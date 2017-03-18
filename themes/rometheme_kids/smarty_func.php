<?php

class rometheme_kids_ui
{

    function __construct()
    {

    }

    static function char($params = null)
    {
        $char = isset($params['c']) ? $params['c'] : NULL;
        $type = isset($params['type'])  ? $params['type'] : 'hiragana';

        if( strlen($char) > 0 ){
            $group =  config_item($type);
            if( !isset($group[$char]) )
                return NULL;

            return $group[$char];
        }
    }

    static function char_col($params = null)
    {
        $char = isset($params['c']) ? $params['c'] : NULL;
        $char_show = isset($params['c_view']) ? $params['c_view'] : NULL;
        $type = isset($params['type'])  ? $params['type'] : 'hiragana';
        $boxcolor = isset($params['boxcolor']) ? $params['boxcolor'] : NULL;

        if( strlen($char) > 0 ){
            $group =  config_item($type);

            if( !isset($group[$char]) )
                return NULL;

            $html = '<div class="col character '.$boxcolor.'">';

            $html.= '<span class="wr">'.$group[$char].'</span>';
            $html.= '<span class="r">'.strlen($char_show) >0 ? $char_show :$char.'</span>';

            $html.= '</div>';
            return $html;
        }



    }


}