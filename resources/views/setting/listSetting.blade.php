@extends('main')
@section('title', ' - Parametres')
@section('main-content')

  
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">{{ __('mypages.y') }} </span> Settings
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
          <div class="card-body">
            <div class="table-responsive text-nowrap">
              <table class="table table-striped table-bordered" id="settingtable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Template facture</th>
                    <th scope="col">Format impression</th>
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
              $('#settingtable').DataTable({
              serverSide: true,
              ajax: '{{ route('setting.list') }}',
              columns: [
                  { data: 'id', name: 'id','visible':false },
                  { data: 'template_inv', name: 'template_inv' },
                  { data: 'print_format', name: 'print_format' },
                  {data: 'action', name: 'action', orderable: false}
                    ],order: [[0, 'desc']]
           });
      });
  
  }
</script>