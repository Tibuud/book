<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(AuthorTableSeeder::class);

        $this->call(BookTableSeeder::class);

        $this->call(ScoreTableSeeder::class);

        $this->call(UserTableSeeder::class);

        // appel des autres seeders ici...
    }
}
