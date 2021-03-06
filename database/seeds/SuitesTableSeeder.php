<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Suite;
use App\Highlight;
use Carbon\Carbon;

class SuitesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        for ($i_suites=0; $i_suites < 500; $i_suites++) {
          $new_suite = new Suite();

          $new_suite->user_id = rand(1,12);
          $new_suite->title = $faker->sentence(6);
          $new_suite->address = $faker->address;
          $new_suite->rooms = rand(1, 4);
          $new_suite->beds = rand(1, 8);
          $new_suite->baths = rand(1, 3);
          $new_suite->square_m = rand(10, 200);
          $new_suite->latitude = rand(45, 40); //lat min-max approssimative dell'italia
          $new_suite->longitude = rand(12, 15); //lng min-max approssimative dell'italia
          $new_suite->price = $faker->randomFloat($nbMaxDecimals = 2, $min = 15, $max = 160.00);
          $new_suite->description = $faker->text(1000);
          $new_suite->main_image = $faker->imageUrl($width = 150, $height = 100);
          $new_suite->save();

          // I assign one or more services to each room
          for ($i_services=0; $i_services < rand(1, 6); $i_services++) {
            // Choose a service
            $new_suite->services()->attach(rand(1,6));
          }

          // I assign 0 or more highlights to each room
          for ($i_highlights=0; $i_highlights < rand(0, 1); $i_highlights++) {
            // Choose a promotion
            // Assign strat & end dateTime to every promotion
            $start = Carbon::now();
            $end = Carbon::now()->addHours(24);
            // $highlights = Highlight::all();
            // foreach ($highlights as $highlight) {
            //   if ($highlight->id == 1) {
            //     $end = Carbon::now()->addHours(24);
            //   }
            //   elseif ($highlight->id == 2) {
            //     $end = Carbon::now()->addHours(72);
            //   }
            //   else {
            //     $end = Carbon::now()->addHours(144);
            //   }
            // }

            $new_suite->highlights()->attach(rand(1, 3),
              [
                'start' => $start,
                'end' => $end
              ]);
          }
        }
    }
}
