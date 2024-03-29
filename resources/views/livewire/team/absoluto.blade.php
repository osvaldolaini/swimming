<div>
    <x-header>{{ mb_strtoupper($titles) }}</x-header>
    <section class="px-1.5 pb-1 dark:bg-gray-800 dark:text-gray-50">
        @isset($message)
            <div class="w-full text-white bg-blue-500 rounded-md">
                <div class="container flex items-center justify-between px-3 py-2 mx-auto">
                    <div class="flex">
                        <svg viewBox="0 0 40 40" class="w-6 h-6 fill-current">
                            <path
                                d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z">
                            </path>
                        </svg>

                        <p class="mx-3"> {{ $message }}</p>
                    </div>
                    {{--
                <button class="p-1 transition-colors duration-300 transform rounded-md hover:bg-opacity-25 hover:bg-gray-600 focus:outline-none">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 18L18 6M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button> --}}
                </div>
            </div>
        @endisset
        <div
            class="container flex flex-col mx-auto space-y-4 sm:space-y-8
        ng-untouched ng-pristine ng-valid relative">
        <x-action-loading-generate></x-action-loading-generate>
            <fieldset
                class="grid grid-cols-4 sm:gap-4 sm:gap-6 px-6 pt-2 pb-10 sm:py-2 px-6 rounded-md shadow-sm dark:bg-gray-900">
                <div class="space-y-2 col-span-full lg:col-span-1">
                    <p class="font-medium">Monte a(s) equipe(s)</p>
                    <p class="text-xs">Informe os dados necessários para formar a(s) equipe(s).</p>
                    <form wire:submit.prevent="generateTeams()">
                        <div class="col-span-full sm:col-span-3 mt-0">
                            <button type="submit" wire:loading.remove
                                class="animate-pulse flex justify-center px-8 py-2 font-semibold text-gray-50
                                rounded-full bg-blue-600 dark:bg-blue-800
                                transform hover:scale-x-110 hover:scale-y-105 transition
                                duration-300 ease-out w-full mx-auto text-center itens-center ">

                                <span class="px-2 ">Gerar equipe(s) </span>
                                <svg fill="currentColor" class="w-6 h-6 " viewBox="0 -3.19 54.13 54.13" id="Layer_1"
                                    data-name="Layer 1" xmlns="http://www.w3.org/2000/svg">
                                    <title>cogs</title>
                                    <path
                                        d="M59.77,37.11l-.41-1c1.4-3.17,1.31-3.27,1-3.54l-1.79-1.75-.18-.15h-.21c-.11,0-.44,0-3.16,1.23l-1-.4c-1.3-3.21-1.43-3.21-1.81-3.21H49.72c-.38,0-.52,0-1.73,3.22l-1,.4a17.37,17.37,0,0,0-3.21-1.17h-.24l-1.93,1.89c-.29.28-.39.37,1.09,3.49l-.41,1C39,38.4,39,38.52,39,38.91v2.48c0,.39,0,.52,3.29,1.7l.41,1c-1.4,3.17-1.31,3.26-1,3.54l1.8,1.75.17.15h.21c.11,0,.43,0,3.16-1.24l1,.41c1.3,3.21,1.43,3.21,1.81,3.21h2.53c.38,0,.52,0,1.73-3.22l1-.41a17,17,0,0,0,3.2,1.18h.24l1.95-1.9c.27-.28.37-.38-1.11-3.49l.41-1c3.29-1.27,3.29-1.41,3.29-1.79V38.81C63.07,38.42,63.07,38.28,59.77,37.11ZM51,44.22a4.12,4.12,0,1,1,4.2-4.12A4.16,4.16,0,0,1,51,44.22Z"
                                        transform="translate(-8.93 -4.12)" />
                                    <path
                                        d="M36,22.79l-.53-1.27c1.83-4.14,1.71-4.26,1.35-4.62l-2.34-2.29-.23-.19H34c-.14,0-.57,0-4.13,1.61l-1.31-.53c-1.69-4.19-1.86-4.19-2.36-4.19h-3.3c-.49,0-.68,0-2.25,4.21l-1.31.53a21.5,21.5,0,0,0-4.19-1.53h-.31L12.33,17c-.38.36-.51.49,1.42,4.57l-.53,1.26c-4.29,1.66-4.29,1.82-4.29,2.32v3.24c0,.51,0,.69,4.3,2.23l.54,1.26c-1.83,4.13-1.71,4.26-1.36,4.61l2.34,2.29L15,39h.27c.14,0,.56,0,4.12-1.61l1.31.53c1.69,4.19,1.86,4.19,2.36,4.19h3.3c.51,0,.69,0,2.26-4.21l1.31-.53a21.5,21.5,0,0,0,4.19,1.53h.31L37,36.38c.36-.36.48-.49-1.44-4.55l.53-1.26c4.29-1.66,4.29-1.83,4.29-2.33V25C40.34,24.5,40.34,24.32,36,22.79ZM24.64,32.08a5.39,5.39,0,1,1,5.48-5.39A5.46,5.46,0,0,1,24.64,32.08Z"
                                        transform="translate(-8.93 -4.12)" />
                                    <path
                                        d="M58,11.62l-.35-.83c1.2-2.71,1.12-2.79.89-3L57,6.28l-.15-.13h-.18A9.91,9.91,0,0,0,54,7.2l-.86-.34c-1.1-2.74-1.22-2.74-1.54-2.74H49.47c-.33,0-.45,0-1.48,2.75l-.85.34a14.14,14.14,0,0,0-2.74-1h-.2L42.56,7.83c-.25.24-.34.32.92,3l-.34.83c-2.8,1.08-2.8,1.18-2.8,1.51v2.12c0,.33,0,.45,2.8,1.45l.35.82c-1.19,2.71-1.11,2.79-.88,3l1.53,1.49.15.14h.18a10,10,0,0,0,2.69-1.06l.85.35c1.11,2.73,1.22,2.73,1.55,2.73h2.15c.33,0,.45,0,1.48-2.74l.85-.35a14.89,14.89,0,0,0,2.73,1H57l1.66-1.62c.23-.23.31-.32-.94-3L58,16.7c2.8-1.09,2.8-1.2,2.8-1.52V13.07C60.84,12.73,60.84,12.62,58,11.62Zm-7.44,6.06a3.52,3.52,0,1,1,3.58-3.51A3.56,3.56,0,0,1,50.59,17.68Z"
                                        transform="translate(-8.93 -4.12)" />
                                </svg>
                            </button>
                        </div>
                    </form>
                    @if ($filterName)
                        <p wire:model="filterName">Não participarão</p>
                        <ul class="list-none">
                            @php
                                $c = 0;
                            @endphp
                            @foreach ($filterName as $item)
                                <li>{{ $c += 1 }}) {{ $item }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-6 gap-2 sm:gap-4 col-span-full lg:col-span-3">
                    <div class="col-span-full sm:col-span-3">
                        <label for="firstname" class="text-sm">Equipe</label>
                        <Select wire:model="type_team" wire:change='cleanSearch()'
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400 dark:border-gray-700 dark:text-gray-900">
                            <option value="masculino">Masculina</option>
                            <option value="feminino">Feminina</option>
                            <option value="mista">Mista</option>
                        </Select>
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <label for="lastname" class="text-sm">Modalidade</label>
                        <Select wire:model="modality" wire:change='cleanSearch()'
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400 dark:border-gray-700 dark:text-gray-900">
                            <option value="1">Livre</option>
                            <option value="medley">Medley</option>
                            {{-- <option value="2">Borboleta</option>
                            <option value="3">Costas</option>
                            <option value="4">Peito</option> --}}
                        </Select>
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <label for="lastname" class="text-sm">Categoria</label>
                        <Select wire:model="birth" wire:change='cleanSearch()'
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400 dark:border-gray-700 dark:text-gray-900">
                            @foreach ($category as $item)
                                @if ($item->status)
                                    <option
                                        value="{{ $item->birth_year }}|{{ $item->birth_year_end }}|{{ $item->id }}">
                                        {{ $item->name }}</option>
                                @endif
                            @endforeach
                        </Select>
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <label for="lastname" class="text-sm">Distância (M)</label>
                        <Select wire:model="distance" wire:change='cleanSearch()'
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400 dark:border-gray-700 dark:text-gray-900">
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="200">200</option>
                            <option value="400">400</option>
                            <option value="800">800</option>
                            <option value="1600">1600</option>
                        </Select>
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <label for="lastname" class="text-sm">Piscina (M)</label>
                        <Select wire:model="pool" wire:change='cleanSearch()'
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400 dark:border-gray-700 dark:text-gray-900">
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </Select>
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <label for="lastname" class="text-sm">Tipo de tempo</label>
                        <Select wire:model="type_time" wire:change='cleanSearch()'
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400 dark:border-gray-700 dark:text-gray-900">
                            <option value="ambos">Ambos</option>
                            <option value="tomada">Tomada de tempo</option>
                            <option value="prova">Prova</option>
                        </Select>
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <label for="firstname" class="text-sm">Busca de resultado</label>
                        <Select wire:model="order" wire:change='cleanSearch()'
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400 dark:border-gray-700 dark:text-gray-900">
                            <option value="day">Mais recente</option>
                            <option value="record">Mais Baixo</option>
                        </Select>
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <label for="firstname" class="text-sm">Equipes</label>
                        <Select wire:model="select_team" wire:change='cleanSearch()'
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400 dark:border-gray-700 dark:text-gray-900">
                            <option value="best">Melhores</option>
                            <option value="all">Todas</option>
                        </Select>
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        {{-- <label for="lastname" class="text-sm">Atletas</label> --}}

                        <a href="#my-modal-2" wire:click='getfilterAthletes()' class="btn btn-error w-full">
                            <span class="leading-none">
                                Remover atletas
                            </span>
                            <svg class="w-6 h-6 " fill="currentColor" version="1.1" id="Capa_1"
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
                        </a>
                    </div>
                    @isset($combinations)
                        <div class="col-span-full sm:col-span-3">
                            <button class="btn btn-info w-full">
                                <span class="leading-none" wire:model="combinations">
                                    Combinações: {{ $combinations }}
                                </span>

                            </button>
                        </div>
                    @endisset

                </div>
            </fieldset>
        </div>
    </section>
    <section wire:model="equipes">
        <div class="grid grid-cols-1 sm:grid-cols-3 card card-side gap-4 rounded-md">
            @isset($equipes)
                @php
                    $title = 0;
                @endphp
                @foreach ($equipes as $equipe)
                    @php
                        $title += 1;
                        $t = converTime($equipe['time_total']);
                    @endphp
                    <div class="card card-side bg-neutral rounded-box text-neutral-content px-1 sm:px-0">
                        <div class="py-2 card-body mx-auto px-3 sm:px-2">
                            <div class="w-full text-center">
                                <x-action-counter time="{{ $t }}" title="{{ $title }}">
                                </x-action-counter>
                            </div>
                            <ul>
                                @foreach ($equipe['team'] as $athlete)
                                    <li>
                                        @switch($athlete->modality->id)
                                            @case(1)
                                                @php $color = 'badge-error'; @endphp
                                            @break

                                            @case(2)
                                                @php $color = 'badge-info'; @endphp
                                            @break

                                            @case(3)
                                                @php $color = 'badge-success'; @endphp
                                            @break

                                            @case(4)
                                                @php $color = 'badge-warning'; @endphp
                                            @break
                                        @endswitch
                                        <div class="badge {{ $color }} mb-2 w-full">
                                            <strong>{{ $athlete->modality->title }} </strong>
                                            &nbsp;:{{ $athlete->athletes->nick }} ({{ converTime($athlete->record) }})
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                @endforeach
            @endisset

        </div>
    </section>

    <div class="modal" id="my-modal-2">
        <div class="modal-box">
            <h3 class="font-bold text-lg pb-2">Remover atletas</h3>
            <div class="grid grid-cols-2 gap-4" wire:model="allAthletes">
                @isset($allAthletes)
                    @foreach ($allAthletes as $item)
                        <div class="form-control">
                            <label class="cursor-pointer">
                                <input type="checkbox" wire:click='filterAthletes({{ $item->id }})'
                                    checked="checked" class="checkbox checkbox-info" />
                                <span class="pl-1 label-text">{{ $item->nick }}</span>
                            </label>
                        </div>
                    @endforeach
                @endisset
            </div>
            <div class="modal-action">
                <a href="#" class="btn" wire:change='cleanSearch()'>Fechar!</a>
            </div>
        </div>
    </div>
</div>
