<?php

namespace App\Filament\Resources\Projects;

use App\Filament\Resources\Projects\Pages;
use App\Models\Project;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use BackedEnum;

// ✅ CORRECT FOR YOUR FILAMENT SETUP
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Repeater;

// TABLE
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

// ACTIONS
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkActionGroup;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-building-office-2';

    public static function form(Schema $form): Schema
    {
        return $form->schema([

            Section::make('Basic Information')
                ->schema([
                    TextInput::make('name')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn ($state, $set) => $set('slug', Str::slug($state))),

                    TextInput::make('slug')
                        ->required(),

                    Select::make('category')
                        ->options([
                            'Ongoing' => 'Ongoing',
                            'Upcoming' => 'Upcoming',
                            'Completed' => 'Completed',
                        ])
                        ->required(),

                    TextInput::make('progress')
                        ->numeric()
                        ->default(0)
                        ->required() // Prevents the "Column progress cannot be null" error
                        ->suffix('%'),
                ])
                ->columns(2),

            Section::make('Project Media (Layout Images)')
                ->description('Upload specific images for different sections of the project page.')
                ->schema([
                    FileUpload::make('image')
                        ->label('Cover Photo (Hero Section)') 
                        ->image()
                        ->directory('projects/covers')
                        ->required(),

                    FileUpload::make('featured_image')
                        ->label('At a Glance Photo')
                        ->image()
                        ->directory('projects/featured'),

                    FileUpload::make('amenities_image')
                        ->label('Features & Amenities Photo') 
                        ->image()
                        ->directory('projects/amenities'),

                    FileUpload::make('floorplan_image')
                        ->label('Floor Plan Photo (Optional)')
                        ->image()
                        ->directory('projects/floorplans'),

                    FileUpload::make('cover_photo')
                        ->label('Secondary Cover Photo (Optional)')
                        ->image()
                        ->directory('projects/extra'),

                    FileUpload::make('brochure_pdf')
                        ->label('Brochure (PDF)')
                        ->acceptedFileTypes(['application/pdf'])
                        ->directory('brochures'),
                ])
                ->columns(2),

            Section::make('Gallery & Experience (Slideshow)')
                ->description('These images will appear in the wide slideshow in the Experience section.')
                ->schema([
                    FileUpload::make('gallery')
                        ->label('Experience Slideshow Images')
                        ->multiple()
                        ->reorderable()
                        ->image()
                        ->directory('project-galleries')
                        ->columnSpanFull(),
                ]),

            Section::make('At a Glance Details')
                ->schema([
                    TextInput::make('location'),
                    TextInput::make('address'),
                    TextInput::make('land_area'),
                    TextInput::make('floors'),
                    TextInput::make('size')->label('Apartment Size'),
                    TextInput::make('beds_baths')->label('Bed / Bath'),
                    TextInput::make('launch_date'),
                    TextInput::make('collection')->default('LUXURY'),
                    TextInput::make('map_link')->label('Google Maps iframe src'),
                ])
                ->columns(2),

            Section::make('Description & Features')
                ->schema([
                    RichEditor::make('features')
                        ->label('Features & Amenities Description')
                        ->columnSpanFull(),
                ]),

            Section::make('Construction Progress')
                ->schema([
                    Repeater::make('construction_updates')
                        ->schema([
                            TextInput::make('task')->required(),
                            TextInput::make('progress')
                                ->numeric()
                                ->default(100)
                                ->suffix('%'),
                            TextInput::make('remarks'),
                        ])
                        ->columns(3)
                        ->reorderable()
                        ->columnSpanFull(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Cover')
                    ->disk('public'),
                
                TextColumn::make('name')
                    ->searchable(),
                
                TextColumn::make('category')
                    ->badge(),
                
                TextColumn::make('progress')
                    ->formatStateUsing(fn ($state) => ($state ?? 0) . '%') // Handles null safely in table
                    ->sortable(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}