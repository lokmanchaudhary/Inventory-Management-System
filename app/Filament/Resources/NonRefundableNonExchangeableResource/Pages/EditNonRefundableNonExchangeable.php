<?php

namespace App\Filament\Resources\NonRefundableNonExchangeableResource\Pages;

use App\Filament\Resources\NonRefundableNonExchangeableResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNonRefundableNonExchangeable extends EditRecord
{
    protected static string $resource = NonRefundableNonExchangeableResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
