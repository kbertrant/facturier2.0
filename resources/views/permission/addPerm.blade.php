<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md modal-simple">
    <div class="modal-content p-0 p-md-2 p-xl-5">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter une permission</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      
      <form class="mb-3" method="POST" action="{{ route('perm.store') }}">
                @csrf
        <div class="mb-3">
          <label for="name" class="form-label">Nom de permission <span class="red-star">*</span></label>
          <input type="text" class="form-control @error('name') is-invalid @enderror"
                  id="name" name="name" placeholder="Nom de la permission"
                  autofocus
                  required />
                @error('name')
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
