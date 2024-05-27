<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = Patient::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {

  	$sex = ['m', 'f'];

    return [
      'look' => $this->faker->numberBetween(1, 3),
      'age' => $this->faker->numberBetween(1, 5),
      'treatment' => $this->faker->numberBetween(1, 2),
      'gender' => $sex[array_rand($sex)]
    ];
  }
}
