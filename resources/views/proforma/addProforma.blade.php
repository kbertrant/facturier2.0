<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple">
      <div class="modal-content p-0 p-md-2 p-xl-5">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Nouvelle proforma</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        
        <form class="mb-3" method="POST" action="{{ route('proforma.store') }}">
                  @csrf
                  <div class="mb-3">
                    <label for="id_cli" class="form-label">Client</label>
                    <input type="text" class="form-control" name="id_cli" list="datalistOptions" id="id_cli" placeholder="Saisir pour rechercher">
                    <datalist id="datalistOptions">
                      @foreach ($clients as $client)
                        <option value="{{ $client->name_cli }}"></option>
                      @endforeach
                    </datalist>
                    @error('id_cli')
                      <span class="invalid-feedback" role="alert">
                        <strong class="strong">Le client est deja aquis</strong>
                      </span>
                      @enderror
                  </div>
            
            <fieldset class="scheduler-border">
              <legend class="scheduler-border">Liste des produits</legend>
              <div class="row">
                  <div class="col-lg-8 col-md-8 col-xs-8">
                      <select id="id_prod[]" name="id_prod[]" class="form-control prod" required>
                          <option value="">Choisir l'article ou la prestation</option>
                          @foreach ($produits as $produit)
                              <option value="{{ $produit->id }}">{{ $produit->name_prod }} - {{ $produit->code_prod }}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="col-lg-2 col-md-2 col-xs-2">
                    <input type="number" class="form-control @error('quantity') is-invalid @enderror"
                    id="quantity[]" name="quantity[]" placeholder="Qte" required />
                  </div>
                  
                  <div class="col-lg-2 col-md-2 col-xs-2">
                    <a href="javascript:void(0);" class="add_button" title="Ajouter">
                    <img src="{{ asset('assets/img/add-icon.png') }}"/></a>
                  </div>
              </div>
              <br/>
              <div class="row">
                  <div class="field_wrapper" style="width: 100%;"><div>
              </div>
              </div>
              </div>
            </fieldset>
            <div class="mb-3">
              <label for="reduction" class="form-label">Reduction </label>
              <input type="number" class="form-control @error('reduction') is-invalid @enderror"
                    id="reduction" name="reduction" value="0" />
              @error('reduction')
                <span class="invalid-feedback" role="alert">
                  <strong class="strong">Reduction est deja aquis</strong>
                </span>
              @enderror
            </div>
            <div class="mb-3">
              <div class="form-check form-switch mb-2">
                <input class="form-check-input" type="checkbox" id="tva_apply" name="tva_apply" checked="">
                <label class="form-check-label" for="tva_apply">TVA appliquée</label>
              </div>
              
            </div>
            <button type="submit" class="btn btn-primary d-grid w-100">Facturer </button>
          </form>
        </div>
      </div>
    </div>
  </div>
  