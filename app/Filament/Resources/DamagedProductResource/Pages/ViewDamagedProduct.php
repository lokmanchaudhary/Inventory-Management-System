<?php

namespace App\Filament\Resources\DamagedProductResource\Pages;

use App\Filament\Resources\DamagedProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDamagedProduct extends ViewRecord
{
    protected static string $resource = DamagedProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
