<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple">
      <div class="modal-content p-0 p-md-2 p-xl-5">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Nouveau paiement</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        
        <form class="mb-3" method="POST" action="{{ route('payment.store') }}">
                  @csrf
            <div class="mb-3">
              <label for="exampleDataList" class="form-label">Numero Facture</label>
              <input type="text" class="form-control" name="num_fac" list="datalistOptions" id="num_fac" placeholder="Saisir pour rechercher">
              <datalist id="datalistOptions">
                @foreach ($facs as $fac)
                  <option value="{{ $fac->ref }}">{{ $fac->name_cli }} - {{ $fac->mttc }}</option>
                @endforeach
              </datalist>
              @error('num_fac')
                <span class="invalid-feedback" role="alert">
                  <strong class="strong">Le client est deja aquis</strong>
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="pay_mode" class="form-label">Mode de paiement </label>
                <select class="form-select" id="pay_mode" name="pay_mode" aria-label="Mode de paiement">
                    <option selected>Choisir mode de paiement</option>
                    <option value="CASH">CASH/ESPECES </option>
                    <option value="MTN MOMO">MTN MOMO</option>
                    <option value="ORANGE MONEY">ORANGE MONEY</option>
                    <option value="CHEQUE">CHEQUE </option>
                    <option value="VIREMENT">VIREMENT</option>
                </select>
                @error('pay_mode')
                    <span class="invalid-feedback" role="alert">
                        <strong class="strong">Mode de paiement est deja aquis</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="mttc_pay" class="form-label">Montant à payer </label>
                <input type="number" class="form-control @error('mttc_pay') is-invalid @enderror"
                    id="mttc_pay" name="mttc_pay" placeholder="Montant à payer" />
                @error('mttc_pay')
                    <span class="invalid-feedback" role="alert">
                        <strong class="strong">Montant a payer est deja aquis</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary d-grid w-100">Encaisser </button>
          </form>
        </div>
      </div>
    </div>
  </div>
  