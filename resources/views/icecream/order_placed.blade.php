@extends('layouts.master')

@section('title')
    Thanks for your Order!
@endsection

@push('head')
    <link href='' rel='stylesheet'>
@endpush

@section('content')
    <section id='allFlavors'>
        <h2 class="pageHeading">Thanks for your order!</h2>
        <h4 class="orderNumber">Order Number: {{ $order_number }}</h4>
        <div class="continueOrder">
            <form method="GET" action="/">
                <input type='submit' value='Continue Shopping' class='btn btn-primary'>
            </form>
        </div>
        <div class="flavor">
            <h2 class="pageHeading">Order Summary</h2>
            <ul>
                @foreach($basket_items as $basket_item)
                    <li>
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
                        <li><span class="flavorName">Size: </span><span class="cartDescription">{{ $basket_item->size->size }}</span></li>
                        <li><span class="flavorName">Quantity: </span><span class="cartDescription">{{ $basket_item->quantity }}</span></li>
                        @foreach($basket_item->flavors as $flavor)
                            <img class="flavorPicCart" src={{ $flavor["picture_url"] }}/>
                        @endforeach
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
@endsection