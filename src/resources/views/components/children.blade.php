{{-- coloquei aqui os dados --}}
<div id="{{ $id }}"{{ $attributes->merge(["class" => "widget-easy widget-children"]) }}>
    <div class="box box-solid box-default">
        @isset($title)
            <div class="box-header with-border ui-sortable-handle">
                <h3 class="box-title">{{ $title }}</h3>
                @if(!empty($isRemovible))
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool hide-widget btn-flat" data-toggle="tooltip" title="{{ __('widget_actions.remove_children') }}" data-original-title="Excluir"><i class="fa fa-times"></i></button>
                    </div>
                @endif
            </div>
        @endisset
        <div class="box-body no-padding">
            {{ $slot }}
        </div>
    </div>
</div>
