@extends('layouts.master')

@section('title')
    Thanks for your Order!
@endsection

@push('head')
    <link href='' rel='stylesheet'>
@endpush

@section('content')
    <section id='allFlavors'>
        <h2>Thanks for your order!</h2>
        <h4>Order Number: {{ $order_number }}</h4>
        <div>
            <form method="GET" action="/">
                <input type='submit' value='Continue Shopping' class='btn btn-primary'>
            </form>
        </div>
    </section>
@endsection