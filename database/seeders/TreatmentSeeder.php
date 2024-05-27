<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Treatment;

class TreatmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    Treatment::factory()->create([
	    	'code' => 'hyaluronic_acid',
		    'name' => 'Ácido hialurónico'
	    ]);

	    Treatment::factory()->create([
	    	'code' => 'botulinum_toxin',
		    'name' => 'Toxina botulínica'
	    ]);
    }
}
