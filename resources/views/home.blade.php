@extends('main')
@section('title', ' - Accueil')
@section('main-content')
 <!-- Content wrapper -->
 <div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row">
        <div class="col-lg-8 mb-4 order-0">
          <div class="card">
            <div class="d-flex align-items-end row">
              <div class="col-sm-7">
                <div class="card-body">
                  <h5 class="card-title text-primary">{{ __('mypages.wlc') }} {{$user->name}}! 🎉</h5>
                  <p class="mb-4">
                    {{ __('mypages.hmsen') }}
                  </p>
                </div>
              </div>
              <div class="col-sm-5 text-center text-sm-left">
                <div class="card-body pb-0 px-0 px-md-4">
                  <img
                    src="../assets/img/illustrations/man-with-laptop-light.png"
                    height="140"
                    alt="View Badge User"
                    data-app-dark-img="illustrations/man-with-laptop-dark.png"
                    data-app-light-img="illustrations/man-with-laptop-light.png"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 order-1">
          <div class="row">
            <div class="col-lg-6 col-md-12 col-6 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                      <img
                        src="../assets/img/icons/unicons/chart-success.png"
                        alt="chart success"
                        class="rounded"
                      />
                    </div>
                    <div class="dropdown">
                      <button
                        class="btn p-0"
                        type="button"
                        id="cardOpt3"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                        <a class="dropdown-item" href="javascript:void(0);">View More</a>
                        <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                      </div>
                    </div>
                  </div>
                  <span class="fw-semibold d-block mb-1">Articles</span>
                  <h3 class="card-title mb-2">{{$products}}</h3>
                  
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-12 col-6 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                      <img
                        src="../assets/img/icons/unicons/wallet-info.png"
                        alt="Credit Card"
                        class="rounded"
                      />
                    </div>
                    
                  </div>
                  <span>Depenses</span>
                  <h6 class="card-title text-nowrap mb-1">{{$depenses}} XAF</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Total Revenue -->
        <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
          <div class="card">
            <div class="row row-bordered g-0">
              <div class="col-md-12">
                <h5 class="card-header m-0 me-2 pb-3">Total Revenue</h5>
                <canvas id="lineChart"></canvas>
              </div>
            </div>
          </div>
        </div>
        <!--/ Total Revenue -->
        <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
          <div class="row">
            <div class="col-6 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                      <img src="../assets/img/icons/unicons/paypal.png" alt="Credit Card" class="rounded" />
                    </div>
                    
                  </div>
                  <span class="d-block mb-1">Paiements</span>
                  <h6 class="card-title text-nowrap mb-2">{{$paiements}} XAF</h6>
                </div>
              </div>
            </div>
            <div class="col-6 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                      <img src="../assets/img/icons/unicons/cc-primary.png" alt="Credit Card" class="rounded" />
                    </div>
                    
                  </div>
                  <span class="fw-semibold d-block mb-1">TVA Collectée</span>
                  <h6 class="card-title mb-2">{{$tva}} XAF</h6>
                </div>
              </div>
            </div>
            <div class="col-6 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                      <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt bx-lg bx-fade-up"></i></small>
                    </div>
                    
                  </div>
                  <span class="fw-semibold d-block mb-1">Ventes/jour</span>
                  <h6 class="card-title mb-2">{{$day_pay}} XAF</h6>
                </div>
              </div>
            </div>
            <div class="col-6 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                      <small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt bx-lg bx-fade-down"></i></small>
                    </div>
                  </div>
                  <span class="fw-semibold d-block mb-1">Depenses/jour</span>
                  <h6 class="card-title mb-2">{{$day_dep}} XAF</h6>
                </div>
              </div>
            </div>
            <!-- </div>
<div class="row"> -->
            
          </div>
        </div>
      </div>
      
    </div>
    <!-- / Content -->
@endsection

<script type="text/javascript">
   window.onload = function() {
        $(document).ready(function() {
        var ctx = document.getElementById('lineChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($data['labels']),
                datasets: [{
                    label: 'Payments income',
                    data: @json($data['payments']),
                    borderColor: 'rgba(22, 160, 133, 1)',
                    borderWidth: 3,
                    fill: false
                },{
                    label: 'Expenses',
                    data: @json($data['depenses']),
                    borderColor: 'rgba(255, 0, 0, 1)',
                    borderWidth: 3,
                    fill: false
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
      });
}
</script>
