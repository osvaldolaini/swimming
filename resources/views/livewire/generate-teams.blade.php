<div>
    @isset($message)
        {{ $message }}
    @endisset
    <x-action-loading></x-action-loading>
    <section class="px-6 py-2 dark:bg-gray-800 dark:text-gray-50">
        <div class="container flex flex-col mx-auto space-y-12
        ng-untouched ng-pristine ng-valid">
            <fieldset class="grid grid-cols-4 gap-6 p-6 rounded-md shadow-sm dark:bg-gray-900">
                <div class="space-y-2 col-span-full lg:col-span-1">
                    <p class="font-medium">Monte a(s) equipe(s)</p>
                    <p class="text-xs">Informe os dados necessários para formar a(s) equipe(s).</p>
                    <form wire:submit.prevent="generateTeams()">
                        <div class="col-span-full sm:col-span-3">
                            <label for="firstname" class="text-sm">&nbsp;</label>
                            <button type="submit " wire:loading.remove
                                class="px-8 py-2 font-semibold text-gray-50 rounded-full bg-blue-300 dark:bg-blue-800">
                                Gerar
                            </button>
                        </div>
                    </form>
                </div>
                <div class="grid grid-cols-6 gap-4 col-span-full lg:col-span-3">
                    <div class="col-span-full sm:col-span-3">
                        <label for="firstname" class="text-sm">Equipe</label>
                        <Select wire:model="type_team" wire:change='cleanSearch()'
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400 dark:border-gray-700 dark:text-gray-900">
                            <option value="masculino">Masculina</option>
                            <option value="feminino">Feminina</option>
                            <option value="mista">Mista</option>
                        </Select>
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <label for="lastname" class="text-sm">Modalidade</label>
                        <Select wire:model="modality" wire:change='cleanSearch()'
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400 dark:border-gray-700 dark:text-gray-900">
                            <option value="livre">Livre</option>
                            <option value="medley">Medley</option>
                            <option value="1">Craw</option>
                            <option value="2">Borboleta</option>
                            <option value="3">Costas</option>
                            <option value="4">Peito</option>
                        </Select>
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <label for="lastname" class="text-sm">Categoria</label>
                        <Select wire:model="birth_year" wire:change='cleanSearch()'
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400 dark:border-gray-700 dark:text-gray-900">
                            @foreach ($category as $item)
                                <option value="{{ $item->birth_year }}">{{ $item->name }}</option>
                            @endforeach
                        </Select>
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <label for="lastname" class="text-sm">Distância (M)</label>
                        <Select wire:model="distance" wire:change='cleanSearch()'
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400 dark:border-gray-700 dark:text-gray-900">
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="200">200</option>
                            <option value="400">400</option>
                            <option value="800">800</option>
                            <option value="1600">1600</option>
                        </Select>
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <label for="lastname" class="text-sm">Piscina (M)</label>
                        <Select wire:model="pool" wire:change='cleanSearch()'
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400 dark:border-gray-700 dark:text-gray-900">
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </Select>
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <label for="lastname" class="text-sm">Tipo de tempo</label>
                        <Select wire:model="type_time" wire:change='cleanSearch()'
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400 dark:border-gray-700 dark:text-gray-900">
                            <option value="ambos">Ambos</option>
                            <option value="tomada">Tomada de tempo</option>
                            <option value="prova">Prova</option>
                        </Select>
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <label for="firstname" class="text-sm">Busca de resultado</label>
                        <Select wire:model="order" wire:change='cleanSearch()'
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400 dark:border-gray-700 dark:text-gray-900">
                            <option value="day">Mais recente</option>
                            <option value="record">Mais Baixo</option>
                        </Select>
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <label for="firstname" class="text-sm">Equipes</label>
                        <Select wire:model="select_team" wire:change='cleanSearch()'
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400 dark:border-gray-700 dark:text-gray-900">
                            <option value="best">Melhores</option>
                            <option value="all">Todas</option>
                        </Select>
                    </div>

                </div>
            </fieldset>
    </div>
    </section>
    <section wire:model="equipes" >
        <div class="grid grid-cols-3 card card-side gap-4 rounded-md">
            @isset($equipes)
            @php
                $title = 0;
            @endphp
                @foreach ($equipes as $equipe)
                @php
                    $title += 1;
                    $t = converTime($equipe['time_total']);
                @endphp
                <div class="card card-side bg-neutral rounded-box text-neutral-content px-0">
                    <div class="py-2 card-body mx-auto px-2">
                        <div class="w-full text-center">
                            <x-action-counter time={{$t}} title="{{ $title }}"></x-action-counter>
                        </div>
                        <ul>
                            @foreach ($equipe['team'] as $athlete)
                                <li>
                                    @switch($athlete->modality->id)
                                        @case(1) @php $color = 'badge-error'; @endphp @break
                                        @case(2) @php $color = 'badge-info'; @endphp @break
                                        @case(3) @php $color = 'badge-success'; @endphp @break
                                        @case(4) @php $color = 'badge-warning'; @endphp @break

                                    @endswitch
                                    <div class="badge {{ $color }} mb-2 w-full">
                                        <strong>{{ $athlete->modality->title }} </strong>
                                          &nbsp;:{{ $athlete->athletes->name }} - Tempo: {{ converTime($athlete->record) }}
                                        </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
                @endforeach
            @endisset

        </div>
    </section>
</div>
 {{-- <div>
    @php
    $teams = array(
                array(
                    'ids' => array(2, 8, 4, 10),
                    'time_total' => 582.01,
                    'team' => array(),
                ),
                array(
                    'ids' => array(15, 16, 11, 2),
                    'time_total' => 581.03,
                    'team' => array(),
                ),
                array(
                    'ids' => array(9, 4, 6, 7),
                    'time_total' => 582.20,
                    'team' => array(),
                ),
                array(
                    'ids' => array(5, 8, 2, 7),
                    'time_total' => 582.34,
                    'team' => array(),
                ),
                array(
                    'ids' => array(1, 6, 9, 10),
                    'time_total' => 581.33,
                    'team' => array(),
                )
            );

            $result = array();
            $arrays_i = array();
            $arrays_j = array();
            // $arrays_i[] = '$teams[0]';
            // $result[] = $teams[0];
            for ($i = 0; $i < count($teams); $i++) {

                // iterar sobre as arrays "filhas"
                // $arrays_i[] = $teams[$i];
                $diff_i = in_array($teams[$i], $arrays_i); //EXCLUIDO
                // print_r($arrays_i);
                // $diff_i = array_search($teams[$i], $arrays_i);
                // dd($diff_i);
                if (!$diff_i) { // se não foi exluido
                    $result[] = $teams[$i];

                    $arrays_i[] = $teams[$i];
                    // $arrays_i[] = $teams[$i];
                    foreach ($teams[$i]['ids'] as $ids) {
                        echo '<pre>'.$ids;
                        // $x = $i+1;
                        for ($j = 0; $j < count($teams); $j++) {
                            $diff_j = in_array($teams[$j], $result); //EXCLUIDO
                            // echo '---->'.$diff_j;
                            // $diff_j = array_search(intval($teams[$j]), $arrays_j);
                                if (!$diff_j){
                                    // echo '<pre>';
                                    //     print_r($teams[$j]['ids']);
                                    $diff_k = in_array($teams[$j], $arrays_i); //EXCLUIDO
                                    if (!$diff_k){
                                    $diff = in_array($ids, $teams[$j]['ids']);
                                    if ($diff) {
                                        // echo $diff. '------';
                                        $arrays_i[] = $teams[$j];
                                        break;
                                    }
                                }
                            }
                        }
                    }

                }

            }
            echo '<pre>';
        print_r($result);

    @endphp
</div> --}}
