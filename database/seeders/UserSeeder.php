<?php

	namespace Database\Seeders;

	use Illuminate\Support\Facades\Hash;

    class UserSeeder extends \Illuminate\Database\Seeder {

        public function run() {
            \App\Models\User::create([
                'name' => 'The Logic Studio',
                'email' => 'notify@logicstudio.nz',
                'email_verified_at' => now(),
                'password' => Hash::make('fred21')
            ]);
        }
	}
