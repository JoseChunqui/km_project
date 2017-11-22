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
    public function index(Request $request)
    {
        $form_id = $request->form;
        $url_valid = $request->url_valid;
        if ($url_valid == 'admlink')
        {
          $questionnaires = Questionnaire::whereHas('form', function($form) use($form_id){
            $form->where('id', $form_id);
          })->get();
          return view('admin.answers', compact('questionnaires'));
        }
    }

    public function show($idForm, $idQuestionnaire, Request $request)
    {
        $questionnaire = Questionnaire::findOrFail($idQuestionnaire);
        return view('admin.show_questionnaire', compact('questionnaire'));
    }


}
