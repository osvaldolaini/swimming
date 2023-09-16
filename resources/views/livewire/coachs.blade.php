<div>
    <x-header>TREINADORES</x-header>
    <div class=" bg-white dark:bg-gray-800 sm:rounded-lg my-6 px-4">
        <div class="-mx-4  overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full align-middle md:px-6 lg:px-8">
                <div class="overflow-hidden border border-gray-200 dark:border-gray-700 sm:rounded-lg">
                    <x-message-session></x-message-session>
                    <table style="width:100%" class='min-w-full divide-y divide-gray-200 dark:divide-gray-700'>
                        <thead class="bg-gray-50 dark:bg-gray-800">
                            <tr scope="col"
                                class="py-3.5 px-4 text-sm font-normal text-left text-gray-500
                                dark:text-gray-400">
                                <th scope="col"
                                    class="py-3.5 px-4 text-sm font-normal
                                        text-center
                                                text-gray-500 dark:text-gray-400">
                                    Treinador
                                </th>
                                <th scope="col"
                                    class="py-3.5 px-4 text-sm font-normal
                                        text-center
                                                text-gray-500 dark:text-gray-400">
                                    Status
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                            @foreach ($coachs as $item)
                                <tr>
                                    <td
                                        class="py-1.5 px-4 text-sm font-normal  text-center text-gray-500 dark:text-gray-400">
                                        {{ $item->user->name }}
                                    </td>
                                    <td class="py-1.5 px-4 text-sm font-normal  text-center text-gray-500 dark:text-gray-400">
                                        @if ($item->head_ok == 0)
                                            <button class="btn btn-info btn-outline" wire:click="active({{ $item->id }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>
                                                Vincular
                                            </button>
                                        @else
                                            <button class="btn btn-info" wire:click="delete({{ $item->id }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>

                                                Desvincular
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
