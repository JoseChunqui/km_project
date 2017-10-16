<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Form;
use App\Questionnaire;

class FormController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $form = Form::with('questionnaires')->first();
        $questionnaires = $form->questionnaires;
        return view('admin.questionnaires', compact('questionnaires'));
    }

    public function show($id, Request $request)
    {
        $questionnaire = Questionnaire::findOrFail($id);
        return view('admin.show_questionnaire', compact('questionnaire'));
    }
}
