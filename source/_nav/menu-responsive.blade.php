<nav id="js-nav-menu" class="w-auto px-2 pt-6 pb-2 bg-gray-200 shadow hidden lg:hidden">
    <ul class="my-0">
        <li class="pl-4">
            <a
                title="{{ $page->siteName }} Blog"
                href="/blog/"
                class="block mt-0 mb-4 text-sm no-underline {{ $page->isActive('/blog') ? 'active text-indigo-500' : 'text-gray-800 hover:text-indigo-500' }}"
            >Blog</a>
        </li>
        <li class="pl-4">
            <a
                title="{{ $page->siteName }} About"
                href="/about/"
                class="block mt-0 mb-4 text-sm no-underline {{ $page->isActive('/about') ? 'active text-indigo-500' : 'text-gray-800 hover:text-indigo-500' }}"
            >About</a>
        </li>
        <li class="pl-4">
            <a
                title="{{ $page->siteName }} Uses"
                href="/uses/"
                class="block mt-0 mb-4 text-sm no-underline {{ $page->isActive('/uses') ? 'active text-indigo' : 'text-gray-800 hover:text-indigo-500' }}"
            >Uses</a>
        </li>
        <li class="pl-4">
            <a
                title="{{ $page->siteName }} Contact"
                href="/contact/"
                class="block mt-0 mb-4 text-sm no-underline {{ $page->isActive('/contact') ? 'active text-indigo-500' : 'text-gray-800 hover:text-indigo-500' }}"
            >Contact</a>
        </li>
    </ul>
</nav>
