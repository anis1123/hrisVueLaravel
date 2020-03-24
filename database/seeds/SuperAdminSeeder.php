<?php

use App\Modules\Superadmin\Models\Superadmin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Superadmin::insert([
            ['name'=>'SuperAdmin',
                'email'=>'superadmin@gmail.com',
                'password'=>Hash::make('turing')
            ]
        ]);

    }
}
