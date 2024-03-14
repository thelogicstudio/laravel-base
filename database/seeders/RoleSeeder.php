<?php

	namespace Database\Seeders;

	use Illuminate\Support\Facades\Hash;

    class RoleSeeder extends \Illuminate\Database\Seeder {

        public function run() {
            \App\Models\Role::create([
                'name' => 'Admin'
            ]);
        }
	}
