@if (!isset($this->selected) || $this->selected == self::$index)
    @teleport('#actions')
        <div class="flex gap-2">
            <div class="flex gap-2 hover:bg-neutral-600" wire:click="enter">
                {!! $firstCommand($slot) !!}
                <x-keycap>en</x-keycap>
            </div>
            <x-dropdown postion="right" :hidden="!$hasItems($slot)">
                <x-slot:head @keydown.meta.k.window.prevent="open">
                    Actions: <x-keycap>⌘</x-keycap> + <x-keycap>k</x-keycap>
                </x-slot:head>
                {{ $slot }}
            </x-dropdown>
        </div>
    @endteleport
@endif