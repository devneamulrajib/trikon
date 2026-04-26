<?php

namespace App\Filament\Resources\Directors;

use App\Filament\Resources\Directors\Pages\CreateDirector;
use App\Filament\Resources\Directors\Pages\EditDirector;
use App\Filament\Resources\Directors\Pages\ListDirectors;
use App\Models\Director;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction; // Corrected namespace
use Filament\Actions\DeleteAction; // Corrected namespace

class DirectorResource extends Resource
{
    protected static ?string $model = Director::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-users';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Director Information')
                ->description('Enter the details for the Board of Director member.')
                ->schema([
                    TextInput::make('name')
                        ->label('Full Name')
                        ->required(),

                    TextInput::make('designation')
                        ->label('Designation')
                        ->required(),

                    TextInput::make('sort_order')
                        ->label('Display Order')
                        ->numeric()
                        ->default(0),

                    FileUpload::make('image')
                        ->label('Profile Photo')
                        ->image()
                        ->directory('directors')
                        ->required(),

                    Textarea::make('description')
                        ->label('Biography / Message')
                        ->rows(8)
                        ->required()
                        ->columnSpanFull(),
                ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Photo')
                    ->circular(),

                TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('designation')
                    ->label('Designation'),

                TextColumn::make('sort_order')
                    ->label('Order')
                    ->sortable(),
            ])
            ->defaultSort('sort_order', 'asc')
            ->actions([
                EditAction::make(), // Uses the imported class
                DeleteAction::make(), // Uses the imported class
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDirectors::route('/'),
            'create' => CreateDirector::route('/create'),
            'edit' => EditDirector::route('/{record}/edit'),
        ];
    }
}