@extends('admin/layouts/layoutMaster')

@section('title', 'Service Module Management')
@section('vendor-style')
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
@endsection
@section('vendor-script')
@endsection
@section('page-script')
<script>
    $('.btn-restore').on('click', function(e) {
        e.preventDefault();
        var obj = $(this);
        var url = $(this).data('action');
        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to restore this record!',
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
                            window.location.reload();
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
            text: 'You want to delete this record permanently!',
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
                            window.location.reload();
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
</script>


@endsection
@section('content')
@include('admin._partials.alert')

<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Service Modules /</span> Trash
</h4>

<!-- Basic Bootstrap Table -->
<div class="card">
    <div class="card-header">
        <div class="float-start">
            <h5>Service Modules</h5>

        </div>
        <div class="float-end">
            <a href="{{ route('admin.service-module.index') }}" class="add-new btn btn-primary mb-3 mb-md-0">
                Go Back</a>

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
                    <td>No record(s) found.</td>
                </tr>
                @else
                @foreach ($dataProvider as $key => $data)
                <tr>
                    <td>{{ $dataProvider->firstItem() + $key }}</td>
                    <td>{{ $data->title }}</td>
                    <td>{{ $data?->code }}</td>
                    <td><span class="badge bg-label-{{ $data->status == 1 ? 'success' : 'danger' }} me-1">{{ $data->active }}</span></td>
                    <td>{{ CommonHelper::dateFormat($data->updated_at) }}</td>
                    <td class="text-center">
                        <a class="btn btn-icon btn-primary btn-restore" data-action="{{ route('admin.service-module.restore', $data->uuid) }}" href="#" title="Restore"><i class="ti ti-refresh-alert"></i></a>
                        <a class="btn btn-icon btn-danger btn-delete" data-action="{{ route('admin.service-module.force-delete', $data->uuid) }}" href="#" title="Restore"><i class="ti ti-trash"></i></a>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
    {{ $dataProvider->appends(request()->query())->links('admin._partials.pagination') }}
</div>
<!--/ Basic Bootstrap Table -->


@endsection