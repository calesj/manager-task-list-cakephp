<?php
declare(strict_types=1);

use Migrations\BaseSeed;

/**
 * Users seed.
 */
class UsersSeed extends BaseSeed
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
        $data = [
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => password_hash('password', PASSWORD_DEFAULT),
            'is_admin' => true,
        ];

        $guest = [
            'name' => 'user',
            'email' => 'user@user.com',
            'password' => password_hash('password', PASSWORD_DEFAULT),
            'is_admin' => false,
        ];

        $table = $this->table('users');
        $table->insert($data)->save();
        $table->insert($guest)->save();
    }
}
