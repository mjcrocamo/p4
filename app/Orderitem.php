<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orderitem extends Model
{
    //
    public function order()
    {
        return $this->belongsTo('App\Order');
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
}
