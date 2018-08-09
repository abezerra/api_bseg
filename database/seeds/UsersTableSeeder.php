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
            'email' => 'root@user.com',
            'password' => bcrypt(123456),
            'role' => 'manager',
            'cpf' => '03676459393',
            'player_id' => '7e035d6b-d4e1-4d29-8a15-00a7c2f2c4df',
            'remember_token' => str_random(10)]);

        factory(\App\Entities\User::class)->create([
            'name' => 'Manager',
            'email' => 'manager@user.com',
            'password' => bcrypt(123456),
            'role' => 'manager',
            'cpf' => rand(1, 999) . rand(1, 999) . rand(1, 999) . rand(1, 99),
            'player_id' => '7e035d6b-d4e1-4d29-8a15-00a7c2f2c4df',
            'remember_token' => str_random(10)]);


        factory(\App\Entities\User::class)->create([
            'name' => 'News Clients Department',
            'email' => 'newsclient@user.com',
            'password' => bcrypt(123456),
            'role' => 'news',
            'cpf' => rand(1, 999) . rand(1, 999) . rand(1, 999) . rand(1, 99),
            'player_id' => '7e035d6b-d4e1-4d29-8a15-00a7c2f2c4df',
            'remember_token' => str_random(10)]);


        factory(\App\Entities\User::class)->create([
            'name' => 'Healt Departament',
            'email' => 'healt@user.com',
            'password' => bcrypt(123456),
            'role' => 'healt',
            'cpf' => rand(1, 999) . rand(1, 999) . rand(1, 999) . rand(1, 99),
            'player_id' => '7e035d6b-d4e1-4d29-8a15-00a7c2f2c4df',
            'remember_token' => str_random(10)]);


        factory(\App\Entities\User::class)->create([
            'name' => 'Eterprise Departament',
            'email' => 'enterprise@user.com',
            'password' => bcrypt(123456),
            'role' => 'enterprise',
            'cpf' => rand(1, 999) . rand(1, 999) . rand(1, 999) . rand(1, 99),
            'player_id' => '7e035d6b-d4e1-4d29-8a15-00a7c2f2c4df',
            'remember_token' => str_random(10)]);


        factory(\App\Entities\User::class)->create([
            'name' => 'Renovation Center',
            'email' => 'renovationcenter@user.com',
            'password' => bcrypt(123456),
            'role' => 'cr',
            'cpf' => rand(1, 999) . rand(1, 999) . rand(1, 999) . rand(1, 99),
            'player_id' => '7e035d6b-d4e1-4d29-8a15-00a7c2f2c4df',
            'remember_token' => str_random(10)]);

        factory(\App\Entities\User::class)->create([
            'name' => 'Collaborator',
            'email' => 'collaborator@user.com',
            'password' => bcrypt(123456),
            'role' => 'collaborator',
            'cpf' => rand(1, 999) . rand(1, 999) . rand(1, 999) . rand(1, 99),
            'player_id' => '7e035d6b-d4e1-4d29-8a15-00a7c2f2c4df',
            'remember_token' => str_random(10)]);
    }
}
