<?php

use Illuminate\Database\Seeder;
use CodeProject\Entities\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        factory(User::class)->create
        ([
        'name' => 'Verdi',
        'email' => 'vicotex@gmail.com',
        'password' => bcrypt(94741301),
        'remember_token' => Str::random(10),
        ]);

        factory(User::class, 10)->create();
    }
}