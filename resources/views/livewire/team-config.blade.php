<div class="w-100">
    <div class="hero bg-gray-100 rounded-t-lg mb-5">
        <div class="hero-content flex-col lg:flex-row-reverse py-5 my-0">
            <h1 class="text-4xl font-black py-0 my-0">CONFIGURAÇÕES</h1>
        </div>
    </div>
    <x-message-session></x-message-session>
        <form action="#" wire:submit.prevent="store()"  class="container flex flex-col mx-auto space-y-12">
            <fieldset class="grid grid-cols-4 gap-6 p-6 rounded-md shadow-sm dark:bg-gray-900">
                <div class="space-y-2 col-span-full lg:col-span-1">
                    <p class="font-medium">Dados do clube</p>
                    {{-- <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                        <!-- Profile Photo File Input -->
                        <input type="file" class="hidden"
                                    wire:model="photo"
                                    x-ref="photo"
                                    x-on:change="
                                            photoName = $refs.photo.files[0].name;
                                            const reader = new FileReader();
                                            reader.onload = (e) => {
                                                photoPreview = e.target.result;
                                            };
                                            reader.readAsDataURL($refs.photo.files[0]);
                                    " />

                        <x-label for="photo" value="{{ __('Photo') }}" />

                        <!-- Current Profile Photo -->
                        <div class="mt-2" x-show="! photoPreview">
                            <img src="{{ $this->user->team_photo_path }}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">
                        </div>

                        <!-- New Profile Photo Preview -->
                        <div class="mt-2" x-show="photoPreview" style="display: none;">
                            <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                                  x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                            </span>
                        </div>

                        <x-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                            {{ __('Select A New Photo') }}
                        </x-secondary-button>

                        @if ($this->user->profile_photo_path)
                            <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                                {{ __('Remove Photo') }}
                            </x-secondary-button>
                        @endif

                        <x-input-error for="photo" class="mt-2" />
                    </div> --}}
                </div>
                <div class="grid grid-cols-6 gap-4 col-span-full lg:col-span-3">
                    <div class="col-span-full sm:col-span-3">
                        <label for="name" class="text-sm">Nome</label>
                        <input id="name" wire:model="name" type="text" placeholder="Nome" class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900">
                        @error('name')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <label for="nick" class="text-sm">Sigla</label>
                        <input id="nick" wire:model="nick" type="text" placeholder="Sigla" class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900">
                        @error('nick')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-full sm:col-span-6" x-data x-init="Inputmask({
                        'mask': '99/99/9999'
                        }).mask($refs.birth)">
                        <label for="birth" class="text-sm">Fundação</label>
                        <input id="birth" x-ref="birth" wire:model="birth" type="text"
                        placeholder="Fundação" class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900">
                    </div>
                    <div class="col-span-full sm:col-span-3">
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
                </div>
            </fieldset>
        </form>

</div>
