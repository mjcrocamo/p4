@extends('layouts.master')

@push('head')

@endpush

@section('content')
    <section id='hi'>
        <h2>Hi!</h2>
        <form method="GET" action="/show">
            <input type="submit" value="Order Sundae!" class="btn btn-primary">
        </form>
    </section>
@endsection