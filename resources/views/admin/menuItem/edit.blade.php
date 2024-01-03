@extends('admin/layouts/layoutMaster')
@section('title', 'Edit Menu Item')

@section('content')
    @include('admin._partials.alert')

    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Menu /</span> Update
    </h4>
    <form action="{{ route('admin.menu.menu-item.update', ['menu' => $menu->uuid, 'menu_item' => $menuItem->id]) }}"
        method="post" id="form" class="form needs-validation" novalidate enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-1">
                            <label for="" class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="title"
                                value="{{ old('title', $menuItem->title) }}" required>
                        </div>
                        <div class="mb-1">
                            <label for="" class="form-label">Link <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="link_url"
                                value="{{ old('link_url', $menuItem->link_url) }}" required>
                        </div>
                        <div class="mb-1">
                            <div class="checkbox-inline">
                                <label class="checkbox checkbox-lg">
                                    <input type="checkbox" name="is_external" value="1"
                                        {{ old('is_external') == 1 || $menuItem->is_external == true ? 'checked' : '' }}>
                                    <span></span>Is External Link</label>
                            </div>
                        </div>

                        <div class="mb-1">
                            <div class="checkbox-inline">
                                <label class="checkbox checkbox-lg">
                                    <input type="checkbox" name="link_target" value="1"
                                        {{ old('link_target') == 1 || $menuItem->link_target == true ? 'checked' : '' }}>
                                    <span></span>Open In New tab</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <button class="btn btn-success waves-effect full-width" type="submit"><i data-feather='save'></i>
                            Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
