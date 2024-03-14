<?php

	namespace Database\Seeders;

	use Illuminate\Support\Facades\DB;

    class PrivilegeSeeder extends \Illuminate\Database\Seeder {

        public function run() {
            $data = [
                [
                    'name' => 'do_all_action_role',
                    'model' => 'role',
                ],
                [
                    'name' => 'index_role',
                    'model' => 'role',
                ],
                [
                    'name' => 'show_role',
                    'model' => 'role',
                ],
                [
                    'name' => 'create_role',
                    'model' => 'role',
                ],
                [
                    'name' => 'update_role',
                    'model' => 'role',
                ],
                [
                    'name' => 'delete_role',
                    'model' => 'role',
                ],
                [
                    'name' => 'restore_role',
                    'model' => 'role',
                ],
                [
                    'name' => 'do_all_action_user',
                    'model' => 'user',
                ],
                [
                    'name' => 'index_user',
                    'model' => 'user',
                ],
                [
                    'name' => 'show_user',
                    'model' => 'user',
                ],
                [
                    'name' => 'create_user',
                    'model' => 'user',
                ],
                [
                    'name' => 'update_user',
                    'model' => 'user',
                ],
                [
                    'name' => 'delete_user',
                    'model' => 'user',
                ],
                [
                    'name' => 'restore_user',
                    'model' => 'user',
                ],
                [
                    'name' => 'view_audit_log',
                    'model' => 'audit log',
                ]
            ];

            DB::table('privileges')->insert($data);

        }
	}
