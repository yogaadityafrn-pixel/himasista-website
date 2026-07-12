<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Period extends Model
{
    use HasFactory;

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
        'divisions' => 'array', 
    ];

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'is_active',
        'divisions', 
    ];

    /**
     * Relasi: Satu periode 'memiliki banyak' pengurus
     */
    public function managements(): HasMany
    {
        return $this->hasMany(Management::class);
    }

    /**
     * Relasi: Satu periode 'memiliki banyak' proker
     */
    public function programs(): HasMany // <-- TAMBAHKAN FUNGSI INI
    {
        return $this->hasMany(Program::class);
    }
}