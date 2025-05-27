<?php

namespace TimoDeWinter\FilamentMonacoEditor\Filament\Actions;

use Filament\Actions\Action;
use Filament\Actions\Concerns\CanCustomizeProcess;
use Filament\Actions\MountableAction;
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

    public static function setUpMonacoAction(MountableAction $action)
    {
        $action->label(__('filament-monaco-editor::monaco-editor.actions.edit_code'));

        $action->fillForm(function (Model&HasMonacoEditor $record, MonacoAction $action) {
            $collection = $action->getCollection();
            $editorCode = $record->editorCodes()->firstWhere('collection', $collection);

            if (is_null($editorCode)) {
                return [];
            }

            return $editorCode->attributesToArray();
        });

        $action->form(fn () => [
            MonacoEditor::make('code')
                ->hiddenLabel()
                ->language($action->getLanguage()),
        ]);

        $action->collection(fn () => $action->getLanguage());

        $action->successNotificationTitle(__('filament-monaco-editor::monaco-editor.notifications.code_saved'));

        $action->action(function () use ($action): void {
            $result = $action->process(static function (Model&HasMonacoEditor $record, MonacoAction $action, array $data) {
                $collection = $action->getCollection();

                $editorCode = $record->editorCodes()->firstWhere('collection', $collection) ?? $record->editorCodes()->make(['collection' => $collection]);

                $editorCode->fill([
                    'code' => $data['code'],
                ]);

                $editorCode->save();

                return $editorCode;
            });

            if (! $result) {
                $action->failure();

                return;
            }

            $action->success();
        });
    }

    protected function setUp(): void
    {
        parent::setUp();

        self::setUpMonacoAction($this);
    }
}
