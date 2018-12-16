@extends('layouts.master')

@section('title')
    View your Cart
@endsection

@push('head')
    <link href='' rel='stylesheet'>
@endpush

@section('content')
    <section id='allFlavors'>
        <h2 class="pageHeading">Your Sundae Cart</h2>
        <h2 class="cartTotal2">Order Total: <span class="cartTotal">${{ $basket->basket_total }}</span></h2>
        <div class="checkoutButton">
            <form method="GET" action="/viewOrder/{{ $basket->id }}">
                <input type='submit' value='Check Out' class='btn btn-primary'>
            </form>
        </div>
        <div class="continueShoppingButton">
            <form method="GET" action="/show">
                <input type='submit' value='Continue Shopping' class='btn btn-primary'>
            </form>
        </div>
        <span class="flavor">
            <h2 class="choiceHeadings">Current Items</h2>
            <ul>
                @foreach($basket_items as $basket_item)
                <li class="itemList">
                    <span class="flavorName">Flavors:</span>
                    @foreach($basket_item->flavors as $flavor)
                            <span class="cartDescription">{{ $flavor->flavor }},</span>
                        @endforeach
                        <div>
                            @if(!empty($basket_item->toppings[0]))
                                <span class="flavorName">Toppings:</span>
                            @foreach($basket_item->toppings as $topping)
                                    <span class="cartDescription">{{ $topping->topping }},</span>
                                @endforeach
                            @endif
                        </div>
                        <li>
                        <span class="flavorName">Size: </span><span class="cartDescription">{{ $basket_item->size->size }}</span>
                        <span class="quantityCart">Quantity: </span><span class="cartDescription" >{{ $basket_item->quantity }}</span>
                        </li>
                        <li>
                            <span class="flavorName">Price: </span><span class="cartDescription">${{ $basket_item->basket_item_total }}</span>
                        </li>
                        @foreach($basket_item->flavors as $flavor)
                            <img class="flavorPicCart" src={{ $flavor["picture_url"] }}/>
                        @endforeach
                        <div class="Updatebutton">
                            <form method="GET" action="/edit/{{ $basket_item->id }}">
                                <input type='submit' value='Update' class='btn btn-primary'>
                            </form>
                        </div>
                        <div class="deletebutton">
                            <form method="POST" action="/cart/{{ $basket_item->id }}/delete">
                                {{ method_field('delete') }}
                                {{ csrf_field() }}
                                <input type='submit' value='Remove' class='btn btn-primary'>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
@endsection