@extends('layouts.master')

@section('content')
    <section class="h-100">
        <div class="row h-100 my-5">
            <div class="col-md-6 col-sm-12 offset-md-3">
                <div class="card my-5">
                    <div class="card-body bg-light p-5">
                        <div class="text-center">
                            <img src="{{ asset('assets/images/subscribe.png') }}" alt="Subscribe" width="150">
                            <span class="d-block mt-2 text-black-50">Subscribe to our newsletter in order not to miss new arrivals <br> promotions and discounts of our store</span>
                        </div>

                        @include('components.forms.subscribers.create')
                    </div>
                  </div>
            </div>
        </div>
    </section>
@endsection
