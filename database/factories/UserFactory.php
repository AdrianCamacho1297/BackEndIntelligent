<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Answer;
use App\Questions;
use App\Test;
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Symfony\Component\Console\Question\Question;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'noControlUser' => $faker->unique()->numberBetween(1, 10000),
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => bcrypt('hola'),
        'nombreUser' => $faker->name,
        'apellidoUser' => $faker->lastName,
        'especialidadUser' => $faker->randomElement([
            'Tics', 'Agronomia', 'Gestion', 'Hidorologica', 'Alimentarias'
        ]),
        'semestreUser' => $faker->numberBetween(1, 12),
        'edadUser' => $faker->numberBetween(1, 30),
        'remember_token' => Str::random(10),
    ];
});

## Generar datos en la base, Fake
$factory->define(Test::class, function (Faker $faker) {
    return [
        'nombreTest' => $faker->word,
        'descripcionTest' => $faker->paragraph(2),
        'duracionTest' => $faker->numberBetween(1, 60),
    ];
});

$factory->define(Answer::class, function (Faker $faker) {
    $question = Questions::all()->random();
    return [
        'answer' => $faker->paragraph(2),
        'statusAnswer' => $faker->randomElement([1, 0]),
        'question_id' => $question->id,
    ];
});
