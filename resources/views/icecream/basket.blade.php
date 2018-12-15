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
        <div class="flavor">
            <ul>
                @foreach($basket_items as $basket_item)
                    Flavors:
                    @foreach($basket_item->flavors as $flavor)
                        {{ $flavor->flavor }},
                    @endforeach
                    <div>
                        @if(!empty($basket_item->toppings[0]))
                        Toppings:
                            @foreach($basket_item->toppings as $topping)
                                {{ $topping->topping }},
                            @endforeach
                        @endif
                    </div>
                    <li>Size: {{ $basket_item->size->size }}</li>
                    <li>Quantity: {{ $basket_item->quantity }}</li>
                    @foreach($basket_item->flavors as $flavor)
                        <li class="cartPicture">
                            <img class="flavorPic" src={{ $flavor["picture_url"] }}/>
                        </li>
                    @endforeach
                    <div class="Updatebutton">
                        <form method="GET" action="/edit/{{ $basket_item->id }}">
                            <input type='submit' value='Update' class='btn btn-primary'>
                        </form>
                    <div class="deletebutton">
                        <form method="POST" action="/cart/{{ $basket_item->id }}/delete">
                            {{ method_field('delete') }}
                            {{ csrf_field() }}
                            <input type='submit' value='Remove' class='btn btn-primary'>
                        </form>
                    </div>
                @endforeach
            </ul>
        </div>
        <div class="checkoutButton">
            <form method="GET" action="/viewOrder/{{ $basket_id}}">
                <input type='submit' value='Check Out' class='btn btn-primary'>
            </form>
        </div>
        <div class="continueShoppingButton">
            <form method="GET" action="/show">
                <input type='submit' value='Continue Shopping' class='btn btn-primary'>
            </form>
        </div>
    </section>
@endsection