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
			      			<h3 class="mb-4">Sing-in</h3>
			      		</div>
								<div class="w-100">
									<p class="social-mediaa d-flex justify-content-end">
										<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>
										<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a>
									</p>
								</div>
			      	</div>
							<form  method="POST" action="{{ route('login') }}">
                                @csrf
			      		<div class="form-group mb-3">
			      			<label class="label">Adresse Email</label>
			      			<input id="email" type="email" class="form-control shadow bg-body-tertiary rounded @error('email') is-invalid @enderror" name="email"placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
					    @error('email')
                            <span class="invalid-feedback" role="alert">
                              <strong class="strong">l'email ou le mot de pass est incorect</strong>
                            </span>
                        @enderror
					</div>
                          
		            <div class="form-group mb-3">
		            	<label class="label" >Mot de passe</label>
		              <input type="password" class="form-control shadow p-3 mb-5 bg-body-tertiary rounded" placeholder="Mot de pass" name="password" required autocomplete="current-password">
					</div>
                  
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
					@if (Route::has('password.request'))   
					<a href="{{ route('password.request') }}"> <small>Mot de passe oublié ?</small> </a>
					@endif
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
