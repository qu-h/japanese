<?php
class Nicdarkthemes_baby_kidsButton extends CI_Smarty
{
    static function btn_text($params = []){
        $text = isset($params['text']) ? $params['text'] : null;
        $background = isset($params['bg']) ? $params['bg'] : 'red';
        $color = isset($params['color']) ? $params['color'] : 'white';
        if( $background =='grey' || $background == 'grey2' ){
            $color = "";
        }
        $attribute = [
            'class'=>"btn-icon small btn-zoom radius5 nicdark_bg_$background $color"
        ];
        if( isset($params['class']) ){
            $attribute['class'] .= " ".$params['class'];
        }
        return anchor(null,$text,$attribute);
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
}