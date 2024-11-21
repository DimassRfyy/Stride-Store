<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Shoe;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextArea;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ShoeResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ShoeResource\RelationManagers;

class ShoeResource extends Resource
{
    protected static ?string $model = Shoe::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';

    protected static ?string $navigationGroup = 'Shoes Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Details')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->prefix('IDR'),
                        FileUpload::make('thumbnail')
                            ->image()
                            ->disk('public')
                            ->directory('shoesThumbnail')
                            ->required(),
                        Repeater::make('photos')
                            ->relationship('photos')
                            ->schema([
                                FileUpload::make('photo')
                                    ->image()
                                    ->disk('public')
                                    ->directory('shoesPhotos')
                                    ->required()
                            ]),
                        Repeater::make('sizes')
                            ->relationship('sizes')
                            ->schema([
                                TextInput::make('size')
                                    ->required()
                            ]),

                    ]),
                Fieldset::make('Additional')
                    ->schema([
                        TextArea::make('about')
                            ->required(),
                        Select::make('is_popular')
                            ->options([
                                '1' => 'Popular',
                                '0' => 'Not Popular'
                            ])
                            ->required(),
                        Select::make('category_id')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Select::make('brand_id')
                            ->relationship('brand', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        TextInput::make('stock')
                            ->required()
                            ->numeric()
                            ->prefix('Qty')
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('category.name'),
                ImageColumn::make('thumbnail'),
                IconColumn::make('is_popular')
                    ->boolean()
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->label('Popular'),
            ])
            ->filters([
                SelectFilter::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name'),
                SelectFilter::make('brand_id')
                    ->label('Brand')
                    ->relationship('brand', 'name')
            ])
            ->actions([
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
            'index' => Pages\ListShoes::route('/'),
            'create' => Pages\CreateShoe::route('/create'),
            'edit' => Pages\EditShoe::route('/{record}/edit'),
        ];
    }
}
