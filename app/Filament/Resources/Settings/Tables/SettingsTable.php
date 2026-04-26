<?php

namespace App\Filament\Resources\Settings\Tables;

use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('site_name')
                    ->label('Company Name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('hero_title')
                    ->label('Hero Heading')
                    ->searchable()
                    ->limit(30),

                TextColumn::make('hero_subtitle')
                    ->label('Hero Subtitle')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                ImageColumn::make('hero_image')
                    ->label('Hero Preview')
                    ->disk('public') // Ensures it looks in the storage/public folder
                    ->circular(),

                TextColumn::make('contact_email')
                    ->label('Email')
                    ->searchable(),

                TextColumn::make('contact_phone')
                    ->label('Phone')
                    ->searchable(),

                TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}