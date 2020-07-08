@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('js')
    @parent
    <link rel="stylesheet" href="{{ asset("resources/widgets/widgets.css") }}">
    <script type="text/javascript" src="{{ asset("resources/widgets/widgets2.js") }}"></script>
@stop


@section('content')
    <p>You are logged in!</p>

    {{-- Plugin widget2.js --}}
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

    {{-- sugestão para informar como usar --}}
    <div class="row hidden-xs">
        <div class="col-xs-12">
            <h4 class="text-muted text-center">(Widgets ordenaveis por 2 colunas - clique no elemento e arraste)</h4>
        </div>
    </div>

    {{-- container de widgets para exibição --}}
    <div id="widgets" class="row" style=" display: none">
        {{-- sugestão usar col-lg 6 x 6 | 7 x 5 --}}
        <div id="widgetLeft" class="col-lg-6 no-padding connectedSortable" style="min-height: 500px;">
            {{-- exemplo de widget | mude o id --}}
            <div id="xxx" class="widget col-md-6 col-sm-6 col-xs-12">
                {{-- coloquei aqui os dados --}}
            </div>
        </div>
        <div id="widgetRight" class="col-lg-6 no-padding connectedSortable" style="min-height: 500px;">
            {{-- exemplo de widget | mude o id --}}
            <div id="xxx" class="widget col-md-6 col-sm-6 col-xs-12">
                {{-- coloquei aqui os dados --}}
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>

		/* sugestão para usar o plugin Odometer */
		function getTotal( time )
		{
			Pace.ignore( function()
			{
				$.ajax( {
					url      : '[coloquei aqui o route]' ,
					type     : 'get' ,
					dataType : "json" ,
					success  : function( data ) {
						// console.log( data, data.nfe );
						$.xxx.update( data.xxx );
					} ,
					error    : function(  ) {
						$.notify( {
							icon    : 'fa fa-exclamation-triangle fa-lg fa-fw' ,
							title   : '<strong>Atenção:</strong>' ,
							message : 'Ops... Tivemos um problema inesperado! <strong><span class="text-center">Tente novamente!</span></strong>'
						} , {
							type  : 'danger' ,
							delay : 1000 ,
						} );
					}
				} )
			});
		}

		$( function()
		{
			// total
			$.xxx   = new Odometer( { el : document.querySelector( '#xxx' ) } );

			getTotal();

			// para dar o tempo processamento do plugin widget
			$( '#widgets' ).show().animation( 'fadeInDownBig' );

			// sugestão - somente para dashboard, colocar conteiner-fluid
			$( '.container' ).toggleClass( 'container' , 'container-fluid' );
		} );
    </script>
@stop