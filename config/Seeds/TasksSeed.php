<?php
declare(strict_types=1);

use Faker\Factory;
use Migrations\BaseSeed;

/**
 * Tasks seed.
 */
class TasksSeed extends BaseSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/migrations/4/en/seeding.html
     *
     * @return void
     */
    public function run(): void
    {
        $faker = Factory::create();
        for ($i = 1; $i <= 50; $i++) {
            $data = [
                'title' => $faker->sentence,
                'content' => $faker->paragraph,
                'status' => $faker->randomElement(['pending', 'in_progress', 'completed']),
                'deadline' => $faker->date(),
                'user_id' => $faker->randomElement([1, 2]),
            ];

            $table = $this->table('tasks');
            $table->insert($data)->save();
        }
    }
}
