<?php

namespace App\Filament\Resources\NonRefundableNonExchangeableResource\Pages;

use App\Filament\Resources\NonRefundableNonExchangeableResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateNonRefundableNonExchangeable extends CreateRecord
{
    protected static string $resource = NonRefundableNonExchangeableResource::class;
}
