<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class TipBackend extends JPAdmin_Controller {

    function __construct()
    {
        parent::__construct();
        $this->fields = $this->TipModel->fields();
        set_temp_val('uri_add',('article/add'));
        set_temp_val('uri_edit',('article/edit/%s'));
    }

    function index(){
        return $this->items();
    }

//    function items($alias){
//        return $this->Tip_Model->get_items_by_alias($alias);
//    }

    var $table_fields = array(
        'id'=>array("#",5,true,'text-center'),
        'name'=>array("Title"),
        'category'=>array("Category"),
        'actions'=>array(),
    );
    function items(){
        if( !function_exists("columns_fields") ){
            $this->load->helper('backend/datatables');
        }
        if( $this->uri->extension =='json' ){
            return $this->TipModel->items_json(array_keys($this->table_fields));
        }

        $data = columns_fields($this->table_fields);
        //$this->template->build('backend/datatables',$data);
        temp_view('backend/datatables', $data);
    }

    public function add(){
        return $this->form(0);
    }
    public function form($id = 0)
    {
        if ($this->input->post()) {
            $data = array();
            foreach ($this->fields as $name => $field) {
                $this->fields[$name]['value'] = $data[$name] = $this->input->post($name);
            }
            $add = $this->Tip_Model->update($data);
            if( $add ){
                set_error(lang('Success.'));
            }
        } else if ( $id > 0 ){
            $item = $this->Tip_Model->get_item_by_id($id);
            foreach ($this->fields AS $field=>$val){
                if( isset($item->$field) ){
                    $this->fields[$field]['value']=$item->$field;
                }
            }
        }

        $data = array(
            'fields' => $this->fields
        );
        $this->template->build('form', $data);
    }
}