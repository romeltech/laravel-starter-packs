<?php

namespace Database\Seeders;

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
        $user = new \App\Models\User([
            'username'   => 'gaadmin',
            'email'      => 'admin@admin.com',
            'password'   => bcrypt('gag@112211'),
            'account_phone'      => '05012345678',
            'status'     => 'active', // active, disabled, trashed
            'role'       => 'admin'
        ]);
        $user->save();
        $user = new \App\Models\User([
            'username'   => 'editor',
            'email'      => 'editor@admin.com',
            'password'   => bcrypt('gag@112211'),
            'account_phone'      => '05012345678',
            'status'     => 'disabled', // active, disabled, trashed
            'role'       => 'editor'
        ]);
        $user->save();
        $user = new \App\Models\User([
            'username'   => 'editor2',
            'email'      => 'editor2@admin.com',
            'password'   => bcrypt('gag@112211'),
            'account_phone'      => '05012345678',
            'status'     => 'trashed', // active, disabled, trashed
            'role'       => 'editor'
        ]);
        $user->save();

        $faker = \Faker\Factory::create();
        for($i = 1; $i < 4; $i++){
            $profile = new \App\Models\Profile([
                'full_name' => $faker->firstNameMale().' '.$faker->lastName(),
                'user_id' => $i,
            ]);
            $profile->save();
        }

    }
}
