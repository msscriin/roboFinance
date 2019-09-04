<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call('UserTableSeeder');
        $this->command->info('Пользователи созданы успешно!');
        $this->call('PurseTableSeeder');
        $this->command->info('Информация о счетах пользователя добавлена успешно!');
    }
}
