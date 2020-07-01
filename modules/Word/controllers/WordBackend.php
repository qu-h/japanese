<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @property WordModel $model
 */
class WordBackend extends JPAdmin_Controller {

    function __construct()
    {
        parent::__construct();
        $this->fields = $this->WordModel->fields();
        $this->config->set_item('word_img_dir', APPPATH."/images/");
        $this->config->set_item('word_img_url', base_url()."images");
        // $this->load->helper('backend/datatables');

        add_site_structure('word',"Word Management");
        set_temp_val('form-uri','word/%s/%d');
        set_temp_val('uri_add','word/add');

        //add_js("http://www.google.com/jsapi");
        //add_module_asset("google-transliteration.js");
        add_git_assets("wanakana.min.js","input-method/wanakana",null,null,false);
        add_git_assets("vime.js","input-method/vime",null,null,false);
        /*
         * using nodejs
         * https://www.npmjs.com/package/wanakana
         * https://www.npmjs.com/package/jp-conversion
         */
    }
    
    function index(){
        return $this->DataTables();
    }

    var $table_fields = array(
        'id'=>array("#",5,false,'text-center'),
        'img'=>array("Hình ảnh",10,false,'text-center'),
        'word'=>array("Từ Vựng"),
        'romaji'=>array("Romaji"),
        'translate'=>array("Nghĩa"),
        'actions'=>array(NULL,5,false,'text-center'),
    );


    private function DataTables(){
        if( $this->uri->extension =='json' ){
            $fields = array_keys($this->table_fields);
            return $this->model->items_json($fields);
            //return $this->items_json_data(array_keys($this->table_fields));
        }
        //$data = array('fields'=>$this->table_fields,'columns_filter'=>true);
        $data = columns_fields($this->table_fields);
        temp_view('backend/datatables',$data);
    }

    public function form($id=0){

        if ($this->input->post()) {
            $formData = [];
            foreach ($this->fields as $name => $field) {
                $this->fields[$name]['value'] = $formData[$name] = $this->input->post($name);
            }

            $add = $this->WordModel->update($formData);
            if( $add ){
                set_error(lang('Success.'));
                redirect('word');
            }

        } else {
            $item = $this->WordModel->get_item_by_id($id);
            foreach ($this->fields AS $field=>$val){
                if( !is_array($this->fields[$field]) ){
                    $this->fields[$field] = [];
                }
                if( isset($item->$field) ){
                    $this->fields[$field]['value']=$item->$field;
                }
            }
        }
        $fields = $this->fields;
        //add_js('{root_assets}wanakana/wanakana.min.js');
        //add_root_asset("wanakana/wanakana.min.js");
        add_module_asset("inputs.js");

        temp_view('Word/word-form',compact('fields'));

    }

    public function findByRomaji($data){
        bug($data);die("findByRomaji");
    }

    function add(){
        return $this->form(0);
    }

    public function edit($id=0){
        return $this->form($id);
    }

}