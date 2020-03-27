<div x-show="open" class="close fixed bottom-0 inset-x-0 inset-0 p-0 flex items-center justify-center z-20">
    <div x-show="open"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity">
        <div class="absolute inset-0 opacity-75 transition ease-in-out duration-500" :style="tint"></div>
    </div>

    <!-- Modal Content -->
    <div @click.prevent="close()"
         @keydown.escape="close()"
         @keydown.arrow-left="previousImage(event)"
         @keydown.arrow-right="nextImage(event)"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-75 translate-y-0 sm:scale-100"
         x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         class="flex items-center fixed top-0 right-0 left-0 bottom-0 h-full overflow-hidden shadow-xl transform transition-all duration-1000 ease-in-out z-30"
    >
        <img class="object-contain w-full h-full md:px-16" :src="src"/>

        <a x-show="previous" href="javascript:;" @click.prevent="previousImage(event)"
           class="absolute top-0 bottom-0 left-0 z-40 flex content-center items-center justify-center ">
            <div class="transition ease-in-out duration-300 rounded-full p-2 bg-gray-100 opacity-50 hover:opacity-75 ml-1">
                <svg class="opacity-100" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="24px" height="24px" viewBox="0 0 48 48"><g transform="translate(0, 0)"><path fill="#444444" d="M30.382,47.177l3.235-2.354L18.473,24L33.618,3.177l-3.235-2.354l-16,22c-0.51,0.702-0.51,1.651,0,2.354 L30.382,47.177z"></path></g></svg>
            </div>
        </a>

        <a x-show="next" href="javascript:;" @click.prevent="nextImage(event)"
           class="absolute top-0 bottom-0 right-0 z-40 flex content-center  items-center justify-center ">
            <div class="transition ease-in-out duration-300 rounded-full p-2 bg-gray-100 opacity-50 hover:opacity-75 mr-1">
                <svg class="opacity-100" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="24px" height="24px" viewBox="0 0 48 48"><g transform="translate(0, 0)"><path fill="#444444" d="M17.618,47.177l-3.235-2.354L29.527,24L14.382,3.177l3.235-2.354l16,22c0.51,0.702,0.51,1.651,0,2.354 L17.618,47.177z"></path></g></svg>
            </div>
        </a>
    </div>
</div>
