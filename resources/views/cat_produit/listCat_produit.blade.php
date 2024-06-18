@extends('main')
@section('title', ' - Categories produit')
@section('main-content')
<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">{{ __('mypages.y') }}</span> Categories</h4>
    @if (session('success'))
      <div class="alert alert-danger" role="alert">
          {{ session('success') }}
      </div>
    @endif
      <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
        <div class="flex-grow-1 mt-3 mt-sm-5">
          <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
            @include('cat_produit.addCat_produit')
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"><i class='bx bx-plus me-1'></i>Ajouter une categorie</button> 
          </div><br>
          <div class="card">
            <h5 class="card-header">Liste des categories</h5>
            <div class="card-body">
              <div class="table-responsive text-nowrap">
                <table class="table table-striped table-bordered" id="catproduitable">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                        <th scope="col">Nom categorie</th>
                        <th scope="col">Statut</th>
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

</div>
@endsection
<script type="text/javascript">
  window.onload = function(){
       $(document).ready(function(){
              $('#catproduitable').DataTable({
              serverSide: true,
              ajax: '{{ route('catproduit.list') }}',
              columns: [
                  { data: 'id', name: 'id','visible':false },
                  { data: 'cat_name', name: 'cat_name' },
                  { data: 'cat_stat', name: 'cat_stat' },
                  {data: 'action', name: 'action', orderable: false}
                    ],order: [[0, 'desc']]
           });
      });
  
  }
</script>