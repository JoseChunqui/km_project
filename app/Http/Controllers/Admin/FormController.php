<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Form;
use App\Questionnaire;
use App\Course;

use Auth;

class FormController extends Controller
{

    public function index(Request $request)
    {
        $current_user_id = Auth::user()->id;
        $courses = Course::with('forms.questionnaires')->where('user_id', $current_user_id)->get();
        return view('admin.forms', compact('courses'));
    }

    public function show($id, Request $request)
    {
        $questionnaire = Questionnaire::findOrFail($id);
        return view('admin.show_questionnaire', compact('questionnaire'));
    }

    public function update($id, Request $request){
        $form = Form::findOrFail($id);
        $form->key = $request->clave;
        $form->save();

        return redirect()->route('courses.index');
    }

    public function store(Request $request)
    {
        $form = new Form();
        $course = Course::findOrFail($request->course);

        $form->course_id = $course->id;
        $form->name = $request->name;
        $form->key = $course->code + '-' + $request->key;

        $path = storage_path()."/../json/questionnaire.json";
        $data = file_get_contents($path);
        $form->data = json_decode($data);

        $form->save();

        return redirect()->route('forms.index');
    }

    public function manage(Request $request)
    {
        $form_id = $request->form;
        $data = json_decode($request->data);

        $form = Form::findOrFail($form_id);
        $form->data = $data;

        $form->save();

        return redirect()->route('forms.index');
    }

    public function changeState(Request $request)
    {
        if ($request->ajax()){
          $form_id = $request->form;
          $form = Form::findOrFail($form_id);
          $form->active = ! $form->active;
          $form->save();
          return response()->json([
            'success' => true,
          ]);
        }

    }
}
