<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfitReportResource\Pages;
use App\Filament\Resources\ProfitReportResource\RelationManagers;
use App\Models\ProfitReport;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProfitReportResource extends Resource
{
    protected static ?string $model = ProfitReport::class;
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?string $navigationGroup = 'Products Management';
    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('product_id')
                    ->label('Product')
                    ->relationship('product', 'title')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $product = \App\Models\Product::find($state);

                        if ($product) {
                            // Calculate total sales
                            $totalSales = $product->display_price * $product->quantity;

                            // Fetch related damaged product data
                            $damagedProduct = \App\Models\DamagedProduct::where('product_id', $product->id)->latest()->first();

                            // Calculate related amounts
                            $totalRefunded = $damagedProduct?->refunded_amount ?? 0;
                            $totalExchanged = $damagedProduct?->exchanged_value ?? 0;
                            $nonRefundableQty = $damagedProduct?->non_exchangeable_non_refundable_quantity ?? 0;

                            // Calculate profit
                            $profit = $totalSales - $totalRefunded - $totalExchanged;

                            // Set the calculated values to the form
                            $set('sales_revenue', $totalSales);
                            $set('refunded', $totalRefunded);
                            $set('damaged_loss', $totalExchanged);
                            $set('total_profit', $profit);
                        }
                    })
                    ->required(),

                Forms\Components\DatePicker::make('report_date')
                    ->label('Report Date')
                    ->required()
                    ->default(now()),

                Forms\Components\TextInput::make('sales_revenue')  // Adjusted to match schema
                ->numeric()
                ->prefix('रु'),

            Forms\Components\TextInput::make('cost')  // Ensure cost is required in form
            ->numeric()
                ->required()
                ->prefix('रु'),

            Forms\Components\TextInput::make('refunded')  // Added refunded amount
            ->numeric()
                ->nullable()
                ->prefix('रु'),

            Forms\Components\TextInput::make('damaged_loss')  // Added damaged loss
            ->numeric()
                ->nullable()
                ->prefix('रु'),

            Forms\Components\TextInput::make('total_profit')  // Added total profit
            ->numeric()
                ->nullable()
                ->prefix('रु'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product.title')
                    ->label('Product')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('sales_revenue')
                    ->label('Sales Revenue')
                    ->money('NPR'),

                Tables\Columns\TextColumn::make('cost')
                    ->label('Cost')
                    ->money('NPR'),

                Tables\Columns\TextColumn::make('refunded')
                    ->label('Refunded Amount')
                    ->money('NPR'),

                Tables\Columns\TextColumn::make('damaged_loss')
                    ->label('Damaged Loss')
                    ->money('NPR'),

                Tables\Columns\TextColumn::make('total_profit')
                    ->label('Total Profit')
                    ->money('NPR'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('Y-m-d h:i:s A')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->alignCenter(),

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
            'index' => Pages\ListProfitReports::route('/'),
            'create' => Pages\CreateProfitReport::route('/create'),
            'view' => Pages\ViewProfitReport::route('/{record}'),
            'edit' => Pages\EditProfitReport::route('/{record}/edit'),
        ];
    }
}
