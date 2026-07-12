<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth; 

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox';
    protected static ?string $navigationGroup = 'Administrasi Sistem';
    protected static ?string $navigationLabel = 'Pesan Masuk'; 
    protected static ?string $modelLabel = 'Pesan Masuk'; 
    protected static ?int $navigationSort = 2;

    // KUNCI KEAMANAN
    public static function canAccess(): bool
    {
        return Auth::user()->hasRole(['Super Admin', 'Admin']);
    }

    // FUNGSI UNTUK MEMBUAT SEMUA FORM READ-ONLY
    public static function canCreate(): bool
    {
        return false; // Sembunyikan tombol "New contact"
    }

    public static function canEdit(Model $record): bool
    {
        return false; // Sembunyikan tombol "Edit" di tabel
    }

    // FORM INI HANYA UNTUK MELIHAT (VIEW)
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->disabled(),
                Forms\Components\TextInput::make('email')
                    ->disabled(),
                Forms\Components\TextInput::make('subject')
                    ->disabled()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('message')
                    ->disabled()
                    ->columnSpanFull(),
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

                Tables\Columns\TextColumn::make('subject')
                    ->searchable(),

                // BADGE UNTUK STATUS "SUDAH DIBACA"
                Tables\Columns\IconColumn::make('is_read')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-envelope')
                    ->trueColor('success')
                    ->falseColor('warning'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Diterima Pada')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(), // Tombol untuk melihat (pakai form() di atas)

                // AKSI KUSTOM UNTUK "TANDAI SUDAH BACA"
                Tables\Actions\Action::make('markAsRead')
                    ->label('Tandai Dibaca')
                    ->icon('heroicon-o-check-circle')
                    ->action(fn (Contact $record) => $record->update(['is_read' => true]))
                    // Hanya tampilkan jika 'is_read' masih false
                    ->visible(fn (Contact $record): bool => !$record->is_read),

                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc'); // Tampilkan pesan terbaru di atas
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
            'index' => Pages\ListContacts::route('/'),
            // Kita tidak butuh halaman create dan edit
            // 'create' => Pages\CreateContact::route('/create'),
            // 'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }    
}