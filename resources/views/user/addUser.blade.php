<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-simple">
      <div class="modal-content p-0 p-md-2 p-xl-5">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter un utilisateur</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        
          <form class="mb-3" method="POST" action="{{ route('user.store') }}">
            @csrf
            <div class="mb-3">
              <label for="name" class="form-label">Noms & prenoms  </label>
              <input type="text" class="form-control @error('name') is-invalid @enderror"
                    id="name" name="name" placeholder="Noms et prenom"
                    autofocus
                    required />
              @error('name')
              <span class="invalid-feedback" role="alert">
                <strong class="strong">Ce nom est deja aquis</strong>
              </span>
              @enderror
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Adresse email </label>
              <input type="email" class="form-control @error('email') is-invalid @enderror"
                    id="email" name="email" placeholder="Email" required />
              @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong class="strong">Ce telephone est deja aquis</strong>
                </span>
              @enderror
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Mot de passe</label>
              <input type="password" class="form-control @error('password') is-invalid @enderror"
                    id="password" name="password" placeholder="Mot de passe" required />
              @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong class="strong">Ce nom est deja aquis</strong>
                </span>
              @enderror
            </div>
  
            <div class="mb-3">
              <label for="ville" class="form-label">Ville </label>
              <input type="text" class="form-control @error('ville') is-invalid @enderror"
                    id="ville" name="ville" placeholder="Ville"required />
              @error('ville')
                <span class="invalid-feedback" role="alert">
                  <strong class="strong">Ce nom est deja aquis</strong>
                </span>
              @enderror
            </div>
            <div class="mb-3">
              <label for="phone" class="form-label">TELEPHONE </label>
              <input type="text" class="form-control @error('phone') is-invalid @enderror"
                    id="phone" name="phone" placeholder="Telephone"required />
              @error('phone')
                <span class="invalid-feedback" role="alert">
                  <strong class="strong">Ce telephone est deja aquis</strong>
                </span>
              @enderror
            </div>
            <div class="mb-3">
              <label for="phone" class="form-label">ABONNEMENT EXPIRATION </label>
              <input type="date" class="form-control @error('exp_date') is-invalid @enderror"
                    id="exp_date" name="exp_date" placeholder="Date expiration"required />
              @error('exp_date')
                <span class="invalid-feedback" role="alert">
                  <strong class="strong">Ce date expiration est deja requise</strong>
                </span>
              @enderror
            </div>
            <button type="submit" class="btn btn-primary d-grid w-100">Ajouter </button>
          </form>
        </div>
      </div>
    </div>
  </div>
  