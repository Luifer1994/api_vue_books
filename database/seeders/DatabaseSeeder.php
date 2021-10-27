<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\User::factory(1)->create();

        //CREAMOS LOS TIPO DE SERVICIO POR DEFECTO YA QUE SON SOLO ESTOS DOS
        $num = 100;
        for ($i=1; $i < $num; $i++) {
            DB::table('books')->insert([
                'name' => 'Libro '. $i,
                'description' => 'Descripcion libro '. $i,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ]);
        }
    }
}
