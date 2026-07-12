<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth; 

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationGroup = 'Administrasi Sistem';
    protected static ?string $navigationLabel = 'Pengaturan Website'; 
    protected static ?string $modelLabel = 'Pengaturan'; 
    protected static ?int $navigationSort = 3;

    public static function canAccess(): bool
    {
        return Auth::user()->hasRole('Super Admin');
    }

    // SEMBUNYIKAN TOMBOL "CREATE"
    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('key')
                    ->disabled() // Key tidak boleh diganti
                    ->columnSpanFull(),

                // Gunakan RichEditor untuk Misi, Textarea biasa untuk Visi
                Forms\Components\Textarea::make('value')
                    ->label('Isi (Value)')
                    ->rows(8)
                    ->columnSpanFull()
                    // Tampilkan Textarea jika key='visi'
                    ->visible(fn ($record) => $record?->key === 'visi'),

                Forms\Components\RichEditor::make('value')
                    ->label('Isi (Value)')
                    ->columnSpanFull()
                    // Tampilkan RichEditor jika key='misi'
                    ->visible(fn ($record) => $record?->key === 'misi'),
                
                Forms\Components\TextInput::make('value')
                        ->label('Nomor WA Humas 1')
                        ->tel() // Tipe input telepon
                        ->prefix('+62') // Beri awalan +62
                        ->helperText('Masukkan nomor WA tanpa 0 di depan. Contoh: 81910833878')
                        ->columnSpanFull()
                        ->visible(fn ($record) => $record?->key === 'wa_humas_1'),

                Forms\Components\TextInput::make('value')
                    ->label('Nomor WA Humas 2')
                    ->tel()
                    ->prefix('+62')
                    ->helperText('Masukkan nomor WA tanpa 0 di depan. Contoh: 81910833878')
                    ->columnSpanFull()
                    ->visible(fn ($record) => $record?->key === 'wa_humas_2'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('key')
                    ->label('Setting')
                    ->searchable(),
                Tables\Columns\TextColumn::make('value')
                    ->label('Isi')
                    ->html() // Render HTML dari RichEditor
                    ->limit(50)
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(), // Hanya boleh edit
            ])
            ->bulkActions([
                // Tidak boleh bulk delete
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
            'index' => Pages\ListSettings::route('/'),
            // Hapus halaman 'create' dari route
            // 'create' => Pages\CreateSetting::route('/create'), 
            'edit' => Pages\EditSetting::route('/{record}/edit'),
        ];
    }    
}