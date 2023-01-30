<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'diemandan',
            'email' => 'diemandan63@gmail.com',
            'password' => Hash::make('yfcnz123'),
            'role' => 'admin'
        ]);
        User::factory()->count(6)->create();
    }
}
