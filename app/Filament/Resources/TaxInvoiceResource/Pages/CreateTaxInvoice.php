<?php

namespace App\Filament\Resources\TaxInvoiceResource\Pages;

use App\Filament\Resources\TaxInvoiceResource;
use Filament\Actions;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard\Step;
use Filament\Resources\Pages\CreateRecord;

class CreateTaxInvoice extends CreateRecord
{
    use CreateRecord\Concerns\HasWizard;

    protected static string $resource = TaxInvoiceResource::class;

    protected function getSteps(): array
    {
        return [
                Step::make('Seller & Invoice Info')
                    ->schema([
                        TextInput::make('seller_id')
                            ->required()
                            ->numeric(),

                        TextInput::make('invoice_number')
                            ->required()
                            ->maxLength(255),

                        DatePicker::make('invoice_date')
                            ->required()
                            ->maxDate(now()),

                        Select::make('payment_type')
                            ->options([
                                'cash' => 'Cash',
                                'card' => 'Card',
                                'bank' => 'Bank Transfer',
                            ])
                            ->searchable()
                            ->nullable(),
                    ]),

                Step::make('Product Details')
                    ->schema([
                        TextInput::make('product_name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('hs_code')
                            ->nullable()
                            ->maxLength(255),

                        TextInput::make('unit')
                            ->nullable()
                            ->maxLength(50),

                        TextInput::make('pack')
                            ->required()
                            ->numeric(),

                        TextInput::make('pcs')
                            ->required()
                            ->numeric(),

                        TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->prefix('$'),

                        TextInput::make('discount')
                            ->required()
                            ->numeric(),

                        TextInput::make('type')
                            ->nullable()
                            ->maxLength(255),
                    ]),

                Step::make('Totals & Summary')
                    ->schema([
                        TextInput::make('amount')
                            ->numeric()
                            ->nullable(),

                        TextInput::make('total_pack_quantity')
                            ->numeric()
                            ->nullable(),

                        TextInput::make('sub_total')
                            ->required()
                            ->numeric(),

                        TextInput::make('discount_total')
                            ->required()
                            ->numeric(),

                        TextInput::make('ebf_vat_amount')
                            ->required()
                            ->numeric(),

                        TextInput::make('vat')
                            ->required()
                            ->numeric(),

                        TextInput::make('net_total')
                            ->required()
                            ->numeric(),
                    ])
        ];
    }
}
