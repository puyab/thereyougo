<?php

namespace Database\Factories;

use App\Models\Profile;
use Closure;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
      $faker = fake();
      $existed_features = ['Workstation', 'terrace', 'TV', 'Hair Dryer', 'Studio', 'Pool', 'AC', 'Towels', 'Ergonomic Chair', 'Garden', 'Oven', 'Shampoo', '2nd Screen', 'BBQ', 'Microwave', 'Bodywash', 'Co-working', 'Bicycle', 'Dishwasher', 'Coffee Machine'];
      $features = [];
      for($i = 0; $i < random_int(0, count($existed_features) - 1); $i++) {
        $features[] = $faker->randomElement($existed_features);
      }
        return [
          'role' => $faker->jobTitle(),
          'company' => $faker->company(),
          'telephone' => $faker->phoneNumber(),
          'location'=> $faker->address(),
          'accommodation_type' => $faker->randomElement(['house', 'apartment', 'room']),
          'bedrooms' => $faker->numberBetween(0, 10),
          'sleep_rooms' => $faker->numberBetween(0, 5),
          'high_speed_wifi' => $faker->randomElement([false, true]),
          'features' => $features,
          'first_name' => $faker->firstName(),
          'last_name' => $faker->lastName(),
          'linkedin' => $faker->url(),
          'status' => $faker->randomElement(['not_sent', 'pending', 'approved', 'rejected'])
        ];
    }
    public function configure()
    {
      return parent::configure()
          ->afterCreating(function (Profile $profile) {
              $seed = now()->unix();
              foreach (['avatar', 'pic_1', 'pic_2', 'pic_3'] as $collection) {
                $profile->addMediaFromUrl('https://picsum.photos/seed/'. $seed .'/502/422')->toMediaCollection($collection);
              }
          });
    }
}
