<?php

namespace Abitae\AbitaeUi\Livewire;

use Livewire\Component;

class Autocomplete extends Component
{
    public string $query = '';
    public array $items = [];
    public ?string $selected = null;
    public int $minChars = 2;

    public function mount(array $items = [], int $minChars = 2): void
    {
        $this->items = $items;
        $this->minChars = $minChars;
    }

    public function updatedQuery(): void
    {
        $this->selected = null;
    }

    public function selectItem(string $value): void
    {
        $this->selected = $value;
        $this->query = $value;
    }

    public function getFilteredProperty(): array
    {
        if (mb_strlen($this->query) < $this->minChars) {
            return [];
        }

        $query = mb_strtolower($this->query);

        return array_values(array_filter($this->items, function ($item) use ($query) {
            return str_contains(mb_strtolower((string) $item), $query);
        }));
    }

    public function render()
    {
        return view('abitae-ui::livewire.autocomplete', [
            'filtered' => $this->filtered,
        ]);
    }
}
