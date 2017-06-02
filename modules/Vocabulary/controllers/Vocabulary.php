<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Vocabulary extends MX_Controller {

    function __construct()
    {
        parent::__construct();
        $this->fields = $this->Vocabulary_Model->fields();
    }

    function index(){
        
    }
    
    /*
     * Backend
     */
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
        }

        $data = array(
            'fields' => $this->fields
        );

        $this->template
        ->title( lang('welcome_to'))
        ->build('backend/form',$data);
    }
}