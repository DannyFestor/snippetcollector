@props(['color', 'bgcolor', 'bordercolor'])

<span {{ $attributes->merge([
    'class'=> 'rounded px-2 py-1 text-xs cursor-pointer'
]) }}
      style="color: {{ $color }}; background-color: {{ $bgcolor }}; border: 1px solid {{ $bordercolor }}"
>
    {{ $slot }}
</span>
