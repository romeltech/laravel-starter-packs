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
            'first_name' => 'GAG',
            'last_name'  => 'Super Admin',
            'email'      => 'admin@admin.com',
            'password'   => bcrypt('gag@112211'),
            'phone'      => '05012345678',
            'status'     => 'active', // active, disabled, trashed
            'company_id' => 1,
            'role'       => 'admin'
        ]);
        $user->save();
        $user = new \App\Models\User([
            'first_name' => 'First',
            'last_name'  => 'Account',
            'email'      => 'first@admin.com',
            'password'   => bcrypt('gag@112211'),
            'phone'      => '05012345678',
            'status'     => 'disabled', // active, disabled, trashed
            'company_id' => 1,
            'role'       => 'editor'
        ]);
        $user->save();
        $user = new \App\Models\User([
            'first_name' => 'Second',
            'last_name'  => 'Account',
            'email'      => 'second@admin.com',
            'password'   => bcrypt('gag@112211'),
            'phone'      => '05012345678',
            'status'     => 'trashed', // active, disabled, trashed
            'company_id' => 1,
            'role'       => 'editor'
        ]);
        $user->save();
    }
}
