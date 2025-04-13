<?php

namespace App\Filament\Resources\ProfitReportResource\Pages;

use App\Filament\Resources\ProfitReportResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewProfitReport extends ViewRecord
{
    protected static string $resource = ProfitReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
