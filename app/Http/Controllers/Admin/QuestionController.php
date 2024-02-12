<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LegalAdvice;
use App\Models\ReplyAdvice;
class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function questions()
    {
        $questions = LegalAdvice::with('category','user')->get();
        return view('dashboard.questions.questions',[
            'questions' => $questions
        ]);
    }
    public function reply($id)
    {
        $replies = ReplyAdvice::with('provider')->where('question_id',$id)->get();
        return view('dashboard.questions.reply',[
            'replies' => $replies
        ]);
    }
}
