<?php

use Illuminate\Database\Seeder;
use App\Rol;

class RolsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rol::create([
            'rol'           => 'Administrador',
            'description'   => 'Rol de administrador'
        ]);

        Rol::create([
            'rol'           => 'Doctor',
            'description'   => 'Rol de Doctor'
        ]);
    }
}
