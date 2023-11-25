<div class="row invoice-preview">
    <!-- Invoice -->
    <div class="col-xl-9 col-md-8 col-12 mb-md-0 mb-4">
      <div class="card invoice-preview-card">
        <div class="card-body">
          <div class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column p-sm-1 p-0">
            <h4>{{$ent->name_ent}}</h4>
            <div>
              <h4>Payment receipt #{{$pay->ref_pay}}</h4>
              <div class="mb-2">
                <span class="me-1">Date Issues:</span>
                <span class="fw-medium">{{$pay->date_pay}}</span>
              </div>
              
              <div>
                <span class="me-1">Status:</span>
                @if($pay->stat_pay == 'Pending')
                    <span class="badge bg-label-danger">{{$pay->stat_pay}}</span>
                @else
                    <span class="badge bg-label-success">{{$pay->stat_pay}}</span>
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
                <th>Item</th>
                <th>Cost</th>
                <th>Qty</th>
                <th>Price</th>
              </tr>
            </thead>
            <tbody>
                @foreach($efs as $ef)
                <tr>
                    <td class="text-nowrap">{{ $ef->name_prod }}</td>
                    <td>{{ $ef->ef_pu }}</td>
                    <td>{{ $ef->ef_qty }}</td>
                    <td>{{ $ef->ef_ttc }}</td>
                </tr>
                @endforeach
            <tr>
                
                <td class="text-end px-4 py-5">
                  <p class="mb-2">Subtotal:</p>
                  <p class="mb-2">Tax:</p>
                  <p class="mb-0">Total:</p>
                </td>
                <td class="px-4 py-5">
                  <p class="fw-medium mb-2">{{$pay->mht_pay}}</p>
                  <p class="fw-medium mb-2">{{$pay->tva_pay}}</p>
                  <p class="fw-medium mb-0">{{$pay->mttc_pay}} XAF</p> 
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