<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(ContactsTableSeeder::class);
        $faker = Faker::create('id_ID');
            for ($i=1; $i <= 100; $i++) { 
                DB::table('siswas')->insert([
                    'nis'=>mt_rand(7350,7450),
                    'nama'=>$faker->name(),
                    'kelas'=>('RPL'),
                ]);
        }
    }
}
