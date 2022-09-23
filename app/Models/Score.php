<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;
    protected $fillable = ['uuid', 'judge_id', 'contest_id', 'criteria_id', 'contestant_id', 'score'];
}
