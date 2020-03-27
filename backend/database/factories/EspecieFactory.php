<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Especie;
use Faker\Factory;
use Faker\Generator as Faker;

$factory->define(Especie::class, function (Faker $faker) {
    $faker = Factory::create('pt_BR');
    return [
        'nome' => $faker->monthName
    ];
});
