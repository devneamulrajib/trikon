<?php

namespace App\Filament\Resources\Settings\Schemas;

use Filament\Schemas\Schema; // <--- Changed from Form to Schema
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;

class SettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([ // Note: Schemas often use 'components' instead of 'schema'
                Section::make('Website Branding')
                    ->schema([
                        TextInput::make('site_name')
                            ->default('Trikon')
                            ->required(),
                        TextInput::make('hero_title')
                            ->required(),
                        TextInput::make('hero_subtitle'),
                        FileUpload::make('hero_image')
                            ->image()
                            ->directory('site-assets'),
                    ])->columns(2),

                Section::make('Contact & Footer')
                    ->schema([
                        TextInput::make('contact_email')->email(),
                        TextInput::make('contact_phone'),
                        Textarea::make('address')->rows(3),
                    ])->columns(2),
            ]);
    }
}