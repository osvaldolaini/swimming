<div class="w-100">
    <div class="bg-white shadow-md dark:bg-gray-800 sm:rounded-lg mb-3">
        @livewire('sheets-export')
    </div>
    <div class="bg-white shadow-md dark:bg-gray-800 sm:rounded-lg mb-3">
        @livewire('sheets-import')
    </div>
    <div class="bg-white shadow-md dark:bg-gray-800 pt-3 sm:rounded-lg">
        <livewire:search-bar.search-bar
            {{-- REQUIRED --}}  model="App\Models\Model\Times" {{-- Model principal --}}
            {{-- REQUIRED --}}  modelId="times.id" {{-- Ex: 'table.id' or 'id' --}}
            {{-- REQUIRED --}}  showId="false" {{-- 'true' or 'false' --}}
            {{-- REQUIRED --}}  columnsInclude="day,athletes.name,modalities.title,record,pool,distance,type_time" {{-- Colunas incluidas --}}
            {{-- REQUIRED --}}  columnsNames="Data,Atleta,Modalidade,Tempo,Piscina,Distância,Tipo" {{-- Cabeçalho da tabela --}}
            {{-- REQUIRED --}}  searchable="type_time,athletes.name,modalities.title,pool,distance,day,record" {{-- Colunas pesquisadas no banco de dados --}}
            {{-- OK --}} customSearch="day|record" {{-- Colunas personalizadas, customizar no model --}}
            {{-- OK --}} activeButton="" {{-- Toogle de ativar e desativear registro --}}
            {{-- OK --}} relationTables="athletes,athletes.id,times.athlete_id | modalities,modalities.id,times.modality_id " {{-- Relacionamentos ( table , key , foreingKey ) --}}
            {{-- OK --}} showButtons="Ações" {{-- Botões --}}
            {{-- OK --}} sort="times.day , asc | times.record , asc" {{-- Ordenação da tabela --}}
            {{-- OK --}} paginate="15" {{-- Qtd de registros por página --}}
        />
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
                @if ($detail)
                    @foreach ($detail as $item => $value)
                        @if ($value)
                            @if ($item == 'Foto')
                                <figure class="w-48">
                                    <img class="photo" src="{{ $value }}" alt="Movie" />
                                </figure>
                            @else
                                <div class="flex flex-col pb-1">
                                    <dt class="text-gray-500 md:text-lg dark:text-gray-400">{{ $item }}:</dt>
                                    <dd class="text-lg font-semibold">
                                        {{ $value }}
                                    </dd>
                                </div>
                            @endif
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
                        <label for="category_id"
                            class="block text-sm font-medium text-gray-900 dark:text-white">*Categoria</label>
                        <select wire:model="category_id" wire:change="getAthletes()" name="category_id"
                            id="category_id" placeholder="Categoria"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="">Selecione uma opção</option>
                            @foreach ($categories as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('athlete_id')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    @isset($athletes)
                        <div class="col-span-2">
                            <label for="athlete_id"
                                class="block text-sm font-medium text-gray-900 dark:text-white">*Atleta</label>
                            <select wire:model="athlete_id" name="athlete_id" id="athlete_id" placeholder="Atleta"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="">Selecione uma opção</option>
                                @foreach ($athletes as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('athlete_id')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    @endisset

                    <div class="col-span-1">
                        <label for="modality_id"
                            class="block text-sm font-medium text-gray-900 dark:text-white">*Modalidade</label>
                        <select wire:model="modality_id" name="modality_id" id="modality_id"
                            placeholder="Modalidade"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="">Selecione uma opção</option>
                            @foreach ($modalities as $item)
                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                            @endforeach
                        </select>
                        @error('modality_id')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="sm:col-span-1" x-data x-init="Inputmask({
                        'mask': '99:99,99'
                    }).mask($refs.record)">
                        <label for="record"
                            class="block text-sm font-medium text-gray-900 dark:text-white">Tempo</label>
                        <input type="text" x-ref="record" wire:model="record" placeholder="Tempo" required=""
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm
                                rounded-lg focus:ring-primary-600 focus:border-primary-600
                                block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        @error('record')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-1">
                        <label for="pool"
                            class="block text-sm font-medium text-gray-900 dark:text-white">*Piscina</label>
                        <select wire:model="pool" name="pool" id="pool" placeholder="Piscina"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                        @error('pool')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-1">
                        <label for="distance"
                            class="block text-sm font-medium text-gray-900 dark:text-white">*Distância</label>
                        <select wire:model="distance" name="distance" id="distance" placeholder="Distância"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="200">200</option>
                        </select>
                        @error('distance')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="sm:col-span-1" x-data x-init="Inputmask({
                        'mask': '99/99/9999'
                    }).mask($refs.day)">
                        <label for="day"
                            class="block text-sm font-medium text-gray-900 dark:text-white">Data</label>
                        <input type="text" x-ref="day" wire:model="day" placeholder="Data" required=""
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm
                                rounded-lg focus:ring-primary-600 focus:border-primary-600
                                block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        @error('day')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-1">
                        <label for="type_time"
                            class="block text-sm font-medium text-gray-900 dark:text-white">*Tipo</label>
                        <select wire:model="type_time" name="type_time" id="type_time" placeholder="Tipo"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="tomada">Tomada</option>
                            <option value="prova">Prova</option>
                            <option value="parcial">Parcial</option>
                        </select>
                        @error('type_time')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="flex items-end space-x-4">
                    <button type="submit"
                        class="text-white
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
                        <label for="category_id"
                            class="block text-sm font-medium text-gray-900 dark:text-white">*Categoria</label>
                        <select wire:model="category_id" wire:change="getAthletes()" name="category_id"
                            id="category_id" placeholder="Categoria"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="">Selecione uma opção</option>
                            @foreach ($categories as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('athlete_id')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    @isset($athletes)
                        <div class="col-span-2">
                            <label for="athlete_id"
                                class="block text-sm font-medium text-gray-900 dark:text-white">*Atleta</label>
                            <select wire:model="athlete_id" name="athlete_id" id="athlete_id" placeholder="Atleta"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="">Selecione uma opção</option>
                                @foreach ($athletes as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('athlete_id')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    @endisset

                    <div class="col-span-1">
                        <label for="modality_id"
                            class="block text-sm font-medium text-gray-900 dark:text-white">*Modalidade</label>
                        <select wire:model="modality_id" name="modality_id" id="modality_id"
                            placeholder="Modalidade"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="">Selecione uma opção</option>
                            @foreach ($modalities as $item)
                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                            @endforeach
                        </select>
                        @error('modality_id')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="sm:col-span-1" x-data x-init="Inputmask({
                        'mask': '99:99,99'
                    }).mask($refs.record)">
                        <label for="record"
                            class="block text-sm font-medium text-gray-900 dark:text-white">Tempo</label>
                        <input type="text" x-ref="record" wire:model="record" placeholder="Tempo" required=""
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm
                                rounded-lg focus:ring-primary-600 focus:border-primary-600
                                block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        @error('record')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-1">
                        <label for="pool"
                            class="block text-sm font-medium text-gray-900 dark:text-white">*Piscina</label>
                        <select wire:model="pool" name="pool" id="pool" placeholder="Piscina"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                        @error('pool')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-1">
                        <label for="distance"
                            class="block text-sm font-medium text-gray-900 dark:text-white">*Distância</label>
                        <select wire:model="distance" name="distance" id="distance" placeholder="Distância"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="200">200</option>
                        </select>
                        @error('distance')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="sm:col-span-1" x-data x-init="Inputmask({
                        'mask': '99/99/9999'
                    }).mask($refs.day)">
                        <label for="day"
                            class="block text-sm font-medium text-gray-900 dark:text-white">Data</label>
                        <input type="text" x-ref="day" wire:model="day" placeholder="Data" required=""
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm
                                rounded-lg focus:ring-primary-600 focus:border-primary-600
                                block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        @error('day')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-1">
                        <label for="type_time"
                            class="block text-sm font-medium text-gray-900 dark:text-white">*Tipo</label>
                        <select wire:model="type_time" name="type_time" id="type_time" placeholder="Tipo"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="tomada">Tomada</option>
                            <option value="prova">Prova</option>
                            <option value="parcial">Parcial</option>
                        </select>
                        @error('type_time')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="flex items-end space-x-4">
                    <button type="submit"
                        class="text-white
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
