@extends('main')
@section('title', ' - Proformas')
@section('main-content')

  
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Vos </span> Proformas
    </h4>
    @if (session('success'))
      <div class="alert alert-danger" role="alert">
          {{ session('success') }}
      </div>
    @endif
    <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
      <div class="flex-grow-1 mt-3 mt-sm-5">
        <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
          @include('proforma.addProforma')
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"><i class='bx bx-check me-1'></i>Nouvelle proforma</button> 
        </div><br>
        <div class="card">
          <h5 class="card-header">Liste des proformas</h5>
          <div class="card-body">
            <div class="table-responsive text-nowrap">
              <table class="table" id="protable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">REF</th>
                    <th scope="col">DATE</th>
                    <th scope="col">TTC</th>
                    <th scope="col">QTY</th>
                    <th scope="col">TVA</th>
                    <th scope="col">CLIENT</th>
                    <th scope="col">ETAT</th>
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
              $('#protable').DataTable({
              serverSide: true,
              ajax: '{{ route('proforma.list') }}',
              columns: [
                  { data: 'id', name: 'id','visible':false },
                  { data: 'pro_ref', name: 'pro_ref' },
                  { data: 'date_pro', name: 'date_pro' },
                  { data: 'amount_pro', name: 'amount_pro' },
                  { data: 'qty_pro', name: 'qty_pro' },
                  { data: 'tva_price', name: 'tva_price' },
                  { data: 'name_cli', name: 'name_cli' },
                  { data: 'stat_pro', name: 'stat_pro' },
                  {data: 'action', name: 'action', orderable: false}
                    ],order: [[0, 'desc']]
           });
      });
  
  }
</script>