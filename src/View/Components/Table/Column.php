<?php

namespace Abitae\AbitaeUi\View\Components\Table;

use Illuminate\View\Component;
use Illuminate\View\View;

class Column extends Component
{
    public string $align;
    public bool $sortable;
    public bool $sorted;
    public ?string $direction;
    public bool $sticky;

    public function __construct(
        string $align = 'start',
        bool $sortable = false,
        bool $sorted = false,
        ?string $direction = null,
        bool $sticky = false
    ) {
        $this->align = $align;
        $this->sortable = $sortable;
        $this->sorted = $sorted;
        $this->direction = $direction;
        $this->sticky = $sticky;
    }

    public function render(): View
    {
        return view('abitae-ui::components.table.column');
    }
}
