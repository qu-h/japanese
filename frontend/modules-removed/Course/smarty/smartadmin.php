<?php

class course_smartadmin_ui extends smartadmin_ui
{

    static function input_conversation(array $params = null)
    {
        $name = isset($params['name']) ? $params['name'] : NULL;
        $course = isset($params['course']) ? $params['course'] : NULL;

        if (strlen($name) < 1)
            return NULL;

        $placeholder = isset($params['placeholder']) ? $params['placeholder'] : NULL;
        $maxlength = isset($params['maxlength']) ? $params['maxlength'] : 0;
        $value = isset($params['value']) ? $params['value'] : NULL;

        $html = NULL;
//         if (isset($params['label']) && strlen($params['label']) > 0) {
//             $html .= '<section class="smart-form" ><header>' . $params['label'] . '</header></section>';
//         }

        $db = get_instance()->db;
        $character_item = $db->select('id,name AS title')
            ->from('course_conversation_character')
            ->get();

        $conversations = $db->where('course', $course)->get('course_conversation');
        if( !is_object($conversations) ){
            bug($db->last_query());die;
        }
        if ($conversations->num_rows() > 0)
            foreach ($conversations->result() as $row) {
                $character = self::input_select_fromDB(array(
                    'name' => $name . "[character]",
                    'value' => $row->character,
                    'options' => $character_item->result()
                ));
                $txt_japan = self::input_text_addon_str(array(
                    'addon' => 'JP',
                    'value' => $row->content_jp,
                    'name' => $name . "[content_jp]"
                ));
                $txt_vn = self::input_text_addon_str(array(
                    'addon' => 'VN',
                    'value' => $row->content_vn,
                    'name' => $name . "[content_vn]"
                ));
                $txt_mp3 = self::input_text_addon_str(array(
                    'addon' => 'fa-check',
                    'value' => $row->mp3,
                    'name' => $name . "[mp3][]"
                ));

                $html .= '<div class="row"><div class="col-md-2">' . $character . '</div><div class="col-md-10">' . $txt_japan . $txt_vn . $txt_mp3 . '</div></div>';
            }

        $character = parent::input_select_fromDB(array(
            'name' => $name . "[character][]",
            'value' => '',
            'options' => $character_item->result()
        ));
        $txt_japan = self::input_text_addon_str(array(
            'addon' => 'JP',
            'value' => NULL,
            'name' => $name . "[content_jp][]"
        ));
        $txt_vn = self::input_text_addon_str(array(
            'addon' => 'VN',
            'value' => NULL,
            'name' => $name . "[content_vn][]"
        ));
        $txt_mp3 = self::input_text_addon_str(array(
            'addon' => 'fa-check',
            'value' => NULL,
            'name' => $name . "[mp3][]"
        ));
        $html .= '<div class="row"><section class="col col-3">' . $character . '</section><section class="col col-9">' . $txt_japan . $txt_vn . $txt_mp3 . '</section></div>';

        $params['html'] = $html;
        return self::input_lable($params);
    }
    
    static function input_vocabulary(array $params = null)
    {
        $name = isset($params['name']) ? $params['name'] : NULL;
        $course = isset($params['course']) ? $params['course'] : 0;
        
        if (strlen($name) < 1){
            return NULL;
        }
            
        
        $html = NULL;
        
        $word = self::input_text_addon_str(array(
                'addon' => 'JP',
                'value' => "",
                'name' => $name . "[word]"
        ));
        $html .= '<section class="col-md-3">' . $word . '</section><section class="col-md-9">' . self::input_tags(array('value' => "",'name' => $name . "[answer]")). '</section>';
        $params['html'] = $html;
        return self::input_lable($params);
    }
    
    static function input_japan_text(array $params = null, $input_only=false){
        $name = isset($params['name']) ? $params['name'] : NULL;
        if (strlen($name) < 1){
            return NULL;
        }
        $romaji_value = isset($params['value']) ? $params['value'] : NULL;
        $word = NULL;
        if( !empty($romaji_value) ){
            $ci = get_instance();
            if( class_exists("Word_Model") ){
                $word = $ci->Word_Model->get_item_by_romaji($romaji_value);
            }
            
        }
       
        $html = NULL;
        $multi_value = $input_only ? "[]" : NULL;
        $romaji = self::input_text_addon_str(array(
                'addon' => 'Romaji',
                'value' => $romaji_value,
                'name' => $name . "[romaji]$multi_value"
        ));
        $html .= '<section class="col-md-3">' . $romaji . '</section>';
        $hira = self::input_text_addon_str(array(
                'addon' => 'Hiragana',
                'value' => is_object($word) ? $word->hiragana : NULL,
                'name' => $name . "[hiragana]$multi_value",
                'class'=>"hirainput"
        ));
        
        $html .= '<section class="col-md-3">' . $hira . '</section>';
        $kata = self::input_text_addon_str(array(
                'addon' => 'Katakana',
                'value' => is_object($word) ? $word->katakana : NULL,
                'name' => $name . "[katakana]$multi_value"
        ));
        $html .= '<section class="col-md-3">' . $kata . '</section>';
        $kanji = self::input_text_addon_str(array(
                'addon' => 'Kanji',
                'value' => is_object($word) ? $word->kanji : NULL,
                'name' => $name . "[kanji]$multi_value"
        ));
        $html .= '<section class="col-md-3">' . $kanji . '</section>';
        $params['html'] = $html;
        if( $input_only ){
            return '<section class="col-md-12"><div class="row">'.$html.'</div></section>';
        }
        return self::input_lable($params);
    }
    
    static function input_japan_text_answer(array $params = null){
        $name = isset($params['name']) ? $params['name'] : NULL;
        if (strlen($name) < 1){
            return NULL;
        }
        $options = isset($params['value']) ? $params['value'] : NULL;
        $html = NULL;
        
        $k = 1;
        if( !empty($options) ){
            $options = unserialize($options);
            foreach ($options AS $romaji){
                $html .= self::input_japan_text(array("name"=>$name,"value"=>$romaji),true);
                $k++;
            }
        }
        $html .= self::input_japan_text(array("name"=>$name,"value"=>NULL),true);
        $html .= '<section class="col-md-12"><div class="row" >

<div class="btn-group">
    <a href="javascript:void(0)" class="btn btn-primary add-answer">
        <i class="fa fa-plus"></i> add new answer
    </a>
</div>

        </div></section>';
        
        $params['html'] = $html;
        return self::input_lable($params);
        
//         bug($options);
    }
}