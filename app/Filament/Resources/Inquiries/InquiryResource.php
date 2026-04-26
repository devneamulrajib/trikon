<?php

namespace App\Filament\Resources\Inquiries;

use App\Filament\Resources\Inquiries\Pages;
use App\Models\Inquiry;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

// Correct Imports for your version
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;

// ✅ UPDATED ACTION NAMESPACES - ALL MOVED TO Filament\Actions
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class InquiryResource extends Resource
{
    protected static ?string $model = Inquiry::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-envelope';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Inquiry Details')
                ->schema([
                    TextInput::make('name')->disabled(),
                    TextInput::make('phone')->disabled(),
                    TextInput::make('email')->disabled(),
                    Textarea::make('message')
                        ->disabled()
                        ->rows(10)
                        ->columnSpanFull(),
                ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('phone')->copyable(),
                TextColumn::make('email')->copyable(),
                TextColumn::make('message')->limit(50)->wrap(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Received At')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                ViewAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                // ✅ Using the updated namespace classes
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInquiries::route('/'),
        ];
    }
}