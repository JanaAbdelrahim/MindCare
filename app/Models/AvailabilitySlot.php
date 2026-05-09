<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AvailabilitySlot extends Model
{
    protected $casts = [
    'start_time' => 'datetime',
    'end_time' => 'datetime',
    ];
    
    protected $fillable = [
        'therapist_id', 'start_time', 'end_time', 'status', 'session_id'
    ];

    public function therapist()
    {
        return $this->belongsTo(Therapist::class, 'therapist_id');
    }

    public function session()
    {
        return $this->belongsTo(PatientSession::class, 'session_id');
    }
}