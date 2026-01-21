<?php

namespace Abitae\AbitaeUi\View\Components\Table;

use Illuminate\View\Component;
use Illuminate\View\View;

class Cell extends Component
{
    public string $align;
    public string $variant;
    public bool $sticky;

    public function __construct(string $align = 'start', string $variant = 'default', bool $sticky = false)
    {
        $this->align = $align;
        $this->variant = $variant;
        $this->sticky = $sticky;
    }

    public function render(): View
    {
        return view('abitae-ui::components.table.cell');
    }
}
