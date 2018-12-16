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
     * View the home page
     */
    public function index()
    {
        return view('icecream.index');
    }

    /*
     * GET /show
     * Page that shows the items to add to your cart
     * Get all the toppings, flavors and sizes
     * Send them to the view
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
     * Adds items to the users cart (basket)
     * Validate request
     * Get session id. If new session and no items in basket
     * Create a new basket and basket items
     * If they already have items in the basket, create the new item
     * Return to homepage and flash that item has been added
     */
    public function addCart(Request $request)
    {
        $this->validate($request, [
            'quantity' => 'required|max:200|numeric|gte:1',
            'size_id' => 'required',
            'flavors' => 'required_without_all'
        ]);

        $session_id = $request->session()->getId();

        $current_basket = Basket::checkBasket($session_id);

        if (!$current_basket) {

            $basket = new Basket();
            $basket->session_id = $session_id;
            $size = Size::find($request->size_id);
            $total_price = $size->price;
            $basket->basket_total = $total_price;
            $basket->save();

            $basket_item = new Basketitem();
            $basket_item->quantity = $request->quantity;
            $basket_item->basket_id = $basket->id;
            $basket_item->size_id = $request->size_id;
            $basket_item->basket_item_total = $total_price;
            $basket_item->save();

            $basket_item->flavors()->sync($request->flavors);
            $basket_item->toppings()->sync($request->toppings);

        } else {
            $current_baskets = Basket::getBasket($session_id);
            $basket_id = $current_baskets[0]["id"];
            $basket = Basket::find($basket_id);

            $size = Size::find($request->size_id);
            $item_price = $size->price;

            $current_total = $basket->basket_total;
            $basket->basket_total = $current_total + $item_price;
            $basket->save();

            $basket_item = new Basketitem();
            $basket_item->quantity = $request->quantity;
            $basket_item->basket_id = $basket_id;
            $basket_item->size_id = $request->size_id;
            $basket_item->basket_item_total = $item_price;
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
     * Route to view basket
     * Get the session id
     * If no items in basket show that no items are there
     * If they do have items, return the list of items
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
     * Page which allows user to edit one item in their cart
     * Show all the flavors, toppings and sizes as well as
     * what is currently chosen for that item
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
     * Route to update item in cart.
     * Validate request
     * Sync item updates to database
     */
    public function update(Request $request, $item_id)
    {
        $this->validate($request, [
            'quantity' => 'required|max:200|numeric|gte:1',
            'size_id' => 'required',
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
     * Route to delete item from cart
     * Find the item and delete it from the database
     * If all items deleted, delete instance of a basket as well
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
     * Page to review an order before placing it
     * Get  and show information about the basket for the user
     * Have forms for information to place the order
     * If not the correct session_id, return a redirect
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
     * Route to place the order
     * Validate the request
     * Use information to update rows in orders and orderitems, as well as pivot tables flavors and toppings
     * Delete rows from basket and basket items
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
        $basket_items_use = $basket_items;

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
            'order_number' => $order_number,
            'basket_items' => $basket_items_use
            ]);
    }

    /*
     *GET
     * Route to return a redirect to the homepage
     */

    public function orderReroute($basket_id) {
        return redirect('/');
    }

}
