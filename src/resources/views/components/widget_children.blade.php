{{-- coloquei aqui os dados --}}
<div id="{{ $id }}"{{ $attributes->merge(["class" => "widget-easy widget-children"]) }}>
    {{ $slot }}
</div>
