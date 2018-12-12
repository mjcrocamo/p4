@extends('layouts.master')

@section('title')
    Review Your Order
@endsection

@push('head')
    <link href='' rel='stylesheet'>
@endpush

@section('content')
    <section id='allFlavors'>
        <h2>Review your Order</h2>
        <form method="POST" action="/placeOrder/{{ $basket_id }}">
            {{ csrf_field() }}
            <div>
            <label>
                <input type="text" placeholder="First Name" name="firstName" value='{{ old('firstName','')}}'>
            </label>
            @include('modules.field-error', ['field' => 'firstName'])
            </div>
            <div>
            <label>
                <input type="text"  placeholder="Last Name" name="lastName" value='{{ old('lastName', '') }}'>
            </label>
            @include('modules.field-error', ['field' => 'lastName'])
            </div>
            <div>
            <label>
                <input type="text"  placeholder="email address" name="email" value='{{ old('email', '') }}'>
            </label>
            @include('modules.field-error', ['field' => 'email'])
            </div>
            <div>
            <label>
                <input type="text" placeholder="Address 1" name="address1" value='{{ old('address1', '') }}'>
            </label>
            @include('modules.field-error', ['field' => 'address1'])
            </div>
            <div>
            <label>
                <input type="text" placeholder="Address 2" name="address2" value='{{ old('address2', '') }}'>
            </label>
            @include('modules.field-error', ['field' => 'address2'])
            </div>
            <div>
            <label>
                <input type="text" placeholder="City" name="city" value='{{ old('city', '') }}'>
            </label>
            @include('modules.field-error', ['field' => 'city'])
            </div>
            <div>
            <label>
                <input type="text" placeholder="State" name="state" value='{{ old('state', '') }}'>
            </label>
            @include('modules.field-error', ['field' => 'state'])
            </div>
            <div>
            <label>
                <input type="text" placeholder="Country" name="country" value='{{ old('country', '') }}'>
            </label>
            @include('modules.field-error', ['field' => 'country'])
            </div>
            <div>
            <label>
                <input type="text" placeholder="Zip Code" name="zipCode" value='{{ old('zipCode', '') }}'>
            </label>
            @include('modules.field-error', ['field' => 'zipCode'])
            </div>
            <div>
            <label>
                <input type="text" placeholder="Card Number" name="cardNumber" value='{{ old('cardNumber', '') }}'>
            </label>
            @include('modules.field-error', ['field' => 'cardNumber'])
            </div>
            <div>
            <label>
                <input type="text" placeholder="CVV" name="CVV" value='{{ old('CVV', '') }}'>
            </label>
            @include('modules.field-error', ['field' => 'CVV'])
            </div>
            <div>
            <label>
                <input type="text" placeholder="Expiration Date: 06/20" name="expDate" value='{{ old('expDate', '') }}'>
            </label>
            @include('modules.field-error', ['field' => 'expDate'])
            </div>

            <h3>Current Items</h3>
            <ul>
                @foreach($basket_items as $basket_item)
                    @foreach($basket_item->flavors as $flavor)
                        <li>{{ $flavor["flavor"] }}</li>
                    @endforeach
                    @foreach($basket_item->flavors as $flavor)
                        <li><img class="flavorPic" src={{ $flavor["picture_url"] }}/></li>
                    @endforeach
                    @foreach($basket_item->toppings as $topping)
                        <li>{{ $topping["topping"] }}</li>
                    @endforeach
                    <li>{{ $basket_item->size["size"] }}</li>
                    <li>{{ $basket_item->quantity }}</li>
                @endforeach
            </ul>
            <input type='submit' value='Place Order' class='btn btn-primary'/>
        </form>
    </section>
@endsection