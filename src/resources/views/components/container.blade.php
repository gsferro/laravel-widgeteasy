<x-widget-easy-actions />

<div id="widgets-easy" {{ $attributes->merge(["class" => "row hide-setting widget-easy-container"]) }} style="display: none;">
    <x-widget-easy-side id="widgetLeft">
        {{ $left }}
    </x-widget-easy-side>

    <x-widget-easy-side id="widgetRight">
        {{ $right }}
    </x-widget-easy-side>
</div>
