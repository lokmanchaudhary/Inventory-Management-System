<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SalesPerformanceReportResource\Pages;
use App\Filament\Resources\SalesPerformanceReportResource\RelationManagers;
use App\Models\SalesPerformanceReport;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SalesPerformanceReportResource extends Resource
{
    protected static ?string $model = SalesPerformanceReport::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?string $navigationGroup = 'Reports Management';
    protected static ?int $navigationSort = 8;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('product_id')
                    ->relationship('product', 'title')
                    ->required(),
                Forms\Components\TextInput::make('total_sales')
                    ->required()
                    ->numeric()
                    ->default(0.00),
                Forms\Components\TextInput::make('total_refunded')
                    ->required()
                    ->numeric()
                    ->default(0.00),
                Forms\Components\TextInput::make('total_exchanged_value')
                    ->required()
                    ->numeric()
                    ->default(0.00),
                Forms\Components\TextInput::make('non_refundable_loss')
                    ->required()
                    ->numeric()
                    ->default(0.00),
                Forms\Components\TextInput::make('net_profit')
                    ->required()
                    ->numeric()
                    ->default(0.00),
                Forms\Components\DatePicker::make('report_date')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product.title')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_sales')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_refunded')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_exchanged_value')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('non_refundable_loss')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('net_profit')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('report_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListSalesPerformanceReports::route('/'),
            'create' => Pages\CreateSalesPerformanceReport::route('/create'),
            'view' => Pages\ViewSalesPerformanceReport::route('/{record}'),
            'edit' => Pages\EditSalesPerformanceReport::route('/{record}/edit'),
        ];
    }
}
