<?php

namespace App\Filament\Resources\Brokerages;

use App\Filament\Resources\Brokerages\Pages\CreateBrokerage;
use App\Filament\Resources\Brokerages\Pages\EditBrokerage;
use App\Filament\Resources\Brokerages\Pages\ListBrokerages;
use App\Models\Brokerage;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class BrokerageResource extends Resource
{
    protected static ?string $model = Brokerage::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-building-office-2';

    protected static string | \UnitEnum | null $navigationGroup = 'Content Management';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                // 1. SELECT CATEGORY (Land or Flat)
                \Filament\Forms\Components\Select::make('category')
                    ->options([
                        'Land' => 'Land / Plot',
                        'Flat' => 'Flat / Apartment',
                    ])
                    ->default('Land')
                    ->live()
                    ->required(),

                // 2. COMMON FIELDS
                \Filament\Forms\Components\TextInput::make('title')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, \Filament\Schemas\Components\Utilities\Set $set) => $set('slug', Str::slug($state))),

                \Filament\Forms\Components\TextInput::make('slug')
                    ->required()
                    ->unique(Brokerage::class, 'slug', ignoreRecord: true),

                // 3. DYNAMIC LOCATION FIELD
                \Filament\Forms\Components\TextInput::make('location')
                    ->label('Location / Area')
                    ->placeholder('e.g. Bashundhara R/A, Dhaka')
                    ->required()
                    ->helperText('This will replace the hardcoded location on the website.'),

                // NEW: GOOGLE MAP FIELD
                \Filament\Forms\Components\Textarea::make('map_link')
                    ->label('Google Maps Embed Link')
                    ->placeholder('Paste the <iframe> code here')
                    ->helperText('Go to Google Maps -> Share -> Embed a map -> Copy HTML')
                    ->columnSpanFull(),

                // 4. LAND SPECIFIC FIELDS
                \Filament\Forms\Components\TextInput::make('block_name')
                    ->label('Block Name')
                    ->visible(fn ($get) => $get('category') === 'Land'),

                \Filament\Forms\Components\TextInput::make('plot_size')
                    ->label('Plot Size')
                    ->visible(fn ($get) => $get('category') === 'Land'),

                \Filament\Forms\Components\TextInput::make('plot_serial')
                    ->label('Plot Serial')
                    ->visible(fn ($get) => $get('category') === 'Land'),

                \Filament\Forms\Components\TextInput::make('facing')
                    ->label('Facing (e.g. South)')
                    ->visible(fn ($get) => $get('category') === 'Land'),

                // 5. FLAT SPECIFIC FIELDS
                \Filament\Forms\Components\TextInput::make('area_sqft')
                    ->label('Area (SFT)')
                    ->visible(fn ($get) => $get('category') === 'Flat'),

                \Filament\Forms\Components\TextInput::make('bedrooms')
                    ->label('Number of Bedrooms')
                    ->visible(fn ($get) => $get('category') === 'Flat'),

                \Filament\Forms\Components\TextInput::make('bathrooms')
                    ->label('Number of Bathrooms')
                    ->visible(fn ($get) => $get('category') === 'Flat'),

                \Filament\Forms\Components\TextInput::make('balcony')
                    ->label('Number of Balconies')
                    ->visible(fn ($get) => $get('category') === 'Flat'),

                \Filament\Forms\Components\TextInput::make('floor_no')
                    ->label('Floor Level')
                    ->visible(fn ($get) => $get('category') === 'Flat'),

                \Filament\Forms\Components\CheckboxList::make('amenities')
                    ->options([
                        'Lift' => 'Lift',
                        'LPG' => 'LPG',
                        'Parking' => 'Parking',
                        'Generator' => 'Generator',
                        'Security' => '24/7 Security',
                    ])
                    ->columns(3)
                    ->visible(fn ($get) => $get('category') === 'Flat'),

                // 6. PRICING & MEDIA
                \Filament\Forms\Components\TextInput::make('price')
                    ->label('Asking Price (BDT)')
                    ->placeholder('e.g. 9,500,000')
                    ->required(),

                // MODIFIED: AUTO-GENERATED PROPERTY ID
                \Filament\Forms\Components\TextInput::make('property_id')
                    ->label('Property ID')
                    ->placeholder('Generated automatically on save')
                    ->disabled()
                    ->dehydrated(false)
                    ->visibleOn('edit'),

                \Filament\Forms\Components\Select::make('status')
                    ->options([
                        'For Sale' => 'For Sale',
                        'Sold' => 'Sold',
                        'New Listing' => 'New Listing',
                        'Hot Offer' => 'Hot Offer',
                    ])->default('For Sale'),

                \Filament\Forms\Components\FileUpload::make('images')
                    ->multiple()
                    ->image()
                    ->directory('brokerage-listings')
                    ->columnSpanFull(),

                \Filament\Forms\Components\RichEditor::make('content')
                    ->label('Description')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('category')->badge(),
                \Filament\Tables\Columns\TextColumn::make('title')->searchable(),
                \Filament\Tables\Columns\TextColumn::make('location')->searchable(),
                \Filament\Tables\Columns\TextColumn::make('price')->label('Price'),
                \Filament\Tables\Columns\TextColumn::make('status')->badge(),
            ])
            ->actions([
                // Actions
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBrokerages::route('/'),
            'create' => CreateBrokerage::route('/create'),
            'edit' => EditBrokerage::route('/{record}/edit'),
        ];
    }
}