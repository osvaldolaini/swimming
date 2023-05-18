@props(['heads' => null])
    <div class="flex w-full">
        <select id="filters" wire:model='selectFilter' wire.loading="disable" class="flex-shrink-0 z-10 inline-flex items-center
         text-sm font-medium text-center text-gray-500 bg-gray-100
         border border-gray-300 rounded-l-lg hover:bg-gray-200 focus:ring-4
         focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600
         dark:focus:ring-gray-700 dark:text-white dark:border-gray-600">
            @foreach ($heads as $filter)
                @if (isset($filter['filter']))
                    <option value="{{ $filter['field'] }}">
                        {{ $filter['label'] }}
                    </option>
                @endif
            @endforeach ($heads as $filter)
        </select>
        <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm
        rounded-r-lg border-l-gray-100 dark:border-l-gray-700 border-l-2
        focus:ring-blue-500 focus:border-blue-500 block w-full
        dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
        dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <label for="simple-search" class="sr-only">
                Pesquisar
            </label>
            <div class="relative w-full">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                    </svg>
                </div>
                <input type="text" id="simple-search" wire:model="search"
                class="block w-full p-2 pl-10 text-sm text-gray-900 border
                border-gray-300 rounded-lg bg-gray-50 focus:ring-primary-500
                focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600
                dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500
                dark:focus:border-primary-500" placeholder="Pesquisar " >
            </div>
        </div>
    </div>
