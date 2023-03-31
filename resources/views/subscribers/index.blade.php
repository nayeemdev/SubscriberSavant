@extends('layouts.master')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/library/datatables/dataTables.css') }}" />
@endpush

@section('content')
    <section class="h-100 container">
        <div class="row h-100 my-5">
            <div class="col-md-12">
                <div class="card my-5">
                    <div class="card-body bg-light p-5">
                        <div class="d-flex justify-content-between">
                            <h3>Subscribers</h3>
                            <a href="{{ route('subscribers.create') }}" class="btn btn-success bg-mailerlite border-0 py-2">Add subscriber</a>
                        </div>
                        <div class="mt-3 table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                  <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Country</th>
                                    <th scope="col">Subscribe date</th>
                                    <th scope="col">Subscribe time</th>
                                    <th scope="col">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>Mark</td>
                                    <td>
                                        <a href="/edit" class="text-decoration-none">mail12@f.co</a>
                                    </td>
                                    <td>Bangladesh</td>
                                    <td>2021-09-01</td>
                                    <td>12:00:00</td>
                                    <td>
                                        <a href="/edit" class="btn btn-sm btn-success bg-mailerlite border-0 py-1">Edit</a>
                                        <a href="/delete" class="btn btn-sm btn-danger border-0 py-1">Delete</a>
                                    </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                  </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('assets/library/datatables/dataTables.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('.table').DataTable();
        } );
    </script>
@endpush
