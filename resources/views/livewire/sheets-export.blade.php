<div>
    <div
        class="p-2 flex flex-col items-stretch justify-end flex-shrink-0 w-full space-y-2 md:w-auto md:flex-row md:space-y-0 md:items-center md:space-x-3">

        <section class="px-6 py-2 dark:bg-gray-800 dark:text-gray-50">
            <div class="container flex flex-col mx-auto space-y-12
            ng-untouched ng-pristine ng-valid">
                <div class="grid grid-cols-6 gap-4 col-span-full lg:col-span-3">
                    <div class="col-span-full sm:col-span-2">
                        <label for="firstname" class="text-sm">Equipe</label>
                        <Select wire:model="type_team"
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400 dark:border-gray-700 dark:text-gray-900">
                            <option value="masculino">Masculina</option>
                            <option value="feminino">Feminina</option>
                            <option value="todos">Todos</option>
                        </Select>
                    </div>
                    <div class="col-span-full sm:col-span-2">
                        <label for="lastname" class="text-sm">Modalidade</label>
                        <Select wire:model="modality"
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400 dark:border-gray-700 dark:text-gray-900">
                            <option value="medley">Medley</option>
                            <option value="1">Craw</option>
                            <option value="2">Borboleta</option>
                            <option value="3">Costa</option>
                            <option value="4">Peito</option>
                        </Select>
                    </div>
                    <div class="col-span-full sm:col-span-2">
                        <label for="lastname" class="text-sm">Categoria</label>
                        <Select wire:model="birth_year"
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400 dark:border-gray-700 dark:text-gray-900">
                            <option value="todas">Todas</option>
                            @foreach ($category as $item)
                                <option value="{{ $item->birth_year }}">{{ $item->name }}</option>
                            @endforeach
                        </Select>
                    </div>
                    <div class="col-span-full sm:col-span-2">
                        <label for="lastname" class="text-sm">Distância (M)</label>
                        <Select wire:model="distance"
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
                    <div class="col-span-full sm:col-span-2">
                        <label for="lastname" class="text-sm">Piscina (M)</label>
                        <Select wire:model="pool"
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400 dark:border-gray-700 dark:text-gray-900">
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </Select>
                    </div>
                    <div class="col-span-full sm:col-span-2">
                        <label for="lastname" class="text-sm">Tipo de tempo</label>
                        <Select wire:model="type_time"
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400 dark:border-gray-700 dark:text-gray-900">
                            <option value="tomada">Tomada de tempo</option>
                            <option value="prova">Prova</option>
                        </Select>
                    </div>
                </div>
            </div>
        </section>

        <div class="group flex">
            <button wire:click="downloadExcel()"
                class="flex-col items-center justify-center w-1/2 px-5 text-center
                        py-2 text-sm tracking-wide text-white transition-colors
                        duration-200 bg-green-500 rounded-lg sm:w-auto gap-x-2
                        hover:bg-green-600 dark:hover:bg-green-500 dark:bg-green-600">
                <svg class="h-10 w-10 mx-auto" fill="currentColor" viewbox="0 0 24 24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M8,8a1,1,0,0,0,0,2H9A1,1,0,0,0,9,8Zm5,12H6a1,1,0,0,1-1-1V5A1,1,0,0,1,6,4h5V7a3,3,0,0,0,3,3h3v2a1,1,0,0,0,2,0V9s0,0,0-.06a1.31,1.31,0,0,0-.06-.27l0-.09a1.07,1.07,0,0,0-.19-.28h0l-6-6h0a1.07,1.07,0,0,0-.28-.19.29.29,0,0,0-.1,0A1.1,1.1,0,0,0,12.06,2H6A3,3,0,0,0,3,5V19a3,3,0,0,0,3,3h7a1,1,0,0,0,0-2ZM13,5.41,15.59,8H14a1,1,0,0,1-1-1ZM14,12H8a1,1,0,0,0,0,2h6a1,1,0,0,0,0-2Zm6.71,6.29a1,1,0,0,0-1.42,0l-.29.3V16a1,1,0,0,0-2,0v2.59l-.29-.3a1,1,0,0,0-1.42,1.42l2,2a1,1,0,0,0,.33.21.94.94,0,0,0,.76,0,1,1,0,0,0,.33-.21l2-2A1,1,0,0,0,20.71,18.29ZM12,18a1,1,0,0,0,0-2H8a1,1,0,0,0,0,2Z"/></svg>
                <span>Baixar modelo excel </span>
            </button>

        </div>
    </div>

</div>
