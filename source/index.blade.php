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

        @include('_partials/modal')
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
                        'name' => $photo->name,
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

                    document.title = photo.name;
                    document.querySelector('#og-url').content = photo.link;
                    document.querySelector('#og-image').content = photo.photo;

                    window.history.pushState({}, '', photo.link);

                    if(!this.open) {
                        setTimeout(() => {
                            this.open = true
                        }, 125);
                    }
                },
                close() {
                    this.open = false
                    document.title = '{{ $page->siteTitle }}';
                    document.querySelector('#og-url').content = '{{ $page->getUrl() }}';
                    document.querySelector('#og-image').content = '/{{ $photos->first()->photo }}';
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
