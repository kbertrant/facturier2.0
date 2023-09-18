@extends('layouts.app')
@section('title', ' - Entreprise')
@section('contentEntreprise')

  <section class="ftco-section">
    <div class="precedent">
    <i class="fa-solid fa-left-long fa-beat"> <a class="navbar-brand" href="{{ url('/') }} " ><span>Precedent</span></a></i>
    </div>
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10">
					<div class="wrap d-md-flex">
						<div class="text-wrap p-lg-5 text-center align-items-center d-flex  order-md-last">
							<div class="text"ali>
							
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores quibusdam numquam est fugiat repudiandae facilis Lorem, ipsum dolor sit amet consectetur adipisicing elit. Fuga sed vel temporibus dolor, aliquam atque numquam? Eligendi cumque debitis libero explicabo, Natus provident necessitatibus possimus pariatur! </p>
							</div>
			      </div>
						<div class="login-wrap p-4 p-lg-5">
			      	<div class="d-flex">
			      		<div class="w-100">
			      			<h3 class="mb-4">Entreprise</h3>
			      		</div>
								<div class="w-100">
									<p class="social-mediaa d-flex justify-content-end">
										<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>
										<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a>
									</p>
								</div>
			      	</div>
							<form method="POST" action="{{ route('store_ent') }}" class="" enctype="multipart/form-data">
							@csrf
			      		<div class="form-group mb-3">
			      			<label class="label">Noms de l'entreprise</label>
			      			<input id="name_ent" type="text" class="form-control shadow bg-body-tertiary rounded @error('name_ent') is-invalid @enderror" name="name_ent"placeholder="Entrer le nom" value="{{ old('name_ent') }}" required autocomplete="name_ent" autofocus>
							  @error('name_ent')
							   <span class="invalid-feedback" role="alert">
								<strong class="strong">Ce nom est deja aquis</strong>
							   </span>
							  @enderror
			      		</div>
		               <div class="form-group mb-3">
		            	<label class="label" for="rc_ent">rc_ent</label>
		                <input type="text" class="form-control shadow  bg-body-tertiary rounded @error('rc_ent') is-invalid @enderror" placeholder="Entrer votre email" name="rc_ent"value="{{ old('rc_ent') }}" autocomplete="rc_ent" required autofocus>
					    @error('rc_ent')
							<span class="invalid-feedback" role="alert">
							<strong class="strong">Ce nom est deja aquis</strong>
							</span>
						  @enderror
		              </div>
                        <div class="form-group mb-3">
		            	    <label class="label" for="nc_ent">nc_ent</label>
		                      <input id="nc_ent" name="nc_ent" type="text" class="form-control shadow  bg-body-tertiary rounded @error('nc_ent') is-invalid @enderror" placeholder="Mot de pass" value="{{ old('nc_ent') }}" autocomplete="nc_ent" autocomplete="nc_ent" autofocus required>
							@error('nc_ent')
							<span class="invalid-feedback" role="alert">
							<strong class="strong">Ce nom est deja aquis</strong>
							</span>
						   @enderror
						   
		                    </div>
                           <div class="form-group mb-3">
		            	 <label class="label" for="bank_ent">Confirmer mot de passe</label>
		                 <input id="bank_ent" type="text" class="form-control shadow  bg-body-tertiary rounded @error('bank_ent') is-invalid @enderror" placeholder="confirmer mot de pass" name="bank_ent" value="{{ old('bank_ent') }}" required autocomplete="bank_ent" autofocus>
                         @error('bank_ent')
							<span class="invalid-feedback" role="alert">
							<strong>{{$message}}</strong>
							</span>
						   @enderror 
                        </div>
                      <div class="form-group mb-3">
			      		   <label class="label" for="phone_ent">Telephone</label>
			      		   <input id="phone_ent" type="text" class="form-control shadow bg-body-tertiary rounded @error('phone_ent') is-invalid @enderror" name="phone_ent" placeholder="Entrer votre numero de telephone" value="{{ old('phone_ent') }}" required autocomplete="phone_ent" autofocus>
					   @error('phone_ent')
						   <span class="invalid-feedback" role="alert">
							   <strong class="strong">Ce numéro est deja aquis</strong>
						   </span>
						   @enderror
			            </div>
                        <div class="form-group mb-3">
			      			<label class="label" for="address_ent">ville</label>
			      			<input id="address_ent" type="text" class="form-control shadow bg-body-tertiary rounded @error('address_ent') is-invalid @enderror" name="address_ent"placeholder="Entrer le nom de votre ville" value="{{ old('address_ent') }}" required autocomplete="address_ent" autofocus>
							  @error('address_ent')
							  <span class="invalid-feedback" role="alert">
							  <strong class="strong">Ce champ est requis</strong>
							  </span>
							@enderror
			      		</div>
                        <div class="form-group mb-3">
			      			 <label class="label" for="owner_ent">Le nom de votre entrreprise</label>
			      			 <input id="owner_ent" type="text" class="form-control shadow bg-body-tertiary rounded @error('owner_ent') is-invalid @enderror" name="owner_ent"placeholder="Entrer le nom de votre entreprise" value="{{ old('owner_ent') }}" required autocomplete="owner_ent" autofocus>
						@error('owner_ent')
                          <span class="invalid-feedback" role="alert">
                            <strong class="strong">Cette entreprise est deja aquis</strong>
                          </span>
                        @enderror
								</div>
                        <div class="form-group mb-3">
						<strong> Image (max 5Mo)</strong>
			      			  <label class="label" for="logo_ent">Image de l'utilisateur</label>
			      		      <input id="logo_ent" type="file" accept="image/png, image/jpg, image/jpeg" class="form-control shadow bg-body-tertiary rounded @error('logo_ent') is-invalid @enderror" name="logo_ent"placeholder="Entrer votre registre de commerce" required>
						 @error('logo_ent')
                          <span class="invalid-feedback" role="alert">
                            <strong>Cet image doit avoir 5Mo</strong>
                          </span>
                          @enderror 
								</div>
                          
                   <div class="mb-3 mt-5">
                   <div class="form-check">
                   <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" />
                   <label class="form-check-label" for="terms-conditions">
                    J'accepte les
                    <a href="javascript:void(0);">conditions et accords</a>
                   </label>
                   </div>
                   </div>      

		            <div class="form-group">
		            	<button type="submit" class="form-control btn btn-primary submi px-3 mb-4 mt-5">Inscription</button>
		            </div>
		            <div class="form-group d-md-flex">
		            	
									<div class="w-50 text-md-right">Deja inscris?
									<a href="{{ route('login') }}">
                    <small> connectez-vous</small>
                  </a>
									</div>
		            </div>
                  
		          </form>
		        </div>
		      </div>
				</div>
			</div>
		</div>
	</section> 
@endsection
