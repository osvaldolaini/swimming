@props(['time','title'])

<div class="grid grid-flow-col gap-5 text-center auto-cols-max">
    {{ $title }}
    <div class="flex flex-col p-2 bg-neutral rounded-box text-neutral-content">
      <span class="countdown font-mono text-5xl">
        <span style="--value:{{ date("i", $time) }};"></span>
      </span>
      min
    </div>
    <div class="flex flex-col p-2 bg-neutral rounded-box text-neutral-content">
      <span class="countdown font-mono text-5xl">
        <span style="--value:{{ date("s", $time) }};"></span>
      </span>
      sec
    </div>
    <div class="flex flex-col p-2 bg-neutral rounded-box text-neutral-content">
        <span class="countdown font-mono text-5xl">
          <span style="--value:{{ date("u", $time) }};"></span>
        </span>
        sec
    </div>
</div>
