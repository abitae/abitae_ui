<?php

namespace Abitae\AbitaeUi\View\Components\Table;

use Illuminate\View\Component;
use Illuminate\View\View;

class Row extends Component
{
    public ?string $key;
    public bool $sticky;

    public function __construct(?string $key = null, bool $sticky = false)
    {
        $this->key = $key;
        $this->sticky = $sticky;
    }

    public function render(): View
    {
        return view('abitae-ui::components.table.row');
    }
}
