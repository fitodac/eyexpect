<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;


class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{

		$this->call(RoleSeeder::class);
		$this->call(LookSeeder::class);
		$this->call(AgeSeeder::class);
		$this->call(TreatmentSeeder::class);
		$this->call(PatientSeeder::class);
		$this->call(PhaseSeeder::class);

		User::factory()->create([
			'name' => 'fitodac',
			'email' => 'fito@commonpeoplei.com',
			'password' => bcrypt('123123')
		])->assignRole('Superadmin');

		User::factory()->create([
			'name' => 'dani',
			'email' => 'dani@commonpeoplei.com',
			'password' => bcrypt('123123')
		])->assignRole('Superadmin');

		User::factory()->create([
			'name' => 'dr_house',
			'email' => 'house@test.com',
			'password' => bcrypt('123123')
		])->assignRole('Medic');

		// \App\Models\User::factory(10)->create();

	}
}
