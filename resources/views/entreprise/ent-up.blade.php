


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Nouvelles informations</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      
      <form  class="mb-3" method="POST" action="{{ route('updateEntreprise') }}" enctype="multipart/form-data">
             @csrf
        <div class="card-body">
        <div class="d-flex align-items-start align-items-sm-center gap-4">
          <img src="/storage/{{$entreprise->logo_ent}}" alt="Logo" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
          <div class="button-wrapper">
            <label  class="btn btn-primary me-2 mb-4" tabindex="0">
              <span class="d-none d-sm-block">Modifier votre photo</span>
              <i class="bx bx-upload d-block d-sm-none"></i>
            </label>
            <input type="file" accept="logo_ent/png, logo_ent/jpg, logo_ent/jpeg" id="upload" name="logo_ent" required class="account-file-input"/>
            <!-- <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p> -->
          </div>
        </div>
      </div>
   
          <input type="text" name ="id" value="{{$entreprise->id}}" style="display:none" class="form-control" >

              <div class="mb-3">
                <label  class="form-label">Nom de l'entreprise</label>
                <input
                  type="text"
                  class="form-control"
                  id="name_ent"
                  required
                  name="name_ent"
                  placeholder="Entrer votre nom pour l'entreprise"
                  value="{{$entreprise->name_ent}}"
                  autofocus
                />
              </div>
              <div class="mb-3">
                <label for="rc_ent" class="form-label">R_c</label>
                <input type="text" class="form-control" id="rc_ent" required value="{{$entreprise->rc_ent}}" name="rc_ent" placeholder="Entrer votre rc" />
              </div>
              <div class="mb-3 ">
                <label class="form-label">NC</label>
                  <input
                    type="text"
                    id="nc_ent"
                    class="form-control"
                    name="nc_ent"
                    placeholder="Mot de passe"
                    value="{{$entreprise->nc_ent}}"
                    required
                  />
              </div>
              
              <div class="mb-3">
                <label  class="form-label">Telephone</label>
                <input type="text"  value="{{$entreprise->phone_ent}}" required class="form-control" id="phone_ent" name="phone_ent" placeholder="Entrer votre numero" />
              </div>
              <div class="mb-3">
                <label  value="{{$entreprise->address_ent}}" class="form-label">Adress</label>
                <input type="text" value="{{$entreprise->address_ent}}" class="form-control" id="address_ent" required name="address_ent" placeholder="Entrer votre adress" />
              </div>

              <div class="mb-3">
                <label  value="{{$entreprise->owner_ent}}" class="form-label">Owner</label>
                <input type="text" value="{{$entreprise->owner_ent}}" class="form-control" id="owner_ent" required name="owner_ent" placeholder="Entrer votre owner" />
              </div>

              <div class="mb-3">
                <label  value="{{$entreprise->bank_ent}}" class="form-label">Bank</label>
                <input type="text" class="form-control" value="{{$entreprise->bank_ent}}" id="bank_ent" required name="bank_ent" placeholder="Entrer votre bank" />
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
