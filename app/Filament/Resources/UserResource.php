<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash; 

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Administrasi Sistem';
    protected static ?string $navigationLabel = 'Manajemen Pengguna'; 
    protected static ?string $modelLabel = 'Pengguna'; 
    protected static ?int $navigationSort = 4;

    public static function canAccess(): bool
    {
        return Auth::user()->hasRole('Super Admin');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            // Pastikan email unik, tapi abaikan user yang sedang diedit
                            ->unique(ignoreRecord: true), 

                        Forms\Components\TextInput::make('password')
                            ->password()
                            // Hash password saat disimpan
                            ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                            // Jangan tampilkan password saat 'edit'
                            ->dehydrated(fn ($state) => filled($state))
                            // Wajib diisi saat 'create', opsional saat 'edit'
                            ->required(fn (string $context): bool => $context === 'create')
                            ->maxLength(255),

                        // INI ADALAH DROPDOWN UNTUK ROLES
                        Forms\Components\Select::make('roles')
                            ->multiple()
                            ->relationship('roles', 'name') // (nama relasi, kolom yang tampil)
                            ->preload() // Langsung load semua roles
                            ->searchable(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),

                Tables\Columns\TextColumn::make('email')
                    ->searchable(),

                // Tampilkan roles sebagai badge
                Tables\Columns\TextColumn::make('roles.name')
                    ->badge()
                    ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(), // Super Admin boleh hapus user
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
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