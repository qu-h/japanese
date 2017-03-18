<?php
function grammar_color($txt=NULL){
    $txt = str_replace('Hiragana', '<span class="color-hira">Hiragana</span>', $txt);
    $txt = str_replace('Katakana', '<span class="color-kata">Katakana</span>', $txt);
    $txt = str_replace('Kanji', '<span class="color-kanji">Kanji</span>', $txt);
    return $txt;
}