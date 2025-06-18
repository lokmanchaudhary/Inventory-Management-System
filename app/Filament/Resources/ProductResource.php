<?php

namespace App\Filament\Resources;

use App\Enums\Product\PackagingType;
use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?string $navigationIcon = 'heroicon-o-cube';
    protected static ?string $navigationGroup = 'Products Management';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Product Title')
                    ->required()
                    ->maxLength(255)
                    ->lazy()
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),

                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->lazy()
                    ->rule('regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/')
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state)))
                    ->unique(Product::class, 'slug', fn ($record) => $record, ignoreRecord: true),

                Forms\Components\TextInput::make('quantity')
                    ->required()
                    ->minValue(0)
                    ->numeric(),

                Forms\Components\Select::make('packaging_type')
                    ->label('Packaging Type')
                    ->required()
                    ->options([
                        PackagingType::BOX->value => 'Box',
                        PackagingType::BUNDLE->value => 'Bundle',
                        PackagingType::STRIPE->value => 'Stripe',
                        PackagingType::PACKET->value => 'Packet',
                        PackagingType::BOTTLE->value => 'Bottle',
                        PackagingType::CAN->value => 'Can',
                        PackagingType::JAR->value => 'Jar',
                        PackagingType::POUCH->value => 'Pouch',
                        PackagingType::TUBE->value => 'Tube',
                        PackagingType::ROLL->value => 'Roll',
                        PackagingType::SACHET->value => 'Sachet',
                        PackagingType::CRATE->value => 'Crate',
                        PackagingType::TRAY->value => 'Tray',
                        PackagingType::CARTON->value => 'Carton',
                        PackagingType::LOOSE->value => 'Loose',
                    ])
                    ->default(PackagingType::BOX->value),


                Forms\Components\DatePicker::make('date_of_manufacture')
                    ->required()
                    ->maxDate(now()),

                Forms\Components\DatePicker::make('date_of_expiry')
                    ->required()
                    ->after('date_of_manufacture'),

                Forms\Components\TextInput::make('base_price')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->prefix('रु'),

                Forms\Components\TextInput::make('display_price')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->prefix('रु'),

                Forms\Components\Toggle::make('status')
                    ->required()
                    ->label('Visible to customers.')
                    ->default(true)
                    ->onColor('success')
                    ->offColor('danger')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('slug')
                    ->searchable()
                    ->badge()
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('quantity')
                    ->numeric()
                    ->sortable()
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('packaging_type')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(fn (PackagingType $state) => $state->label())
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('date_of_manufacture')
                    ->date()
                    ->sortable()
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('date_of_expiry')
                    ->date()
                    ->badge()
                    ->sortable()
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('base_price')
                    ->numeric()
                    ->sortable()
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('display_price')
                    ->numeric()
                    ->sortable()
                    ->alignCenter(),

                Tables\Columns\ToggleColumn::make('status')
                    ->label('Make Visible ?')
                    ->onColor('success')
                    ->offColor('danger')
                    ->inline()
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('Y-m-d h:i:s A')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('Y-m-d h:i:s A')
                    ->sortable()
                    ->alignCenter()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->label('Show'),
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make()
                        ->label('Edit Product'),
                    Tables\Actions\DeleteAction::make()
                        ->label('Delete Product'),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'view' => Pages\ViewProduct::route('/{record}'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
