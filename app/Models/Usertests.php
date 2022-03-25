<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usertests extends Model
{
    use HasFactory;
    protected $fillable = [
        'test_id','user_id','tags','time_taken','test_result','questionsid','weightagevalue','user_option','ploat_points'
    ];
}
