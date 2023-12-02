<?php

namespace App\Livewire;

use Livewire\Attributes\Modelable;
use Livewire\Component;

class Input extends Component
{
    public string $name = '';
    public string $type = '';
    public string $placeholder = '';
    public bool $required = false;

    #[Modelable]
    public string $value = '';

    public function render()
    {
        return view('livewire.input');
    }
}
