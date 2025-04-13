<?php

namespace App\Filament\Resources\ProductExchangeResource\Pages;

use App\Filament\Resources\ProductExchangeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProductExchanges extends ListRecords
{
    protected static string $resource = ProductExchangeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
