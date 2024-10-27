@props(['tagsCsv'])

@php
$tags = explode(',', $tagsCsv); 
@endphp

<div class="tags">
    @foreach ($tags as $tag)
        <a href="/?tag={{ $tag }}" class="tag">{{ $tag }}</a>
    @endforeach
</div>
