<?php

namespace App\Filament\Resources\SalesPerformanceReportResource\Pages;

use App\Filament\Resources\SalesPerformanceReportResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSalesPerformanceReports extends ListRecords
{
    protected static string $resource = SalesPerformanceReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
