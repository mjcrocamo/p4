<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Basketitem extends Model
{
    //
    public function basket()
    {
        return $this->belongsTo('App\Basket');
    }

    public function size()
    {
        return $this->belongsTo('App\Size');
    }

    public function flavors()
    {
        # withTimestamps will ensure the pivot table has its created_at/updated_at fields automatically maintained
        return $this->belongsToMany('App\Flavor')->withTimestamps();
    }

    public function toppings()
    {
        # withTimestamps will ensure the pivot table has its created_at/updated_at fields automatically maintained
        return $this->belongsToMany('App\Topping')->withTimestamps();
    }

    public static function getBasketItems($basket_id)
    {
        return self::where("basket_id","=", $basket_id)->with(['size','flavors','toppings'])->get();
    }

    public static function getBasketItem($item_id)
    {
        return self::where("id","=", $item_id)->with(['size','flavors','toppings'])->get();
    }

    public static function checkBasketItems($basket_id)
    {
        return self::where("basket_id","=", $basket_id)->exists();
    }
}
