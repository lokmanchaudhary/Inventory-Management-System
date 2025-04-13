<?php

namespace App\Filament\Resources\ProfitReportResource\Pages;

use App\Filament\Resources\ProfitReportResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProfitReport extends EditRecord
{
    protected static string $resource = ProfitReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
