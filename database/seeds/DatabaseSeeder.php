<?php

use Illuminate\Database\Seeder;
use App\User;

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
    }
}
