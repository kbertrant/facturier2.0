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

function calculateTotal(listProducts) {
  let totalHT = 0;
  listProducts.forEach((item)=>{totalHT += item.total;});
  //console.log(totalHT);
  $('#ht').html(new Intl.NumberFormat("cm-CM", { style: "currency", currency: "XAF" }).format(totalHT));
  let totalTVA = 0;
  //totalTVA = (parseInt(totalHT) * 0.1925);
  //console.log(totalTVA);
  $('#taxes').html(new Intl.NumberFormat(new Intl.NumberFormat("cm-CM", { style: "currency", currency: "XAF" }).format(totalTVA)));
  $('#ttc').html(new Intl.NumberFormat("cm-CM", { style: "currency", currency: "XAF" }).format((totalHT + totalTVA)));
}



  window.onload = function(){
    $('#ht').html(0);
    $('#taxes').html(0);
    $('#discount').html(0);
    $('#ttc').html(0);
    $('#rs').html(0);
    $('#som_ttc').html(0);
    let arrayAmount = [];

    $('#id_prod').change(function(){
      const num = $(this).val()
      console.log(num);
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

    $('#tva_apply').change(function(){
      const tva_app = $(this).val()
      var rs_app = document.getElementById('rs_apply').value;
      console.log(rs_app);
      console.log(tva_app);
      console.log(arrayAmount);
      let totalHT = 0;
      let totalTVA = 0;
        let rs_val = 0;
        let newHT = 0;
        let newTTC = 0;
      arrayAmount.forEach((item)=>{totalHT += item.total;});
      if(rs_app == "on" && tva_app=="on"){
        
        rs_val = (parseInt(totalHT) * 0.022);
        newHT = totalHT - rs_val;
        totalTVA = (parseInt(newHT) * 0.1925);
        newTTC = newHT + totalTVA;
        //console.log(totalTVA);
        
      }else if(rs_app == "on" && tva_app=="off"){
        rs_val = (parseInt(totalHT) * 0.055);
        newHT = totalHT - rs_val;
        totalTVA = 0;
        newTTC = newHT + totalTVA;
      }else if(rs_app == "off" && tva_app=="on"){
        rs_val = 0;
        newHT = totalHT - rs_val;
        totalTVA = (parseInt(totalHT) * 0.1925);
        newTTC = newHT + totalTVA;
      }else if(rs_app == "off" && tva_app=="off"){
        rs_val = 0;
        newHT = totalHT - rs_val;
        totalTVA = 0;
        newTTC = newHT + totalTVA;
      }
      $('#ht').html(new Intl.NumberFormat("cm-CM", { style: "currency", currency: "XAF" }).format(totalHT));
        $('#taxes').html(new Intl.NumberFormat("cm-CM", { style: "currency", currency: "XAF" }).format(totalTVA));
        $('#ttc').html(new Intl.NumberFormat("cm-CM", { style: "currency", currency: "XAF" }).format(newTTC ));
        $('#rs').html(new Intl.NumberFormat("cm-CM", { style: "currency", currency: "XAF" }).format(rs_val));
    });

    $('#rs_apply').change(function(){
      const rs_app = $(this).val()
      var tva_app = document.getElementById('tva_apply').value;
      console.log(rs_app);
      console.log(tva_app);
      console.log(arrayAmount);
      let totalHT = 0;
      let totalTVA = 0;
        let rs_val = 0;
        let newHT = 0;
        let newTTC = 0;
      arrayAmount.forEach((item)=>{totalHT += item.total;});
      if(rs_app == "on" && tva_app=="on"){
        
        rs_val = (parseInt(totalHT) * 0.022);
        newHT = totalHT - rs_val;
        totalTVA = (parseInt(newHT) * 0.1925);
        newTTC = newHT + totalTVA;
        //console.log(totalTVA);
        
      }else if(rs_app == "off" && tva_app=="on"){
        rs_val = (parseInt(totalHT) * 0.055);
        newHT = totalHT - rs_val;
        totalTVA = 0;
        newTTC = newHT + totalTVA;
      }else if(rs_app == "on" && tva_app=="off"){
        rs_val = (parseInt(totalHT) * 0.055);
        newHT = totalHT - rs_val;
        totalTVA = 0;
        newTTC = newHT + totalTVA;
      }else if(rs_app == "off" && tva_app=="off"){
        rs_val = 0;
        newHT = totalHT - rs_val;
        totalTVA = 0;
        newTTC = newHT + totalTVA;
      }
      $('#ht').html(totalHT);
        $('#taxes').html(totalTVA);
        $('#ttc').html(newTTC);
        $('#rs').html(rs_val);
    });
    
    $(document).ready(function(){
      
      $('#factable').DataTable({
        serverSide: true,
        ajax: '{{ route('facture.list') }}',
        columns: [
          { data: 'id', name: 'id','visible':false },
          { data: 'ref_fac', name: 'ref_fac' },
          { data: 'date_fac', name: 'date_fac' },
          { data: 'mttc_fac', name: 'mttc_fac' , render: $.fn.dataTable.render.number( ',', '.', 0, 'XAF ' )},
          { data: 'qty_fac', name: 'qty_fac' },
          { data: 'name_cli', name: 'name_cli' },
          { data: 'stat_fac', name: 'stat_fac' },
          {data: 'action', name: 'action', orderable: false}
            ],order: [[2, 'desc']]
      });
      $(document).ready(function() { function updateInvoice() { var totalAmount = 0; $('#invoice tbody tr').each(function() { var price = parseFloat($(this).find('.price').text()); var quantity = $(this).find('.quantity').val(); var amount = price * quantity; $(this).find('.amount').text(amount.toFixed(2)); totalAmount += amount; }); $('#totalAmount').text(totalAmount.toFixed(2)); } $('.quantity').on('change', function() { updateInvoice(); }); updateInvoice(); // Initial calculation 
      });
      $(document).ready(function(){
            var x = 1; //Initial field counter is 1
            var maxField = 10; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.field_wrapperPP'); //Input field wrapper
            let dataArray = [];
            //Once add button is clicked
            $(addButton).click(function(){
                //Check maximum number of input fields
                let verif = document.getElementById('your_price').value;
                var verif_select = document.getElementById('id_prod');
                if(x < maxField && verif != 0 && verif_select.selectedIndex !=0){

                   
                  let lineArray = [];
                  let idprod = document.getElementById('id_prod').value;
                  let yprice = document.getElementById('your_price').value;
                  let qty = document.getElementById('quantity').value;
                  
                  let total = (parseInt(yprice) * parseInt(qty));
                  let e = document.getElementById('id_prod');
                  var designation = e.options[e.selectedIndex].text;
                  console.log(designation);

                  lineArray = {x,designation, yprice, qty, total};
                  dataArray.push(lineArray);
                  arrayAmount = dataArray;
                  //console.log(dataArray);
                  var myselect = document.getElementById('id_prod');
                  myselect.selectedIndex = 0;
                  document.getElementById('your_price').value = 0;
                  document.getElementById('quantity').value = 1;
                  x++;
                  var fieldHTML = '<div class="row hiden" style="margin:5px"><div class=" col-lg-6 col-md-6 col-xs-6 field"><label for="qty_prod" class="form-label">DESIGNATION</label><select class="prod form-control" id="id_prod'+x+'" name="id_prod[]"><option value="">Choisir produit</option> @foreach ($produits as $produit) <option value="{{ $produit->id }}">{{ $produit->name_prod }} - {{ $produit->price_prod }}</option> @endforeach</select></div><div class="col-lg-2 col-md-2 col-xs-2"><label for="qty_prod" class="form-label">YOUR PRICE</label><input type="number" class="form-control @error('your_price') is-invalid @enderror" id="your_price" name="your_price['+x+']" value="0" required /></div><div class="col-lg-2 col-md-2 col-xs-2 field"><label for="qty_prod" class="form-label">QUANTITE</label><input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity['+x+']" required /></div><div class="col-lg-2 col-md-2 col-xs-2 remove_buttonPP"><label for="qty_prod" class="form-label">SUPPRIMER</label> <a href="javascript:void(0);" class=""><i class="bx bx-comment-x bx-red bx-md"></i></a></div></div>';
                  $(wrapper).append(fieldHTML);
                  //initialize table
                  var table = new Tabulator("#billtable", {
                      data:dataArray, //assign data to table
                      autoColumns:true, //create columns from data field names
                      movableColumns:true,
                      responsiveLayout:"hide",
                      layout:"fitColumns",
                      
                      rowClick:function(e, row){
                          //e - the click event object
                          //row - row component

                          row.toggleSelect(); //toggle row selected state on row click
                          console.log(row);
                      },
                  });
                  var selectedData = table.getSelectedRows();
                  console.log(selectedData);

                  calculateTotal(dataArray);
                  //var myHT = document.getElementById('ht').value;
                  //console.log(myHT);
                }

            });
            
            //Once remove button is clicked
            $(wrapper).on('click', '.remove_buttonPP', function(x){
                //e.preventDefault();
                //$(this).parent('div').remove(); //Remove field html
                //x--; //Decrement field counter
                
                //table.deleteRow(x);
            });
          });
      });
  
      $(document).ready(function(){
        var form = '#add-invoice';
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $(form).on('submit', function(event){
            event.preventDefault();

            var id_cli = $("#id_cli").val();
            var id_prod = arrayAmount;
            var reduction = $("#reduction").val();
            var rs_apply = $("#rs_apply").val();
            var tva_apply = $("#tva_apply").val();
            console.log(id_cli,id_prod,reduction);
            mydata = {id_cli:id_cli, id_prod:id_prod, reduction:reduction, tva_apply:tva_apply, rs_apply:rs_apply};
            $.ajax({
                url: "{{ route('facture.store') }}",
                method: 'POST',
                data: mydata,
                cache: false,
                processData: false,
                success:function(response)
                {
                    $(form).trigger("reset");
                    alert(response.success)
                },
                error: function(response) {
                }
            });
        });
      });
      
  }
</script>