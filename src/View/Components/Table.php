<?php

namespace Abitae\AbitaeUi\View\Components;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\View\Component;
use Illuminate\View\View;

class Table extends Component
{
    public LengthAwarePaginator|Paginator|null $paginate;

    public function __construct(LengthAwarePaginator|Paginator|null $paginate = null)
    {
        $this->paginate = $paginate;
    }

    public function render(): View
    {
        return view('abitae-ui::components.table');
    }
}
