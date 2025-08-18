@extends('main')
@section('title', ' - Update role')
@section('main-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Update </span> Permission 
    </h4>
    @if (session('success'))
        <div class="alert alert-danger" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
        <div class="flex-grow-1 mt-3 mt-sm-5">
            <div class="row invoice-preview">
                <div class="col-xl-10 col-md-10 col-10 mb-md-0 mb-4">
                    <div class="card invoice-preview-card">
                        <div class="modal-body">
                            <form class="mb-3" method="POST" action="{{ route('permission.update') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" class="form-control" id="id" name="id" value="{{$permission->id}}"/>
                                
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nom <span class="red-star">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{$permission->name}}" autofocus required />
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong class="strong">Ce code est deja aquis</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                
                            </div>
                                <button type="submit" class="btn btn-primary d-grid w-100">Modifier </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
