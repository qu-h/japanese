<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Course extends MX_Controller {

    function __construct()
    {
        parent::__construct();
        $this->fields = $this->Course_Model->fields();
    }

    public function form($id=0){

        if ($this->input->post()) {
            $formdata = array();
            foreach ($this->fields as $name => $field) {
                $this->fields[$name]['value'] = $formdata[$name] = $this->input->post($name);
            }

            $add = $this->Course_Model->update($formdata);
            if( $add ){
                set_error(lang('Success.'));
            }

        } else {
            $item = $this->Course_Model->get_item_by_id($id);
            foreach ($this->fields AS $field=>$val){
                if( isset($item->$field) ){
                    $this->fields[$field]['value']=$item->$field;
                }
            }
            if( !empty($item) AND isset($this->fields['conversation']) ){
                $this->fields['conversation']['course']=$id;
            }
        }

        $data = array(
            'fields' => $this->fields
        );
        temp_view('backend/form',$data);

    }

    function lesson($a){
        die($a);
    }
}