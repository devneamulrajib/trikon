<?php

namespace App\Filament\Resources\Sliders\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;

class SliderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Slider Content')
                    ->description('Upload high-quality luxury images for the homepage slider')
                    ->schema([
                        FileUpload::make('image')
                            ->image()
                            ->directory('sliders')
                            ->required()
                            ->columnSpanFull(),
                        TextInput::make('title')
                            ->label('Main Title (e.g. The New Era)')
                            ->placeholder('Leave blank if not needed'),
                        TextInput::make('subtitle')
                            ->label('Subtitle (e.g. Advancing Into)')
                            ->placeholder('Leave blank if not needed'),
                        TextInput::make('sort_order')
                            ->numeric()
                            ->default(0),
                    ])->columns(2)
            ]);
    }
}