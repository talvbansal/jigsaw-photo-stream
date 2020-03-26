@extends('_layouts.master')

@section('content')
    <div class="flex flex-wrap relative content-start">
        @foreach($photos->values() as $photo)
            @include('_partials/photo', ['photos' => $photos->values(), 'photo' => $photo])
        @endforeach
    </div>
@endsection
