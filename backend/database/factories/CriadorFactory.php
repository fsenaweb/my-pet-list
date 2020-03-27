<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use \App\Models\Criador;
use Faker\Generator as Faker;
use Faker\Factory;

$factory->define(Criador::class, function (Faker $faker) {
    $faker = Factory::create('pt_BR');
    return [
        'nome' => $faker->name,
        'endereco' => $faker->address,
        'telefone' => $faker->phone
    ];
});
