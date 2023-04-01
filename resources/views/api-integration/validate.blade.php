@extends('layouts.master')

@section('content')
    <section class="h-100">
        <div class="row h-100 my-5">
            <div class="col-md-6 col-sm-12 offset-md-3">
                <div class="card my-5">
                    <div class="card-body bg-light p-5">
                        <div class="text-center">
                            <span class="d-block mt-2 text-black-50">
                                In order to work with MailerLite API you need to integrate your API key.
                                You can get the token from
                                <a href="https://www.mailerlite.com/help/" target="_blank">Mailerlite</a>
                            </span>
                        </div>

                        @include('components.forms.api.validate')
                    </div>
                  </div>
            </div>
        </div>
    </section>
@endsection
