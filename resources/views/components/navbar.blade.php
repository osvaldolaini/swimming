<div class="flex flex-col bg-blue-400 text-white h-full">
    <!-- Navigation Rail -->
    <div class="relative">
        <div class="w-54 bg-blue-400 text-white dark:bg-surfacedark-100 flex items-center flex-col gap-8 py-5">
            <div class="flex flex-col items-center gap-5 sm:gap-3">
                <a href="{{ route('teams') }}"
                    class=" group min-h-[56px] flex w-32
                flex-col items-center justify-center px-0 gap-1 py-1
                {{ Request::is('atletas*') ? 'text-blue-900 font-semibold' : 'text-white ' }} text-sm ">
                    <div
                        class="relative w-14 h-8 hover-icon group-hover:bg-secondary-100
                        dark:group-hover:bg-secondary-700 group-hover:bg-opacity-80
                        dark:group-hover:bg-opacity-80 flex items-center justify-center
                        rounded-2xl ">
                        <svg class="w-8 h-8 " fill="currentColor" version="1.1" id="Capa_1"
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
                    <p class="dark:text-neutral-100 tracking-[.0416em] leading-tight ">
                        Atletas
                    </p>
                </a>
                <div class="divider my-10 sm:my-0 hidden sm:flex"></div>
                {{-- <a href="{{ route('modality') }}" class="group min-h-[56px] flex w-32 flex-col items-center justify-center px-0 gap-1">
                    <div
                    class="relative w-14 h-8 hover-icon group-hover:bg-secondary-100
                    dark:group-hover:bg-secondary-700 group-hover:bg-opacity-80
                    dark:group-hover:bg-opacity-80 flex items-center justify-center
                    rounded-2xl text-white">
                    <svg class="w-8 h-8 " fill="currentColor" version="1.1"  id="_x32_" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512"
                            xml:space="preserve">

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
                    </div>
                    <p class="text-sm dark:text-neutral-100 tracking-[.0416em]
                    leading-tight">
                        Modalidades
                    </p>
                </a> --}}
                <a href="{{ route('category') }}"
                    class="group min-h-[56px] flex w-32 flex-col items-center justify-center
                    px-0 gap-1
                    {{ Request::is('categorias*') ? 'text-blue-900 font-semibold' : 'text-white  ' }} text-sm">
                    <div
                        class="relative w-14 h-8 hover-icon group-hover:bg-secondary-100
                    dark:group-hover:bg-secondary-700 group-hover:bg-opacity-80
                    dark:group-hover:bg-opacity-80 flex items-center justify-center
                    rounded-2xl ">
                        <svg class="w-8 h-8 " fill="currentColor" version="1.1" id="_x32_"
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
                    </div>
                    <p class=" dark:text-neutral-100 tracking-[.0416em] leading-tight">
                        Categorias
                    </p>
                </a>
                <div class="divider my-10 sm:my-0 hidden sm:flex"></div>
                <a href="{{ route('times') }}"
                    class="group min-h-[56px] flex w-32
                    flex-col items-center justify-center px-0 gap-1 py-1
                    {{ Request::is('tempos*') ? 'text-blue-900 font-semibold' : 'text-white ' }} text-sm ">
                    <div
                        class="relative w-14 h-8 hover-icon group-hover:bg-secondary-100
                    dark:group-hover:bg-secondary-700 group-hover:bg-opacity-80
                    dark:group-hover:bg-opacity-80 flex items-center justify-center
                    rounded-2xl ">
                        <svg class="w-8 h-8 " viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="Calendar / Timer">
                                <path id="Vector" stroke="currentColor"
                                    d="M12 13V9M21 6L19 4M10 2H14M12 21C7.58172 21 4 17.4183 4 13C4 8.58172 7.58172 5 12 5C16.4183 5 20 8.58172 20 13C20 17.4183 16.4183 21 12 21Z"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </g>
                        </svg>
                    </div>
                    <p class="dark:text-neutral-100 tracking-[.0416em]
                    leading-tight">
                        Tempos
                    </p>
                </a>
                <div class="divider my-10 sm:my-0 hidden sm:flex"></div>
                <a href="{{ route('generateTeam') }}"
                    class=" group min-h-[56px] flex w-32
                    flex-col items-center justify-center px-0 gap-1 py-1
                    {{ Request::is('*equipe*') ? 'text-blue-900 font-semibold' : 'text-white ' }} text-sm ">
                    <div
                        class="relative w-14 h-8 hover-icon group-hover:bg-secondary-100
                    dark:group-hover:bg-secondary-700 group-hover:bg-opacity-80
                    dark:group-hover:bg-opacity-80 flex items-center justify-center
                    rounded-2xl ">
                        <svg class="w-8 h-8 " fill="currentColor" version="1.1" id="Capa_1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            viewBox="0 0 155.739 155.739" xml:space="preserve">
                            <g>
                                <g>
                                    <path
                                        d="M93.192,25.738c8.326,0,15.073,6.752,15.073,15.081c0,8.325-6.747,15.078-15.073,15.078
                                        c-8.33,0-15.079-6.753-15.079-15.078C78.113,32.49,84.862,25.738,93.192,25.738z" />
                                    <path
                                        d="M101.102,73.074c5.354,0,9.692,4.339,9.692,9.691c0,5.356-4.338,9.697-9.692,9.697c-5.356,0-9.693-4.341-9.693-9.697
                                        C91.409,77.413,95.746,73.074,101.102,73.074z" />
                                    <path
                                        d="M52.781,155.739h86.949c0,0-25.232-20.279-24.701-42.513c0.317-12.388,24.701-28.158,24.58-62.58
                                        c-0.076-17.311-16.865-46.088-45.371-49.675C65.724-2.62,44.386,3.656,35.062,21.235c-9.335,17.57-10.042,32.999-9.325,35.861
                                        c0.726,2.876,3.769,8.255,3.769,8.255S15.16,87.405,16.049,90.988c0.908,3.596,10.748,5.527,10.748,5.527s0.892,2.497-0.906,7.335
                                        c-1.795,4.846,3.338,10.468,4.88,12.43c1.519,1.954-2.158,8.062-0.908,11.476c1.253,3.398,7.176,7.523,13.986,6.632
                                        c6.819-0.902,15.566-2.504,18.604-3.054C69.312,147.479,52.781,155.739,52.781,155.739z M117.141,90.021l-2.947,4.525
                                        l-2.867-1.883c-1.315,1.353-2.919,2.452-4.714,3.207l0.708,3.371l-5.276,1.1l-0.706-3.364c-1.97,0.032-3.864-0.335-5.602-1.051
                                        l-1.883,2.872l-4.527-2.955l1.877-2.872c-1.346-1.312-2.451-2.912-3.199-4.706l-3.376,0.705l-1.11-5.285l3.38-0.701
                                        c-0.027-1.952,0.333-3.852,1.045-5.598l-2.871-1.882l2.952-4.522l2.876,1.879c1.312-1.36,2.908-2.458,4.711-3.212l-0.708-3.368
                                        l5.28-1.111l0.708,3.374c1.952-0.033,3.853,0.338,5.599,1.048l1.882-2.875l4.52,2.949l-1.878,2.878
                                        c1.351,1.313,2.456,2.905,3.208,4.711l3.357-0.7l1.111,5.28l-3.365,0.7c0.032,1.958-0.338,3.857-1.051,5.604L117.141,90.021z
                                        M67.762,30.636l5.218,1.207c1.188-2.685,2.925-5.145,5.157-7.213L75.3,20.086l7.115-4.449l2.84,4.545
                                        c2.835-1.095,5.807-1.581,8.739-1.475l1.2-5.204l8.189,1.883l-1.204,5.203c2.682,1.196,5.128,2.931,7.204,5.158l4.539-2.838
                                        l4.454,7.122l-4.547,2.829c1.097,2.837,1.576,5.811,1.479,8.741l5.202,1.207l-1.888,8.181l-5.215-1.207
                                        c-1.182,2.679-2.917,5.146-5.149,7.212l2.842,4.54l-7.124,4.448l-2.831-4.539c-2.846,1.1-5.817,1.587-8.748,1.475l-1.206,5.204
                                        l-8.178-1.888l1.195-5.204c-2.676-1.186-5.135-2.925-7.194-5.155l-4.55,2.841l-4.45-7.122l4.55-2.834
                                        c-1.1-2.843-1.581-5.806-1.48-8.736l-5.211-1.204L67.762,30.636z" />
                                </g>
                            </g>
                        </svg>
                    </div>
                    <p class="dark:text-neutral-100 tracking-[.0416em] leading-tight">
                        Gerar equipes
                    </p>
                </a>

                <div class="divider my-5 sm:my-0 flex sm:hidden">
                    <!-- Authentication -->
                    <a href="{{ route('profile.show') }}"
                        class=" group min-h-[56px] flex w-32
                        flex-col items-center justify-center px-0 gap-1 py-1
                        {{ Request::is('profile*') ? 'text-blue-900 font-semibold' : 'text-white ' }} text-sm ">
                        <div
                            class="relative w-14 h-8 hover-icon group-hover:bg-secondary-100
                            dark:group-hover:bg-secondary-700 group-hover:bg-opacity-80
                            dark:group-hover:bg-opacity-80 flex items-center justify-center
                            rounded-2xl ">
                            <svg class="w-8 h-8 " viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="User / User_Circle">
                                    <path id="Vector"
                                        d="M17.2166 19.3323C15.9349 17.9008 14.0727 17 12 17C9.92734 17 8.06492 17.9008 6.7832 19.3323M12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12C21 16.9706 16.9706 21 12 21ZM12 14C10.3431 14 9 12.6569 9 11C9 9.34315 10.3431 8 12 8C13.6569 8 15 9.34315 15 11C15 12.6569 13.6569 14 12 14Z"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </g>
                            </svg>
                        </div>
                        <p class="dark:text-neutral-100 tracking-[.0416em] leading-tight">
                            {{ __('Profile') }}
                        </p>
                    </a>

                </div>
                <div class="divider my-5 sm:my-0 flex sm:hidden">
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <a href="{{ route('logout') }}"
                            class=" group min-h-[56px] flex w-32
                            flex-col items-center justify-center px-0 gap-1 py-1
                            text-white text-sm ">
                            <div
                            class="relative w-14 h-8 hover-icon group-hover:bg-secondary-100
                            dark:group-hover:bg-secondary-700 group-hover:bg-opacity-80
                            dark:group-hover:bg-opacity-80 flex items-center justify-center
                            rounded-2xl ">
                            <svg class="w-8 h-8 " viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14 7.63636L14 4.5C14 4.22386 13.7761 4 13.5 4L4.5 4C4.22386 4 4 4.22386 4 4.5L4 19.5C4 19.7761 4.22386 20 4.5 20L13.5 20C13.7761 20 14 19.7761 14 19.5L14 16.3636" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M10 12L21 12M21 12L18.0004 8.5M21 12L18 15.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                            <p class="dark:text-neutral-100 tracking-[.0416em] leading-tight">
                                {{ __('Log Out') }}
                            </p>
                        </a>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
