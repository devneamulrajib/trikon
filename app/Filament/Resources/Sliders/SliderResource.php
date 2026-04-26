<?php

namespace App\Filament\Resources\Sliders;

use App\Filament\Resources\Sliders\Pages;
use App\Models\Slider;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class SliderResource extends Resource
{
    protected static ?string $model = Slider::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-presentation-chart-bar';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            \Filament\Forms\Components\FileUpload::make('image')
                ->image()
                ->directory('sliders')
                ->disk('public')
                ->required(),
                
            \Filament\Forms\Components\TextInput::make('title')
                ->label('Heading'),
            
            \Filament\Forms\Components\TextInput::make('subtitle')
                ->label('Sub-heading'),
            
            \Filament\Forms\Components\TextInput::make('sort_order')
                ->numeric()
                ->default(0),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            \Filament\Tables\Columns\ImageColumn::make('image')
                ->disk('public'),
            \Filament\Tables\Columns\TextColumn::make('title')
                ->searchable(),
            \Filament\Tables\Columns\TextColumn::make('sort_order'),
        ])->actions([
            \Filament\Actions\EditAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSliders::route('/'),
            'create' => Pages\CreateSlider::route('/create'),
            'edit' => Pages\EditSlider::route('/{record}/edit'),
        ];
    }
}