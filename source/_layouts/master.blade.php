<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <title>{{ $page->siteTitle }}</title>
        <meta property="og:title" content="{{ $page->siteTitle }}">
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ $page->getUrl() }}" id="og-url">
        <meta property="og:image" content="/{{ $photos->first()->photo }}" id="og-image">
        <meta property="og:site_name" content="{{ $page->siteTitle }}">
        <meta property="og:description" content="{{ $page->siteDescription }}">

        @if($page->links->twitter)
            <meta name="twitter:creator" content="{{ '@'.$page->links->twitter }}">
        @endif
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="{{ $page->getUrl() }}">
        <meta name="twitter:title" content="{{ $page->siteTitle }}" id="tw-title">
        <meta name="twitter:description" content="{{ $page->siteDescription }}">
        <meta name="twitter:image:src" content="/{{ $photos->first()->photo }}" id="tw-image">

        <meta name="description" content="{{ $page->siteDescription }}">

        <link rel="icon" type="image/png" href="/assets/favicon.png"/>
        <link rel="stylesheet" href="{{ mix('/css/main.css') }}">
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
        <script async src="https://cdn.jsdelivr.net/npm/loading-attribute-polyfill@0.2.0/loading-attribute-polyfill.min.js" integrity="sha256-kX73NqVUoUbV0K44kgoqP8P8IZfU0OEjr/afCnK2Mrg=" crossorigin="anonymous"></script>
    </head>

    <body class="antialiased font-sans">
        @yield('content')
        @include('./../_partials/social-links')
    </body>
</html>
