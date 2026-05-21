<?php

namespace App\Filament\Resources\Testimonials\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;

class TestimonialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Customer Review Details')
                ->description('Add customer feedback and their video/photo.')
                ->schema([
                    TextInput::make('name')
                        ->label('Customer Name')
                        ->required(),

                    TextInput::make('role')
                        ->label('Customer Designation')
                        ->placeholder('e.g. Apartment Owner / Landowner')
                        ->required(),

                    Textarea::make('content')
                        ->label('Review Content / Quote')
                        ->rows(5)
                        ->required()
                        ->columnSpanFull(),

                    TextInput::make('video_url')
                        ->label('YouTube Video URL')
                        ->placeholder('https://www.youtube.com/watch?v=...')
                        ->url()
                        ->helperText('Leave empty if there is no video.'),

                    FileUpload::make('image')
                        ->label('Customer Photo / Thumbnail')
                        ->image()
                        ->directory('testimonials')
                        ->visibility('public')
                        ->required()
                        ->helperText('This will show in the small boxes at the bottom.'),

                    Toggle::make('is_active')
                        ->label('Visible on Website')
                        ->default(true),
                ])
        ]);
    }
}