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
            'full_name'  => 'GAG Super Admin',
            'username'   => 'gaadmin',
            'email'      => 'admin@admin.com',
            'password'   => bcrypt('gag@112211'),
            'phone'      => '05012345678',
            'status'     => 'active', // active, disabled, trashed
            'role'       => 'admin'
        ]);
        $user->save();
        $user = new \App\Models\User([
            'full_name'  => 'Editor Account',
            'username'   => 'editor',
            'email'      => 'editor@admin.com',
            'password'   => bcrypt('gag@112211'),
            'phone'      => '05012345678',
            'status'     => 'disabled', // active, disabled, trashed
            'role'       => 'editor'
        ]);
        $user->save();
        $user = new \App\Models\User([
            'full_name'  => 'Another Editor Account',
            'username'   => 'editor2',
            'email'      => 'editor2@admin.com',
            'password'   => bcrypt('gag@112211'),
            'phone'      => '05012345678',
            'status'     => 'trashed', // active, disabled, trashed
            'role'       => 'editor'
        ]);
        $user->save();
    }
}
