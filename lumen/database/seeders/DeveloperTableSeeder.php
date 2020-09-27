<?php

namespace Database\Seeders;

use App\Developer;
use Illuminate\Database\Seeder;

class DeveloperTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Developer::create([
            'nome' => "João da Silva",
            'sexo' => "M",
            'idade' => 22,
            'dt_nasc' => "1998-02-10",
            'hobby' => "Colecionar selos"
        ]);
        Developer::create([
            'nome' => "Susy Cristina",
            'sexo' => "F",
            'idade' => 32,
            'dt_nasc' => "1987-12-30",
            'hobby' => "Montar quebra cabeças"
        ]);
        Developer::create([
            'nome' => "Marina Barbosa",
            'sexo' => "F",
            'idade' => 39,
            'dt_nasc' => "1981-09-24",
            'hobby' => "Viajar para lugares exóticos"
        ]);
        Developer::create([
            'nome' => "Joaquim Manoel",
            'sexo' => "M",
            'idade' => 18,
            'dt_nasc' => "2002-06-19",
            'hobby' => "Jogar videogames"
        ]);
    }
}
