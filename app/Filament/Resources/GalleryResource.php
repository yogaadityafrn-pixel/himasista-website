<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryResource\Pages;
use App\Models\Gallery;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class GalleryResource extends Resource
{
    protected static ?string $model = Gallery::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'Konten Publik';
    protected static ?string $navigationLabel = 'Galeri'; 
    protected static ?string $modelLabel = 'Galeri Foto'; 
    protected static ?int $navigationSort = 3; 

    public static function canAccess(): bool
    {
        return Auth::user()->hasRole(['Super Admin', 'Admin']);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('image_path')
                ->label('Foto')
                ->image()
                ->directory('gallery-images')
                ->imageResizeMode('cover')
                ->imageResizeTargetWidth('1600')
                ->imageResizeTargetHeight('1600')
                ->imageEditor()
                ->required()
                ->helperText('Rekomendasi: Unggah foto dengan orientasi potret (vertikal) untuk hasil terbaik di layout galeri. Foto akan otomatis dikompres/diresize saat upload.')
                ->columnSpanFull(),

                Forms\Components\TextInput::make('caption')
                    ->label('Caption (Deskripsi Singkat)')
                    ->maxLength(255)
                    ->columnSpanFull(),

                Forms\Components\Select::make('category')
                    ->options([
                        'Event' => 'Event',
                        'Rapat' => 'Rapat',
                        'Kegiatan' => 'Kegiatan',
                        'Lainnya' => 'Lainnya',
                    ])
                    ->default('Event')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('Foto')
                    ->square(), 

                Tables\Columns\TextColumn::make('caption')
                    ->searchable(),

                Tables\Columns\TextColumn::make('category')
                    ->badge() 
                    ->searchable(),

                Tables\Columns\TextColumn::make('user.name') 
                    ->label('Uploaded by')
                    ->sortable(),

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
            'index' => Pages\ListGalleries::route('/'),
            'create' => Pages\CreateGallery::route('/create'),
            'edit' => Pages\EditGallery::route('/{record}/edit'),
        ];
    }
}