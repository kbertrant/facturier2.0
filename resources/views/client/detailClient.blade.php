@extends('main')
@section('title', ' - Details Client')
@section('main-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Details Client</span> {{$cl->name_cli}}
    </h4>
    @if (session('success'))
      <div class="alert alert-danger" role="alert">
          {{ session('success') }}
    </div>
    @endif
    <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
        <div class="flex-grow-1 mt-3 mt-sm-5">
        
            <div class="row">
                <!-- Customer-detail Sidebar -->
                <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
                  <!-- Customer-detail Card -->
                  <div class="card mb-4">
                    <div class="card-body">
                      <div class="customer-avatar-section">
                        <div class="d-flex align-items-center flex-column">
                          <img class="img-fluid rounded my-3" src="/images/default_client.png" height="110" width="110" alt="User avatar">
                          <div class="customer-info text-center">
                            <h4 class="mb-1"> {{$cl->name_cli}}</h4>
                            <small>Created #{{$cl->created_at}}</small>
                          </div>
                        </div>
                      </div>
                      <div class="d-flex justify-content-around flex-wrap mt-4 py-3">
                        <div class="d-flex align-items-center gap-2">
                          <div class="avatar">
                            <div class="avatar-initial rounded bg-label-primary"><i class="bx bx-cart-alt bx-sm"></i>
                            </div>
                          </div>
                          <div>
                            <h5 class="mb-0">{{$count}}</h5>
                            <span>Commandes</span>
                          </div>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                          <div class="avatar">
                            <div class="avatar-initial rounded bg-label-primary"><i class="bx bx-dollar bx-sm"></i>
                            </div>
                          </div>
                          <div>
                            <h5 class="mb-0">{{$sum_pay}} XAF</h5>
                            <span>Depenses</span>
                          </div>
                        </div>
                      </div>
              
                      <div class="info-container">
                        <small class="d-block pt-4 border-top fw-normal text-uppercase text-muted my-3">DETAILS</small>
                        <ul class="list-unstyled">
                          <li class="mb-3">
                            <span class="fw-medium me-2">Username:</span>
                            <span>{{$cl->name_cli}}</span>
                          </li>
                          <li class="mb-3">
                            <span class="fw-medium me-2">Email:</span>
                            <span>{{$cl->cl_email}}</span>
                          </li>
                          <li class="mb-3">
                            <span class="fw-medium me-2">Status:</span>
                            <span class="badge bg-label-success">{{$cl->status}}</span>
                          </li>
                          <li class="mb-3">
                            <span class="fw-medium me-2">Contact:</span>
                            <span>{{$cl->phone_cli}}</span>
                          </li>
              
                          <li class="mb-3">
                            <span class="fw-medium me-2">Address:</span>
                            <span>{{$cl->address_cli}}</span>
                          </li>
                        </ul>
                        <div class="d-flex justify-content-center">
                          <a href="javascript:;" class="btn btn-primary me-3" data-bs-target="#editUser" data-bs-toggle="modal">Modifier</a>
              
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /Customer-detail Card -->
                </div>
                <!--/ Customer Sidebar -->
                <!-- Customer Content -->
                <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
                  <!-- Customer Pills -->
                  <ul class="nav nav-pills flex-column flex-md-row mb-4">
                    <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i>Overview</a></li>
                    <li class="nav-item"><a class="nav-link" href="app-ecommerce-customer-details-security.html"><i class="bx bx-lock-alt me-1"></i>Security</a></li>
                    <li class="nav-item"><a class="nav-link" href="app-ecommerce-customer-details-billing.html"><i class="bx bx-detail me-1"></i>Address &amp; Billing</a></li>
                    <li class="nav-item"><a class="nav-link" href="app-ecommerce-customer-details-notifications.html"><i class="bx bx-bell me-1"></i>Notifications</a></li>
                  </ul>
                  <!--/ Customer Pills -->
              
                  <!-- / Customer cards -->
                  <div class="row text-nowrap">
                    <div class="col-md-6 mb-4">
                      <div class="card h-100">
                        <div class="card-body">
                          <div class="card-icon mb-3">
                            <div class="avatar">
                              <div class="avatar-initial rounded bg-label-danger"><i class="bx bx-dollar bx-sm"></i>
                              </div>
                            </div>
                          </div>
                          <div class="card-danger">
                            <h4 class="card-title mb-3">Montants impayés</h4>
                            <div class="d-flex align-items-end mb-1 gap-1">
                              <h4 class="text-danger mb-0">{{$sum_to_pay}} XAF</h4>
                              <p class="mb-0">A payer</p>
                            </div>
                            <p class="text-muted mb-0 text-truncate">Solde du compte avant le prochain achat</p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-icon mb-3">
                            <div class="avatar">
                              <div class="avatar-initial rounded bg-label-success"><i class="bx bx-receipt bx-sm"></i>
                              </div>
                            </div>
                          </div>
                          <div class="card-info">
                            <h4 class="card-title mb-3">Nombre de factures impayées </h4>
                            <span class="badge bg-label-success mb-1">Platinum member</span>
                            <p class="text-muted mb-0">{{$count}} factures</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              
                  <!-- / customer cards -->
                  <!-- Invoice table -->
                  <div class="card mb-4">
                    <div class="table-responsive mb-3">
                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer"><div class="card-header d-flex flex-wrap py-3 py-sm-2"><div class="head-label text-center me-4 ms-1"><h5 class="card-title mb-10 text-nowrap">Factures</h5></div></div>
                    <table class="table" id="clientfacture">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">NUMERO</th>
                          <th scope="col">DATE</th>
                          <th scope="col">MONTANT</th>
                          <th scope="col">STATUS</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      
                    </table>
                    </div>
                  </div>
                  <!-- /Invoice table -->
                </div>
                <!--/ Customer Content -->
              </div>
        </div>
    </div>
</div>
@endsection
<script type="text/javascript">
  window.onload = function(){
       $(document).ready(function(){
        //alert(ids);
        let ids = {!! json_encode($id_cli) !!};
        var url = '{{ route("clfacture.list", ":id") }}';
        url = url.replace(':id', ids);

            $('#clientfacture').DataTable({
              serverSide: true,
              ajax: url,
              columns: [
                { data: 'id', name: 'id','visible':false },
                  { data: 'ref_fac', name: 'ref_fac' },
                  { data: 'date_fac', name: 'date_fac' },
                  { data: 'mttc_fac', name: 'mttc_fac' },
                  { data: 'stat_fac', name: 'stat_fac' },
                  {data: 'action', name: 'action', orderable: true}
                    ],order: [[0, 'desc']]
          });
      });
  }
</script>