<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-simple">
      <div class="modal-content p-0 p-md-2 p-xl-5">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Nouvelle depense</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        
          <form class="mb-3" method="POST" action="{{ route('depense.store') }}">
            @csrf
            <div class="mb-3">
              <label for="id_four" class="form-label">Fournisseur</label>
              <select class="form-select" id="id_four" name="id_four" aria-label="Fournisseur">
                <option selected>Choisir fournisseur</option>
                @foreach ($fours as $four)
                  <option value="{{ $four->id }}">{{ $four->four_name }}</option>
                @endforeach
              </select>
              @error('id_four')
                <span class="invalid-feedback" role="alert">
                  <strong class="strong">Fournisseur est deja aquis</strong>
                </span>
              @enderror
            </div>
            <div class="mb-3">
                <label for="label_dep" class="form-label">Intitule de la depense</label>
                <input type="text" class="form-control @error('label_dep') is-invalid @enderror"
                    id="label_dep" name="label_dep" placeholder="Objet de la depense" required />
                @error('label_dep')
                    <span class="invalid-feedback" role="alert">
                        <strong class="strong">Ce intitule est deja aquis</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
              <label for="amount_dep" class="form-label">Montant à payer </label>
              <input type="number" class="form-control @error('amount_dep') is-invalid @enderror"
                    id="amount_dep" name="amount_dep" placeholder="Montant à payer" required />
                @error('amount_dep')
                    <span class="invalid-feedback" role="alert">
                        <strong class="strong">Ce code est deja aquis</strong>
                    </span>
                @enderror
            </div>
            
            <div class="mb-3">
              <label for="solde_dep" class="form-label">Solde</label>
              <input type="number" class="form-control @error('solde_dep') is-invalid @enderror"
                    id="solde_dep" name="solde_dep" placeholder="Dimension du produit" required />
                @error('solde_dep')
                    <span class="invalid-feedback" role="alert">
                        <strong class="strong">Sole est deja aquis</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="pay_mode" class="form-label">Mode de paiement </label>
                <select class="form-select" id="mode_dep" name="mode_dep" aria-label="Mode de paiement">
                    <option selected>Choisir mode de paiement</option>
                    <option value="CASH">CASH/ESPECES </option>
                    <option value="MTN MOMO">MTN MOMO</option>
                    <option value="ORANGE MONEY">ORANGE MONEY</option>
                    <option value="CHEQUE">CHEQUE </option>
                    <option value="VIREMENT">VIREMENT</option>
                </select>
                @error('mode_dep')
                    <span class="invalid-feedback" role="alert">
                        <strong class="strong">Mode de paiement est deja aquis</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary d-grid w-100">Ajouter </button>
          </form>
        </div>
      </div>
    </div>
  </div>
  