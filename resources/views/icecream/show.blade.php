@extends('layouts.master')

@section('title')
    Choose your Sundae!
@endsection

@push('head')
    <link href='' rel='stylesheet'>
@endpush

@section('content')
    <section id='allFlavors'>
        <form class="form-row" method="POST" action="/cart">
            {{ csrf_field() }}
            <div class="col-4">
                <h2 class="choiceHeadings">Flavors</h2>
                 <ul>
                    @foreach($flavors as $flavor)
                         <li>
                             <label class="checkbox">
                                 <input {{ (in_array($flavor->id, old('flavors', []) )) ? 'checked' : '' }} type="checkbox" name='flavors[]' value={{ $flavor->id }}>

                                 <span class="flavorName">{{ $flavor->flavor }}</span>
                                 <div>
                                     <span class="flavorDescription">{{ $flavor->description }}</span>
                                 </div>
                                 @include('modules.field-error', ['field' => 'flavors'])
                                 <div>
                                     <img class="flavorPictureEdit" src={{ $flavor->picture_url }}/>
                                 </div>
                             </label>
                         </li>
                    @endforeach
                 </ul>
            </div>
            <div class="col-5">
                <h2 class="choiceHeadings">Toppings</h2>
                <ul>
                    @foreach($toppings as $topping)
                        <li>
                            <label class="checkbox">
                                <input {{ (in_array($topping->id, old('toppings', []) )) ? 'checked' : '' }} type="checkbox" name='toppings[]' value={{ $topping->id }}>
                                <span class="flavorName">{{ $topping->topping }}</span>
                                @include('modules.field-error', ['field' => 'toppings'])
                                <div>
                                    <img class="flavorPictureEdit" src={{ $topping->topping_url }}/>
                                </div>
                            </label>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class=class="col-3">
                <h3 class="choiceHeadings">Quantity</h3>
                <div class="quantityEdit">
                    <input class="form-control" type="text" name="quantity" value={{ old('quantity', 1) }}>
                    @include('modules.field-error', ['field' => 'quantity'])
                </div>
                <h3 class="choiceHeadings">Size</h3>
                <select class="form-control" name='size_id'>
                    <option value=''>Choose a size...</option>
                    @foreach($sizes as $size)
                        <option value='{{ $size->id }}' {{ old('size_id') ? 'selected' : '' }}>{{ $size->size }}</option>
                    @endforeach
                </select>
                @include('modules.field-error', ['field' => 'size_id'])
                <div class="editButton">
                    <input type="submit" value="Add to Cart" class="btn btn-primary">
                </div>
            </div>
        </form>
    </section>
@endsection