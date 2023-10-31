@extends('main')
@section('title', ' - Fournisseurs')
@section('main-content')

  
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Vos </span> Fournisseurs
    </h4>
    @if (session('success'))
      <div class="alert alert-danger" role="alert">
          {{ session('success') }}
      </div>
    @endif
    <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
      <div class="flex-grow-1 mt-3 mt-sm-5">
        <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
          @include('fournisseur.addFour')
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"><i class='bx bx-check me-1'></i>Ajouter un fournisseur</button> 
        </div><br>
        <div class="card">
          <h5 class="card-header">Liste des fournisseurs</h5>
          <div class="card-body">
            <div class="table-responsive text-nowrap">
              <table class="table" id="fourtable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">NAME</th>
                    <th scope="col">CODE</th>
                    <th scope="col">ADDRESS</th>
                    <th scope="col"> PHONE</th>
                    <th scope="col">STATUS</th>
                    <th scope="col">MANAGER</th>
                    <th scope="col">RCCM</th>
                    <th scope="col">NUI</th>
                    <th scope="col">EMAIL</th>
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
              $('#fourtable').DataTable({
              serverSide: true,
              ajax: '{{ route('fournisseur.list') }}',
              columns: [
                  { data: 'id', name: 'id','visible':false },
                  { data: 'four_name', name: 'four_name' },
                  { data: 'four_code', name: 'four_code' },
                  { data: 'four_adress', name: 'four_adress' },
                  { data: 'four_phone', name: 'four_phone' },
                  { data: 'four_stat', name: 'four_stat' },
                  { data: 'resp_name', name: 'resp_name' },
                  { data: 'four_rccm', name: 'four_rccm' },
                  { data: 'four_nui', name: 'four_nui' },
                  { data: 'four_email', name: 'four_email' },
                  {data: 'action', name: 'action', orderable: false}
                    ],order: [[0, 'desc']]
           });
      });
  
  }
</script>