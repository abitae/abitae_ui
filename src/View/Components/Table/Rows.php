<?php

namespace Abitae\AbitaeUi\View\Components\Table;

use Illuminate\View\Component;
use Illuminate\View\View;

class Rows extends Component
{
    public function render(): View
    {
        return view('abitae-ui::components.table.rows');
    }
}
