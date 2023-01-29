<x-widget_actions />

{{-- container de widgets para exibição --}}
<div id="widgets-easy"{{ $attributes->merge(["class" => "row hide-setting"]) }}>
    {{ $slot }}
</div>
