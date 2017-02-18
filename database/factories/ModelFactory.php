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


$factory->define(App\Database::class, function (Faker\Generator $faker) {
    return [
        'name'           => $faker->word,
        'user_id'        => factory(App\User::class)->create()->id,
        'game_server_id' => factory(App\GameServer::class)->create()->id,
    ];
});

$factory->define(App\Order::class, function (Faker\Generator $faker) {
    return [
        'user_id'       => factory(App\User::class)->create()->id,
        'duration'      => $faker->randomNumber(3),
        'is_completed'  => 1,
        'email'         => $faker->email,
        'country'       => $faker->countryCode,
        'price'         => $faker->randomNumber(5),
        'game_server_id'=> factory(App\GameServer::class)->create()->id,
    ];
});

$factory->define(App\FtpUser::class, function (Faker\Generator $faker) {
    return [
        'user_id'   => factory(App\User::class)->create()->id,
        'game_server_id' => factory(App\GameServer::class)->create()->id,
        'username'  => $faker->userName,
    ];
});

$factory->define(\App\ServerPackage::class, function (Faker\Generator $faker) {
    return [
        'game_id'   => factory(App\Game::class)->create()->id,
        'name'      => $faker->word,
        'version'   => $faker->word,
        'url'       => $faker->url,
    ];
});