<?php
/**
 * Created by PhpStorm.
 * User: hongq
 * Date: 5/5/2019
 * Time: 3:27 AM
 */

class MaziiBackend extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function getMinna($lesson_id=1){
//        $this->load->library('rest', ['server'=>'http://mina.mazii.net/api']);
//        $data = $this->rest->get("getKotoba.php","lessonid=$number");

        $this->load->library('curl');
        //$this->getVocabulary($lesson_id);
//
//        for( $i=46;$i<=50;$i++ ){
//            $this->getListen($i);
//            $this->getGrammar($i);
//        }
        die('end get data');

    }

    private function createStoreDirectory($lesson_id){
        $storeDir = sprintf(APPPATH.'..%s/%d','/modules/Grammar/Markdown/minna',$lesson_id);
        if( !is_dir($storeDir) ){
            mkdir($storeDir,777);
        }
        $storeDir = realpath($storeDir);

        if( !is_dir($storeDir) ){
            return false;
        }
        return $storeDir;
    }

    private function getVocabulary($lesson_id){
        $api = sprintf('http://mina.mazii.net/api/getKotoba.php?lessonid=%d',$lesson_id);
        $data = $this->curl->simple_get($api);
        if( strlen($data) > 0 ){
            $data = json_decode($data,true);
        }

        $storeDir = sprintf(APPPATH.'..%s/%d','/modules/Grammar/Markdown/minna',$lesson_id);

        if( !is_dir($storeDir) ){
            mkdir($storeDir,777);
        }
        $storeDir = realpath($storeDir);

        if( !is_dir($storeDir) ){
            return;
        }

        $vocabulary = $storeDir.DS."vocabulary.md";

        if( file_exists($vocabulary) ){
            die('file has exist');
        }

        write_file($vocabulary,'# Vocabulary'.PHP_EOL.PHP_EOL,'a+');
        write_file($vocabulary,'|Hiragana   | Romaji | Kanji | Mean |'.PHP_EOL,'a+');
        write_file($vocabulary,'|-----------|--------|:-----:|------|'.PHP_EOL,'a+');

        if( count($data) > 0 ) foreach ($data AS $row){
            $wordLine = sprintf('| %s| %s| %s| %s',$row['hiragana'],$row['roumaji'],$row['kanji'],$row['mean']);
            write_file($vocabulary,$wordLine.PHP_EOL,'a+');
        }
    }

    private function getListen($lesson_id){
        $api = sprintf('http://mina.mazii.net/api/getListenLession.php?lesson=%d&type=Kotoba',$lesson_id);
        $data = $this->curl->simple_get($api);
        if( strlen($data) > 0 ){
            $data = json_decode($data,true);
        }

        if( count($data) > 0 ) foreach ($data AS $row) {
            if( array_key_exists('link',$row) ){
                $url = sprintf("http://eup.mobi/apps/mina/listen/%s",$row['link']);
                $storeDir = $this->createStoreDirectory($lesson_id);
                $fileSave = $storeDir.DS.$row['link'];
                if( file_exists($fileSave) )
                    continue;
                //write_file($storeDir.DS.$row['link'], fopen($mp3, 'r'),'a+');
                $downloadFile = fopen($fileSave, "w");
                $handle = curl_init($url);
                // Tell cURL to write contents to the file.
                curl_setopt($handle, CURLOPT_FILE, $downloadFile);
                // Follow redirects.
                curl_setopt($handle, CURLOPT_FOLLOWLOCATION, true);
                // Do the request.
                curl_exec($handle);
                // Clean up.
                curl_close($handle);
                fclose($downloadFile);
            }

        }

    }

    private function getGrammar($lesson_id){
        $storeDir = $this->createStoreDirectory($lesson_id);

        $vocabulary = $storeDir.DS."grammar.md";

        if( file_exists($vocabulary) ){
            return false;
        }

        $api = sprintf('http://mina.mazii.net/api/getGrammar.php?lessonid=%d',$lesson_id);
        $data = $this->curl->simple_get($api);
        if( strlen($data) > 0 ){
            $data = json_decode($data,true);
        }

        write_file($vocabulary,'# Grammar'.PHP_EOL.PHP_EOL,'a+');
        if( count($data) > 0 ) foreach ($data AS $row){

            write_file($vocabulary,"## ".$row['name'].PHP_EOL.PHP_EOL,'a+');
            $row['content'] = str_replace(['$C$','$T$','$E$','$Y$'],'',$row['content']);
            write_file($vocabulary,$row['content'].PHP_EOL.PHP_EOL,'a+');
        }
    }
}