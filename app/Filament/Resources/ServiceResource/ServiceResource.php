<?php

namespace App\Filament\Resources\ServiceResource;

use App\Filament\Resources\ServiceResource\Pages;
use App\Models\Service;
use Filament\Resources\Resource;
use Filament\Forms;
use Filament\Schemas\Schema; // Required for your version
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;

// REVERTED: Using the Unified Actions namespace which works for your version
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

use Illuminate\Support\Str;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    // Strict type hint match
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    /**
     * form(Filament\Schemas\Schema $schema): Filament\Schemas\Schema
     */
    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            // Simplified Form: Only the 3 requested features + essentials
            TextInput::make('name')
                ->label('Service Name')
                ->required()
                ->live(onBlur: true)
                ->afterStateUpdated(fn ($set, $state) => $set('slug', Str::slug($state))),
            
            TextInput::make('slug')
                ->required()
                ->unique(ignoreRecord: true),
            
            FileUpload::make('hero_image')
                ->label('Cover Photo (Hero)')
                ->image()
                ->directory('services')
                ->required()
                ->columnSpanFull(),
            
            RichEditor::make('description')
                ->label('Short Description (Next to Video)')
                ->columnSpanFull(),
            
            TextInput::make('video_url')
                ->label('YouTube URL')
                ->placeholder('https://www.youtube.com/watch?v=...')
                ->columnSpanFull(),
            
            RichEditor::make('main_content')
                ->label('Main Body Details (Detailed Space)')
                ->columnSpanFull(),
        ]);
    }

    /**
     * table(Filament\Tables\Table $table): Filament\Tables\Table
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\ImageColumn::make('hero_image')->circular(),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Using unified actions as per your version's structure
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }
    
    public static function getPages(): array 
    {
        return [
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}