<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple">
      <div class="modal-content p-0 p-md-2 p-xl-5">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">{{ __('mypages.np') }}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        
        <form class="mb-3" method="POST" action="{{ route('proforma.store') }}">
                  @csrf
                  <div class="mb-3">
                    <label for="id_cli" class="form-label">Client</label>
                    <input type="text" class="form-control" name="id_cli" list="datalistOptions" id="id_cli" placeholder="Saisir pour rechercher" required>
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
              <legend class="scheduler-border">{{ __('mypages.ldps') }}</legend>
              <div class="row">
                  <div class="col-lg-6 col-md-6 col-xs-8">
                      <select id="id_prod[]" name="id_prod[]" class="form-control prod" required>
                          <option value="">Choisir l'article ou la prestation</option>
                          @foreach ($produits as $produit)
                              <option value="{{ $produit->id }}">{{ $produit->name_prod }} - {{ $produit->price_prod }}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="col-lg-2 col-md-2 col-xs-2">
                    <input type="number" class="form-control @error('your_price') is-invalid @enderror"
                    id="your_price[]" name="your_price[]" value="0" required />
                  </div>
                  <div class="col-lg-2 col-md-2 col-xs-2">
                    <input type="number" class="form-control @error('quantity') is-invalid @enderror"
                    id="quantity[]" name="quantity[]" placeholder="Qte" required />
                  </div>
                  
                  <div class="col-lg-2 col-md-2 col-xs-2">
                    <a href="javascript:void(0);" class="add_button" title="Ajouter">
                      <i class="bx bx-list-plus bx-md"></i></a>
                  </div>
              </div>
              <br/>
              <div class="row">
                  <div class="field_wrapper" style="width: 100%;"><div>
              </div>
              </div>
              </div>
            </fieldset>
            <div class="row">
              <div class="col-lg-4 col-md-4 col-xs-4">
                <div class="mb-3">
                  <label for="reduction" class="form-label">{{ __('mypages.remise') }} (%)</label>
                  <input type="number" class="form-control @error('reduction') is-invalid @enderror"
                    id="reduction" name="reduction" value="0" required oninput="calculateTotal()"/>
                    @error('reduction')
                    <span class="invalid-feedback" role="alert">
                      <strong class="strong">Reduction est deja aquis</strong>
                    </span>
                    @enderror
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-xs-12">
                <div class="form-check form-switch mb-3">
                  <label class="form-check-label" for="tva_apply">{{ __('mypages.tva') }} </label>
                  <select id="tva_apply" name="tva_apply" class="form-control" onchange="calculateTotal()">
                    <option value="off">OFF</option>
                    <option value="on">ON</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-xs-12">
                <div class="form-check form-switch mb-3">
                  <label class="form-check-label" for="rs_apply">{{ __('mypages.rs') }} </label>
                  <select id="rs_apply" name="rs_apply" class="form-control" onchange="calculateTotal()">
                    <option value="off">OFF</option>
                    <option value="on">ON</option>
                  </select>
                </div>
              </div>
            </div>


            <div class="row">
              <div class="col-lg-6 col-md-6 col-xs-12"></div>
              <div class="col-lg-6 col-md-6 col-xs-12">
                <table>
                  <tr>
                    <td>Total HT :</td>
                    <td id="ht">0 XAF</td>
                  </tr>
                  <tr>
                    <td>T.V.A :</td>
                    <td id="taxes">0 XAF</td>
                  </tr>
                  <tr>
                    <td>Deducted at source :</td>
                    <td id="rs">0 XAF</td>
                  </tr>
                  <tr>
                    <td>Discount (%):</td>
                    <td id="discount">0</td>
                  </tr>
                  <tr>
                    <td>Total TC :</td>
                    <td id="ttc">0 XAF</td>
                  </tr>
                </table>
              </div>
            </div>
            <button type="submit" class="btn btn-primary d-grid w-100">Ajouter </button>
          </form>
        </div>
      </div>
    </div>
  </div>
  