<?php

namespace App\Filament\Resources\Settings;

use App\Filament\Resources\Settings\Pages;
use App\Models\Setting;
use Filament\Resources\Resource;
use Filament\Schemas\Schema; // This is the correct import for your version
use Filament\Tables\Table;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload; // Added for logo
use Filament\Forms\Components\RichEditor; // Added for Legal Content
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn; // Added for logo preview
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;
    
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-cog-6-tooth';

    /**
     * Updated to match the Schema signature your version requires
     */
    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('General Branding')
                ->schema([
                    TextInput::make('site_name')
                        ->label('Website Name')
                        ->required(),

                    FileUpload::make('logo')
                        ->label('Site Logo')
                        ->image()
                        ->directory('site-settings')
                        ->visibility('public')
                        ->helperText('Upload a high-quality transparent PNG logo.'),
                ]),

            Section::make('Contact Details (Editable)')
                ->schema([
                    TextInput::make('hotline')
                        ->label('Hotline Number')
                        ->placeholder('e.g. 16634'),
                        
                    TextInput::make('sales_phone')
                        ->label('Sales Number')
                        ->placeholder('e.g. +880 1700 000000'),
                        
                    TextInput::make('email')
                        ->label('Email Address')
                        ->email(),
                        
                    TextInput::make('address')
                        ->label('Office Address'),

                    TextInput::make('whatsapp_number')
                        ->label('WhatsApp Number')
                        ->placeholder('e.g. 8801700000000')
                        ->helperText('Include country code without + sign.'),

                    TextInput::make('messenger_id')
                        ->label('Messenger ID/Username')
                        ->placeholder('e.g. trikonholdings')
                        ->helperText('The unique ID or Username of your Facebook Page.'),
                ]),

            Section::make('Legal Pages & Policies')
                ->description('Edit the content for Terms & Conditions and Privacy Policy pages')
                ->schema([
                    RichEditor::make('terms_content')
                        ->label('Terms & Conditions Content')
                        ->columnSpanFull(),

                    RichEditor::make('privacy_content')
                        ->label('Privacy Policy Content')
                        ->columnSpanFull(),
                ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('logo')
                    ->label('Logo')
                    ->circular(),

                TextColumn::make('site_name'),
                
                TextColumn::make('hotline'),
                
                TextColumn::make('email'),
            ])
            ->actions([
                EditAction::make(),
                ViewAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSettings::route('/'),
            'create' => Pages\CreateSetting::route('/create'),
            'edit' => Pages\EditSetting::route('/{record}/edit'),
        ];
    }
}