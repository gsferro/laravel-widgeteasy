<x-widget_actions />

<div id="widgets-easy" {{ $attributes->merge(["class" => "row hide-setting widget-easy-container"]) }}>
    <x-widget_side id="widgetLeft">
        {{ $left }}
    </x-widget_side>

    <x-widget_side id="widgetRight">
        {{ $right }}
    </x-widget_side>
</div>
