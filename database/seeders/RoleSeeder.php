<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

		$superadmin = Role::create(['name' => 'Superadmin']);
		$admin = Role::create(['name' => 'Admin']);
		$doctor = Role::create(['name' => 'Medic']);

		Permission::create(['name' => 'dashboard'])->syncRoles([$superadmin, $admin, $doctor]);

	}
}
