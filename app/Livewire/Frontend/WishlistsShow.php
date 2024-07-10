<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistsShow extends Component
{

    public function removeWishlistItem(int $wishlistId)
    {
        Wishlist::where('user_id', Auth::user()->id)->where('id', $wishlistId)->delete();
        $this->dispatch('wishlistAddedUpdated');
        session()->flash('message', 'Wishlist Item deleted successfully');
        $this->dispatch('message', [
            'text' => 'Wishlist Item deleted Successfully',
            'type' => 'success',
            'status' => 200
        ]);
    }
    public function render()
    {
        $wishlist = Wishlist::where('user_id', Auth::user()->id)->get();
        return view('livewire.frontend.wishlists-show', compact('wishlist'));
    }
}
