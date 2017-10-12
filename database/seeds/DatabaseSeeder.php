<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Form;

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
        $user = new User();
        $user->name = 'Jose Chunqui';
        $user->email = 'jose.chunqui.v@uni.pe';
        $user->password = bcrypt('159159');
        $user->save();

        $path = storage_path()."/../json/questionnaire.json";
        $data = file_get_contents($path);
        $form = new Form();
        $form->data = $data;
        $form->save();

    }
}
