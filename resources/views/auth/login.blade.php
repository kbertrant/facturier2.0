@extends('layouts.app')
@section('title', ' - Login')
@section('contentLogin')

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
							<div class="text w-100 h-100">
							<p class="inscription"><span>Nouveau ?  <a href="{{ route('register') }}">Inscrivez-vous</a></span></p>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores quibusdam numquam est fugiat repudiandae facilis Lorem, ipsum dolor sit amet consectetur adipisicing elit. Fuga sed vel temporibus dolor, aliquam atque numquam? Eligendi cumque debitis libero explicabo, Natus provident necessitatibus possimus pariatur! </p>
							</div>
			      </div>
						<div class="login-wrap p-4 p-lg-5">
			      	<div class="d-flex">
			      		<div class="w-100">
			      			<h3 class="mb-4">Singin in</h3>
			      		</div>
								<div class="w-100">
									<p class="social-mediaa d-flex justify-content-end">
										<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>
										<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a>
									</p>
								</div>
			      	</div>
							<form action="{{ route('login') }}" method="POST" class="signin-form">
                                @csrf
			      		<div class="form-group mb-3">
			      			<label class="label" for="name">Adresse Email</label>
			      			<input id="email" type="email" class="form-control shadow bg-body-tertiary rounded" name="email"placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
			      		</div>
                          @error('email')
                          <span class="invalid-feedback" role="alert">
                            <strong>l'email est inconue.veillez fournir l'email correcte ou créer un compte</strong>
                          </span>
                        @enderror

		            <div class="form-group mb-3">
		            	<label class="label" for="password">Mot de passe</label>
		              <input type="password" class="form-control shadow p-3 mb-5 bg-body-tertiary rounded" placeholder="Mot de pass" name="password" required autofocus>
		            </div>
                    @error('password')
                          <span class="invalid-feedback" role="alert">
                            <strong>l'email est inconue.veillez fournir le password correcte ou créer un compte</strong>
                          </span>
                        @enderror
		            <div class="form-group">
		            	<button type="submit" class="form-control btn btn-primary submi px-3 mb-4">Connexion</button>
		            </div>
		            <div class="form-group d-md-flex">
		            	<div class="w-50 text-left">
			            	<label class="checkbox-wrap checkbox-primary mb-0">se souvenir de moi
									  <input type="checkbox" checked>
									  <span class="checkmark"></span>
										</label>
									</div>
									<div class="w-50 text-md-right">
									<a href="{{ route('password.request') }}">
                    <small>Mot de passe oublié ?</small>
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
  <!-- 👋 -->
@endsection
