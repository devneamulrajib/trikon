<?php

namespace App\Filament\Resources\SisterConcerns;

use App\Models\SisterConcern;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;

class SisterConcernResource extends Resource
{
    protected static ?string $model = SisterConcern::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-briefcase';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Sister Concern Details')
                ->description('Enter the details for the sister company.')
                ->schema([
                    TextInput::make('name')
                        ->required()
                        ->placeholder('e.g. Trikon Real Estate Ltd.'),

                    TextInput::make('sort_order')
                        ->numeric()
                        ->default(0),

                    FileUpload::make('logo')
                        ->label('Company Logo')
                        ->image()
                        ->directory('sister-concerns')
                        ->required(),

                    Textarea::make('description')
                        ->label('Company Profile')
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
                ImageColumn::make('logo')
                    ->label('Logo'),

                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('sort_order')
                    ->label('Order')
                    ->sortable(),
            ])
            ->defaultSort('sort_order', 'asc')
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }

    // Simplest way to get it working: use standard index/create/edit routes
    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Resources\SisterConcerns\Pages\ListSisterConcerns::route('/'),
            'create' => \App\Filament\Resources\SisterConcerns\Pages\CreateSisterConcern::route('/create'),
            'edit' => \App\Filament\Resources\SisterConcerns\Pages\EditSisterConcern::route('/{record}/edit'),
        ];
    }
}