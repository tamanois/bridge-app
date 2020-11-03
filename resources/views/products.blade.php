@extends('index')

@section('content')

    @include('perso.functions')
    <div class="products-list container">
        <div class="row">
            <button class="btn btn-primary" id="add_product_button">
                <span class="fas fa-plus-circle">
                </span>
                 New product
            </button>
        </div>

        @if(isset($errors) && $errors->count() > 0)

            <div class="row mt-5">
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>

        @endif
        <div class="row mt-5">

           @foreach($products as $product)

                <div class="col-md-3 ">

                    <div class="product-container">
                        <div class="product-image">
                            @if($product->img_url)
                                <a href="{{route('show_product', $product->id)}}"><img src="{{asset($product->img_url)}}" alt=""></a>

                            @else
                                <a href="{{route('show_product', $product->id)}}"><img src="{{asset('images/package.png')}}" alt=""></a>

                            @endif
                            <div class="btn-group product-action" role="group" >
                                <a href="{{route('show_product', $product->id)}}" type="button" class="btn btn-sm btn-warning"><span class="fas fa-search" style="color: white"></span></a>
                                <button type="button" class="btn btn-sm btn-primary"><span class="fas fa-pen" onclick="edit_product({{$product->id}}, '{{sanitize($product->name)}}',  '{{sanitize($product->description)}}',  {{sanitize($product->price)}},  {{sanitize($product->discount)}}, {{sanitize($product->service)}}, {{sanitize($product->stock)}}, {{sanitize($product->published)}})"></span></button>
                                <a href="{{route('delete_product', $product->id)}}" class="btn btn-sm btn-danger"><span class="fas fa-trash"></span></a>
                            </div>
                        </div>
                    </div>

                    <h5 class="title">{{$product->name}}</h5>
                    <div class="alert alert-info">
                        <h4  style="text-align: center; font-weight: 600">{{$product->price}} FCFA</h4>
                    </div>
                </div>
           @endforeach
            @if($products->count() == 0)
                <h1 style="color: gray; text-align: center"> The product list is empty </h1>
            @endif


        </div>




    </div>


    <div class="modal fade" id="store_product_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary" style="color: white;">
                    <h4 class="modal-title" >Create a new product</h4>

                    <button type="button" class="close" data-dismiss="modal">x</button>
                </div>
                <div class="modal-body">



                    <form  id="store_product_form" role="form" method="POST" action="{{route('store_product')}}" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <fieldset>


                            <div class="form-group">
                                <label for="product_image">Product image  </label>
                                <input class="form-control" id="product_image" name="product_image" type="file"  >

                            </div>
                            <div class="form-group">
                                <label for="name">Product name  </label>
                                <input class="form-control" id="name" name="name" type="text"  required >

                            </div>

                            <div class="form-group">
                                <label for="description">Description  </label>
                                <textarea  class="form-control" id="description" name="description" ></textarea>


                            </div>

                            <div class="form-group">
                                <label for="price">Price </label>
                                <input class="form-control" id="price" name="price" type="number"   required >

                            </div>

                            <div class="form-group" >
                                <input  id="discount" name="discount" type="checkbox"  > The item is on discount

                            </div>

                            <div class="form-group" >
                                <input  id="service" name="service" type="checkbox"  > The item is a service

                            </div>

                            <div class="form-group" >
                                <input  id="stock" name="stock" type="checkbox"  checked> The item is in stock

                            </div>




                            <button class="btn btn-primary pull-right"><span class="fas fa-save"></span> Save</button>


                        </fieldset>
                    </form>


                </div>

            </div>


        </div>
    </div>


    <div class="modal fade" id="update_product_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary" style="color: white;">
                    <h4 class="modal-title" >Edit a product</h4>

                    <button type="button" class="close" data-dismiss="modal">x</button>
                </div>
                <div class="modal-body">



                    <form  id="edit_product_form" role="form" method="POST" action="{{route('update_product')}}" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id" id="edit_id" value="{{ csrf_token() }}">
                        <fieldset>


                            <div class="form-group">
                                <label for="edit_product_image">Product image  </label>
                                <input class="form-control" id="edit_product_image" name="product_image" type="file"  >

                            </div>
                            <div class="form-group">
                                <label for="edit_name">Product name  </label>
                                <input class="form-control" id="edit_name" name="name" type="text"  required >

                            </div>

                            <div class="form-group">
                                <label for="edit_description">Description  </label>
                                <textarea  class="form-control" id="edit_description" name="description" ></textarea>


                            </div>

                            <div class="form-group">
                                <label for="edit_price">Price </label>
                                <input class="form-control" id="edit_price" name="price" type="number"   required >

                            </div>

                            <div class="form-group" >
                                <input  id="edit_discount" name="discount" type="checkbox"  > The item is on discount

                            </div>

                            <div class="form-group" >
                                <input  id="edit_service" name="service" type="checkbox"  > The item is a service

                            </div>

                            <div class="form-group" >
                                <input  id="edit_stock" name="stock" type="checkbox"  checked> The item is in stock

                            </div>




                            <button class="btn btn-primary pull-right"><span class="fas fa-save"></span> Save</button>


                        </fieldset>
                    </form>


                </div>

            </div>


        </div>
    </div>


@endsection

@section('scripts')

<script>
    $(function () {
        $('#add_product_button').on('click', function () {
            $('#store_product_modal').modal('show');
        });
    });

    function edit_product(id, name, description, price, discount, service, stock, published) {
        $('#edit_id').val(id);
        $('#edit_name').val(name);
        $('#edit_description').val(description);
        $('#edit_price').val(price);
        if(discount) {
            $('#edit_discount').prop('checked', true);
        } else {
            $('#edit_discount').prop('checked', false);

        }
         if(service) {
            $('#edit_service').prop('checked', true);
        } else {
             $('#edit_service').prop('checked', false);

         }
         if(stock) {
            $('#edit_stock').prop('checked', true);
        } else {
             $('#edit_stock').prop('checked', false);

         }
         if(published) {
            $('#edit_published').prop('checked', true);
        } else {
             $('#edit_published').prop('checked', false);

         }


        $('#update_product_modal').modal('show');

    }


</script>
@endsection