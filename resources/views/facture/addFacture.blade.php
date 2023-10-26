<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple">
      <div class="modal-content p-0 p-md-2 p-xl-5">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Nouvelle facture</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        
        <form class="mb-3" method="POST" action="{{ route('facture.store') }}">
                  @csrf
            <div class="mb-3">
                <label for="id_cli" class="form-label">CLIENT</label>
                <select class="form-select" id="id_cli" name="id_cli" aria-label="Client">
                    <option selected>Choisir le client</option>
                    @foreach ($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->name_cli }}</option>
                    @endforeach
                </select>
                @error('id_cli')
                <span class="invalid-feedback" role="alert">
                    <strong class="strong">Le client est deja aquis</strong>
                </span>
                @enderror
            </div>
            <div class="mb-3">
              <label for="code_prod" class="form-label">Code produit</label>
              <input type="text" class="form-control @error('code_prod') is-invalid @enderror"
                    id="code_prod" name="code_prod" placeholder="Code du produit"
                    autofocus
                    required />
              @error('code_prod')
                            <span class="invalid-feedback" role="alert">
                                <strong class="strong">Ce code est deja aquis</strong>
                            </span>
                      @enderror
            </div>
            <div class="mb-3">
              <label for="name_prod" class="form-label">Nom produit</label>
              <input type="text" class="form-control @error('name_prod') is-invalid @enderror"
                    id="name_prod" name="name_prod" placeholder="Nom du produit"
                    
                    required />
              @error('name_prod')
                            <span class="invalid-feedback" role="alert">
                                <strong class="strong">Ce nom est deja aquis</strong>
                            </span>
                      @enderror
            </div>
            <div class="mb-3">
              <label for="desc_prod" class="form-label">Description produit</label>
              <input type="text" class="form-control @error('desc_prod') is-invalid @enderror"
                    id="desc_prod" name="desc_prod" placeholder="Description du produit"
                    
                    required />
              @error('desc_prod')
                            <span class="invalid-feedback" role="alert">
                                <strong class="strong">Ce nom est deja aquis</strong>
                            </span>
                      @enderror
            </div>
            
            
            
            
            
            <button type="submit" class="btn btn-primary d-grid w-100">Facturer </button>
          </form>
        </div>
      </div>
    </div>
  </div>
  