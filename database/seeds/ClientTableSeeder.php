<?php

use Illuminate\Database\Seeder;

class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\Laravel\Passport\Client::class,50)->create()->each(function($u){
            // $u
        });
    }
}
