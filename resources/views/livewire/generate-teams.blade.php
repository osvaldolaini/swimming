<div>
    <section class="p-6 dark:bg-gray-800 dark:text-gray-50">
        <form wire:submit.prevent="generateTeams()"
            class="container flex flex-col mx-auto space-y-12
        ng-untouched ng-pristine ng-valid">
            <fieldset class="grid grid-cols-4 gap-6 p-6 rounded-md shadow-sm dark:bg-gray-900">
                <div class="space-y-2 col-span-full lg:col-span-1">
                    <p class="font-medium">Montes a(s) equipe(s)</p>
                    <p class="text-xs">Informe os dados necessários para formar a(s) equipe(s).</p>
                </div>
                <div class="grid grid-cols-6 gap-4 col-span-full lg:col-span-3">
                    <div class="col-span-full sm:col-span-3">
                        <label for="firstname" class="text-sm">Equipe</label>
                        <Select wire:model="type_team"
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400 dark:border-gray-700 dark:text-gray-900">
                            <option value="masculino">Masculina</option>
                            <option value="feminino">Feminina</option>
                            <option value="mista">Mista</option>
                        </Select>
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <label for="lastname" class="text-sm">Modalidade</label>
                        <Select wire:model="modality"
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400 dark:border-gray-700 dark:text-gray-900">
                            <option value="livre">Livre</option>
                            <option value="medley">Medley</option>
                        </Select>
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <label for="lastname" class="text-sm">Categoria</label>
                        <Select wire:model="birth_year"
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400 dark:border-gray-700 dark:text-gray-900">
                            @foreach ($category as $item)
                                <option value="{{ $item->birth_year }}">{{ $item->name }}</option>
                            @endforeach
                        </Select>
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <label for="lastname" class="text-sm">Distância (M)</label>
                        <Select wire:model="distance"
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400 dark:border-gray-700 dark:text-gray-900">
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="200">200</option>
                        </Select>
                    </div>
                    <div class="col-span-full sm:col-span-3">

                        <button type="submit"
                            class="px-8 py-3 font-semibold text-gray-50 rounded-full bg-blue-300 dark:bg-blue-800">
                            Gerar
                        </button>
                    </div>
                </div>
            </fieldset>
        </form>
    </section>
    <section wire:model="equipes">
        <div wire:loading wire:target="equipes">
            Processing Payment...
        </div>
        <ul>
            @isset($equipes)
                    @php
                        $team = 0;
                    @endphp
                @foreach ($equipes as $equipe)

                @php
                $team += 1;
            @endphp
            <p>Equipe {{ $team }}</p>
                @foreach ($equipe as $key => $atleta)
                @php
                $tempo_total = 0;
                $mod = $key + 1;
            @endphp

                <p>
                    @php
                            $time = $times
                            ->where('modality_id', $mod)
                            ->where('athlete_id', $atleta)
                            ->first();
                            // $tempo_total += date('H:i:s', strtotime($time->record));
                    @endphp

                    @if ($time)
                        {{ $time->athletes->nick }}
                        - {{ $time->modality->title }}
                        @php
                            $tb = explode(':', date('H:i:s', strtotime($time->record)));
                        @endphp
                        {{ $tb[0] }}:{{ $tb[1] }},{{ $tb[2] }}
                    @endif

                </p>
                @endforeach

                    <br/><br/>
                @endforeach

            @endisset

        </ul>
    </section>
</div>
