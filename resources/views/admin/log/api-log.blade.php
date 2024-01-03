@extends('admin/layouts/layoutMaster')

@section('title', 'Gift Card Management')

@section('breadcrumb')
@section('content')
@include('admin._partials.alert')
<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Logs /</span> API
</h4>
@if ($dataProvider->isEmpty())
<div class="card">
    <div class="card-body">
        No record(s) found.
    </div>
</div>
@else
<div class="accordion accordion-margin" id="accordionMargin" data-toggle-hover="true">
    @php $index = $dataProvider->firstItem(); @endphp
    @foreach ($dataProvider as $key => $data)
    <div class="accordion-item card">
        <h2 class="accordion-header" id="headingMargin-{{ $key }}">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionMargin{{ $key }}" aria-expanded="false" aria-controls="accordionMargin{{ $key }}">
                #{{ $index + $key }}. <span class="w-75 mx-1">{{$data->title}}</span> <span class="fw-light mx-3"><i class="ti ti-calendar"></i> {{ $data->created_at }} <span class="badge bg-label-danger ">{{ $data->created_at->diffForHumans() }}</span></span>
            </button>
        </h2>
        <div id="accordionMargin{{ $key }}" class="accordion-collapse collapse" aria-labelledby="headingMargin{{ $key }}" data-bs-parent="#accordionMargin">
            <div class="accordion-body">
                <div class="row">
                    <div class="col-md-4 mb-1">
                        <div>Channel:</div>
                        <div>{{ $data->channel }}</div>
                        <div class="badge bg-light-primary">{{ $data->level_name }}</div>
                    </div>
                    <div class="col-md-4 mb-1">
                        <div>Message:</div>
                        <div>{{ $data->message }}</div>
                    </div>
                    <div class="col-md-4 mb-1">
                        <div>IP:</div>
                        <div>{{ $data->remote_addr }}</div>
                    </div>
                    <div class="col-12 mb-1">
                        <div>URL:</div>
                        <div class="word-wrap">{{ $data->url }}</div>
                    </div>
                    <div class="col-md-4 mb-1">
                        <div>Method:</div>
                        <div>{{ $data->method }}</div>
                    </div>
                    <div class="col-md-4 mb-1">
                        <div>Controller:</div>
                        <div>{{ $data->controller }}</div>
                    </div>
                    <div class="col-md-4 mb-1">
                        <div>Action:</div>
                        <div>{{ $data->action }}</div>
                    </div>
                    <div class="col-md-4 mb-1">
                        <div>Status Code:</div>
                        <div>{{ $data->status_code }}</div>
                    </div>
                    <div class="col-md-12 mb-1">
                        <div>Request Data:</div>
                        <code><pre class="word-wrap p-1">{{ json_encode(json_decode($data->request_data), JSON_PRETTY_PRINT) }}</pre></code>
                    </div>
                    <div class="col-md-12 mb-1">
                        <div>Response Data:</div>
                        <code><pre class="word-wrap p-1">{{ json_encode(json_decode($data->response_data), JSON_PRETTY_PRINT) }}</pre></code>
                    </div>
                    <div class="col-md-4">
                        <div>Context:</div>
                        <div>{{ $data->context }}</div>
                    </div>
                    <div class="col-md-4">
                        <div>Created At:</div>
                        <div>{{ $data->created_at->diffForHumans() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
{{ $dataProvider->appends(request()->query())->links('admin._partials.pagination') }}
@endif
@endsection