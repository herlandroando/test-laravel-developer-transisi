<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            "name"      => "Admin Transisi",
            "email"     => "admin@transisi.id",
            "password"  => bcrypt("transisi")
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
