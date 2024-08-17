<nav class="hidden lg:flex items-center justify-end text-lg">
    <a title="{{ $page->siteName }} Blog" href="/blog"
        class="ml-6 text-cream-light hover:text-indigo-600 {{ $page->isActive('/blog') ? 'active text-indigo-600' : '' }}">
        Blog
    </a>

    <a title="{{ $page->siteName }} About" href="/about"
        class="ml-6 text-cream-light hover:text-indigo-600 {{ $page->isActive('/about') ? 'active text-indigo-600' : '' }}">
        About
    </a>

    <a title="{{ $page->siteName }} Uses" href="/uses"
        class="ml-6 text-cream-light hover:text-indigo-600 {{ $page->isActive('/uses') ? 'active text-indigo-600' : '' }}">
        Uses
    </a>

    <a title="{{ $page->siteName }} Contact" href="/contact"
        class="ml-6 text-cream-light hover:text-indigo-600 {{ $page->isActive('/contact') ? 'active text-indigo-600' : '' }}">
        Contact
    </a>
</nav>
