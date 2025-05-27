<?php

namespace TimoDeWinter\FilamentMonacoEditor\Filament\Tables\Actions;

use Filament\Actions\Concerns\CanCustomizeProcess;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\Concerns\HasDefaultState;
use TimoDeWinter\FilamentMonacoEditor\Concerns\CanHaveCollection;
use TimoDeWinter\FilamentMonacoEditor\Concerns\CanHaveLanguage;
use TimoDeWinter\FilamentMonacoEditor\Contracts\HasCollection;
use TimoDeWinter\FilamentMonacoEditor\Contracts\HasCustomizationProcess;
use TimoDeWinter\FilamentMonacoEditor\Contracts\HasDefault;
use TimoDeWinter\FilamentMonacoEditor\Contracts\HasLanguage;

class MonacoAction extends Action implements HasCollection, HasCustomizationProcess, HasLanguage, HasDefault
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

        \TimoDeWinter\FilamentMonacoEditor\Filament\Actions\MonacoAction::setUpMonacoAction($this);

        $this->icon('heroicon-o-code-bracket');
    }
}
