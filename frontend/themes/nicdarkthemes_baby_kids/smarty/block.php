<?php
class Nicdarkthemes_baby_kidsBlock extends CI_Smarty
{
    static function block_archive($params = []){
        $ci = get_instance();
        return $ci->smarty->view(APPPATH."views/block/archive.tpl",$params);
    }

    static function block_archive_button($params = []){
        $ci = get_instance();
        $data = $params;
        if( is_array($params['content']) && !empty($params['content']) ){
            $buttons = "";
            foreach ($params['content'] AS $val){
                $buttons .= Nicdarkthemes_baby_kidsButton::btn_text(['text'=>$val,'class'=>'border-1-w btn-shadow']);
            }
            $params['content'] = $buttons;
        }
        return $ci->smarty->view(APPPATH."views/block/archive.tpl",$params);
    }

    static function block_archive_list($params = []){
        $ci = get_instance();
        return $ci->smarty->view(APPPATH."views/block/archive-list.tpl",$params);
    }

    static function block_archive_group_items($params = []){
        $ci = get_instance();
        return $ci->smarty->view(APPPATH."views/block/archive-group-item.tpl",$params);
    }



}