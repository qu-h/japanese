<?php

function han_in_string($word)
{

    setlocale(LC_ALL, "ja_JP.utf8");
    $data = ['kanji' => '', 'hiragana' => ''];
    $pattern_kanji = '/\p{Han}+/u';
    $pattern_hira = '/\p{Hiragana}+/u';

    //$pattern = '/([\p{Han}\p{Katakana}\p{Hiragana}]+)+([(])+([\p{Katakana}\p{Hiragana}])+([)])/u';


//        preg_match_all('/
//    ([\p{Han}\p{Katakana}\p{Hiragana}]+)    # Kanji
//    (?: [(]                                 # optional part: paren (
//    ([\p{Hiragana}]+)                       # Hiragana
//    [)] )?                                  # closing paren )
//    \s*=\s*                                 # spaces and =
//    ([\w\s;=]+)                             # English letters
//    /ux',
//            $word, $keywords, PREG_SET_ORDER
//        );

    preg_match($pattern_kanji, $word, $matches);
    if (isset($matches[0])) {
        $data['kanji'] = $matches[0];
    }
    preg_match($pattern_hira, $word, $matches);
    if (isset($matches[0])) {
        $data['hiragana'] = $matches[0];
        //$data['katakana'] =  mb_convert_kana($data['hiragana'], 'C', 'UTF-8');
    }

    return $data;
}