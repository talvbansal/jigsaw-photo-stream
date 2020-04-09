<a
    href="/photos/{{ $photo->filename }}"
    class="open flex-grow relative border-2 vh-50 sm:vh-40 md:vh-30"
    title="{{ $photo->name }}"
    @click.prevent="showPhoto('{{ $photo->id }}')"
>
    <noscript class="loading-lazy">
        <img
            class="inline-block w-auto min-w-full min-h-full max-h-full object-cover
            transition duration-500 ease-in-out hover:opacity-50"
            loading="lazy"
            style="background-color: {{ $photo->tint }}"
            src="/{{ $photo->thumbnail }}"
            width="{{ $photo->width }}px"
            height="{{ $photo->height }}px"
        />
    </noscript>
</a>
