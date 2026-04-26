<?php

namespace App\Filament\Resources\Projects;

use App\Filament\Resources\Projects\Pages;
use App\Models\Project;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use BackedEnum;

// ✅ CORRECT FOR FILAMENT V4
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
                        ->suffix('%'),
                ])
                ->columns(2),

            Section::make('Project Media')
                ->schema([
                    FileUpload::make('featured_image')
                        ->image()
                        ->directory('projects/featured'),

                    FileUpload::make('image')
                        ->image()
                        ->directory('projects/thumbnails'),

                    FileUpload::make('gallery')
                        ->multiple()
                        ->image()
                        ->directory('project-galleries'),

                    FileUpload::make('brochure_pdf')
                        ->acceptedFileTypes(['application/pdf'])
                        ->directory('brochures'),
                ])
                ->columns(2),

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

            RichEditor::make('features')
                ->columnSpanFull(),

            Repeater::make('construction_updates')
                ->schema([
                    TextInput::make('task')->required(),
                    TextInput::make('progress')->numeric()->default(100)->suffix('%'),
                    TextInput::make('remarks'),
                ])
                ->columns(3)
                ->reorderable()
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')->disk('public'),
                TextColumn::make('name')->searchable(),
                TextColumn::make('category')->badge(),
                TextColumn::make('progress')->suffix('%'),
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