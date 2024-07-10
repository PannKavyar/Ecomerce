<div>
    <div class="py-3 py-md-5 bg-light">
        <div class="container">
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="shopping-cart">

                        <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Products</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Price</h4>
                                </div>

                                <div class="col-md-4">
                                    <h4>Remove</h4>
                                </div>
                            </div>
                        </div>
                        @forelse ($wishlist as $wishlistItem)
                            @if ($wishlistItem->product)
                                <div class="cart-item">
                                    <div class="row">
                                        <div class="col-md-6 my-auto">
                                            <a
                                                href="{{ route('frontend.productView', ['category_slug' => $wishlistItem->product->category->slug, 'product_slug' => $wishlistItem->product->slug]) }}">
                                                <label class="product-name">
                                                    <img src="{{ asset($wishlistItem->product->productImages[0]->image) }}"
                                                        style="width: 50px; height: 50px"
                                                        alt="{{ $wishlistItem->product->name }}">
                                                    {{ $wishlistItem->product->name }}
                                                </label>
                                            </a>
                                        </div>
                                        <div class="col-md-2 my-auto">
                                            <label class="price">${{ $wishlistItem->product->selling_price }} </label>
                                        </div>
                                        <div class="col-md-4 col-12 my-auto">
                                            <div class="remove">
                                                <button type="button"
                                                    wire:click="removeWishlistItem({{ $wishlistItem->id }})"
                                                    class="btn btn-danger btn-sm">
                                                    <span>
                                                        <i class="fa fa-trash"></i> Remove
                                                    </span>
                                                    <span wire:loading
                                                        wire:target="removeWishlistItem({{ $wishlistItem->id }})">Removing...
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        @empty
                            <div>No Wishlist Found</div>
                        @endforelse


                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
