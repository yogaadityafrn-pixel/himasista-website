<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PeriodResource\Pages;
use App\Models\Period;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class PeriodResource extends Resource
{
    protected static ?string $model = Period::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationGroup = 'Manajemen Organisasi'; 
    protected static ?string $navigationLabel = 'Periode Kepengurusan'; 
    protected static ?string $modelLabel = 'Periode'; 
    protected static ?int $navigationSort = 1;

    public static function canAccess(): bool
    {
        return Auth::user()->hasRole(['Super Admin', 'Admin']);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name') 
                    ->label('Nama Periode (Contoh: Kabinet Sinergi 2024/2025)')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),

                Forms\Components\DatePicker::make('start_date') 
                    ->label('Tanggal Mulai')
                    ->required(),

                Forms\Components\DatePicker::make('end_date') 
                    ->label('Tanggal Selesai')
                    ->required(),

                Forms\Components\Toggle::make('is_active') 
                    ->label('Periode Aktif Saat Ini?')
                    ->required(),
                
                Forms\Components\TagsInput::make('divisions')
                ->label('Daftar Divisi untuk Periode Ini')
                ->placeholder('Ketik nama divisi lalu tekan Enter')
                ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name') 
                    ->label('Nama Periode')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('start_date') 
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('end_date') 
                    ->date()
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_active') 
                    ->label('Aktif?')
                    ->boolean(),

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
            'index' => Pages\ListPeriods::route('/'),
            'create' => Pages\CreatePeriod::route('/create'),
            'edit' => Pages\EditPeriod::route('/{record}/edit'),
        ];
    }    
}