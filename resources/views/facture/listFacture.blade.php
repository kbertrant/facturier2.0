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
              <table class="table table-striped table-bordered" id="factable">
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

  function calculateTotal() {
    const id_prod = document.getElementById('id_prod').value;
    const quantities = document.getElementById('quantity').value;
    const prices = document.getElementById('your_price').value;
    const reduct = document.getElementById('reduction').value;
    const rs_apply = document.getElementById('rs_apply').value;
    const tva_apply = document.getElementById('tva_apply').value;
    let total = 0;
    const reduction = parseInt(reduct);
      console.log(rs_apply,tva_apply);
    for (let i = 0; i < quantities.length; i++) {
      const quantity = parseFloat(quantities) || 0;
      const price = parseFloat(prices) || 0;
      total = quantity * price;
    }
    var val_ht = parseInt(total.toFixed(0));
    var val_discount = (parseInt(total) * parseInt(reduction) / 100).toFixed(0);
    var val_after_discount = val_ht - val_discount;
    


    if(tva_apply == 'on' && rs_apply=='on'){
      initValues();
      
      var val_rs = parseInt(val_after_discount * 0.022).toFixed(0);
      var val_after_rs = val_after_discount - val_rs;
      var val_taxes = parseInt(val_after_rs * 0.1925).toFixed(0);

      document.getElementById('ht').textContent = val_ht;
      document.getElementById('discount').textContent = val_discount;
      document.getElementById('taxes').textContent = val_taxes;
      document.getElementById('rs').textContent = val_rs;
      document.getElementById('ttc').textContent = parseInt(val_after_rs) + parseInt(val_taxes);
    
    }else if(tva_apply == 'off' && rs_apply=='on'){
      initValues();

      var val_rs = parseInt(val_after_discount * 0.055).toFixed(0);
      var val_after_rs = val_after_discount - val_rs;

      var val_taxes =  0;

      document.getElementById('ht').textContent = val_ht;
      document.getElementById('discount').textContent = val_discount;
      document.getElementById('taxes').textContent = val_taxes;
      document.getElementById('rs').textContent = val_rs;
      document.getElementById('ttc').textContent = parseInt(val_after_rs) + parseInt(val_taxes);
      
    }else if(tva_apply == 'on' && rs_apply=='off'){
      initValues();

      var val_rs = 0;
      var val_after_rs = parseInt(val_after_discount) - parseInt(val_rs);

      var val_taxes = parseInt(val_after_rs * 0.1925).toFixed(0);

      document.getElementById('ht').textContent = val_ht;
      document.getElementById('discount').textContent = val_discount;
      document.getElementById('taxes').textContent = val_taxes;
      document.getElementById('rs').textContent = val_rs;
      document.getElementById('ttc').textContent = parseInt(val_after_rs) + parseInt(val_taxes);;
      
    }else if(tva_apply == 'off' && rs_apply=='off'){
      
      initValues();
      document.getElementById('ht').textContent = val_ht;
      document.getElementById('discount').textContent = 0;
      document.getElementById('taxes').textContent = 0;
      document.getElementById('rs').textContent = val_rs;
      document.getElementById('ttc').textContent = val_ht;
      document.getElementById('som_ttc').textContent = val_ht;
    }

    
  }
    function initValues(){
      $('#ht').html(0);
      $('#taxes').html(0);
      $('#discount').html(0);
      $('#ttc').html(0);
      $('#rs').html(0);
      $('#som_ttc').html(0);
    }

    $('#id_prod1').change(function(){
      const num = $(this).val()
      //console.log(num);
      $.ajax({
        type: 'GET', 
        url: '/produit/ajax/'+num,
        dataType: 'json',
        success: function (data) {
            console.log(data);

            document.getElementById('your_price1').value = data.price_prod;

        },error:function(){ 
             console.log(data);
        }
      });
    });

    $('#id_prod2').change(function(){
      const num = $(this).val()
      //console.log(num);
      $.ajax({
        type: 'GET', 
        url: '/produit/ajax/'+num,
        dataType: 'json',
        success: function (data) {
            console.log(data);

            document.getElementById('your_price2').value = data.price_prod;

        },error:function(){ 
             console.log(data);
        }
      });
    });
    
  window.onload = function(){
    
    initValues();

    $('#id_prod').change(function(){
      const num = $(this).val()
      //console.log(num);
      $.ajax({
        type: 'GET', 
        url: '/produit/ajax/'+num,
        dataType: 'json',
        success: function (data) {
            console.log(data);

            document.getElementById('your_price').value = data.price_prod;

        },error:function(){ 
             console.log(data);
        }
      });
    });

    

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
            ],order: [[2, 'desc']]
      });
      $(document).ready(function(){
            var x = 1; //Initial field counter is 1
            var maxField = 10; //Input fields increment limitation
            var addButton = $('.add_buttonPP'); //Add button selector
            var wrapper = $('.field_wrapperPP'); //Input field wrapper
            
            //Once add button is clicked
            $(addButton).click(function(){
                //Check maximum number of input fields
                if(x < maxField){
                  var fieldHTML = '<div class="row" style="margin:10px"><div class=" col-lg-6 col-md-6 col-xs-6 field"><label for="qty_prod" class="form-label">DESIGNATION</label><select class="prod form-control" id="id_prod'+x+'" name="id_prod[]"><option value="">Choisir produit</option> @foreach ($produits as $produit) <option value="{{ $produit->id }}">{{ $produit->name_prod }} - {{ $produit->price_prod }}</option> @endforeach</select></div><div class="col-lg-2 col-md-2 col-xs-2"><label for="qty_prod" class="form-label">YOUR PRICE</label><input type="number" class="form-control @error('your_price') is-invalid @enderror" id="your_price'+x+'" name="your_price[]" value="0" required oninput="calculateTotal()"/></div><div class="col-lg-2 col-md-2 col-xs-2 field"><label for="qty_prod" class="form-label">QUANTITE</label><input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity'+x+'" name="quantity[]" required oninput="calculateTotal()"/></div><div class="col-lg-2 col-md-2 col-xs-2 remove_buttonPP"><label for="qty_prod" class="form-label">SUPPRIMER</label> <a href="javascript:void(0);" class=""><i class="bx bx-comment-x bx-red bx-md"></i></a></div></div>';
                    
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