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
        <span class="text-muted fw-light">Site Setting /</span> Manages
    </h4>
    <form id="form" class="row g-3" method="POST" action="{{ route('admin.site-setting.store') }}"
        enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col">
                <div class="card mb-3">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" role="tablist">
                            <li class="nav-item">
                                <button type="button" class="nav-link active" data-bs-toggle="tab"
                                    data-bs-target="#form-tabs-general" role="tab" aria-selected="true">
                                    General
                                </button>
                            </li>
                        </ul>
                    </div>

                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="form-tabs-general" role="tabpanel">
                            <div class="row g-3">
                                @foreach (\App\Models\SiteSetting::SETTINGS as $key => $setting)
                                    @if ($setting['type'] == 'general')
                                        <input type="hidden" name="settings[{{ $key }}][title]"
                                            value="{{ $setting['title'] }}">
                                        <input type="hidden" name="settings[{{ $key }}][type]"
                                            value="{{ $setting['type'] }}">
                                        <input type="hidden" name="settings[{{ $key }}][slug]"
                                            value="{{ $setting['slug'] }}">
                                        <input type="hidden" name="settings[{{ $key }}][form-type]"
                                            value="{{ $setting['form-type'] }}">
                                        @if ($setting['form-type'] == 'file')
                                            <div class="col-md-6 mb-2">
                                                <label class="form-label" for="">{{ $setting['title'] }}</label>
                                                <div class="row">
                                                    <div
                                                        class="{{ isset($settings[$setting['slug']]) ? 'col-md-9' : 'col-md-12' }}">
                                                        <input type="file" id="" class="form-control"
                                                            placeholder="{{ $setting['title'] }}"
                                                            name="settings[{{ $key }}][value]" />
                                                    </div>
                                                    @if (isset($settings[$setting['slug']]))
                                                        <div class="col-md-3">

                                                            <a href="{{ asset('storage/' . $settings[$setting['slug']]) }}"
                                                                class="btn btn-label-info" target="_blank">PREVIEW</a>
                                                        </div>
                                                    @endif
                                                </div>

                                            </div>
                                        @elseif ($setting['form-type'] == 'select')
                                            <div class="col-sm-6">
                                                <label class="form-label"
                                                    for="{{ $setting['slug'] }}">{{ $setting['title'] }}</label>
                                                <select class="selectpicker w-auto" id="{{ $setting['slug'] }}"
                                                    data-style="btn-default" data-icon-base="ti"
                                                    data-tick-icon="ti-check text-white"
                                                    name="settings[{{ $key }}][value]">
                                                    @foreach ($setting['options'] as $select => $option)
                                                        <option
                                                            {{ isset($settings[$setting['slug']]) && $settings[$setting['slug']] == $select ? 'selected' : '' }}
                                                            value="{{ $select }}">{{ $option }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @else
                                            <div class="col-md-6 mb-2">
                                                <label class="form-label" for="">{{ $setting['title'] }}</label>
                                                <input type="text" id="" class="form-control"
                                                    placeholder="{{ $setting['title'] }}"
                                                    name="settings[{{ $key }}][value]"
                                                    value="{{ isset($settings[$setting['slug']]) ? $settings[$setting['slug']] : '' }}" />
                                            </div>
                                        @endif
                                    @endif
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        @can('admin-access-policy.perform', 'edit-site-setting')
            <div class="col-md-12 mb-2">

                <button type="submit" name="submitButton" class="btn btn-primary btn-page-block-custom">Submit</button>
            </div>
        @endcan
    </form>

@endsection
