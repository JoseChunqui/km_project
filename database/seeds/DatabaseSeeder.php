<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Form;
use App\Role;
use App\Institution;
use App\Course;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $role = new Role();
        $role->name = 'admin';
        $role->save();

        $role = new Role();
        $role->name = 'user';
        $role->save();

        $institution = new Institution();
        $institution->name = 'Universidad Nacional de Ingeniería';
        $institution->abbreviation = 'UNI';
        $institution->save();

        $course = new Course();
        $course->name = 'Administración del Conocimiento';
        $course->user_id = 1;
        $course->code = 'ST265U';
        $course->save();

        $course = new Course();
        $course->name = 'Administración del Conocimiento';
        $course->user_id = 2;
        $course->code = 'ST265W';
        $course->save();

        $user = new User();
        $user->name = 'Jhon Doe';
        $user->role_id = 1;
        $user->email = 'jhon_doe@uni.pe';
        $user->password = bcrypt('159159');
        $user->save();

        $user = new User();
        $user->name = 'James Doe';
        $user->role_id = 2;
        $user->institution_id = 1;
        $user->email = 'james_doe@uni.pe';
        $user->password = bcrypt('159159');
        $user->save();

        $path = storage_path()."/../json/questionnaire.json";
        $data = file_get_contents($path);
        $form = new Form();
        $form->name = 'Cuestionario KM 20172';
        $form->data = json_decode($data);
        $form->course_id = 1;
        $form->key = 'ST265U-20172';
        $form->save();

        $path = storage_path()."/../json/questionnaire.json";
        $data = file_get_contents($path);
        $form = new Form();
        $form->name = 'Cuestionario KM 20172W';
        $form->data = json_decode($data);
        $form->course_id = 2;
        $form->key = 'ST265W-20172';
        $form->save();

    }
}
