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
                            <a href="{{ route('subscribers.create') }}"
                               class="btn btn-success bg-mailerlite border-0 py-2">Add subscriber</a>
                        </div>
                        <div class="mt-3 table-responsive">
                            <table class="table table-hover" id="subscriber-table">
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
        let subscribersDatatable = $ ('#subscriber-table').dataTable ({
            "ordering": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{ route('subscribers.json') }}",
                "dataType": "json",
                "type": "GET"
            },
            "columns": [
                {"data": "name"},
                {"data": "email"},
                {"data": "country"},
                {"data": "subscribe_date"},
                {"data": "subscribe_time"},
                {"data": "actions"},
            ],
            "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],
            stateSave: false,
            "language": {
                "infoEmpty": "No subscribers available",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "Search:",
                "searchPlaceholder": "Email...",
            },
        });

        $ ('.data-table-search-input-text').on ('keyup change', function () {
            let inputElement = $ (this);

            setTimeout (function () {
                let i = inputElement.attr('data-column');
                let v = inputElement.val();
                subscribersDatatable.api().columns(i).search(v).draw();
            }, 1500);
        });

        $(document).on('click', '.delete', function (e) {
            e.preventDefault();
            let btn = $(this);
            btn.text('Deleting...').attr('disabled', true);
            let subscriberId = $(this).data('subscriber_id');

            $.ajax({
                url: '/subscribers/' + subscriberId,
                type: 'DELETE',
                success: function (response) {
                    if (response.success === true) {
                        subscribersDatatable.api().ajax.reload();
                        toastr.success(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                    btn.text('Delete').attr('disabled', false);
                }
            });
        });
    </script>
@endpush
