<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $firstUser = User::first();

        //if(!$firstUser)
            User::factory()->create([
                'name' => 'admin',
                'email' => 'admin@admin.ru',
                'password'=> '123456',
            ]);

        $this->call([
            ActivitySeeder::class,
            BuildingSeeder::class,
            OrganizationSeeder::class,
        ]);
    }
}
