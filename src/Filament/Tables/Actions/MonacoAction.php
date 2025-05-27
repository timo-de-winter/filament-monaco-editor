<?php

namespace TimoDeWinter\FilamentMonacoEditor\Filament\Tables\Actions;

use Filament\Actions\Concerns\CanCustomizeProcess;
use Filament\Tables\Actions\Action;
use TimoDeWinter\FilamentMonacoEditor\Concerns\CanHaveCollection;
use TimoDeWinter\FilamentMonacoEditor\Concerns\CanHaveLanguage;

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

        \TimoDeWinter\FilamentMonacoEditor\Filament\Actions\MonacoAction::setUpMonacoAction($this);

        $this->icon('heroicon-o-code-bracket');
    }
}
