<?php

namespace App\Livewire\Frontend\Product;

use App\Models\Cart;
use App\Models\Wishlist;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class View extends Component
{
    public $category, $product, $productColorSelectedQty, $quantityCount = 1, $productColorId;

    public function mount($category, $product)
    {
        $this->category = $category;
        $this->product = $product;
    }

    public function colorSelected($productColorId)
    {
        $this->productColorId = $productColorId;
        $productColor = $this->product->productColors()->where('id', $productColorId)->first();
        $this->productColorSelectedQty = $productColor->quantity;

        if ($this->productColorSelectedQty == 0) {
            $this->productColorSelectedQty = 'outOfStock';
        }
    }

    public function addToWishlist($productId)
    {
        if (Auth::check()) {
            if (Wishlist::where('user_id', auth()->user()->id)->where('product_id', $productId)->exists()) {
                session()->flash('message', 'Already added to wishlist');
                $this->dispatch('message', [
                    'text' => 'Alrady added to wishlist',
                    'type' => 'warning',
                    'status' => 409
                ]);
                return false;
            } else {
                $wishlist = Wishlist::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $productId
                ]);
                $this->dispatch('wishlistAddedUpdated');
                session()->flash('message', 'Wishlist Added Successfully');
                $this->dispatch('message', [
                    'text' => 'Wishlist Added Successfully',
                    'type' => 'success',
                    'status' => 200
                ]);
            }
        } else {
            session()->flash('message', 'Please Login First');
            $this->dispatch('message', [
                'text' => 'Please Login First',
                'type' => 'error',
                'status' => 401
            ]);
            return false;
        }
    }

    public function decrementQuantity()
    {
        if ($this->quantityCount > 1) {
            $this->quantityCount--;
        }
    }

    public function incrementQuantity()
    {
        if ($this->quantityCount < 10) {
            $this->quantityCount++;
        }
    }

    public function addToCart(int $productId)
    {
        if (Auth::check()) {
            if ($this->product->where('id', $productId)->where('status', '0')->exists()) {
                //Check product colour quantity and add to cart
                if ($this->product->productColors->count() > 1) {
                    if ($this->productColorSelectedQty != NULL) {
                        if (Cart::where('user_id', Auth::user()->id)->where('product_id', $productId)->where('product_color_id', $this->productColorId)->exists()) {
                            session()->flash('message', 'Product already add to Cart');
                        } else {
                            $productColor = $this->product->productColors()->where('id', $this->productColorId)->first();
                            if ($productColor->quantity > 0) {
                                if ($productColor->quantity > $this->quantityCount) {
                                    //Insert product to cart
                                    Cart::create([
                                        'user_id' => Auth::user()->id,
                                        'product_id' => $productId,
                                        'product_color_id' => $this->productColorId,
                                        'quantity' => $this->quantityCount
                                    ]);
                                    $this->dispatch('CartAddedUpdated');
                                    session()->flash('message', 'Product added to Cart');
                                } else {
                                    session()->flash('message', 'Only {$this->product->quantity}quantity available');
                                }
                            } else {
                                session()->flash('message', 'Out of Stock');
                            }
                        }
                    } else {
                        session()->flash('message', 'Please select color ');
                    }
                } else {
                    if (Cart::where('user_id', Auth::user()->id)->where('product_id', $productId)->exists()) {
                        session()->flash('message', 'Product already add to cart');
                    } else {
                        if ($this->product->quantity > 0) {
                            if ($this->product->quantity > $this->quantityCount) {
                                //Insert product to cart
                                Cart::create([
                                    'user_id' => Auth::user()->id,
                                    'product_id' => $productId,
                                    'quantity' => $this->quantityCount
                                ]);
                                $this->dispatch('CartAddedUpdated');
                                session()->flash('message', 'Product added to Cart');
                            } else {
                                session()->flash('message', 'Only {$this->product->quantity}quantity available');
                            }
                        } else {
                            session()->flash('message', 'Out of Stock');
                        }
                    }
                }
            } else {
                session()->flash('message', 'Product does not exists');
                $this->dispatch('message', [
                    'text' => 'Product does not exists',
                    'type' => 'warning',
                    'status' => 404
                ]);
            }
        } else {
            session()->flash('message', 'Please Login First');
            $this->dispatch('message', [
                'text' => 'Please Login First',
                'type' => 'info',
                'status' => 401
            ]);
        }
    }
    public function render()
    {
        return view('livewire.frontend.product.view', [
            'product' => $this->product,
            'category' => $this->category
        ]);
    }
}
