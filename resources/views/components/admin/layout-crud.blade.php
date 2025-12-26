@props(['title', 'createUrl' => null, 'createText' => 'Add New'])

<div class="bg-white border border-secondary p-4 md:p-6 rounded-lg shadow-sm">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <h1 class="font-serif text-2xl md:text-3xl text-primary">{{ $title }}</h1>
        @if($createUrl)
            <a href="{{ $createUrl }}" class="bg-primary text-white px-6 py-2 text-sm font-medium hover:bg-accent transition-colors rounded-lg w-full md:w-auto text-center">
                + {{ $createText }}
            </a>
        @endif
    </div>

    <div class="overflow-x-auto">
        {{ $slot }}
    </div>
</div>
