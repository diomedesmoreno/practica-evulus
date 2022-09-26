<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $insert = [
        	[
            'name' => Str::random(10),
            'email' => Str::random(10).'@example.com',
            'mi_codigo_referido' => substr(str_shuffle($permitted_chars), 0, 10),
            'monto_actual' => 1000
            ],
        	[
            'name' => Str::random(10),
            'email' => Str::random(10).'@example.com',
            'mi_codigo_referido' => substr(str_shuffle($permitted_chars), 0, 10),
            'monto_actual' => 2000
            ],
        	[
            'name' => Str::random(10),
            'email' => Str::random(10).'@example.com',
            'mi_codigo_referido' => substr(str_shuffle($permitted_chars), 0, 10),
            'monto_actual' => 3000
            ],
        	[
            'name' => Str::random(10),
            'email' => Str::random(10).'@example.com',
            'mi_codigo_referido' => substr(str_shuffle($permitted_chars), 0, 10),
            'monto_actual' => 4000
            ],
        	[
            'name' => Str::random(10),
            'email' => Str::random(10).'@example.com',
            'mi_codigo_referido' => substr(str_shuffle($permitted_chars), 0, 10),
            'monto_actual' => 5000
            ],
        	[
            'name' => Str::random(10),
            'email' => Str::random(10).'@example.com',
            'mi_codigo_referido' => substr(str_shuffle($permitted_chars), 0, 10),
            'monto_actual' => 6000
            ],
        	[
            'name' => Str::random(10),
            'email' => Str::random(10).'@example.com',
            'mi_codigo_referido' => substr(str_shuffle($permitted_chars), 0, 10),
            'monto_actual' => 7000
            ],
        	[
            'name' => Str::random(10),
            'email' => Str::random(10).'@example.com',
            'mi_codigo_referido' => substr(str_shuffle($permitted_chars), 0, 10),
            'monto_actual' => 8000
            ],
        	[
            'name' => Str::random(10),
            'email' => Str::random(10).'@example.com',
            'mi_codigo_referido' => substr(str_shuffle($permitted_chars), 0, 10),
            'monto_actual' => 9000
            ],
        	[
            'name' => Str::random(10),
            'email' => Str::random(10).'@example.com',
            'mi_codigo_referido' => substr(str_shuffle($permitted_chars), 0, 10),
            'monto_actual' => 9500
            ],
            [
            'name' => Str::random(10),
            'email' => Str::random(10).'@example.com',
            'mi_codigo_referido' => substr(str_shuffle($permitted_chars), 0, 10),
            'monto_actual' => 9000
            ],
            [
            'name' => Str::random(10),
            'email' => Str::random(10).'@example.com',
            'mi_codigo_referido' => substr(str_shuffle($permitted_chars), 0, 10),
            'monto_actual' => 9500
            ],
        ];

        DB::table('users')->insert($insert);
        // php artisan migrate
        // php artisan db:seed --class=UsersTableSeeder
        // php artisan db:seed --class=NivelesTableSeeder
        // php artisan db:seed --class=UsuariosReferidosTableSeeder
    }
}
