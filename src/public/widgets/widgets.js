/**
 * widgets2.js
 * @func reordenar as posiçoes das div e exibir/ocultar
 * @autor Guilherme Ferro
 * @data ultima atualização 15/03/2019
 * @version 3.1
 * @release Adaptado para salvar em banco via ajax as posições e os campos hidden
 * @release nesse pacth acertei ao reabrir tudo, salvar como hidden os que já estavam abertos
 * utilizando o metodo data retriever
 * @release 2.2.0 Adicionando duas colunas col-lg-7 (left) e col-lg-5 (right) tanto no banco como na chamada
 * dos metodos, o retorno passa a exigir o side ao invés do position
 * @release 2.2.1 consertado btn close widget (.hide-widget) para dps da ordenação
 * @release 2.2.3 consertado btn close all e open all
 * @release 3.0 adaptação para laravel RetrieverController
 * @release 3.0.1 na primeira exibição, manter como esta no html sem ordenação
 * @release 3.1 criado a opção de resetar configuraçoes widgetReset
 *
 * 5widgetInsere {opc , itens}
 * widgetOpenAll
 * widgetRetorna {opc} & func
 * exemplo:
 * ajaxData( 'widgetInsere' , { opc : 'side', itens : itens } );
 * ajaxData( 'widgetRetorna' , { opc : 'hidden' } , function( data )
 {
	 var localData = data.split(",");
	 ...
 } );
 * */
$( function() {
	/**
	 * Adds jQuery UI sortable portlet functionality to widgets
	 */
	$( '#widgets-easy' ).find( '#widgetLeft, #widgetRight' ).sortable( {
		// handle            : '.with-border' ,
		connectWith : '.connectedSortable' ,
		//cancel            : '#filter-ps' ,
		cursor            : 'move' ,
		opacity           : 0.7 ,
		scrollSensitivity : 3 ,
		//tolerance         : 'move' ,
		placeholder : 'portlet-placeholder ui-corner-all' ,
		stop        : function( event , ui ) {
			// console.log( event );
			// save widget order in localStorage
			var left  = [];
			var right = [];
			$( '.widget-easy' ).each( function() {
				var side = $( this ).parents( '.connectedSortable' ).attr( 'id' );
				let id   = $( this ).attr( 'id' );

				if( side == 'widgetLeft' )
					left.push( id );
				else
					right.push( id );
			} )
				.promise()
				.done( function() {
					// console.log( left.toString() );
					// console.log( right.toString() );

					ajaxData( 'widgetInsere' , { opc : 'left' , itens : left.toString() } );
					ajaxData( 'widgetInsere' , { opc : 'right' , itens : right.toString() } );
				} );
		}
	} ).disableSelection();

	// hide localstored hidden widgets
	keepWidgetHidden();

	// keep widgets ordered
	keepWidgetOrdered();
} );

/**
 * Import function dataretriver ajaxData
 * */
function ajaxData( method , args , acao )
{
	if( !$.isFunction( acao ) ) acao = function() {};

	if( !$.isPlainObject( args ) ) args = {};

	let arg = $.extend( args , {
		'method' : method
	} );

	$.get( '/widget-easy' , arg , acao , 'text' );
}

/**
 *
 * Widget hide functionality
 *
 **/

	// general cached DOM objects
	// let closedWidgetCount = $( '#closed-widget-count' );
	// let closedWidgets     = $( '#closed-widget-list' );
let allWidgets        = $( '.widget-easy' );

// unhide closed widget
$( document ).on( 'click' , '#open' , function() {
	// cache DOM objects/data used in this function
	var widgetIdentifier = $( this ).data( 'id' );
	var widget           = $( '#' + widgetIdentifier );
	var navItem          = $( this ).parent();

	openWidget( widget , widgetIdentifier , 500 );

	// remove item from closed-widget-list
	navItem.remove();
} );

function openWidget( widget , widgetIdentifier , speed )
{
	// decrement closed-widget-count
	if( widget.is( ':hidden' ) )
		$( '#closed-widget-count' ).text( Number( $( '#closed-widget-count' ).text() ) - 1 );
	else
		return;

	// unhide widget
	widget.show( 500 );

	// remove widget_hidden
	ajaxData( 'widgetInsere' , { opc : 'hidden' , itens : widgetIdentifier } );
}

function hideWidget( widget , speed , remove )
{
	// cache DOM objects/data used in this function
	var widgetName       = widget.find( '.box-header h3' ).text() || widget.find( '.inner p' ).text();
	var widgetIdentifier = widget.attr( 'id' );

	console.log( widgetIdentifier );
	console.log( widgetName );

	// update count
	if( !widget.is( ':hidden' ) )
		$( '#closed-widget-count' ).text( Number( $( '#closed-widget-count' ).text() ) + 1 );

	// hide widget from DOM
	widget.hide( speed );

	// add to hidden list
	$( '#closed-widget-list' ).append( '<li><a href="javascript:void(0)" id="open" class="open-widget" data-id="' + widgetIdentifier + '"><i class="fa fa-external-link-square fa-flip-horizontal fa-fw"></i> ' + widgetName + '</a></li>' );

	// remove true
	remove && ajaxData( 'widgetInsere' , { opc : 'hidden' , itens : widgetIdentifier } );
}

function keepWidgetHidden()
{
	ajaxData( 'widgetRetorna' , { opc : 'hidden' } , function( data ) {
		if( data != 0 )
		{
			var localData = data.split( ',' );
			$.each( localData , function( i , value ) {
				hideWidget( $( '#' + value ) , 0 , false );
			} );
		}
	} );
}

function keepWidgetOrdered()
{
	getSide( 'left' , '#widgetLeft' );
	getSide( 'right' , '#widgetRight' );
}

function getSide( side , sideId )
{
	ajaxData( 'widgetRetorna' , { opc : side } , function( data )
	{
		var count = 1;
		if( data != 0 )
		{
			var localData = data.split( ',' );
			// console.log( typeof localData );
			count         = 0;
			$.each( localData , function( i , value ) {
				count++;
				let widgetId = '#' + value;
				let numOrder = i++;

				let elem = $( '#widgets-easy' ).find( widgetId );

				elem.attr( 'data-order' , numOrder );
				elem.attr( 'data-side' , side );

				count--;
			} );
		}
		else
		{
			count = 0;
			// var otherSide = (side == 'left' ? 'right' : 'left');
			// var otherSide = (side == 'left' ? 'right' : 'left');
			//console.log( 'other side: ' + otherSide);
			$( '#widgets-easy' ).find( sideId ).find( '.widget-easy' ).attr( 'data-side' , side );
		}

		var order = setInterval( function() {
			if( side == 'right' && (count == 0 || data == 0) ){
				realOrder( order );
			}
		} , 1 );
	} );
}

function realOrder( order )
{
	clearInterval( order );

	// Seleciona as divs que queremos ordenar
	var widgets = $( '#widgets-easy' );

	var left  = widgets.find( '#widgetLeft' );
	var right = widgets.find( '#widgetRight' );

	// get other side
	var rightInLeft = left.find( '.widget-easy[data-side="right"]' );
	var leftInRight = right.find( '.widget-easy[data-side="left"]' );

	// remove side wrong
	$( rightInLeft ).remove();
	$( leftInRight ).remove();
	// add side right
	$( '#widgetRight' ).append( rightInLeft );
	$( '#widgetLeft' ).append( leftInRight );

	orderSide( left.find( '.widget-easy' ) , '#widgetLeft' );
	orderSide( right.find( '.widget-easy' ) , '#widgetRight' );

	// hide / close widget function
	$( '.hide-widget' ).on( 'click' , function() {
		var widget = $( this ).parents( '.widget-easy' );
		hideWidget( widget , 300 , true );
	} );

	showContainer();
}

function orderSide( divs , sideId )
{
	// Converte a NodeList de divs para array
	// https://developer.mozilla.org/en/docs/Web/API/NodeList#How_can_I_convert_NodeList_to_Array.3F
	var ordem = [].map.call( divs , function( element ) {
		return element;
	} );

	// Ordena a array pelo atributo 'order'
	ordem.sort( function( a , b ) {
		var ca = parseInt( a.getAttribute( 'data-order' ) , 10 );
		var cb = parseInt( b.getAttribute( 'data-order' ) , 10 );
		return ca - cb;
	} );

	// Reinsere os filhos no pai, resultando na ordem desejada
	for( var i = 0 ; i < ordem.length ; i++ )
		$( '#widgets-easy' ).find( sideId ).append( ordem[ i ] );
}

function showContainer()
{
	// dps de atualizar
	$( '#widgets-easy' ).show( "fast" );
}

///////////////////////////////////////////// BTN ACTIONS
$( function() {
	$( '#theme-setting' ).on( 'click' , function() {
		console.log( 'click' );
		var setting  = $( '#theme-setting' );
		var setting2 = $( '#theme-setting2' );

		if( setting.hasClass( 'show-setting' ) )
		{
			setting.addClass( 'hide-setting' );
			setting.removeClass( 'show-setting' );

			setting2.addClass( 'show-setting' );
			setting2.removeClass( 'hide-setting' );
		}
	} );

	$( '#close-setting' ).on( 'click' , function() {
		var setting  = $( '#theme-setting' );
		var setting2 = $( '#theme-setting2' );

		if( setting2.hasClass( 'show-setting' ) )
		{
			setting2.addClass( 'hide-setting' );
			setting2.removeClass( 'show-setting' );

			setting.addClass( 'show-setting' );
			setting.removeClass( 'hide-setting' );
		}
	} );

	// Close all widgets
	$( '#close-all-widgets' ).on( 'click' , function() {
		var widgetNames = [];
		$( '.widget-easy' ).each( function() {
			if( $( this ).is( ':visible' ) )
			{
				var widget = $( this );
				if (!! widget.find('div.box-tools').length)
				{
					// encapsulando em array
					widgetNames.push( widget.attr( 'id' ) );
					// colocando hide
					widget.hide( 400 );
					// pega as informações
					var widgetName       = widget.find( '.box-header h3' ).text() || widget.find( '.inner p' ).text();
					var widgetIdentifier = widget.attr( 'id' );
					// add to hidden list
					$( '#closed-widget-list' ).append( '<li><a href="javascript:void(0)" id="open" class="open-widget" data-id="' + widgetIdentifier + '"><i class="fa fa-external-link-square fa-flip-horizontal fa-fw"></i> ' + widgetName + '</a></li>' );
				}
			}
		} ).promise().done( function() {
			// ação somente se tiver alguem a ser fechado
			if( widgetNames.length > 0 )
			{
				$( '#closed-widget-count' ).text( $( '#closed-widget-list' ).find( 'li' ).length );
				ajaxData( 'widgetInsere' , { opc : 'hidden' , itens : widgetNames.toString() } );
			}
		} );
	} );

	// Open all widgets
	$( '#open-all-widgets' ).on( 'click' , function() {
		$( '.widget-easy' ).each( function() {
			var widget = $( this );
			// exibe
			widget.show( 500 );

			// limpando contadores
			$( '#closed-widget-list' ).empty();
			$( '#closed-widget-count' ).text( 0 );

		} ).promise().done( function() {
			ajaxData( 'widgetOpenAll' );
		} );
	} );

	// Open all widgets
	$( '#reset-widgets' ).on( 'click' , function() {
		ajaxData( 'widgetReset' , {} , function( r ) {
			r && location.reload();
		} );
	} );
} );

