<div>
    <x-header> EVOLUÇÃO DE {{ mb_strtoupper($athlete->nick) }}</x-header>
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
