<?php

namespace Trafik8787\LaraCrud2\Seeder;

use Faker\Generator;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Database\Seeder;

class ArticleTableExampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Factory $factory, Generator $faker)
    {
        $factory->define(\App\Http\Node\Model\ArticleExampleModel::class, function () use ($faker) {

            return [
                'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                'description' => $faker->text($maxNbChars = 150),
                'date' => $faker->date($format = 'Y-m-d', $max = 'now')
            ];


        });

        factory(\App\Http\Node\Model\ArticleExampleModel::class, 50)->create();
    }
}
