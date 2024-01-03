@php
    $configData = Helper::appClasses();
@endphp

@extends('admin/layouts/layoutMaster')

@section('title', 'Roles - Apps')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/spinkit/spinkit.css') }}" />

@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/block-ui/block-ui.js') }}"></script>

@endsection

@section('page-script')
    <script src="{{ asset('assets/js/extended-ui-blockui.js') }}"></script>

    {{-- <script>
        (function() {
            // On edit role click, update text
            var roleEditList = document.querySelectorAll('.role-edit-modal'),
                roleAdd = document.querySelector('.add-new-role'),
                roleTitle = document.querySelector('.role-title');

            roleAdd.onclick = function() {
                roleTitle.innerHTML = 'Add New Role'; // reset text
                document.querySelector('#modalRoleName').value = "";
                document.querySelector('#role-id').value = "";


            };
            if (roleEditList) {
                roleEditList.forEach(function(roleEditEl) {
                    roleEditEl.onclick = function() {
                        var roleId = roleEditEl.getAttribute("data-role-id");
                        document.querySelector('#role-id').value = roleId;

                        var title = roleEditEl.getAttribute("data-role-title");
                        document.querySelector('#modalRoleName').value = title;
                        roleTitle.innerHTML = 'Edit Role'; // reset text
                        var root = window.location.protocol + '//' + window.location.host;

                        var GET_PERMISSION_URL = root + '/system-user/get-role-permissions/' + roleId;

                        $.ajax({
                            url: GET_PERMISSION_URL,
                            method: "GET",
                            dataType: "json",
                            success: function(permissions) {
                                permissions.forEach(function(data) {
                                    $('#' + data).prop('checked', true);
                                })

                            },
                            error: function(xhr, status, error) {
                                console.error("Error:", status, error);
                            }
                        });

                    };
                });
            }
        })();
    </script>
    <script>
        /**
         * Add new role Modal JS
         */

        'use strict';

        document.addEventListener('DOMContentLoaded', function(e) {
            (function() {
                // add role form validation
                FormValidation.formValidation(document.getElementById('addRoleForm'), {
                    fields: {
                        modalRoleName: {
                            validators: {
                                notEmpty: {
                                    message: 'Please enter role name'
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
    </script> --}}
@endsection

@section('content')
    @include('admin._partials.alert')
    <h4 class="fw-semibold mb-4">Roles List</h4>

    <p class="mb-4">A role provided access to predefined menus and features so that depending on <br> assigned role an
        administrator can have access to what user needs.</p>
    <!-- Role cards -->
    <div class="row g-4">
        @foreach ($roles as $data)
            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h6 class="fw-normal mb-2">Total {{ $data->users->count() }} users</h6>
                            <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                @foreach ($data->users as $user)
                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                        title="{{ $user->full_name }}" class="avatar avatar-sm pull-up">
                                        @if ($user->avatar)
                                            <img class="rounded-circle" src="{{ asset('assets/img/avatars/5.png') }}"
                                                alt="Avatar">
                                        @else
                                            @php
                                                $states = ['success', 'danger', 'warning', 'info', 'primary', 'secondary'];
                                                $words = explode(' ', $user->full_name);
                                                $firstLetters = array_map(function ($word) {
                                                    return substr($word, 0, 1); // Get the first letter of each word
                                                }, $words);
                                                $initials = implode('', $firstLetters);
                                            @endphp
                                            <span
                                                class="avatar-initial rounded-circle bg-label-{{ $states[array_rand($states)] }}">{{ strlen($initials) > 2  ? substr($initials, 0, 2) : $initials }}</span>
                                        @endif

                                    </li>
                                @endforeach

                            </ul>
                        </div>
                        @can('admin-access-policy.perform', 'edit-role')
                            <div class="d-flex justify-content-between align-items-end mt-1">
                                <div class="role-heading">
                                    <h4 class="mb-1">{{ $data->title }}</h4>
                                    <a href="{{route('admin.role.edit',$data->uuid)}}"><span>Edit Role</span></a>
                                </div>
                                {{-- <a href="javascript:void(0);" class="text-muted"><i class="ti ti-copy ti-md"></i></a> --}}
                            </div>
                        @endcan
                    </div>
                </div>
            </div>
        @endforeach
        @can('admin-access-policy.perform', 'add-role')
            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card h-100">
                    <div class="row h-100">
                        <div class="col-sm-5">
                            <div class="d-flex align-items-end h-100 justify-content-center mt-sm-0 mt-3">
                                <img src="{{ asset('assets/img/illustrations/add-new-roles.png') }}"
                                    class="img-fluid mt-sm-4 mt-md-0" alt="add-new-roles" width="83">
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="card-body text-sm-end text-center ps-sm-0">
                                <a href="{{route('admin.role.create')}}"
                                    class="btn btn-primary mb-2 text-nowrap add-new-role">Add New Role</a>
                                <p class="mb-0 mt-1">Add role, if it does not exist</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endcan
    </div>
    <!--/ Role cards -->

    <!-- Add Role Modal -->
    {{-- @include('admin/_partials/_modals/modal-add-role') --}}
    <!-- / Add Role Modal -->
@endsection
