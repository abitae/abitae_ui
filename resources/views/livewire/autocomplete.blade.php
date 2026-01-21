<div
    x-data="{ open: false }"
    class="relative"
    @click.away="open = false"
>
    <input
        type="text"
        class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
        placeholder="Buscar..."
        wire:model.debounce.250ms="query"
        @focus="open = true"
        @keydown.escape="open = false"
    />

    <div
        x-show="open"
        x-transition
        class="absolute z-10 mt-1 w-full rounded-md border border-gray-200 bg-white shadow-lg"
    >
        @if (count($filtered) > 0)
            <ul class="max-h-56 overflow-auto py-1 text-sm">
                @foreach ($filtered as $value)
                    <li>
                        <button
                            type="button"
                            class="w-full px-3 py-2 text-left hover:bg-gray-100"
                            wire:click="selectItem(@js($value))"
                            @click="open = false"
                        >
                            {{ $value }}
                        </button>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="px-3 py-2 text-sm text-gray-500">
                @if (mb_strlen($query) < $minChars)
                    Escribe al menos {{ $minChars }} caracteres.
                @else
                    Sin resultados.
                @endif
            </div>
        @endif
    </div>
</div>
