@extends('admin/layouts/layoutMaster')
@section('title', 'Manage - ' . $menu->title)
@section('page-style')
    <style>
        .dd {
            position: relative;
            display: block;
            margin: 0;
            padding: 0;
            max-width: 600px;
            list-style: none;
            font-size: 13px;
            line-height: 20px;
        }

        .dd-list {
            display: block;
            position: relative;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .dd-list .dd-list {
            padding-left: 30px;
        }

        .dd-collapsed .dd-list {
            display: none;
        }

        .dd-item,
        .dd-empty,
        .dd-placeholder {
            display: block;
            position: relative;
            margin: 0;
            padding: 0;
            min-height: 20px;
            font-size: 13px;
            line-height: 20px;
        }

        .dd-handle {
            display: block;
            height: 30px;
            margin: 5px 0;
            padding: 5px 10px;
            color: #333;
            text-decoration: none;
            font-weight: bold;
            border: 1px solid #ccc;
            background: #fafafa;
            background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
            background: -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
            background: linear-gradient(top, #fafafa 0%, #eee 100%);
            -webkit-border-radius: 3px;
            border-radius: 3px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .dd-handle:hover {
            color: #2ea8e5;
            background: #fff;
        }

        .dd-item>button {
            display: block;
            position: relative;
            cursor: pointer;
            float: left;
            width: 25px;
            height: 20px;
            margin: 5px 0;
            padding: 0;
            text-indent: 100%;
            white-space: nowrap;
            overflow: hidden;
            border: 0;
            background: transparent;
            font-size: 12px;
            line-height: 1;
            text-align: center;
            font-weight: bold;
        }

        .dd-item>button:before {
            content: '+';
            display: block;
            position: absolute;
            width: 100%;
            text-align: center;
            text-indent: 0;
        }

        .dd-item>button[data-action="collapse"]:before {
            content: '-';
        }

        .dd-placeholder,
        .dd-empty {
            margin: 5px 0;
            padding: 0;
            min-height: 30px;
            background: #f2fbff;
            border: 1px dashed #b6bcbf;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .dd-empty {
            border: 1px dashed #bbb;
            min-height: 100px;
            background-color: #e5e5e5;
            background-image: -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
                -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
            background-image: -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
                -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
            background-image: linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
                linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
            background-size: 60px 60px;
            background-position: 0 0, 30px 30px;
        }

        .dd-dragel {
            position: absolute;
            pointer-events: none;
            z-index: 9999;
        }

        .dd-dragel>.dd-item .dd-handle {
            margin-top: 0;
        }

        .dd-dragel .dd-handle {
            -webkit-box-shadow: 2px 4px 6px 0 rgba(0, 0, 0, .1);
            box-shadow: 2px 4px 6px 0 rgba(0, 0, 0, .1);
        }

        .nestable-lists {
            display: block;
            clear: both;
            padding: 30px 0;
            width: 100%;
            border: 0;
            border-top: 2px solid #ddd;
            border-bottom: 2px solid #ddd;
        }

        #nestable-menu {
            padding: 0;
            margin: 0;
        }

        #nestable-output,
        #nestable2-output {
            width: 100%;
            height: 7em;
            font-size: 0.75em;
            line-height: 1.333333em;
            font-family: Consolas, monospace;
            padding: 5px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        #nestable2 .dd-handle {
            color: #fff;
            border: 1px solid #999;
            background: #bbb;
            background: -webkit-linear-gradient(top, #bbb 0%, #999 100%);
            background: -moz-linear-gradient(top, #bbb 0%, #999 100%);
            background: linear-gradient(top, #bbb 0%, #999 100%);
        }

        #nestable2 .dd-handle:hover {
            background: #bbb;
        }

        #nestable2 .dd-item>button:before {
            color: #fff;
        }

        @media only screen and (min-width: 700px) {
            .dd {
                float: left;
                width: 80%;
            }

            .dd+.dd {
                margin-left: 2%;
            }
        }

        .dd-hover>.dd-handle {
            background: #2ea8e5 !important;
        }

        .dd3-content {
            display: block;
            height: 30px;
            margin: 5px 0;
            padding: 5px 10px 5px 40px;
            color: #333;
            text-decoration: none;
            font-weight: bold;
            border: 1px solid #ccc;
            background: #fafafa;
            background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
            background: -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
            background: linear-gradient(top, #fafafa 0%, #eee 100%);
            -webkit-border-radius: 3px;
            border-radius: 3px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .dd3-content:hover {
            color: #2ea8e5;
            background: #fff;
        }

        .dd-dragel>.dd3-item>.dd3-content {
            margin: 0;
        }

        .dd3-item>button {
            margin-left: 30px;
        }

        .dd3-handle {
            position: absolute;
            margin: 0;
            left: 0;
            top: 0;
            cursor: pointer;
            width: 30px;
            text-indent: 100%;
            white-space: nowrap;
            overflow: hidden;
            border: 1px solid #aaa;
            background: #ddd;
            background: -webkit-linear-gradient(top, #ddd 0%, #bbb 100%);
            background: -moz-linear-gradient(top, #ddd 0%, #bbb 100%);
            background: linear-gradient(top, #ddd 0%, #bbb 100%);
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }

        .dd3-handle:before {
            content: '≡';
            display: block;
            position: absolute;
            left: 0;
            top: 3px;
            width: 100%;
            text-align: center;
            text-indent: 0;
            color: #fff;
            font-size: 20px;
            font-weight: normal;
        }

        .dd3-handle:hover {
            background: #ddd;
        }

        .edit-wrap {
            position: absolute;
            top: 0;
            left: 101%;
        }

        .delete-wrap {
            position: absolute;
            top: 0;
            left: 107%;
        }
    </style>
@endsection
@section('page-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Nestable/2012-10-15/jquery.nestable.min.js"
        integrity="sha512-a3kqAaSAbp2ymx5/Kt3+GL+lnJ8lFrh2ax/norvlahyx59Ru/1dOwN1s9pbWEz1fRHbOd/gba80hkXxKPNe6fg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(function() {
            var updateOutput = function(e) {
                var list = e.length ? e : $(e.target),
                    output = list.data('output');
                $.ajax({
                    method: "POST",
                    url: "{{ route('admin.menu.menu-item.sort', $menu->id) }}",
                    data: {
                        list: list.nestable('serialize')
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                }).done(function() {
                    Swal.fire({
                        title: "Success!",
                        text: "Menu list has been sorted.",
                        timer: 2000,
                        icon: 'success',
                        showConfirmButton: false
                    });
                });
            };

            $('.dd').nestable({
                'serialize': true,
                'maxDepth': 1,
                'includeContent': true
            }).on('change', updateOutput);
            $('.remove-item').on('click', function() {
                $object = $(this);
                var id = $object.closest('li').data('id');
                var menu = "{{ $menu->id }}";
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You will not be able to recover this !',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, keep it'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            type: "POST",
                            url: baseUrl + "/system-user/menu/" + menu + "/menu-item/" + id,
                            data: {
                                id: id,
                                _method: 'DELETE'
                            },
                            success: function(response) {
                                Swal.fire("Deleted!", response.message, "success");
                                $object.closest('li').remove();
                            },
                            error: function(e) {
                                console.log(e);
                                if (e.responseJSON.message) {
                                    Swal.fire('Error', e.responseJSON.message, 'error');
                                } else {
                                    Swal.fire('Error',
                                        'Something went wrong while processing your request.',
                                        'error')
                                }
                            }
                        });
                    }
                });
            });

        });
    </script>
@endsection

@section('content')
    @include('admin._partials.alert')

    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Menu /</span> Manages
    </h4>
    <div class="row">
        <div class="col-md-4">
            <section id="accordion-hover">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add Menu Items</h4>
                            </div>
                            <div class="card-body">
                                <div class="accordion" id="accordionHover" data-toggle-hover="true">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingHoverOne">
                                            <button class="accordion-button collapsed accordion-hover-title" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#contentAccordion"
                                                aria-expanded="false" aria-controls="contentAccordion">
                                                Contents
                                            </button>
                                        </h2>
                                        <div id="contentAccordion" class="accordion-collapse collapse"
                                            aria-labelledby="headingHoverOne" data-bs-parent="#accordionHover">
                                            <div class="accordion-body">
                                                <form action="{{ route('admin.menu.menu-item.store', $menu->uuid) }}"
                                                    id="content_form" method="post">
                                                    @csrf
                                                    <fieldset class="content-group"
                                                        style="max-height: 500px; overflow-y: scroll; overflow-x:hidden">
                                                        <input type="hidden" name="type"
                                                            value="{{ ConstantHelper::MENU_TYPE_CONTENT }}" />
                                                        @if (!empty($contents))
                                                            @foreach ($contents as $data)
                                                                <div class="checkbox mb-1">
                                                                    <label>
                                                                        <input type="checkbox" name="model_ids[]"
                                                                            value="{{ $data->id }}">
                                                                        {{ $data->title }}
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </fieldset>
                                                    <div class="mb-1">
                                                        <button type="submit"
                                                            class="btn btn-primary btn-custom">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="customHeading">
                                            <button class="accordion-button collapsed accordion-hover-title" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#customAccordion"
                                                aria-expanded="false" aria-controls="customAccordion">
                                                Custom
                                            </button>
                                        </h2>
                                        <div id="customAccordion" class="accordion-collapse collapse"
                                            aria-labelledby="customHeading" data-bs-parent="#accordionHover">
                                            <div class="accordion-body">
                                                <form action="{{ route('admin.menu.menu-item.store', $menu->uuid) }}"
                                                    id="form" method="post" class="form needs-validation" novalidate>
                                                    @csrf
                                                    <fieldset class="content-group"
                                                        style="max-height: 500px; overflow-y: scroll; overflow-x:hidden">
                                                        <input type="hidden" name="type"
                                                            value="{{ ConstantHelper::MENU_TYPE_CUSTOM }}" />
                                                        <div class="mb-1">
                                                            <label for="" class="form-label">Title <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="title"
                                                                value="{{ old('title') }}" required>
                                                        </div>
                                                        <div class="mb-1">
                                                            <label for="" class="form-label">Link <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="link_url"
                                                                value="!#" required>

                                                        </div>
                                                        <div class="mb-1">
                                                            <div class="checkbox-inline">
                                                                <label class="checkbox checkbox-lg">
                                                                    <input type="checkbox" name="is_external" value="1"
                                                                        {{ old('is_external') == 1 ? 'checked' : '' }}>
                                                                    <span></span>Is External Link</label>
                                                            </div>
                                                        </div>

                                                        <div class="mb-1">
                                                            <div class="checkbox-inline">
                                                                <label class="checkbox checkbox-lg">
                                                                    <input type="checkbox" name="link_target" value="1"
                                                                        {{ old('link_target') == 1 ? 'checked' : '' }}>
                                                                    <span></span>Open In New tab</label>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                    <div class="mb-1">
                                                        <button type="submit"
                                                            class="btn btn-primary btn-custom">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-md-8">
            <div class="card card-custom gutter-b">
                <div class="card-header">
                    <div class="card-title w-100">
                        <h3 class="card-label w-100 mr-0">
                            Menu structure
                        </h3>
                    </div>
                </div>
                <div class="card-body">

                    @if (!empty($items))
                        <div class="dd">
                            <ol class="dd-list">
                                @foreach ($items['parent'] as $lvl => $item)
                                    <li class="dd-item" data-id="{{ $item['id'] }}">
                                        <div class="dd-handle">
                                            {{ CommonHelper::shortText($item['title'], 30) }}

                                            <span
                                                class="float-right badge badge-flat border-info text-info text-uppercase">{{ $item['type'] == 1 ? 'Content' : 'Custom' }}</span>
                                        </div>
                                        <span class="edit-wrap d-flex">
                                            <a href="{{ route('admin.menu.menu-item.edit', ['menu' => $menu->id, 'menu_item' => $item['id']]) }}"
                                                class="btn btn-sm btn-primary waves-effect" data-bs-toggle="tooltip"
                                                data-bs-original-title="Edit"><i class="ti ti-pencil"></i></a>
                                            <a class="btn btn-sm btn-danger remove-item waves-effect" data-action=""
                                                data-bs-toggle="tooltip" data-bs-original-title="Trash"><i
                                                    class="ti ti-trash"></i></a></span>

                                    </li>
                                @endforeach
                            </ol>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
