@extends('main')
@section('title', ' - Proforma')
@section('main-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Update </span> User 
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
                            <form class="mb-3" method="POST" action="{{ route('user.update') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" class="form-control" id="id" name="id" value="{{$user->id}}"/>
                                
                                <div class="mb-3">
                                    <label for="name" class="form-label">Noms & Prenoms <span class="red-star">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{$user->name}}" autofocus required />
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong class="strong">Ce code est deja aquis</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email <span class="red-star">*</span></label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{$user->email}}" required />
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong class="strong">Ce email est deja aquis</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Mot de passe <span class="red-star">*</span></label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password" value="{{$user->password}}" required />
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong class="strong">Ce nom est deja aquis</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="ville" class="form-label">Ville <span class="red-star">*</span></label>
                                    <input type="text" class="form-control @error('ville') is-invalid @enderror"
                                            id="ville" name="ville" value="{{$user->ville}}" required />
                                    @error('ville')
                                        <span class="invalid-feedback" role="alert">
                                        <strong class="strong">Ce nom est deja aquis</strong>
                                        </span>
                                    @enderror
                                    </div>
                                    <div class="mb-3">
                                    <label for="phone" class="form-label">TELEPHONE <span class="red-star">*</span></label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                            id="phone" name="phone" value="{{$user->phone}}" required />
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                        <strong class="strong">Ce telephone est deja aquis</strong>
                                        </span>
                                    @enderror
                                    </div>
                                    <div class="mb-3">
                                    <label for="phone" class="form-label">ABONNEMENT EXPIRATION <span class="red-star">*</span></label>
                                    <input type="date" class="form-control @error('exp_date') is-invalid @enderror"
                                            id="exp_date" name="exp_date" value="{{$user->exp_date}}" required />
                                    @error('exp_date')
                                        <span class="invalid-feedback" role="alert">
                                        <strong class="strong">Ce date expiration est deja requise</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" value="{{$user->image}}" name="image" id="image">
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong class="strong">Une image est requise</strong>
                                        </span>
                                    @enderror
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
