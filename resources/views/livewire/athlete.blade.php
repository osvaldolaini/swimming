<div>
    <style>
        .photo {
            width: 100%;
            height: 100%;
            text-align: center;
            object-fit: cover;
            color: transparent;
            text-indent: 10000px;
        }
    </style>
    <div class="grid sm:grid-cols-3 grid-cols-1 gap-4 mb-3" >
        <button class="btn gap-2" wire:click="showModalCreate()">
            <svg class="h-8 w-8 " fill="currentColor" viewbox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path clip-rule="evenodd" fill-rule="evenodd"
                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                </svg>
            Inserir atleta
          </button>
          <x-message-session ></x-message-session>
    </div>
    <div class="grid sm:grid-cols-2 grid-cols-1 gap-4 " wire:model="athletes">
        @foreach ($athletes as $item)
        @php
            $livre = $this->times->where('athlete_id',$item->id)->where('modality_id',1)->first();
            $borbo = $this->times->where('athlete_id',$item->id)->where('modality_id',2)->first();
            $costa = $this->times->where('athlete_id',$item->id)->where('modality_id',3)->first();
            $peito = $this->times->where('athlete_id',$item->id)->where('modality_id',4)->first();
        @endphp
        <div class="card card-side shadow-xl h-100 {{ ($item->sex == 'feminino' ? 'bg-red-100' : 'bg-blue-100' ) }}">
            <figure class="w-48">
                @if ($item->register)
                    <img class="photo" src="{{ imageProfile($item->register.'/'.$item->slug)}}"
                    alt="Movie" />
                @else
                    <img class="photo" src="{{url('storage/logo-gnu.svg')}}"
                    alt="Movie" />
                @endif
            </figure>
            <div class="card-body">
                <h2 class="card-title ucfirst">{{ ucwords(mb_strtolower($item->nick)) }} ( {{ getCategory($item->birth) }} )</h2>
                <p>{{ $item->name }}</p>
              <h2 class="card-title">Tempos 50m</h2>
              <div class="grid grid-cols-4 gap-4">
                <div>
                    <div class="badge badge-info mb-2 w-full text-xs ">
                        Borbo
                        @isset($borbo)
                            {{converTime($borbo->record)}}
                        @endisset
                    </div>
                </div>
                <div>
                    <div class="badge badge-success mb-2 w-full text-xs">
                        Costa
                        @isset($costa)
                        {{converTime($costa->record)}}
                        @endisset
                    </div>
                </div>
                <div>
                    <div class="badge badge-warning mb-2 w-full text-xs">
                        Peito
                        @isset($peito)
                        {{converTime($peito->record)}}
                        @endisset
                    </div>
                </div>
                <div>
                    <div class="badge badge-error mb-2 w-full text-xs justify-center inline-block text-center">
                            @isset($livre)
                                {{converTime($livre->record)}}
                            @endisset
                            <span class="block ">Craw</span>
                    </div>
                </div>
              </div>
              <div class="card-actions justify-end">
                <x-table-buttons-modals id="{{ $item->id }}"></x-table-buttons-modals>
              </div>
            </div>
        </div>

        @endforeach
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
                    <div class="sm:col-span-2">
                        <label for="name" class="block text-sm font-medium text-gray-900 dark:text-white">Nome completo</label>
                        <input type="text" wire:model="name" name="name" id="name"  placeholder="Nome completo" required="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        @error('name') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="sm:w-full col-span-2 ">
                        <label for="nick" class="block text-sm font-medium text-gray-900 dark:text-white">Apelido</label>
                        <input type="text" wire:model="nick" name="nick" id="nick"  placeholder="Apelido" required="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        @error('nick') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="sm:w-full col-span-2 ">
                        <label for="register" class="block text-sm font-medium text-gray-900 dark:text-white">Nº de registro</label>
                        <input type="text" wire:model="register"  placeholder="Registro" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        @error('register') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="sm:col-span-2" x-data x-init="Inputmask({
                        'mask': '99/99/9999'
                    }).mask($refs.birth)">
                        <label for="birth"
                            class="block text-sm font-medium text-gray-900 dark:text-white">Data</label>
                        <input type="text" x-ref="birth" wire:model="birth" placeholder="Data"
                            required=""
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm
                            rounded-lg focus:ring-primary-600 focus:border-primary-600
                            block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        @error('birth')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="sm:w-full col-span-2 ">
                        <label for="sex"
                        class="block text-sm font-medium text-gray-900 dark:text-white">Sexo</label>
                        <select wire:model="sex"  name="sex" id="sex" placeholder="Sexo"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" >
                                <option value="">Selecione uma opção</option>
                                <option value="masculino">Masculino</option>
                                <option value="feminino">Feminino</option>
                        </select>
                        @error('sex') <span class="error">{{ $message }}</span> @enderror
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
                    <div class="sm:col-span-2">
                        <label for="name" class="block text-sm font-medium text-gray-900 dark:text-white">Nome completo</label>
                        <input type="text" wire:model="name" name="name" id="name"  placeholder="Nome completo" required="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        @error('name') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="sm:w-full col-span-2 ">
                        <label for="nick" class="block text-sm font-medium text-gray-900 dark:text-white">Apelido</label>
                        <input type="text" wire:model="nick" name="nick" id="nick"  placeholder="Apelido" required="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        @error('nick') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="sm:w-full col-span-2 ">
                        <label for="register" class="block text-sm font-medium text-gray-900 dark:text-white">Nº de registro</label>
                        <input type="text" wire:model="register" placeholder="Registro" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        @error('register') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="sm:col-span-2" x-data x-init="Inputmask({
                        'mask': '99/99/9999'
                    }).mask($refs.birth)">
                        <label for="birth"
                            class="block text-sm font-medium text-gray-900 dark:text-white">Data</label>
                        <input type="text" x-ref="birth" wire:model="birth" placeholder="Data"
                            required=""
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm
                            rounded-lg focus:ring-primary-600 focus:border-primary-600
                            block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        @error('birth')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="sm:w-full col-span-2 ">
                        <label for="sex"
                        class="block text-sm font-medium text-gray-900 dark:text-white">Sexo</label>
                        <select wire:model="sex"  name="sex" id="sex" placeholder="Sexo"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" >
                                <option value="">Selecione uma opção</option>
                                <option value="masculino">Masculino</option>
                                <option value="feminino">Feminino</option>
                        </select>
                        @error('sex') <span class="error">{{ $message }}</span> @enderror
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
