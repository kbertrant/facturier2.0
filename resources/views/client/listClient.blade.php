@extends('main')
@section('title', ' - Clients')
@section('main-content')

  
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Vos </span> Clients
    </h4>
    @if (session('success'))
      <div class="alert alert-danger" role="alert">
          {{ session('success') }}
      </div>
    @endif
    <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
      <div class="flex-grow-1 mt-3 mt-sm-5">
        <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
          @include('client.addClient')
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"><i class='bx bx-check me-1'></i>Ajouter un client</button> 
        </div><br>
        <div class="card">
          <h5 class="card-header">Liste des clients</h5>
          <div class="card-body">
            <div class="table-responsive text-nowrap">
              <table class="table" id="clientable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">NAME</th>
                    <th scope="col">PHONE</th>
                    <th scope="col">ADDRESS</th>
                    <th scope="col">RAISON SOCIALE</th>
                    <th scope="col">RCCM</th>
                    <th scope="col">NUI</th>
                    <th scope="col">EMAIL</th>
                    <th scope="col">TYPE</th>
                    <th scope="col">STATUS</th>
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
              $('#clientable').DataTable({
              serverSide: true,
              ajax: '{{ route('cliente.list') }}',
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