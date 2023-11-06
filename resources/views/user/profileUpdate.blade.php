


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Nouvelles informations</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form  class="mb-3" method="POST" action="{{ route('updateUser') }}" enctype="multipart/form-data">
          @csrf
       <div class="card-body">
        <div class="d-flex align-items-start align-items-sm-center gap-4">
          <img src="/storage/{{$user->image}}" alt="image" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
          <div class="button-wrapper">
            <label  class="btn btn-primary me-2 mb-4" tabindex="0">
              <span class="d-none d-sm-block">Modifier votre photo</span>
              <i class="bx bx-upload d-block d-sm-none"></i>
            </label>
            <input type="file" accept="image/png, image/jpg, image/jpeg" id="upload" name="image" required class="account-file-input"  />

            <!-- <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p> -->
          </div>
        </div>
      </div>
            <input type="text" name ="id" value="{{$user->id}}" style="display:none" class="form-control" >

              <div class="mb-3">
                <label for="username" class="form-label">Noms</label>
                <input
                  type="text"
                  class="form-control @error('name') is-invalid @enderror"
                  id="name"
                  required
                  name="name"
                  placeholder="Entrer votre nom"
                  value="{{$user->name}}"
                  autofocus
                />
                @error('name')
							   <span class="invalid-feedback" role="alert">
								<strong class="strong">Se champ est deja aquis</strong>
							   </span>
							  @enderror
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" required value="{{$user->email}}" name="email" placeholder="Entrer votre email" />
                @error('email')
							   <span class="invalid-feedback" role="alert">
								<strong class="strong">Cet email est deja aquis</strong>
							   </span>
							  @enderror
              </div>
              <div class="mb-3 form-password-toggle">
                <label class="form-label">Ancien mot de passe</label>
                <div class="input-group input-group-merge">
                  <input type="password"  id="anc_password" class="form-control" name="anc_password" required placeholder="Mot ancien mot de passe" />
                  <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
              </div>
              <div class="mb-3 form-password-toggle">
                <label class="form-label" >Nouveau mot de passe</label>
                <div class="input-group input-group-merge">
                  <input type="password"  id="new_password" class="form-control @error('new_password')is-invalid @enderror" name="new_password" required placeholder="Mot Nouveau mot de passe" />
                  <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  @error('new_password')
							   <span class="invalid-feedback" role="alert">
								<strong class="strong">Se champ doit avoir au moins 8 carractère</strong>
							   </span>
							  @enderror
                </div>
              </div>
              
              <div class="mb-3">
                <label for="phone" class="form-label">Telephone</label>
                <input type="text"  value="{{$user->phone}}" required class="form-control @error('phone')is-invalid @enderror" id="phone" name="phone" placeholder="Entrer votre numero" />
                @error('phone')
							   <span class="invalid-feedback" role="alert">
								<strong class="strong">Se champ est deja aquis</strong>
							   </span>
							  @enderror
              </div>
              <div class="mb-3">
                <label for="ville"   class="form-label">Ville</label>
                <input type="text" value="{{$user->ville}}" class="form-control " id="ville" name="ville" placeholder="Entrer votre ville" />
              </div>
              
              <div class="mb-3">
                <div class="form-check">
                 
                </div>
              </div>
              <button type="submit" class="btn btn-primary d-grid w-100">Modifier </button>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
       
      </div>
    </div>
  </div>
</div>
