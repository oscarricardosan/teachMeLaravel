<?php

use TeachMe\Entities\User;

class UserTableSeeder extends BaseSeeder
{
    public function run(){
        $this->createAdmin();
        $this->createMultiple(50);
    }

    /*Crea usuario Admin*/
    public function createAdmin(){
       $this->create([
           'name' => 'admin',
           'email' => 'admin@admin.com',
           'password' => bcrypt('admin'),
       ]);
    }

    public function getDummyData(\Faker\Generator $faker, array $customValues = array())
    {
        return [
            'name' => $faker->name,
            'email' => $faker->email,
            'password' => bcrypt('secret'),
        ];
    }

    public function getModel()
    {
        return new User();
    }
}