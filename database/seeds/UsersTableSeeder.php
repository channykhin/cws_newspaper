<?php

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
        DB::table('users')->insert([
        	'id' => '1',
        	'first_name' => 'Default',
        	'last_name' => 'User',
        	'email' => 'default@gmail.com',
        	'phone' => '00000000',
        	'username' => 'administrator',
        	'password' => Hash::make('administrator'),
        	'status' => '1',
        	'online' => '0',
        	'created_at' => date("Y-m-d G:i:s"),
        	'updated_at' => date("Y-m-d G:i:s"),
        	'role_id' => '1', 
        ]);

    }
}
