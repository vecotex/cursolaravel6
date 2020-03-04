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
        /*
        Project::truncate();
        Client::truncate();
        User::truncate();
        */
        
        $this->call(UserTableSeeder::class);
        $this->call(ClientTableSeeder::class);        
        $this->call(ProjectTableSeeder::class);        
        $this->call(ProjectNoteTableSeeder::class);
    }
}
