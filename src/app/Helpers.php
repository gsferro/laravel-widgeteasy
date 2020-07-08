<?php

namespace App;

/**
 * Classe para usar metodos estaticos como funções genericas de reuso em qualquer parte do sistema
 *
 * @author Guilherme Ferro
 * @email guilherme.ferro@fiocruz.br
 */
class Helpers
{
    /**
     * retorna uma string com a máscara desejada
     *
     * @param $valor
     * @return mixed
     */
    public static function removeMask( $valor )
    {
        if( !self::StringIsNotNull( $valor ) ) return $valor;

        $valor = str_replace( ".", "", $valor );
        $valor = str_replace( "-", "", $valor );
        $valor = str_replace( "/", "", $valor );
        return $valor;
    }

    /**
     * Valida String
     *
     * @param $str
     * @return bool
     */
    public static function StringIsNotNull( $str )
    {
        // se for null retorna direto
        if( is_null( $str ) ) return false;
        return ( strlen( trim( $str ) ) > 0 ? true : false );
    }

    //////////////////////////////////////////////
    /**
     * @autor  Guilherme Ferro
     * @import sistema NF-e v4.0
     */

    /**
     * @param $mask
     * @param $str
     * @return mixed
     */
    public static function mask( $mask, $str )
    {
        $str = str_replace( " ", "", $str );
        for( $i = 0; $i < strlen( $str ); $i++ ) $mask[ strpos( $mask, "#" ) ] = $str[ $i ];

        return $mask;
    }

    /**
     * Formatação data
     *
     * @param $formato
     * @param $_data
     * @return mixed|string
     */
    public static function FData( $formato, $_data )
    {
        if( !self::StringIsNotNull( $_data ) ) return $_data;

        $data = substr( $_data, 0, 10 );
        switch( $formato )
        {
            // 00/00/0000 => 0000-00-00
            case "db":
                return implode( '-', array_reverse( explode( '/', $data ) ) );
                break;
            // 0000-00-00 => 00/00/0000
            case "br":
                return implode( '/', array_reverse( explode( '-', $data ) ) );
                break;
        }
    }

    /**
     * recebe 2 valores e compara para colocar atributo no input select
     *
     * @param $value
     * @param $id
     * @return string default
     */
    public static function Sel( $value, $id )
    {
        return ( $value == $id ? 'selected' : '' );
    }

    /**
     * recebe 2 valores e compara com o id para colocar atributo selected no select
     *
     * @param $value
     * @param $valueTwo
     * @param $id
     * @return string default
     */
    public static function SelTwo( $value, $valueTwo, $id )
    {
        return ( ( $value == $id || $valueTwo == $id ) ? 'selected' : '' );
    }
}