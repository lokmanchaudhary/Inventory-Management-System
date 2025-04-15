<?php

namespace App\Filament\Resources\RefundedProductResource\Pages;

use App\Filament\Resources\RefundedProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewRefundedProduct extends ViewRecord
{
    protected static string $resource = RefundedProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
