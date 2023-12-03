<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $fillable = ['survey_name', 'end_date'];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function userSurveyStatus()
    {
        return $this->hasMany(UserSurveyStatus::class);
    }
}
