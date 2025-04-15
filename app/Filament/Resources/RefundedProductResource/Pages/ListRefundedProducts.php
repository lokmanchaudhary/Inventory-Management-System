<?php

namespace App\Filament\Resources\RefundedProductResource\Pages;

use App\Filament\Resources\RefundedProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRefundedProducts extends ListRecords
{
    protected static string $resource = RefundedProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
