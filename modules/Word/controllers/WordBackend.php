<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class WordBackend extends Admin_Controller {

    function __construct()
    {
        parent::__construct();
        $this->fields = $this->WordModel->fields();
        $this->config->set_item('word_img_dir', APPPATH."/images/");
        $this->config->set_item('word_img_url', base_url()."images");
        $this->load->helper('backend/datatables');
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
        return $this->items();
    }

    var $table_fields = array(
        'id'=>array("#",5,false,'text-center'),
        'img'=>array("Hình ảnh",10,false,'text-center'),
        'word'=>array("Từ Vựng"),
        'romaji'=>array("Romaji"),
        'vietnamese'=>array("Nghĩa"),
        'actions'=>array(NULL,5,false,'text-center'),
    );


    function items(){
        if( $this->uri->extension =='json' ){
            return $this->items_json_data(array_keys($this->table_fields));
        }

        $data = array('fields'=>$this->table_fields,'columns_filter'=>true);

//        $data['data_json_url'] = base_url($this->uri->uri_string().'.json',NULL);
//        $data['columns_fields'] = columns_fields($this->table_fields);
        $data = columns_fields($this->table_fields);
        temp_view('backend/datatables',$data);
    }

    private function items_json_data(){
        $this->WordModel->items_json('edit');
    }

    public function form($id=0){

        if ($this->input->post()) {
            $formdata = array();
            foreach ($this->fields as $name => $field) {
                $this->fields[$name]['value'] = $formdata[$name] = $this->input->post($name);
            }

            $add = $this->WordModel->update($formdata);
            if( $add ){
                set_error(lang('Success.'));
                redirect('admin/word');
            }

        } else {
            $item = $this->WordModel->get_item_by_id($id);
            foreach ($this->fields AS $field=>$val){
                if( isset($item->$field) ){
                    $this->fields[$field]['value']=$item->$field;
                }
            }
        }
        $data = array(
            'fields' => $this->fields
        );
        
        //add_js('{root_assets}wanakana/wanakana.min.js');
        //add_root_asset("wanakana/wanakana.min.js");
        add_module_asset("inputs.js");

        temp_view('Word/backend/word-form',$data);

    }

    public function findByRomaji($data){
        bug($data);die("findByRomaji");
    }

    function add(){
        dd('add word backend');
    }

    public function edit($id){
        return $this->form($id);
    }

//    public function topic(){
//        dd('tip in word');
//    }
}