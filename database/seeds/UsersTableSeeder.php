<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        factory(User::class,50)->create()->each(function($u){
            factory(\Laravel\Passport\Client::class,5)->create(['user_id' => $u->id]);
           // $u->clients()->create(factory(\Laravel\Passport\Client::class)->make());
        });

    }
}
