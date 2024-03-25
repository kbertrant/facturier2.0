@extends('main')
@section('title', ' - Factures')
@section('main-content')

  
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">{{ __('mypages.y') }} </span> {{ __('mypages.yf') }}
    </h4>
    @if (session('success'))
      <div class="alert alert-danger" role="alert">
          {{ session('success') }}
      </div>
    @endif
    <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
      <div class="flex-grow-1 mt-3 mt-sm-5">
        <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
          @include('facture.addFacture')
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"><i class='bx bx-check me-1'></i>{{ __('mypages.nf') }} </button> 
        </div><br>
        <div class="card">
          <h5 class="card-header">{{ __('mypages.ldf') }}</h5>
          <div class="card-body">
            <div class="table-responsive text-nowrap">
              <table class="table" id="factable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">REF</th>
                    <th scope="col">DATE</th>
                    <th scope="col">TTC</th>
                    <th scope="col">QTY</th>
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
              $('#factable').DataTable({
              serverSide: true,
              ajax: '{{ route('facture.list') }}',
              columns: [
                  { data: 'id', name: 'id','visible':false },
                  { data: 'ref_fac', name: 'ref_fac' },
                  { data: 'date_fac', name: 'date_fac' },
                  { data: 'mttc_fac', name: 'mttc_fac' },
                  { data: 'qty_fac', name: 'qty_fac' },
                  { data: 'name_cli', name: 'name_cli' },
                  { data: 'stat_fac', name: 'stat_fac' },
                  {data: 'action', name: 'action', orderable: false}
                    ],order: [[0, 'desc']]
           });
           $(document).ready(function(){
            var maxField = 10; //Input fields increment limitation
            var addButton = $('.add_buttonPP'); //Add button selector
            var wrapper = $('.field_wrapperPP'); //Input field wrapper
            var fieldHTML = '<div class="row" style="margin:5px"><div class=" col-lg-8 col-md-8 col-xs-8 field"><select class="prod form-control shadow" id="id_prod[]" name="id_prod[]"><option value="">Choisir produit</option> @foreach ($produits as $produit) <option value="{{ $produit->id }}">{{ $produit->name_prod }} - {{ $produit->price_prod }}</option> @endforeach</select></div><div class="col-lg-2 col-md-2 col-xs-2 field"><input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity[]" placeholder="Qte" required /></div><div class="col-lg-2 col-md-2 col-xs-2 remove_buttonPP"> <a href="javascript:void(0);" class=""><i class="bx bx-comment-x bx-red bx-md"></i></a></div></div>';

            var x = 1; //Initial field counter is 1
            
            //Once add button is clicked
            $(addButton).click(function(){
                //Check maximum number of input fields
                if(x < maxField){
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                }
            });

            //Once remove button is clicked
            $(wrapper).on('click', '.remove_buttonPP', function(e){
                e.preventDefault();
                $(this).parent('div').remove(); //Remove field html
                x--; //Decrement field counter
            });
          });
      });
  }
</script>