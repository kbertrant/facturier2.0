@extends('layouts.app')
@section('title', ' - Register')
@section('contentRegister')

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
			      			<h3 class="mb-4">Sigin up</h3>
			      		</div>
								<div class="w-100">
									<p class="social-mediaa d-flex justify-content-end">
										<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>
										<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a>
									</p>
								</div>
			      	</div>
							<form method="POST" action="{{ route('register') }}" class="" enctype="multipart/form-data">
							@csrf
			      		<div class="form-group mb-3">
			      			<label class="label">Noms</label>
			      			<input id="name" type="text" class="form-control shadow bg-body-tertiary rounded @error('name') is-invalid @enderror" name="name"placeholder="Entrer votre nom" value="{{ old('name') }}" required autocomplete="name" autofocus>
							  @error('name')
							   <span class="invalid-feedback" role="alert">
								<strong class="strong">Ce nom est deja aquis</strong>
							   </span>
							  @enderror
			      		</div>
		               <div class="form-group mb-3">
		            	<label class="label" for="email">Email</label>
		                <input type="email" class="form-control shadow  bg-body-tertiary rounded @error('email') is-invalid @enderror" placeholder="Entrer votre email" name="email"value="{{ old('email') }}"autocomplete="email" required autofocus>
					    @error('email')
							<span class="invalid-feedback" role="alert">
							<strong>Cette email est deja aquis</strong>
							</span>
						  @enderror
		              </div>
                        <div class="form-group mb-3">
		            	    <label class="label" for="password">Mot de passe</label>
		                      <input id="password" name="password" type="password" class="form-control shadow  bg-body-tertiary rounded @error('password') is-invalid @enderror" placeholder="Mot de pass"  required>
							@error('password')
							<span class="invalid-feedback" role="alert">
							<strong>{{$message}}</strong>
							</span>
						   @enderror
						   
		                    </div>
                           <div class="form-group mb-3">
		            	 <label class="label" for="password-confirm">Confirmer mot de passe</label>
		                 <input id="password-confirm" type="password" class="form-control shadow  bg-body-tertiary rounded" placeholder="confirmer mot de pass" name="password_confirmation">
		                    </div>
                      <div class="form-group mb-3">
			      		   <label class="label" for="phone">Telephone</label>
			      		   <input id="phone" type="text" class="form-control shadow bg-body-tertiary rounded @error('phone') is-invalid @enderror" name="phone"placeholder="Entrer votre numero de telephone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>
					   @error('phone')
						   <span class="invalid-feedback" role="alert">
							   <strong class="strong">Ce numéro est deja aquis</strong>
						   </span>
						   @enderror
			            </div>
                        <div class="form-group mb-3">
			      			<label class="label" for="ville">ville</label>
			      			<input id="ville" type="text" class="form-control shadow bg-body-tertiary rounded @error('ville') is-invalid @enderror" name="ville"placeholder="Entrer le nom de votre ville" value="{{ old('ville') }}" required autocomplete="ville" autofocus>
							  @error('ville')
							  <span class="invalid-feedback" role="alert">
							  <strong class="strong">Ce champ est requis</strong>
							  </span>
							@enderror
			      		</div>
                        <div class="form-group mb-3">
			      			 <label class="label" for="entreprise">Le nom de votre entrreprise</label>
			      			 <input id="entreprise" type="text" class="form-control shadow bg-body-tertiary rounded @error('entreprise') is-invalid @enderror" name="entreprise"placeholder="Entrer le nom de votre entreprise" value="{{ old('entreprise') }}" required autocomplete="entreprise" autofocus>
						@error('entreprise')
                          <span class="invalid-feedback" role="alert">
                            <strong class="strong">Cette entreprise est deja aquis</strong>
                          </span>
                        @enderror
								</div>
                        <div class="form-group mb-3">
						<strong> Image (max 5Mo)</strong>
			      			  <label class="label" for="image">Image de l'utilisateur</label>
			      		      <input id="image" type="file" accept="image/png, image/jpg, image/jpeg" class="form-control shadow bg-body-tertiary rounded @error('image') is-invalid @enderror" name="image"placeholder="Entrer votre registre de commerce" required>
						 @error('')
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
