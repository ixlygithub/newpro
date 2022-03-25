<?php

namespace App\Http\Controllers;

class HTMLController extends Controller
{
   
    public function login_html()
    {
        return view('login_html');
    }
    public function question_html()
    {
        return view('question_html');
    }
    public function content_html()
    {
        return view('content_html');
    }
    public function account_final_html()
    {
        return view('account_final');
    }
    public function quiz_html()
    {
        return view('quiz_html');
    }
     public function exam_html()
    {
        return view('exam_html');
    }
    public function review_summary()
    {
        return view('review_summary');
    }
    public function question_summary()
    {
        return view('question_summary');
    }
    public function construction()
    {
        return view('construction');
    }
    
}
