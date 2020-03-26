@extends('_layouts.master')

@section('content')
    <div class="flex flex-wrap relative content-start">
        @foreach($photos as $photo)
            @include('_partials/photo', ['photo' => $photo])
        @endforeach
    </div>
@endsection
