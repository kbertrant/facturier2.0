@extends('main')
@section('title', ' - Paiements')
@section('main-content')

  
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Vos </span> Paiements
    </h4>
    @if (session('success'))
      <div class="alert alert-danger" role="alert">
          {{ session('success') }}
      </div>
    @endif
    <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
      <div class="flex-grow-1 mt-3 mt-sm-5">
        <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
          @include('payment.addPayment')
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"><i class='bx bx-check me-1'></i>Nouveau paiement</button> 
        </div><br>
        <div class="card">
          <h5 class="card-header">Liste des paiements</h5>
          <div class="card-body">
            <div class="table-responsive text-nowrap">
              <table class="table" id="paytable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">REF</th>
                    <th scope="col">DATE</th>
                    <th scope="col">TTC</th>
                    <th scope="col">MODE</th>
                    <th scope="col">EMAIL</th>
                    <th scope="col">ETAT</th>
                    <th scope="col">FACTURE</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                
              </table>
              </div>  
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
<script type="text/javascript">
  window.onload = function(){
       $(document).ready(function(){
              $('#paytable').DataTable({
              serverSide: true,
              ajax: '{{ route('payment.list') }}',
              columns: [
                  { data: 'id', name: 'id','visible':false },
                  { data: 'name_cli', name: 'name_cli' },
                  { data: 'phone_cli', name: 'phone_cli' },
                  { data: 'address_cli', name: 'address_cli' },
                  { data: 'raison_sociale', name: 'raison_sociale' },
                  { data: 'cl_rccm', name: 'cl_rccm' },
                  { data: 'cl_nui', name: 'cl_nui' },
                  { data: 'cl_email', name: 'cl_email' },
                  { data: 'name_tc', name: 'name_tc' },
                  { data: 'status', name: 'status' },
                  {data: 'action', name: 'action', orderable: false}
                    ],order: [[0, 'desc']]
           });
      });
  
  }
</script>