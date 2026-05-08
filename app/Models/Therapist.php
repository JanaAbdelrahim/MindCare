<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Therapist extends Authenticatable
{
    protected $table = 'therapists';

    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
        'specialization', 'language', 'rating', 'is_available',
        'wallet', 'session_fee', 'total_patients', 'total_sessions'
    ];

    protected $hidden = ['password'];

    public function sessions()
    {
        return $this->hasMany(PatientSession::class, 'therapist_id');
    }

    public function availabilitySlots()
    {
        return $this->hasMany(AvailabilitySlot::class, 'therapist_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'therapist_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'therapist_id');
    }

    public function patients()
    {
        return $this->hasMany(Patient::class, 'therapist_id');
    }
}
