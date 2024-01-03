@extends('admin/layouts/layoutMaster')

@section('title', 'Gift Card Management')
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
    <span class="text-muted fw-light">Gift Cards /</span> Manage
</h4>

<!-- Basic Bootstrap Table -->
<div class="card">

    <div class="card-header">
        <div class="float-start">
            <h5>Gift Cards</h5>

        </div>
        <div class="float-end">
            @can('admin-access-policy.perform', 'add-coupon')
            <a href="{{ route('admin.gift-card.create') }}" class="add-new btn btn-primary mb-3 mb-md-0"> Add
                New</a>
            @endcan
            @can('admin-access-policy.perform', 'delete-coupon')
            <a href="{{ route('admin.gift-card.trash') }}" class="add-new btn btn-danger mb-3 mb-md-0">
                Trash</a>
            @endcan

        </div>
    </div>
    <div class="card-header border-bottom">
        <form action="" method="get" class="row">
            <div class="col-md-3 mb-3">
                <label for="code">Code</label>
                <input type="text" class="form-control" name="code" value="{{ request()?->code }}">
            </div>
            <div class="col-md-3 mb-3">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" value="{{ request()?->name }}">
            </div>
            <div class="col-md-3 mb-3">
                <label for="from">From</label>
                <input type="date" name="from" id="from" class="form-control" value="{{ request()?->from }}">
            </div>
            <div class="col-md-3 mb-3">
                <label for="till">Till</label>
                <input type="date" name="till" id="till" class="form-control" value="{{ request()?->till }}">
            </div>
            <div class="col-md-3 mb-3">
                <label for="Client">Client</label>
                <select name="client" id="" class="form-select select2">
                    <option value="">All</option>
                    @if(isset($clients) && !empty($clients))
                    @foreach($clients as $client)
                    <option value="{{ $client?->slug }}" {{ request()->client == $client?->slug || session()->get('client-ID') == $client?->id ? 'selected' : '' }}>{{ $client?->title }}</option>
                    @endforeach
                    @endif
                </select>
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-success">Search</button>
                <a href="{{ route('admin.gift-card.index') }}" class="btn btn-primary">Reset</a>
            </div>
        </form>
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
                    <th>Value (NPR)</th>
                    <th>Status</th>
                    <th>Date</th>
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
                    <td><span class="badge bg-label-info w-100">{{ $data->code }}</span></td>
                    <td>
                        @if (empty($data->users))
                        <i class="ti ti-minus"></i>
                        @else
                        @foreach ($data->users as $user)
                        <div>{{ $user?->full_name }}</div>
                        <div><a href="tel:{{ $user?->mobile }}">{{ $user?->mobile }}</a></div>
                        <div class=""><a href="mailto:{{ $user?->email }}">{{ $user?->email }}</a></div>
                        @endforeach
                        @endif
                    </td>
                    <td>
                        <div class="mb-1">{{ $data->discount_type == 1 ? 'Flat' : 'Percentage' }}</div>
                        <div class="mb-1">{{ CommonHelper::dateFormat($data->start_date_time, 21) }}</div>
                        {{ CommonHelper::dateFormat($data->end_date_time, 21) }}
                    </td>
                    <td>
                        <div class="mb-1">{{ $data->discount_type == 1 ? 'NPR ' : '' }}{{ $data->discount_value }}{{ $data->discount_type == 1 ? '' : '%' }}</div>
                        <div class="badge bg-label-info">Claimed: {{ $data?->usedCouponValue($data?->id) ?? 0 }}</div>
                    </td>

                    <td><span class="btn-status badge bg-label-{{ $data->status == 1 ? 'success' : 'danger' }} me-1" data-action="{{ route('admin.gift-card.change-status', $data->uuid) }}" title="Change Status">{{ $data->status == 1 ? 'Active' : 'Inactive' }}</span>
                    </td>
                    <td>
                        <div class="mb-1"><span class="badge bg-label-primary w-100">Created: {{ CommonHelper::dateFormat($data->created_at, 21) }}</span></div>
                        <div class=""><span class="badge bg-label-info w-100">Modified: {{ CommonHelper::dateFormat($data->updated_at, 21) }}</span></div>
                    </td>
                    <td class="text-center">
                        @can('admin-access-policy.perform', 'edit-coupon')
                        <a class="btn btn-icon btn-primary" href="{{ route('admin.gift-card.edit', $data->uuid) }}"><i class="ti ti-pencil"></i></a>
                        @endcan
                        @can('admin-access-policy.perform', 'delete-coupon')
                        @if (empty($data->user_id))
                        <a class="btn btn-icon btn-danger btn-delete" href="javascript:void(0);" data-action="{{ route('admin.gift-card.destroy', $data->uuid) }}"><i class="ti ti-trash"></i>
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