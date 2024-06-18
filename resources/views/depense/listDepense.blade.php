@extends('main')
@section('title', ' - Charges')
@section('main-content')

  
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Vos </span> Charges(dépenses)
    </h4>
    @if (session('success'))
      <div class="alert alert-danger" role="alert">
          {{ session('success') }}
      </div>
    @endif
    <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
      <div class="flex-grow-1 mt-3 mt-sm-5">
        <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
          @include('depense.addDepense')
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"><i class='bx bx-check me-1'></i>Nouvelle depense</button> 
        </div><br>
        <div class="card">
          <h5 class="card-header">Liste des charges</h5>
          <div class="card-body">
            <div class="table-responsive text-nowrap">
              <table class="table table-striped table-bordered" id="deptable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">REF</th>
                    <th scope="col">DATE</th>
                    <th scope="col">INTITULE</th>
                    <th scope="col"> FOURNISSEUR</th>
                    <th scope="col">STATUS</th>
                    <th scope="col">MONTANT</th>
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
              $('#deptable').DataTable({
              serverSide: true,
              ajax: '{{ route('depense.list') }}',
              columns: [
                  { data: 'id', name: 'id','visible':false },
                  { data: 'ref_dep', name: 'ref_dep' },
                  { data: 'date_dep', name: 'date_dep' },
                  { data: 'label_dep', name: 'label_dep' },
                  { data: 'four_name', name: 'four_name' },
                  { data: 'status', name: 'status' },
                  { data: 'amount_dep', name: 'amount_dep' },
                  {data: 'action', name: 'action', orderable: false}
                    ],order: [[2, 'desc']]
           });
      });
  
  }
</script>