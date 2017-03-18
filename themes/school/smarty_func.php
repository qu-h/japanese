<?php

class school_ui
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
        $type = isset($params['type'])  ? $params['type'] : 'hiragana';

        if( strlen($char) > 0 ){
            $group =  config_item($type);
            if( !isset($group[$char]) )
                return NULL;

            $html = '<div class="col character rounded">';
            $html.= '<span class="wr">'.$group[$char].'</span>';
            $html.= '<span class="r">'.$char.'</span>';
            $html.= '</div>';
            return $html;
        }
    }

    static function notification($params = null)
    {
        $html = NULL;

        $session = get_instance()->session;
        if ($session->flashdata('error')) {
            $html .= self::msg(array(
                'content' => $session->flashdata('error')
            ));
        }

        return $html;
    }

    static function msg($params = null)
    {
        $content = isset($params['content']) ? $params['content'] : '';

        $html = '<div class="alert alert-block alert-success">
            	<a href="#" data-dismiss="alert" class="close">�</a>
            	<h4 class="alert-heading"><i class="fa fa-check-square-o"></i> Check validation!</h4>
            	<p>' . $content . '</p>
            </div>';
        return $html;
    }


}