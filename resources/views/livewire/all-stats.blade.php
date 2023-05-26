<div>
    <div class="hero bg-gray-100 rounded-t-lg mb-5">
        <div class="hero-content flex-col lg:flex-row-reverse py-5 my-0">
            <H2 class="text-4xl font-black py-0 my-0">
                EVOLUÇÃO DE
                {{ mb_strtoupper($athlete->nick) }}
            </H2>
        </div>
    </div>
    <div class="grid gap-4 mb-1 sm:grid-cols-2 grid-cols-1 sm:gap-6 sm:mb-5">
        @if ($charts)
            @foreach ($charts as $key => $values)
                @livewire('all-stats-bar',
                    [
                        'times' => $values,
                        'prove' => $key
                    ]
                )
            @endforeach
        @endif
    </div>
</div>
