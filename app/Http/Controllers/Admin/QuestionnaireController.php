<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel as Excel;

use Auth;
use App\Questionnaire;
use App\Form;


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
        $form = Form::findOrFail($form_id);
        $questionnaires = Questionnaire::whereHas('form', function($form) use($form_id){
          $form->where('id', $form_id);
        })->get();
        return view('admin.answers', compact('questionnaires', 'form'));
    }

    public function show(Request $request)
    {
        $questionnaire_id = $request->codigo;
        $questionnaire = Questionnaire::findOrFail($questionnaire_id);
        return view('admin.show_questionnaire', compact('questionnaire'));
    }

    public function export_to_excel(Request $request)
    {
        $form_id = $request->form;
        $questionnaires = Questionnaire::whereHas('form', function($form) use($form_id){
          $form->where('id', $form_id);
        })->get()->toJson();

        Excel::create('Laravel Excel', function($excel) use($questionnaires) {
          $excel->sheet('Excel sheet', function($sheet) use($questionnaires) {
            $sheet->loadView('admin.export.export_answers', compact('questionnaires'));
          });
        })->export('xls');

    }


}
