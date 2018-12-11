@extends('layouts.master')

@push('head')

@endpush

@section('content')
    <section id='hi'>
        <h2>There are currently no items in your cart</h2>
        <form method="GET" action="/show">
            <input type="submit" value="Continue Shopping" class="btn btn-primary">
        </form>
    </section>
@endsection