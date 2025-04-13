<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductExchangeResource\Pages;
use App\Filament\Resources\ProductExchangeResource\RelationManagers;
use App\Models\ProductExchange;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductExchangeResource extends Resource
{
    protected static ?string $model = ProductExchange::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrows-right-left';
    protected static ?string $navigationGroup = 'Products Management';
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('damaged_product_id')
                    ->label('Damaged Product')
                    ->relationship('damagedProduct', 'id')
                    ->required(),

                Forms\Components\Select::make('exchanged_product_id')
                    ->label('Exchanged With')
                    ->relationship('exchangedProduct', 'title')
                    ->searchable()
                    ->required(),

                Forms\Components\TextInput::make('quantity')
                    ->required()
                    ->numeric()
                    ->minValue(1),

                Forms\Components\TextInput::make('value')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->prefix('रु'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('damagedProduct.product.title')
                    ->label('Damaged Product')
                    ->searchable(),

                Tables\Columns\TextColumn::make('exchangedProduct.title')
                    ->label('Exchanged Product')
                    ->searchable(),

                Tables\Columns\TextColumn::make('quantity')
                    ->sortable(),

                Tables\Columns\TextColumn::make('value')
                    ->money('NPR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('Y-m-d h:i A')
                    ->sortable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('Y-m-d h:i:s A')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)->alignCenter(),
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
            'index' => Pages\ListProductExchanges::route('/'),
            'create' => Pages\CreateProductExchange::route('/create'),
            'view' => Pages\ViewProductExchange::route('/{record}'),
            'edit' => Pages\EditProductExchange::route('/{record}/edit'),
        ];
    }
}
