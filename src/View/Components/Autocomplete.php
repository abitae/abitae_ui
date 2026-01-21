<?php

namespace Abitae\AbitaeUi\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Autocomplete extends Component
{
    public ?string $label;
    public ?string $description;
    public ?string $placeholder;
    public string $type;
    public ?string $size;
    public string $variant;
    public bool $disabled;
    public bool $readonly;
    public bool $invalid;
    public bool $multiple;
    public ?string $mask;
    public ?string $icon;
    public ?string $iconTrailing;
    public ?string $kbd;
    public bool $clearable;
    public bool $copyable;
    public bool $viewable;
    public string $as;
    public int $minChars;

    public function __construct(
        ?string $label = null,
        ?string $description = null,
        ?string $placeholder = null,
        string $type = 'text',
        ?string $size = null,
        string $variant = 'outline',
        bool $disabled = false,
        bool $readonly = false,
        bool $invalid = false,
        bool $multiple = false,
        ?string $mask = null,
        ?string $icon = null,
        ?string $iconTrailing = null,
        ?string $kbd = null,
        bool $clearable = false,
        bool $copyable = false,
        bool $viewable = false,
        string $as = 'input',
        int $minChars = 2
    ) {
        $this->label = $label;
        $this->description = $description;
        $this->placeholder = $placeholder;
        $this->type = $type;
        $this->size = $size;
        $this->variant = $variant;
        $this->disabled = $disabled;
        $this->readonly = $readonly;
        $this->invalid = $invalid;
        $this->multiple = $multiple;
        $this->mask = $mask;
        $this->icon = $icon;
        $this->iconTrailing = $iconTrailing;
        $this->kbd = $kbd;
        $this->clearable = $clearable;
        $this->copyable = $copyable;
        $this->viewable = $viewable;
        $this->as = $as;
        $this->minChars = $minChars;
    }

    public function render(): View
    {
        return view('abitae-ui::components.autocomplete');
    }
}
