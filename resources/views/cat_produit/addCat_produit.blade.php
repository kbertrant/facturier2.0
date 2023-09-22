<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter une categorie de produit</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      
      <form class="mb-3" method="POST" action="{{ route('catproduit.store') }}">
                @csrf
        <div class="mb-3">
          <label for="name" class="form-label">Nom categorie</label>
          <input type="text" class="form-control @error('cat_name') is-invalid @enderror"
                  id="cat_name" name="cat_name" placeholder="Nom de la categorie"
                  autofocus
                  required />
                @error('cat_name')
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
