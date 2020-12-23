<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'florent6001',
            'email' => 'florentvandroy@gmail.com',
            'admin' => 1,
            'password' => bcrypt('motdepasse123'),
        ]);
    }
}
