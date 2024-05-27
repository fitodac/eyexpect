<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Age;

class AgeSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
	  Age::factory()->create([ 'code' => 'less_40', 'name' => '< 40' ]);
	  Age::factory()->create([ 'code' => '41_50', 'name' => '41-50' ]);
	  Age::factory()->create([ 'code' => '51_60', 'name' => '51-60' ]);
	  Age::factory()->create([ 'code' => '61_70', 'name' => '61-70' ]);
	  Age::factory()->create([ 'code' => 'more_71', 'name' => '> 71' ]);
  }
}
