<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminUser = new User();
        $adminUser->name = '管理員';
        $adminUser->email = 'admin@resume.com';
        $adminUser->password = Hash::make('admin');
        $adminUser->save();
    }
}
