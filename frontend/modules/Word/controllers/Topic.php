<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Topic extends MX_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Topic_Model');
        $this->load->smarty("Word/smartadmin");
        add_git_assets("wanakana.min.js","input-method/wanakana",null,null,false);
        add_git_assets("vime.js","input-method/vime",null,null,false);
    }

    public function form($id=0){
        $this->fields = $this->Topic_Model->fields();
        if ($this->input->post()) {
            $formdata = array();
            foreach ($this->fields as $name => $field) {
                $this->fields[$name]['value'] = $formdata[$name] = $this->input->post($name);
            }

            $add = $this->Topic_Model->update($formdata);
            if( $add ){
                set_success('Success.');
                $newUri = url_to_edit(null,$add);
                if( input_post('back') ){
                    $newUri = url_to_list();
                }
                return redirect($newUri, 'refresh');
            }

        } else {
            $item = $this->Topic_Model->get_item_by_id($id);
            foreach ($this->fields AS $field=>$val){
                if( isset($item->$field) ){
                    $this->fields[$field]['value']=$item->$field;
                }
            }
        }
        $data = array(
            'fields' => $this->fields
        );

        add_module_asset("inputs.js");
        temp_view('topic-form',$data);

    }


    var $table_fields = array(
        'id'=>array("#",5,false,'text-center'),
        'name'=>array("Name"),
        'total'=>array("Words"),
        'actions'=>array(NULL,5,false,'text-center'),
    );
    public function items(){
        if( $this->uri->extension =='json' ){
            return $this->Topic_Model->items_json();
        }

        //$data = array('fields'=>$this->table_fields,'columns_filter'=>true);

        $data = columns_fields($this->table_fields);
        temp_view('backend/datatables',$data);
    }
}