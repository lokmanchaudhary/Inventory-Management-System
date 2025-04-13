<?php

namespace App\Filament\Resources\ProfitReportResource\Pages;

use App\Filament\Resources\ProfitReportResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProfitReports extends ListRecords
{
    protected static string $resource = ProfitReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
