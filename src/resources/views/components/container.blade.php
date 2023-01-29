<x-widget-actions />

<div id="widgets-easy" {{ $attributes->merge(["class" => "row hide-setting widget-easy-container"]) }} style="display: none;"
    <x-widget-side id="widgetLeft">
        {{ $left }}
    </x-widget-side>

    <x-widget-side id="widgetRight">
        {{ $right }}
    </x-widget-side>
</div>
