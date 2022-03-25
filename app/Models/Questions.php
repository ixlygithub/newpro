<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    use HasFactory;
    protected $fillable = [
        'question', 'category','tags','weightage_type','question_type','optiontype','options','ans','notes','explanation','wrong_ans_audio'
    ];
}
