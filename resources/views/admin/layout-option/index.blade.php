@extends('admin/layouts/layoutMaster')

@section('title', 'Layout Option')
@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/spinkit/spinkit.css') }}" />

@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/block-ui/block-ui.js') }}"></script>

@endsection

@section('page-script')
    <script src="{{ asset('assets/js/extended-ui-blockui.js') }}"></script>
    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/super-build/ckeditor.js"></script> --}}

@endsection
@section('content')
    @include('admin._partials.alert')

    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Layout Option /</span> Manages
    </h4>
    <form id="form" class="row g-3" method="POST" action="{{ route('admin.layout-option.store') }}"
        enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col">
                <div class="card mb-3">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" role="tablist">
                            <li class="nav-item">
                                <button type="button" class="nav-link active" data-bs-toggle="tab"
                                    data-bs-target="#form-tabs-personal" role="tab" aria-selected="true">
                                    General
                                </button>
                            </li>
                            @foreach ($options as $option)
                                @if ($option->type == 2)
                                    <li class="nav-item">
                                        <button type="button" class="nav-link" data-bs-toggle="tab"
                                            data-bs-target="#form-tabs-{{ $option->id }}" role="tab"
                                            aria-selected="false">
                                            {{ $option->title }}
                                        </button>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>

                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="form-tabs-personal" role="tabpanel">
                            <div class="row g-3">
                                @foreach ($options as $option)
                                    @if ($option->type == 1)
                                        <div class="col-md-12 mb-2">

                                            <label for="" class="form-label">{{ $option->title }}</label>

                                            <select name="{{ $option->id }}" class="form-control">
                                                <option value="">Select menu</option>
                                                @foreach ($menus as $menu)
                                                    <option value="{{ $menu->id }}"
                                                        {{ $menu->id == $option->menu_id ? 'selected' : '' }}>
                                                        {!! $menu->title !!}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                        </div>
                        @foreach ($options as $option)
                            @if ($option->type == 2)
                                <div class="tab-pane fade" id="form-tabs-{{ $option->id }}" role="tabpanel">
                                    <div class="col-md-12 mb-2">
                                        <label class="form-label" for="description{{ $option->id }}">Description</label>
                                        <textarea id="description{{ $option->id }}" class="form-control ckeditor" name="blocks[{{ $option->id }}]"
                                            id="ckeditor">{{ $option->value }}</textarea>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @can('admin-access-policy.perform', 'edit-layout-option')

            <div class="col-md-12 mb-2">

                <button type="submit" name="submitButton" class="btn btn-primary btn-page-block-custom">Submit</button>
            </div>
            @endif
        </form>

    @endsection
