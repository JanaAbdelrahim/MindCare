<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'therapist_id', 'session_id', 'patient_id',
        'user_type', 'message', 'is_read'
    ];

    public function therapist()
    {
        return $this->belongsTo(Therapist::class, 'therapist_id');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function session()
    {
        return $this->belongsTo(PatientSession::class, 'session_id');
    }
}
