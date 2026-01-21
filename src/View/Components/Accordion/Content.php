<?php

namespace Abitae\AbitaeUi\View\Components\Accordion;

use Illuminate\View\Component;
use Illuminate\View\View;

class Content extends Component
{
    public function render(): View
    {
        return view('abitae-ui::components.accordion.content');
    }
}
