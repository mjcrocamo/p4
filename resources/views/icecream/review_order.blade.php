@extends('layouts.master')

@section('title')
    Review and Place Order
@endsection

@push('head')
    <link href='' rel='stylesheet'>
@endpush

@section('content')
    <section id='allFlavors'>
        <h2>Flavors</h2>
        <div class="flavor"
        <ul>
            @foreach($flavors as $flavor)
                <li>{{ $flavor->flavor }}</li>
                <li><img class="flavorPic" src={{ $flavor->picture_url }}/></li>
                <li>{{ $flavor->description }}</li>
            @endforeach
        </ul>
        </div>
    </section>

    <section id='allToppings'>
        <h2>Toppings</h2>
        @foreach($toppings as $topping)
            <li>{{ $topping->topping }}</li>
            <li><img class="flavorPic" src={{ $topping->topping_url }}/></li>
        @endforeach
    </section>
@endsection