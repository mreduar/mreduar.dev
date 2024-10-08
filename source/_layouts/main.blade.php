<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="description" content="{{ $page->description ?? $page->siteDescription }}">

        <meta property="og:title" content="{{ $page->title ? $page->title . ' | ' : '' }}{{ $page->siteName }}" />
        <meta property="og:type" content="{{ $page->type ?? 'website' }}" />
        <meta property="og:url" content="{{ $page->getUrl() }}" />
        <meta property="og:description" content="{{ $page->description ?? $page->siteDescription }}" />

        <title>{{ $page->title ?  $page->title . ' | ' : '' }}{{ $page->title ? $page->siteName : $page->fullSiteName }}</title>

        <link rel="home" href="{{ $page->baseUrl }}">
        <link rel="icon" href="/favicon.ico">
        <link href="/blog/feed.atom" type="application/atom+xml" rel="alternate"
            title="{{ $page->siteName }} Atom Feed">

        @if ($page->production)
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-C0PD6RHNF0"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-C0PD6RHNF0');
        </script>
        @endif

        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,300i,400,400i,700,700i,800,800i"
            rel="stylesheet">
        <link rel="stylesheet" href="{{ mix('css/main.css', 'assets/build') }}">
    </head>

    <body id="body" class="flex flex-col justify-between min-h-screen bg-darker text-cream-light leading-normal font-sans">
        <nav class="flex items-center shadow bg-gradient-to-r from-blacked to-darker h-24 py-4"
            role="banner">
            <div class="container flex items-center max-w-8xl mx-auto px-4 lg:px-8">
                <div class="flex items-center">
                    <a href="/" title="{{ $page->siteName }} home" class="inline-flex items-center">
                        <img class="h-7 md:h-8 mr-3" src="/assets/img/logo.png" alt="{{ $page->siteName }} logo" />

                        <h1 class="text-lg md:text-2xl  font-semibold hover:text-indigo-600 my-0">{{ $page->siteName }}
                        </h1>
                    </a>
                </div>

                <div id="vue-search" class="flex flex-1 justify-end items-center">
                    @include('_components.search')

                    @include('_nav.menu')

                    @include('_nav.menu-toggle')
                </div>
            </div>
        </nav>

        @include('_nav.menu-responsive')

        @hasSection('header')
        <header class="text-center bg-gradient-to-r from-blacked to-darker pb-40 md:pb-24 pt-10"
            style="clip-path: polygon(50% 0%, 100% 0, 100% 65%, 50% 100%, 0 65%, 0 0);">
            @yield('header')
        </header>
        @endif

        <main role="main" class="flex-auto w-full py-16 px-6 container max-w-4xl mx-auto">
            @yield('body')
        </main>

        <footer class="bg-darker text-center text-sm mt-12 py-4" role="contentinfo">
            <ul class="flex flex-col md:flex-row justify-center list-none">
                <li class="md:mr-2">
                    &copy; <a href="/" title="MrEduar">MrEduar</a> {{ date('Y') }}.
                </li>

                <li class="md:mr-2">
                    Built with <a href="http://jigsaw.tighten.co" title="Jigsaw by Tighten">Jigsaw</a>
                    and <a href="https://tailwindcss.com" title="Tailwind CSS, a utility-first CSS framework">Tailwind
                        CSS</a>.
                </li>

                <li>
                    Code highlighting provided by <a href="https://torchlight.dev/" title="Jigsaw by Tighten">Torchlight</a>
                </li>
            </ul>
        </footer>

        <script src="{{ mix('js/main.js', 'assets/build') }}"></script>

        @stack('scripts')
    </body>

</html>
