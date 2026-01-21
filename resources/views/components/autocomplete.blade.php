@php
    use Illuminate\View\ComponentSlot;
    use Illuminate\Support\Str;

    $wireModel = $attributes->wire('model')->value();
    $containerClass = $attributes->get('container:class');
    $inputClass = $attributes->get('class:input');
    $wireAttributes = $attributes->whereStartsWith('wire:model');
    $iconLeadingAttr = $attributes->get('icon:leading');
    $iconTrailingAttr = $attributes->get('icon:trailing');
    $iconSlot = $icon instanceof ComponentSlot ? $icon : null;
    $iconLeadingSlot = isset($iconLeading) && $iconLeading instanceof ComponentSlot ? $iconLeading : null;
    $iconTrailingSlot = isset($iconTrailing) && $iconTrailing instanceof ComponentSlot ? $iconTrailing : null;
    $iconComponent = $icon ? 'heroicon-s-' . Str::kebab($icon) : null;
    $iconLeadingComponent = $iconLeadingAttr ? 'heroicon-s-' . Str::kebab($iconLeadingAttr) : null;
    $iconTrailingComponent = $iconTrailingAttr ? 'heroicon-s-' . Str::kebab($iconTrailingAttr) : null;
    $sizeClass = match ($size) {
        'xs' => 'px-2 py-1 text-xs',
        'sm' => 'px-2.5 py-1.5 text-sm',
        default => 'px-3 py-2 text-sm',
    };
    $variantClass = $variant === 'filled'
        ? 'bg-gray-100 border-gray-200 focus:border-blue-500'
        : 'bg-white border-gray-300 focus:border-blue-500';
    $stateClass = $invalid ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : '';
@endphp

<div
    x-data="{
        query: {{ $wireModel ? "@entangle('{$wireModel}').defer" : "''" }},
        open: false,
        items: [],
        inputType: '{{ $type }}',
        minChars: {{ (int) $minChars }},
        init() {
            this.items = [...this.$el.querySelectorAll('[data-autocomplete-item]')]
                .map(el => ({
                    value: el.dataset.value,
                    label: el.dataset.label,
                    disabled: el.dataset.disabled === 'true'
                }));
        },
        get filtered() {
            if (this.query.length < this.minChars) {
                return [];
            }
            const q = this.query.toLowerCase();
            return this.items.filter(item => item.label.toLowerCase().includes(q));
        },
        select(item) {
            if (item.disabled) return;
            this.query = item.value;
            this.open = false;
        }
    }"
    class="relative {{ $containerClass }}"
    @click.away="open = false"
>
    @if ($label)
        <label class="mb-1 block text-sm font-medium text-gray-700">
            {{ $label }}
        </label>
    @endif

    <div class="relative">
        @if ($iconSlot || $iconLeadingSlot || $iconTrailingSlot || $icon || $iconLeadingAttr || $iconTrailingAttr)
            <div class="absolute inset-y-0 left-3 flex items-center text-gray-500">
                @if ($iconSlot)
                    {{ $iconSlot }}
                @elseif ($iconLeadingSlot)
                    {{ $iconLeadingSlot }}
                @elseif ($iconComponent)
                    <x-dynamic-component :component="$iconComponent" class="h-4 w-4" />
                @elseif ($iconLeadingComponent)
                    <x-dynamic-component :component="$iconLeadingComponent" class="h-4 w-4" />
                @endif
            </div>
        @endif

        @if ($as === 'button')
            <button
                type="button"
                class="w-full rounded-md border focus:outline-none focus:ring-2 focus:ring-blue-500 text-left {{ $sizeClass }} {{ $variantClass }} {{ $stateClass }} {{ $inputClass }} {{ ($iconSlot || $iconLeadingSlot || $icon || $iconLeadingAttr) ? 'pl-9' : '' }}"
                @click="open = !open"
                :disabled="{{ $disabled ? 'true' : 'false' }}"
            >
                <span x-text="query || '{{ $placeholder ?? 'Seleccionar...' }}'"></span>
            </button>
            <input type="hidden" x-model="query" {{ $wireAttributes }} />
        @else
            <input
                type="{{ $type }}"
                class="w-full rounded-md border focus:outline-none focus:ring-2 focus:ring-blue-500 {{ $sizeClass }} {{ $variantClass }} {{ $stateClass }} {{ $inputClass }} {{ ($iconSlot || $iconLeadingSlot || $icon || $iconLeadingAttr) ? 'pl-9' : '' }}"
                placeholder="{{ $placeholder ?? 'Buscar...' }}"
                x-model="query"
                @focus="open = true"
                @keydown.escape="open = false"
                {{ $disabled ? 'disabled' : '' }}
                {{ $readonly ? 'readonly' : '' }}
                {{ $multiple ? 'multiple' : '' }}
                x-bind:type="inputType"
                @if ($mask) x-mask="{{ $mask }}" @endif
                {{ $wireAttributes }}
            />
        @endif

        <div class="absolute inset-y-0 right-2 flex items-center gap-2 text-gray-500">
            @if ($clearable)
                <button
                    type="button"
                    class="text-xs"
                    x-show="query"
                    @click="query = ''"
                >
                    Clear
                </button>
            @endif
            @if ($copyable)
                <button
                    type="button"
                    class="text-xs"
                    @click="navigator.clipboard.writeText(query || '')"
                >
                    Copy
                </button>
            @endif
            @if ($viewable && $type === 'password')
                <button
                    type="button"
                    class="text-xs"
                    @click="inputType = inputType === 'password' ? 'text' : 'password'"
                >
                    View
                </button>
            @endif
            @if ($kbd)
                <span class="text-xs">{{ $kbd }}</span>
            @endif
            @if ($iconTrailingSlot)
                {{ $iconTrailingSlot }}
            @elseif ($iconTrailingComponent)
                <x-dynamic-component :component="$iconTrailingComponent" class="h-4 w-4" />
            @endif
        </div>
    </div>

    @if ($description)
        <p class="mt-1 text-xs text-gray-500">{{ $description }}</p>
    @endif

    <div
        x-show="open"
        x-transition
        class="absolute z-10 mt-1 w-full rounded-md border border-gray-200 bg-white shadow-lg"
    >
        <template x-if="filtered.length > 0">
            <ul class="max-h-56 overflow-auto py-1 text-sm">
                <template x-for="item in filtered" :key="item.value">
                    <li :class="{ 'opacity-50': item.disabled }">
                        <button
                            type="button"
                            class="w-full px-3 py-2 text-left hover:bg-gray-100 disabled:cursor-not-allowed"
                            @click="select(item)"
                            :disabled="item.disabled"
                        >
                            <span x-text="item.label"></span>
                        </button>
                    </li>
                </template>
            </ul>
        </template>
        <template x-if="filtered.length === 0">
            <div class="px-3 py-2 text-sm text-gray-500">
                <span x-show="query.length < minChars">Escribe al menos <span x-text="minChars"></span> caracteres.</span>
                <span x-show="query.length >= minChars">Sin resultados.</span>
            </div>
        </template>
    </div>

    <div class="hidden">
        {{ $slot }}
    </div>
</div>
