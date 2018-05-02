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
        //factory(\App\Entities\User::class, 10)->create();

        factory(\App\Entities\User::class)->create([
            'name' => 'Root',
            'email' => 'root@bseg.com',
            'password' => bcrypt(123456),
            'role' => 'manager',
            'cpf' => '03676459393',
            'remember_token' => str_random(10)]);


//        factory(\App\Entities\User::class)->create([
//            'name' => 'News Clients Department',
//            'email' => 'newsclient@bseg.com',
//            'password' => bcrypt(123456),
//            'role' => 'news',
//            'cpf' => rand(1, 999) . rand(1, 999) . rand(1, 999) . rand(1, 99),
//            'remember_token' => str_random(10)]);
//
//
//        factory(\App\Entities\User::class)->create([
//            'name' => 'Healt Departament',
//            'email' => 'healt@bseg.com',
//            'password' => bcrypt(123456),
//            'role' => 'healt',
//            'cpf' => rand(1, 999) . rand(1, 999) . rand(1, 999) . rand(1, 99),
//            'remember_token' => str_random(10)]);
//
//
//        factory(\App\Entities\User::class)->create([
//            'name' => 'Eterprise Departament',
//            'email' => 'enterprise@bseg.com',
//            'password' => bcrypt(123456),
//            'role' => 'enterprise',
//            'cpf' => rand(1, 999) . rand(1, 999) . rand(1, 999) . rand(1, 99),
//            'remember_token' => str_random(10)]);
//
//
//        factory(\App\Entities\User::class)->create([
//            'name' => 'Renovation Center',
//            'email' => 'renovationcenter@bseg.com',
//            'password' => bcrypt(123456),
//            'role' => 'cr',
//            'cpf' => rand(1, 999) . rand(1, 999) . rand(1, 999) . rand(1, 99),
//            'remember_token' => str_random(10)]);
//
//        factory(\App\Entities\User::class)->create([
//            'name' => 'Collaborator',
//            'email' => 'collaborator@bseg.com',
//            'password' => bcrypt(123456),
//            'role' => 'collaborator',
//            'cpf' => rand(1, 999) . rand(1, 999) . rand(1, 999) . rand(1, 99),
//            'remember_token' => str_random(10)]);
    }
}
