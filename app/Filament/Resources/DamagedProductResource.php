<?php

namespace App\Filament\Resources;

use App\Enums\DamagedProduct\DamagedProductStatus;
use App\Filament\Resources\DamagedProductResource\Pages;
use App\Filament\Resources\DamagedProductResource\RelationManagers;
use App\Models\DamagedProduct;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DamagedProductResource extends Resource
{
    protected static ?string $model = DamagedProduct::class;

    protected static ?string $navigationIcon = 'heroicon-o-exclamation-triangle';
    protected static ?string $navigationGroup = 'Products Management';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('product_id')
                    ->relationship('product', 'title')
                    ->searchable()
                    ->preload()
                    ->required(),

                Forms\Components\TextInput::make('damaged_quantity')
                    ->numeric()
                    ->required()
                    ->minValue(1)
                    ->reactive(),

                Forms\Components\TextInput::make('refundable_quantity')
                    ->numeric()
                    ->minValue(0)
                    ->reactive()
                    ->afterStateUpdated(function (callable $set, callable $get) {
                        $set('non_exchangeable_non_refundable_quantity',
                            max(0, ($get('damaged_quantity') ?? 0) - ($get('refundable_quantity') ?? 0) - ($get('exchangeable_quantity') ?? 0))
                        );
                    }),

                Forms\Components\TextInput::make('exchangeable_quantity')
                    ->numeric()
                    ->minValue(0)
                    ->reactive()
                    ->afterStateUpdated(function (callable $set, callable $get) {
                        $set('non_exchangeable_non_refundable_quantity',
                            max(0, ($get('damaged_quantity') ?? 0) - ($get('refundable_quantity') ?? 0) - ($get('exchangeable_quantity') ?? 0))
                        );
                    }),

                Forms\Components\TextInput::make('non_exchangeable_non_refundable_quantity')
                    ->numeric()
                    ->disabled()
                    ->dehydrated()
                    ->minValue(0),

                Forms\Components\TextInput::make('damaged_value')
                    ->numeric()
                    ->minValue(0)
                    ->prefix('रु')
                    ->nullable(),

                Forms\Components\Select::make('status')
                    ->required()
                    ->options([
                        DamagedProductStatus::PENDING->value => 'Pending',
                        DamagedProductStatus::REFUNDED->value => 'Refunded',
                        DamagedProductStatus::EXCHANGED->value => 'Exchanged',
                    ])
                    ->default(DamagedProductStatus::PENDING->value),

                Forms\Components\Textarea::make('remarks')
                    ->rows(3)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product.title')
                    ->label('Product')
                    ->alignCenter()
                    ->searchable(),
                Tables\Columns\TextColumn::make('damaged_quantity')
                    ->alignCenter()
                    ->sortable(),
                Tables\Columns\TextColumn::make('refundable_quantity')
                    ->alignCenter()
                    ->sortable(),
                Tables\Columns\TextColumn::make('exchangeable_quantity')
                    ->alignCenter()
                    ->sortable(),
                Tables\Columns\TextColumn::make('non_exchangeable_non_refundable_quantity')
                    ->alignCenter()
                    ->sortable(),
                Tables\Columns\TextColumn::make('damaged_value')
                    ->money('NPR')
                    ->alignCenter()
                    ->sortable(),

                Tables\Columns\SelectColumn::make('status')
                    ->alignCenter()
                    ->options([
                        DamagedProductStatus::PENDING->value => 'Pending',
                        DamagedProductStatus::REFUNDED->value => 'Refunded',
                        DamagedProductStatus::EXCHANGED->value => 'Exchanged',
                    ])
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->alignCenter()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('Y-m-d h:i:s A')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->alignCenter(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->label('Show'),
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make()
                        ->label('Edit Sub Category'),
                    Tables\Actions\DeleteAction::make()
                        ->label('Delete Sub Category'),
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
            'index' => Pages\ListDamagedProducts::route('/'),
            'create' => Pages\CreateDamagedProduct::route('/create'),
            'view' => Pages\ViewDamagedProduct::route('/{record}'),
            'edit' => Pages\EditDamagedProduct::route('/{record}/edit'),
        ];
    }
}
