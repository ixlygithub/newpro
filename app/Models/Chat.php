<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    protected $fillable = [
        'from_user', 'to_user','msg','status','read_by','from_role','chatdate_time'
    ];
}
