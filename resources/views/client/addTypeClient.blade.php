<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-simple">
      <div class="modal-content p-0 p-md-2 p-xl-5">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter un type client</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        
          <form class="mb-3" method="POST" action="{{ route('typecliente.store') }}">
                  @csrf
            <div class="mb-3">
              <label for="code_prod" class="form-label">Libelle du type</label>
              <input type="text" class="form-control @error('name_tc') is-invalid @enderror"
                    id="name_tc" name="name_tc" placeholder="Libelle du type de client"
                    required />
              @error('name_tc')
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
  