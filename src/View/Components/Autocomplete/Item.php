<?php

namespace Abitae\AbitaeUi\View\Components\Autocomplete;

use Illuminate\View\Component;
use Illuminate\View\View;

class Item extends Component
{
    public ?string $value;
    public bool $disabled;

    public function __construct(?string $value = null, bool $disabled = false)
    {
        $this->value = $value;
        $this->disabled = $disabled;
    }

    public function render(): View
    {
        return view('abitae-ui::components.autocomplete.item');
    }
}
