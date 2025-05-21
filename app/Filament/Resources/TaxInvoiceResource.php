<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TaxInvoiceResource\Pages;
use App\Filament\Resources\TaxInvoiceResource\RelationManagers;
use App\Models\TaxInvoice;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TaxInvoiceResource extends Resource
{
    protected static ?string $model = TaxInvoice::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Reports Management';
    protected static ?int $navigationSort = 9;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Seller & Invoice Info')
                    ->schema([
                        Forms\Components\TextInput::make('seller_id')
                            ->required()
                            ->numeric(),

                        Forms\Components\TextInput::make('invoice_number')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\DatePicker::make('invoice_date')
                            ->required()
                            ->maxDate(now()),

                        Forms\Components\TextInput::make('payment_type')
                            ->maxLength(255)
                            ->default(null),
                    ]),

                Forms\Components\Section::make('Product Details')
                    ->schema([
                        Forms\Components\TextInput::make('product_name')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('hs_code')
                            ->maxLength(255)
                            ->default(null),

                        Forms\Components\TextInput::make('unit'),

                        Forms\Components\TextInput::make('pack')
                            ->required()
                            ->numeric(),

                        Forms\Components\TextInput::make('pcs')
                            ->required()
                            ->numeric(),

                        Forms\Components\TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->prefix('$'),

                        Forms\Components\TextInput::make('discount')
                            ->required()
                            ->numeric(),

                        Forms\Components\TextInput::make('type')
                            ->maxLength(255)
                            ->default(null),
                    ]),

                Forms\Components\Section::make('Totals & Summary')
                    ->schema([
                        Forms\Components\TextInput::make('amount')
                            ->numeric()
                            ->default(null),

                        Forms\Components\TextInput::make('total_pack_quantity')
                            ->numeric()
                            ->default(null),

                        Forms\Components\TextInput::make('sub_total')
                            ->required()
                            ->numeric(),

                        Forms\Components\TextInput::make('discount_total')
                            ->required()
                            ->numeric(),

                        Forms\Components\TextInput::make('ebf_vat_amount')
                            ->required()
                            ->numeric(),

                        Forms\Components\TextInput::make('vat')
                            ->required()
                            ->numeric(),

                        Forms\Components\TextInput::make('net_total')
                            ->required()
                            ->numeric(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('seller_id')
                    ->alignCenter()
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('invoice_number')
                    ->alignCenter()
                    ->searchable(),
                Tables\Columns\TextColumn::make('invoice_date')
                    ->alignCenter()
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_type')
                    ->alignCenter()
                    ->searchable(),
                Tables\Columns\TextColumn::make('product_name')
                    ->alignCenter()
                    ->searchable(),
                Tables\Columns\TextColumn::make('hs_code')
                    ->alignCenter()
                    ->searchable(),
                Tables\Columns\TextColumn::make('unit')
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('pack')
                    ->alignCenter()
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('pcs')
                    ->alignCenter()
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->alignCenter()
                    ->money()
                    ->sortable(),
                Tables\Columns\TextColumn::make('discount')
                    ->alignCenter()
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->alignCenter()
                    ->searchable(),
                Tables\Columns\TextColumn::make('amount')
                    ->alignCenter()
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_pack_quantity')
                    ->alignCenter()
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sub_total')
                    ->alignCenter()
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('discount_total')
                    ->alignCenter()
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ebf_vat_amount')
                    ->alignCenter()
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('vat')
                    ->alignCenter()
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('net_total')
                    ->alignCenter()
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->alignCenter()
                    ->dateTime('Y-m-d h:i:s A')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->alignCenter()
                    ->dateTime('Y-m-d h:i:s A')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->label('Show'),
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make()
                        ->label('Edit Tax Invoice'),
                    Tables\Actions\DeleteAction::make()
                        ->label('Delete Tax Invoice'),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTaxInvoices::route('/'),
            'create' => Pages\CreateTaxInvoice::route('/create'),
            'view' => Pages\ViewTaxInvoice::route('/{record}'),
            'edit' => Pages\EditTaxInvoice::route('/{record}/edit'),
        ];
    }
}
