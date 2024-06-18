@extends('main')
@section('title', ' - Produits')
@section('main-content')


    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Vos </span> Produits
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
                    @include('produit.addProduit')
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"
                        data-bs-whatever="@mdo"><i class='bx bx-check me-1'></i>Ajouter un Produit</button>
                </div><br>
                <div class="card">
                    <h5 class="card-header">Liste des produits</h5>
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-striped table-bordered" id="produitable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">CODE</th>
                                        <th scope="col">NAME</th>
                                        <th scope="col">DESC</th>
                                        <th scope="col">PRICE</th>
                                        <th scope="col">QTY</th>
                                        <th scope="col">CATEGORIE</th>
                                        <th scope="col">IMAGE</th>
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
            $('#produitable').DataTable({
                serverSide: true,
                ajax: '{{ route('produit.list') }}',
                columns: [{
                        data: 'id',
                        name: 'id',
                        'visible': false
                    },
                    {
                        data: 'code_prod',
                        name: 'code_prod'
                    },
                    {
                        data: 'name_prod',
                        name: 'name_prod'
                    },
                    {
                        data: 'desc_prod',
                        name: 'desc_prod'
                    },
                    {
                        data: 'price_prod',
                        name: 'price_prod'
                    },
                    {
                        data: 'qty_prod',
                        name: 'qty_prod'
                    },
                    {
                        data: 'cat_name',
                        name: 'cat_name'
                    },
                    {
                        data: 'img',
                        render: function(data) {
                            console.log(data);
                            return '<img src="{{ URL::to('/') }}/products/images/' + data +
                                '" class="avatar" width="200" height="200"/>';
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    }
                ],
                order: [
                    [0, 'desc']
                ]
            });
        });

    }
</script>
