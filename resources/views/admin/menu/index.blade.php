@extends('admin/layouts/layoutMaster')

@section('title', 'Menu Management')
@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
@endsection
@section('vendor-script')
@endsection
@section('page-script')
    <script>
        $('.btn-status').on('click', function(e) {
            e.preventDefault();
            var obj = $(this);
            var url = $(this).data('action');
            Swal.fire({
                title: 'Are you sure?',
                text: 'You want to change status!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, continue!',
                cancelButtonText: 'No, keep it.'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "GET",
                        url: url,
                        'dataType': 'json',
                        success: function(response) {
                            if (response.status == 0) {
                                Swal.fire({
                                    title: 'Success',
                                    text: response.message,
                                    icon: 'success',
                                    timer: 2000
                                });
                                if (response.data == true) {
                                    obj.text('Active');
                                    obj.removeClass('bg-label-danger');
                                    obj.addClass('bg-label-success');
                                } else {
                                    obj.text('Inactive');
                                    obj.removeClass('bg-label-success');
                                    obj.addClass('bg-label-danger');
                                }
                            }
                            if (response.status == 1) {
                                Swal.fire({
                                    title: 'Error',
                                    text: response.message,
                                    icon: 'error',
                                    timer: 2000
                                });
                            }

                        },
                        error: function(e) {
                            if (e.responseJSON.message) {
                                Swal('Error', e.responseJSON.message, 'error');
                            } else {
                                Swal('Error',
                                    'Something went wrong while processing your request.',
                                    'error')
                            }
                        }
                    });
                }
            });
        });
        $('.btn-delete').on('click', function(e) {

            e.preventDefault();
            var obj = $(this);
            var url = $(this).data('action');
            Swal.fire({
                title: 'Are you sure?',
                text: 'You want to delete this record!',
                icon: 'warning',
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonText: 'Yes, continue!',
                cancelButtonText: 'No, keep it.'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            _method: 'DELETE'
                        },
                        'dataType': 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.status == 0) {
                                Swal.fire({
                                    title: 'Success',
                                    text: response.message,
                                    icon: 'success',
                                    timer: 3000
                                });
                                window.location.reload();
                            }
                            if (response.status == 1) {
                                Swal.fire({
                                    title: 'Error',
                                    text: response.message,
                                    icon: 'error',
                                    timer: 3000
                                });
                            }

                        },
                        error: function(e) {
                            if (e.responseJSON.message) {
                                Swal('Error', e.responseJSON.message, 'error');
                            } else {
                                Swal('Error',
                                    'Something went wrong while processing your request.',
                                    'error')
                            }
                        }
                    });
                }
            });
        });
    </script>


@endsection
@section('content')
    @include('admin._partials.alert')

    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Menu /</span> Manages
    </h4>

    <!-- Basic Bootstrap Table -->
    <div class="card">
        <div class="card-header">
            <div class="float-start">
                <h5>List</h5>

            </div>
            <div class="float-end">
                @can('admin-access-policy.perform', 'add-menu')
                    <a href="{{ route('admin.menu.create') }}" class="add-new btn btn-primary mb-3 mb-md-0"> Add
                        New</a>
                @endcan

            </div>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>S.N</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($dataProvider as $key => $data)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td><strong>{{ $data->title }}</strong></td>
                            <td><span class="btn-status badge bg-label-{{ $data->status == 1 ? 'success' : 'danger' }} me-1"
                                    data-action="{{ route('admin.menu.change-status', $data->uuid) }}"
                                    title="Change Status">{{ $data->active }}</span>
                            </td>
                            <td>
                                <a href="{{ route('admin.menu.menu-item.index', ['menu' => $data->uuid]) }}"
                                    class="btn btn-icon btn-secondary"><i
                                    class="ti ti-list"></i></a>
                                @can('admin-access-policy.perform', 'edit-menu')
                                    <a class="btn btn-icon btn-primary" href="{{ route('admin.menu.edit', $data->uuid) }}"><i
                                            class="ti ti-pencil"></i></a>
                                @endcan
                                @can('admin-access-policy.perform', 'delete-menu')
                                    <a class="btn btn-icon btn-danger btn-delete" href="javascript:void(0);"
                                        data-action="{{ route('admin.menu.destroy', $data->uuid) }}"><i
                                            class="ti ti-trash"></i>
                                    </a>
                                @endcan

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9">No record(s) found.</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>



        </div>

    </div>
    {{ $dataProvider->appends(request()->query())->links('admin._partials.pagination') }}

@endsection
