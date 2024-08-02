@props(['component'])

@php
    // Convert the path to the Blade component to the correct format
    $componentPath = str_replace('.', '/', $component);
@endphp

<div>
    @if(view()->exists($componentPath))
        @include($componentPath)
    @else
        <p>Component not found</p>
    @endif
</div>