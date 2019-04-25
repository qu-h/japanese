<?php
class Nicdarkthemes_baby_kidsModifier extends CI_Smarty
{
    static function modifier_row_label($text,$label,$rightCol=3,$color='red'){
        $ci = get_instance();
        $col = [
            'right'=>2,
            'left'=>9
        ];
        $rightCol = intval($rightCol);
        if( $rightCol > 0 && $rightCol < 8 ){
            $col['right'] = $rightCol;
            $col['left'] = 12 - $rightCol;
        }
        return $ci->smarty->view(APPPATH."views/input/row-label.tpl",compact('text','label','col'));
    }
}