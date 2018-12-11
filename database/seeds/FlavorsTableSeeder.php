<?php

use Illuminate\Database\Seeder;
use App\Flavor;

class FlavorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $flavors = [
            ["Vanilla","Classic vanilla ice cream","images/flavors/vanilla2.jpg"],
            ["Chocolate","Classic chocolate ice cream","images/flavors/chocolate.jpg"],
            ["Chunky Monkey","Creamy banana ice cream full of chopped walnuts and chocolate chips","images/flavors/chunk-monkey.png"],
            ["Half Baked","Chocolate ice cream with brownie and cookie dough","images/flavors/half-baked.jpg"],
            ["Cherry","Classic cherry flavored ice cream","images/flavors/cherry.jpg"],
            ["Chocolate Fudge Brownie","Classic chocolate ice cream with baked fudge brownie chunks","images/flavors/chocolate-fudge-brownie.jpg"],
            ["Chocolate Chip","Classic vanilla ice cream with chocolate chips","images/flavors/chocolate-chip.jpg"],
            ["Cookie Monster","Classic vanilla ice cream colored blue with cookie dough chunks","images/flavors/cookie-monster.jpg"],
            ["Graham Slam","Classic vanilla ice cream with graham cracker bits","images/flavors/graham-slam.jpg"],
            ['Oreo',"Classic vanilla with oreo cookie chunks","images/flavors/oreo.jpg"],
            ['Chocolate Peanut Butter',"Class chocolate ice cream with peanut butter","images/flavors/chocolate-peanutbutter.jpg"],
            ['Fudge Swirl',"Classic vanilla ice cream with chocolate fudge swirls","images/flavors/fudge-swirl.jpg"]
        ];

        $count = count($flavors);

        foreach ($flavors as $key => $flavorData) {
            $flavor = new Flavor();

            $flavor->created_at = Carbon\Carbon::now()->subDays($count)->toDateTimeString();
            $flavor->updated_at = Carbon\Carbon::now()->subDays($count)->toDateTimeString();
            $flavor->flavor = $flavorData[0];
            $flavor->description = $flavorData[1];
            $flavor->picture_url = $flavorData[2];

            $flavor->save();
            $count--;
        }
    }
}
