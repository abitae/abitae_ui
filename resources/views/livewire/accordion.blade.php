<div
    x-data="{
        openIndexes: [],
        toggle(index) {
            if (@js($multiple)) {
                this.openIndexes = this.openIndexes.includes(index)
                    ? this.openIndexes.filter(i => i !== index)
                    : [...this.openIndexes, index];
            } else {
                this.openIndexes = this.openIndexes[0] === index ? [] : [index];
            }
        },
        isOpen(index) {
            return this.openIndexes.includes(index);
        }
    }"
    class="space-y-2"
>
    @foreach ($items as $index => $item)
        <div class="border border-gray-200 rounded-md">
            <button
                type="button"
                class="w-full flex items-center justify-between px-4 py-3 text-left font-medium text-gray-900"
                @click="toggle({{ $index }})"
            >
                <span>{{ $item['title'] ?? 'Item' }}</span>
                <span
                    class="text-gray-500 transition-transform"
                    :class="{ 'rotate-180': isOpen({{ $index }}) }"
                >
                    ▼
                </span>
            </button>
            <div
                x-show="isOpen({{ $index }})"
                x-collapse
                class="px-4 pb-4 text-gray-700"
            >
                {!! $item['content'] ?? '' !!}
            </div>
        </div>
    @endforeach
</div>
