<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        	'name' => 'Juan Carlos Medina',
        	'slug' => Str::slug('Juan Carlos Medina', '-').Str::uuid(),
        	'picture' => 'default.png',
        	'role_id' => \App\Rol::ADMIN,
        	'email' => 'contodofit@gmail.com',
        	'confirmed' => 0,
        	'identification_card' => '5482125200212',
        	'password' => bcrypt('ConTF2019'),
            'sex' => true,
            'date_birth' => Carbon\Carbon::now(),
        ]);

    }
}
