<?php

namespace App\Filament\Resources\News\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class NewsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('title')
                ->required()
                ->maxLength(255),

            DatePicker::make('published_at')
                ->label('Event Date')
                ->required()
                ->default(now()),

            FileUpload::make('image')
                ->image()
                ->directory('news')
                ->required(),

            Textarea::make('description')
                ->rows(3)
                ->columnSpanFull(),

            TextInput::make('sort_order')
                ->numeric()
                ->default(0),
        ]);
    }
}