---
title: About
description: A little bit about me
---
@extends('_layouts.master')

@section('body')
    <h1>About</h1>

    <img src="/assets/images/me2.jpg"
        alt="About image"
        class="flex rounded-full h-64 w-64 bg-contain mx-auto md:float-right my-6 md:ml-10">

    <p class="mb-6">Hello! My name is Eduar Bastidas. I am a full-stack <code>PHP</code> developer.</p>

    <p class="mb-6">
        Computers caught my attention from a very early age, my parents forbade me to spend too much time in front of the PC, until I decided to take my university career related to computers, systems and programming. I'm a Systems Engineer, and I've been working in web development since I was in university. Since then it's been more than {{ \Carbon\Carbon::parse('2016-01-01')->diffForHumans() }} of which {{  \Carbon\Carbon::parse('2017-01-01')->diffForHumans() }} I have dedicated to specialize in technologies like Laravel and Vue.js, building APIs for all kinds of businesses and applications.
    </p>

    <p class="mb-6">
        My focus as a developer is web development, which I have been involved in since the beginning of 2017. My first projects were built with HTML, CSS, JavaScript, PHP and MySQL. Currently this is still the same, however I have also learned other technologies and frameworks such as Vue.js Livewire, Alphine.js, Tailwind CSS, and where I have more experience is Laravel. I also know other technologies such as Prestashop and a little Wordpress, I have developed simple applications with Electron and Node.js for personal and business projects.
    </p>

    <p class="mb-6">
        Currently I work at Blockshift Network, a Venezuelan company dedicated to Marketing, Web Consulting, Mobile Application Development and Websites at national and international level.
    </p>

    <p>
        When I'm not coding, you'll catch me playing video games with co-workers or friends. On weekends I like to relax as much as I can to start the work week with enough energy, every month I like to travel with friends on quick day trips.
    </p>
@endsection
