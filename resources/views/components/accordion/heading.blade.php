<button
    type="button"
    class="w-full flex items-center justify-between px-4 py-3 text-left font-medium text-gray-900"
    :class="{
        'flex-row-reverse gap-2': variant === 'reverse',
        'opacity-50 cursor-not-allowed': disabled
    }"
    :disabled="disabled"
    @click="
        if (disabled) return;
        open = !open;
        $dispatch('abitae-accordion-toggle', { rootId: rootId, id: id, open: open });
    "
>
    <span>{{ $slot }}</span>
    <span
        class="text-gray-500 transition-transform"
        :class="{ 'rotate-180': open }"
    >
        ▼
    </span>
</button>
