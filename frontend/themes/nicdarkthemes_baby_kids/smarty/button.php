<?php
class Nicdarkthemes_baby_kidsButton extends CI_Smarty
{
    static function btn_text($params){
        $text = isset($params['text']) ? $params['text'] : null;
        $uri = isset($params['uri']) ? $params['uri'] : null;
        $name = isset($params['bg']) ? $params['bg'] : 'red';
        //$color = isset($params['color']) ? $params['color'] : 'white';
        $class = isset($params['class']) ? $params['class'] : null;


        $attribute = [
            'class'=>"btn-$name-small-radius-shadow-mt10 $class"
        ];
        if( isset($params['class']) ){
            $attribute['class'] .= " ".$params['class'];
        }
        if( array_key_exists("target",$params) ){
            $attribute['target'] = $params['target'];
        }
        return anchor($uri,$text,$attribute);
    }

    static function btn_icon($params = []){
        $text = isset($params['text']) ? $params['text'] : null;
        $title = isset($params['title']) ? $params['title'] : null;
        $background = isset($params['bg']) ? $params['bg'] : 'grey';
        $color = isset($params['color']) ? $params['color'] : "";
        $icon = isset($params['icon']) ? $params['icon'] : "";

        $attribute = [
            'class'=>"btn-icon nicdark_bg_$background small nicdark_shadow nicdark_radius $color",
            'rel'=>"nofollow"
        ];
        $icon = '<i class="icon-'.$icon.'"></i>';
        if( isset($params['class']) ){
            $attribute['class'] .= " ".$params['class'];
        }
        if( in_array($background,['green','yellow']) ){
            $attribute['class'] .= " white";
        }

        //return "<a "._stringify_attributes($attribute).">$icon  ".lang($title)." : <span class=\"red\" style=\"font-size: 120%; font-weight: bold;\" >$text</span></a>";
        $content = $icon."  ".lang($title)." : <span class=\"red\" style=\"font-size: 120%; font-weight: bold;\" >$text</span>";
        return anchor(null,$content,$attribute);
    }

    static function btn_word($params){
        $word = array_key_exists('word',$params) ? $params['word'] : [];
        $params['text'] = $word['text'];
        $params['class'] = 'btn-zoom';
        return self::btn_text($params);
    }
}