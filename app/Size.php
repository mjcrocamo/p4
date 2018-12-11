<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    //
    public function orderitems()
    {
        return $this->hasMany('App\Orderitem');
    }

    public function basketitems()
    {
        return $this->hasMany('App\Basketitem');
    }

    public static function show()
    {
        return self::select(['id','size'])->get();
    }

    public static function getSize($basket_item_id)
    {

    }
}
