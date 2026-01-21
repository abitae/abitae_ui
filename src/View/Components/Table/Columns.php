<?php

namespace Abitae\AbitaeUi\View\Components\Table;

use Illuminate\View\Component;
use Illuminate\View\View;

class Columns extends Component
{
    public bool $sticky;

    public function __construct(bool $sticky = false)
    {
        $this->sticky = $sticky;
    }

    public function render(): View
    {
        return view('abitae-ui::components.table.columns');
    }
}
