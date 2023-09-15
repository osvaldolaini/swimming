<div class="flex flex-col h-full mt-0 sm:mt-4 sm:ml-3">
    <!-- Navigation Rail -->
    <div class="relative h-screen lg:block w-64 pb-3 ">
        <div class="h-full bg-white rounded-2xl dark:bg-gray-700 py-2">
            <nav class="mt-5">
                <div>
                    <a href="{{ route('admDashboard') }}"
                    class="flex items-center justify-start w-full px-4 py-2 my-1
                    font-thin uppercase transition-colors duration-200
                    {{ Request::is('*dashboard') ? 'bg-gradient-to-r from-white to-blue-100
                    dark:from-gray-700 dark:to-gray-800 text-blue-500 border-r-4 border-blue-500' :
                    'dark:text-gray-200 hover:text-blue-500 text-gray-500' }}" >
                        <span class="text-left">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 2048 1792" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1070 1178l306-564h-654l-306 564h654zm722-282q0 182-71 348t-191 286-286 191-348 71-348-71-286-191-191-286-71-348 71-348 191-286 286-191 348-71 348 71 286 191 191 286 71 348z">
                                </path>
                            </svg>
                        </span>
                        <span class="mx-4 text-sm font-normal">
                            Dashboard
                        </span>
                    </a>
                    <a href="{{ route('admConfigTeam') }}"
                    class="flex items-center justify-start w-full px-4 py-2 my-1
                    font-thin uppercase transition-colors duration-200
                    {{ Request::is('*clubes*') ? 'bg-gradient-to-r from-white to-blue-100
                    dark:from-gray-700 dark:to-gray-800 text-blue-500 border-r-4 border-blue-500' :
                    'dark:text-gray-200 hover:text-blue-500 text-gray-500' }}" >
                        <span class="text-left">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M1 3.5A1.5 1.5 0 012.5 2h15A1.5 1.5 0 0119 3.5v2A1.5 1.5 0 0117.5 7h-15A1.5 1.5 0 011 5.5v-2zm3.5 1a1 1 0 11-2 0 1 1 0 012 0zM1 9.5A1.5 1.5 0 012.5 8h6.073a1.5 1.5 0 011.342 2.17l-1 2a1.5 1.5 0 01-1.342.83H2.5A1.5 1.5 0 011 11.5v-2zm3.5 1a1 1 0 11-2 0 1 1 0 012 0zM1 15.5A1.5 1.5 0 012.5 14h5.27a1.5 1.5 0 011.471 1.206l.4 2A1.5 1.5 0 018.171 19H2.5A1.5 1.5 0 011 17.5v-2zm3.5 1a1 1 0 11-2 0 1 1 0 012 0zM12.159 13.059l-.682-.429a.987.987 0 01-.452-.611.946.946 0 01.134-.742.983.983 0 01.639-.425 1.023 1.023 0 01.758.15l.682.427c.369-.31.8-.54 1.267-.676V9.97c0-.258.104-.504.291-.686.187-.182.44-.284.704-.284.264 0 .517.102.704.284a.957.957 0 01.291.686v.783c.472.138.903.37 1.267.676l.682-.429a1.02 1.02 0 01.735-.107c.25.058.467.208.606.419.14.21.19.465.141.71a.97.97 0 01-.403.608l-.682.429a3.296 3.296 0 010 1.882l.682.43a.987.987 0 01.452.611.946.946 0 01-.134.742.982.982 0 01-.639.425 1.02 1.02 0 01-.758-.15l-.682-.428c-.369.31-.8.54-1.267.676v.783a.957.957 0 01-.291.686A1.01 1.01 0 0115.5 19a1.01 1.01 0 01-.704-.284.957.957 0 01-.291-.686v-.783a3.503 3.503 0 01-1.267-.676l-.682.429a1.02 1.02 0 01-.75.132.999.999 0 01-.627-.421.949.949 0 01-.135-.73.97.97 0 01.434-.61l.68-.43a3.296 3.296 0 010-1.882zm3.341-.507c-.82 0-1.487.65-1.487 1.449s.667 1.448 1.487 1.448c.82 0 1.487-.65 1.487-1.448 0-.8-.667-1.45-1.487-1.45z" /></svg>
                        </span>
                        <span class="mx-4 text-sm font-normal">
                            Clubes
                        </span>
                    </a>
                    <a href="{{ route('admTeamsList') }}"
                        class="flex items-center justify-start w-full px-4 py-2 my-1
                        font-thin uppercase transition-colors duration-200
                        {{ Request::is('*atletas*') ? 'bg-gradient-to-r from-white to-blue-100
                        dark:from-gray-700 dark:to-gray-800 text-blue-500 border-r-4 border-blue-500' :
                        'dark:text-gray-200 hover:text-blue-500 text-gray-500'}}"
                        >
                        <span class="text-left">
                            <svg class="w-6 h-6" fill="currentColor" version="1.1" id="Capa_1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                viewBox="0 0 554.653 554.653" xml:space="preserve">
                                <g>
                                    <g>
                                        <path
                                            d="M533.176,405.093l-56.505,41.76c-3.385,2.505-10.471,2.716-14.009,0.363l-49.515-32.646
                                                c-12.737-8.415-32.025-8.511-44.811-0.182l-50.71,32.904c-3.892,2.506-11.81,2.562-15.729,0.096l-52.699-33.277
                                                c-13.148-8.281-32.417-7.487-44.839,1.854l-40.927,30.83c-3.385,2.562-10.414,2.802-13.971,0.487l-50.701-32.876
                                                c-13.339-8.673-32.618-7.516-44.829,2.678L4.848,458.021c-5.718,4.762-6.483,13.253-1.731,18.972
                                                c2.678,3.193,6.512,4.848,10.366,4.848c3.041,0,6.11-1.032,8.616-3.127l49.094-40.937c3.107-2.61,9.476-2.983,12.89-0.774
                                                l50.71,32.895c13.11,8.521,32.397,7.822,44.848-1.568l40.937-30.829c3.414-2.592,10.595-2.897,14.219-0.593l52.709,33.277
                                                c12.804,8.08,32.053,7.966,44.781-0.277l50.7-32.904c3.825-2.468,11.522-2.429,15.31,0.076l49.505,32.637
                                                c13.024,8.616,32.34,8.109,44.887-1.166l56.504-41.77c5.986-4.428,7.239-12.871,2.821-18.848
                                                C547.605,401.918,539.162,400.655,533.176,405.093z" />
                                        <path
                                            d="M164.972,249.225c-19.747,0-35.869,16.007-35.869,35.802c0,19.852,16.123,35.974,35.869,35.974
                                                c19.794,0,35.907-16.122,35.907-35.974C200.879,265.232,184.766,249.225,164.972,249.225z" />
                                        <path
                                            d="M199.339,365.963c6.436,4.953,17.939,4.332,25.704-1.396l14.038-10.346l119.426-82.658
                                                c5.432-2.974,9.878-7.43,12.814-12.804l87.123-148.276c6.895-11.991,2.764-27.339-9.228-34.348
                                                c-12.097-6.895-27.454-2.707-34.349,9.342l-72.693,123.749l-106.986,64.881c-5.316,2.936-19.584,20.072-27.339,31.748
                                                c-7.287,10.978-13.684,27.521-15.989,35.916C189.557,350.194,192.904,361.02,199.339,365.963z" />
                                    </g>
                                </g>
                            </svg>
                        </span>
                        <span class="mx-4 text-sm font-normal">
                            Atletas
                        </span>
                    </a>
                    <a href="{{ route('admTeam') }}"
                        class="flex items-center justify-start w-full px-4 py-2 my-1
                        font-thin uppercase transition-colors duration-200
                        {{ Request::is('*times*') ? 'bg-gradient-to-r from-white to-blue-100
                        dark:from-gray-700 dark:to-gray-800 text-blue-500 border-r-4 border-blue-500' :
                        'dark:text-gray-200 hover:text-blue-500 text-gray-500'}}"
                        >
                        <span class="text-left">
                            <svg class="w-6 h-6 " fill="currentColor" version="1.1" id="_x32_"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            viewBox="0 0 512 512" xml:space="preserve">

                            <g>
                                <path fill="currentColor"
                                    d="M378.405,0H133.594C86.229,0,47.703,38.526,47.703,85.891v340.217c0,47.358,38.526,85.892,85.892,85.892
		                            h170.12h13.164l9.319-9.311L454.986,373.9l9.311-9.318v-13.18V85.891C464.297,38.526,425.771,0,378.405,0z M432.495,351.402h-83.71
		                            c-24.898,0-45.072,20.189-45.072,45.078v83.718h-170.12c-29.868,0-54.09-24.215-54.09-54.09V85.891
		                            c0-29.875,24.223-54.09,54.09-54.09h244.811c29.883,0,54.09,24.215,54.09,54.09V351.402z" />
                                <rect x="133.677" y="126.915" class="st0" width="30.684" height="29.282" />
                                <rect x="133.677" y="198.195" class="st0" width="30.684" height="29.276" />
                                <rect x="133.677" y="269.476" class="st0" width="30.684" height="29.276" />
                                <rect x="133.677" y="340.756" class="st0" width="30.684" height="29.275" />
                                <rect x="197.461" y="126.915" class="st0" width="180.87" height="29.282" />
                                <rect x="197.461" y="198.195" class="st0" width="180.87" height="29.276" />
                                <rect x="197.461" y="269.476" class="st0" width="180.87" height="29.276" />
                                <rect x="197.461" y="340.756" class="st0" width="74.339" height="29.275" />
                            </g>
                        </svg>
                        </span>
                        <span class="mx-4 text-sm font-normal">
                            Equipes
                        </span>
                    </a>
                    <a href="{{ route('admRelay') }}"
                        class="flex items-center justify-start w-full px-4 py-2 my-1
                        font-thin uppercase transition-colors duration-200
                        {{ Request::is('*revezamentos*') ? 'bg-gradient-to-r from-white to-blue-100
                        dark:from-gray-700 dark:to-gray-800 text-blue-500 border-r-4 border-blue-500' :
                        'dark:text-gray-200 hover:text-blue-500 text-gray-500'}}"
                        >
                        <span class="text-left">
                            <svg class="w-6 h-6 " fill="currentColor" version="1.1" id="_x32_"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            viewBox="0 0 512 512" xml:space="preserve">

                            <g>
                                <path fill="currentColor"
                                    d="M378.405,0H133.594C86.229,0,47.703,38.526,47.703,85.891v340.217c0,47.358,38.526,85.892,85.892,85.892
		                            h170.12h13.164l9.319-9.311L454.986,373.9l9.311-9.318v-13.18V85.891C464.297,38.526,425.771,0,378.405,0z M432.495,351.402h-83.71
		                            c-24.898,0-45.072,20.189-45.072,45.078v83.718h-170.12c-29.868,0-54.09-24.215-54.09-54.09V85.891
		                            c0-29.875,24.223-54.09,54.09-54.09h244.811c29.883,0,54.09,24.215,54.09,54.09V351.402z" />
                                <rect x="133.677" y="126.915" class="st0" width="30.684" height="29.282" />
                                <rect x="133.677" y="198.195" class="st0" width="30.684" height="29.276" />
                                <rect x="133.677" y="269.476" class="st0" width="30.684" height="29.276" />
                                <rect x="133.677" y="340.756" class="st0" width="30.684" height="29.275" />
                                <rect x="197.461" y="126.915" class="st0" width="180.87" height="29.282" />
                                <rect x="197.461" y="198.195" class="st0" width="180.87" height="29.276" />
                                <rect x="197.461" y="269.476" class="st0" width="180.87" height="29.276" />
                                <rect x="197.461" y="340.756" class="st0" width="74.339" height="29.275" />
                            </g>
                        </svg>
                        </span>
                        <span class="mx-4 text-sm font-normal">
                            Revezamentos
                        </span>
                    </a>
                    <a href="{{ route('admTimes') }}"
                        class="flex items-center justify-start w-full px-4 py-2 my-1
                        font-thin uppercase transition-colors duration-200
                        {{ Request::is('*tempos*') ? 'bg-gradient-to-r from-white to-blue-100
                        dark:from-gray-700 dark:to-gray-800 text-blue-500 border-r-4 border-blue-500' :
                        'dark:text-gray-200 hover:text-blue-500 text-gray-500'}}"
                        >
                        <span class="text-left">
                            <svg class="w-6 h-6 " viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g id="Calendar / Timer">
                                    <path id="Vector" stroke="currentColor"
                                        d="M12 13V9M21 6L19 4M10 2H14M12 21C7.58172 21 4 17.4183 4 13C4 8.58172 7.58172 5 12 5C16.4183 5 20 8.58172 20 13C20 17.4183 16.4183 21 12 21Z"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </g>
                            </svg>
                        </span>
                        <span class="mx-4 text-sm font-normal">
                            Tempos
                        </span>
                    </a>

                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <a href="{{ route('logout') }}"
                        class="flex items-center justify-start w-full px-4 py-2 my-1
                        font-thin uppercase transition-colors duration-200
                        {{ Request::is('profile*') ? 'bg-gradient-to-r from-white to-blue-100
                        dark:from-gray-700 dark:to-gray-800 text-blue-500 border-r-4 border-blue-500' :
                        'dark:text-gray-200 hover:text-blue-500 text-gray-500'}}
                        sm:hidden"
                        >
                        <span class="text-left">
                            <svg class="w-6 h-6 " viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14 7.63636L14 4.5C14 4.22386 13.7761 4 13.5 4L4.5 4C4.22386 4 4 4.22386 4 4.5L4 19.5C4 19.7761 4.22386 20 4.5 20L13.5 20C13.7761 20 14 19.7761 14 19.5L14 16.3636" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M10 12L21 12M21 12L18.0004 8.5M21 12L18 15.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <span class="mx-4 text-sm font-normal">
                            {{ __('Log Out') }}
                        </span>
                    </a>
                </form>
                </div>
            </nav>
        </div>
    </div>
</div>
