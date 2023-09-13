<div class="w-100">
    <div class="hero bg-gray-100 rounded-t-lg mb-5">
        <div class="hero-content flex-col lg:flex-row-reverse py-5 my-0">
            <h1 class="text-4xl font-black py-0 my-0">CATEGORIAS</h1>
        </div>
    </div>
    {{-- @livewire('admin.filters.institution.institution-table') --}}
    <div class="bg-white shadow-md dark:bg-gray-800 pt-3 sm:rounded-lg">
        <livewire:search-bar.search-bar
        {{-- REQUIRED --}}  model="App\Models\Model\Categories" {{-- Model principal --}}
        {{-- REQUIRED --}}  modelId="id" {{-- Ex: 'table.id' or 'id' --}}
        {{-- REQUIRED --}}  showId="false" {{-- 'true' or 'false' --}}
        {{-- REQUIRED --}}  columnsInclude="name,type,birth_year,birth_year_end" {{-- Colunas incluidas --}}
        {{-- REQUIRED --}}  columnsNames="Categoria,Tipo,Ano,Ano limite" {{-- Cabeçalho da tabela --}}
        {{-- REQUIRED --}}  searchable="name,birth_year,birth_year_end" {{-- Colunas pesquisadas no banco de dados --}}
        {{-- OK --}} customSearch="type" {{-- Colunas personalizadas, customizar no model --}}
        {{-- OK --}} activeButton="active" {{-- Toogle de ativar e desativar registro --}}
        {{-- OK --}} relationTables="" {{-- Relacionamentos ( table , key , foreingKey ) --}}
        {{-- OK --}} showButtons="Ações" {{-- Botões --}}
        {{-- OK --}} sort="type , asc" {{-- Ordenação da tabela --}}
        {{-- OK --}} paginate="10" {{-- Qtd de registros por página --}}
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
            <x-slot name="title">Criar novo</x-slot>
            <x-slot name="content">
                <form action="#" wire:submit.prevent="store()" wire.loading.attr='disable'>
                    <div class="grid gap-4 mb-1 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                        <div class="col-span-2">
                            <label for="name" class="block text-sm font-medium text-gray-900 dark:text-white">*Categoria</label>
                            <input type="text" wire:model="name" name="name" id="name"  placeholder="Categoria" required="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            @error('name') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-2">
                            <label for="type" class="block text-sm font-medium text-gray-900 dark:text-white">*Categoria</label>
                            <select wire:model="type" name="type" id="type" placeholder="Tipo"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="1">Base</option>
                                <option value="2">Absoluto</option>
                                <option value="3">Master</option>
                            </select>
                            @error('type') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-1 {{ ($type == 3 ? 'block':'hidden') }} ">
                            <label for="old_min" class="block text-sm font-medium text-gray-900 dark:text-white">
                                *Soma mínima das idades</label>
                            <input type="text" wire:model="old_min" placeholder="Soma das idades" required="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            @error('old_min') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-1 {{ ($type == 3 ? 'block':'hidden') }} ">
                            <label for="old_max" class="block text-sm font-medium text-gray-900 dark:text-white">
                                *Soma máxima das idades</label>
                            <input type="text" wire:model="old_max" placeholder="Soma das idades" required="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            @error('old_max') <span class="error">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-span-2 sm:col-span-1" x-data x-init="Inputmask({
                            'mask': '9999'
                        }).mask($refs.birth_year)">
                            <label for="birth_year"
                                class="block text-sm font-medium text-gray-900 dark:text-white">Data</label>
                            <input type="text" x-ref="birth_year" wire:model="birth_year" placeholder="Data"
                                required=""
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm
                                rounded-lg focus:ring-primary-600 focus:border-primary-600
                                block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            @error('birth_year')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-1" x-data x-init="Inputmask({
                            'mask': '9999'
                        }).mask($refs.birth_year_end)">
                            <label for="birth_year_end"
                                class="block text-sm font-medium text-gray-900 dark:text-white">Data limite</label>
                            <input type="text" x-ref="birth_year_end" wire:model="birth_year_end" placeholder="Data limite"
                                required=""
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm
                                rounded-lg focus:ring-primary-600 focus:border-primary-600
                                block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            @error('birth_year_end')
                                <span class="error">{{ $message }}</span>
                            @enderror
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
                            <label for="name" class="block text-sm font-medium text-gray-900 dark:text-white">*Categoria</label>
                            <input type="text" wire:model="name" name="name" id="name"  placeholder="Categoria" required="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            @error('name') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-1 {{ ($type == 3 ? 'block':'hidden') }} ">
                            <label for="old_min" class="block text-sm font-medium text-gray-900 dark:text-white">
                                *Soma mínima das idades</label>
                            <input type="text" wire:model="old_min" placeholder="Soma das idades" required="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            @error('old_min') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-1 {{ ($type == 3 ? 'block':'hidden') }} ">
                            <label for="old_max" class="block text-sm font-medium text-gray-900 dark:text-white">
                                *Soma máxima das idades</label>
                            <input type="text" wire:model="old_max" placeholder="Soma das idades" required="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            @error('old_max') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-2">
                            <label for="type" class="block text-sm font-medium text-gray-900 dark:text-white">*Categoria</label>
                            <select wire:model="type" placeholder="Tipo"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="1">Base </option>
                                <option value="2">Absoluto </option>
                                <option value="3">Master </option>
                            </select>
                            @error('type') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-1" x-data x-init="Inputmask({
                            'mask': '9999'
                        }).mask($refs.birth_year)">
                            <label for="birth_year"
                                class="block text-sm font-medium text-gray-900 dark:text-white">Data</label>
                            <input type="text" x-ref="birth_year" wire:model="birth_year" placeholder="Data"
                                required=""
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm
                                rounded-lg focus:ring-primary-600 focus:border-primary-600
                                block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            @error('birth_year')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-1" x-data x-init="Inputmask({
                            'mask': '9999'
                        }).mask($refs.birth_year_end)">
                            <label for="birth_year_end"
                                class="block text-sm font-medium text-gray-900 dark:text-white">Data limite</label>
                            <input type="text" x-ref="birth_year_end" wire:model="birth_year_end" placeholder="Data limite"
                                required=""
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm
                                rounded-lg focus:ring-primary-600 focus:border-primary-600
                                block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            @error('birth_year_end')
                                <span class="error">{{ $message }}</span>
                            @enderror
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

