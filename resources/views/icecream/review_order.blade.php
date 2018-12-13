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
            <h4>Shipping Info</h4>
            <div class="shippingInfo">
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
                <input type="text" placeholder="Address 1" name="shipAddress1" value='{{ old('shipAddress1', '') }}'>
            </label>
            @include('modules.field-error', ['field' => 'shipAddress1'])
            </div>
            <div>
            <label>
                <input type="text" placeholder="Address 2" name="shipAddress2" value='{{ old('shipAddress2', '') }}'>
            </label>
            @include('modules.field-error', ['field' => 'shipAddress2'])
            </div>
            <div>
            <label>
                <input type="text" placeholder="City" name="shipCity" value='{{ old('shipCity', '') }}'>
            </label>
            @include('modules.field-error', ['field' => 'shipCity'])
            </div>
            <div>
            <label>
                <input type="text" placeholder="State" name="shipState" value='{{ old('shipState', '') }}'>
            </label>
            @include('modules.field-error', ['field' => 'shipState'])
            </div>
            <div>
            <label>
                <input type="text" placeholder="Country eg US " name="shipCountry" value='{{ old('shipCountry', '') }}'>
            </label>
            @include('modules.field-error', ['field' => 'shipCountry'])
            </div>
            <div>
            <label>
                <input type="text" placeholder="Zip Code" name="shipZipCode" value='{{ old('shipZipCode', '') }}'>
            </label>
            @include('modules.field-error', ['field' => 'shipZipCode'])
            </div>
            </div>
            <h4>Billing Info</h4>
            <div class="billingInfo">
            <div>
                <label>
                    <input type="text" placeholder="Address 1" name="billAddress1" value='{{ old('billAddress1', '') }}'>
                </label>
                        @include('modules.field-error', ['field' => 'billAddress1'])
            </div>
                <div>
                    <label>
                        <input type="text" placeholder="Address 2" name="billAddress2" value='{{ old('billAddress2', '') }}'>
                    </label>
                    @include('modules.field-error', ['field' => 'billAddress2'])
                </div>
                <div>
                    <label>
                        <input type="text" placeholder="City" name="billCity" value='{{ old('billCity', '') }}'>
                    </label>
                    @include('modules.field-error', ['field' => 'billCity'])
                </div>
                <div>
                    <label>
                        <input type="text" placeholder="State" name="billState" value='{{ old('billState', '') }}'>
                    </label>
                    @include('modules.field-error', ['field' => 'billState'])
                </div>
                <div>
                    <label>
                        <input type="text" placeholder="Country eg US " name="billCountry" value='{{ old('billCountry', '') }}'>
                    </label>
                    @include('modules.field-error', ['field' => 'billCountry'])
                </div>
                <div>
                    <label>
                        <input type="text" placeholder="Zip Code" name="billZipCode" value='{{ old('billZipCode', '') }}'>
                    </label>
                    @include('modules.field-error', ['field' => 'billZipCode'])
                </div>
            </div>
            <h4>Payment</h4>
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