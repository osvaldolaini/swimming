<div>
    <div class="grid sm:grid-cols-3 grid-cols-1 gap-4 ">
        @foreach ($athletes as $item)
        @php
            $livre = $this->times->where('athlete_id',$item->id)->where('modality_id',1)->first();
            $borbo = $this->times->where('athlete_id',$item->id)->where('modality_id',2)->first();
            $costa = $this->times->where('athlete_id',$item->id)->where('modality_id',3)->first();
            $peito = $this->times->where('athlete_id',$item->id)->where('modality_id',4)->first();
        @endphp
            <div class="grid sm:grid-cols-3 grid-cols-2 card card-side bg-base-100 shadow-xl px-1 ">
                <div class="hidden sm:flex items-stretch">
                    <figure >
                        @if ($item->sex == 'masculino')
                            <img  src="https://cdn.w600.comps.canstockphoto.com.br/nata%C3%A7%C3%A3o-banco-de-ilustra%C3%A7%C3%A3o_csp3405238.jpg"
                                alt="Movie" />
                        @else
                            <img  src="https://cdn.w600.comps.canstockphoto.com.br/menino-nata%C3%A7%C3%A3o-banco-de-ilustra%C3%A7%C3%A3o_csp3981246.jpg"
                                alt="Movie" />
                        @endif
                    </figure>
                </div>

                <div class="card-body px-0 px-1 ">
                    <h2 class="card-title">{{ $item->nick }}</h2>
                    <p>{{ $item->name }}</p>
                    <div class="card-actions justify-end">

                    </div>
                </div>
                <div class="flex flex-col py-6  mx-auto">
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
                        <div class="badge badge-error mb-2 w-full text-xs">
                            Craw
                            @isset($livre)
                            {{converTime($livre->record)}}
                            @endisset
                        </div>
                    </div>
                </div>

            </div>
        @endforeach
    </div>
</div>
