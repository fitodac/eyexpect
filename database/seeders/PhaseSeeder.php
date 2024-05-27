<?php

	namespace Database\Seeders;

	use Illuminate\Database\Seeder;
	use App\Models\Phase;

	class PhaseSeeder extends Seeder
	{
		/**
		 * Run the database seeds.
		 *
		 * @return void
		 */
		public function run()
		{

			$total_phases = 50;

			function random_image(){
				$images = [
					'v3_0007020', 'v3_0041898', 'v3_0054931', 'v3_0074738', 'v3_0131967', 'v3_0136452', 'v3_0147367',
					'v3_0152359', 'v3_0172878', 'v3_0191280', 'v3_0223049', 'v3_0253308', 'v3_0254814', 'v3_0276984',
					'v3_0298946', 'v3_0314252', 'v3_0330987', 'v3_0361471', 'v3_0405128', 'v3_0416004', 'v3_0425758',
					'v3_0431663', 'v3_0458998', 'v3_0505862', 'v3_0566465', 'v3_0637389', 'v3_0639266', 'v3_0654301',
					'v3_0667079', 'v3_0774986', 'v3_0802028', 'v3_0817760', 'v3_0889677', 'v3_0903790', 'v3_0915351',

				];
				$idx = array_rand($images);
				return env('APP_URL')."/storage/____IMAGES/$images[$idx].jpg";
			}


			for($i = 1; $i <= $total_phases; $i++){
				$initial = Phase::factory()->create([ 'code' => 'initial', 'name' => 'Inicial', 'patient_id' => $i ]);
				$middle = Phase::factory()->create([ 'code' => 'middle', 'name' => 'Media', 'patient_id' => $i ]);
				$final = Phase::factory()->create([ 'code' => 'final', 'name' => 'Final', 'patient_id' => $i ]);

				$pics = ['front', 'right', 'left', 'threequarters', 'smiling', 'angry'];



				for($ii = 0; $ii <= 5; $ii++){
					$initial->addMediaFromUrl(random_image())
						->setFileName( substr(md5(time()), 0, 16) .'.jpg' )
						->withResponsiveImages()
						->toMediaCollection($pics[$ii]);

					$middle->addMediaFromUrl(random_image())
						->setFileName( substr(md5(time()), 0, 16) .'.jpg' )
						->withResponsiveImages()
						->toMediaCollection($pics[$ii]);

					$final->addMediaFromUrl(random_image())
						->setFileName( substr(md5(time()), 0, 16) .'.jpg' )
						->withResponsiveImages()
						->toMediaCollection($pics[$ii]);
				}

			}
		}
	}
