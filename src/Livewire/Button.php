<?php

namespace Abitae\AbitaeUi\Livewire;

use Livewire\Component;

class Button extends Component
{
    public string $label = 'Button';
    public string $variant = 'primary';
    public string $size = 'md';
    public string $type = 'button';
    public bool $disabled = false;

    public function mount(
        string $label = 'Button',
        string $variant = 'primary',
        string $size = 'md',
        string $type = 'button',
        bool $disabled = false
    ): void {
        $this->label = $label;
        $this->variant = $variant;
        $this->size = $size;
        $this->type = $type;
        $this->disabled = $disabled;
    }

    public function render()
    {
        return view('abitae-ui::livewire.button');
    }
}
