<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'period_id',
        'name',
        'division',
        'description',
    ];

    /**
     * Relasi: Satu proker 'milik' satu periode
     */
    public function period(): BelongsTo
    {
        return $this->belongsTo(Period::class);
    }
}