<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Institution;
use App\User;
use App\Form;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $institutions = Institution::with('users')->get();
        $courses = Course::with('user.institution', 'forms')->get();
        return view('admin.courses', compact('courses','institutions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      try {
        DB::beginTransaction();

        $course = new Course();
        $course->user_id = $request->user;
        $course->name = $request->name;
        $course->code = $request->code;
        $course->save();

        $path = storage_path()."/../json/questionnaire.json";
        $data = file_get_contents($path);
        $form = new Form();
        $form->name = 'Cuestionario KM';
        $form->data = json_decode($data);
        $form->course_id = $course->id;
        $form->key = ($request->code).'20172';
        $form->save();

        $request->session()->flash('success', 'Curso creado correctamente. Se generó un cuestionario para dicho curso de forma automática');

        DB::commit();

      } catch (\Exception $e) {

        DB::rollBack();

        $request->session()->flash('warning', 'Ha ocurrido un error. Recuerde que el código de curso es único. Intente de nuevo o contacte al administrador del sistema');

      }



        return redirect()->route('courses.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        //
    }
}
