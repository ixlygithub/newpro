<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionCategory_old extends Model
{
    //
    use SoftDeletes;
    protected $table= "questions_categoris";
    protected $fillable= ['id', 'question_category', 'status'];
    public $timestamps= false;

}
