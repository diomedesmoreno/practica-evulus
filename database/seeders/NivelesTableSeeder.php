<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NivelesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $insert = [
        	[
            'nombre' => 'Nivel 1',
            'monto_minimo_personal' => 1000,
            'monto_minimo_directo' => 1500,
            'monto_minimo_red' => 3000,
            'numero_red' => 1
            ],
        	[
                'nombre' => 'Nivel 2',
                'monto_minimo_personal' => 2000,
                'monto_minimo_directo' => 3000,
                'monto_minimo_red' => 6000,
                'numero_red' => 2
            ],
        	[
                'nombre' => 'Nivel 3',
                'monto_minimo_personal' => 3000,
                'monto_minimo_directo' => 6000,
                'monto_minimo_red' => 12000,
                'numero_red' => 3
            ]
        ];

        DB::table('niveles')->insert($insert);

        // php artisan migrate
        // php artisan db:seed --class=UsersTableSeeder
        // php artisan db:seed --class=NivelesTableSeeder
        // php artisan db:seed --class=UsuariosReferidosTableSeeder
    }
}
