<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WellnessRecord extends Model
{
    protected $fillable = [
        'patient_id', 'mood_score', 'sleep_quality', 'journal_entry', 'visibility'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
}
