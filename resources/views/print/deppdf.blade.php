<div class="row invoice-preview">
    <!-- Invoice -->
    <div class="col-xl-9 col-md-8 col-12 mb-md-0 mb-4">
      <div class="card invoice-preview-card">
        <div class="card-body">
          <div class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column p-sm-1 p-0">
            <h4>{{$ent->name_ent}}</h4>
            <div>
              <h4>Invoice #{{$dep->ref_dep}}</h4>
              <div class="mb-2">
                <span class="me-1">Date Issues:</span>
                <span class="fw-medium">{{$dep->date_dep}}</span>
              </div>
              
              <div>
                <span class="me-1">Status:</span>
                @if($dep->status == 'Pending')
                    <span class="badge bg-label-danger">{{$dep->status}}</span>
                @else
                    <span class="badge bg-label-success">{{$dep->status}}</span>
                @endif
              </div>
            </div>
          </div>
        </div>
        <hr class="my-0">
        
        <div class="table-responsive">
          <table class="table border-top m-0">
            <thead>
              <tr>
                <th>Reference</th>
                <th>Designation</th>
                <th>Price</th>
              </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-nowrap">{{ $dep->ref_dep }}</td>
                    <td>{{ $dep->label_dep }}</td>
                    <td>{{ $dep->amount_dep }}</td>
                </tr>
            <tr>
                
                <td class="text-end px-4 py-5">
                  <p class="mb-2">Tax:</p>
                  <p class="mb-0">Total:</p>
                </td>
                <td class="px-4 py-5">
                  <p class="fw-medium mb-2">{{$dep->solde_dep}}</p>
                  <p class="fw-medium mb-0">{{$dep->amount_dep}} XAF</p> 
                </td>
              </tr>
            </tbody>
          </table>
        </div>
  
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <span class="me-1 fw-medium">Executé par: {{$usr->name}}</span><br>
              <span class="fw-medium">Thank you for your business!</span>
              
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /Invoice -->
  </div>