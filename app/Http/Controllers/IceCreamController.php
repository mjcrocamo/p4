<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Basket;
use App\Basketitem;
use App\Flavor;
use App\Order;
use App\Orderitem;
use App\Size;
use App\Topping;
use App\Http\Controllers\Session;

class IceCreamController extends Controller
{
    /*
     * GET /
     */
    public function index()
    {
        return view('icecream.index');
    }

    /*
     * GET /show
     */
    public function show()
    {
        $flavors = Flavor::show();
        $toppings = Topping::show();
        $sizes = Size::show();

        return view('icecream.show')->with([
            'flavors' => $flavors,
            'toppings' => $toppings,
            'sizes' => $sizes
        ]);
    }

    /*
     * POST /cart
     */
    public function addCart(Request $request)
    {
        $this->validate($request, [
            'quantity' => 'required|max:3|numeric',
            'size_id' => 'required',
            'toppings' => 'required_without_all',
            'flavors' => 'required_without_all'
        ]);

        $session_id = $request->session()->getId();

        $current_basket = Basket::checkBasket($session_id);

        if (!$current_basket) {

            $basket = new Basket();
            $basket->session_id = $session_id;
            $basket->save();

            $basket_item = new Basketitem();
            $basket_item->quantity = $request->quantity;
            $basket_item->basket_id = $basket->id;
            $basket_item->size_id = $request->size_id;
            $basket_item->save();

            $basket_item->flavors()->sync($request->flavors);
            $basket_item->toppings()->sync($request->toppings);

        } else {
            $current_baskets = Basket::getBasket($session_id);

            $basket_item = new Basketitem();
            $basket_item->quantity = $request->quantity;
            $basket_item->basket_id = $current_baskets[0]["id"];
            $basket_item->size_id = $request->size_id;
            $basket_item->save();

            $basket_item->flavors()->sync($request->flavors);
            $basket_item->toppings()->sync($request->toppings);

        }

        return redirect('/')->with([
            'alert' => $request->quantity . ' items added to your cart.'
        ]);
    }

    /*
     *GET /cart
     */
    public function showCart(Request $request)
    {
        $session_id = $request->session()->getId();

        $check_basket = Basket::checkBasket($session_id);

        if(!$check_basket) {
            return view('icecream.emptybasket');
        } else {
            $basket = Basket::getBasket($session_id);
            $basket_id = $basket[0]["id"];
            $basket_items = Basketitem::getBasketItems($basket_id);

            return view('icecream.basket')->with([
                'basket_items' => $basket_items
            ]);
        }
    }

    /*
     *GET /edit/{id}
     */
    public function edit($id)
    {
        $basket_item = Basketitem::find($id);
        $flavors = Flavor::show();
        $toppings = Topping::show();
        $sizes = Size::show();

        $flavorsForItem = $basket_item->flavors()->pluck('flavors.id')->toArray();
        $toppingsForItem = $basket_item->toppings()->pluck('toppings.id')->toArray();

        return view('icecream.edit')->with([
            'basket_item' => $basket_item,
            'flavors' => $flavors,
            'toppings' => $toppings,
            'sizes' => $sizes,
            'flavorsForItem' => $flavorsForItem,
            'toppingsForItem' => $toppingsForItem
        ]);

    }

    /*
     *PUT /cart/{id}/update
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'quantity' => 'required|max:3|numeric',
            'size_id' => 'required',
            'toppings' => 'required_without_all',
            'flavors' => 'required_without_all'
        ]);

        $basket_item = Basketitem::find($id);
        $basket_item->flavors()->sync($request->flavors);
        $basket_item->toppings()->sync($request->toppings);

        $basket_item->quantity = $request->quantity;
        $basket_item->size_id = $request->size_id;
        $basket_item->save();

        return redirect('/cart')->with([
            'alert' => $request->quantity . ' items have been updated in your cart.'
        ]);

    }

    /*
     *DELETE /cart/{id}/delete
     */
    public function delete(Request $request, $id)
    {

        $basket_item = Basketitem::find($id);
        $basket_id = $basket_item->basket_id;
        $quantity = $basket_item->quantity;
        $basket_item ->flavors()->detach();
        $basket_item ->toppings()->detach();
        $basket_item->delete();

        $basket_items = Basketitem::checkBasketItems($basket_id);

        if(!$basket_items) {
            $basket = Basket::find($basket_id);
            $basket->delete();
        }

        return redirect('/cart')->with([
            'alert' => $quantity . ' items have been removed from the cart.'
        ]);

    }

}
