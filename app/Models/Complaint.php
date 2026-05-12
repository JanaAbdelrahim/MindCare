<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{

    protected $fillable = ['patient_id', 'category', 'description', 'status'];
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
}
