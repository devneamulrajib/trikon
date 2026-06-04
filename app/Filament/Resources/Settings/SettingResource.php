<?php

namespace App\Filament\Resources\Settings;

use App\Filament\Resources\Settings\Pages;
use App\Models\Setting;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-cog-6-tooth';

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
                        ->disk('public')
                        ->directory('site-settings')
                        ->visibility('public')
                        ->helperText('Upload a high-quality transparent PNG logo.'),

                    TextInput::make('welcome_video_url')
                        ->label('Welcome Section Video URL')
                        ->placeholder('https://www.youtube.com/watch?v=...')
                        ->helperText('Paste the full YouTube link here.'),

                    FileUpload::make('meeting_section_image')
                        ->label('Schedule a Meeting — Section Image')
                        ->image()
                        ->disk('public')
                        ->directory('site-settings')
                        ->visibility('public')
                        ->helperText('Left side image in the Schedule a Meeting section.'),
                ]),

            Section::make('Featured Showcase Section')
                ->description('Appears between Services and Testimonials. Each slide = background image + auto-playing corner video.')
                ->schema([
                    Repeater::make('featured_showcase')
                        ->label('Showcase Slides')
                        ->schema([
                            TextInput::make('title')
                                ->label('Project Title')
                                ->required()
                                ->placeholder('e.g. Trikon Tower — Bashundhara'),

                            TextInput::make('subtitle')
                                ->label('Subtitle / Tagline')
                                ->placeholder('e.g. Luxury Living Redefined'),

                            TextInput::make('location')
                                ->label('Location')
                                ->placeholder('e.g. Bashundhara R/A, Dhaka'),

                            TextInput::make('badge')
                                ->label('Badge Text')
                                ->placeholder('e.g. ONGOING • RESIDENTIAL'),

                            FileUpload::make('bg_image')
                                ->label('Background Image')
                                ->image()
                                ->disk('public')
                                ->directory('showcase')
                                ->visibility('public')
                                ->helperText('Main full-width background image for this slide.'),

                            FileUpload::make('video_url')
                                ->label('Corner Video (MP4 / WebM)')
                                ->disk('public')
                                ->directory('showcase-videos')
                                ->visibility('public')
                                ->acceptedFileTypes(['video/mp4', 'video/webm', 'video/ogg'])
                                ->maxSize(102400)
                                ->helperText('Upload an MP4/WebM video. It will auto-play muted in the bottom-right corner of this slide.'),

                            TextInput::make('project_link')
                                ->label('Project Page Link')
                                ->placeholder('e.g. /project/trikon-tower'),
                        ])
                        ->itemLabel(fn (array $state): ?string => $state['title'] ?? 'New Slide')
                        ->addActionLabel('+ Add Showcase Slide')
                        ->collapsible()
                        ->reorderable()
                        ->columnSpanFull(),
                ]),

            Section::make('Contact Details')
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
                        ->placeholder('e.g. trikonholdings'),
                ]),

            Section::make('Legal Pages & Policies')
                ->schema([
                    RichEditor::make('terms_content')
                        ->label('Terms & Conditions Content')
                        ->columnSpanFull(),

                    RichEditor::make('privacy_content')
                        ->label('Privacy Policy Content')
                        ->columnSpanFull(),
                ]),
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
            'index'  => Pages\ListSettings::route('/'),
            'create' => Pages\CreateSetting::route('/create'),
            'edit'   => Pages\EditSetting::route('/{record}/edit'),
        ];
    }
}