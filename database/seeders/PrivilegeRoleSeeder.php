<?php

	namespace Database\Seeders;

    use Illuminate\Support\Facades\DB;

    class PrivilegeRoleSeeder extends \Illuminate\Database\Seeder {

        public function run() {
            $data = [
                [
                    'role_id' => '1',
                    'privilege_id' => '1',
                ],
                [
                    'role_id' => '1',
                    'privilege_id' => '8',
                ],
                [
                    'role_id' => '1',
                    'privilege_id' => '15',
                ]
            ];

            DB::table('privilege_role')->insert($data);

        }
	}
