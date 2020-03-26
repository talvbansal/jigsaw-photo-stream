@extends('_layouts.master')

@section('content')
    <div x-data="photo_stream_data()" x-init="init()" class="flex flex-wrap relative content-start"
        @keydown.escape="close()"
        @keydown.arrow-left="previousImage(event)"
        @keydown.arrow-right="nextImage(event)"
    >
        @foreach($photos->values() as $photo)
            @include('_partials/photo', ['photo' => $photo])
        @endforeach

        <div x-show="open" class="close z-10 fixed top-0 bottom-0 inset-x-0 px-4 pb-6 sm:inset-0 sm:p-0 sm:flex sm:items-center sm:justify-center">
            <!-- Modal window layer -->
            <div @click.prevent="close()"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-75"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-75"
                 x-transition:leave-end="opacity-0"
                 class="flex absolute top-0 right-0 left-0 bottom-0 opacity-75 transition duration-500 ease-in-out transform transition-all z-10"
                 :style="tint">
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
                 class="h-full overflow-hidden shadow-xl transform transition-all duration-1000 ease-in-out z-30"
            >
                <img class="object-contain w-full h-full px-2 md:px-16" :src="src"/>

                <a x-show="previous" href="javascript:;" @click.prevent="previousImage(event)"
                   class="absolute top-0 bottom-0 left-0 z-40 flex content-center items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="48px" height="48px" viewBox="0 0 48 48"><g transform="translate(0, 0)"><path fill="#444444" d="M30.382,47.177l3.235-2.354L18.473,24L33.618,3.177l-3.235-2.354l-16,22c-0.51,0.702-0.51,1.651,0,2.354 L30.382,47.177z"></path></g></svg>
                </a>

                <a x-show="next" href="javascript:;" @click.prevent="nextImage(event)"
                   class="absolute top-0 bottom-0 right-0 z-40 flex content-center  items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="48px" height="48px" viewBox="0 0 48 48"><g transform="translate(0, 0)"><path fill="#444444" d="M17.618,47.177l-3.235-2.354L29.527,24L14.382,3.177l3.235-2.354l16,22c0.51,0.702,0.51,1.651,0,2.354 L17.618,47.177z"></path></g></svg>
                </a>
            </div>
        </div>
    </div>
    <script>
        function photo_stream_data() {
            return {
                open: false,
                photos: {!! $photos->values()->map(function($photo) use($photos){
                    return (object) [
                        'id' => (int) $photo->id,
                        'photo' => '/'.$photo->photo,
                        'tint' => 'background-color: '.$photo->tint,
                        'link' => '/photos/'.$photo->filename,
                        'filename' => $photo->filename,
                        'next' => $photos->where('filename', '=', $photo->_meta->nextItem)->first()->id ?? null,
                        'previous' => $photos->where('filename', '=', $photo->_meta->previousItem)->first()->id ?? null,
                    ];
                })->toJson() !!},

                href: '',
                tint: '',
                next: '',
                previous: '',
                src: '',

                init(){
                  if(window.location.pathname !== '/'){
                      const name = window.location.pathname.split('/')[2];
                      const photo = this.photos.find((photo) => {
                          return photo.filename === name;
                      });

                      if(photo) {
                          this.showPhoto(photo.id)
                      }
                  }
                },

                showPhoto(id) {
                    id = Number.parseInt(id);
                    const photo = this.photos.find((photo) => {
                        return photo.id === id;
                    });

                    this.src = photo.photo;
                    this.tint = photo.tint;
                    this.previous = photo.previous;
                    this.next = photo.next;
                    this.href = photo.link;

                    window.history.pushState({}, '', photo.link);

                    if(!this.open) {
                        setTimeout(() => {
                            this.open = true
                        }, 125);
                    }
                },
                close() {
                    this.open = false
                    if(this.href) {
                        window.history.pushState({}, '', '/');
                    }
                },

                nextImage(event){
                    event.stopPropagation();
                    this.showPhoto(this.next)
                },

                previousImage(event){
                    event.stopPropagation();
                    this.showPhoto(this.previous)
                }
            }
        }

    </script>
@endsection
