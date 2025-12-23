@props(['title', 'createUrl' => null, 'createText' => 'Add New'])

<div class="bg-white border border-secondary p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="font-serif text-3xl text-primary">{{ $title }}</h1>
        @if($createUrl)
            <a href="{{ $createUrl }}" class="bg-primary text-white px-6 py-2 text-sm font-medium hover:bg-accent transition-colors rounded-none">
                + {{ $createText }}
            </a>
        @endif
    </div>

    <div class="overflow-x-auto">
        {{ $slot }}
    </div>
</div>
