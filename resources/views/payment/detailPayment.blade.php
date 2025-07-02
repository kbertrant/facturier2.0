@extends('main')
@section('title', ' - Paiement')
@section('main-content')

  
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Details </span> PaYment #{{$pay->ref_pay}}
    </h4>
    @if (session('success'))
      <div class="alert alert-danger" role="alert">
          {{ session('success') }}
      </div>
    @endif
    <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
      <div class="flex-grow-1 mt-3 mt-sm-5">
        <div class="row invoice-preview">
            <!-- Invoice -->
            <div class="col-xl-12 col-md-12 col-12 mb-md-0 mb-4">
              <div class="card invoice-preview-card">
                <div class="card-body">
                  <div class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column p-sm-3 p-0">
                    <div class="mb-xl-0 mb-4">
                      <div class="d-flex svg-illustration mb-3 gap-2">
                        <span class="app-brand-logo demo"><svg width="25" viewBox="0 0 25 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                          <defs>
                            <path d="M13.7918663,0.358365126 L3.39788168,7.44174259 C0.566865006,9.69408886 -0.379795268,12.4788597 0.557900856,15.7960551 C0.68998853,16.2305145 1.09562888,17.7872135 3.12357076,19.2293357 C3.8146334,19.7207684 5.32369333,20.3834223 7.65075054,21.2172976 L7.59773219,21.2525164 L2.63468769,24.5493413 C0.445452254,26.3002124 0.0884951797,28.5083815 1.56381646,31.1738486 C2.83770406,32.8170431 5.20850219,33.2640127 7.09180128,32.5391577 C8.347334,32.0559211 11.4559176,30.0011079 16.4175519,26.3747182 C18.0338572,24.4997857 18.6973423,22.4544883 18.4080071,20.2388261 C17.963753,17.5346866 16.1776345,15.5799961 13.0496516,14.3747546 L10.9194936,13.4715819 L18.6192054,7.984237 L13.7918663,0.358365126 Z" id="path-1"></path>
                            <path d="M5.47320593,6.00457225 C4.05321814,8.216144 4.36334763,10.0722806 6.40359441,11.5729822 C8.61520715,12.571656 10.0999176,13.2171421 10.8577257,13.5094407 L15.5088241,14.433041 L18.6192054,7.984237 C15.5364148,3.11535317 13.9273018,0.573395879 13.7918663,0.358365126 C13.5790555,0.511491653 10.8061687,2.3935607 5.47320593,6.00457225 Z" id="path-3"></path>
                            <path d="M7.50063644,21.2294429 L12.3234468,23.3159332 C14.1688022,24.7579751 14.397098,26.4880487 13.008334,28.506154 C11.6195701,30.5242593 10.3099883,31.790241 9.07958868,32.3040991 C5.78142938,33.4346997 4.13234973,34 4.13234973,34 C4.13234973,34 2.75489982,33.0538207 2.37032616e-14,31.1614621 C-0.55822714,27.8186216 -0.55822714,26.0572515 -4.05231404e-15,25.8773518 C0.83734071,25.6075023 2.77988457,22.8248993 3.3049379,22.52991 C3.65497346,22.3332504 5.05353963,21.8997614 7.50063644,21.2294429 Z" id="path-4"></path>
                            <path d="M20.6,7.13333333 L25.6,13.8 C26.2627417,14.6836556 26.0836556,15.9372583 25.2,16.6 C24.8538077,16.8596443 24.4327404,17 24,17 L14,17 C12.8954305,17 12,16.1045695 12,15 C12,14.5672596 12.1403557,14.1461923 12.4,13.8 L17.4,7.13333333 C18.0627417,6.24967773 19.3163444,6.07059163 20.2,6.73333333 C20.3516113,6.84704183 20.4862915,6.981722 20.6,7.13333333 Z" id="path-5"></path>
                          </defs>
                          <g id="g-app-brand" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="Brand-Logo" transform="translate(-27.000000, -15.000000)">
                              <g id="Icon" transform="translate(27.000000, 15.000000)">
                                <g id="Mask" transform="translate(0.000000, 8.000000)">
                                  <mask id="mask-2" fill="white">
                                    <use xlink:href="#path-1"></use>
                                  </mask>
                                  <use fill="var(--bs-primary)" xlink:href="#path-1"></use>
                                  <g id="Path-3" mask="url(#mask-2)">
                                    <use fill="var(--bs-primary)" xlink:href="#path-3"></use>
                                    <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-3"></use>
                                  </g>
                                  <g id="Path-4" mask="url(#mask-2)">
                                    <use fill="var(--bs-primary)" xlink:href="#path-4"></use>
                                    <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-4"></use>
                                  </g>
                                </g>
                                <g id="Triangle" transform="translate(19.000000, 11.000000) rotate(-300.000000) translate(-19.000000, -11.000000) ">
                                  <use fill="var(--bs-primary)" xlink:href="#path-5"></use>
                                  <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-5"></use>
                                </g>
                              </g>
                            </g>
                          </g>
                      </svg>
                      </span>
                      <span class="app-brand-text demo text-body fw-bold">{{$ent->name_ent}}</span>
                      </div>
                      <p class="mb-1">{{$ent->owner_ent}}</p>
                      <p class="mb-1">{{$ent->phone_ent}}</p>
                      <p class="mb-0">{{$ent->address_ent}}</p>
                    </div>
                    <div>
                      <h4>Paiement #{{$pay->ref_pay}}</h4>
                      <div class="mb-2">
                        <span class="me-1">Date:</span>
                        <span class="fw-medium">{{$pay->date_pay}}</span>
                      </div>
                      
                      <div>
                        <span class="me-1">Status:</span>
                        @if($pay->stat_pay == 'Pending')
                            <span class="badge bg-label-danger">{{$pay->stat_pay}}</span>
                        @else
                            <span class="badge bg-label-success">{{$pay->stat_pay}}</span>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-0">
                <div class="card-body">
                  <div class="row p-sm-3 p-0">
                    <div class="col-xl-6 col-md-12 col-sm-5 col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-4">
                      <h6 class="pb-2">Payment from:</h6>
                      <p class="mb-1">{{$cl->name_cli}}</p>
                      <p class="mb-1">{{$cl->raison_sociale}}</p>
                      <p class="mb-1">{{$cl->address_cli}}</p>
                      <p class="mb-1">{{$cl->phone_cli}}</p>
                      <p class="mb-0">{{$cl->cl_email}}</p>
                    </div>
                    
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table border-top m-0">
                    <thead>
                      <tr>
                        <th>Item</th>
                        <th>Description</th>
                        <th>Cost</th>
                        <th>Qty</th>
                        <th>Price</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($efs as $ef)
                        <tr>
                            <td class="text-nowrap">{{ $ef->ef_lib }}</td>
                            <td class="text-nowrap">{{ $ef->ef_lib }}</td>
                            <td>{{ number_format($ef->ef_pu,2) }}</td>
                            <td>{{ $ef->ef_qty }}</td>
                            <td>{{ number_format($ef->ef_ttc,2) }}</td>
                        </tr>
                        @endforeach
                    <tr>
                        <td colspan="3" class="align-top px-4 py-5">
                          <p class="mb-2">
                            <span class="me-1 fw-medium">Executé par:</span>
                            <span><b>{{ $usr->name }}</b></span>
                          </p>
                          <span>Thanks for your business</span>
                        </td>
                        <td class="text-end px-4 py-5">
                          <p class="mb-2">Subtotal:</p>
                          <p class="mb-2">Tax:</p>
                          <p class="mb-0">Total:</p>
                        </td>
                        <td class="px-4 py-5">
                          <p class="fw-medium mb-2"><b>{{number_format($pay->mht_pay,2)}} XAF<b></p>
                          <p class="fw-medium mb-2"><b>{{number_format($pay->reduction,2)}} XAF<b></p>
                          <p class="fw-medium mb-2"><b>{{number_format($pay->tva_pay,2)}} XAF<b></p>
                          <p class="fw-medium mb-0"><b>{{number_format($pay->mttc_pay,2)}} XAF<b></p> 
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
          
                <div class="card-body">
                  <div class="row">
                    <div class="col-12">
                      <span class="fw-medium">Note:</span>
                      <span>It was a pleasure working with you and your team. We hope you will keep us in mind for future freelance
                        projects. Thank You!</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /Invoice -->
          
            <!-- Invoice Actions -->
            <div class="col-xl-12 col-md-12 col-12 mb-md-0 mb-4 invoice-actions">
              <div class="card">
                <div class="card-body">
                    <a href="/payment/generate/{{$pay->id}}">
                        <button class="btn btn-primary d-grid w-100 mb-3">
                            <span class="d-flex align-items-center justify-content-center text-nowrap"><i class="bx bx-download bx-xs me-1"></i>Telecharger</span>
                        </button>
                    </a>
                    
                </div>
              </div>
            </div>
            <!-- /Invoice Actions -->
          </div>
      </div>
    </div>
</div>
@endsection


