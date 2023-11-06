@extends('main')
@section('title', ' - Utilisateurs')
@section('main-content')

  
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Vos </span> Utilisateurs
    </h4>
    @if (session('success'))
      <div class="alert alert-danger" role="alert">
          {{ session('success') }}
      </div>
    @endif
    <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
      <div class="flex-grow-1 mt-3 mt-sm-5">
        <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
          @include('user.addUser')
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"><i class='bx bx-check me-1'></i>Ajouter un utilisateur</button> 
        </div><br>
        <div class="card">
          <h5 class="card-header">Liste des Utilisateurs</h5>
          <div class="card-body">
            <div class="table-responsive text-nowrap">
              <table class="table" id="usertable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">NAME</th>
                    <th scope="col">EMAIL</th>
                    <th scope="col">PHONE</th>
                    <th scope="col">VILLE</th>
                    <th scope="col">ENTREPRISE</th>
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
              $('#usertable').DataTable({
              serverSide: true,
              ajax: '{{ route('user.list') }}',
              columns: [
                  { data: 'id', name: 'id','visible':false },
                  { data: 'name', name: 'name' },
                  { data: 'email', name: 'email' },
                  { data: 'phone', name: 'phone' },
                  { data: 'ville', name: 'ville' },
                  { data: 'name_ent', name: 'name_ent' },
                  { data: 'stat', name: 'stat' },
                  {data: 'action', name: 'action', orderable: false}
                    ],order: [[0, 'desc']]
           });
      });
  
  }
</script>