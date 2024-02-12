<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\legalAdvice;
class LegalAdviceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function allAdvice(){
        $advices = legalAdvice::with('category','user')->get();
        return view('dashboard.legal-advice.advices',[
            'advices' => $advices
        ]);
    } 
    
}
