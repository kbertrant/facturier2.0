<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md modal-simple">
    <div class="modal-content p-0 p-md-2 p-xl-5">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter un client</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      
        <form class="mb-3" method="POST" action="{{ route('cliente.store') }}">
          @csrf
          <div class="mb-3">
            <label for="id_tc" class="form-label">Categorie du produit</label>
            <select class="form-select" id="id_tc" name="id_tc" aria-label="Categorie du produit">
              <option selected>Choisir type client</option>
              @foreach ($list_tcs as $tc)
                <option value="{{ $tc->id }}">{{ $tc->name_tc }}</option>
              @endforeach
            </select>
            @error('id_tc')
						  <span class="invalid-feedback" role="alert">
							  <strong class="strong">Type est deja aquis</strong>
						  </span>
				    @enderror
          </div>
          <div class="mb-3">
            <label for="code_prod" class="form-label">Noms & prenoms client </label>
            <input type="text" class="form-control @error('name_cli') is-invalid @enderror"
                  id="name_cli" name="name_cli" placeholder="Nom du client"
                  autofocus
                  required />
            @error('name_cli')
						  <span class="invalid-feedback" role="alert">
							  <strong class="strong">Ce nom est deja aquis</strong>
						  </span>
				    @enderror
          </div>
          <div class="mb-3">
            <label for="phone_cli" class="form-label">Telephone client</label>
            <input type="text" class="form-control @error('phone_cli') is-invalid @enderror"
                  id="phone_cli" name="phone_cli" placeholder="Nom du produit"required />
            @error('phone_cli')
						  <span class="invalid-feedback" role="alert">
							  <strong class="strong">Ce telephone est deja aquis</strong>
						  </span>
				    @enderror
          </div>
          <div class="mb-3">
            <label for="address_cli" class="form-label">Adresse du client</label>
            <input type="text" class="form-control @error('address_cli') is-invalid @enderror"
                  id="address_cli" name="address_cli" placeholder="Adresse du client"required />
            @error('address_cli')
						  <span class="invalid-feedback" role="alert">
							  <strong class="strong">Ce nom est deja aquis</strong>
						  </span>
				    @enderror
          </div>

          <div class="mb-3">
            <label for="address_cli" class="form-label">RAISON SOCIALE</label>
            <input type="text" class="form-control @error('raison_sociale') is-invalid @enderror"
                  id="raison_sociale" name="raison_sociale" placeholder="Raison sociale"required />
            @error('raison_sociale')
						  <span class="invalid-feedback" role="alert">
							  <strong class="strong">Ce nom est deja aquis</strong>
						  </span>
				    @enderror
          </div>
          <div class="mb-3">
            <label for="cl_email" class="form-label">EMAIL</label>
            <input type="text" class="form-control @error('cl_email') is-invalid @enderror"
                  id="cl_email" name="cl_email" placeholder="Email"required />
            @error('cl_email')
						  <span class="invalid-feedback" role="alert">
							  <strong class="strong">Ce nom est deja aquis</strong>
						  </span>
				    @enderror
          </div>

          <div class="mb-3">
            <label for="cl_rccm" class="form-label">Registre commerce</label>
            <input type="text" class="form-control @error('cl_rccm') is-invalid @enderror"
                  id="cl_rccm" name="cl_rccm" placeholder="Registre commerce "required />
            @error('cl_rccm')
						  <span class="invalid-feedback" role="alert">
							  <strong class="strong">Ce nom est deja aquis</strong>
						  </span>
				    @enderror
          </div>
          
          <button type="submit" class="btn btn-primary d-grid w-100">Ajouter </button>
        </form>
      </div>
    </div>
  </div>
</div>
