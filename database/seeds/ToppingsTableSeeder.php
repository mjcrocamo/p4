<?php

use Illuminate\Database\Seeder;
use App\Topping;

class ToppingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $toppings = [
            ["Chocolate Sprinkles","/images/toppings/chocolate-sprinkles.jpg"],
            ["Hot Fudge","/images/toppings/HotFudge.jpg"],
            ["Rainbow Sprinkles","/images/toppings/rainbow-sprinkles.jpg"],
            ["Chocolate Syrup","/images/toppings/chocolate-syrup.jpg"],
            ["Marshmallow","/images/toppings/marshmallow.jpg"],
            ["Banana","/images/toppings/banana.jpg"],
            ["Pineapple","/images/toppings/pineapple.jpg"],
            ["Strawberry","/images/toppings/strawberry.jpg"],
            ["Reeses Peanut Butter Cups","/images/toppings/reeses.jpg"],
            ["Whipped Cream","/images/toppings/whipped-cream.jpg"],
            ["Chocolate Chips","/images/toppings/chocolate-chips.jpg"]
            ];

        $count = count($toppings);

        foreach ($toppings as $key => $toppingData) {
            $topping = new Topping();

            $topping->created_at = Carbon\Carbon::now()->subDays($count)->toDateTimeString();
            $topping->updated_at = Carbon\Carbon::now()->subDays($count)->toDateTimeString();
            $topping->topping = $toppingData[0];
            $topping->topping_url = $toppingData[1];

            $topping->save();
            $count--;
        }
    }
}
