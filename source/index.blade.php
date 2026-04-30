@extends('_layouts.main')

@section('header')
    <img src="/assets/images/me.jpg" alt="Eduar Bastidas" class="mx-auto rounded-full w-1/4 md:w-1/6 lg:w-1/12">
    <h1>Hey, I'm Eduar.</h1>
    <p class="b30 max-w-3xl mx-auto px-4">
        Full-stack Laravel developer with 7+ years building SaaS, APIs and custom web apps.
        <br class="hidden md:block">
        Currently at <a href="https://manyrequests.com" target="_blank" rel="noopener noreferrer" class="underline">ManyRequests</a>, helping agencies scale their operations.
    </p>

    <ul class="flex flex-wrap justify-center gap-x-6 gap-y-2 list-none my-6 text-sm md:text-base text-cream-light">
        <li><strong class="text-white">7+ years</strong> of experience</li>
        <li><strong class="text-white">Laravel · Vue.js · PHP</strong></li>
    </ul>

    <div class="justify-center flex py-3 text-white">
        <a href="https://twitter.com/mreduar" target="_blank" rel="noopener noreferrer" aria-label="Eduar Bastidas on Twitter">
            <img src="./assets/img/twitter.svg" alt="" class="hover:bg-indigo-800 mx-2 p-2 rounded-xl">
        </a>
        <a href="https://github.com/mreduar" target="_blank" rel="noopener noreferrer" aria-label="Eduar Bastidas on GitHub">
            <img src="./assets/img/github.svg" alt="" class="hover:bg-indigo-800 mx-2 p-2 rounded-xl">
        </a>
        <a href="https://www.linkedin.com/in/mreduar/" target="_blank" rel="noopener noreferrer" aria-label="Eduar Bastidas on LinkedIn">
            <img src="./assets/img/linkedin.svg" alt="" class="hover:bg-indigo-800 mx-2 p-2 rounded-xl">
        </a>
        <a href="https://www.instagram.com/mreduar/" target="_blank" rel="noopener noreferrer" aria-label="Eduar Bastidas on Instagram">
            <img src="./assets/img/instagram.svg" alt="" class="hover:bg-indigo-800 mx-2 p-2 rounded-xl">
        </a>
    </div>

    <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-3">
        <a href="/about" class="inline-block bg-indigo-900 hover:bg-indigo-800 text-white hover:text-white antialiased text-light-purple font-bold text-sm px-8 py-3 no-underline rounded-full leading-none hover:translateY-1px transition-1s">
            More about me
        </a>
    </div>
@endsection

@section('body')
    @foreach ($posts->where('featured', true) as $featuredPost)
        <div class="w-full mb-6">
            @if ($featuredPost->cover_image)
                <img src="{{ $featuredPost->cover_image }}" alt="{{ $featuredPost->title }} cover image" class="mb-6">
            @endif

            <p class="text-gray-700 font-medium my-2">
                {{ $featuredPost->getDate()->format('F j, Y') }}
            </p>

            <h2 class="text-3xl mt-0">
                <a href="{{ $featuredPost->getUrl() }}" title="Read {{ $featuredPost->title }}" class="font-extrabold">
                    {{ $featuredPost->title }}
                </a>
            </h2>

            <p class="mt-0 mb-4">{!! $featuredPost->getExcerpt() !!}</p>

            <a href="{{ $featuredPost->getUrl() }}" title="Read - {{ $featuredPost->title }}" class="uppercase tracking-wide mb-4">
                Read
            </a>
        </div>

        @if (! $loop->last)
            <hr class="border-b my-6">
        @endif
    @endforeach

    @include('_components.newsletter-signup')

    @foreach ($posts->where('featured', false)->take(6)->chunk(2) as $row)
        <div class="flex flex-col md:flex-row md:-mx-6">
            @foreach ($row as $post)
                <div class="w-full md:w-1/2 md:mx-6">
                    @include('_components.post-preview-inline')
                </div>

                @if (! $loop->last)
                    <hr class="block md:hidden w-full border-b mt-2 mb-6">
                @endif
            @endforeach
        </div>

        @if (! $loop->last)
            <hr class="w-full border-b mt-2 mb-6">
        @endif
    @endforeach
@stop
