<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Management extends Model
{
    use HasFactory;
    
    // Solusi "hantu cache" dari sebelumnya
    protected $table = 'managements';

    protected $fillable = [
        'period_id',
        'name',
        'position',
        'division',
        'photo',
        'instagram_url', 
        'linkedin_url',  
    ];

    /**
     * Relasi: Satu pengurus 'milik' satu periode
     */
    public function period(): BelongsTo
    {
        return $this->belongsTo(Period::class);
    }
}