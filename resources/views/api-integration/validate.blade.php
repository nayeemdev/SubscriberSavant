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
                        <form class="form-card text-right mt-2" method="POST" action="{{ route('integration.validate') }}">
                            <div class="col-12">
                                <div class="form-group mb-2">
                                    <label for="api_key">API Key</label>
                                    <textarea name="api_key" id="api_key"
                                        class="form-control @error('api_key') is-invalid @enderror"
                                        rows="4"></textarea>
                                    @error('api_key')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-primary bg-mailerlite border-0 mt-2">
                                        Validate and Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                  </div>
            </div>
        </div>
    </section>
@endsection
