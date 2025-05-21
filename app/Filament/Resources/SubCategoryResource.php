<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubCategoryResource\Pages;
use App\Filament\Resources\SubCategoryResource\RelationManagers;
use App\Models\Category;
use App\Models\SubCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class SubCategoryResource extends Resource
{
    protected static ?string $model = SubCategory::class;
    protected static ?string $navigationIcon = 'heroicon-o-folder-open';
    protected static ?string $navigationGroup = 'Products Management';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make("title")
                    ->label('SubCategory Title')
                    ->required()
                    ->maxLength(255)
                    ->lazy()
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),

                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->lazy()
                    ->rule('regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/')
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state)))
                    ->unique(SubCategory::class, 'slug', fn ($record) => $record, ignoreRecord: true),

                Forms\Components\Select::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'title', function ($query) {
                        $query->where('status', true)
                            ->orderBy('sequence', 'asc');
                    })
                    ->preload()
                    ->allowHtml()
                    ->required(),

                Forms\Components\Toggle::make('status')
                    ->label('Make Visible ?')
                    ->default(true)
                    ->onColor('success')
                    ->offColor('danger')->columnSpanFull(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('SubCategory Title')
                    ->searchable()
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('slug')
                    ->badge()
                    ->searchable()
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('category.title')
                    ->label('Parent Category')
                    ->icon('heroicon-o-rectangle-group')
                    ->badge()
                    ->color('primary')
                    ->searchable()
                    ->sortable()->alignCenter(),

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
            'index' => Pages\ListSubCategories::route('/'),
            'create' => Pages\CreateSubCategory::route('/create'),
            'view' => Pages\ViewSubCategory::route('/{record}'),
            'edit' => Pages\EditSubCategory::route('/{record}/edit'),
        ];
    }
}
