<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Pet;
use App\Models\Criador;
use App\Models\Especie;
use Faker\Factory;
use Faker\Generator as Faker;

$factory->define(Pet::class, function (Faker $faker) {
    $faker = Factory::create('pt_BR');
    return [
        'nome' => $faker->colorName,
        'sexo' => $faker->randomElement(array('M','F')),
        'nascimento' => $faker->dateTimeBetween('-5 years', 'now'),
        'criador_id' => Criador::all()->random()->id,
        'especie_id' =>  Especie::all()->random()->id
    ];
});
