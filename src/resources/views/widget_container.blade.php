
@include('widgeteasyCSS')
@include('widgeteasyJS')
@include('odometer')

{{-- Plugin widget2.js --}}
@include('vendor/gsferro/widgeteasy/resources/views/widget_buttons')

{{-- container de widgets para exibição --}}
<div id="widgets" class="row" style=" display: none">
    {{-- sugestão usar col-lg 6 x 6 | 7 x 5 --}}
    <div id="widgetLeft" class="col-lg-6 no-padding connectedSortable" style="min-height: 500px;">
        {{-- exemplo de widget | mude o id --}}
        @widgetChild(["id" => "xxx"])
            {{-- coloquei aqui os dados --}}
        @endwidgetChild
    </div>
    <div id="widgetRight" class="col-lg-6 no-padding connectedSortable" style="min-height: 500px;">
        {{-- exemplo de widget | mude o id --}}
        @widgetChild(["id" => "xxx"])
            {{-- coloquei aqui os dados --}}
        @endwidgetChild
    </div>
</div>
<script>

    /* sugestão para usar o plugin Odometer */
    function getTotal( time )
    {
		$.ajax( {
			url      : '[coloquei aqui o route]' ,
			type     : 'get' ,
			dataType : "json" ,
			success  : function( data ) {
				// console.log( data );

                // plugin Odometer
				$.xxx.update( data.xxx );
			} ,
			error    : function( r ) {
				// console.log( r );
			}
		} )
    }

    $( function()
    {
		// plugin Odometer
        // $.xxx   = new Odometer( { el : document.querySelector( '#xxx' ) } );

        // getTotal();

        // para dar o tempo processamento do plugin widget
        $( '#widgets' ).show( 1000 );
    } );
</script>