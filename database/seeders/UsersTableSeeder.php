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
            'is_active'  => true,
            'company_id' => 1,
            'role'       => 'admin'
        ]);
        $user->save();
    }
}
