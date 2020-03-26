<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>{{ $page->siteTitle }}</title>

        <link rel="stylesheet" href="{{ mix('/css/main.css') }}">
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
        <script async src="https://cdn.jsdelivr.net/npm/loading-attribute-polyfill@0.2.0/loading-attribute-polyfill.min.js" integrity="sha256-kX73NqVUoUbV0K44kgoqP8P8IZfU0OEjr/afCnK2Mrg=" crossorigin="anonymous"></script>
    </head>

    <body class="antialiased font-sans">
        @yield('content')

        <ul class="fixed bottom-0 right-0 flex flex-col sm:flex-row flex-wrap ml-6 mb-6 mr-6 opacity-75">
            <li class="text-xs mr-1 mb-1 rounded px-2 py-1 bg-gray-100 text-gray-800 uppercase"><a rel="me" href="https://github.com/talvbansal/photo-stream" title="Fork on Github">Fork Me on Github</a></li>
            <li class="text-xs mr-1 mb-1 rounded px-2 py-1 bg-gray-100 text-gray-800 uppercase"><a rel="me" href="https://twitter.com/{{ $page->links->twitter }}" title="@{{ $page->links->twitter }} on Twitter">Twitter</a></li>
            <li class="text-xs mr-1 mb-1 rounded px-2 py-1 bg-gray-100 text-gray-800 uppercase"><a rel="me" href="https://github.com/{{ $page->links->github }}" title="@{{ $page->links->github }} on Github">Github</a></li>
            <li class="text-xs mr-1 mb-1 rounded px-2 py-1 bg-gray-100 text-gray-800 uppercase"><a rel="me" href="https://instagram.com/{{ $page->links->instagram }}" title="@{{ $page->links->instagram }} on Instagram">Instagram</a></li>
            <li class="text-xs mr-1 mb-1 rounded px-2 py-1 bg-gray-100 text-gray-800 uppercase"><a rel="me" href="https://{{ $page->links->redbubble }}.redbubble.com?asc=u" title="@{{ $page->links->redbubble }} on Redbubble">Redbubble</a></li>
        </ul>
    </body>
</html>
