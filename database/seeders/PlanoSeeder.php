<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('planos')->insert([
            'nome' => 'Free',
            'valor' => 0,
        ]);

        DB::table('planos')->insert([
            'nome' => 'Basic',
            'valor' => 100,
        ]);

        DB::table('planos')->insert([
            'nome' => 'Plus',
            'valor' => 187,
        ]);
    }
}
