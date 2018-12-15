@extends('layouts.master')

@section('title')
    Update Sundae
@endsection

@push('head')
    <link href='' rel='stylesheet'>
@endpush

@section('content')
    <section id='allFlavors'>
        <h2 class="pageHeading">Edit Sundae</h2>
            <form class="form-row" method="POST" action="/cart/{{ $basket_item["id"] }}/update">
                {{ method_field('put') }}
                {{ csrf_field() }}
                <div class="col-md-4">
                    <h2 class="choiceHeadings">Flavors</h2>
                    <ul>
                        @foreach($flavors as $flavor)
                            <li>
                            <label class="checkbox">
                                    <input {{ (in_array($flavor->id, old('flavors', $flavorsForItem) )) ? 'checked' : '' }} type="checkbox" name='flavors[]' value={{ $flavor->id }}>

                                <span class="flavorName">{{ $flavor->flavor }}</span>
                                <div>
                                    <span class="flavorDescription">{{ $flavor->description }}</span>
                                </div>
                                <div>
                                    <img class="flavorPictureEdit" src={{ $flavor->picture_url }}/>
                                </div>
                            </label>
                                @include('modules.field-error', ['field' => 'flavors'])
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-4">
                    <h2 class="choiceHeadings">Toppings</h2>
                        <div class="flavor">
                            <ul>
                                @foreach($toppings as $topping)
                                <li>
                                    <label class="checkbox">
                                        <input {{ (in_array($topping->id, old('toppings', $toppingsForItem))) ? 'checked' : '' }} type="checkbox" name='toppings[]' value={{ $topping->id }}/>
                                        <span class="flavorName">{{ $topping->topping }}</span>
                                    </label>
                                </li>
                                    @include('modules.field-error', ['field' => 'toppings'])
                                @endforeach
                            </ul>
                        </div>
                </div>
                <div class="col-md-3">
                   <h3 class="choiceHeadings">Quantity</h3>
                   <div class="quantityEdit">
                        <input type="text" name="quantity" value={{ old('quantity', $basket_item["quantity"]) }}>
                        @include('modules.field-error', ['field' => 'quantity'])
                    </div>
                    <h3 class="choiceHeadings">Size</h3>
                    <select name='size_id'>
                        <option value=''>Choose a size...</option>
                        @foreach($sizes as $size)
                            <option value='{{ $size->id }}' {{ old('size_id',$basket_item["size_id"]) ? 'selected' : '' }}>{{ $size->size }}</option>
                        @endforeach
                    </select>
                    @include('modules.field-error', ['field' => 'size_id'])
                    <div class="editButton">
                        <input type="submit" value="Update Cart" class="btn btn-primary">
                    </div>
                </div>
            </form>
    </section>
@endsection