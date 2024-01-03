@extends('admin/layouts/layoutMaster')

@section('title', 'Client Management')
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
    <span class="text-muted fw-light">Clients /</span> Manage
</h4>

<!-- Basic Bootstrap Table -->
<div class="card">

    <div class="card-header">
        <div class="float-start">
            <h5>Clients</h5>

        </div>
        <div class="float-end">
            @can('admin-access-policy.perform', 'add-client')
            <a href="{{ route('admin.client.create') }}" class="add-new btn btn-primary mb-3 mb-md-0"> Add
                New</a>
            @endcan
            @can('admin-access-policy.perform', 'delete-client')
            <a href="{{ route('admin.client.trash') }}" class="add-new btn btn-danger mb-3 mb-md-0">
                Trash</a>
            @endcan

        </div>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th width="50">S.No.</th>
                    <th>Title</th>
                    <th width="80">Code</th>
                    <th width="120">Status</th>
                    <th width="80">Modified At</th>
                    <th class="text-center" width="180">Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @if($dataProvider->isEmpty())
                <tr>
                    <td colspan="6">No record(s) found.</td>
                </tr>
                @else
                @foreach ($dataProvider as $key => $data)
                <tr>
                    <td>{{ $dataProvider->firstItem() + $key }}</td>
                    <td><strong>{{ $data->title }}</strong></td>
                    <td>{{ $data?->code }}</td>
                    <td><span class="btn-status badge bg-label-{{ $data->status == 1 ? 'success' : 'danger' }} me-1" data-action="{{ route('admin.client.change-status', $data->uuid) }}" title="Change Status">{{ $data->active }}</span>
                    </td>
                    <td>{{ CommonHelper::dateFormat($data?->updated_at) }}</td>
                    <td class="text-center">
                        @can('admin-access-policy.perform', 'edit-client')
                        <a class="btn btn-icon btn-primary" href="{{ route('admin.client.edit', $data->uuid) }}"><i class="ti ti-pencil"></i></a>
                        @endcan
                        @can('admin-access-policy.perform', 'delete-client')
                        <a class="btn btn-icon btn-danger btn-delete" href="javascript:void(0);" data-action="{{ route('admin.client.destroy', $data->uuid) }}"><i class="ti ti-trash"></i>
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