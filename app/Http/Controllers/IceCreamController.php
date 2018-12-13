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
                'basket_items' => $basket_items,
                'basket_id' => $basket_id
            ]);
        }
    }

    /*
     *GET /edit/{item_id}
     */
    public function edit($item_id)
    {
        $basket_item = Basketitem::find($item_id);
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
     *PUT /cart/{item_id}/update
     */
    public function update(Request $request, $item_id)
    {
        $this->validate($request, [
            'quantity' => 'required|max:3|numeric',
            'size_id' => 'required',
            'toppings' => 'required_without_all',
            'flavors' => 'required_without_all'
        ]);

        $basket_item = Basketitem::find($item_id);
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
     *DELETE /cart/{item_id}/delete
     */
    public function delete(Request $request, $item_id)
    {

        $basket_item = Basketitem::find($item_id);
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

    /*
     *GET View Order page
     */
    public function viewOrder(Request $request, $basket_id)
    {
        $session_id = $request->session()->getId();

        $check_basket = Basket::checkBasket($session_id);
        $basket = Basket::getBasket($session_id);

        if (!$check_basket or $basket[0]["id"] != $basket_id) {
            return redirect('/');
        } else {
            $basket_items = Basketitem::getBasketItems($basket_id);

            return view('icecream.review_order')->with([
                'basket_items' => $basket_items,
                'basket_id' => $basket_id
            ]);
        }
    }

    /*
     *POST View Order page
     */
    public function placeOrder(Request $request, $basket_id)
    {
       $this->validate($request, [
           'firstName' => 'required|alpha',
           'lastName' => 'required|alpha',
           'email'=> 'required|email',
           'shipAddress1' => 'required',
           'shipAddress2' => 'nullable',
           'shipCity' => 'required|alpha',
           'shipState' => 'required|size:2|alpha',
           'shipZipCode' => 'required|digits:5|numeric',
           'shipCountry' => 'required|size:2',
           'billAddress1' => 'required',
           'billAddress2' => 'nullable',
           'billCity' => 'required|alpha',
           'billState' => 'required|size:2|alpha',
           'billZipCode' => 'required|digits:5|numeric',
           'billCountry' => 'required|size:2',
           'cardNumber' => 'required|digits:16|numeric',
           'CVV' => 'required|digits:3|numeric',
           'expDate' => 'required|size:5'
        ]);

        $session_id = $request->session()->getId();
        $basket = Basket::find($basket_id);
        $basket_items = Basketitem::getBasketItems($basket_id);

        $order = new Order();
        $order_number = rand(100,100000000) + $order->id;
        $order->order_number = $order_number;
        $order->session_id = $session_id;
        $order->first_name = $request->firstName;
        $order->last_name = $request->lastName;
        $order->ship_address_1 = $request->shipAddress1;
        $order->ship_address_2 = $request->shipAddress2;
        $order->ship_city = $request->shipCity;
        $order->ship_state = $request->shipState;
        $order->ship_country = $request->shipCountry;
        $order->ship_zip_code = $request->shipZipCode;
        $order->bill_address_1 = $request->billAddress1;
        $order->bill_address_2 = $request->billAddress2;
        $order->bill_city = $request->billCity;
        $order->bill_state = $request->billState;
        $order->bill_country = $request->billCountry;
        $order->bill_zip_code = $request->billZipCode;
        $order->email = $request->email;
        $order->card_number = $request->cardNumber;
        $order->card_exp_date = $request->expDate;
        $order->cv_code = $request->CVV;

        $order->save();

        foreach ($basket_items as $basket_item) {

            $order_item = new Orderitem();

            $order_item->order_id = $order->id;
            $order_item->quantity = $basket_item->quantity;
            $order_item->size_id = $basket_item->size->id;

            $order_item->save();

            $flavors2 = [];
            foreach($basket_item->flavors as $flavor) {
                array_push($flavors2,$flavor->id);
            }
            $toppings2 = [];
            foreach($basket_item->toppings as $topping) {
                array_push($toppings2,$topping->id);
            }

            $order_item->flavors()->sync($flavors2);
            $order_item->toppings()->sync($toppings2);
        }

        foreach ($basket_items as $basket_item) {
            $basket_item ->flavors()->detach();
            $basket_item ->toppings()->detach();
            $basket_item->delete();
        }
        $basket->delete();

        return view('icecream.order_placed')->with([
            'order_number' => $order_number
            ]);
    }

    public function orderReroute($basket_id) {
        return redirect('/');
    }

}
