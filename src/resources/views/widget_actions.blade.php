<div class="row">
    <div id="theme-setting" class="show-setting" data-toggle="tooltip"
         title="Preferência de exibição das widgets do Dashboard" data-placement="bottom">
        <a href="javascript:void(0)">
            <i class="fa fa-chevron-circle-left fa-2x"></i>
        </a>
        <ul style="display: none;"></ul>
    </div>
    <div id="theme-setting2" class="hide-setting">
        <a href="javascript:void(0)">
            <i id="close-setting" class="fa fa-chevron-circle-right fa-2x" data-toggle="tooltip" title="Ocultar" data-placement="top"></i>
        </a>
        <ul class="fa-ul">
            <li>
                <span onclick="location.reload()">
                    <i class="fa fa-refresh fa-lg text-primary fa-fw"></i> Atualizar Painel
                </span>
            </li>
            <li class="li-hr"></li>
            <li>
                <span id="close-all-widgets">
                    <i class="fa fa-times-circle fa-lg text-danger fa-fw"></i> Fechar todos
                </span>
            </li>
            <li>
                <span id="open-all-widgets">
                    <i class="fa fa-plus-circle fa-lg text-success fa-fw"></i> Abrir todos
                </span>
            </li>
            <li>
                <span id="reset-widgets">
                    <i class="fa fa-recycle fa-lg text-muted fa-fw"></i> Resetar
                </span>
            </li>
            <li class="li-hr"></li>
            <li class="close-count">
                Fechados: <span id="closed-widget-count">0</span>
            </li>
            <ul id="closed-widget-list" class="fa-ul"></ul>
        </ul>
    </div>
</div>