<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Judges extends Model
{
    use HasFactory;

    protected $fillable = ['uuid', 'judge_name', 'contest_id', 'position', 'order'];
}
