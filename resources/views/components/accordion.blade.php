<div
    x-data="{
        rootId: null,
        variant: @js($variant),
        transition: @js($transition),
        exclusive: @js($exclusive),
        init() {
            this.rootId = 'acc-' + Math.random().toString(36).slice(2);
        }
    }"
    x-bind:data-accordion-id="rootId"
    x-bind:data-accordion-variant="variant"
    x-bind:data-accordion-transition="transition"
    x-bind:data-accordion-exclusive="exclusive"
    data-accordion-root
    @abitae-accordion-toggle.window="
        if ($event.detail.rootId !== rootId) return;
        if (exclusive && $event.detail.open) {
            $dispatch('abitae-accordion-close', { rootId: rootId, except: $event.detail.id });
        }
    "
    class="space-y-2"
>
    {{ $slot }}
</div>
