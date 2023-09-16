<div>
    <x-message-session></x-message-session>
    @if (Auth::user()->team)
        <div class="w-full p-2 grid grid-cols-1 gap-4 ">
            <div class="stats stats-vertical lg:stats-horizontal shadow">
                <a href="{{ route('teamsList') }}" class="cursor-pointer">
                    <div class="stat">
                        <div class="stat-figure text-primary">
                            <svg class="w-8 h-8" fill="currentColor" version="1.1" id="Capa_1"
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
                        </div>
                        <div class="stat-title">Atletas</div>
                        <div class="stat-value">{{ $this->athletes }}</div>
                        {{-- <div class="stat-desc">↘︎ 90 (14%)</div> --}}
                    </div>
                </a>
                <div class="stat">
                    <div class="stat-title">Coordenadores</div>
                    <div class="stat-value">{{ $this->head }}</div>
                </div>
                <div class="stat">
                    <div class="stat-title">Treinadores</div>
                    <div class="stat-value">{{ $this->coachs }}</div>
                </div>
                <a href="{{ route('times') }}" class="cursor-pointer">
                    <div class="stat">
                        <div class="stat-figure text-primary">
                            <svg class="w-6 h-6 " viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g id="Calendar / Timer">
                                    <path id="Vector" stroke="currentColor"
                                        d="M12 13V9M21 6L19 4M10 2H14M12 21C7.58172 21 4 17.4183 4 13C4 8.58172 7.58172 5 12 5C16.4183 5 20 8.58172 20 13C20 17.4183 16.4183 21 12 21Z"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </g>
                            </svg>
                        </div>
                        <div class="stat-title">Tempos</div>
                        <div class="stat-value">{{ $this->times }}</div>
                        {{-- <div class="stat-desc">↘︎ 90 (14%)</div> --}}
                    </div>
                </a>
            </div>
        </div>
    @else
        @if (Auth::user()->group->type == 2)
            <section class="dark:bg-gray-800 dark:text-gray-100">
                <div
                    class="container mx-auto flex flex-col items-center px-4 py-10 text-center md:py-24 md:px-10 lg:px-24 xl:max-w-3xl">
                    <h1 class="text-4xl font-bold leadi sm:text-5xl">Que bom que você
                        <span class="dark:text-violet-400">acreditou nesta</span> ideia
                    </h1>
                    <p class="px-8 mt-8 mb-12 text-lg">Vamos começar? Clique em Configurações para criar um
                        Clube/Associação!</p>
                    <div class="flex flex-wrap justify-center">
                        <a href="{{ route('configTeam') }}"
                            class="cursor-pointer px-8 py-3 m-2 text-lg font-semibold rounded bg-blue-400 text-gray-900">Configurações</a>
                    </div>
                </div>
            </section>
        @else
        @if (Auth::user()->group->coach_ok == 0)
            <section class="dark:bg-gray-800 dark:text-gray-100">
                <div
                    class="container mx-auto flex flex-col items-center px-4 py-10 text-center md:py-24 md:px-10 lg:px-24 xl:max-w-3xl">
                    <h1 class="text-4xl font-bold leadi sm:text-5xl">Entre em contato com o
                        <span class="dark:text-violet-400">Coordenador </span> da equipe
                    </h1>
                    <p class="px-8 mt-8 mb-12 text-lg">Aguarde o convite ser aceito para poder participar de uma equipe!</p>
                    <div class="w-full flex justify-center mx-auto ">
                        @livewire('search-team')
                    </div>
                </div>
            </section>
        @else
            <section class="dark:bg-gray-800 dark:text-gray-100">
                <div
                    class="container mx-auto flex flex-col items-center px-4 py-16 text-center md:py-32 md:px-10 lg:px-32 xl:max-w-3xl">
                    <h1 class="text-4xl font-bold leadi sm:text-5xl">Entre em contato com o
                        <span class="dark:text-violet-400">Coordenador </span> do(a)
                        <span class="text-white bg-blue-900 px-2">
                            {{ Auth::user()->group->team->nick }}
                        </span>
                    </h1>
                    <p class="px-8 mt-8 mb-12 text-lg">Aguarde o convite ser aceito para poder participar de uma equipe!</p>
                    {{-- <div class="flex flex-wrap justify-center">
                        <a href="{{ route('configTeam') }}"
                            class="cursor-pointer px-8 py-3 m-2 text-lg font-semibold rounded bg-blue-400 text-gray-900">Configurações</a>
                    </div> --}}
                </div>
            </section>
        @endif


        @endif

    @endif
</div>
