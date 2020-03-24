<?php

use App\Modules\Superadmin\Models\User;
use Illuminate\Database\Seeder;
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
        User::insert([
            ['name'=>'SuperAdmin',
            'email'=>'superadmin@gmail.com',
            'password'=>Hash::make('turing'),
                'super_admin'=>'1',
            ]
        ]);
    }
}
