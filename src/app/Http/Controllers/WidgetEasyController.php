<?php

namespace Gsferro\WidgetEasy\Http\Controllers;

use Gsferro\WidgetEasy\Model\WidgetEasy;
use Illuminate\Http\Request;

/**
 * @author  Guilherme Ferro
 * @version 1.0
 * @data    13/03/2019
 * @funcao  Centralizar as requisições ajax retriever genericas atravez de actions enumerados
 * @params  use a route name retriever, ela recebe o nome da func que deve ser o mesmo nome do metodo que sera chamado
 *         dentro da classe, de uma forma generica.
 *
 */
class WidgetEasyController extends Controller
{
    private $modal;
    public function __invoke( Request $request )
    {
        // encapsulamento
        $dados = array_map( 'trim', $request->all() );
        #################
        # validações request
        // pegando o termo
        $method = $dados[ "method" ];
        if( blank( $method ) ) return redirect()->back();

        $this->modal = new WidgetEasy();
        return $this->$method($dados);
    }
    /////////////////////////////// Widget dashboard

    /**
     * faz a ação de inserir na tbl usuario_preferencia
     * @param array $dados
     * @return mixed|string|null
     */
    private function widgetInsere($dados = [])
    {
//        $dados = \Request::all();

        $valor = $dados[ "itens" ];
        switch( $dados[ 'opc' ] )
        {
            case 'hidden':
                $collum = "widget_hidden";
                $item   = $this->wgGet( "widget_hidden" );
                if( !is_numeric( $item ) )
                {
                    $_item = explode( ',', $item );
                    $exist = array_search( $dados[ "itens" ], $_item );

                    if( $exist !== false ) // se tiver retira
                        unset( $_item[ $exist ] );
                    else // senão insere
                        $_item[] = $dados[ "itens" ];

                    $valor = implode( ',', $_item );
                }
                break;
            case 'left':
                $collum = "widget_position_left";
                break;
            case 'right':
                $collum = "widget_position_right";
                break;
        }

        $user = $this->modal;
        if( $user->update( [ $collum => ( self::StringIsNotNull( $valor ) ? $valor : null ) ] ) ) return $valor;
        else
            return null;
    }

    private function widgetOpenAll()
    {
        return (int)$this->modal->update( [ 'widget_hidden' => null ] );
    }

    private function widgetReset()
    {
        return (int)$this->modal->update( [
            'widget_hidden'         => null,
            'widget_position_left'  => null,
            'widget_position_right' => null
        ] );
    }

    /**
     * faz a ação de retornar da tbl usuario_preferencia
     * @param array $dados
     * @return bool|int
     */
    private function widgetRetorna($dados = [])
    {
//        $dados = \Request::all();

        switch( $dados[ 'opc' ] )
        {
            case 'hidden':
                $collum = "widget_hidden";
                break;
            case 'left':
                $collum = "widget_position_left";
                break;
            case 'right':
                $collum = "widget_position_right";
                break;

            default:
                return false;
                break;
        }
        return $this->wgGet( $collum );
    }

    private function wgGet( $collum )
    {
        $reg = WidgetEasy::firstOrCreate( [ 'user_id' => auth()->user()->id ] );

        return ( self::StringIsNotNull( $reg[ $collum ] ) ? $reg[ $collum ] : 0 );
    }

    private static function StringIsNotNull( $str )
    {
        // se for null retorna direto
        if( is_null( $str ) ) return false;
        return ( strlen( trim( $str ) ) > 0 ? true : false );
    }
}
