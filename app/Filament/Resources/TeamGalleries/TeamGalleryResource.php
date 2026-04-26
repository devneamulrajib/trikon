<?php

namespace App\Filament\Resources\TeamGalleries;

use App\Filament\Resources\TeamGalleries\Pages;
use App\Models\TeamGallery;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;

class TeamGalleryResource extends Resource
{
    protected static ?string $model = TeamGallery::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-photo';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Gallery Image')
                ->schema([
                    FileUpload::make('image')
                        ->image()
                        ->directory('team-gallery')
                        ->required(),

                    TextInput::make('caption')
                        ->placeholder('Optional caption for the image'),

                    TextInput::make('sort_order')
                        ->numeric()
                        ->default(0),
                ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->square(),
                TextColumn::make('caption'),
                TextColumn::make('sort_order')
                    ->sortable(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTeamGalleries::route('/'),
            'create' => Pages\CreateTeamGallery::route('/create'),
            'edit' => Pages\EditTeamGallery::route('/{record}/edit'),
        ];
    }
}