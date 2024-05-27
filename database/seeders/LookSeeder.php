<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Look;

class LookSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Look::factory()->create([ 'code' => 'tired', 'name' => 'Cansado' ]);
		Look::factory()->create([ 'code' => 'angry', 'name' => 'Enfadado' ]);
		Look::factory()->create([ 'code' => 'aging', 'name' => 'Envejecido' ]);
	}
}
