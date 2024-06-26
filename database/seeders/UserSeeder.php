<?php

	namespace Database\Seeders;

	use Illuminate\Support\Facades\Hash;

    class UserSeeder extends \Illuminate\Database\Seeder {

        public function run() {
            \App\Models\User::create([
                'name' => 'ABC Company',
                'email' => 'admin@abc.com',
                'email_verified_at' => now(),
                'password' => Hash::make('admin123')
            ]);
        }
	}
