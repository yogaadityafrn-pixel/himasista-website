<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ManagementResource\Pages;
use App\Models\Management;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Get;
use Illuminate\Support\Collection;

class ManagementResource extends Resource
{
    protected static ?string $model = Management::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Manajemen Organisasi';
    protected static ?string $navigationLabel = 'Pengurus'; 
    protected static ?string $modelLabel = 'Pengurus'; 
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Select::make('period_id')
                            ->label('Periode Kepengurusan')
                            ->relationship('period', 'name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->live(), // Ini untuk divisi reaktif

                        Forms\Components\TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('position')
                            ->label('Jabatan')
                            ->required()
                            ->maxLength(255),
                        
                        // Dropdown Divisi Reaktif
                        Forms\Components\Select::make('division')
                            ->label('Divisi')
                            ->required()
                            ->options(function (Get $get): Collection {
                                $period = \App\Models\Period::find($get('period_id'));
                                if (! $period || ! $period->divisions) {
                                    return collect();
                                }
                                return collect($period->divisions)->combine($period->divisions);
                            })
                            ->disabled(fn (Get $get): bool => ! $get('period_id'))
                            ->placeholder(fn (Get $get): string => $get('period_id') ? 'Pilih Divisi' : 'Pilih Periode terlebih dahulu'),
                        
                        // vvv TAMBAHKAN 2 FIELD BARU INI vvv
                        Forms\Components\TextInput::make('instagram_url')
                            ->label('URL Instagram')
                            ->prefixIcon('heroicon-o-at-symbol')
                            ->placeholder('https://instagram.com/username')
                            ->url() // Validasi URL
                            ->maxLength(255)
                            ->columnSpan(1),

                        Forms\Components\TextInput::make('linkedin_url')
                            ->label('URL LinkedIn')
                            ->prefixIcon('heroicon-o-link')
                            ->placeholder('https://linkedin.com/in/username')
                            ->url() // Validasi URL
                            ->maxLength(255)
                            ->columnSpan(1),

                        Forms\Components\FileUpload::make('photo')
                            ->image()
                            ->directory('management-photos')
                            ->helperText('Rekomendasi: Foto portrait (vertikal) agar pas di kartu.')
                            ->nullable()
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        // ... (Tidak ada perubahan di method table())
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo')->circular(),
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('position')->searchable(),
                Tables\Columns\TextColumn::make('division')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('period.name')->searchable()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('period_id')
                    ->label('Filter Berdasarkan Periode')
                    ->relationship('period', 'name')
                    ->preload(),
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
            'index' => Pages\ListManagement::route('/'),
            'create' => Pages\CreateManagement::route('/create'),
            'edit' => Pages\EditManagement::route('/{record}/edit'),
        ];
    }    
}