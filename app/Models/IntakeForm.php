<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IntakeForm extends Model
{
    protected $fillable = [
        'patient_id', 'mood_score', 'stress_score', 'social_score',
        'anxiety_score', 'trauma_score', 'sleep_score', 'self_care_score',
        'overall_level', 'recommended_specialization'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class,'patient_id');
    }

    public function report()
    {
        return $this->hasOne(Report::class, 'intake_form_id');
    }
}
