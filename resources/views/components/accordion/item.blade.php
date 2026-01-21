<div
    x-data="{
        id: null,
        rootId: null,
        variant: 'default',
        transition: false,
        exclusive: false,
        open: @js($expanded),
        disabled: @js($disabled),
        init() {
            this.id = 'item-' + Math.random().toString(36).slice(2);
            const root = this.$el.closest('[data-accordion-root]');
            this.rootId = root ? root.dataset.accordionId : null;
            if (root) {
                this.variant = root.dataset.accordionVariant || 'default';
                this.transition = root.dataset.accordionTransition === 'true';
                this.exclusive = root.dataset.accordionExclusive === 'true';
            }
        }
    }"
    data-accordion-item
    @abitae-accordion-close.window="
        if ($event.detail.rootId === rootId && $event.detail.except !== id) {
            open = false;
        }
    "
    class="border border-gray-200 rounded-md"
>
    @if ($heading)
        @component('abitae-ui::components.accordion.heading')
            {{ $heading }}
        @endcomponent
    @endif

    {{ $slot }}
</div>
