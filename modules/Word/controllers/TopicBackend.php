<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class TopicBackend
 * @property TopicModel $TopicModel
 * @property TopicModel()->$topic_fields $fields
 */
class TopicBackend extends Admin_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('TopicModel');
        $this->load->smarty("Word/smartadmin");
        add_site_structure('word/topic/',lang("Topics") );

        set_temp_val('uri_add','word/topic/add' );
        add_git_assets("wanakana.min.js","input-method/wanakana",null,null,false);
        add_git_assets("vime.js","input-method/vime",null,null,false);
    }

    public function index(){
        return $this->items();
    }

    public function add(){
        return $this->form();
    }

    public function edit($id){
        return $this->form($id);
    }

    public function form($id=0){
        $fields = $this->TopicModel->fields();
        if ($this->input->post()) {
            $formData = [];
            if( input_post('btn-crawler') && input_post('id') < 1 && input_post('source') != ''  ){
                $fields = $this->Crawler($fields);
            } else {
                foreach ($fields as $name => $field) {
                    $fields[$name]['value'] = $formData[$name] = $this->input->post($name);
                }
                $add = $this->TopicModel->update($formData);
                if( $add ){
                    $newUri = url_to_edit(null,$add);
                    if( input_post('back') ){
                        $newUri = url_to_list();
                    }
                    redirect($newUri, 'refresh');
                }
            }
        } else {
            $item = $this->TopicModel->get_item_by_id($id);
            foreach ($fields AS $field=>$val){
                if( !is_array($fields[$field]) ){
                    $fields[$field] = [];
                }
                if( isset($item->$field) ){
                    $fields[$field]['value']= $item->$field;
                }
            }
        }

        if( $id > 0 ) {
            $fields['source']['readonly'] = true;
            $fields['alias']['type'] = 'editable';
        }
        //dd($fields);
        add_module_asset("inputs.js");
        temp_view('Word/topic-form-backend',compact('fields'));

    }

    /**
     * @var array TableColumn
     */
    var $table_fields = array(
        'id'=>array("#",5,false,'text-center'),
        'name'=>array("Name"),
        'total'=>array("Words"),
        'actions'=>array(NULL,5,false,'text-center'),
    );

    /**
     *
     * @return template : Datatable Topics
     */
    public function items(){
        if( $this->uri->extension =='json' ){
            return $this->TopicModel->items_json();
        }
        $data = columns_fields($this->table_fields);
        temp_view('Word/backend/topics-datatable',$data);
    }

    private function Crawler($fields){
        $this->load->module('SystemCrawler');

        $source = input_post('source');
        $host = get_domain($source);
        $fields['source']['value'] = $source;


        if( strlen($host) > 0 ){
            $html = new simple_html_dom();
            $html->load(get_site_html_curl($source));
            switch ($host){
                case 'learn-japanese-adventure.com':
                    $titleObject = $html->find("#ContentColumn h1",0);
                    if( $titleObject  ){
                        $fields['name']['value'] = trim( strip_tags($titleObject->innertext) );
                        $fields['alias']['value'] = url_title($fields['name']['value'],'-',true);
                    }
                    $tableObject = $html->find("#ContentColumn table",0);
                    if( $tableObject ){
                        foreach ($tableObject->find('tr') AS $indexRow=>$row){
                            $vocabulary = [
                                'kanji'=>null,
                                'japanese'=>null,
                                'romaji'=>null,
                                'english'=>NULL,
                                'vietnamese'=>null,
                                'id'=>0
                            ];
                            if( $indexRow > 0 ){
                                $vocabulary['kanji'] = $row->find('td',1)->plaintext;
                                $vocabulary['japanese'] = $row->find('td',2)->plaintext;
                                $vocabulary['romaji'] = $row->find('td',3)->plaintext;
                                $vocabulary['english'] = $row->find('td',4)->plaintext;
                                $fields['words']['value'][] = $vocabulary;
                            }
                        }
                    }
                    break;
            }
        }

        return $fields;
    }
}