@php
    $containerClass = $attributes->get('container:class');
@endphp

<div data-abitae-table class="w-full {{ $containerClass }}">
    <div class="overflow-x-auto rounded-md border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200 text-sm text-gray-900">
            {{ $slot }}
        </table>
    </div>

    @if ($paginate)
        <div class="mt-3">
            {{ $paginate->links() }}
        </div>
    @endif
</div>
