<?php

use Faker\Generator as Faker;

$factory->define(App\Score::class, function (Faker $faker) {
    return [

            'IP_visiteur' => $faker->ipv4,
            'vote' => $faker->numberBetween(1,5),
            'book_id' => $faker->numberBetween(1,30)
    ];
});


