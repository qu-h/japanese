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
}