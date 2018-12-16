<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function orderitems()
    {
        return $this->hasMany('App\Orderitem');
    }

    public static function getOrder($session_id)
    {
        return self::where('session_id','=', $session_id)->get();
    }
}
