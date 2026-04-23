---
title: About
description: Full-stack Laravel developer with 7+ years building SaaS, APIs and custom web apps.
---
@extends('_layouts.main')

@section('body')
    <h1 class="text-3xl">About</h1>

    <img src="/assets/images/me2.jpg"
        alt="Eduar Bastidas"
        class="flex rounded-full h-64 w-64 bg-contain mx-auto md:float-right my-6 md:ml-10">

    <p class="mb-4">
        Hello! I'm <strong>Eduar Bastidas</strong>, a full-stack PHP developer based in Venezuela.
    </p>

    <p class="mb-6">
        I specialize in <strong>Laravel</strong>, <strong>Vue.js</strong> and <strong>Inertia.js</strong>,
        building SaaS products, REST APIs and tailored web applications. I've been shipping for
        the web since 2017, with a focus on writing scalable, maintainable code that follows the
        best practices of the Laravel and PHP community.
    </p>

    <h2 class="text-2xl">Experience</h2>

    <div class="mb-6">
        <h3 class="text-lg mb-1">Software Development Engineer — <a href="https://manyrequests.com" target="_blank" rel="noopener noreferrer">ManyRequests</a></h3>
        <p class="text-sm text-gray-400 mt-0 mb-2">Mar 2022 – Present · Remote</p>
        <ul class="list-disc pl-6">
            <li>Led the rewrite from v1 (legacy, tightly-coupled codebase) to v2, authoring roughly <strong>90% of the current application code</strong>.</li>
            <li>Architected the new version following Laravel and PHP community best practices, prioritizing scalability, readability and long-term maintainability.</li>
            <li>Stack: Laravel, Vue.js, Inertia.js, Tailwind CSS, MySQL.</li>
        </ul>
    </div>

    <div class="mb-6">
        <h3 class="text-lg mb-1">Full-stack Developer — <a href="https://blockshift.us/" target="_blank" rel="noopener noreferrer">Blockshift</a></h3>
        <p class="text-sm text-gray-400 mt-0 mb-2">Sep 2019 – Mar 2022 · 2 yrs 7 mos · On-site, then remote from 2020 (COVID)</p>
        <ul class="list-disc pl-6">
            <li>Worked at a software agency juggling <strong>3–5 custom client projects in parallel</strong> at any given time, owning each from scoping to deployment.</li>
            <li>Built tailored applications with Laravel and Vue.js, and extended WordPress and Prestashop storefronts for e-commerce clients.</li>
            <li>Shipped a high volume of projects over 2.5+ years, adapting to each client's domain and shifting requirements.</li>
        </ul>
    </div>

    <div class="mb-6">
        <h3 class="text-lg mb-1">PHP Web Developer — Jak Ideas &amp; Soluciones</h3>
        <p class="text-sm text-gray-400 mt-0 mb-2">Dec 2018 – Jul 2019 · 8 mos</p>
        <ul class="list-disc pl-6">
            <li>Same agency-style workflow: <strong>3–5 custom client websites in parallel</strong>, built with Laravel and Blade across the full stack (backend, frontend, deployment).</li>
            <li>Translated client requirements into production-ready features, adapting quickly to each project's domain.</li>
        </ul>
    </div>

    <h2 class="text-2xl">Education</h2>

    <p class="mb-6">
        <strong>Systems Engineering</strong> — UNEFA (Universidad Nacional Experimental Politécnica
        de la Fuerza Armada Nacional), 2011 – 2017.
    </p>

    <h2 class="text-2xl">Tools &amp; stack</h2>

    <p class="mb-6">
        For the full list of tools, editor setup, hardware and what I use day-to-day, check out
        the <a href="/uses">Uses</a> page.
    </p>

    <h2 class="text-2xl">Beyond code</h2>

    <p>
        When I'm not coding, I'm usually playing video games with co-workers and friends, or
        planning the next weekend day trip. I like to protect my weekends so I can start each
        work week with full energy.
    </p>
@endsection
