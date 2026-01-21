<?php

namespace Abitae\AbitaeUi\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Accordion extends Component
{
    public string $variant;
    public bool $transition;
    public bool $exclusive;

    public function __construct(string $variant = 'default', bool $transition = false, bool $exclusive = false)
    {
        $this->variant = $variant;
        $this->transition = $transition;
        $this->exclusive = $exclusive;
    }

    public function render(): View
    {
        return view('abitae-ui::components.accordion');
    }
}
