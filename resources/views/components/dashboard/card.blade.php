@props([
  'title',
  'value' => 0,
  'icon' => 'cube',         {{-- nombre del ícono heroicon --}}
  'badge' => null,
  'badgeColor' => 'bg-neutral-700',
  'subtitle' => null
])

<div class="bg-neutral-900 border border-neutral-800 rounded-xl p-4 flex flex-col gap-2 shadow">
  <div class="flex items-center justify-between">
    <div>
      <p class="text-sm text-neutral-400">{{ $title }}</p>
      <h3 class="text-2xl font-bold text-neutral-100">{{ $value }}</h3>
      @if($subtitle)
        <p class="text-xs text-neutral-500 mt-1">{{ $subtitle }}</p>
      @endif
    </div>

    {{-- Ícono (Heroicons) --}}
    <div class="text-indigo-400">
      @switch($icon)
        @case('package')
          <x-heroicon-o-cube class="w-6 h-6" />
          @break
        @case('truck')
          <x-heroicon-o-truck class="w-6 h-6" />
          @break
        @case('store')
          <x-heroicon-o-building-storefront class="w-6 h-6" />
          @break
        @case('clipboard-list')
          <x-heroicon-o-clipboard-document-list class="w-6 h-6" />
          @break
        @case('clock')
          <x-heroicon-o-clock class="w-6 h-6" />
          @break
        @case('calendar')
          <x-heroicon-o-calendar-days class="w-6 h-6" />
          @break
        @default
          <x-heroicon-o-cog-6-tooth class="w-6 h-6" />
      @endswitch
    </div>
  </div>

  @if($badge)
    <span class="self-start text-xs mt-2 px-2 py-1 rounded {{ $badgeColor }} text-neutral-100">
      {{ $badge }}
    </span>
  @endif
</div>
