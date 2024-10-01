<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Images extends Component
{
    public $image;

    public function mount($image)
    {
        $this->image = $image;
    }

    public function render()
    {
        return view('livewire.images');
    }
}
