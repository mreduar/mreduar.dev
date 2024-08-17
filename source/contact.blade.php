---
title: Contact
description: Get in touch with us
---
@extends('_layouts.main')

@section('body')
<h1>Contact</h1>

<p class="mb-8">
    If the social networks are not enough send me an email directly from here.
</p>

<form action="https://getform.io/f/f737847c-d09e-49c4-90fa-9452081fcab4" method="POST" class="mb-12">
    <input type="hidden" id="captchaResponse" name="g-recaptcha-response">
    <div class="flex flex-wrap mb-6 -mx-3">
        <div class="w-full md:w-1/2 mb-6 md:mb-0 px-3">
            <label class="block mb-2 text-sm font-semibold" for="contact-name">
                Name
            </label>

            <input type="text" id="contact-name" placeholder="Jane Doe" name="name"
                class="block w-full border shadow rounded-lg outline-none mb-2 px-4 py-3 text-black" required>
        </div>

        <div class="w-full px-3 md:w-1/2">
            <label class="block text-sm font-semibold mb-2" for="contact-email">
                Email Address
            </label>

            <input type="email" id="contact-email" placeholder="email@domain.com" name="email"
                class="block w-full border shadow rounded-lg outline-none mb-2 px-4 py-3 text-black" required>
        </div>
    </div>

    <div class="w-full mb-12">
        <label class="block text-sm font-semibold mb-2" for="contact-message">
            Message
        </label>

        <textarea id="contact-message" rows="4" name="message"
            class="block w-full border shadow rounded-lg outline-none appearance-none mb-2 px-4 py-3 text-black"
            placeholder="A lovely message here." required></textarea>
    </div>

    <div class="flex justify-end w-full">
        <button type="submit" class="block bg-indigo-900 hover:bg-indigo-800 text-white text-sm font-semibold leading-snug tracking-wide uppercase shadow rounded-lg cursor-pointer px-6 py-3">
            Submit
        </button>
    </div>
</form>
@stop

@push('scripts')
<script src="https://www.google.com/recaptcha/api.js?render=6Ld0cnYdAAAAAEd7ItFyjT4ohgNPy4ewNg30wjf7"></script>

<script>
    grecaptcha.ready(function() {
       grecaptcha.execute('6Ld0cnYdAAAAAEd7ItFyjT4ohgNPy4ewNg30wjf7', {action: 'contactform'})
       .then(function(token) {
         document.getElementById('captchaResponse').value = token;
       });
     });
</script>
@endpush
