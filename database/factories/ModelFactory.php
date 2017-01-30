<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'username' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Game::class, function (Faker\Generator $faker) {
    return [
        'name'  => $faker->company,
        'identifier'   => $faker->slug,
    ];
});

$factory->define(App\Server::class, function (Faker\Generator $faker) {
    return [
        'name'  => $faker->company,
        'provider'  => $faker->company,
        'ip'        => $faker->ipv4,
        'is_online' => true,
        'is_installed'  => true,
    ];
});

$factory->define(App\GameServer::class, function (Faker\Generator $faker) {
    return [
        'ip'        => $faker->domainName,
        'game_id'   => factory(\App\Game::class)->create()->id,
        'server_id' => factory(\App\Server::class)->create()->id,
        'hourly_cost'   => $faker->randomFloat(null, 1, 20),
        'is_online' => true,
    ];
});