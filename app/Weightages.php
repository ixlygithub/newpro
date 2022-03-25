<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Weightages extends Model
{
    use Notifiable;
   
      protected $table = 'weightages';
    protected $fillable = [
        'weightage_title', 'rating'
    ];
}
