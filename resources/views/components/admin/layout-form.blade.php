@props([
    'title', 
    'subtitle' => null, 
    'action', 
    'method' => 'POST', 
    'hasFiles' => false,
    'backUrl' => null,
    'submitText' => 'Save'
])

<div class="max-w-2xl mx-auto bg-white border border-secondary p-8">
    <div class="mb-8">
        <h1 class="font-serif text-3xl text-primary mb-2">{{ $title }}</h1>
        @if($subtitle)
            <p class="text-gray-500 text-sm">{{ $subtitle }}</p>
        @endif
    </div>

    <form action="{{ $action }}" method="{{ $method === 'GET' ? 'GET' : 'POST' }}" @if($hasFiles) enctype="multipart/form-data" @endif class="space-y-6">
        @csrf
        @if(!in_array($method, ['GET', 'POST']))
            @method($method)
        @endif

        {{ $slot }}

        <div class="flex justify-end gap-4 pt-4 border-t border-secondary">
            @if($backUrl)
                <a href="{{ $backUrl }}" class="px-6 py-2 text-sm font-medium text-gray-600 hover:text-primary transition-colors">Cancel</a>
            @endif
            <button type="submit" class="bg-primary text-white px-8 py-2 text-sm font-medium hover:bg-accent transition-colors rounded-none">
                {{ $submitText }}
            </button>
        </div>
    </form>
</div>
