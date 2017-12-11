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
        $courses = Course::with('forms.questionnaires')->where('user_id', $current_user_id)->orderby('id','DESC')->get();
        return view('admin.forms', compact('courses'));
    }

    public function show($id, Request $request)
    {
        $questionnaire = Questionnaire::findOrFail($id);
        return view('admin.show_questionnaire', compact('questionnaire'));
    }

    public function update($id, Request $request){
        $form = Form::findOrFail($id);
        $new_key =  $form->course->code . '-' . $request->clave;
        $form_exists = Form::where('key', $new_key)->first();
        if(! $form_exists){
          try {
            $form->key = $new_key;
            $form->save();

            $request->session()->flash('success', 'La clave del cuestionario ha sido cambiada con éxito');

          } catch (\Exception $e) {

            $request->session()->flash('warning', 'Ha ocurrido un error. No se pudo cambiar la clave del cuestionario. Intente de nuevo o contacte con el administrador del sistema');

          }

        }else{
          $request->session()->flash('warning', 'La clave del cuestionario ya existe. Esta debe ser única');
        }
        return redirect()->route('forms.index');
    }

    public function store(Request $request)
    {
        try {

          $form = new Form();
          $course = Course::findOrFail($request->course);

          $form->course_id = $course->id;
          $form->name = $request->name;
          $form->key = $course->code + '-' + $request->key;

          $path = storage_path()."/../json/questionnaire.json";
          $data = file_get_contents($path);
          $form->data = json_decode($data);

          $form->save();

          $request->session()->flash('success', 'El cuestionario ha sido creado con éxito');

        } catch (\Exception $e) {

          $request->session()->flash('warning', 'No se ha podido crear el cuestionario. Recuerde que la clave del cuestionario tiene que se única');

        }

        return redirect()->route('forms.index');
    }

    public function manage(Request $request)
    {
        try {
          $form_id = $request->form;
          $data = json_decode($request->data);

          $form = Form::findOrFail($form_id);
          $form->data = $data;

          $form->save();

          $request->session()->flash('success', 'El cuestionario ha sido actualizado con éxito');

        } catch (\Exception $e) {

          $request->session()->flash('warning', 'Ha ocurrido un error. No se ha podido actualizar el cuestionario. Intente nuevamente o contacte al administrador del sistema');

        }

        return redirect()->route('forms.index');
    }

    public function changeState(Request $request)
    {
        if ($request->ajax()){
          try {
            $form_id = $request->form;
            $form = Form::findOrFail($form_id);
            $form->active = ! $form->active;
            $form->save();

            return response()->json([
              'success' => true,
            ]);

          } catch (\Exception $e) {

            return response()->json([
              'success' => false,
            ]);

          }

        }

    }
}
