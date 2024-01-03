@extends('admin/layouts/layoutMaster')

@section('title', 'Student Management')
@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
@endsection
@section('vendor-script')
@endsection
@section('page-script')
    <script src="{{ asset('assets/js/forms-selects.js') }}"></script>
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
        <span class="text-muted fw-light">Student /</span> Manages
    </h4>

    <!-- Basic Bootstrap Table -->
    <div class="card">
        <div class="card-header">
            <div class="float-start">
                <h5>List</h5>
            </div>
            {{-- <div class="float-end">
                @can('admin-access-policy.perform', 'add-student')
                    <a href="{{ route('admin.student.create') }}" class="add-new btn btn-primary mb-3 mb-md-0"> Add
                        New</a>
                @endcan
                @can('admin-access-policy.perform', 'delete-student')
                    <a href="{{ route('admin.student.trash') }}" class="add-new btn btn-danger mb-3 mb-md-0">
                        Trash</a>
                @endcan
            </div> --}}
        </div>
        <div class="card-header border-bottom">
            <form action="" method="get" class="row">
                <div class="col-md-3 mb-3">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ request()?->name }}">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="mobile">Mobile No.</label>
                    <input type="text" class="form-control" name="mobile" value="{{ request()?->mobile }}">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email" class="form-control"
                        value="{{ request()?->email }}">
                </div>
                <div class="col-md-3 mt-3">
                    <button type="submit" class="btn btn-success">Search</button>
                    <a href="{{ route('admin.student.index') }}" class="btn btn-primary">Reset</a>
                </div>
            </form>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>Name</th>
                        <th>Client</th>
                        <th>Subscriber ID</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th class="text-center" width="180">Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @if ($dataProvider->isEmpty())
                        <tr>
                            <td colspan="7">No record(s) found.</td>
                        </tr>
                    @else
                        @foreach ($dataProvider as $key => $data)
                            <tr>
                                <td>{{ $dataProvider->firstItem() + $key }}</td>
                                <td>{{ $data?->full_name }}</td>
                                <td>{{ $data?->client?->title }}</td>
                                <td>{{ $data?->subscriber_id }}</td>
                                <td>{{ $data?->mobile }}</td>
                                <td><strong>{{ $data->email }}</strong> </td>
                                <td><span
                                        class="btn-status badge bg-label-{{ $data->status == 1 ? 'success' : 'danger' }} me-1"
                                        data-action="{{ route('admin.student.change-status', $data->uuid) }}"
                                        title="Change Status">{{ $data->status == 1 ? 'Active' : 'Inactive' }}</span>
                                </td>
                                <td class="text-center">
                                    @can('admin-access-policy.perform', 'edit-student')
                                        <a class="btn btn-icon btn-primary"
                                            href="{{ route('admin.student.edit', $data->uuid) }}"><i
                                                class="ti ti-pencil"></i></a>
                                    @endcan
                                    @can('admin-access-policy.perform', 'delete-student')
                                        <a class="btn btn-icon btn-danger btn-delete" href="javascript:void(0);"
                                            data-action="{{ route('admin.student.destroy', $data->uuid) }}"><i
                                                class="ti ti-trash"></i>
                                        </a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    {{ $dataProvider->appends(request()->query())->links('admin._partials.pagination') }}

@endsection
