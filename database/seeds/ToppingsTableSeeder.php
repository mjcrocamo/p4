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
            ["Chocolate Sprinkles","/images/toppings/chocolate-sprinkles.jpg",0.50],
            ["Hot Fudge","/images/toppings/HotFudge.jpg",0.50],
            ["Rainbow Sprinkles","/images/toppings/rainbow-sprinkles.jpg",0.50],
            ["Chocolate Syrup","/images/toppings/chocolate-syrup.jpg",0.50],
            ["Marshmallow","/images/toppings/marshmallow.jpg",1.00],
            ["Banana","/images/toppings/banana.jpg",1.00],
            ["Pineapple","/images/toppings/pineapple.jpg",1.00],
            ["Strawberry","/images/toppings/strawberry.jpg",1.00],
            ["Reeses Peanut Butter Cups","/images/toppings/reeses.jpg",1.00],
            ["Whipped Cream","/images/toppings/whipped-cream.jpg",0.50],
            ["Chocolate Chips","/images/toppings/chocolate-chips.jpg",0.50]
            ];

        $count = count($toppings);

        foreach ($toppings as $key => $toppingData) {
            $topping = new Topping();

            $topping->created_at = Carbon\Carbon::now()->subDays($count)->toDateTimeString();
            $topping->updated_at = Carbon\Carbon::now()->subDays($count)->toDateTimeString();
            $topping->topping = $toppingData[0];
            $topping->topping_url = $toppingData[1];
            $topping->price = $toppingData[2];

            $topping->save();
            $count--;
        }
    }
}
