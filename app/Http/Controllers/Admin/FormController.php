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
        // $form = Form::with('questionnaires')->first();
        // $questionnaires = $form->questionnaires;
        // return view('admin.questionnaires', compact('questionnaires'));

        $current_user_id = Auth::user()->id;
        // $forms = Form::whereHas('course', function($course) use($current_user_id){
        //   $course->where('user_id', $current_user_id);
        // })->get();

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
}
