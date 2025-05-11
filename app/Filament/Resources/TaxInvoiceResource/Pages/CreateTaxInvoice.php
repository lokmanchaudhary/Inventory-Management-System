<?php

namespace App\Filament\Resources\TaxInvoiceResource\Pages;

use App\Filament\Resources\TaxInvoiceResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTaxInvoice extends CreateRecord
{
    protected static string $resource = TaxInvoiceResource::class;
}
