<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\Questionnaire;


class QuestionnaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, Request $request)
    {
        $questionnaires = Questionnaire::with('form')->whereHas('form', function($form) use($id){
          $form->where('id', $id);
        })->get();

        return view('admin.questionnaires', compact('questionnaires'));
    }

    public function show($idForm, $idQuestionnaire, Request $request)
    {
        $questionnaire = Questionnaire::findOrFail($idQuestionnaire);
        return view('admin.show_questionnaire', compact('questionnaire'));
    }


}
