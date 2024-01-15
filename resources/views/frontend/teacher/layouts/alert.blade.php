@if (Session::has('info'))
<div class="alert alert-info alert-dismissible" role="alert">
    <div class="alert-body d-flex align-items-center">
        <i data-feather='info' class="me-50"></i>
        <span> {!! Session::get('info') !!}</span>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (Session::has('success'))
<div class="alert alert-success alert-dismissible" role="alert">
    <div class="alert-body d-flex align-items-center">
        <i data-feather='check-circle' class="me-50"></i>
        <span> {!! Session::get('success') !!}</span>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (Session::has('warning'))
<div class="alert alert-warning alert-dismissible" role="alert">
    <div class="alert-body d-flex align-items-center">
        <i data-feather='alert-triangle' class="me-50"></i>
        <span> {!! Session::get('warning') !!}</span>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (Session::has('error'))
<div class="alert alert-danger alert-dismissible" role="alert">
    <div class="alert-body d-flex align-items-center">
        <i data-feather='alert-octagon' class="me-50"></i>
        <span> {!! Session::get('error') !!}</span>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if ($errors->any())
<div class="alert alert-danger" role="alert">
    <div class="alert-heading">
        Review required in some field(s).
        <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <div class="alert-body">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif
