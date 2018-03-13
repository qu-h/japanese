<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Topic extends MX_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Topic_Model');
        $this->load->smarty("Word/smartadmin");
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
                set_error(lang('Success.'));
                redirect('admin/word');
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
}