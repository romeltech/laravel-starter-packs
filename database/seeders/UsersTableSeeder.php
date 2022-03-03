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
            'full_name' => 'GAG Super Admin',
            'email'      => 'admin@admin.com',
            'password'   => bcrypt('gag@112211'),
            'phone'      => '05012345678',
            'status'     => 'active', // active, disabled, trashed
            'company_id' => 1,
            'role'       => 'admin'
        ]);
        $user->save();
        $user = new \App\Models\User([
            'full_name' => 'Editor Account',
            'email'      => 'editor@admin.com',
            'password'   => bcrypt('gag@112211'),
            'phone'      => '05012345678',
            'status'     => 'disabled', // active, disabled, trashed
            'company_id' => 1,
            'role'       => 'editor'
        ]);
        $user->save();
        $user = new \App\Models\User([
            'full_name' => 'Another Editor Account',
            'email'      => 'editor2@admin.com',
            'password'   => bcrypt('gag@112211'),
            'phone'      => '05012345678',
            'status'     => 'trashed', // active, disabled, trashed
            'company_id' => 1,
            'role'       => 'editor'
        ]);
        $user->save();
    }
}
