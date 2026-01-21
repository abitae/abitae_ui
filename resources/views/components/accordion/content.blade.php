<div
    x-show="open"
    x-bind:x-collapse="transition"
    class="px-4 pb-4 text-gray-700"
>
    {{ $slot }}
</div>
