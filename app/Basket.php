<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    //
    public function basketitems()
    {
        return $this->hasMany('App\Basketitem');
    }

    public static function checkBasket($session_id)
    {
        return self::where('session_id','=', $session_id)->exists();
    }

    public static function getBasket($session_id)
    {
        return self::where('session_id','=', $session_id)->get();
    }
}
