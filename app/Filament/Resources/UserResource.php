<?php

namespace App\Filament\Resources;

use App\Models\User;
use Filament\Resources\Resource;
use Filament\Schemas\Schema; 
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Section;
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
     * Controls visibility of the "Users" menu in the sidebar.
     */
    public static function shouldRegisterNavigation(): bool
    {
        $user = Auth::user();
        // Replace 'your-email@example.com' with your actual login email to ensure you never lose access
        return $user->role === 'admin' || $user->email === 'your-email@example.com';
    }

    /**
     * Using Schema type hint to match your project configuration
     */
    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('User Account Details')
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
                        ->options([
                            'admin' => 'Super Admin (Full Access)',
                            'editor' => 'Editor (Limited Access)',
                        ])
                        ->required()
                        ->native(false)
                        ->live(),

                    TextInput::make('password')
                        ->password()
                        ->dehydrated(fn ($state) => filled($state)) 
                        ->required(fn (string $context): bool => $context === 'create') 
                        ->maxLength(255),
                ])->columns(2),

            Section::make('Page Permissions')
                ->description('Select which pages this Editor is allowed to manage.')
                // Logic: Only show this section if the role is 'editor'
                ->hidden(fn (callable $get) => $get('role') === 'admin')
                ->schema([
                    CheckboxList::make('permissions')
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
                        ->gridDirection('vertical'),
                ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('email')->searchable()->sortable(),
                TextColumn::make('role')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'admin' => 'danger',
                        'editor' => 'info',
                        default => 'gray',
                    }),
                TextColumn::make('created_at')->label('Registered')->dateTime()->sortable(),
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