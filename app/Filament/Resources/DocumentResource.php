<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DocumentResource\Pages;
use App\Models\Document;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage; 
use Illuminate\Support\Facades\Auth;

class DocumentResource extends Resource
{
    protected static ?string $model = Document::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder-open';
    protected static ?string $navigationGroup = 'Administrasi Sistem'; 
    protected static ?string $navigationLabel = 'Arsip Dokumen'; 
    protected static ?string $modelLabel = 'Dokumen'; 
    protected static ?int $navigationSort = 1;

    public static function canAccess(): bool
    {
        return Auth::user()->hasRole(['Super Admin', 'Admin']);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Judul Dokumen')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Forms\Components\Select::make('category')
                            ->label('Kategori')
                            ->options([
                                'ADART' => 'AD/ART',
                                'LPJ' => 'LPJ (Laporan Pertanggungjawaban)',
                                'Template Proposal' => 'Template Proposal',
                                'Template Surat' => 'Template Surat',
                                'Lainnya' => 'Lainnya',
                            ])
                            ->required(),

                        Forms\Components\FileUpload::make('file_path')
                            ->label('File Dokumen')
                            ->directory('arsip-dokumen')
                            ->preserveFilenames() 
                            ->acceptedFileTypes([ 
                                'application/pdf',
                                'application/msword',
                                'application/vnd.openxmlformats-officedocument.wordprocessingml.document', // .docx
                                'application/vnd.ms-excel',
                                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', // .xlsx
                            ])
                            ->required(),

                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi (Catatan)')
                            ->nullable()
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul Dokumen')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('category')
                    ->badge()
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Di-upload oleh')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Upload')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->options([
                        'ADART' => 'AD/ART',
                        'LPJ' => 'LPJ',
                        'Template Proposal' => 'Template Proposal',
                        'Template Surat' => 'Template Surat',
                        'Lainnya' => 'Lainnya',
                    ]),
            ])
            ->actions([
                // vvv INI TOMBOL BARU KITA vvv
                Tables\Actions\Action::make('download')
                    ->label('Download')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('info')
                    // Buka URL file di tab baru
                    ->url(fn (Document $record): string => Storage::url($record->file_path), shouldOpenInNewTab: true),
                // ^^^ SAMPAI SINI ^^^

                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListDocuments::route('/'),
            'create' => Pages\CreateDocument::route('/create'),
            'edit' => Pages\EditDocument::route('/{record}/edit'),
        ];
    }    
}