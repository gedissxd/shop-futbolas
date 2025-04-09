<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Terminal;
use Livewire\Attributes\On;
use Mijora\Omniva\Locations\PickupPoints;

class CartItem extends Component
{
    public $carts = [];
    public $terminals = [];
    public $pickupMethod = 'shop';


    public function getPickupPoints()
    {
        $pickupPoints = new PickupPoints();
        $this->omnivaPickupPoints = $pickupPoints->getFilteredLocations('lt');
        return $this->omnivaPickupPoints;
    }

    public function mount()
    {
        $userId = auth()->id();
        $this->refreshCart();
     
        $this->pickupMethod = request()->input('pickupMethod', 'shop');

    }

    private function refreshCart()
    {
        $this->carts = Cart::where('user_id', auth()->id())
            ->with('product')
            ->get();
    }


    public function increment($id)
    {
        $cart = $this->carts->firstWhere('id', $id);

        if (!$cart) {
            return;
        }

        if ($cart->quantity + 1 > $cart->product->stock) {
            session()->flash('error', __('Cannot add more of :product, only :stock available', ['product' => $cart->product->name, 'stock' => $cart->product->stock]));
            return;
        }

        $cart->quantity++;
        $cart->save();

        $this->dispatch('cartUpdated'); 
    }

    public function decrement($id)
    {
        $cart = $this->carts->firstWhere('id', $id);

        if (!$cart) {
            return;
        }

        if ($cart->quantity > 1) {
            $cart->quantity--;
            $cart->save();
        }
        
        $this->dispatch('cartUpdated'); 
    }

    public function getCartTotal()
    {
        return $this->carts->sum(function($cart) {
            return $cart->product->price * $cart->quantity;
        });
    }
    public function getTerminals()
    {
        return Terminal::orderBy('city')->get(['id', 'city', 'name', 'address']);

    }

    public function delete($id)
    {
        $cart = $this->carts->firstWhere('id', $id);
        
        if (!$cart) {
            return;
        }
        
        $cart->delete();
        $this->dispatch('cartUpdated');
    }

    public function setPickupMethod($method)
    {
        $this->pickupMethod = $method;
        session(['pickupMethod' => $method]);
        return $this->pickupMethod;
    }

    public function render()
    {
        return view('livewire.cart-item');
    }
}
