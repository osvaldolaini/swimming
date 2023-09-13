@props(['time', 'title','old'=>null])

<div class="grid grid-flow-col gap-5 text-center auto-cols-max">
    <div
        class="flex items-center px-2 py-1 {{ $title > 3 ? 'bg-red-500' : 'bg-green-500' }}
        rounded-box text-neutral-content">
        <span class="py-2">Equipe {{ $title }}</span><br>
    </div>
    <div class="flex flex-col px-2 py-1 bg-neutral rounded-box text-neutral-content">
        <span class="font-mono text-4xl sm:text-5xl">
            <span>{{$time}}</span>
        </span>
    </div>

</div>
@if ($old)
<div class="flex items-center px-2 py-1 bg-gray-800 justify-center rounded-box text-neutral-content">
    <span > ( {{ $old }} anos)</span>
</div>
@endif

