@extends('layouts.master')

@section('title')
    Review Your Order
@endsection

@push('head')
    <link href='' rel='stylesheet'>
@endpush

@section('content')
    <section id='allFlavors'>
        <h2 class="pageHeading">Review your Order</h2>
        <form method="POST" class="form-row" action="/placeOrder/{{ $basket_id }}">
            {{ csrf_field() }}
            <div class="col-3">
                <h3 class="choiceHeadings">Shipping Info</h3>
                <div>
                <label>
                    <input type="text" class="form-control" placeholder="First Name" name="firstName" value='{{ old('firstName','')}}'>
                </label>
                @include('modules.field-error', ['field' => 'firstName'])
                </div>
                <div>
                <label>
                    <input type="text" class="form-control" placeholder="Last Name" name="lastName" value='{{ old('lastName', '') }}'>
                </label>
                @include('modules.field-error', ['field' => 'lastName'])
                </div>
                <div>
                <label>
                    <input type="text" class="form-control" placeholder="Email Address" name="email" value='{{ old('email', '') }}'>
                </label>
                @include('modules.field-error', ['field' => 'email'])
                </div>
                <div>
                <label>
                    <input type="text" class="form-control" placeholder="Address 1" name="shipAddress1" value='{{ old('shipAddress1', '') }}'>
                </label>
                @include('modules.field-error', ['field' => 'shipAddress1'])
                </div>
                <div>
                <label>
                    <input type="text" class="form-control" placeholder="Address 2" name="shipAddress2" value='{{ old('shipAddress2', '') }}'>
                </label>
                @include('modules.field-error', ['field' => 'shipAddress2'])
                </div>
                <div>
                <label>
                    <input type="text" class="form-control" placeholder="City" name="shipCity" value='{{ old('shipCity', '') }}'>
                </label>
                @include('modules.field-error', ['field' => 'shipCity'])
                </div>
                <div>
                <label>
                    <input type="text" class="form-control" placeholder="State" name="shipState" value='{{ old('shipState', '') }}'>
                </label>
                @include('modules.field-error', ['field' => 'shipState'])
                </div>
                <div>
                <label>
                    <input type="text" class="form-control" placeholder="Country eg. US " name="shipCountry" value='{{ old('shipCountry', '') }}'>
                </label>
                @include('modules.field-error', ['field' => 'shipCountry'])
                </div>
                <div>
                <label>
                    <input type="text" class="form-control" placeholder="Zip Code" name="shipZipCode" value='{{ old('shipZipCode', '') }}'>
                </label>
                @include('modules.field-error', ['field' => 'shipZipCode'])
                </div>
            </div>
            <div class="col-3">
                <h3 class="choiceHeadings">Billing Info</h3>
                <div>
                    <label>
                        <input type="text" class="form-control" placeholder="Address 1" name="billAddress1" value='{{ old('billAddress1', '') }}'>
                    </label>
                    @include('modules.field-error', ['field' => 'billAddress1'])
                </div>
                <div>
                    <label>
                        <input type="text" class="form-control" placeholder="Address 2" name="billAddress2" value='{{ old('billAddress2', '') }}'>
                    </label>
                    @include('modules.field-error', ['field' => 'billAddress2'])
                </div>
                <div>
                    <label>
                        <input type="text" class="form-control" placeholder="City" name="billCity" value='{{ old('billCity', '') }}'>
                    </label>
                    @include('modules.field-error', ['field' => 'billCity'])
                </div>
                <div>
                    <label>
                        <input type="text" class="form-control" placeholder="State" name="billState" value='{{ old('billState', '') }}'>
                    </label>
                    @include('modules.field-error', ['field' => 'billState'])
                </div>
                <div>
                    <label>
                        <input type="text" class="form-control" placeholder="Country eg. US " name="billCountry" value='{{ old('billCountry', '') }}'>
                    </label>
                    @include('modules.field-error', ['field' => 'billCountry'])
                </div>
                <div>
                    <label>
                        <input type="text" class="form-control" placeholder="Zip Code" name="billZipCode" value='{{ old('billZipCode', '') }}'>
                    </label>
                    @include('modules.field-error', ['field' => 'billZipCode'])
                </div>
            </div>
            <div class="col-2">
                <h3 class="choiceHeadings">Payment</h3>
                <div>
                <label>
                    <input type="text" class="form-control" placeholder="Card Number" name="cardNumber" value='{{ old('cardNumber', '') }}'>
                </label>
                @include('modules.field-error', ['field' => 'cardNumber'])
                </div>
                <div>
                <label>
                    <input type="text" class="form-control" placeholder="CVV" name="CVV" value='{{ old('CVV', '') }}'>
                </label>
                @include('modules.field-error', ['field' => 'CVV'])
                </div>
                <div>
                <label>
                    <input type="text" class="form-control" placeholder="Expiration Date: 06/20" name="expDate" value='{{ old('expDate', '') }}'>
                </label>
                @include('modules.field-error', ['field' => 'expDate'])
                </div>
            </div>
            <div class="col-3">
                <h3 class="choiceHeadings">Place Order</h3>
                <h4 class="reviewTotal2">Order Total: <span class="reviewTotal">${{ $basket->basket_total }}</span></h4>
                <div class="placeOrderbutton">
                    <input type='submit' value='Place Order' class='btn btn-primary'/>
                </div>
                <ul>
                    @foreach($basket_items as $basket_item)
                    <li class="itemList">
                        <span class="flavorNameReview">Flavors:</span>
                        @foreach($basket_item->flavors as $flavor)
                            <span class="reviewDescription">{{ $flavor->flavor }},</span>
                        @endforeach
                        <div>
                            @if(!empty($basket_item->toppings[0]))
                                <span class="flavorNameReview">Toppings:</span>
                                @foreach($basket_item->toppings as $topping)
                                    <span class="reviewDescription">{{ $topping->topping }},</span>
                                @endforeach
                            @endif
                        </div>
                        <li>
                            <span class="flavorNameReview">Size: </span><span class="reviewDescription">{{ $basket_item->size->size }}</span>
                            <span class="quantityCartReview">Quantity: </span><span class="reviewDescription">{{ $basket_item->quantity }}</span>
                        </li>
                        <li>
                            <span class="flavorNameReview">Price: </span><span class="reviewDescription">${{ $basket_item->basket_item_total }}</span>
                        </li>
                        @foreach($basket_item->flavors as $flavor)
                            <img class="flavorPicReview" src={{ $flavor->picture_url }}/>
                        @endforeach
                    </li>
                    @endforeach
                </ul>
                <div class="placeOrderbutton">
                    <input type='submit' value='Place Order' class='btn btn-primary'/>
                </div>
            </div>
        </form>
    </section>
@endsection