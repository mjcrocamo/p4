@extends('layouts.master')

@section('title')
    View your Cart
@endsection

@push('head')
    <link href='' rel='stylesheet'>
@endpush

@section('content')
    <section id='allFlavors'>
        <h2>Sundae Cart</h2>
        <div class="flavor">
        <ul>
            <h3>hi</h3>
            @foreach($basket_items as $basket_item)
                    @foreach($basket_item->flavors as $flavor)
                        <li>{{ $flavor->flavor }}</li>
                    @endforeach
                    @foreach($basket_item->flavors as $flavor)
                            <li><img class="flavorPic" src={{ $flavor["picture_url"] }}/></li>
                        @endforeach
                    @foreach($basket_item->toppings as $topping)
                        <li>{{ $topping->topping }}</li>
                    @endforeach
                    <li>{{ $basket_item->size->size }}</li>
                        <li>{{ $basket_item->quantity }}</li>
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
            @endforeach
        </ul>
    </div>
        <div>
            <form method="GET" action="/viewOrder/{{ $basket_id}}">
                <input type='submit' value='Check Out' class='btn btn-primary'>
            </form>
            <form method="GET" action="/show">
                <input type='submit' value='Continue Shopping' class='btn btn-primary'>
            </form>
        </div>

    </section>
@endsection