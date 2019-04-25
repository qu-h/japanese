<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class GrammarBackend
 * @property REST $rest
 * @property Curl $curl
 */
class GrammarBackend extends Admin_Controller {

    function __construct()
    {
        parent::__construct();

        $this->fields = $this->Grammar_Model->fields();
    }

    /*
     * Frontend
     */
    function index(){
        return $this->items();
    }

    function item($alias=NULL){
        
        if( is_null($alias) ){
            $alias = $this->uri->segment(2);
        }
        $data['row'] = $this->Grammar_Model->get_item_by_alias($alias);

        temp_view('item',$data);
    }
    /*
     * Backend
     */
    var $table_fields = array(
        'id'=>array("#",2,true,'center'),
        'title'=>array("Title"),
        'grammar'=>array("Cấu Trúc"),
        'category'=>array("Danh Mục"),
        'actions'=>array(NULL,5,false),
    );


    function items(){
        if( $this->uri->extension =='json' ){
            return $this->items_json_data(array_keys($this->table_fields));
        }

        $data = array('fields'=>$this->table_fields,'columns_filter'=>true);
        //         $data['page_header'] = $this->template->view('layouts/page_header',null,true);
        $data['data_json_url'] = base_url($this->uri->uri_string().'.json',NULL);

        $data['columns_fields'] = "";
        foreach ($this->table_fields AS $k=>$f){
            /*
             * https://datatables.net/reference/option/columns.render
             */
            $col_data = "data:'$k'";
            $col_order = NULL;
            if( isset($f[2]) &&  $f[2] != true ){
                $col_order = ',"orderable": false';
            }
            $col_width = NULL;
            if( isset($f[1]) &&  is_numeric($f[1]) ){
                $col_width = ',"width": "'.$f[1].'%"';
            }
            $content_default = NULL;
            if( $k=='actions' ){
                $col_data = "data:null";
                $content_default = ', "defaultContent" : \'<button class="btn btn-xs btn-default" data-action="edit" ><i class="fa fa-pencil"></i></button>\'';
            }
            $data['columns_fields'] .= "{ $col_data $col_order $col_width $content_default},";
        }
        $data['columns_fields'] = substr($data['columns_fields'], 0,-1);


        temp_view('backend/datatables',$data);
    }

    private function items_json_data(){
        $this->Grammar_Model->items_json('edit');
    }

    public function form($id=0){

        if ($this->input->post()) {
            $formdata = array();
            foreach ($this->fields as $name => $field) {
                $this->fields[$name]['value'] = $formdata[$name] = $this->input->post($name);
            }

            $add = $this->Grammar_Model->update($formdata);
            if( $add ){
                set_error(lang('Success.'));
                redirect('admin/grammar');
            }

        } else {
            $item = $this->Grammar_Model->get_item_by_id($id);
            foreach ($this->fields AS $field=>$val){
                if( isset($item->$field) ){
                    $this->fields[$field]['value']=$item->$field;
                }
            }
        }

        $fields = $this->fields;
        temp_view('Grammar/form',compact('fields'));

    }


    public function Markdown($action=null,$id=0){
        switch ($action){
            case 'edit':
            case 'add':
                break;
            default:
                return $this->MarkdownDataTable();
                break;

        }
    }

    private function MarkdownForm(){

    }
    private function MarkdownDataTable(){
dd('show table');
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