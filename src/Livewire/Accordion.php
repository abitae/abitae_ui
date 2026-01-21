<?php

namespace Abitae\AbitaeUi\Livewire;

use Livewire\Component;

class Accordion extends Component
{
    public array $items = [];
    public bool $multiple = false;

    public function mount(array $items = [], bool $multiple = false): void
    {
        $this->items = $items;
        $this->multiple = $multiple;
    }

    public function render()
    {
        return view('abitae-ui::livewire.accordion');
    }
}
