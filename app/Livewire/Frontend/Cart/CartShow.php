<?php

namespace App\Livewire\Frontend\Cart;

use App\Models\Cart;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CartShow extends Component
{
    public $cart, $totalPrice=0;

    public function decrementQuantity(int $cartId)
    {
        $cartData = Cart::where('id', $cartId)->where('user_id', auth()->user()->id)->first();
        if ($cartData) {
            if ($cartData->productColor->where('id', $cartData->product_color_id)->exists()) {
                $productColor = $cartData->productColor->where('id', $cartData->product_color_id)->first();
                if ($productColor->quantity > $cartData->quantity) {
                    $cartData->decrement('quantity');
                    session()->flash('message', 'Quantity Updated');
                } else {
                    session()->flash('message', 'Only {$productColor->quantity} quantity available');
                }
            } else {
                if ($cartData->product->quantity > $cartData->quantity) {
                    $cartData->decrement('quantity');
                    session()->flash('message', 'Quantity Updated');
                } else {
                    session()->flash('message', 'Only {$cartData->product->quantity} quantity available');
                }
            }
        } else {
            session()->flash('message', 'Something went Wrong');
        }
    }

    public function incrementQuantity(int $cartId)
    {
        $cartData = Cart::where('id', $cartId)->where('user_id', auth()->user()->id)->first();
        if ($cartData) {
            if ($cartData->productColor()->where('id', $cartData->product_color_id)->exists()) {
                $productColor = $cartData->productColor->where('id', $cartData->product_color_id)->first();
                if ($productColor->quantity > $cartData->quantity) {
                    $cartData->increment('quantity');
                    session()->flash('message', 'Quantity Updated');
                } else {
                    session()->flash('message', 'Only {$productColor->quantity} quantity available');
                }
            } else {
                if ($cartData->product->quantity > $cartData->quantity) {
                    $cartData->increment('quantity');
                    session()->flash('message', 'Quantity Updated');
                } else {
                    session()->flash('message', 'Only {$cartData->product->quantity} quantity available');
                }
            }
        } else {
            session()->flash('message', 'Something went Wrong');
        }
    }

    public function removeCartItem(int $cartId)
    {
        $removeCartData = Cart::where('user_id', Auth::user()->id)->where('id', $cartId)->first();
        if ($removeCartData) {
            $removeCartData->delete();

            $this->dispatch('CartAddedUpdated');
            session()->flash('message', 'Cart Item removed');
        } else {
            session()->flash('message', 'Something went wrong');
        }
    }
    public function render()
    {
        $this->cart = Cart::where('user_id', auth()->user()->id)->get();
        return view('livewire.frontend.cart.cart-show', [
            'cart' => $this->cart
        ]);
    }
}
