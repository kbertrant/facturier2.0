


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Informations du client</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      
      <form class="mb-3" method="POST" action="{{ route('addClient') }}">
                @csrf
                <div class="mb-3">
                <label for="name" class="form-label">Noms</label>
                <input
                  type="text"
                  class="form-control @error('name') is-invalid @enderror"
                  id="name"
                  name="name"
                  placeholder="Entrer votre nom"
                  autofocus
                  required
                  value="{{ old('name') }}"
                />
                @error('name')
							   <span class="invalid-feedback" role="alert">
								<strong class="strong">Ce nom est deja aquis</strong>
							   </span>
							  @enderror
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" 
                required 
                class="form-control @error('email') is-invalid @enderror" 
                id="email" 
                name="email" 
                placeholder="Entrer votre email"
                value="{{ old('email') }}" />
                @error('email')
							   <span class="invalid-feedback" role="alert">
								<strong class="strong">Cet email est deja aquis</strong>
							   </span>
							  @enderror
              </div>
              <div class="mb-3 form-password-toggle">
                <label class="form-label" for="password">Mot de passe</label>
                <div class="input-group input-group-merge">
                  <input
                    type="password"
                    id="password"
                    class="form-control @error('password') is-invalid @enderror"
                    name="password"
                    placeholder="Mot de passe"
                    aria-describedby="password"
                    required
                  />
                  <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  @error('password')
							   <span class="invalid-feedback" role="alert">
								<strong class="strong">Au moins 8 carractère pour le mot de passe</strong>
							   </span>
							  @enderror
                </div>
              </div>
              <div class="mb-3 form-password-toggle">
                <label class="form-label " for="password">Confirmer mot de passe</label>
                <div class="input-group input-group-merge">
                  <input
                    type="password"
                    id="confirm_password"
                    class="form-control @error('password_confirmation') is-invalid @enderror"
                    name="password_confirmation"
                    placeholder="Confirmer mot de passe"
                    required
                  />
                  <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  @error('password_confirmation')
							   <span class="invalid-feedback" role="alert">
								<strong class="strong">se password ne correspond pas</strong>
							   </span>
							  @enderror
                </div>
              </div>
              <div class="mb-3">
                <label for="phone" class="form-label ">Telephone</label>
                <input type="text" required class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" id="phone" name="phone" placeholder="Entrer votre numero" />
                @error('phone')
							   <span class="invalid-feedback" role="alert">
								<strong class="strong">Ce numero est deja aquis</strong>
							   </span>
							  @enderror
              </div>
              <div class="mb-3">
                <label for="ville" class="form-label">Ville</label>
                <input type="text" required class="form-control  @error('ville') is-invalid @enderror" id="ville" value="{{ old('ville') }}" name="ville" placeholder="Entrer votre ville" />
              </div>
              <div class="mb-3">
                <label for="name_ent" class="form-label">Le nom de votre entrreprise</label>
                <input type="text"  required class="form-control @error('name_ent') is-invalid @enderror" id="name_ent" value="{{ old('name_ent') }}" name="name_ent" placeholder="Entrer votre entreprise" />
                @error('name_ent')
							   <span class="invalid-feedback" role="alert">
								<strong class="strong">Ce champ est deja aquis</strong>
							   </span>
							  @enderror
              </div>
              <div class="mb-3">
                <label for="rc_ent" class="form-label">Registre commerce entrreprise</label>
                <input type="text" required class="form-control @error('rc_ent') is-invalid @enderror" id="rc_ent" value="{{ old('name_ent') }}" name="rc_ent" placeholder="Entrer votre registre de commerce" />
                @error('rc_ent')
							   <span class="invalid-feedback" role="alert">
								<strong class="strong">Se champ est deja aquis</strong>
							   </span>
							  @enderror
              </div>
              <div class="mb-3">
                <label for="image" class="form-label">image</label>
                <input type="file"  accept="image/png, image/jpg, image/jpeg" class="form-control" id="image" required name="image" placeholder="Entrer votre image" />   
              </div>
              <div class="mb-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" />
                  <label class="form-check-label" for="terms-conditions">
                    J'accepte les
                    <a href="javascript:void(0);">conditions et accords</a>
                  </label>
                </div>
              </div>
              <button type="submit" class="btn btn-primary d-grid w-100">Inscription </button>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
       
      </div>
    </div>
  </div>
</div>
