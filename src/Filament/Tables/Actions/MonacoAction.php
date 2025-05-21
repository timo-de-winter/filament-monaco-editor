<?php

namespace TimoDeWinter\FilamentMonacoEditor\Filament\Tables\Actions;

use Filament\Actions\Concerns\CanCustomizeProcess;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;
use TimoDeWinter\FilamentMonacoEditor\Concerns\CanHaveCollection;
use TimoDeWinter\FilamentMonacoEditor\Concerns\CanHaveLanguage;
use TimoDeWinter\FilamentMonacoEditor\Contracts\HasMonacoEditor;
use TimoDeWinter\FilamentMonacoEditor\Filament\Forms\Components\MonacoEditor;

class MonacoAction extends Action
{
    use CanCustomizeProcess;
    use CanHaveCollection;
    use CanHaveLanguage;

    public static function getDefaultName(): ?string
    {
        return 'monaco';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(__('filament-monaco-editor::monaco-editor.actions.edit_code'));

        $this->fillForm(function (Model&HasMonacoEditor $record, MonacoAction $action) {
            $collection = $action->getCollection();
            $editorCode = $record->editorCodes()->firstWhere('collection', $collection);

            if (is_null($editorCode)) {
                return [];
            }

            return $editorCode->attributesToArray();
        });

        $this->form(fn () => [
            MonacoEditor::make('code')
                ->hiddenLabel()
                ->language($this->getLanguage()),
        ]);

        $this->collection(fn () => $this->getLanguage());

        $this->successNotificationTitle(__('filament-monaco-editor::monaco-editor.notifications.code_saved'));

        $this->icon('heroicon-o-code-bracket');

        $this->action(function (): void {
            $result = $this->process(static function (Model&HasMonacoEditor $record, MonacoAction $action, array $data) {
                $collection = $action->getCollection();

                $editorCode = $record->editorCodes()->firstWhere('collection', $collection) ?? $record->editorCodes()->make(['collection' => $collection]);

                $editorCode->fill([
                    'code' => $data['code'],
                ]);

                $editorCode->save();

                return $editorCode;
            });

            if (! $result) {
                $this->failure();

                return;
            }

            $this->success();
        });
    }
}
