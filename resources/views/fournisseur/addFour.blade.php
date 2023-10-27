<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-simple">
      <div class="modal-content p-0 p-md-2 p-xl-5">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Nouveau fournisseur</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        
          <form class="mb-3" method="POST" action="{{ route('fournisseur.store') }}">
            @csrf
            
            <div class="mb-3">
                <label for="four_name" class="form-label">Nom fournisseur </label>
                <input type="text" class="form-control @error('name_cli') is-invalid @enderror"
                    id="four_name" name="four_name" placeholder="Nom du fournisseur"
                    autofocus
                    required />
                @error('four_name')
                    <span class="invalid-feedback" role="alert">
                        <strong class="strong">Ce nom est deja aquis</strong>
                    </span>
              @enderror
            </div>
            <div class="mb-3">
                <label for="four_code" class="form-label">Code fournisseur </label>
                <input type="text" class="form-control @error('four_code') is-invalid @enderror"
                    id="four_code" name="four_code" placeholder="Code fournisseur" required />
                @error('four_code')
                <span class="invalid-feedback" role="alert">
                    <strong class="strong">Ce telephone est deja aquis</strong>
                </span>
                @enderror
            </div>
            <div class="mb-3">
              <label for="adress_four" class="form-label">Adresse fournisseur</label>
              <input type="text" class="form-control @error('address_cli') is-invalid @enderror"
                    id="adress_four" name="adress_four" placeholder="Adresse fournisseur"required />
              @error('adress_four')
                            <span class="invalid-feedback" role="alert">
                                <strong class="strong">Cette adresse est deja aquis</strong>
                            </span>
                      @enderror
            </div>
  
            <div class="mb-3">
              <label for="four_phone" class="form-label">Telephone</label>
              <input type="text" class="form-control @error('four_phone') is-invalid @enderror"
                    id="four_phone" name="four_phone" placeholder="Telephone..."required />
                @error('four_phone')
                <span class="invalid-feedback" role="alert">
                    <strong class="strong">Ce nom est deja aquis</strong>
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="resp_name" class="form-label">NOM DU RESPONSABLE</label>
                <input type="text" class="form-control @error('resp_name') is-invalid @enderror"
                    id="resp_name" name="resp_name" placeholder="Nom du responsable"required />
                @error('resp_name')
                    <span class="invalid-feedback" role="alert">
                        <strong class="strong">Ce nom du responsable est deja aquis</strong>
                    </span>
                    @enderror
            </div>
  
            <div class="mb-3">
              <label for="four_rccm" class="form-label">Registre commerce</label>
              <input type="text" class="form-control @error('four_rccm') is-invalid @enderror"
                    id="four_rccm" name="four_rccm" placeholder="Registre commerce "required />
              @error('four_rccm')
                <span class="invalid-feedback" role="alert">
                    <strong class="strong">Ce registre de commerce est deja aquis</strong>
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="four_nui" class="form-label"> Identifiant unique</label>
                <input type="text" class="form-control @error('four_nui') is-invalid @enderror"
                      id="four_nui" name="four_nui" placeholder="Identifiant unique"required />
                @error('four_nui')
                              <span class="invalid-feedback" role="alert">
                                  <strong class="strong">Ce identifiant unique est deja aquis</strong>
                              </span>
                        @enderror
              </div>
              <div class="mb-3">
                <label for="four_email" class="form-label">Email fournisseur</label>
                <input type="email" class="form-control @error('four_email') is-invalid @enderror"
                      id="four_email" name="four_email" placeholder="Identifiant unique"required />
                @error('four_email')
                              <span class="invalid-feedback" role="alert">
                                  <strong class="strong">Adresse email est deja aquis</strong>
                              </span>
                        @enderror
              </div>
            <button type="submit" class="btn btn-primary d-grid w-100">Ajouter </button>
          </form>
        </div>
      </div>
    </div>
  </div>
  