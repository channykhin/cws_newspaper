<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
        	'id' => '1',
        	'name' => 'Administrator',
        	'description' => 'somebody who has access to all the administration features within a site.',
        	'priority' => '3', 
        ]);
        DB::table('roles')->insert([
        	'id' => '2',
        	'name' => 'Editor',
        	'description' => 'somebody who can publish and manage posts including the posts of other users.',
        	'priority' => '10', 
        ]);
        DB::table('roles')->insert([
        	'id' => '3',
        	'name' => 'Author',
        	'description' => 'somebody who can publish and manage their own posts.',
        	'priority' => '1000', 
        ]);
        DB::table('roles')->insert([
            'id' => '4',
            'name' => 'Contributor',
            'description' => 'somebody who can write and manage their own posts but cannot publish them.',
            'priority' => '10000', 
        ]);
        DB::table('roles')->insert([
            'id' => '5',
            'name' => 'Subscriber',
            'description' => 'somebody who can only manage their profile.',
            'priority' => '100000', 
        ]);
    }
}
