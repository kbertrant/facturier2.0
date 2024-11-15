@extends('main')
@section('title', ' - Tresorerie')
@section('main-content')

  
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">{{ __('mypages.ltr') }}</span>
    </h4>
    @if (session('success'))
      <div class="alert alert-danger" role="alert">
          {{ session('success') }}
      </div>
    @endif
    <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
        <div class="row flex-grow-1 mt-3 mt-sm-5">
        
            <!-- Transactions -->
        <div class="col-md-12 col-xs-12 col-lg-6 order-2 mb-4">
            <div class="card h-100">
              <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="card-title m-0 me-2">{{ __('mypages.ltr') }}</h5>
                
              </div>
              <div class="card-body">
                <ul class="p-0 m-0">
                    @foreach ($tresors as $tresor)
                  <li class="d-flex mb-4 pb-1">
                    <div class="d-flex flex-shrink-5 me-5">
                        @if($tresor->mouvement == "OUT")
                        <small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i> -{{number_format($tresor->amount,0)}}</small>
                        @else
                            <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +{{number_format($tresor->amount,0)}}</small>
                        @endif
                    </div>
                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                      <div class="me-2">
                        <small class="text-muted d-block mb-1">{{$tresor->mouvement}}</small>
                        <h6 class="mb-0">{{$tresor->date_tres}}</h6>
                      </div>
                      <div class="user-progress d-flex align-items-center gap-1">
                        <h6 class="mb-0">{{number_format($tresor->amount_tres,0)}}</h6>
                        <span class="text-muted"> XAF</span>
                      </div>
                    </div>
                  </li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
          <!--/ Transactions -->
        
          <div class="col-lg-6 col-md-12 col-xs-12 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-5">
                    <img
                      src="../assets/img/icons/unicons/wallet.png"
                      alt="chart success"
                      class="rounded"
                    />
                  </div>
                  
                </div>
                <h2 class="fw-semibold d-block mb-1">{{ __('mypages.yccf') }}</h2>
                <h1 class="card-title mb-2">{{number_format($actuel->amount_tres,0)}} <span class="text-muted"> XAF</span></h1>
                @if($actuel->mouvement == "OUT")
                  <small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i> -{{number_format($actuel->amount,0)}}</small>
                @else
                  <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +{{number_format($actuel->amount,0)}}</small>
                @endif
              </div>
            </div>
          </div>
        </div>
        
    </div>
</div>
@endsection
