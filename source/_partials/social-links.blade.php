<ul class="fixed z-10 bottom-0 right-0 flex flex-col sm:flex-row flex-wrap mb-3 mr-3 opacity-75">
    <li class="cursor-pointer text-xs mr-1 mb-1 rounded px-2 py-1 bg-gray-100 text-gray-800 uppercase hover:bg-white hover:text-gray-900">
        <a rel="me" target="_blank" href="https://github.com/talvbansal/jigsaw-photo-stream" title="Fork on Github">Fork on Github</a>
    </li>
    @if($page->links->twitter)
        <li class="cursor-pointer text-xs mr-1 mb-1 rounded px-2 py-1 bg-gray-100 text-gray-800 uppercase hover:bg-white hover:text-gray-900">
            <a rel="me" target="_blank" href="https://twitter.com/{{ $page->links->twitter }}" title="{{ '@'.$page->links->twitter }} on Twitter">Twitter</a>
        </li>
    @endif
    @if($page->links->github)
        <li class="cursor-pointer text-xs mr-1 mb-1 rounded px-2 py-1 bg-gray-100 text-gray-800 uppercase hover:bg-white hover:text-gray-900">
            <a rel="me" target="_blank" href="https://github.com/{{ $page->links->github }}" title="{{ '@'.$page->links->github }} on Github">Github</a>
        </li>
    @endif
    @if($page->links->instagram)
        <li class="cursor-pointer text-xs mr-1 mb-1 rounded px-2 py-1 bg-gray-100 text-gray-800 uppercase hover:bg-white hover:text-gray-900">
            <a rel="me" target="_blank" href="https://instagram.com/{{ $page->links->instagram }}" title="{{ '@'.$page->links->instagram }} on Instagram">Instagram</a>
        </li>
    @endif
    @if($page->links->redbubble)
        <li class="cursor-pointer text-xs mr-1 mb-1 rounded px-2 py-1 bg-gray-100 text-gray-800 uppercase hover:bg-white hover:text-gray-900">
            <a rel="me" href="https://{{ $page->links->redbubble }}.redbubble.com?asc=u" title="{{ $page->links->redbubble }} on Redbubble">Redbubble</a>
        </li>
    @endif
</ul>
