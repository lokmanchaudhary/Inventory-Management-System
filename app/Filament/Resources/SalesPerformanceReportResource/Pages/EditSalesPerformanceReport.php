<?php

namespace App\Filament\Resources\SalesPerformanceReportResource\Pages;

use App\Filament\Resources\SalesPerformanceReportResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSalesPerformanceReport extends EditRecord
{
    protected static string $resource = SalesPerformanceReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
