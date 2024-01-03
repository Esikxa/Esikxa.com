@extends('admin/layouts/layoutMaster')

@section('title', 'Coupon Management')
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
    <span class="text-muted fw-light">Coupons /</span> Manage
</h4>

<!-- Basic Bootstrap Table -->
<div class="card">

    <div class="card-header">
        <div class="float-start">
            <h5>Coupons</h5>

        </div>
        <div class="float-end">
            @can('admin-access-policy.perform', 'add-coupon')
            <a href="{{ route('admin.coupon.create') }}" class="add-new btn btn-primary mb-3 mb-md-0"> Add
                New</a>
            @endcan
            @can('admin-access-policy.perform', 'delete-coupon')
            <a href="{{ route('admin.coupon.trash') }}" class="add-new btn btn-warning mb-3 mb-md-0">
                Trash</a>
            @endcan

        </div>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th width="50">S.No.</th>
                    <th>client</th>
                    <th>Code</th>
                    <th>Assign To</th>
                    <th>Validity</th>
                    <th>Discount Type</th>
                    <th>Discount Value</th>
                    <th>Status</th>
                    <th class="text-center" width="180">Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @if($dataProvider->isEmpty())
                <tr>
                    <td colspan="9">No record(s) found.</td>
                </tr>
                @else
                @foreach ($dataProvider as $key => $data)
                <tr>
                    <td>{{ $dataProvider->firstItem() + $key }}</td>
                    <td>{{ ucfirst($data?->client?->title) }}</td>
                    <td><strong>{{ $data->code }}</strong></td>
                    <td>
                        @if (empty($data->users))
                        <i class="ti ti-minus"></i>
                        @else
                        @foreach ($data->users as $user)
                        <span class="badge bg-label-info">{{ $user?->full_name }}</span>
                        @endforeach
                        @endif
                    </td>
                    <td>{{ $data->start_date_time }} <i class="ti ti-minus"></i>

                        {{ $data->end_date_time }}
                    </td>
                    <td>{{ $data->discount_type == 1 ? 'Flat' : 'Percentage' }}</td>
                    <td>
                        {{ $data->discount_type == 1 ? 'NPR ' : '' }}{{ $data->discount_value }}{{ $data->discount_type == 1 ? '' : '%' }}
                    </td>

                    <td><span class="btn-status badge bg-label-{{ $data->status == 1 ? 'success' : 'danger' }} me-1" data-action="{{ route('admin.coupon.change-status', $data->uuid) }}" title="Change Status">{{ $data->status == 1 ? 'Active' : 'Inactive' }}</span>
                    </td>
                    <td class="text-center">
                        @can('admin-access-policy.perform', 'edit-coupon')
                        <a class="btn btn-icon btn-primary" href="{{ route('admin.coupon.edit', $data->uuid) }}"><i class="ti ti-pencil"></i></a>
                        @endcan
                        @can('admin-access-policy.perform', 'delete-coupon')
                        @if (empty($data->user_id))
                        <a class="btn btn-icon btn-danger btn-delete" href="javascript:void(0);" data-action="{{ route('admin.coupon.destroy', $data->uuid) }}"><i class="ti ti-trash"></i>
                        </a>
                        @else
                        <i class="ti ti-minus"></i>
                        @endif
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