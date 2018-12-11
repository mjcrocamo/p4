@extends('layouts.master')

@section('title')
    Choose your Sundae!
@endsection

@push('head')
    <link href='' rel='stylesheet'>
@endpush

@section('content')
    <section id='allFlavors'>
        <h2>Flavors</h2>
        <form method="POST" action="/cart">
            {{ csrf_field() }}
            <div class="flavor">
                 <ul>
                    @foreach($flavors as $flavor)
                         <li><span class="flavorName">{{ $flavor->flavor }}</span></li>
                         <label class="checkbox">
                        <li><img class="flavorPic" src={{ $flavor->picture_url }}/>
                             <input {{ (in_array($flavor->id, old('flavors', []) )) ? 'checked' : '' }} type="checkbox" name='flavors[]' value={{ $flavor->id }}></li>
                         </label>
                        <li><span class="flavorDescription">{{ $flavor->description }}</span></li>
                         @include('modules.field-error', ['field' => 'flavors'])
                    @endforeach
                 </ul>
            </div>

            <section id='allToppings'>
                <h2>Toppings</h2>
                <div class="flavor">
                    <ul>
                        @foreach($toppings as $topping)
                            @include('modules.field-error', ['field' => 'toppings'])
                            <li><span class="flavorName">{{ $topping->topping }}</span></li>
                            <label class="checkbox">
                                <li><img class="flavorPic" src={{ $topping->topping_url }}/>
                                    <input {{ (in_array($topping->id, old('toppings', []) )) ? 'checked' : '' }} type="checkbox" name='toppings[]' value={{ $topping->id }}></li>
                            </label>
                        @endforeach
                    </ul>
                </div>
            </section>
            <div class="quantity">
                <input type="text" name="quantity" value={{ old('quantity', 1) }}>
                @include('modules.field-error', ['field' => 'quantity'])
            </div>
            <div class="size">
                <select name='size_id'>
                    <option value=''>Choose a size...</option>
                    @foreach($sizes as $size)
                        <option value='{{ $size->id }}' {{ old('size_id') ? 'selected' : '' }}>{{ $size->size }}</option>
                    @endforeach
                </select>
                @include('modules.field-error', ['field' => 'size_id'])
            </div>
            <input type="submit" value="Add to Cart" class="btn btn-primary">
        </form>
    </section>
@endsection