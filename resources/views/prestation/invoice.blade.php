@extends('main')
@section('title', ' - Ajouter Facture service')
@section('main-content')

  
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Ajouter </span> une facture de service
    </h4>
    @if (session('success'))
      <div class="alert alert-danger" role="alert">
          {{ session('success') }}
      </div>
    @endif
    <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
      <div class="flex-grow-1 mt-3 mt-sm-5">
            <div class="row invoice-preview">
                <!-- Invoice -->
                <div class="col-xl-12 col-md-12 col-12 mb-md-0 mb-4">
                    <div class="card invoice-preview-card">
                        <div class="card-body">
                        <form class="mb-3" method="POST" action="{{ route('pres.saveInvoice') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="id_cli" class="form-label">Client</label>
                                <input type="text" class="form-control" name="id_cli" list="datalistOptions" id="id_cli" placeholder="Saisir pour rechercher" required>
                                    <datalist id="datalistOptions">
                                        @foreach ($clients as $client)
                                        <option value="{{ $client->name_cli }}"></option>
                                        @endforeach
                                    </datalist>
                                @error('id_cli')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="strong">Le client est deja aquis</strong>
                                </span>
                                @enderror
                            </div>
                                    
                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border">Services</legend>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-xs-8">
                                        <input type="text" class="form-control @error('id_prod') is-invalid @enderror"
                                                id="id_prod[]" name="id_prod[]" placeholder="Saisir un prestation..." required />
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-xs-2">
                                        <input type="number" class="form-control @error('your_price') is-invalid @enderror"
                                                id="your_price[]" name="your_price[]" value="0" required />
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-xs-2">
                                        <input type="number" class="form-control @error('quantity') is-invalid @enderror"
                                                id="quantity[]" name="quantity[]" placeholder="Qte" required />
                                    </div>
                                        
                                    <div class="col-lg-2 col-md-2 col-xs-2">
                                        <a href="javascript:void(0);" class="add_button" title="Ajouter">
                                        <i class="bx bx-list-plus bx-md"></i></a>
                                    </div>
                                </div>
                                <br/>
                                <div class="row">
                                    <div class="field_wrapper" style="width: 100%;"><div>
                                </div>
                            </div>
                            </div>
                                </fieldset>
                                <legend class="scheduler-border">Discount and taxes</legend>
                                    <div class="row">
                                    <div class="col-lg-4 col-md-4 col-xs-4">
                                        <div class="mb-3">
                                        <label for="reduction" class="form-label">{{ __('mypages.remise') }} (%)</label>
                                        <input type="number" class="form-control @error('reduction') is-invalid @enderror"
                                            id="reduction" name="reduction" value="0" required oninput="calculateTotal()"/>
                                            @error('reduction')
                                            <span class="invalid-feedback" role="alert">
                                            <strong class="strong">Reduction est deja aquis</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <div class="form-check form-switch mb-3">
                                        <label class="form-check-label" for="tva_apply">{{ __('mypages.tva') }} </label>
                                        <select id="tva_apply" name="tva_apply" class="form-control" onchange="calculateTotal()">
                                            <option value="off">OFF</option>
                                            <option value="on">ON</option>
                                        </select>
                                        </div>
                                    </div>
                                <div class="col-lg-4 col-md-4 col-xs-12">
                                    <div class="form-check form-switch mb-3">
                                        <label class="form-check-label" for="rs_apply">{{ __('mypages.rs') }} </label>
                                        <select id="rs_apply" name="rs_apply" class="form-control" onchange="calculateTotal()">
                                            <option value="off">OFF</option>
                                            <option value="on">ON</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-xs-12"></div>
                                <div class="col-lg-6 col-md-6 col-xs-12">
                                    <table>
                                        <tr>
                                            <td>Total HT :</td>
                                            <td id="ht">0 XAF</td>
                                        </tr>
                                        <tr>
                                            <td>T.V.A :</td>
                                            <td id="taxes">0 XAF</td>
                                        </tr>
                                        <tr>
                                            <td>Deducted at source :</td>
                                            <td id="rs">0 XAF</td>
                                        </tr>
                                        <tr>
                                            <td>Discount (%):</td>
                                            <td id="discount">0</td>
                                        </tr>
                                        <tr>
                                            <td>Total TC :</td>
                                            <td id="ttc">0 XAF</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary d-grid w-100">Add Quotation </button>
                        </form>    
                    </div>
                    </div>
                </div>
                <!-- /Invoice -->
            </div>
        </div>
    </div>
</div>
@endsection
<script type="text/javascript">
    window.onload = function() {
        $(document).ready(function() {
            $(document).ready(function() {
                var maxField = 10; //Input fields increment limitation
                var addButton = $('.add_button'); //Add button selector
                var wrapper = $('.field_wrapper'); //Input field wrapper
                    
                var x = 1; //Initial field counter is 1

                //Once add button is clicked
                $(addButton).click(function() {
                    //Check maximum number of input fields
                    if (x < maxField) {
                        var fieldHTML = '<div class="row" style="margin:10px"><div class=" col-lg-6 col-md-6 col-xs-6 field"><label for="qty_prod" class="form-label">DESIGNATION</label><input type="text" class=" form-control" id="id_prod" name="id_prod[]"></div><div class="col-lg-2 col-md-2 col-xs-2"><label for="qty_prod" class="form-label">YOUR PRICE</label><input type="number" class="form-control @error('your_price') is-invalid @enderror" id="your_price" name="your_price[]" value="0" required /></div><div class="col-lg-2 col-md-2 col-xs-2 field"><label for="qty_prod" class="form-label">QUANTITE</label><input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity[]" required /></div><div class="col-lg-2 col-md-2 col-xs-2 remove_buttonPP"><label for="qty_prod" class="form-label"></label> <a href="javascript:void(0);" class=""><i class="bx bx-comment-x bx-red bx-md"></i></a></div></div>';
                        x++; //Increment field counter
                        
                        $(wrapper).append(fieldHTML); //Add field html
                    }
                });

                //Once remove button is clicked
                $(wrapper).on('click', '.remove_buttonPP', function(e) {
                    e.preventDefault();
                    $(this).parent('div').remove(); //Remove field html
                    x--; //Decrement field counter
                });
            });
        });

    }
</script>
