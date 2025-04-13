<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;
    protected static ?string $navigationIcon = 'heroicon-o-folder';
    protected static ?string $navigationGroup = 'Products Management';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\TextInput::make("title")
                            ->label('Category Title')
                            ->required()
                            ->maxLength(255)
                            ->lazy()
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),

                        Forms\Components\TextInput::make('slug')
                            ->hint('URL resource')
                            ->hintIcon('heroicon-o-globe-alt')
                            ->hintColor('secondary')
                            ->required()
                            ->lazy()
                            ->rule('regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/')
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state)))
                            ->unique(Category::class, 'slug', fn ($record) => $record, ignoreRecord: true),

                        Forms\Components\Toggle::make('status')
                            ->label('Make Visible ?')
                            ->default(true)
                            ->onColor('success')
                            ->offColor('danger'),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Category Title')
                    ->searchable()
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('slug')
                    ->badge()
                    ->searchable()
                    ->alignCenter(),

                Tables\Columns\IconColumn::make('status')
                    ->boolean()
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
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('Y-m-d h:i:s A')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Show'),
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make()
                        ->label('Edit Category'),
                    Tables\Actions\DeleteAction::make()
                        ->label('Delete Category'),
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'view' => Pages\ViewCategory::route('/{record}'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
