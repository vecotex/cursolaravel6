<?php

use Illuminate\Database\Seeder;
use CodeProject\Entities\Client;

class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        factory(Client::class, 10)->create();
    }
}
