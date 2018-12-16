@extends('layouts.master')

@section('title')
    View your Cart
@endsection

@push('head')

@endpush

@section('content')
    <section id='hi'>
        <h2  class="pageHeading2">There are currently no items in your cart</>
        <div class="continueEmpty">
            <form method="GET" action="/show">
                <input type="submit" value="Continue Shopping" class="btn btn-primary">
            </form>
        </div>
    </section>
@endsection