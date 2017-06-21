<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Learning extends MX_Controller {

    function __construct()
    {
        parent::__construct();
        if( !property_exists($this, 'template') ){
        }

        
    }

    /*
     * Frontend
     */
    function index(){
        die('show index grammar');
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
        'id'=>array("#"),
        'title'=>array("Title"),
        'grammar'=>array("Cấu Trúc"),
        'category'=>array("Danh Mục"),
        'actions'=>array(NULL,5,false),
    );


    function vocabulary(){
        $action = $this->uri->segment(4);
        $this->vocabulary_fields = $this->Learning_Vocabulary_Model->fields();

        switch ($action){
            case 'add':
                return $this->vocabulary_form();
        }
    }

    private function vocalbulary_items(){
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

    public function vocabulary_form($id=0){

        if ($this->input->post()) {
            $formdata = array();
            foreach ($this->vocabulary_fields as $name => $field) {
                $this->vocabulary_fields[$name]['value'] = $formdata[$name] = input_post($name);
            }
           $add = $this->Learning_Vocabulary_Model->update($formdata);
            if( $add ){
                set_error(lang('Success.'));
                redirect('admin/learning/vocabulary/add');
            }

        } else {
            $item = $this->Learning_Vocabulary_Model->get_item_by_id($id);
            foreach ($this->vocabulary_fields AS $field=>$val){
                if( isset($item->$field) ){
                    $this->vocabulary_fields[$field]['value']=$item->$field;
                }
            }
        }
        
        $data = array(
            'fields' => $this->vocabulary_fields
        );
        
        add_root_asset("bootstrap-ajax-typeahead/js/bootstrap-typeahead.js");
        add_root_asset("wanakana/wanakana.min.js");
        add_module_asset("inputs.js");
        temp_view('backend/form',$data);

    }
}