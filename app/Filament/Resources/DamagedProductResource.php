<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DamagedProductResource\Pages;
use App\Filament\Resources\DamagedProductResource\RelationManagers;
use App\Models\DamagedProduct;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

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
                    ->required(),

                Forms\Components\TextInput::make('damaged_quantity')
                    ->numeric()
                    ->required()
                    ->minValue(1),

                Forms\Components\TextInput::make('refundable_quantity')
                    ->numeric()
                    ->minValue(0),

                Forms\Components\TextInput::make('exchangeable_quantity')
                    ->numeric()
                    ->minValue(0),

                Forms\Components\TextInput::make('non_exchangeable_non_refundable_quantity')
                    ->numeric()
                    ->minValue(0),

                Forms\Components\TextInput::make('refunded_amount')
                    ->numeric()
                    ->minValue(0)
                    ->prefix('रु')
                    ->nullable(),

                Forms\Components\TextInput::make('exchanged_value')
                    ->numeric()
                    ->minValue(0)
                    ->prefix('रु')
                    ->nullable(),

                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'refunded' => 'Refunded',
                        'exchanged' => 'Exchanged',
                    ])
                    ->required(),

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
                Tables\Columns\TextColumn::make('refunded_amount')
                    ->money('NPR')
                    ->alignCenter()
                    ->sortable(),
                Tables\Columns\TextColumn::make('exchanged_value')
                    ->alignCenter()
                    ->money('NPR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->alignCenter()
                    ->badge()
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
