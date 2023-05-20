<div class="w-100">
    {{-- @livewire('admin.filters.institution.institution-table') --}}
    <div class="bg-white shadow-md dark:bg-gray-800 sm:rounded-lg mb-3">
        @livewire('sheets-export')
    </div>
    <div class="bg-white shadow-md dark:bg-gray-800 pt-3 sm:rounded-lg">
        <div class="flex flex-col items-center justify-between px-4 space-y-3 md:flex-row md:space-y-0 md:space-x-4">
        <x-table-filters :heads="$heads"></x-table-filters>
            <div class="flex flex-col items-stretch justify-end flex-shrink-0 w-full space-y-2 md:w-auto md:flex-row md:space-y-0 md:items-center md:space-x-3">
                <div class="group flex ">
                    <button wire:click="showModalCreate()" class="flex items-center justify-center w-1/2 px-5
                    py-2 text-sm tracking-wide text-white transition-colors
                    duration-200 bg-blue-500 rounded-lg sm:w-auto gap-x-2
                    hover:bg-blue-600 dark:hover:bg-blue-500 dark:bg-blue-600">
                        <svg class="h-4 w-4 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                        </svg>
                        <span>Novo </span>
                    </button>
                </div>
            </div>
        </div>

        <div class=" bg-white shadow-md dark:bg-gray-800 sm:rounded-lg my-6 px-4">
            <div class="-mx-4  overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden border border-gray-200 dark:border-gray-700 sm:rounded-lg">
                        <x-message-session ></x-message-session>
                        <table  style="width:100%" class='min-w-full divide-y divide-gray-200 dark:divide-gray-700'>
                            {{-- Table head --}}
                            <thead class="bg-gray-50 dark:bg-gray-800">
                                <tr >
                                    <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left text-gray-500 dark:text-gray-400">
                                        Data
                                    </th>
                                    <th scope="col" class="py-3.5 px-4 text-sm font-normal text-center text-gray-500 dark:text-gray-400">
                                        Atleta
                                    </th>
                                    <th scope="col" class="py-3.5 px-4 text-sm font-normal text-center text-gray-500 dark:text-gray-400">
                                        Modalidade
                                    </th>
                                    <th scope="col" class="py-3.5 px-4 text-sm font-normal text-center text-gray-500 dark:text-gray-400">
                                        Tempo
                                    </th>
                                    <th class="py-3.5 px-4 text-sm font-normal text-center text-gray-500 dark:text-gray-400">
                                        Piscina
                                    </th>
                                    <th class="py-3.5 px-4 text-sm font-normal text-center text-gray-500 dark:text-gray-400">
                                        Distância
                                    </th>
                                    <th class="py-3.5 px-4 text-sm font-normal text-center text-gray-500 dark:text-gray-400">
                                        Tipo
                                    </th>
                                    <th class="w-1/4 py-3.5 px-4 text-sm font-normal text-center text-gray-500 dark:text-gray-400">
                                        Opções
                                    </th>
                                </tr>
                            </thead>
                            {{-- Table body --}}
                            <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">

                                @foreach ($data as $cat)
                                <tr >
                                    <td class="py-1.5 px-4 text-sm font-normal text-left text-gray-500 dark:text-gray-400">
                                        {{ convertOnlyDate($cat->day)  }}
                                    </td>
                                    <td class="py-1.5 px-4 text-sm font-normal text-center text-gray-500 dark:text-gray-400">
                                        {{ ucwords(mb_strtolower($cat->athletes->nick)) }}
                                    </td>
                                    <td class="py-1.5 px-4 text-sm font-normal text-center text-gray-500 dark:text-gray-400">
                                        {{ $cat->modality->title}}
                                    </td>
                                    <td class="py-1.5 px-4 text-sm font-normal text-center text-gray-500 dark:text-gray-400">
                                        {{ converTime($cat->record) }}
                                    </td>
                                    <td class="py-1.5 px-4 text-sm font-normal text-center text-gray-500 dark:text-gray-400">
                                        {{ $cat->pool }}
                                    </td>
                                    <td class="py-1.5 px-4 text-sm font-normal text-center text-gray-500 dark:text-gray-400">
                                        {{ $cat->distance }}
                                    </td>
                                    <td class="py-1.5 px-4 text-sm font-normal text-center text-gray-500 dark:text-gray-400">
                                        {{ ucwords(mb_strtolower($cat->type_time)) }}
                                    </td>
                                    {{-- <td class="py-1.5 px-4 text-sm font-normal text-center text-gray-500 dark:text-gray-400">
                                        <div>
                                            <livewire:toggle-button
                                            :model="$cat"
                                            field="active"
                                            key="{{ $cat->id }}"
                                            width="sm" />

                                    </td> --}}
                                    <td class="py-1.5 px-4 text-sm font-normal text-center text-gray-500 dark:text-gray-400">
                                        <div class="w-full">
                                            <div class="flex justify-center font-medium duration-200 ">
                                                <div class="tooltip tooltip-bottom p-0" data-tip="Editar">
                                                    <button wire:click="showModalEdit({{ $cat->id }})"
                                                        class="py-2 px-3
                                                    hover:text-white dark:hover:bg-blue-500 transition-colors hover:hover:bg-blue-500
                                                    duration-200 whitespace-nowrap">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 " fill="none" viewBox="0 0 24 24"
                                                            stroke="currentColor" stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                                            </path>
                                                        </svg>
                                                    </button>
                                                </div>
                                                <div class="tooltip tooltip-bottom p-0" data-tip="Apagar">
                                                    <button wire:click="showModal({{ $cat->id }})"
                                                        class="py-2 px-3
                                                        transition-colors dark:hover:bg-red-500 hover:hover:bg-red-500
                                                        duration-200 hover:text-white -ml-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                                            stroke="currentColor" stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                            </path>
                                                        </svg>
                                                    </button>
                                                </div>
                                                <div class="tooltip tooltip-bottom p-0" data-tip="Ver">
                                                    <button wire:click="showView({{ $cat->id }})"
                                                        class="py-2 px-3 transition-colors
                                                    dark:hover:bg-teal-500 hover:hover:bg-teal-500
                                                    duration-200 hover:text-white -ml-1">
                                                        <svg stroke="currentColor" class="w-5 h-5 sm:w-6 sm:h-6" viewBox="0 0 24 24" fill="currentColor"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M6.30147 15.5771C4.77832 14.2684 3.6904 12.7726 3.18002 12C3.6904 11.2274 4.77832 9.73158 6.30147 8.42294C7.87402 7.07185 9.81574 6 12 6C14.1843 6 16.1261 7.07185 17.6986 8.42294C19.2218 9.73158 20.3097 11.2274 20.8201 12C20.3097 12.7726 19.2218 14.2684 17.6986 15.5771C16.1261 16.9282 14.1843 18 12 18C9.81574 18 7.87402 16.9282 6.30147 15.5771ZM12 4C9.14754 4 6.75717 5.39462 4.99812 6.90595C3.23268 8.42276 2.00757 10.1376 1.46387 10.9698C1.05306 11.5985 1.05306 12.4015 1.46387 13.0302C2.00757 13.8624 3.23268 15.5772 4.99812 17.0941C6.75717 18.6054 9.14754 20 12 20C14.8525 20 17.2429 18.6054 19.002 17.0941C20.7674 15.5772 21.9925 13.8624 22.5362 13.0302C22.947 12.4015 22.947 11.5985 22.5362 10.9698C21.9925 10.1376 20.7674 8.42276 19.002 6.90595C17.2429 5.39462 14.8525 4 12 4ZM10 12C10 10.8954 10.8955 10 12 10C13.1046 10 14 10.8954 14 12C14 13.1046 13.1046 14 12 14C10.8955 14 10 13.1046 10 12ZM12 8C9.7909 8 8.00004 9.79086 8.00004 12C8.00004 14.2091 9.7909 16 12 16C14.2092 16 16 14.2091 16 12C16 9.79086 14.2092 8 12 8Z" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="items-center justify-between  py-4">
                {{ $data->links() }}
            </div>
        </div>
    </div>
        {{-- MODAL DELETE --}}
        <x-confirmation-modal wire:model="showJetModal">
            <x-slot name="title">Excluir registro</x-slot>
            <x-slot name="content">
                <h2 class="h2">Deseja realmente excluir o registro?</h2>
                <p>Não será possível reverter esta ação!</p>
            </x-slot>
            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('showJetModal')" class="mx-2">
                    Cancelar
                </x-secondary-button>
                <x-danger-button wire:click.prevent="delete({{ $registerId }})" wire.loading.attr='disable'>
                    Apagar registro
                </x-danger-button>
            </x-slot>
        </x-confirmation-modal>
        {{-- MODAL READ --}}
        <x-dialog-modal wire:model="showModalView">
            <x-slot name="title">Detalhes</x-slot>
            <x-slot name="content">
                <dl class="max-w text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
                    @if($detail)
                        @foreach ($detail as $item => $value)
                            @if ($value)
                                <div class="flex flex-col pb-1">
                                    <dt class="text-gray-500 md:text-lg dark:text-gray-400">{{ $item }}:</dt>
                                    <dd class="text-lg font-semibold">
                                        {{ $value }}
                                    </dd>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </dl>
            </x-slot>
            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('showModalView')" class="mx-2">
                    Fechar
                </x-secondary-button>
            </x-slot>
        </x-dialog-modal>
        {{-- MODAL CREATE --}}
        <x-dialog-modal wire:model="showModalCreate">
            <x-slot name="title">Inserir novo</x-slot>
            <x-slot name="content">
                <form action="#" wire:submit.prevent="store()" wire.loading.attr='disable'>
                    <div class="grid gap-4 mb-1 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                        <div class="col-span-2">
                            <label for="category_id" class="block text-sm font-medium text-gray-900 dark:text-white">*Categoria</label>
                            <select wire:model="category_id" wire:change="getAthletes()" name="category_id" id="category_id"
                            placeholder="Categoria" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" >
                                <option value="">Selecione uma opção</option>
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}" >{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('athlete_id') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        @isset($athletes)
                            <div class="col-span-2">
                                <label for="athlete_id" class="block text-sm font-medium text-gray-900 dark:text-white">*Atleta</label>
                                <select wire:model="athlete_id"  name="athlete_id" id="athlete_id" placeholder="Atleta" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" >
                                    <option value="">Selecione uma opção</option>
                                    @foreach ($athletes as $item)
                                        <option value="{{ $item->id }}" >{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('athlete_id') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        @endisset

                        <div class="col-span-1">
                            <label for="modality_id" class="block text-sm font-medium text-gray-900 dark:text-white">*Modalidade</label>
                            <select wire:model="modality_id"  name="modality_id" id="modality_id" placeholder="Modalidade" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" >
                                <option value="">Selecione uma opção</option>
                                @foreach ($modalities as $item)
                                    <option value="{{ $item->id }}" >{{ $item->title }}</option>
                                @endforeach
                            </select>
                            @error('modality_id') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="sm:col-span-1" x-data x-init="Inputmask({
                            'mask': '99:99,99'
                        }).mask($refs.record)">
                            <label for="record"
                                class="block text-sm font-medium text-gray-900 dark:text-white">Tempo</label>
                            <input type="text" x-ref="record" wire:model="record" placeholder="Tempo"
                                required=""
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm
                                rounded-lg focus:ring-primary-600 focus:border-primary-600
                                block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            @error('record')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-1">
                            <label for="pool" class="block text-sm font-medium text-gray-900 dark:text-white">*Piscina</label>
                            <select wire:model="pool"  name="pool" id="pool" placeholder="Piscina" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" >
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                            </select>
                            @error('pool') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-1">
                            <label for="distance" class="block text-sm font-medium text-gray-900 dark:text-white">*Distância</label>
                            <select wire:model="distance"  name="distance" id="distance" placeholder="Distância" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" >
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="200">200</option>
                            </select>
                            @error('distance') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="sm:col-span-1" x-data x-init="Inputmask({
                            'mask': '99/99/9999'
                        }).mask($refs.day)">
                            <label for="day"
                                class="block text-sm font-medium text-gray-900 dark:text-white">Data</label>
                            <input type="text" x-ref="day" wire:model="day" placeholder="Data"
                                required=""
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm
                                rounded-lg focus:ring-primary-600 focus:border-primary-600
                                block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            @error('day')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-1">
                            <label for="type_time" class="block text-sm font-medium text-gray-900 dark:text-white">*Tipo</label>
                            <select wire:model="type_time"  name="type_time" id="type_time" placeholder="Tipo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" >
                                    <option value="tomada">Tomada</option>
                                    <option value="prova">Prova</option>
                                    <option value="parcial">Parcial</option>
                            </select>
                            @error('type_time') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="flex items-end space-x-4">
                        <button type="submit" class="text-white
                        bg-blue-700 hover:bg-blue-800
                        focus:ring-4 focus:outline-none focus:ring-blue-300
                        font-medium rounded-lg text-sm px-5 py-2.5
                        text-center dark:bg-blue-600 dark:hover:bg-blue-700
                        dark:focus:ring-blue-800">
                            Salvar
                        </button>
                    </div>
                </form>

            </x-slot>
            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('showModalCreate')" class="mx-2">
                    Fechar
                </x-secondary-button>
            </x-slot>
        </x-dialog-modal>
        {{-- MODAL UPDATE --}}
        <x-dialog-modal wire:model="showModalEdit">
            <x-slot name="title">Editar</x-slot>
            <x-slot name="content">
                <form wire:submit.prevent="update">
                    <div class="grid gap-4 mb-1 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                        <div class="col-span-2">
                            <label for="category_id" class="block text-sm font-medium text-gray-900 dark:text-white">*Categoria</label>
                            <select wire:model="category_id" wire:change="getAthletes()" name="category_id" id="category_id"
                            placeholder="Categoria" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" >
                                <option value="">Selecione uma opção</option>
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}" >{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('athlete_id') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        @isset($athletes)
                            <div class="col-span-2">
                                <label for="athlete_id" class="block text-sm font-medium text-gray-900 dark:text-white">*Atleta</label>
                                <select wire:model="athlete_id"  name="athlete_id" id="athlete_id" placeholder="Atleta" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" >
                                    <option value="">Selecione uma opção</option>
                                    @foreach ($athletes as $item)
                                        <option value="{{ $item->id }}" >{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('athlete_id') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        @endisset

                        <div class="col-span-1">
                            <label for="modality_id" class="block text-sm font-medium text-gray-900 dark:text-white">*Modalidade</label>
                            <select wire:model="modality_id"  name="modality_id" id="modality_id" placeholder="Modalidade" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" >
                                <option value="">Selecione uma opção</option>
                                @foreach ($modalities as $item)
                                    <option value="{{ $item->id }}" >{{ $item->title }}</option>
                                @endforeach
                            </select>
                            @error('modality_id') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="sm:col-span-1" x-data x-init="Inputmask({
                            'mask': '99:99,99'
                        }).mask($refs.record)">
                            <label for="record"
                                class="block text-sm font-medium text-gray-900 dark:text-white">Tempo</label>
                            <input type="text" x-ref="record" wire:model="record" placeholder="Tempo"
                                required=""
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm
                                rounded-lg focus:ring-primary-600 focus:border-primary-600
                                block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            @error('record')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-1">
                            <label for="pool" class="block text-sm font-medium text-gray-900 dark:text-white">*Piscina</label>
                            <select wire:model="pool"  name="pool" id="pool" placeholder="Piscina" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" >
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                            </select>
                            @error('pool') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-1">
                            <label for="distance" class="block text-sm font-medium text-gray-900 dark:text-white">*Distância</label>
                            <select wire:model="distance"  name="distance" id="distance" placeholder="Distância" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" >
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="200">200</option>
                            </select>
                            @error('distance') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="sm:col-span-1" x-data x-init="Inputmask({
                            'mask': '99/99/9999'
                        }).mask($refs.day)">
                            <label for="day"
                                class="block text-sm font-medium text-gray-900 dark:text-white">Data</label>
                            <input type="text" x-ref="day" wire:model="day" placeholder="Data"
                                required=""
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm
                                rounded-lg focus:ring-primary-600 focus:border-primary-600
                                block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            @error('day')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-1">
                            <label for="type_time" class="block text-sm font-medium text-gray-900 dark:text-white">*Tipo</label>
                            <select wire:model="type_time"  name="type_time" id="type_time" placeholder="Tipo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" >
                                    <option value="tomada">Tomada</option>
                                    <option value="prova">Prova</option>
                                    <option value="parcial">Parcial</option>
                            </select>
                            @error('type_time') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="flex items-end space-x-4">
                        <button type="submit" class="text-white
                        bg-blue-700 hover:bg-blue-800
                        focus:ring-4 focus:outline-none focus:ring-blue-300
                        font-medium rounded-lg text-sm px-5 py-2.5
                        text-center dark:bg-blue-600 dark:hover:bg-blue-700
                        dark:focus:ring-blue-800">
                            Atualizar
                        </button>
                    </div>
                </form>
            </x-slot>
            <x-slot name="footer">
                <x-primary-button wire:click="$toggle('showModalEdit')" class="mx-2">
                    Fechar
                </x-secondary-button>
            </x-slot>
        </x-dialog-modal>
</div>


