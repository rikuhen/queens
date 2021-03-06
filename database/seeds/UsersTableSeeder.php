<?php

use Illuminate\Database\Seeder;
use App\User;
use Hash as Hasher;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = 'juezuno';
        $password = Hasher::make($password);
        User::create([
            'role' => 'juez',
            'username' => 'juezuno',
            'password' =>$password
        ]);

        $password = 'admin';
        $password = Hasher::make($password);
        User::create([
        	'role' => 'admin',
        	'username' => 'admin',
        	'password' =>$password
        ]);
    }
}
