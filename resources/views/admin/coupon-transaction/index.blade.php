@extends('admin/layouts/layoutMaster')

@section('title', 'Transaction Management')
@section('vendor-style')

@endsection
@section('vendor-script')
@endsection
@section('page-script')

@endsection
@section('content')
@include('admin._partials.alert')

<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Transactions /</span> Manage
</h4>

<!-- Basic Bootstrap Table -->
<div class="card">
    <div class="card-header">
        <div class="float-start">
            <h5>Transactions</h5>
        </div>
        <div class="float-end">

        </div>
    </div>
    <div class="card-header border-bottom">
        <form action="" method="get" class="row">
            <div class="col-md-3 mb-3">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" value="{{ request()?->name }}">
            </div>
            <div class="col-md-3 mb-3">
                <label for="">Code</label>
                <input type="text" class="form-control" name="code" value="{{ request()?->code }}">
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-success">Search</button>
                <a href="{{ route('admin.transaction.index') }}" class="btn btn-primary">Reset</a>
            </div>
        </form>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th width="50">S.No.</th>
                    <th>Code</th>
                    <th>User</th>
                    <th>Amount</th>
                    <th>Created At</th>
                    <th>Status</th>
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
                    <td><span class="badge bg-label-info w-100">{{ $data?->coupon?->code }}</span></td>
                    <td>{{ $data?->user?->getFullNameAttribute() }}</td>
                    <td>{{ $data?->amount ?? 0 }}</td>
                    <td>{{ CommonHelper::dateFormat($data?->created_at, 21) }}</td>
                    <td><span class="btn-status badge bg-label-{{ $data->status == 1 ? 'success' : 'danger' }} me-1" data-action="{{ route('admin.coupon.change-status', $data->uuid) }}" title="Change Status">{{ $data->status == 1 ? 'Claimed' : 'Unclaimed' }}</span>
                    </td>
                    <td class="text-center">

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