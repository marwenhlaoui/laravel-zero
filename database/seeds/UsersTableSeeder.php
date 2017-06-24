<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User();
        $admin->name = "Admin";
        $admin->email = "admin@blog.com";
        $admin->password = bcrypt('password');
        $admin->role = true;/*admin role*/
        $admin->save();
    }
}
