<?php

namespace TimoDeWinter\FilamentMonacoEditor\Filament\Actions;

use Filament\Actions\Action;
use Filament\Actions\Concerns\CanCustomizeProcess;
use Filament\Schemas\Components\Grid;
use Filament\Support\Enums\Width;
use Filament\Tables\Filters\Concerns\HasDefaultState;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use TimoDeWinter\FilamentMonacoEditor\Concerns\CanHaveCollection;
use TimoDeWinter\FilamentMonacoEditor\Concerns\CanHaveLanguage;
use TimoDeWinter\FilamentMonacoEditor\Contracts\HasCollection;
use TimoDeWinter\FilamentMonacoEditor\Contracts\HasCustomizationProcess;
use TimoDeWinter\FilamentMonacoEditor\Contracts\HasDefault;
use TimoDeWinter\FilamentMonacoEditor\Contracts\HasLanguage;
use TimoDeWinter\FilamentMonacoEditor\Contracts\HasMonacoEditor;
use TimoDeWinter\FilamentMonacoEditor\Filament\Forms\Components\MonacoEditor;

class MonacoAction extends Action implements HasCollection, HasCustomizationProcess, HasDefault, HasLanguage
{
    use CanCustomizeProcess;
    use CanHaveCollection;
    use CanHaveLanguage;
    use HasDefaultState;

    public static function getDefaultName(): ?string
    {
        return 'monaco';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->label(__('filament-monaco-editor::monaco-editor.actions.edit_code'))
            ->modalWidth(Width::Full)
            ->fillForm(function (Model&HasMonacoEditor $record, MonacoAction $action) {
                $collection = $action->getCollection();

                if (! is_array($collection)) {
                    $editorCode = $record->editorCodes()->firstWhere('collection', $collection);

                    return ['code' => $editorCode->code ?? $action->getDefaultState()];
                }

                $editorCodes = $record
                    ->editorCodes()
                    ->whereIn('collection', array_keys($collection))
                    ->get()
                    ->pluck('code', 'collection');

                return collect($collection)
                    ->keys()
                    ->mapWithKeys(function (string $collection) use ($action, $editorCodes) {
                        $code = $editorCodes->get($collection, $action->getDefaultState()[$collection] ?? null);

                        return [$collection => $code];
                    })
                    ->toArray();
            })
            ->schema(function () {
                if (! is_array($collection = $this->getCollection())) {
                    return [
                        MonacoEditor::make('code')
                            ->hiddenLabel()
                            ->language($this->getLanguage()),
                    ];
                }

                return [
                    Grid::make(['xs' => 1, 'lg' => 2])
                        ->schema(
                            collect($collection)
                                ->map(function (string $language, string $collection) {
                                    return MonacoEditor::make($collection)
                                        ->label("$collection ($language)")
                                        ->language($language);
                                })
                                ->toArray()
                        ),
                ];
            })
            ->collection(fn () => $this->getLanguage())
            ->successNotificationTitle(__('filament-monaco-editor::monaco-editor.notifications.code_saved'))
            ->action(function (): void {
                $result = $this->process(static function (Model&HasMonacoEditor $record, MonacoAction $action, array $data) {
                    $collection = $action->getCollection();

                    if (! is_array($collection)) {
                        $editorCode = $record->editorCodes()->firstWhere('collection', $collection) ?? $record->editorCodes()->make(['collection' => $collection]);

                        $editorCode->fill(['code' => $data['code']]);
                        $editorCode->save();

                        return $editorCode;
                    }

                    // Since the collection is an array we need to process multiple collections
                    return DB::transaction(function () use ($collection, $record, $data) {
                        $editorCodes = $record->editorCodes()
                            ->whereIn('collection', array_keys($collection))
                            ->get()
                            ->keyBy('collection');

                        foreach (array_keys($collection) as $collectionToFill) {
                            $editorCode = $editorCodes->get($collectionToFill, function () use ($collectionToFill, $record) {
                                return $record->editorCodes()->make(['collection' => $collectionToFill]);
                            });

                            $editorCode->fill(['code' => $data[$collectionToFill] ?? null]);
                            $editorCode->save();
                        }

                        return true;
                    });
                });

                if (! $result) {
                    $this->failure();

                    return;
                }

                $this->success();
            });
    }
}
