@extends('admin/layouts/layoutMaster')

@section('title', 'Role Management')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/spinkit/spinkit.css') }}" />

@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/block-ui/block-ui.js') }}"></script>

@endsection

@section('page-script')
    <script src="{{ asset('assets/js/extended-ui-blockui.js') }}"></script>

    <script>
        /**
         * Add new role Modal JS
         */

        'use strict';

        document.addEventListener('DOMContentLoaded', function(e) {
            (function() {
                // add role form validation
                FormValidation.formValidation(document.getElementById('form'), {
                    fields: {
                        title: {
                            validators: {
                                notEmpty: {
                                    message: 'Please enter role title'
                                }
                            }
                        }
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        bootstrap5: new FormValidation.plugins.Bootstrap5({
                            // Use this for enabling/changing valid/invalid class
                            // eleInvalidClass: '',
                            eleValidClass: '',
                            rowSelector: '.col-12'
                        }),
                        submitButton: new FormValidation.plugins.SubmitButton(),
                        // Submit the form when all fields are valid
                        defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                        autoFocus: new FormValidation.plugins.AutoFocus()
                    }
                });

                // Select All checkbox click
                const selectAll = document.querySelector('#selectAll'),
                    checkboxList = document.querySelectorAll('[type="checkbox"]');
                selectAll.addEventListener('change', t => {
                    checkboxList.forEach(e => {
                        e.checked = t.target.checked;
                    });
                });
            })();
        });
    </script>
@endsection

@section('content')
    @include('admin._partials.alert')

    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Role /</span> Edit
    </h4>
    <div class="row">
        <!-- FormValidation -->
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <form id="form" class="row g-3" method="POST"
                        action="{{ route('admin.role.update', $model->uuid) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="col-md-12 mb-2">
                            <label class="form-label" for="title">Role Title</label>
                            <input type="text" id="title" class="form-control" name="title"
                                value="{{ old('title', $model->title) }}" readonly />
                        </div>

                        <div class="col-md-12 mb-2">
                            <h5>Permissions</h5>
                            <!-- Permission table -->
                            <div class="table-responsive">
                                <table class="table table-flush-spacing">
                                    <tbody>
                                        <tr>
                                            <td class="text-nowrap fw-semibold">Administrator Access <i
                                                    class="ti ti-info-circle" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Allows a full access to the system"></i>
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="selectAll" />
                                                    <label class="form-check-label" for="selectAll">
                                                        Select All
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                        @foreach ($modules as $module)
                                            <tr>
                                                <td class="text-nowrap fw-semibold">{{ $module->title }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        @foreach ($module->permissions as $permission)
                                                            <div class="form-check me-3 me-lg-5">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="permissions[]" id="{{ $permission->uuid }}"
                                                                    value="{{ $permission->id }}"
                                                                    {{ in_array($permission->id, $permissions) ? 'checked' : '' }} />
                                                                <label class="form-check-label"
                                                                    for="{{ $permission->uuid }}">
                                                                    {{ $permission->title }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- Permission table -->
                        </div>
                        <div class="col-md-12 mb-2">
                            <div class="form-check form-switch mb-2">
                                <input type="checkbox" name="status" class="form-check-input" id="status"
                                    value="{{ ConstantHelper::STATUS_ACTIVE }}"
                                    {{ old('status', $model->status) == ConstantHelper::STATUS_ACTIVE ? 'checked' : '' }}>
                                <label class="form-check-label" for="status">Active ?</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" name="submitButton"
                                class="btn btn-primary btn-page-block-custom">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /FormValidation -->
    </div>
@endsection
