<div class="flex-grow relative border-2 vh-80 sm:vh-60 md:vh-40" style="
background-color: {{ $photo->tint }};
width:'{{ $photo->width }}px';
height:'{{ $photo->height }}px';"

title="{{ $photo->name }}">
    <a class="open" href="">
        <img
            class="inline-block w-auto min-w-full min-h-full max-h-full object-cover
            transition duration-500 ease-in-out hover:opacity-75"
            loading="lazy"
            src="{{ $photo->thumbnail }}"
            width="{{ $photo->width }}"
            height="{{ $photo->height }}"
        />
    </a>

    <a class="close" href="">Close</a>
</div>
