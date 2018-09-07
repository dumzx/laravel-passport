<?php

use Faker\Generator as Faker;
use Laravel\Passport\Client as Model;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'secret' => str_random(60),
        'redirect' => $faker->url(),
        'personal_access_client' => 0,
        'password_client' => 0,
        'revoked' => rand(0,1),
    ];
});
