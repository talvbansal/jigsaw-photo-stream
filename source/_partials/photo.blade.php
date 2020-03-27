<div
     class="open flex-grow relative border-2 vh-60 sm:vh-40 md:vh-30"
     style="
background-color: {{ $photo->tint }};
width:'{{ $photo->width }}px';
height:'{{ $photo->height }}px';"
title="{{ $photo->name }}
">
    <a href="/photos/{{ $photo->filename }}" @click.prevent="showPhoto('{{ $photo->id }}')">
        <noscript class="loading-lazy">
            <img
                class="inline-block w-auto min-w-full min-h-full max-h-full object-cover
                transition duration-500 ease-in-out hover:opacity-50"
                loading="lazy"
                src="/{{ $photo->thumbnail }}"
                width="{{ $photo->width }}"
                height="{{ $photo->height }}"
            />
        </noscript>
    </a>
</div>
