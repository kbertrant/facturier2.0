@extends('main')
@section('title', ' - Entreprise')
@section('main-content')

  
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Votre </span> Entreprise
    </h4>
  <!-- Header -->
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        
        <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
          <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
          <img src="{{ URL::to('enterprises/'.$entreprise->logo_ent) }}"  class="image my-2 ms-0 ms-sm-4 rounded">
          </div>
          <div class="flex-grow-1 mt-3 mt-sm-5">
            <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
              <div class="user-profile-info">
                <h1>{{$entreprise->name_ent}}</h1>
                <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                  <li class="list-inline-item fw-medium">
                    <i class='bx bx-calendar-alt'></i>:  {{$entreprise->address_ent}}
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Header -->
  
  <!-- Navbar pills -->
  <div class="row">
    <div class="col-md-12">
      <ul class="nav nav-pills flex-column flex-sm-row mb-4">
      @include('entreprise.ent-up')
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"><i class='bx bx-check me-1'></i>Modifer</button>
      </ul>
    </div>
  </div>
  <!--/ Navbar pills -->
  
  <!-- User Profile Content -->
  <div class="row">
    <div class="col-xl-4 col-lg-5 col-md-5">
      <!-- About User -->
      <div class="card mb-4">
        <div class="card-body">
          <small class="text-muted text-uppercase">A propos</small>
          <ul class="list-unstyled mb-4 mt-3">
            <li class="d-flex align-items-center mb-3"><i class="bx bx-user"></i><span class="fw-medium mx-2">Nom complet:</span> <span>{{$entreprise->name_ent}}</span></li>
            <li class="d-flex align-items-center mb-3"><i class="bx bx-check"></i><span class="fw-medium mx-2">Registre Comm.:</span> <span>{{$entreprise->rc_ent}}</span></li>
            <li class="d-flex align-items-center mb-3"><i class="bx bx-check"></i><span class="fw-medium mx-2">Numero Contribuable:</span> <span>{{$entreprise->nc_ent}}</span></li>
            <li class="d-flex align-items-center mb-3"><i class="bx bx-check"></i><span class="fw-medium mx-2">Owner:</span> <span>{{$entreprise->owner_ent}}</span></li>
            <li class="d-flex align-items-center mb-3"><i class="bx bx-check"></i><span class="fw-medium mx-2">Bank:</span> <span>{{$entreprise->bank_ent}}</span></li>
            <li class="d-flex align-items-center mb-3"><i class="bx bx-check"></i><span class="fw-medium mx-2">Regime fiscal:</span> <span>{{$entreprise->regim_fisc_ent}}</span></li>
          </ul>
          <small class="text-muted text-uppercase">Contacts</small>
          <ul class="list-unstyled mb-4 mt-3">
            <li class="d-flex align-items-center mb-3"><i class="bx bx-phone"></i><span class="fw-medium mx-2">Contact:</span> <span> {{$entreprise->phone_ent}}</span></li>
            <li class="d-flex align-items-center mb-3"><i class="bx bx-envelope"></i><span class="fw-medium mx-2">Adresse:</span> <span>{{$entreprise->address_ent}}</span></li>
          </ul>
        </div>
      </div>
      <!--/ About User -->
      
    </div>
    <div class="col-xl-8 col-lg-7 col-md-7">
      <!-- Activity Timeline -->
      <div class="card card-action mb-4">
        <div class="card-header align-items-center">
          <h5 class="card-action-title mb-0"><i class='bx bx-list-ul me-2'></i>Activities</h5>
          <div class="card-action-element">
            <div class="dropdown">
              <button type="button" class="btn dropdown-toggle hide-arrow p-0" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-dots-vertical-rounded"></i></button>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="javascript:void(0);">Share timeline</a></li>
                <li><a class="dropdown-item" href="javascript:void(0);">Suggest edits</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="javascript:void(0);">Report bug</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="card-body">
          <ul class="timeline ms-2">
            @foreach($acts as $i=>$act)
              <li class="timeline-item timeline-item-transparent">
                <span class="timeline-point-wrapper"><span class="timeline-point timeline-point-info"></span></span>
                <div class="timeline-event">
                  <div class="timeline-header mb-1">
                    <h1 class="mb-0">{{$act->lib_histo}}</h1>
                    <small class="text-muted">{{$act->date_histo}}</small>
                  </div>
                  <h6 class="mb-0">{{$act->name}}</h6>
                </div>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
      <!--/ Activity Timeline -->
    </div>
  </div>
</div>
@endsection