@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                @if ($errors->any())
                    <div class="alert alert-warning">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif



                <div class="d-flex justify-content-between align-items-center">
                    <h3>Edit Products</h3>
                    <a href="{{ route('product.index') }}" class="btn btn-danger btn-sm">Back </a>
                </div>

                <div class="card-body">

                    @if (session('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                    @endif
                    <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                    data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home"
                                    aria-selected="true">
                                    Home
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="seotag-tab" data-bs-toggle="tab"
                                    data-bs-target="#seotag-tab-pane" type="button" role="tab" aria-controls="seotag"
                                    aria-selected="false">
                                    SEO Tag
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="details-tab" data-bs-toggle="tab"
                                    data-bs-target="#details-tab-pane" type="button" role="tab" aria-controls="details"
                                    aria-selected="false">
                                    Details
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="image-tab" data-bs-toggle="tab"
                                    data-bs-target="#image-tab-pane" type="button" role="tab" aria-controls="image"
                                    aria-selected="false">
                                    Product Image
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="colors-tab" data-bs-toggle="tab"
                                    data-bs-target="#colors-tab-pane" type="button" role="tab">
                                    Product Color
                                </button>
                            </li>
                        </ul>

                        <div class="tab-content" id="myTabContent">

                            <div class="tab-pane fade border p-3  show active" id="home-tab-pane" role="tabpanel"
                                aria-labelledby="home-tab">
                                <div class="mb-3">
                                    <label>Category</label>
                                    <select name="category_id" class="form-control">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">

                                    <label>Product Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ $product->name }}">
                                </div>

                                <div class="mb-3">

                                    <label>Product Slug</label>
                                    <input type="text" name="slug" class="form-control" value="{{ $product->slug }}">
                                </div>

                                <div class="mb-3">
                                    <label>Select Brand</label>
                                    <select name="brand_id" class="form-control">
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}"
                                                {{ $brand->id == $product->brand_id ? 'selected' : '' }}>
                                                {{ $brand->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label>Small Description</label>
                                    <textarea name="small_description" class="form-control">{{ $product->small_description }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control">{{ $product->description }}</textarea>
                                </div>
                            </div>

                            <div class="tab-pane fade border p-3 " id="seotag-tab-pane" role="tabpanel"
                                aria-labelledby="seotag-tab">

                                <div class="mb-3">
                                    <label>Meta Title</label>
                                    <input type="text" name="meta_title" class="form-control"
                                        value="{{ $product->meta_title }}">
                                </div>

                                <div class="mb-3">
                                    <label>Meta Description</label>
                                    <textarea name="meta_description" class="form-control">
                                        {{ $product->meta_description }}
                                    </textarea>
                                </div>

                                <div class="mb-3">
                                    <label>Meta Keyword</label>
                                    <textarea name="meta_keyword" class="form-control">
                                        {{ $product->meta_keyword }}
                                    </textarea>
                                </div>
                            </div>

                            <div class="tab-pane fade border p-3" id="details-tab-pane" role="tabpanel"
                                aria-labelledby="details-tab">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label>Original Price</label>
                                            <input type="text" name="original_price" class="form-control"
                                                value="{{ $product->original_price }}">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label>Selling Price</label>
                                            <input type="text" name="selling_price" class="form-control"
                                                value="{{ $product->selling_price }}">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label>Quantity</label>
                                            <input type="text" name="quantity" class="form-control"
                                                value="{{ $product->quantity }}">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label>Trending</label>
                                            <input type="checkbox" name="trending" style="width: 15px; height:15px"
                                                {{ $product->trending == '1' ? 'checked' : '' }}>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label>Featured</label>
                                            <input type="checkbox" name="featured" style="width: 15px; height:15px"
                                                {{ $product->featured == '1' ? 'checked' : '' }}>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label>Status</label>
                                            <input type="checkbox" name="status" style="width: 15px; height:15px"
                                                {{ $product->status == '1' ? 'checked' : '' }}>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="tab-pane fade border p-3" id="image-tab-pane" role="tabpanel"
                                aria-labelledby="image-tab" tabindex="0">
                                <div class="mb-3">
                                    <label>Upload Product Images</label>
                                    <input type="file" name="image[]" multiple class="form-control">
                                </div>
                                <div>
                                    @if ($product->productImages)
                                        <div class="row">
                                            @foreach ($product->productImages as $image)
                                                <div class="col-md-2">
                                                    <img src="{{ asset($image->image) }}" alt="Image"
                                                        style="width:80px ;height:80px" class="me-4 border">
                                                    <a href="{{ route('product.deleteImage', $image->id) }}"
                                                        class="d-block">Remove</a>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <h5>No Image Added</h5>
                                    @endif
                                </div>


                            </div>
                            <div class="tab-pane fade border p-3" id="colors-tab-pane" role="tabpanel">
                                <div class="mb-3">
                                    <h4>Add Product Color</h4>
                                    <label>Select Color</label>
                                    </hr>
                                    <div class="row">
                                        @forelse ($colors as $colorItem)
                                            <div class="col-md-3">
                                                <div class="p-2 border mb-3">

                                                    Color: <input type="checkbox" name="colors[{{ $colorItem->id }}]"
                                                        value="{{ $colorItem->id }}" />{{ $colorItem->name }}
                                                    <br />
                                                    Quantity: <input type="number"
                                                        name="colorquantity[{{ $colorItem->id }}]"
                                                        style="width:70px ; border:1px solid" />
                                                </div>

                                            </div>

                                        @empty
                                            <div class="col-md-12">
                                                <h4>
                                                    No Color Founds
                                                </h4>
                                            </div>
                                        @endforelse

                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-sm table-bodered">
                                        <thead>
                                            <tr>
                                                <th> Color Name</th>
                                                <th>Quantity</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($product->productColors as $productColor)
                                                <tr class="product-color-tr">
                                                    @if ($productColor->color)
                                                        <div>
                                                            <td>{{ $productColor->color->name }}</td>
                                                        </div>
                                                    @else
                                                        Debug: No Color Found
                                                    @endif

                                                    <td>
                                                        <div class="input-group mb-3" style="width: 150px">
                                                            <input type="text" value="{{ $productColor->quantity }}"
                                                                class="productColorQuantity form-control form-control-sm">
                                                            <button type="button" value="{{ $productColor->id }}"
                                                                class="updateProductColorBtn btn btn-primary btn-sm text-white">Update</button>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button type="button" value="{{ $productColor->id }}"
                                                            class="deleteProductColorBtn btn btn-danger btn-sm text-white">Delete</button>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });
            $(document).on('click', '.updateProductColorBtn', function() {
                var product_id = {{ $product->id }};
                var qty = $(this).closest('.product-color-tr').find('.productColorQuantity').val();
                var product_color_id = $(this).val();
                // alert(product_color_id);
                // alert(qty);

                if (qty <= 0) {
                    alert('Quantity is Required');
                    // return false;
                }
                var data = {
                    'product_id': product_id,
                    'product_color_id': product_color_id,
                    'qty': qty
                };
                $.ajax({
                    type: "POST",
                    url: "/admin/product-color/" + product_color_id,
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // console.log(response);
                        alert(response.message);
                    }
                });
            });


            $(document).on('click', '.deleteProductColorBtn', function() {
                var product_color_id = $(this).val();
                var thisClick = $(this);
                // alert('Button clicked!');
                // thisClick.closest('.product-color-tr').remove();
                // console.log('Product Color ID:', product_color_id);


                $.ajax({
                    type: "GET",
                    url: "/admin/product-color/" + product_color_id + "/delete",
                    success: function(response) {
                        thisClick.closest('.product-color-tr').remove();
                        alert(response.message);

                    }
                });
            });
        });
    </script>
@endsection
