<?php

namespace Abitae\AbitaeUi\View\Components\Accordion;

use Illuminate\View\Component;
use Illuminate\View\View;

class Item extends Component
{
    public ?string $heading;
    public bool $expanded;
    public bool $disabled;

    public function __construct(?string $heading = null, bool $expanded = false, bool $disabled = false)
    {
        $this->heading = $heading;
        $this->expanded = $expanded;
        $this->disabled = $disabled;
    }

    public function render(): View
    {
        return view('abitae-ui::components.accordion.item');
    }
}
