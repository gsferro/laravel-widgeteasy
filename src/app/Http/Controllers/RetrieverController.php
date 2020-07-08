<?php

namespace Gsferro\WidgetEasy\Http\Controllers;

use App\Helpers;
use App\Model\UsuariosPreferencias;
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
    public function __invoke( Request $request )
    {
        // encapsulamento
        $dados = array_map( 'trim', $request->all() );
        #################
        # validações request
        // pegando o termo
        $method = $dados[ "method" ];
        if( blank( $method ) ) return $this->sendError( "Pesquisa obrigatório!" );

        return $this->$method($dados);
    }
    /////////////////////////////// Widget dashboard
    /**
     * faz a ação de inserir na tbl usuario_preferencia
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
                    //			echo $exist;
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

        $user = UsuariosPreferencias::find( session( 'usuario' )[ "login" ] );
        if( $user->update( [ $collum => ( Helpers::StringIsNotNull( $valor ) ? $valor : null ) ] ) ) return $valor;
        else
            return null;
    }

    private function widgetOpenAll()
    {
        return (int)UsuariosPreferencias::find( session( 'usuario' )[ "login" ] )->update( [ 'widget_hidden' => null ] );
    }

    private function widgetReset()
    {
        return (int)UsuariosPreferencias::find( session( 'usuario' )[ "login" ] )->update( [
            'widget_hidden'         => null,
            'widget_position_left'  => null,
            'widget_position_right' => null
        ] );
    }

    /**
     * faz a ação de retornar da tbl usuario_preferencia
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
        $reg = UsuariosPreferencias::firstOrCreate( [ 'login' => session( 'usuario' )[ "login" ] ] );

        return ( Helpers::StringIsNotNull( $reg[ $collum ] ) ? $reg[ $collum ] : 0 );
    }
}
