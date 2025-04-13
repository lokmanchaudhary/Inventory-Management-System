<?php

namespace App\Filament\Resources\ProductExchangeResource\Pages;

use App\Filament\Resources\ProductExchangeResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewProductExchange extends ViewRecord
{
    protected static string $resource = ProductExchangeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
