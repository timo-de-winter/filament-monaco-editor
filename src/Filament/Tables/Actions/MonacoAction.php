<?php

namespace TimoDeWinter\FilamentMonacoEditor\Filament\Tables\Actions;

use Filament\Actions\Concerns\CanCustomizeProcess;
use Filament\Tables\Actions\Action;
use TimoDeWinter\FilamentMonacoEditor\Concerns\CanHaveCollection;
use TimoDeWinter\FilamentMonacoEditor\Concerns\CanHaveLanguage;
use TimoDeWinter\FilamentMonacoEditor\Contracts\HasCollection;
use TimoDeWinter\FilamentMonacoEditor\Contracts\HasCustomizationProcess;
use TimoDeWinter\FilamentMonacoEditor\Contracts\HasLanguage;

class MonacoAction extends Action implements HasLanguage, HasCollection, HasCustomizationProcess
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
