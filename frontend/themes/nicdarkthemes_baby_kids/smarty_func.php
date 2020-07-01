<?php

class nicdarkthemes_baby_kids_ui
{

    function __construct()
    {
        $ci = get_instance();
        if( !method_exists($ci, 'db') ){
            $ci->load->database();
        }
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

            $ci = get_instance();
            if( !method_exists($ci, 'db') ){
                $ci->load->database();
            }

            $character = $ci->db->where(array("type"=>$type,'romaji'=>$char))->get("characters")->row();

            if( empty($character) )
                return NULL;

            if( strlen($character->code) > 0 ){
                $char_code = $character->code;
            } else {
                $char_code = $character->romaji;
            }

            $html = '<div class="col character '.$boxcolor.'">';

            $html.= '<span class="wr">'.$character->character.'</span>';
            $html.= '<i class="write icon-brush"></i>';
            $html.= '<i class="listen icon-volume-up" code="'.$char_code.'" ></i>';

            $html.= '<span class="r" code="'.$char_code.'">'.( strlen($char_show) >0 ? $char_show : $char).'</span>';

            $html.= '</div>';
            return $html;
        }
    }

    static function kata_col($params = null){
        $params['type'] =  'katakana';
        return self::char_col($params);
    }

    static function mainmenu_items(){
        $ci = get_instance();
        if( !method_exists($ci, 'db') ){
            $ci->load->database();
        }

        $db = $ci->db;

        //current-menu-ancestor current-menu-parent current_page_parent current_page_ancestor
        $frontend_menu = $db->where(array('parent'=>0,'backend'=>0,'status'=>1))->get('menus');
        $html = "";
        if( $frontend_menu->num_rows() > 0 ) foreach ($frontend_menu->result() AS $level1){
            $level1->uri = $level1->uri == 'homepage' ? base_url() : $level1->uri;
            $menuHtml = anchor($level1->uri,$level1->name,array('class'=>"sf-with-ul") );
            $submenu = $db->where(array('parent'=>$level1->id))->get('menus');
            if( $submenu->num_rows() > 0 ){
                $menuHtml .= '<ul class="sub-menu" >';
                $class_level3 = NULL;
                foreach ($submenu->result() AS $level2){
                    $menu2Html = anchor($level2->uri,$level2->name);
                    $submenu3 = $db->where(array('parent'=>$level2->id))->get('menus');

                    if( $submenu3->num_rows() > 0 ){
                        $menu2Html .= '<ol>';
                        $class_level3 = 'nicdark_megamenu  mm_grid_2';
                        foreach ($submenu3->result() AS $level3){
                            $menu2Html .= '<li>'.anchor($level3->uri,$level3->name).'</li>';
                        }
                        $menu2Html .= '</ol>';
                        $menuHtml .= '<li class="mm_grid_3 menu-item-has-children mm_grid " >'.$menu2Html.'</li>';
                    } else {

                        $menuHtml .= '<li>'.$menu2Html.'</li>';
                    }

                }
                $menuHtml .= "</ul>";

                $html .= '<li class="'.$level1->icon.' menu-item menu-item-has-children '.$class_level3.'">'.$menuHtml.'</li>';
            } else {
                $html .= '<li class="'.$level1->icon.' menu-item">'.$menuHtml.'</li>';
            }
        }
        return $html;


    }
    static function japan_hira($params = null){
        $txt = isset($params['txt']) ? $params['txt'] : NULL;
        $txt_read = isset($params['read']) ? $params['read'] : NULL;
        $html = '';        

        $var = explode(PHP_EOL, $txt);
        $hiragana =  config_item('hiragana');
        $katakana =  config_item('katakana');
        if( count($var) > 0 ) foreach ($var as $value) {
            if( strlen($value) > 0 ){
                $char_out = "";

                $chars = preg_split('//u',$value, -1, PREG_SPLIT_NO_EMPTY);
                if( count($chars) > 0 ){
                    foreach ($chars as $c) {
                        if( in_array($c, $hiragana) ){
                            $char_out .= "<span class=\"hira\">$c</span>";
                        } elseif ( in_array($c, $katakana) ){
                            $char_out .= "<span class=\"kata\">$c</span>";
                        } else {
                            $char_out .= "<span class=\"kanji\">$c</span>";
                        }
                    }
                } else {
                    $char_out = $value;
                }
                $html .= "<p class=\"japan_hira\" >$char_out</p>";    
            }
            
        }

        $read_var = explode(PHP_EOL, $txt_read);
        if( count($read_var) > 0 ) foreach ($read_var as $value) {
            if( strlen($value) > 0 )
            $html .= "<span class=\"japan_read\" >$value</span>";
        }
        return $html;
    }
    

}