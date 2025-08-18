@extends('main')
@section('title', ' - Vos creances')
@section('main-content')

  
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Vos </span> creances
    </h4>
    @if (session('success'))
      <div class="alert alert-danger" role="alert">
          {{ session('success') }}
      </div>
    @endif
    <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
      <div class="flex-grow-1 mt-3 mt-sm-5">
        <br>
        <div class="card">
          <h5 class="card-header">Liste des creances</h5>
          <div class="card-body">
            <div class="table-responsive text-nowrap">
              <table class="table table-striped table-bordered" id="creancestable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">NAME</th>
                    <th scope="col">PHONE</th>
                    <th scope="col">ADDRESS</th>
                    <th scope="col">TYPE</th>
                    <th scope="col">TOTAL</th>
                    <th scope="col">NUMBER</th>
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
              $('#creancestable').DataTable({
              serverSide: true,
              ajax: '{{ route('creances') }}',
              columns: [
                  { data: 'id', name: 'id','visible':false },
                  { data: 'name_cli', name: 'name_cli' },
                  { data: 'phone_cli', name: 'phone_cli' },
                  { data: 'address_cli', name: 'address_cli' },
                  { data: 'name_tc', name: 'name_tc' },
                  { data: 'ttc', name: 'ttc' },
                  { data: 'num', name: 'num' }
                    ],order: [[0, 'desc']]
           });
      });
  
  }
</script>