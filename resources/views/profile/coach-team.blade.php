<x-action-section>
    <x-slot name="title">
        Seu vinculo
    </x-slot>

    <x-slot name="description">
        Clicando no botão você pode desvincular-se do clube.
    </x-slot>

    <x-slot name="content">
        <x-message-session></x-message-session>
        @if (Auth::user()->team)
            <div class="mt-5 space-y-6">
                <!-- Other Browser Sessions -->
                <div class="overflow-x-auto">
                    <table class="table w-full text-sm ">
                        <thead>
                            <tr>
                                <th>Clube / Associação</th>
                                <th>Coordenador</th>
                                <th>Data vínculo</th>
                                <th>Exluir</th>
                            </tr>
                        </thead>
                        <tbody>

                            <div class="flex items-center">
                                <!-- row 1 -->
                                <tr>
                                    <th>{{ Auth::user()->team->nick }}</th>
                                    <td>
                                        {{ Auth::user()->team->head->name }}
                                    </td>
                                    <td>
                                        {{ convertDate(Auth::user()->group->updated_at) }}
                                    </td>
                                    <td>
                                        <button title="Apagar" wire:click="deleteTeam({{ Auth::user()->group->id }})"
                                            class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                            <svg class="w-5 h-5 mx-1" fill="currentColor"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10 12V17" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M14 12V17" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M4 7H20" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M6 10V18C6 19.6569 7.34315 21 9 21H15C16.6569 21 18 19.6569 18 18V10"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            <span class="mx-1">EXCLUIR</span>
                                        </button>
                                    </td>
                                </tr>
                            </div>
                        </tbody>
                    </table>
                </div>
            </div>
        @endif


    </x-slot>
</x-action-section>
