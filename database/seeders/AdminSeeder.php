<?php

namespace Database\Seeders;

use App\Constants\UserType;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(100)->create([
            'type' => UserType::ADMIN
        ]);
    }
}
