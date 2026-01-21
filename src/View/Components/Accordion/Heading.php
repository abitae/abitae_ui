<?php

namespace Abitae\AbitaeUi\View\Components\Accordion;

use Illuminate\View\Component;
use Illuminate\View\View;

class Heading extends Component
{
    public function render(): View
    {
        return view('abitae-ui::components.accordion.heading');
    }
}
