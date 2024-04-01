@extends('main')
@section('title', ' - Proforma')
@section('main-content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Editer un produit </span> {{ $prod->name_pro }}
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
      
                        <form class="mb-3" method="POST" action="{{ route('produit.update') }}" enctype="multipart/form-data">
                          @csrf
                          <input type="hidden" class="form-control" id="id" name="id" value="{{$prod->id}}"/>
                          <div class="mb-3">
                            <label for="id_cat" class="form-label">Categorie du produit</label>
                            <select class="form-select" id="id_cat" name="id_cat" aria-label="Categorie du produit" required>
                              
                              @foreach ($cats as $cat)
                                <option value="{{ $cat->id }}" {{($prod->id_cat === $cat->id ) ? 'Selected' : ''}}>{{ $cat->cat_name }}</option>
                              @endforeach
                            </select>
                            @error('id_cat')
                              <span class="invalid-feedback" role="alert">
                                <strong class="strong">Categorie est deja aquis</strong>
                              </span>
                            @enderror
                          </div>
                          <div class="mb-3">
                            <label for="code_prod" class="form-label">Code produit</label>
                            <input type="text" class="form-control @error('code_prod') is-invalid @enderror"
                                  id="code_prod" name="code_prod" value="{{$prod->code_prod}}" autofocus required />
                            @error('code_prod')
                                          <span class="invalid-feedback" role="alert">
                                              <strong class="strong">Ce code est deja aquis</strong>
                                          </span>
                                    @enderror
                          </div>
                          <div class="mb-3">
                            <label for="name_prod" class="form-label">Nom produit</label>
                            <input type="text" class="form-control @error('name_prod') is-invalid @enderror"
                                  id="name_prod" name="name_prod" value="{{$prod->name_prod}}" required />
                            @error('name_prod')
                                          <span class="invalid-feedback" role="alert">
                                              <strong class="strong">Ce nom est deja aquis</strong>
                                          </span>
                                    @enderror
                          </div>
                          <div class="mb-3">
                            <label for="desc_prod" class="form-label">Description produit</label>
                            <input type="text" class="form-control @error('desc_prod') is-invalid @enderror"
                                  id="desc_prod" name="desc_prod" value="{{$prod->desc_prod}}" required />
                            @error('desc_prod')
                                          <span class="invalid-feedback" role="alert">
                                              <strong class="strong">Ce nom est deja aquis</strong>
                                          </span>
                                    @enderror
                          </div>
                          <div class="mb-3">
                            <label for="price_prod" class="form-label">Prix du produit</label>
                            <input type="text" class="form-control @error('price_prod') is-invalid @enderror"
                                  id="price_prod" name="price_prod" value="{{$prod->price_prod}}" required />
                            @error('price_prod')
                                          <span class="invalid-feedback" role="alert">
                                              <strong class="strong">Ce nom est deja aquis</strong>
                                          </span>
                                    @enderror
                          </div>
                          <div class="mb-3">
                            <label for="qty_prod" class="form-label">Qte du produit</label>
                            <input type="text" class="form-control @error('qty_prod') is-invalid @enderror"
                                  id="qty_prod" name="qty_prod" value="{{$prod->qty_prod}}" required />
                            @error('qty_prod')
                                          <span class="invalid-feedback" role="alert">
                                              <strong class="strong">Quantite est deja aquis</strong>
                                          </span>
                                    @enderror
                          </div>
                          <div class="mb-3">
                            <label for="color_prod" class="form-label">Couleur du produit</label>
                            <input type="text"  />
                                  <input type="color" value="#666EE8" class="form-control @error('color_prod') is-invalid @enderror"
                                  id="color_prod" name="color_prod" value="{{$prod->color_prod}}" required>
                            @error('color_prod')
                                          <span class="invalid-feedback" role="alert">
                                              <strong class="strong">Couleur est deja aquis</strong>
                                          </span>
                                    @enderror
                          </div>
                          <div class="mb-3">
                            <label for="size_prod" class="form-label">Dimension du produit</label>
                            <input type="text" class="form-control @error('color_prod') is-invalid @enderror"
                                  id="size_prod" name="size_prod" value="{{$prod->size_prod}}" required />
                            @error('size_prod')
                                          <span class="invalid-feedback" role="alert">
                                              <strong class="strong">Quantite est requis</strong>
                                          </span>
                                    @enderror
                          </div>
                          <div class="mb-3">
                            <label for="detail" class="form-label">Detaillable</label>
                            <input type="radio" class="form-check-input @error('detail') is-invalid @enderror" {{($prod->detail === "on" ) ? 'Checked' : ''}}
                                  id="detail" name="detail" required />
                            <label for="detail" class="form-check-label">oui</label>
                            <input type="radio" class="form-check-input @error('detail') is-invalid @enderror" {{($prod->detail === "off" ) ? 'Checked' : ''}}
                                  id="detail" name="detail" required />
                            <label for="detail" class="form-check-label">non</label>
                            @error('detail')
                                          <span class="invalid-feedback" role="alert">
                                              <strong class="strong">Detail est deja aquis</strong>
                                          </span>
                                    @enderror
                          </div>
                          <div class="mb-3">
                            <label for="neuf" class="form-label">Neuf</label>
                            <input type="radio" class="form-check-input @error('neuf') is-invalid @enderror" {{($prod->neuf === "on" ) ? 'Checked' : ''}}
                                  id="neuf" name="neuf" required />
                            <label for="neuf" class="form-check-label">oui</label>
                            <input type="radio" class="form-check-input @error('neuf') is-invalid @enderror" {{($prod->neuf === "off" ) ? 'Checked' : ''}}
                                  id="neuf" name="neuf" required />
                            <label for="neuf" class="form-check-label">non</label>
                            @error('detail')
                                          <span class="invalid-feedback" role="alert">
                                              <strong class="strong">Neuf est deja aquis</strong>
                                          </span>
                                    @enderror
                          </div>
                          <div class="mb-3">
                            <label for="volume" class="form-label">Volume</label>
                            <input type="text" class="form-control @error('volume') is-invalid @enderror"
                                  id="volume" name="volume" value="{{$prod->volume}}" required />
                            @error('volume')
                                          <span class="invalid-feedback" role="alert">
                                              <strong class="strong">Volume est deja aquis</strong>
                                          </span>
                                    @enderror
                          </div>
                          <div class="mb-3">
                            <label for="poids" class="form-label">Poids</label>
                            <input type="text" class="form-control @error('poids') is-invalid @enderror"
                                  id="poids" name="poids" value="{{$prod->poids}}" required />
                            @error('poids')
                                          <span class="invalid-feedback" role="alert">
                                              <strong class="strong">Poids est deja aquis</strong>
                                          </span>
                                    @enderror
                          </div>
                          <div class="mb-3">
                            <label for="img" class="form-label">Image</label>
                            <input type="file" class="form-control @error('img') is-invalid @enderror" value="{{$prod->img}}" name="img" id="img">
                            @error('img')
                                          <span class="invalid-feedback" role="alert">
                                              <strong class="strong">Une image est requise</strong>
                                          </span>
                                    @enderror
                          </div>
                          <div class="mb-3">
                            <label for="is_stock" class="form-label">Produit stockable</label>
                            <select class="form-select" id="is_stock" name="is_stock" required>
                                <option value="N" {{($prod->is_stock === "N" ) ? 'Selected' : ''}}>NO </option>
                                <option value="Y" {{($prod->is_stock === "Y" ) ? 'Selected' : ''}}>YES </option>
                            </select>
                            @error('is_stock')
                                          <span class="invalid-feedback" role="alert">
                                              <strong class="strong">Stockable est deja aquis</strong>
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
