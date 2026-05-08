<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'patient_id', 'therapist_id', 'intake_form_id',
        'total_score', 'condition_level',
        'recommended_specialization', 'notes',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function therapist()
    {
        return $this->belongsTo(Therapist::class, 'therapist_id');
    }

    public function intakeForm()
    {
        return $this->belongsTo(IntakeForm::class, 'intake_form_id');
    }
}
