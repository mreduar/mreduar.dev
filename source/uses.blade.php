---
title: Uses
description: This page contains a list of all the hardware I own and all the software I use.
---
@extends('_layouts.main')

@section('body')

    <section>
        <h2>
            Software, tools and more
        </h2>

        <div class="mt-10">
            <h3 class="text-xl">
                Programming & Technologies
            </h3>
            <ul class="list-none pl-5">
                <li><a href="https://laravel.com" target="_blank" rel="noopener noreferrer">Laravel</a> ❤
                <li><a href="https://www.php.net" target="_blank" rel="noopener noreferrer">PHP</a></li>
                </li>
                <li><a href="https://inertiajs.com/" target="_blank" rel="noopener noreferrer">Inertia JS</a></li>
                <li><a class="line-through" href="https://laravel-livewire.com" target="_blank" rel="noopener noreferrer">Livewire</a></li>
                <li><a href="https://www.mysql.com" target="_blank" rel="noopener noreferrer">MySQL</a></li>
                <li><a href="https://redis.io" target="_blank" rel="noopener noreferrer">Redis</a></li>
                <li>HTML5, CSS3, <span class="line-through">SASS</span>, <a href="https://tailwindcss.com/" target="_blank" rel="noopener noreferrer">Tailwind
                        CSS</a>, <a class="line-through" href="https://getbootstrap.com" target="_blank" rel="noopener noreferrer">Bootstrap
                        4</a>
                </li>
                <li>
                    JavaScript, <a href="https://vuejs.org/" target="_blank" rel="noopener noreferrer">VueJS</a>
                </li>
                <li>
                    <a href="https://getcomposer.org" target="_blank" rel="noopener noreferrer">Composer</a>
                    &
                    <a href="https://www.npmjs.com" target="_blank">npm</a>
                </li>
                <li><a href="https://pestphp.com/" target="_blank" rel="noopener noreferrer">PestPHP</a></li>
                <li><a href="https://phpunit.de" target="_blank" rel="noopener noreferrer">PHPUnit</a></li>
            </ul>
        </div>

        <div class="mt-10">
            <h3 class="text-xl">
                IDE/Editor & Terminal
            </h3>
            <ul class="list-none pl-5">
                <li>
                    <a href="https://code.visualstudio.com" target="_blank" rel="noopener noreferrer">
                        📝 VS Code
                    </a>
                    <span class="block">Pretty sure it's taken over as the king of IDE's.</span>
                    <ul class="list-none">
                        <li>
                            <a href="https://marketplace.visualstudio.com/items?itemName=Equinusocio.vsc-community-material-theme"
                                target="_blank" rel="noopener noreferrer">
                                Community Material Theme
                            </a>
                        </li>
                        <li>
                            Previously
                            <a class="line-through" href="https://www.sublimetext.com" target="_blank" rel="noopener noreferrer">
                                Sublime Text
                            </a>
                        </li>
                    </ul>
                    <img src="/assets/images/vscode.png" alt="VSCode" class="md:w-2/3 mx-auto my-3">
                    <details class="my-5 ml-8">
                        <summary class="cursor-pointer">
                            <span class="text-indigo-600 font-bold">
                                VS Code Extensions
                            </span>
                            <p class="m-0">Extensions I use to power up my productivity</p>
                        </summary>
                        <div>
                            <ul>
                                <li>
                                    <a href="https://marketplace.visualstudio.com/items?itemName=austenc.laravel-docs">Laravel Docs</a>
                                </li>
                                <li>
                                    <a href="https://marketplace.visualstudio.com/items?itemName=onecentlin.laravel5-snippets">Laravel Snippets</a>
                                </li>
                                <li>
                                    <a href="https://marketplace.visualstudio.com/items?itemName=ahinkle.laravel-model-snippets">Laravel Model Snippets</a>
                                </li>
                                <li>
                                    <a href="https://marketplace.visualstudio.com/items?itemName=onecentlin.laravel-blade">Laravel Blade Snippets</a>
                                </li>
                                <li>
                                    <a href="https://marketplace.visualstudio.com/items?itemName=codingyu.laravel-goto-view">Laravel goto view</a>
                                </li>
                                <li>
                                    <a href="https://marketplace.visualstudio.com/items?itemName=open-southeners.laravel-pint">Laravel Pint</a>
                                </li>
                                <li>
                                    <a href="https://marketplace.visualstudio.com/items?itemName=calebporzio.better-phpunit">Better PHPUnit</a>
                                </li>
                                <li>
                                    <a href="https://marketplace.visualstudio.com/items?itemName=m1guelpf.better-pest">Better Pest</a>
                                </li>
                                <li>
                                    <a href="https://marketplace.visualstudio.com/items?itemName=wongjn.php-sniffer">PHP Sniffer</a>
                                </li>
                                <li>
                                    <a href="https://marketplace.visualstudio.com/items?itemName=esbenp.prettier-vscode">Prettier</a>
                                </li>
                                <li>
                                    <a href="https://marketplace.visualstudio.com/items?itemName=dbaeumer.vscode-eslint">ESLint</a>
                                </li>
                                <li>
                                    <a href="https://marketplace.visualstudio.com/items?itemName=bradlc.vscode-tailwindcss">Tailwind CSS IntelliSense</a>
                                </li>
                                <li>
                                    <a href="https://marketplace.visualstudio.com/items?itemName=austenc.tailwind-docs">Tailwind Docs</a>
                                </li>
                                <li>
                                    <a href="https://marketplace.visualstudio.com/items?itemName=neilbrayfield.php-docblocker">PHP DocBlocker</a>
                                </li>
                                <li>
                                    <a href="https://marketplace.visualstudio.com/items?itemName=mikestead.dotenv">DotENV</a>
                                </li>
                                <li>
                                    <a href="https://marketplace.visualstudio.com/items?itemName=adpyke.codesnap">CodeSnap</a>
                                </li>
                                <li>
                                    <a href="https://marketplace.visualstudio.com/items?itemName=formulahendry.auto-rename-tag">Auto Rename Tag</a>
                                </li>
                                <li>
                                    <a href="https://marketplace.visualstudio.com/items?itemName=bmewburn.vscode-intelephense-client">PHP Intelephense</a>
                                </li>
                                <li>
                                    <a href="https://marketplace.visualstudio.com/items?itemName=GitHub.copilot">GitHub Copilot</a>
                                </li>
                                <li>
                                    <a href="https://marketplace.visualstudio.com/items?itemName=GitHub.copilot-chat">GitHub Copilot Chat</a>
                                </li>
                                <li>
                                    <a href="https://marketplace.visualstudio.com/items?itemName=Equinusocio.vsc-community-material-theme">Community Material Theme</a>
                                </li>
                                <li>
                                    <a href="https://marketplace.visualstudio.com/items?itemName=vscode-icons-team.vscode-icons">vscode-icons</a>
                                </li>
                                {{-- Bracket Select --}}
                                <li>
                                    <a href="https://marketplace.visualstudio.com/items?itemName=chunsen.bracket-select">Bracket Select</a>
                                </li>
                                {{-- Dev Containers --}}
                                <li>
                                    <a href="https://marketplace.visualstudio.com/items?itemName=ms-vscode-remote.remote-containers">Dev Containers</a>
                                </li>
                                {{-- CodeSnap --}}
                                <li>
                                    <a href="https://marketplace.visualstudio.com/items?itemName=adpyke.codesnap">CodeSnap</a>
                                </li>
                                {{-- GitLens --}}
                                <li>
                                    <a href="https://marketplace.visualstudio.com/items?itemName=eamodio.gitlens">GitLens</a>
                                </li>
                                {{-- Vue - Official --}}
                                <li>
                                    <a href="https://marketplace.visualstudio.com/items?itemName=Vue.volar">Vue - Official</a>
                                </li>
                                {{-- Vue 3 Support - All In One --}}
                                <li>
                                    <a href="https://marketplace.visualstudio.com/items?itemName=Wscats.vue">Vue 3 Support - All In One</a>
                                </li>
                            </ul>
                        </div>
                    </details>
                </li>
                <li>
                    <svg class="inline-block" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16"
                        height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M0 3a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2H2a2 2 0 01-2-2V3zm9.5 5.5h-3a.5.5 0 000 1h3a.5.5 0 000-1zm-6.354-.354L4.793 6.5 3.146 4.854a.5.5 0 11.708-.708l2 2a.5.5 0 010 .708l-2 2a.5.5 0 01-.708-.708z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <a href="https://github.com/microsoft/terminal" target="_blank" rel="noopener noreferrer">Windows
                        Terminal</a> + Bash:
                    <span>
                        A good, highly customizable console that includes many unix commands out of the box.
                    </span>
                    <img src="/assets/images/terminal.png" alt="Windows Terminal" class="md:w-2/3 mx-auto my-3">
                </li>
                <li>
                    <svg class="inline-block" stroke="currentColor" fill="currentColor" stroke-width="0"
                        viewBox="0 0 16 16" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M0 3a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2H2a2 2 0 01-2-2V3zm9.5 5.5h-3a.5.5 0 000 1h3a.5.5 0 000-1zm-6.354-.354L4.793 6.5 3.146 4.854a.5.5 0 11.708-.708l2 2a.5.5 0 010 .708l-2 2a.5.5 0 01-.708-.708z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <a href="https://tinkerwell.app/" target="_blank" rel="noopener noreferrer">Tinkerwell</a>
                    <span>It is a great tool for quickly testing ideas or isolating a method for debugging, all within the
                        context of a real application.</span>
                    <div class="overflow-hidden rounded-lg shadow-xl md:mx-24"
                        style="-webkit-mask-image: -webkit-gradient(linear, left 75%, left bottom, from(rgba(0,0,0,1)), to(rgba(0,0,0,0)))">
                        <video playsinline="" autoplay="" muted="" loop=""
                            class="max-w-130 md:max-w-full">
                            <source src="/assets/videos/tip-top-tinker-tool.mp4" type="video/mp4">
                        </video>
                    </div>
                </li>
            </ul>
        </div>

        <div class="mt-10">
            <h3 class="text-xl">
                Tools & Browsers
            </h3>
            <ul class="pl-5 list-none">
                <li>
                    <a href="https://tableplus.com/" target="_blank" rel="noopener noreferrer">💾 TablePlus</a>
                    <span>As my favorite database client, Database management made easy</span>
                    <img src="/assets/images/tableplus.webp" alt="TablePlus" class="md:w-2/3 mx-auto my-3">
                </li>
                <li>
                    <a href="https://www.google.com/chrome/" target="_blank" rel="noopener noreferrer">🌏 Chrome</a>
                    <span>My favorite browser for personal use and development/testing, but I'm also using <a href="https://www.microsoft.com/en-us/edge">Edge</a> occasionally especially with this AI hype</span>
                </li>
                <li>
                    <svg class="inline" width="18" height="18" viewBox="0 0 256 256"
                        xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMinYMin meet">
                        <path
                            d="M251.172 116.594L139.4 4.828c-6.433-6.437-16.873-6.437-23.314 0l-23.21 23.21 29.443 29.443c6.842-2.312 14.688-.761 20.142 4.693 5.48 5.489 7.02 13.402 4.652 20.266l28.375 28.376c6.865-2.365 14.786-.835 20.269 4.657 7.663 7.66 7.663 20.075 0 27.74-7.665 7.666-20.08 7.666-27.749 0-5.764-5.77-7.188-14.235-4.27-21.336l-26.462-26.462-.003 69.637a19.82 19.82 0 0 1 5.188 3.71c7.663 7.66 7.663 20.076 0 27.747-7.665 7.662-20.086 7.662-27.74 0-7.663-7.671-7.663-20.086 0-27.746a19.654 19.654 0 0 1 6.421-4.281V94.196a19.378 19.378 0 0 1-6.421-4.281c-5.806-5.798-7.202-14.317-4.227-21.446L81.47 39.442l-76.64 76.635c-6.44 6.443-6.44 16.884 0 23.322l111.774 111.768c6.435 6.438 16.873 6.438 23.316 0l111.251-111.249c6.438-6.44 6.438-16.887 0-23.324"
                            fill="#fff" />
                    </svg>
                    <a href="https://git-scm.com/" target="_blank" rel="noopener noreferrer">Git</a>
                    <span>Duh.</span>
                </li>
                <li class="line-through">
                    <a href="https://insomnia.rest" target="_blank" rel="noopener noreferrer">📬 Insomnia</a>
                    <span>My favorite API client to create, share, test and document APIs</span>
                </li>
                <li>
                    <svg class="inline" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="18" height="18" viewBox="0 0 64 64">
                        <path fill="#8d6c9f" d="M35.774,47.286c-0.433,0-0.831-0.282-0.959-0.718l-0.564-1.919c-0.156-0.53,0.146-1.086,0.677-1.241 c0.531-0.158,1.087,0.148,1.241,0.677l0.564,1.919c0.156,0.53-0.146,1.086-0.677,1.241C35.963,47.273,35.867,47.286,35.774,47.286z"></path><path fill="#8d6c9f" d="M30.779,47.938c-0.032,0-0.064-0.001-0.097-0.005c-0.55-0.053-0.952-0.541-0.899-1.091l0.191-1.991 c0.053-0.551,0.55-0.965,1.091-0.899c0.55,0.053,0.952,0.541,0.899,1.091l-0.191,1.991C31.724,47.551,31.289,47.938,30.779,47.938z"></path><path fill="#8d6c9f" d="M25.928,46.158c-0.206,0-0.414-0.063-0.592-0.195c-0.445-0.327-0.54-0.953-0.212-1.397l1.187-1.61 c0.326-0.445,0.955-0.54,1.397-0.212c0.445,0.327,0.54,0.953,0.212,1.397l-1.187,1.61C26.538,46.018,26.234,46.158,25.928,46.158z"></path><path fill="#8d6c9f" d="M22.799,42.033c-0.397,0-0.772-0.237-0.929-0.628c-0.206-0.513,0.044-1.095,0.557-1.301l1.856-0.743 c0.513-0.206,1.094,0.045,1.3,0.557c0.205,0.513-0.044,1.095-0.557,1.301l-1.857,0.743C23.049,42.011,22.923,42.033,22.799,42.033z"></path><path fill="#f9dd8f" d="M31.807,57c-9.731,0-19.583-6.088-19.583-17.725c0-1.838,0.224-3.503,0.625-5.005	c-0.318,0.66-0.869,1.134-1.651,1.414c-0.317,0.114-0.646,0.172-0.977,0.172c-1.258,0-2.401-0.846-2.844-2.105	c-0.696-1.98-0.677-7.472,2.332-13.776c2.814-5.896,7.563-10.145,13.734-12.285C24.762,7.231,26.008,7,27.146,7	c1.258,0,2.407,0.28,3.417,0.834c1.91,1.049,3.178,2.93,3.875,5.75c0.846,3.415,0.709,7.55,0.641,8.822	c0.008-0.022,0.015-0.046,0.022-0.069c0.809-2.519,2.452-7.099,3.666-9.39c0.952-1.796,2.438-2.907,4.184-3.131	c0.218-0.028,0.439-0.043,0.662-0.043c1.809,0,3.59,0.95,5.293,2.823c1.737,1.871,10.049,11.459,7.662,21.58	c-0.317,1.342-1.532,2.278-2.955,2.278c-0.282,0-0.563-0.038-0.836-0.114c-0.672-0.189-1.227-0.617-1.608-1.178	c1.256,2.13,1.888,4.264,1.888,6.393C53.057,50.11,41.432,57,31.807,57z M34.632,24.897c-0.682,1.892-2.36,3.607-6.515,3.754	c-3.935,0.14-9.79,3.084-9.79,10.624c0,7.601,6.781,11.577,13.479,11.577c6.474,0,15.146-4.597,15.146-9.297	c0-3.018-3.305-6.969-9.069-10.845l-0.251-0.128l-0.055-0.038C35.553,29.136,34.558,27.212,34.632,24.897z M43.912,16.411	c-0.956,2.121-2.556,5.673-3.271,7.901c-0.202,0.63-0.068,0.801,0.591,1.259c4.571,3.065,7.831,6.173,9.756,9.29	c-0.377-0.71-0.503-1.578-0.287-2.437c1.412-5.624-4.066-13.223-6.296-15.676c-0.201-0.222-0.358-0.344-0.46-0.405	C43.935,16.362,43.924,16.385,43.912,16.411z M27.14,13.143c-0.443,0-1.034,0.124-1.709,0.358	c-11.964,4.152-12.701,15.944-12.35,18.094c0.107,0.656,0.122,1.241,0.045,1.752c2.496-7.55,9.652-10.657,14.777-10.839	c1.142-0.04,1.383-0.221,1.393-0.229c0.096-0.935-0.122-4.559-0.778-7.209c-0.369-1.496-0.792-1.794-0.873-1.838	C27.582,13.198,27.437,13.143,27.14,13.143z"></path><path fill="#8d6c9f" d="M27.146,8c1.091,0,2.072,0.237,2.936,0.711c1.653,0.907,2.76,2.58,3.386,5.114	c0.79,3.194,0.694,7.072,0.611,8.58c-0.112,2.047-0.616,5.058-5.997,5.248c-4.323,0.153-10.755,3.374-10.755,11.623	c0,8.257,7.284,12.577,14.479,12.577c7.051,0,16.147-4.993,16.147-10.297c0-3.341-3.331-7.528-9.561-11.707l-0.244-0.126	c-3.047-2.118-2.731-5.098-2.095-7.08c0.85-2.651,2.461-7.082,3.598-9.226c0.794-1.501,2.011-2.427,3.427-2.607	c0.178-0.024,0.356-0.035,0.535-0.035c1.514,0,3.049,0.842,4.553,2.496c0.412,0.454,9.883,10.274,7.429,20.677	c-0.218,0.923-1.071,1.509-1.981,1.509c-0.189,0-0.379-0.025-0.568-0.078c-1.091-0.309-1.655-1.598-1.376-2.709	c1.538-6.128-4.15-13.979-6.525-16.593c-0.456-0.502-0.9-0.785-1.287-0.785c-0.342,0-0.638,0.221-0.858,0.708	c-1.008,2.238-2.584,5.741-3.311,8.007c-0.42,1.308,0.246,1.881,0.972,2.386c7.615,5.107,11.396,10.267,11.396,15.163	C52.057,49.557,40.979,56,31.806,56c-9.234,0-18.582-5.744-18.582-16.725c0-11.187,8.799-15.559,14.713-15.768	c1.847-0.065,2.231-0.481,2.312-1.07c0.149-1.08-0.073-4.821-0.762-7.607c-0.328-1.326-0.786-2.158-1.363-2.475	c-0.277-0.152-0.618-0.212-0.984-0.212c-0.669,0-1.425,0.201-2.037,0.414c-13.021,4.518-13.299,17.424-13.009,19.199	c0.28,1.713-0.166,2.604-1.233,2.987c-0.214,0.077-0.43,0.113-0.64,0.113c-0.838,0-1.597-0.575-1.9-1.438	c-0.622-1.769-0.57-7.018,2.291-13.013c2.696-5.649,7.246-9.72,13.159-11.771C24.99,8.211,26.117,8,27.146,8 M27.146,6	c-1.251,0-2.607,0.25-4.031,0.744c-6.429,2.231-11.377,6.657-14.309,12.8c-3.161,6.624-3.151,12.323-2.373,14.538	c0.583,1.66,2.105,2.775,3.787,2.775c0.39,0,0.777-0.059,1.152-0.176c-0.098,0.826-0.149,1.691-0.149,2.595	C11.224,51.568,21.578,58,31.806,58c10.289,0,22.25-7.183,22.25-16.445c0-1.373-0.24-2.743-0.718-4.109	c0.092,0.006,0.183,0.009,0.275,0.009c1.889,0,3.504-1.254,3.927-3.049c2.442-10.349-5.395-19.792-7.855-22.439l-0.039-0.043	c-1.901-2.091-3.93-3.151-6.033-3.151c-0.265,0-0.534,0.018-0.797,0.052c-2.07,0.264-3.825,1.562-4.932,3.655	c-0.585,1.104-1.264,2.714-1.904,4.377c-0.109-1.162-0.288-2.369-0.571-3.513c-0.768-3.106-2.195-5.195-4.365-6.386	C29.885,6.322,28.574,6,27.146,6L27.146,6z M14.178,28.933c0.463-3.913,2.56-11.357,11.58-14.487c0.547-0.19,1.044-0.3,1.368-0.303	c0.092,0.158,0.255,0.503,0.419,1.167c0.533,2.153,0.745,4.841,0.75,6.173c-0.118,0.01-0.26,0.019-0.429,0.025	C23.461,21.664,17.639,23.855,14.178,28.933L14.178,28.933z M41.598,24.603c0.571-1.773,1.731-4.442,2.653-6.505	c2.275,2.738,6.353,8.83,5.592,13.535c-1.991-2.326-4.683-4.63-8.069-6.901C41.7,24.68,41.642,24.637,41.598,24.603L41.598,24.603z M31.806,49.852c-6.201,0-12.479-3.633-12.479-10.577c0-7.366,5.773-9.516,8.825-9.624c2.593-0.092,4.557-0.779,5.884-2.054	c0.513,1.475,1.51,2.753,2.971,3.769l0.108,0.075l0.117,0.06l0.14,0.072c5.375,3.624,8.581,7.351,8.581,9.982	C45.954,45.277,38.153,49.852,31.806,49.852L31.806,49.852z"></path>
                    </svg>
                    <a href="https://navicat.com/en/products/navicat-premium" target="_blank" rel="noopener noreferrer">Navicat Premium</a>
                    <span>I especially use Navicat to have a mental model of the database, to see the relationships between tables and to see the data in a more visual way.</span>
                    <img src="/assets/images/navicat.png" alt="Navicat Premium" class="md:w-2/3 mx-auto my-3">
                </li>
            </ul>
        </div>

        <div class="mt-10">
            <h3 class="text-xl">
                Comunication
            </h3>
            <ul class="pl-5 list-none">
                <li>
                    <a href="https://meet.google.com/" target="_blank" rel="noopener noreferrer">📷 Google Meet</a>
                    <span>For team meetings.</span>
                </li>
                <li>
                    <a href="https://telegram.org" target="_blank" rel="noopener noreferrer">✉️ Telegram</a>
                    <span>For talking with friends and colleagues, in groups of developers and so on. Primary means of communication</span>
                </li>
                <li>
                    <a href="https://discord.com" target="_blank" rel="noopener noreferrer">🎙️ Discord</a>
                    <span>
                        for gaming.
                    </span>
                </li>
                <li>
                    <a href="https://messenger.com" target="_blank" rel="noopener noreferrer">💬 Messenger</a>
                    <span>
                        for family.
                    </span>
                </li>
            </ul>
        </div>

        <div class="mt-10">
            <h3 class="text-xl">
                Productivity & Others
            </h3>
            <ul class="pl-5 list-none">
                <li>
                    <a href="https://spotify.com/" target="_blank" rel="noopener noreferrer">🎵 Spotify</a>
                    <span>I listen to music every day to reach a state of maximum concentration.</span>
                </li>
                <li>
                    🗒 <a href="https://www.atlassian.com/software/jira" target="_blank"
                        rel="noopener noreferrer">Jira</a>
                    <span>To organize my work tasks with the whole team</span>
                </li>
                <li>
                    🗒 <a href="https://trello.com/" target="_blank" rel="noopener noreferrer">Trello</a>
                    <span>To create personal tasks and goals that I want to accomplish.</span>
                </li>
                <li>
                    <a href="https://github.com/microsoft/PowerToys">🔎 Microsoft PowerToys</a>
                    <span>It is a pack of tools that improve my productivity, it has tools like <a
                            href="https://www.alfredapp.com/">Alfred</a> for mac, and a color picker that I use very often
                        to select any color within my screen.</span>
                </li>
                <li>
                    <a href="https://www.figma.com" target="_blank" rel="noopener noreferrer">🎨 Figma</a>
                    <span>To view designs created by customers.</span>
                </li>
                <li>
                    <a href="https://flareapp.io/" target="_blank" rel="noopener noreferrer">🐛 Flare</a>
                    <span>Flare is specifically built for Laravel error tracking. Think of Ignition—your local error page—in
                        production. Track all your PHP and JavaScript errors in one place.</span>
                </li>
                <li class="line-through">
                    <a href="https://www.adobe.com/products/xd.html" target="_blank" rel="noopener noreferrer">🎨 Adobe XD</a>
                    <span>To view designs created by customers.</span>
                </li>
            </ul>
        </div>
    </section>

    <section>
        <h2>
            Hardware
        </h2>
        <img src="/assets/images/cpu.png" alt="MY PC" class="md:w-2/3 mx-auto my-3">
        <ul class="list-none">
            <li>
                CPU:
                <a href="https://ark.intel.com/content/www/en/en/ark/products/199271/intel-core-i5-10400-processor-12m-cache-up-to-4-30-ghz.html"
                    target="_blank">
                    Intel Core i5-10400
                </a>
            </li>
            <li>
                GPU:
                <a href="https://www.gigabyte.com/co/Graphics-Card/GV-R56XTGAMING-OC-6GD" target="_blank"> Gigabyte
                    Radeon RX 5600 XT GAMING OC 6G
                </a>
            </li>
            <li>
                RAM:
                <a href="https://www.corsair.com/lm/en/vengeance-rgb-pro-memory" target="_blank">
                    Corsair Vengeance RGB Pro DDR4 3600
                </a>
                32 GB (2 x 16 GB)
            </li>
            <li>
                CPU Cooler:
                <a href="https://nzxt.com/product/kraken-m22" target="_blank">Kraken M22 Liquid Cooler</a>
            </li>
            <li>
                Storage:
                <ul class="list-none">
                    <li>
                        <a href="https://shop.westerndigital.com/en-us/products/internal-drives/wd-blue-sn550-nvme-ssd#WDS250G2B0C"
                            target="_blank">
                            Western Digital Blue SN550 NVMe SSD
                        </a>
                        500GB
                    </li>
                    <li>
                        <a href="https://www.seagate.com/products/hard-drives/barracuda-hard-drive/" target="_blank">
                            Seagate BarraCuda Internal Hard Drive HDD
                        </a>
                        2TB
                    </li>
                </ul>
            </li>
            <li>
                Motherboard:
                <a href="https://www.msi.com/Motherboard/MPG-Z490-GAMING-PLUS" target="_blank">MSI MPG Z490 Gaming
                    Plus</a>
            </li>
            <li>
                PSU:
                <a href="https://www.gigabyte.com/ph/Power-Supply/GP-P750GM#kf" target="_blank">
                    EVGA SuperNOVA 650 GA, 80 Plus Gold, Fully Modular
                </a>
                650W
            </li>
            <li>
                Case:
                <a href="https://nzxt.com/product/h510" target="_blank">NZXT H510 Matte Black/Red</a>
            </li>
        </ul>
    </section>

    <section>
        <h2>
            Audio + Video + Peripherals
        </h2>
        <img src="/assets/images/setup.png" alt="Setup" class="md:w-2/3 mx-auto my-3">
        <ul class="list-none">
            <li>
                My system audio revolves around a <a
                    href="https://www.amazon.com/-/en/Genius-SW-G2-1-1250-0-138-reproductores/dp/B08143J5G6"
                    target="_blank">
                    Genius SW-G2.1 1250
                </a>
                home theater.
            </li>
            <li>
                I have an
                <a href="https://www.sceptre.com/Monitors/UltraWide/C305B-200UN-30-Curved-Monitor-product1134category12category95.html"
                    target="_blank">
                    Sceptre 30-inch Curved Gaming Monitor
                </a>
                Ultra Wide 200Hz, I usually split the screen in two or three depending on what I am doing.
            </li>
            <li>
                I also like to change headphones depending on the case, when I need more concentration I use the HP Gaming
                Headset H300.
            </li>
            <li>
                I write with a <a href="https://www.redragonzone.com/products/redragonk556">Redragon K556 RGB Mechanical
                    Gaming Keyboard</a> with which I feel very comfortable while programming or playing, because of its not
                so big size it allows me to have more space to move the mouse.
            </li>
            <li>
                To move the pointer I use a <a href="https://www2.razer.com/gaming-mice/razer-deathadder-elite">Razer
                    Deathadder Elite</a> with 16,000 dpi precision, so that I don't miss any of the few clicks I make with
                it while programming.
            </li>
            <li>
                Finally, to give a more RGB touch to my setup I have a <a
                    href="https://www2.razer.com/gaming-mouse-mats/razer-goliathus-chroma">Razer Goliathus Extended Chroma
                    Gaming Mouse Mat</a>.
                To position the keyboard and the mouse on the same mouse pad, I think it gives it a nice gaming touch as I
                like it.
            </li>
        </ul>
    </section>

@stop
