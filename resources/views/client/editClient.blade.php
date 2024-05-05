@extends('main')
@section('title', ' - Modifier Client ')
@section('main-content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Editer un client </span> {{ $cl->cl_name }}
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
      
                        <form class="mb-3" method="POST" action="{{ route('cliente.update') }}" >
                          @csrf
                          <input type="hidden" class="form-control" id="id" name="id" value="{{$cl->id}}"/>
                          
                          <div class="mb-3">
                            <label for="id_tc" class="form-label">Type client</label>
                            <select class="form-select" id="id_tc" name="id_tc" aria-label="Categorie du produit" required>
                              
                              @foreach ($list_tcs as $tc)
                                <option value="{{ $tc->id }}" {{($cl->id_tc === $tc->id ) ? 'Selected' : ''}}>{{ $tc->name_tc }}</option>
                              @endforeach
                            </select>
                            @error('id_tc')
                                          <span class="invalid-feedback" role="alert">
                                              <strong class="strong">Type est requis</strong>
                                          </span>
                                    @enderror
                          </div>
                          <div class="mb-3">
                            <label for="code_prod" class="form-label">Noms & prenoms client </label>
                            <input type="text" class="form-control @error('name_cli') is-invalid @enderror"
                                  id="name_cli" name="name_cli" value="{{$cl->name_cli}}" 
                                  required />
                            @error('name_cli')
                                          <span class="invalid-feedback" role="alert">
                                              <strong class="strong">Ce nom est requis</strong>
                                          </span>
                                    @enderror
                          </div>
                          <div class="mb-3">
                            <label for="phone_cli" class="form-label">Telephone client</label>
                            <input type="text" class="form-control @error('phone_cli') is-invalid @enderror"
                                  id="phone_cli" name="phone_cli" value="{{$cl->phone_cli}}" required />
                            @error('phone_cli')
                                          <span class="invalid-feedback" role="alert">
                                              <strong class="strong">Ce telephone est requis</strong>
                                          </span>
                                    @enderror
                          </div>
                          <div class="mb-3">
                            <label for="address_cli" class="form-label">Adresse du client</label>
                            <input type="text" class="form-control @error('address_cli') is-invalid @enderror"
                                  id="address_cli" name="address_cli" value="{{$cl->address_cli}}" />
                            @error('address_cli')
                                          <span class="invalid-feedback" role="alert">
                                              <strong class="strong">Ce nom est deja aquis</strong>
                                          </span>
                                    @enderror
                          </div>
                
                          <div class="mb-3">
                            <label for="address_cli" class="form-label">RAISON SOCIALE</label>
                            <input type="text" class="form-control @error('raison_sociale') is-invalid @enderror"
                                  id="raison_sociale" name="raison_sociale" value="{{$cl->raison_sociale}}" required />
                            @error('raison_sociale')
                                          <span class="invalid-feedback" role="alert">
                                              <strong class="strong">Ce nom est requis</strong>
                                          </span>
                                    @enderror
                          </div>
                          <div class="mb-3">
                            <label for="cl_email" class="form-label">EMAIL</label>
                            <input type="text" class="form-control @error('cl_email') is-invalid @enderror"
                                  id="cl_email" name="cl_email" value="{{$cl->cl_email}}" required />
                            @error('cl_email')
                                          <span class="invalid-feedback" role="alert">
                                              <strong class="strong">Ce nom est requis</strong>
                                          </span>
                                    @enderror
                          </div>
                
                          <div class="mb-3">
                            <label for="cl_rccm" class="form-label">Registre commerce</label>
                            <input type="text" class="form-control @error('cl_rccm') is-invalid @enderror"
                                  id="cl_rccm" name="cl_rccm" value="{{$cl->cl_rccm}}"required />
                            @error('cl_rccm')
                                          <span class="invalid-feedback" role="alert">
                                              <strong class="strong">Ce nom est requis</strong>
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
