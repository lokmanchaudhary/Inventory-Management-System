<?php

namespace App\Filament\Resources\RefundedProductResource\Pages;

use App\Filament\Resources\RefundedProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRefundedProduct extends EditRecord
{
    protected static string $resource = RefundedProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
