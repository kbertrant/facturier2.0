@extends('main')
@section('title', ' - Proformas')
@section('main-content')


    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">{{ __('mypages.y') }} </span> {{ __('mypages.yp') }}
        </h4>
        @if (session('success'))
            <div class="alert alert-danger" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
            <div class="flex-grow-1 mt-3 mt-sm-5">
                <div
                    class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                    @include('proforma.addProforma')
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"
                        data-bs-whatever="@mdo"><i class='bx bx-check me-1'></i>{{ __('mypages.np') }}</button>
                </div><br>
                <div class="card">
                    <h5 class="card-header">{{ __('mypages.ldp') }}</h5>
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-striped table-bordered" id="protable">
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
   
    window.onload = function() {
        $(document).ready(function() {
            $('#protable').DataTable({
                serverSide: true,
                ajax: '{{ route('proforma.list') }}',
                columns: [{
                        data: 'id',
                        name: 'id',
                        'visible': false
                    },
                    {
                        data: 'pro_ref',
                        name: 'pro_ref'
                    },
                    {
                        data: 'date_pro',
                        name: 'date_pro'
                    },
                    {
                        data: 'mttc_pro',
                        name: 'mttc_pro', render: $.fn.dataTable.render.number( ',', '.', 2, 'XAF ' )
                    },
                    {
                        data: 'qty_pro',
                        name: 'qty_pro'
                    },
                    {
                        data: 'name_cli',
                        name: 'name_cli'
                    },
                    {
                        data: 'stat_pro',
                        name: 'stat_pro'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    }
                ],
                order: [
                    [2, 'desc']
                ]
            });
            $(document).ready(function() {
                var maxField = 10; //Input fields increment limitation
                var addButton = $('.add_button'); //Add button selector
                var wrapper = $('.field_wrapper'); //Input field wrapper
                    
                var x = 1; //Initial field counter is 1

                //Once add button is clicked
                $(addButton).click(function() {
                    //Check maximum number of input fields
                    if (x < maxField) {
                        var fieldHTML = '<div class="row" style="margin:10px"><div class=" col-lg-6 col-md-6 col-xs-6 field"><label for="qty_prod" class="form-label">DESIGNATION</label><select class="prod form-control" id="id_prod" name="id_prod[]"><option value="">Choisir produit</option> @foreach ($produits as $produit) <option value="{{ $produit->id }}">{{ $produit->name_prod }} - {{ $produit->price_prod }}</option> @endforeach</select></div><div class="col-lg-2 col-md-2 col-xs-2"><label for="qty_prod" class="form-label">YOUR PRICE</label><input type="number" class="form-control @error('your_price') is-invalid @enderror" id="your_price" name="your_price[]" value="0" required /></div><div class="col-lg-2 col-md-2 col-xs-2 field"><label for="qty_prod" class="form-label">QUANTITE</label><input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity[]" required /></div><div class="col-lg-2 col-md-2 col-xs-2 remove_buttonPP"><label for="qty_prod" class="form-label">SUPPRIMER</label> <a href="javascript:void(0);" class=""><i class="bx bx-comment-x bx-red bx-md"></i></a></div></div>';
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
