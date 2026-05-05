<?php

namespace App\Filament\Resources;

use App\Models\User;
use Filament\Resources\Resource;
use Filament\Forms\Schema; 
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Section;
use Filament\Forms\Get;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Support\Facades\Auth;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-users';

    protected static string | \UnitEnum | null $navigationGroup = 'Settings';

    /**
     * This controls who can see the "Users" menu in the sidebar.
     */
    public static function shouldRegisterNavigation(): bool
    {
        // SAFETY NET: If the user is an admin, OR if their email matches yours, show the menu.
        // Replace 'your-email@example.com' with your actual email address.
        $user = Auth::user();
        return $user->role === 'admin' || $user->email === 'your-email@example.com'; 
    }

    public static function form(\Filament\Forms\Form $form): \Filament\Forms\Form
    {
        return $form->schema([
            Section::make('User Account Details')
                ->description('Manage basic account information and system roles.')
                ->schema([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),

                    TextInput::make('email')
                        ->email()
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->maxLength(255),

                    Select::make('role')
                        ->label('System Role')
                        ->options([
                            'admin' => 'Super Admin (Full Access)',
                            'editor' => 'Editor (Limited Access)',
                        ])
                        ->required()
                        ->native(false)
                        ->live(), // This allows the Permissions section to show/hide instantly

                    TextInput::make('password')
                        ->password()
                        ->dehydrated(fn ($state) => filled($state)) 
                        ->required(fn (string $context): bool => $context === 'create') 
                        ->maxLength(255),
                ])->columns(2),

            Section::make('Page Permissions')
                ->description('Select exactly which pages this Editor is allowed to view and manage.')
                // This section ONLY shows up if the role is set to "Editor"
                ->visible(fn (Get $get) => $get('role') === 'editor')
                ->schema([
                    CheckboxList::make('permissions')
                        ->label('Allow Access To:')
                        ->options([
                            'projects' => 'Projects Management',
                            'brokerage' => 'Brokerage Market',
                            'sliders' => 'Homepage Sliders',
                            'services' => 'Our Services',
                            'team' => 'Management & Board',
                            'csr' => 'CSR Initiatives',
                            'blog' => 'Blog & News',
                            'settings' => 'General Site Settings',
                        ])
                        ->columns(2)
                        ->gridDirection('vertical')
                        ->bulkToggleable(),
                ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('role')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'admin' => 'danger',
                        'editor' => 'info',
                        default => 'gray',
                    }),
                TextColumn::make('created_at')
                    ->label('Registered')
                    ->dateTime()
                    ->sortable(),
            ])
            ->actions([
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}