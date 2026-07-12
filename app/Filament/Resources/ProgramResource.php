<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProgramResource\Pages;
use App\Models\Program;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Get;
use Illuminate\Support\Collection;

class ProgramResource extends Resource
{
    protected static ?string $model = Program::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationGroup = 'Manajemen Organisasi';
    protected static ?string $navigationLabel = 'Program Kerja'; 
    protected static ?string $modelLabel = 'Program Kerja'; 
    protected static ?int $navigationSort = 3;

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
                            ->live(), 
                        
                        Forms\Components\Select::make('division')
                            ->label('Divisi Pelaksana')
                            ->required()
                            ->searchable()
                            ->options(function (Get $get): Collection {
                                $period = \App\Models\Period::find($get('period_id'));
                                
                                if (! $period || ! $period->divisions) {
                                    return collect(); 
                                }

                                return collect($period->divisions)->combine($period->divisions);
                            })
                            ->disabled(fn (Get $get): bool => ! $get('period_id'))
                            ->placeholder(fn (Get $get): string => $get('period_id') 
                                            ? 'Pilih Divisi' 
                                            : 'Pilih Periode terlebih dahulu'),

                        Forms\Components\TextInput::make('name')
                            ->label('Nama Program Kerja')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi Singkat')
                            ->nullable()
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Proker')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('division')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('period.name')
                    ->label('Periode')
                    ->searchable()
                    ->sortable(),
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
            'index' => Pages\ListPrograms::route('/'),
            'create' => Pages\CreateProgram::route('/create'),
            'edit' => Pages\EditProgram::route('/{record}/edit'),
        ];
    }    
}