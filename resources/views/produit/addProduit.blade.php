<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md modal-simple">
    <div class="modal-content p-0 p-md-2 p-xl-5">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter un produit</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      
        <form class="mb-3" method="POST" action="{{ route('produit.store') }}">
                @csrf
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
          <div class="mb-3">
            <label for="price_prod" class="form-label">Prix du produit</label>
            <input type="text" class="form-control @error('price_prod') is-invalid @enderror"
                  id="price_prod" name="price_prod" placeholder="Prix du produit"
                  
                  required />
            @error('price_prod')
						  <span class="invalid-feedback" role="alert">
							  <strong class="strong">Ce nom est deja aquis</strong>
						  </span>
				    @enderror
          </div>
          <div class="mb-3">
            <label for="qty_prod" class="form-label">Qte du produit</label>
            <input type="text" class="form-control @error('qty_prod') is-invalid @enderror"
                  id="qty_prod" name="qty_prod" placeholder="Quantite du produit"
                  
                  required />
            @error('qty_prod')
						  <span class="invalid-feedback" role="alert">
							  <strong class="strong">Quantite est deja aquis</strong>
						  </span>
				    @enderror
          </div>
          <div class="mb-3">
            <label for="color_prod" class="form-label">Qte du produit</label>
            <input type="text" class="form-control @error('color_prod') is-invalid @enderror"
                  id="color_prod" name="color_prod" placeholder="Couleur du produit"
                  
                  required />
            @error('color_prod')
						  <span class="invalid-feedback" role="alert">
							  <strong class="strong">Quantite est deja aquis</strong>
						  </span>
				    @enderror
          </div>
          <div class="mb-3">
            <label for="size_prod" class="form-label">Dimension du produit</label>
            <input type="text" class="form-control @error('color_prod') is-invalid @enderror"
                  id="size_prod" name="size_prod" placeholder="Dimension du produit"
                  
                  required />
            @error('size_prod')
						  <span class="invalid-feedback" role="alert">
							  <strong class="strong">Quantite est deja aquis</strong>
						  </span>
				    @enderror
          </div>
          <div class="mb-3">
            <label for="id_cat" class="form-label">Categorie du produit</label>
            <select class="form-select" id="id_cat" name="id_cat" aria-label="Categorie du produit">
              <option selected>Choisir categorie</option>
              @foreach ($cats as $cat)
                <option value="{{ $cat->id }}">{{ $cat->cat_name }}</option>
              @endforeach
            </select>
            @error('id_cat')
						  <span class="invalid-feedback" role="alert">
							  <strong class="strong">Categorie est deja aquis</strong>
						  </span>
				    @enderror
          </div>
          <button type="submit" class="btn btn-primary d-grid w-100">Ajouter </button>
        </form>
      </div>
    </div>
  </div>
</div>
