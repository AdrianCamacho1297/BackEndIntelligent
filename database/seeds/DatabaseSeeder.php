<?php

use App\Answer;
use App\Questions;
use App\Test;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * Para insertar los en la base de datos
     *
     * @return void
     */
    public function run()
    {
        DB::table('test_user')->truncate();
        // Answer::truncate();
        Questions::truncate();
        Test::truncate();
        User::truncate();

        $numUser = 10;
        $numTest = 10;
        $numAnswer = 1000;
        factory(Test::class, $numTest)->create()->each(
            ##Por cada Test que se haga, se generará sus preguntas, tomando su id.
            function ($test) {
                $faker = Faker\Factory::create();
                for ($i = 0; $i < 10; $i++) {
                    Questions::create([
                        'pregunta' => $faker->paragraph(1),
                        'test_id' => $test->id
                    ]);
                }
            }
        );

        factory(User::class, $numUser)->create()->each(
            function ($user) {
                $test = Test::all()->random(mt_rand(1, 5))->pluck('id');
                $user->tests()->attach($test);
            }
        );

        factory(Answer::class, $numAnswer)->create();


        $users = User::all();
        foreach ($users as $user) {
            $tests = $user->tests;
            foreach ($tests as $test) {
                $preguntas = $test->questions;
                foreach ($preguntas as $pregunta) {
                    DB::insert('insert into answer_user (answer_id, user_id, question_id) values (?, ?,?)', [$pregunta->answers->random()->id,$user->id, $pregunta->id ]);
                }
            }
        }
    }
}
