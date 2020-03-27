<?php

use Illuminate\Database\Seeder;
use App\Models\Especie;

class EspeciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Especie::class, 10)->create();
    }
}
