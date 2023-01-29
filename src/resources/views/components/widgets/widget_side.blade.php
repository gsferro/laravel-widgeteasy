{{-- sugestão usar col-lg 6 x 6 | 7 x 5 --}}
<div id="{{ $id }}" {{ $attributes->merge(["class" => "no-padding connectedSortable min-height-container "]) }}>
    {{ $slot }}
</div>