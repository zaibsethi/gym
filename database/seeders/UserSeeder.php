<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            [
                'name' => 'Jahanzaib Mehdi',
                'email' => 'developer@gymcms.com',
                'phone' => '0000',
                'password' => Hash::make('Zaib@dev_23_'),
                'type' => 'developer',
            ],
////            [
//                'name' => 'Zaib',
//                'email' => 'zaib@fitnesszone.com',
//                'password' => Hash::make('Zaib@3_36'),
//                'type' => 'owner',
//                'gym_id' => 1,
//
//            ],
// [
//                'name' => 'Shahzaib',
//                'email' => 'shahzaib@fitnesszone.com',
//                'password' => Hash::make('Shahzaib216'),
//                'type' => 'superAdmin',
//                'gym_id' => 1,
//
//
//            ],
//            [
//                'name' => 'Sameer',
//                'email' => 'sameert@fitnesszone.com',
//                'password' => Hash::make('Sameer10'),
//                'type' => 'admin',
//                'gym_id' => 1,
//
//
//            ],
//            [
//                'name' => 'Arshman',
//                'email' => 'arshman@fitnesszone.com',
//                'password' => Hash::make('Arshman070'),
//                'type' => 'admin',
//                'gym_id' => 1,
//
//            ],
        ]);

    }
}
