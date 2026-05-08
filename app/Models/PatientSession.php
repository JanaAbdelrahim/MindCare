<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientSession extends Model
{
    protected $table = 'patient_sessions';

    protected $fillable = [
        'therapist_id', 'patient_id', 'session_time',
        'notes', 'status', 'rating'
    ];

    public function therapist()
    {
        return $this->belongsTo(Therapist::class, 'therapist_id');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'session_id');
    }

    public function availabilitySlot()
    {
        return $this->hasOne(AvailabilitySlot::class, 'session_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'session_id');
    }
}
