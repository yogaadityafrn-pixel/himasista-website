<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\Post; // Import Post

class RecentPostsWidget extends BaseWidget
{
    protected static ?int $sort = 2; // Tampilkan di bawah statistik
    protected int | string | array $columnSpan = 'full'; // Penuhi lebar

    public function table(Table $table): Table
    {
        return $table
            ->query(
                // Ambil 5 berita terbaru
                Post::query()->latest('published_at')->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul Berita'),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Penulis'),
                Tables\Columns\TextColumn::make('published_at')
                    ->label('Dipublikasi Pada')
                    ->dateTime()
                    ->sortable(),
            ])
            ->actions([
                // Tambahkan tombol 'Edit' cepat
                Tables\Actions\EditAction::make()
                    ->url(fn (Post $record): string => \App\Filament\Resources\PostResource::getUrl('edit', ['record' => $record])),
            ]);
    }
}