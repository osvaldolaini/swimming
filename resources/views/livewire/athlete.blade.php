<div>
    <div class="grid grid-cols-3 gap-4">
        @foreach ($athletes as $item)
        @php
            $livre = $this->times->where('athlete_id',$item->id)->where('modality_id',1)->first();
            $borbo = $this->times->where('athlete_id',$item->id)->where('modality_id',2)->first();
            $costa = $this->times->where('athlete_id',$item->id)->where('modality_id',3)->first();
            $peito = $this->times->where('athlete_id',$item->id)->where('modality_id',4)->first();
        @endphp
            <div class="grid grid-cols-3 card card-side bg-base-100 shadow-xl">
                <figure>
                    @if ($item->sex == 'masculino')
                        <img src="https://cdn.w600.comps.canstockphoto.com.br/nata%C3%A7%C3%A3o-banco-de-ilustra%C3%A7%C3%A3o_csp3405238.jpg"
                            alt="Movie" />
                    @else
                        <img src="https://cdn.w600.comps.canstockphoto.com.br/menino-nata%C3%A7%C3%A3o-banco-de-ilustra%C3%A7%C3%A3o_csp3981246.jpg"
                            alt="Movie" />
                    @endif
                </figure>
                <div class="flex flex-col py-6 text-sm">
                    <div>
                        <div class="badge badge-info mb-2">
                            Borbo
                            @isset($borbo)
                                @php
                                    $tb = explode(':',date("H:i:s", strtotime($borbo->record)));
                                @endphp
                                {{$tb[0]}}:{{$tb[1]}},{{$tb[2]}}
                            @endisset
                        </div>
                    </div>
                    <div>
                        <div class="badge badge-success mb-2">
                            Costa
                            @isset($costa)
                                @php
                                    $tc = explode(':',date("H:i:s", strtotime($costa->record)));
                                @endphp
                                {{$tc[0]}}:{{$tc[1]}},{{$tc[2]}}
                            @endisset
                        </div>
                    </div>
                    <div>
                        <div class="badge badge-warning mb-2">
                            Peito
                            @isset($peito)
                                @php
                                    $tp = explode(':',date("H:i:s", strtotime($peito->record)));
                                @endphp
                                {{$tp[0]}}:{{$tp[1]}},{{$tp[2]}}
                            @endisset
                        </div>
                    </div>
                    <div>
                        <div class="badge badge-error mb-2">
                            Craw
                            @isset($livre)
                                @php
                                    $tl = explode(':',date("H:i:s", strtotime($livre->record)));
                                @endphp
                                {{$tl[0]}}:{{$tl[1]}},{{$tl[2]}}
                            @endisset
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h2 class="card-title">{{ $item->nick }}</h2>
                    <p>{{ $item->name }}</p>
                    <div class="card-actions justify-end">

                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
