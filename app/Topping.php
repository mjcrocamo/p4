<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topping extends Model
{
    //
    public function basketitems()
    {
        # withTimestamps will ensure the pivot table has its created_at/updated_at fields automatically maintained
        return $this->belongsToMany('App\Basketitem')->withTimestamps();
    }

    public function orderitems()
    {
        # withTimestamps will ensure the pivot table has its created_at/updated_at fields automatically maintained
        return $this->belongsToMany('App\Orderitem')->withTimestamps();
    }

    public static function show()
    {
        return self::select(['id','topping', 'topping_url','price'])->get();
    }

    public static function getToppingPrices($topping_ids) {
        return self::select(['price'])->whereIn("id",$topping_ids)->get();
    }
}
