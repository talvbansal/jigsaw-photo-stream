<div x-data="{ open: false }"
     class="flex-grow relative border-2 vh-60 sm:vh-50 md:vh-40"
     style="
background-color: {{ $photo->tint }};
width:'{{ $photo->width }}px';
height:'{{ $photo->height }}px';"
title="{{ $photo->name }}
">
    <a class="open" href="/photos/{{ $photo->filename }}" @click.prevent="open = true">
        <noscript class="loading-lazy">
            <img
                class="inline-block w-auto min-w-full min-h-full max-h-full object-cover
                transition duration-500 ease-in-out hover:opacity-75"
                loading="lazy"
                src="{{ $photo->thumbnail }}"
                width="{{ $photo->width }}"
                height="{{ $photo->height }}"
            />
        </noscript>
    </a>

    <div x-show="open" @click="open = false" class="close z-10 fixed bottom-0 inset-x-0 px-4 pb-6 sm:inset-0 sm:p-0 sm:flex sm:items-center sm:justify-center">

        <!-- Modal window layer -->
        <div x-show="open"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-75"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-75"
             x-transition:leave-end="opacity-0"
             class="flex absolute top-0 right-0 left-0 bottom-0 opacity-75"
             style="background-color: {{ $photo->tint }};">
        </div>

        <div x-show="open"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-75 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             class="h-full overflow-hidden shadow-xl transform transition-all"
        >
            <img class="object-contain w-full h-full px-16" :src="(open)?  '/{{ $photo->photo }}' : '' "/>

            @if(!$loop->first)
                <a href="/photos/{{ $photos[$loop->index]->filename }}"
                   class="absolute top-0 bottom-0 left-0 z-20 flex content-center items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="48px" height="48px" viewBox="0 0 48 48"><g transform="translate(0, 0)"><path fill="#444444" d="M30.382,47.177l3.235-2.354L18.473,24L33.618,3.177l-3.235-2.354l-16,22c-0.51,0.702-0.51,1.651,0,2.354 L30.382,47.177z"></path></g></svg>
                </a>
            @endif

            @if(!$loop->last)
                <a href="/photos/{{ $photos[$loop->index]->filename }}"
                   class="absolute top-0 bottom-0 right-0 z-20 flex content-center  items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="48px" height="48px" viewBox="0 0 48 48"><g transform="translate(0, 0)"><path fill="#444444" d="M17.618,47.177l-3.235-2.354L29.527,24L14.382,3.177l3.235-2.354l16,22c0.51,0.702,0.51,1.651,0,2.354 L17.618,47.177z"></path></g></svg>
                </a>
            @endif
        </div>
    </div>
</div>
