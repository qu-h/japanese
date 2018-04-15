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
            'class'=>"nicdark_btn_icon nicdark_bg_$background small nicdark_shadow nicdark_radius $color"
        ];
        return anchor(null,$text,$attribute);
    }

    static function btn_icon($params = []){
        $text = isset($params['text']) ? $params['text'] : null;
        $title = isset($params['title']) ? $params['title'] : null;
        $background = isset($params['bg']) ? $params['bg'] : 'grey';
        $color = isset($params['color']) ? $params['color'] : "";
        $icon = isset($params['icon']) ? $params['icon'] : "";

        $attribute = [
            'class'=>"nicdark_btn_icon nicdark_bg_$background small nicdark_shadow nicdark_radius $color",
            'rel'=>"nofollow"
        ];
        $icon = '<i class="icon-'.$icon.'"></i>';

        return "<a "._stringify_attributes($attribute).">$icon  ".lang($title)." : <span class=\"red\" style=\"font-size: 120%; font-weight: bold;\" >$text</span></a>";
    }
}