@props(['team' => null, 'notdetail' => false])
<div>
    <button class="cursor-pointer text-gray-800 dark:text-gray-900" wire:click="send({{$team->id}})">
        <div class="flex items-center space-x-2" wire:key="{{ $team->id }}-team">
            @if ($team->team_photo_path)
                <img src="{{ $team->team_photo_path }}" alt="swimmingteam-avatar-{{ $team->name }}"
                    class="object-cover object-center w-16 h-16 rounded-full shadow-sm dark:bg-gray-500 dark:border-gray-700">
            @else
            <picture >
                <source srcset="{{ url('storage/logos/swimming.webp') }}" type="image/webp">
                <img class="object-cover object-center w-16 h-16 rounded-full shadow-sm dark:bg-gray-500 dark:border-gray-700" src="{{ url('logos/swimming.png') }}" alt="twam-swimming-logo">
            </picture>
            @endif
            <div>
                <h2 class="flex text-sm font-semibold leading-none items-center my-0 py-0">
                    <span class="my-0 py-0">{{ $team->name }}</span>
                </h2>
                <span class="inline-block text-xs leading-none dark:text-gray-900 mb-0 mt-0 py-0">
                    {{ '@' . $team->nick }}
                </span>
            </div>
        </div>
    </button>
</div>
