<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class KanjiBackend extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function index(){
        return $this->items();
    }

    var $table_fields = array(
        'id'=>array("#",5,true,'text-center'),
        'word'=>array("Word"),
        'onyomi'=>["am On"],
        'kunyomi'=>["am Kun"],
        'level'=>["Level"],
        'actions'=>array(),
    );

    function items(){
        if( !function_exists("columns_fields") ){
            $this->load->helper('backend/datatables');
        }

        if( $this->uri->extension =='json' ){
            return $this->Kanji_Model->items_json(array_keys($this->table_fields));
        }

        $data = columns_fields($this->table_fields);

        $this->template->build('backend/datatables',$data);
    }

    public function form($id = 0)
    {
        $this->fields = $this->Kanji_Model->fields();

        if ($this->input->post()) {
            $data = array();
            foreach ($this->fields as $name => $field) {
                $this->fields[$name]['value'] = $data[$name] = $this->input->post($name);
            }
            $add = $this->Kanji_Model->update($data);
            if( $add ){
                set_error(lang('Success.'));
            }
        } else if ( $id > 0 ){
            $item = $this->Kanji_Model->get_item_by_id($id);
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