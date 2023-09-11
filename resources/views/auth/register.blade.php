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
							<form action="{{ route('register') }}" method="POST" class="signin-form">
                @csrf
			      		<div class="form-group mb-3">
			      			<label class="label" for="name">Noms</label>
			      			<input id="name" type="text" class="form-control shadow bg-body-tertiary rounded" name="name"placeholder="Entrer votre nom" value="{{ old('name') }}" required autocomplete="name" autofocus>
			      		</div>
                   @error('name')
                  <span class="invalid-feedback" role="alert">
                    <strong>Ce nom est deja aquis</strong>
                  </span>
                  @enderror
		            <div class="form-group mb-3">
		            	<label class="label" for="email">Email</label>
		              <input type="email" class="form-control shadow p-3 mb-5 bg-body-tertiary rounded" placeholder="Entrer votre email" name="email"value="{{ old('email') }}"autocomplete="email" required autofocus>
		            </div>
                    @error('email')
                          <span class="invalid-feedback" role="alert">
                            <strong>Cette email est deja aquis</strong>
                          </span>
                        @enderror
                        <div class="form-group mb-3">
		            	        <label class="label" for="password">Mot de passe</label>
		                      <input type="password" class="form-control shadow p-3 mb-5 bg-body-tertiary rounded" placeholder="Mot de pass" name="password" required autofocus>
		                    </div>
                    @error('password')
                          <span class="invalid-feedback" role="alert">
                            <strong>veillez fournir un password de huit carractères </strong>
                          </span>
                        @enderror
                        <div class="form-group mb-3">
		            	        <label class="label" for="password">Confirmer mot de passe</label>
		                      <input type="password" class="form-control shadow p-3 mb-5 bg-body-tertiary rounded" placeholder="confirmer mot de pass" name="confirm_password" required autofocus>
		                    </div>
                       @error('confirm_password')
                         <span class="invalid-feedback" role="alert">
                            <strong>Ne correspond pas</strong>
                          </span>
                       @enderror 
                      <div class="form-group mb-3">
			      			      <label class="label" for="phone">Telephone</label>
			      			      <input id="phone" type="text" class="form-control shadow bg-body-tertiary rounded" name="phone"placeholder="Entrer votre numero de telephone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>
			      		      </div>
                          @error('phone')
                          <span class="invalid-feedback" role="alert">
                            <strong>Ce numéro est deja aquis</strong>
                          </span>
                        @enderror
                        <div class="form-group mb-3">
			      			        <label class="label" for="ville">ville</label>
			      			        <input id="ville" type="text" class="form-control shadow bg-body-tertiary rounded" name="ville"placeholder="Entrer le nom de votre ville" value="{{ old('ville') }}" required autocomplete="ville" autofocus>
			      		        </div>
                          @error('ville')
                          <span class="invalid-feedback" role="alert">
                            <strong>Ce champ est requis</strong>
                          </span>
                        @enderror
                        <div class="form-group mb-3">
			      			       <label class="label" for="entreprise">Le nom de votre entrreprise</label>
			      			       <input id="entreprise" type="text" class="form-control shadow bg-body-tertiary rounded" name="entreprise"placeholder="Entrer le nom de votre entreprise" value="{{ old('entreprise') }}" required autocomplete="entreprise" autofocus>
			      		       </div>
                          @error('entreprise')
                          <span class="invalid-feedback" role="alert">
                            <strong>Cette entreprise est deja aquis</strong>
                          </span>
                        @enderror
                        <div class="form-group mb-3">
			      			        <label class="label" for="rc_ent">Registre commerce entrreprise</label>
			      		        	<input id="rc_ent" type="text" class="form-control shadow bg-body-tertiary rounded" name="rc_ent"placeholder="Entrer votre registre de commerce" value="{{ old('rc_ent') }}" required autocomplete="rc_ent" autofocus>
			      	        	</div>
                          @error('rc_ent')
                          <span class="invalid-feedback" role="alert">
                            <strong>Ce nom est deja aquis</strong>
                          </span>
                          @enderror 
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
