<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Patient extends Authenticatable
{
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
        'age', 'condition_level', 'wallet', 'therapist_id',
        'total_sessions', 'date_of_birth', 'gender'
    ];

    protected $hidden = ['password'];

    public function therapist()
    {
        return $this->belongsTo(Therapist::class, 'therapist_id');
    }

    public function sessions()
    {
        return $this->hasMany(PatientSession::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function intakeAnswers()
    {
        return $this->hasMany(IntakeAnswer::class);
    }

    public function intakeForm()
    {
        return $this->hasOne(IntakeForm::class);
    }

    public function wellnessRecords()
    {
        return $this->hasMany(WellnessRecord::class);
    }

    public function goals()
    {
        return $this->hasMany(Goal::class);
    }

    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}
