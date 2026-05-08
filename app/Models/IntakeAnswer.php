<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IntakeAnswer extends Model
{
    protected $fillable = ['patient_id', 'intake_question_id', 'intake_option_id', 'score'];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function question()
    {
        return $this->belongsTo(IntakeQuestion::class, 'intake_question_id');
    }

    public function option()
    {
        return $this->belongsTo(IntakeOption::class, 'intake_option_id');
    }
}
