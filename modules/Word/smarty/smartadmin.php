<?php
class word_smartadmin_ui extends SmartadminInputs {

    function __construct()
    {

    }

    static function input_words(array $params = null){
        $name = isset($params['name']) ? $params['name'] : NULL;
        $course = isset($params['course']) ? $params['course'] : NULL;
        $values = isset($params['value']) ? $params['value'] : NULL;

        if( empty($name) OR strlen($name) < 1 )
            return NULL;


        $html = "";

        if( !empty($values) && strlen($values) > 2 ){
            $values = unserialize($values);
            if( count($values) >0 ) foreach ($values AS $word){
                $html.= '<div class="row clearfix">'.self::input_word_row($name,$word).'</div>';
            }
        }

        $html.= '<div class="row clearfix">'.self::input_word_row($name).'</div>';

        $html.= '<section class="col-12"><a href="javascript:void(0);" class="btn btn-primary add-word" id="'.$name.'_add_line" ><i class="fa fa-gear"></i> Add Word</a></section>';
        $params['html'] = $html;
        return self::row_input($params);
    }

    private static function input_word_row($name,$id=0){
        $html = "";
        if( $id > 0 ){
            $word = get_instance()->Word_Model->get_item_by_id($id);
        } else {
            $word = (object)array(
                'kanji'=>null,
                'japanese'=>null,
                'romaji'=>null,
                'man_speak'=>null,
                'woman_speak'=>null,
                'english'=>NULL,
                'vietnamese'=>null,
                'id'=>0
            );
        }

        $romaji_params = array(
            'name'=>$name."[romaji][]",
            'txt_pre'=>'Rōmaji',
            'title'=>'romaji',
            'value'=>$word->romaji,
            'class'=>"$name-romaji"
        );
        $html.= '<section class="col col-3">'.parent::text_addon($romaji_params).'</section>';

        $kanji_params = array(
            'name'=>$name."[kanji][]",
            'icon'=>'fa-language',
            'title'=>'Kanji',
            'class'=>"$name-kanji",
            'value'=>$word->kanji
        );
        $html.= '<section class="col col-2">'.parent::text_addon($kanji_params).'</section>';

        $japan_params = array(
            'name'=>$name."[vn][]",
            'txt_pre'=>'VN',
            'title'=>'vietnamese',
            'class'=>"$name-vn vietnamese-input",
            'value'=>$word->vietnamese
        );
        $html.= '<section class="col col-3">'.parent::text_addon($japan_params).'</section>';

        $english_params = array(
            'name'=>$name."[en][]",
            'txt_pre'=>'EN',
            'title'=>'english',
            'class'=>"$name-en",
            'value'=>$word->english
        );
        $html.= '<section class="col col-3">'.parent::text_addon($english_params).'</section>';
        $html .= parent::input_hidden(['class'=>'words-id','name'=>$name."[id][]",'value'=>$word->id]);
        return $html;
    }

}