<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class WellnessRecord extends Model
{
    protected $fillable = [
        'patient_id',
        'mood_score',
        'sleep_quality',
        'journal_entry',
        'visibility',
    ];

    protected $casts = [
        'mood_score'    => 'integer',
        'sleep_quality' => 'float',
    ];

    public const MOOD_LABELS = [
        1 => 'Very Sad',
        2 => 'Sad',
        3 => 'Okay',
        4 => 'Good',
        5 => 'Great',
    ];

    public function getMoodLabelAttribute(): ?string
    {
        return self::MOOD_LABELS[$this->mood_score] ?? null;
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function scopeJournals(Builder $query): Builder
    {
        return $query->whereNotNull('journal_entry');
    }

    public function scopeMoods(Builder $query): Builder
    {
        return $query->whereNotNull('mood_score');
    }

    public function scopeLastDays(Builder $query, int $days = 7): Builder
    {
        return $query->where('created_at', '>=', now()->subDays($days)->startOfDay());
    }
}
