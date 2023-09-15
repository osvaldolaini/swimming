<div>
    <div class="w-full p-2 grid grid-cols-1 gap-4 ">
        <div class="stats stats-vertical lg:stats-horizontal shadow">
            <div class="stat">
                <div class="stat-title">Clubes</div>
                <div class="stat-value">{{ $this->teams }}</div>
                {{-- <div class="stat-desc">↘︎ 90 (14%)</div> --}}
            </div>
            <div class="stat">
                <div class="stat-title">Atletas</div>
                <div class="stat-value">{{ $this->athletes }}</div>
                {{-- <div class="stat-desc">↘︎ 90 (14%)</div> --}}
            </div>
            <div class="stat">
                <div class="stat-title">Coordenadores</div>
                <div class="stat-value">{{ $this->head }}</div>
                {{-- <div class="stat-desc">↘︎ 90 (14%)</div> --}}
            </div>
            <div class="stat">
                <div class="stat-title">Treinadores</div>
                <div class="stat-value">{{ $this->coachs }}</div>
                {{-- <div class="stat-desc">↘︎ 90 (14%)</div> --}}
            </div>
            <div class="stat">
                <div class="stat-title">Tempos</div>
                <div class="stat-value">{{ $this->times }}</div>
            </div>

        </div>
    </div>
</div>
