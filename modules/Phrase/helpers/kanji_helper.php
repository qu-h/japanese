<?php

function kanjiCount($string){
    setlocale(LC_ALL, "ja_JP.utf8");


//    $string = "私の名前はマークです。私はテキサス大学を卒業しました。私はすしが大好きです。
//           私は漢字が好きです。";

    if( !is_string($string) )
        return [];

    $pattern = "/[a-zA-Z0-9０-９あ-んア-ンー。、？！＜＞： 「」（）｛｝≪≫〈〉《》【】
            『』〔〕［］・\n\r\t\s\(\)　]/u";
    $kanjiString = preg_replace($pattern, "", $string);

    $kanjiArray = preg_split("//u", $kanjiString, -1, PREG_SPLIT_NO_EMPTY);

    return array_unique($kanjiArray);

    $countedArray = array_count_values($kanjiArray);
    arsort($countedArray);

    foreach ($countedArray as $kanji => $count) {
        echo "$count $kanji <br/>";
    }
}