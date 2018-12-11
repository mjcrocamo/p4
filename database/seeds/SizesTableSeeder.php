<?php

use Illuminate\Database\Seeder;
use App\Size;


class SizesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $sizes = [
            ["Small"],
            ["Medium"],
            ["Large"],
            ["Extra Large"]
        ];

        $count = count($sizes);

        foreach ($sizes as $key => $sizeData) {
            $size = new Size();

            $size->created_at = Carbon\Carbon::now()->subDays($count)->toDateTimeString();
            $size->updated_at = Carbon\Carbon::now()->subDays($count)->toDateTimeString();
            $size->size = $sizeData[0];

            $size->save();
            $count--;
        }
    }
}
