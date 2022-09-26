<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsuariosReferidosTableSeeder extends Seeder
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
            'usuario_referido_id' => 3,
            'usuario_referidor_id' => 2,
            'id_rastro' => '2,3',
            ],
        	[
                'usuario_referido_id' => 4,
                'usuario_referidor_id' => 2,
                'id_rastro' => '2,4',
            ],
        	[
                'usuario_referido_id' => 5,
                'usuario_referidor_id' => 2,
                'id_rastro' => '2,5',
            ],
        	[
                'usuario_referido_id' => 6,
                'usuario_referidor_id' => 4,
                'id_rastro' => '4,6',
            ],
        	[
                'usuario_referido_id' => 7,
                'usuario_referidor_id' => 4,
                'id_rastro' => '4,7',
            ],
        	[
                'usuario_referido_id' => 8,
                'usuario_referidor_id' => 4,
                'id_rastro' => '4,8',
            ],
        	[
                'usuario_referido_id' => 9,
                'usuario_referidor_id' => 3,
                'id_rastro' => '3,9',
            ],
        	[
                'usuario_referido_id' => 11,
                'usuario_referidor_id' => 7,
                'id_rastro' => '4,7,11',
            ],
        	[
                'usuario_referido_id' => 12,
                'usuario_referidor_id' => 7,
                'id_rastro' => '4,7,12',
            ],
        ];

        DB::table('usuarios_referidos')->insert($insert);
                // php artisan migrate
        // php artisan db:seed --class=UsersTableSeeder
        // php artisan db:seed --class=NivelesTableSeeder
        // php artisan db:seed --class=UsuariosReferidosTableSeeder
    }
}
