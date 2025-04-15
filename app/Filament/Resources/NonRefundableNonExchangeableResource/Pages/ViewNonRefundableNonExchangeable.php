<?php

namespace App\Filament\Resources\NonRefundableNonExchangeableResource\Pages;

use App\Filament\Resources\NonRefundableNonExchangeableResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewNonRefundableNonExchangeable extends ViewRecord
{
    protected static string $resource = NonRefundableNonExchangeableResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
