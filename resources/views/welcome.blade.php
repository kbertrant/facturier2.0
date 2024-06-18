@extends('layouts.app')
@section('title', ' - Bienvenue')

@section('content')
<!--[if lte IE 9]>
      <p class="browserupgrade">
        You are using an <strong>outdated</strong> browser. Please
        <a href="https://browsehappy.com/">upgrade your browser</a> to improve
        your experience and security.
      </p>
    <![endif]-->

    <!-- ======== header start ======== -->
    <header class="header">
      <div class="navbar-area">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-12">
              <nav class="navbar navbar-expand-lg">
                <div class="app-brand demo">
                  <a href="{{route('home')}}" class="app-brand-link">
                    <span class="app-brand-logo demo">
                      <svg
                        width="25"
                        viewBox="0 0 25 42"
                        version="1.1"
                        xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink"
                      >
                        <defs>
                          <path
                            d="M13.7918663,0.358365126 L3.39788168,7.44174259 C0.566865006,9.69408886 -0.379795268,12.4788597 0.557900856,15.7960551 C0.68998853,16.2305145 1.09562888,17.7872135 3.12357076,19.2293357 C3.8146334,19.7207684 5.32369333,20.3834223 7.65075054,21.2172976 L7.59773219,21.2525164 L2.63468769,24.5493413 C0.445452254,26.3002124 0.0884951797,28.5083815 1.56381646,31.1738486 C2.83770406,32.8170431 5.20850219,33.2640127 7.09180128,32.5391577 C8.347334,32.0559211 11.4559176,30.0011079 16.4175519,26.3747182 C18.0338572,24.4997857 18.6973423,22.4544883 18.4080071,20.2388261 C17.963753,17.5346866 16.1776345,15.5799961 13.0496516,14.3747546 L10.9194936,13.4715819 L18.6192054,7.984237 L13.7918663,0.358365126 Z"
                            id="path-1"
                          ></path>
                          <path
                            d="M5.47320593,6.00457225 C4.05321814,8.216144 4.36334763,10.0722806 6.40359441,11.5729822 C8.61520715,12.571656 10.0999176,13.2171421 10.8577257,13.5094407 L15.5088241,14.433041 L18.6192054,7.984237 C15.5364148,3.11535317 13.9273018,0.573395879 13.7918663,0.358365126 C13.5790555,0.511491653 10.8061687,2.3935607 5.47320593,6.00457225 Z"
                            id="path-3"
                          ></path>
                          <path
                            d="M7.50063644,21.2294429 L12.3234468,23.3159332 C14.1688022,24.7579751 14.397098,26.4880487 13.008334,28.506154 C11.6195701,30.5242593 10.3099883,31.790241 9.07958868,32.3040991 C5.78142938,33.4346997 4.13234973,34 4.13234973,34 C4.13234973,34 2.75489982,33.0538207 2.37032616e-14,31.1614621 C-0.55822714,27.8186216 -0.55822714,26.0572515 -4.05231404e-15,25.8773518 C0.83734071,25.6075023 2.77988457,22.8248993 3.3049379,22.52991 C3.65497346,22.3332504 5.05353963,21.8997614 7.50063644,21.2294429 Z"
                            id="path-4"
                          ></path>
                          <path
                            d="M20.6,7.13333333 L25.6,13.8 C26.2627417,14.6836556 26.0836556,15.9372583 25.2,16.6 C24.8538077,16.8596443 24.4327404,17 24,17 L14,17 C12.8954305,17 12,16.1045695 12,15 C12,14.5672596 12.1403557,14.1461923 12.4,13.8 L17.4,7.13333333 C18.0627417,6.24967773 19.3163444,6.07059163 20.2,6.73333333 C20.3516113,6.84704183 20.4862915,6.981722 20.6,7.13333333 Z"
                            id="path-5"
                          ></path>
                        </defs>
                        <g id="g-app-brand" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <g id="Brand-Logo" transform="translate(-27.000000, -15.000000)">
                            <g id="Icon" transform="translate(27.000000, 15.000000)">
                              <g id="Mask" transform="translate(0.000000, 8.000000)">
                                <mask id="mask-2" fill="white">
                                  <use xlink:href="#path-1"></use>
                                </mask>
                                <use fill="#696cff" xlink:href="#path-1"></use>
                                <g id="Path-3" mask="url(#mask-2)">
                                  <use fill="#696cff" xlink:href="#path-3"></use>
                                  <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-3"></use>
                                </g>
                                <g id="Path-4" mask="url(#mask-2)">
                                  <use fill="#696cff" xlink:href="#path-4"></use>
                                  <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-4"></use>
                                </g>
                              </g>
                              <g
                                id="Triangle"
                                transform="translate(19.000000, 11.000000) rotate(-300.000000) translate(-19.000000, -11.000000) "
                              >
                                <use fill="#696cff" xlink:href="#path-5"></use>
                                <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-5"></use>
                              </g>
                            </g>
                          </g>
                        </g>
                      </svg>
                    </span>
                    <span class="app-brand-text demo menu-text fw-bold ms-2">Facturier 2.0</span>
                  </a>
                </div>
                <button
                  class="navbar-toggler"
                  type="button"
                  data-bs-toggle="collapse"
                  data-bs-target="#navbarSupportedContent"
                  aria-controls="navbarSupportedContent"
                  aria-expanded="false"
                  aria-label="Toggle navigation"
                >
                  <span class="toggler-icon"></span>
                  <span class="toggler-icon"></span>
                  <span class="toggler-icon"></span>
                </button>

                <div
                  class="collapse navbar-collapse sub-menu-bar"
                  id="navbarSupportedContent"
                >
                  <ul id="nav" class="navbar-nav ms-auto">
                    <li class="nav-item">
                      <a class="page-scroll active" href="#home">Accueil</a>
                    </li>
                    <li class="nav-item">
                      <a class="page-scroll" href="#features">Fonctionnalités</a>
                    </li>
                    <li class="nav-item">
                      <a class="page-scroll" href="#about">Facturier2.0</a>
                    </li>

                    <li class="nav-item">
                      <a class="page-scroll" href="#why">Pourquoi ?</a>
                    </li>
                    <li class="nav-item">
                      <a href="javascript:void(0)">Pricing</a>
                    </li>
                    @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    
                  </ul>
                </div>
                <!-- navbar collapse -->
              </nav>
              <!-- navbar -->
            </div>
          </div>
          <!-- row -->
        </div>
        <!-- container -->
      </div>
      <!-- navbar area -->
    </header>
    <!-- ======== header end ======== -->

    <!-- ======== hero-section start ======== -->
    <section id="home" class="hero-section">
      <div class="container">
        <div class="row align-items-center position-relative">
          <div class="col-lg-6">
            <div class="hero-content">
              <h1 class="wow fadeInUp" data-wow-delay=".4s">
                Propulsez votre commerce 
              </h1>
              <p class="wow fadeInUp" data-wow-delay=".6s">
                Changez la vision de vos finances ou que vous soyez.
              </p>
              <a
                href="javascript:void(0)"
                class="main-btn border-btn btn-hover wow fadeInUp"
                data-wow-delay=".6s"
                >Inscrivez-vous maintenant </a
              >
              <a href="#features" class="scroll-bottom">
                <i class="lni lni-arrow-down"></i
              ></a>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="hero-img wow fadeInUp" data-wow-delay=".5s">
              <img src="assets/img/hero/dashboard.png" alt="" />
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ======== hero-section end ======== -->

    <!-- ======== feature-section start ======== -->
    <section id="features" class="feature-section pt-120">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-4 col-md-8 col-sm-10">
            <div class="single-feature">
              <div class="icon">
                <i class="lni lni-bootstrap"></i>
              </div>
              <div class="content">
                <h3>Factures normalisée </h3>
                <p>
                  Toutes vos factures sont enregistrées par statut et sécurisées. 
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-8 col-sm-10">
            <div class="single-feature">
              <div class="icon">
                <i class="lni lni-layout"></i>
              </div>
              <div class="content">
                <h3>Gestion des articles et stock </h3>
                <p>
                  Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                  diam nonumy eirmod tempor invidunt ut labore
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-8 col-sm-10">
            <div class="single-feature">
              <div class="icon">
                <i class="lni lni-coffee-cup"></i>
              </div>
              <div class="content">
                <h3>Gardez vos états à jour</h3>
                <p>
                  Gardez vos finances à jour, grace à des rapports et graphes en temps reel.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ======== feature-section end ======== -->

    <!-- ======== about-section start ======== -->
    <section id="about" class="about-section pt-150">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-xl-6 col-lg-6">
            <div class="about-img">
              <img src="assets/img/view-client.png" alt="" class="w-100" />
              <img
                src="assets/img/about/about-left-shape.svg"
                alt=""
                class="shape shape-1"
              />
              <img
                src="assets/img/about/left-dots.svg"
                alt=""
                class="shape shape-2"
              />
            </div>
          </div>
          <div class="col-xl-6 col-lg-6">
            <div class="about-content">
              <div class="section-title mb-30">
                <h2 class="mb-25 wow fadeInUp" data-wow-delay=".2s">
                  Parfaite solution pour le suivi client 
                </h2>
                <p class="wow fadeInUp" data-wow-delay=".4s">
                  Les informations de vos clients sont visibles en temps reels.
                   Verifiez leurs impayés et consultez ce que vous leur reclamez.
                </p>
              </div>
              <a
                href="javascript:void(0)"
                class="main-btn btn-hover border-btn wow fadeInUp"
                data-wow-delay=".6s"
                >Savoir plus </a
              >
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ======== about-section end ======== -->

    <!-- ======== about2-section start ======== -->
    <section id="about" class="about-section pt-150">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-xl-6 col-lg-6">
            <div class="about-content">
              <div class="section-title mb-30">
                <h2 class="mb-25 wow fadeInUp" data-wow-delay=".2s">
                  Easy to Use with Tons of Awesome Features
                </h2>
                <p class="wow fadeInUp" data-wow-delay=".4s">
                  Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                  diam nonumy eirmod tempor invidunt ut labore et dolore magna
                  aliquyam erat, sed diam voluptua.
                </p>
              </div>
              <ul>
                <li>Quick Access</li>
                <li>Easily to Manage</li>
                <li>24/7 Support</li>
              </ul>
              <a
                href="javascript:void(0)"
                class="main-btn btn-hover border-btn wow fadeInUp"
                data-wow-delay=".6s"
                >Learn More</a
              >
            </div>
          </div>
          <div class="col-xl-6 col-lg-6 order-first order-lg-last">
            <div class="about-img-2">
              <img src="assets/img/about/about-2.png" alt="" class="w-100" />
              <img
                src="assets/img/about/about-right-shape.svg"
                alt=""
                class="shape shape-1"
              />
              <img
                src="assets/img/about/right-dots.svg"
                alt=""
                class="shape shape-2"
              />
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ======== about2-section end ======== -->

    <!-- ======== feature-section start ======== -->
    <section id="why" class="feature-extended-section pt-100">
      <div class="feature-extended-wrapper">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-xxl-5 col-xl-6 col-lg-8 col-md-9">
              <div class="section-title text-center mb-60">
                <h2 class="mb-25 wow fadeInUp" data-wow-delay=".2s">
                  Why Choose SaaSpal
                </h2>
                <p class="wow fadeInUp" data-wow-delay=".4s">
                  Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                  diam nonumy eirmod tempor invidunt ut labore et dolore
                </p>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-4 col-md-6">
              <div class="single-feature-extended">
                <div class="icon">
                  <i class="lni lni-display"></i>
                </div>
                <div class="content">
                  <h3>SaaS Focused</h3>
                  <p>
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                    diam nonumy eirmod tempor invidunt ut labore
                  </p>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6">
              <div class="single-feature-extended">
                <div class="icon">
                  <i class="lni lni-leaf"></i>
                </div>
                <div class="content">
                  <h3>Awesome Design</h3>
                  <p>
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                    diam nonumy eirmod tempor invidunt ut labore
                  </p>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6">
              <div class="single-feature-extended">
                <div class="icon">
                  <i class="lni lni-grid-alt"></i>
                </div>
                <div class="content">
                  <h3>Ready to Use</h3>
                  <p>
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                    diam nonumy eirmod tempor invidunt ut labore
                  </p>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6">
              <div class="single-feature-extended">
                <div class="icon">
                  <i class="lni lni-javascript"></i>
                </div>
                <div class="content">
                  <h3>Vanilla JS</h3>
                  <p>
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                    diam nonumy eirmod tempor invidunt ut labore
                  </p>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6">
              <div class="single-feature-extended">
                <div class="icon">
                  <i class="lni lni-layers"></i>
                </div>
                <div class="content">
                  <h3>Essential Sections</h3>
                  <p>
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                    diam nonumy eirmod tempor invidunt ut labore
                  </p>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6">
              <div class="single-feature-extended">
                <div class="icon">
                  <i class="lni lni-rocket"></i>
                </div>
                <div class="content">
                  <h3>Highly Optimized</h3>
                  <p>
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                    diam nonumy eirmod tempor invidunt ut labore
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ======== feature-section end ======== -->

    <!-- ======== subscribe-section start ======== -->
    <section id="contact" class="subscribe-section pt-120">
      <div class="container">
        <div class="subscribe-wrapper img-bg">
          <div class="row align-items-center">
            <div class="col-xl-6 col-lg-7">
              <div class="section-title mb-15">
                <h2 class="text-white mb-25">Subscribe Our Newsletter</h2>
                <p class="text-white pr-5">
                  Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                  diam nonumy eirmod tempor
                </p>
              </div>
            </div>
            <div class="col-xl-6 col-lg-5">
              <form action="#" class="subscribe-form">
                <input
                  type="email"
                  name="subs-email"
                  id="subs-email"
                  placeholder="Your Email"
                />
                <button type="submit" class="main-btn btn-hover">
                  Subscribe
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ======== subscribe-section end ======== -->

    <!-- ======== footer start ======== -->
    <footer class="footer">
      <div class="container">
        <div class="widget-wrapper">
          <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-6">
              <div class="footer-widget">
                <div class="app-brand demo">
                  <a href="{{route('home')}}" class="app-brand-link" style="color: azure">
                    <span class="app-brand-logo demo">
                      <svg
                        width="25"
                        viewBox="0 0 25 42"
                        version="1.1"
                        xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink"
                      >
                        <defs>
                          <path
                            d="M13.7918663,0.358365126 L3.39788168,7.44174259 C0.566865006,9.69408886 -0.379795268,12.4788597 0.557900856,15.7960551 C0.68998853,16.2305145 1.09562888,17.7872135 3.12357076,19.2293357 C3.8146334,19.7207684 5.32369333,20.3834223 7.65075054,21.2172976 L7.59773219,21.2525164 L2.63468769,24.5493413 C0.445452254,26.3002124 0.0884951797,28.5083815 1.56381646,31.1738486 C2.83770406,32.8170431 5.20850219,33.2640127 7.09180128,32.5391577 C8.347334,32.0559211 11.4559176,30.0011079 16.4175519,26.3747182 C18.0338572,24.4997857 18.6973423,22.4544883 18.4080071,20.2388261 C17.963753,17.5346866 16.1776345,15.5799961 13.0496516,14.3747546 L10.9194936,13.4715819 L18.6192054,7.984237 L13.7918663,0.358365126 Z"
                            id="path-1"
                          ></path>
                          <path
                            d="M5.47320593,6.00457225 C4.05321814,8.216144 4.36334763,10.0722806 6.40359441,11.5729822 C8.61520715,12.571656 10.0999176,13.2171421 10.8577257,13.5094407 L15.5088241,14.433041 L18.6192054,7.984237 C15.5364148,3.11535317 13.9273018,0.573395879 13.7918663,0.358365126 C13.5790555,0.511491653 10.8061687,2.3935607 5.47320593,6.00457225 Z"
                            id="path-3"
                          ></path>
                          <path
                            d="M7.50063644,21.2294429 L12.3234468,23.3159332 C14.1688022,24.7579751 14.397098,26.4880487 13.008334,28.506154 C11.6195701,30.5242593 10.3099883,31.790241 9.07958868,32.3040991 C5.78142938,33.4346997 4.13234973,34 4.13234973,34 C4.13234973,34 2.75489982,33.0538207 2.37032616e-14,31.1614621 C-0.55822714,27.8186216 -0.55822714,26.0572515 -4.05231404e-15,25.8773518 C0.83734071,25.6075023 2.77988457,22.8248993 3.3049379,22.52991 C3.65497346,22.3332504 5.05353963,21.8997614 7.50063644,21.2294429 Z"
                            id="path-4"
                          ></path>
                          <path
                            d="M20.6,7.13333333 L25.6,13.8 C26.2627417,14.6836556 26.0836556,15.9372583 25.2,16.6 C24.8538077,16.8596443 24.4327404,17 24,17 L14,17 C12.8954305,17 12,16.1045695 12,15 C12,14.5672596 12.1403557,14.1461923 12.4,13.8 L17.4,7.13333333 C18.0627417,6.24967773 19.3163444,6.07059163 20.2,6.73333333 C20.3516113,6.84704183 20.4862915,6.981722 20.6,7.13333333 Z"
                            id="path-5"
                          ></path>
                        </defs>
                        <g id="g-app-brand" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <g id="Brand-Logo" transform="translate(-27.000000, -15.000000)">
                            <g id="Icon" transform="translate(27.000000, 15.000000)">
                              <g id="Mask" transform="translate(0.000000, 8.000000)">
                                <mask id="mask-2" fill="white">
                                  <use xlink:href="#path-1"></use>
                                </mask>
                                <use fill="#696cff" xlink:href="#path-1"></use>
                                <g id="Path-3" mask="url(#mask-2)">
                                  <use fill="#696cff" xlink:href="#path-3"></use>
                                  <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-3"></use>
                                </g>
                                <g id="Path-4" mask="url(#mask-2)">
                                  <use fill="#696cff" xlink:href="#path-4"></use>
                                  <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-4"></use>
                                </g>
                              </g>
                              <g
                                id="Triangle"
                                transform="translate(19.000000, 11.000000) rotate(-300.000000) translate(-19.000000, -11.000000) "
                              >
                                <use fill="#696cff" xlink:href="#path-5"></use>
                                <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-5"></use>
                              </g>
                            </g>
                          </g>
                        </g>
                      </svg>
                    </span>
                    <span class="app-brand-text demo menu-text fw-bold ms-1">Facturier 2.0</span>
                  </a>
                </div>
                <p class="desc mb-30 text-white">
                  Propulsez votre commerce et faites des economies.
                </p>
                <ul class="socials">
                  <li>
                    <a href="jvascript:void(0)">
                      <i class="lni lni-facebook-filled"></i>
                    </a>
                  </li>
                  <li>
                    <a href="jvascript:void(0)">
                      <i class="lni lni-twitter-filled"></i>
                    </a>
                  </li>
                </ul>
              </div>
            </div>

            <div class="col-xl-2 col-lg-2 col-md-6">
              <div class="footer-widget">
                <h3>About Us</h3>
                <ul class="links">
                  <li><a href="javascript:void(0)">Accueil</a></li>
                  <li><a href="javascript:void(0)">Fonctionnalités</a></li>
                  <li><a href="javascript:void(0)">Pourquoi facturier2.0 ?</a></li>
                </ul>
              </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-6">
              <div class="footer-widget">
                <h3>Fonctionnalités</h3>
                <ul class="links">
                  <li><a href="javascript:void(0)">Comment ça marche ?</a></li>
                  <li><a href="javascript:void(0)">Politique de confidentialité</a></li>
                  <li><a href="javascript:void(0)">Conditions d'utilisation</a></li>
                  <li><a href="javascript:void(0)">Politique de remboursement</a></li>
                </ul>
              </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-6">
              <div class="footer-widget">
                <h3>Autres Produits</h3>
                <ul class="links">
                  <li><a href="jvascript:void(0)">Gestion d'un patient hospitalier</a></li>
                  <li><a href="jvascript:void(0)">Gestion d'un client hotellier </a></li>
                  <li><a href="jvascript:void(0)">Gestion du processus de recrutement </a></li>
                  <li><a href="jvascript:void(0)">Gestion des visites sur site </a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!-- ======== footer end ======== -->

    <!-- ======== scroll-top ======== -->
    <a href="#" class="scroll-top btn-hover">
      <i class="lni lni-chevron-up"></i>
    </a>

    <!-- ======== JS here ======== -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/main.js"></script>
@endsection
