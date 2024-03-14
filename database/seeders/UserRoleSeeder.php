<?php

	namespace Database\Seeders;

    use Illuminate\Support\Facades\DB;

    class UserRoleSeeder extends \Illuminate\Database\Seeder {

        public function run() {
            $data = [
                [
                    'role_id' => '1',
                    'user_id' => '1',
                ]
            ];

            DB::table('user_role')->insert($data);

        }
	}
