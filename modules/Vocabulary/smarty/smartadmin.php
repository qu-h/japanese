<?php
class vocabulary_smartadmin_ui extends smartadmin_ui {

    function __construct()
    {

    }

    static function input_vocabulary(array $params = null){
        $name = isset($params['name']) ? $params['name'] : NULL;
        $course = isset($params['course']) ? $params['course'] : NULL;
        $values = isset($params['value']) ? $params['value'] : NULL;

        if( empty($name) OR strlen($name) < 1 )
            return NULL;


        $html = "";

        if( !empty($values) ){
            $values = unserialize($values);
            if( count($values) >0 ) foreach ($values AS $word){
                $html.= '<div class="row clearfix">'.self::input_vocabulary_row($name,$word).'</div>';
            }
        }

        $html.= '<div class="new_row row clearfix">'.self::input_vocabulary_row($name).'</div>';
        $html.= '<section class="col-12"><a href="javascript:void(0);" class="btn btn-primary" id="'.$name.'_add_line" ><i class="fa fa-gear"></i> Add Vocabulary</a></section>';
        $params['html'] = $html;
        return self::input_lable($params);
    }

    private static function input_vocabulary_row($name,$txt=null){
        $html = "";
        if( strlen($txt) > 0 ){
            $word = get_instance()->Vocabulary_Model->get_course_row($txt);
        } else {
            $word = (object)array('kanji'=>null,'japanese'=>null,'romaji'=>null,'man_speak'=>null,'woman_speak'=>null,'english'=>NULL);
        }
        $kanji_params = array(
            'name'=>$name."[kanji][]",
            'icon'=>'fa-language',
            'value'=>$word->kanji
        );
        $html.= '<section class="col col-2">'.parent::text_addon($kanji_params).'</section>';

        $japan_params = array(
            'name'=>$name."[jp][]",
            'icon'=>'fa-language',
            'value'=>$word->japanese
        );
        $html.= '<section class="col col-3">'.parent::text_addon($japan_params).'</section>';

        $romaji_params = array(
            'name'=>$name."[romaji][]",
            'txt_pre'=>'Rōmaji',
            'value'=>$word->romaji
        );
        $html.= '<section class="col col-3">'.parent::text_addon($romaji_params).'</section>';

//         $mp3_params = array(
//             'name'=>$name."[mp3][]",
//             'icon'=>'fa-file-sound-o',
//             'value'=>$word->man_speak
//         );
//         $html.= '<section class="col col-3">'.parent::text_addon($mp3_params).'</section>';

        $english_params = array(
            'name'=>$name."[english][]",
            'txt_pre'=>'EN',
            'value'=>$word->english
        );
        $html.= '<section class="col col-3">'.parent::text_addon($english_params).'</section>';

        return $html;
    }
}