<div class="w-100">
    <x-header>EQUIPES</x-header>
    {{-- @livewire('admin.filters.institution.institution-table') --}}
    <div class="bg-white shadow-md dark:bg-gray-800 pt-3 sm:rounded-lg">
        <livewire:search-bar.search-bar
            {{-- REQUIRED --}} model="App\Models\Model\Teams" {{-- Model principal --}}
            {{-- REQUIRED --}} modelId="id"  {{-- Ex: 'table.id' or 'id' --}}
            {{-- REQUIRED --}} showId="false" {{-- 'true' or 'false' --}}
            {{-- REQUIRED --}} columnsInclude="name,min_age,max_age" {{-- Colunas incluidas --}}
            {{-- REQUIRED --}} columnsNames="Equipe,Idade mínima,Idade Limite" {{-- Cabeçalho da tabela --}}
            {{-- REQUIRED --}} searchable="name,min_age,max_age" {{-- Colunas pesquisadas no banco de dados --}}
            {{-- OK --}} customSearch="" {{-- Colunas personalizadas, customizar no model --}}
            {{-- OK --}} activeButton="active" {{-- Toogle de ativar e desativar registro --}}
            {{-- OK --}} relationTables="" {{-- Relacionamentos ( table , key , foreingKey ) --}}
            {{-- OK --}} showButtons="Ações" {{-- Botões --}}
            {{-- OK --}} sort="min_age , asc" {{-- Ordenação da tabela --}}
            {{-- OK --}} paginate="10" {{-- Qtd de registros por página --}} />
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
                        <label for="name"
                            class="block text-sm font-medium text-gray-900 dark:text-white">*Categoria</label>
                        <input type="text" wire:model="name" name="name" id="name" placeholder="Categoria"
                            required=""
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        @error('name')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-2">
                        <label for="type"
                            class="block text-sm font-medium text-gray-900 dark:text-white">*Categoria</label>
                        <select placeholder="Categoria" wire:model="category_id" wire:change="changeType"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="">Selecione...</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-2 sm:col-span-1 {{ $category_id != '' ? 'block' : 'hidden' }} ">
                        <label for="min_age" class="block text-sm font-medium text-gray-900 dark:text-white">
                            *Idade mínima (ano do nascimento)</label>
                        <select placeholder="Limite de idade da categoria" wire:model="min_age" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            @for ($i = $initial; $i < $final; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                        @error('max_age')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-2 sm:col-span-1 {{ $category_id != '' ? 'block' : 'hidden' }} ">
                        <label for="max_age" class="block text-sm font-medium text-gray-900 dark:text-white">
                            *Idade máxima (ano do nascimento)</label>
                        <select placeholder="Limite de idade da categoria" wire:model="max_age" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            @for ($i = $initial; $i < $final; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                        @error('max_age')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </form>
        </x-slot>
        <x-slot name="footer">
            <button type="submit" wire:click="store" class="text-white
                    bg-blue-700 hover:bg-blue-800
                    focus:ring-4 focus:outline-none focus:ring-blue-300
                    font-medium rounded-lg text-sm px-5 py-2.5
                    text-center dark:bg-blue-600 dark:hover:bg-blue-700
                    dark:focus:ring-blue-800">
                        Salvar
                </button>
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
                        <label for="name"
                            class="block text-sm font-medium text-gray-900 dark:text-white">*Categoria</label>
                        <input type="text" wire:model="name" name="name" id="name" placeholder="Categoria"
                            required=""
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        @error('name')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-2">
                        <label for="type"
                            class="block text-sm font-medium text-gray-900 dark:text-white">*Categoria</label>
                        <select placeholder="Categoria" wire:model="category_id" wire:change="changeType"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-2 sm:col-span-1 {{ $category_id != '' ? 'block' : 'hidden' }} ">
                        <label for="min_age" class="block text-sm font-medium text-gray-900 dark:text-white">
                            *Idade mínima (ano do nascimento)</label>
                        <select placeholder="Limite de idade da categoria" wire:model="min_age" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            @for ($i = $initial; $i < $final; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                        @error('max_age')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-2 sm:col-span-1 {{ $category_id != '' ? 'block' : 'hidden' }} ">
                        <label for="max_age" class="block text-sm font-medium text-gray-900 dark:text-white">
                            *Idade máxima (ano do nascimento)</label>
                        <select placeholder="Limite de idade da categoria" wire:model="max_age" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            @for ($i = $initial; $i < $final; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                        @error('max_age')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </form>
        </x-slot>
        <x-slot name="footer">
            <button type="submit" wire:click="update" class="text-white
                    bg-blue-700 hover:bg-blue-800
                    focus:ring-4 focus:outline-none focus:ring-blue-300
                    font-medium rounded-lg text-sm px-5 py-2.5
                    text-center dark:bg-blue-600 dark:hover:bg-blue-700
                    dark:focus:ring-blue-800">
                        Atualizar
                </button>
            <x-primary-button wire:click="$toggle('showModalEdit')" class="mx-2">
                Fechar
                </x-secondary-button>
        </x-slot>
    </x-dialog-modal>
</div>
