@props(['type' => 'info', 'message'])

<div style="padding: 15px; margin-bottom: 20px; border: 1px solid transparent; border-radius: 4px; 
    @if($type == 'success') background-color: #d4edda; color: #155724; border-color: #c3e6cb;
    @elseif($type == 'error') background-color: #f8d7da; color: #721c24; border-color: #f5c6cb;
    @else background-color: #cce5ff; color: #004085; border-color: #b8daff; @endif">
    {{ $message }}
</div>
