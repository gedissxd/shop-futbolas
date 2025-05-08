<?php

namespace App\Livewire;

use App\Models\Terminal;
use Livewire\Component;
use Mijora\Omniva\Locations\PickupPoints;
use Livewire\Attributes\Required;
class CartTerminals extends Component
{

    public $terminals = [];
    #[Required]
    public $pickupMethod = 'shop';

    public function mount()
    {
        $this->pickupMethod = request()->input('pickupMethod', 'shop');
    }
    public function getPickupPoints()
    {
        $pickupPoints = new PickupPoints();
        return $pickupPoints->getFilteredLocations('lt');
    }

    public function getTerminals()
    {
        return Terminal::orderBy('city')->get(['id', 'city', 'name', 'address']);
    }

    public function setPickupMethod($method)
    {
        $this->pickupMethod = $method;
        session(['pickupMethod' => $method]);
        $this->dispatch('pickupMethodChanged', $method);
    }
}
