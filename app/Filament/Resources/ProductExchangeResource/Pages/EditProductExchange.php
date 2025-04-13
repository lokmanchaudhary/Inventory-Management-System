<?php

namespace App\Filament\Resources\ProductExchangeResource\Pages;

use App\Filament\Resources\ProductExchangeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProductExchange extends EditRecord
{
    protected static string $resource = ProductExchangeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
