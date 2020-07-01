<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Course extends JP_Controller {

    function __construct()
    {
        parent::__construct();
        $this->fields = $this->Course_Model->fields();
        $this->load->model('Word/Word_Model');
    }

    function lesson($a){
        die($a);
    }

    
    /*
     * backend
     */
    var $table_fields = array(
        'id'=>array("#",5,false,'text-center'),
        'name'=>array("Tên bài học"),
        'vocabulary_count'=>array("Số Từ Vựng",10,false,'text-center'),
        'actions'=>array(NULL,5,false,'text-center'),
    );
    public function items(){
        if( $this->uri->extension =='json' ){
            $this->Course_Model->items_json('edit');
            //return $this->items_json_data(array_keys($this->table_fields));
        }
    
        $data = array('fields'=>$this->table_fields,'columns_filter'=>true);
    
        $data['data_json_url'] = base_url($this->uri->uri_string().'.json',NULL);
        $data['columns_fields'] = columns_fields($this->table_fields);
    
        
        temp_view('backend/datatables',$data);
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
                redirect('admin/course');
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
    
        
        temp_view('backend/form',$data);
    
    }

    
    /*
     * backend vocabulary actions
     */
    public function vocabulary(){
        $course_id= $this->uri->segment(4);
        $action= $this->uri->segment(5);
        if( is_numeric($course_id) ){
            $course = $this->Course_Model->get_item_by_id($course_id);
        } else {
            $course = $this->Course_Model->get_item_by_alias($course_id);
        }
        if( strlen($action) > 0 ){
            if( $action=='add' ){
                return $this->vocabulary_form(0,$course->id);
            } elseif( $action=='edit' ){
                $course_vocabulary_id = $this->uri->segment(6);
                return $this->vocabulary_form($course_vocabulary_id,$course->id);
            } else {
                show_404();
            }
        } else {
            return  $this->vocabulary_items($course->id);
        }
    
        if( empty($course) ){
            redirect('admin/course');
        }
    
    }
    
    var $vocabulary_table_fields = array(
            'id'=>array("#",5,false,'text-center'),
            'word'=>array("Từ Vựng",10),
            'write'=>array("Chữ viết",10),
            'answers'=>array("Lựa chọn trả lời",0,false),
            'actions'=>array(NULL,5,false,'text-center'),
    );
    
    private function vocabulary_items($course_id=0){
        if( $this->uri->extension =='json' ){
            $this->CourseVocabulary_Model->items_json('edit',$course_id);
        }
        
        $data = array('fields'=>$this->vocabulary_table_fields,'columns_filter'=>true);
        $data['data_json_url'] = base_url($this->uri->uri_string().'.json',NULL);
        $data['columns_fields'] = columns_fields($this->vocabulary_table_fields);
        temp_view('backend/datatables',$data);
    }
    
    private function vocabulary_form($id=0,$course_id=NULL){
        $fields = $this->CourseVocabulary_Model->fields();
        
        if ($this->input->post()) {
            $formdata = array();
            foreach ($fields as $name => $field) {
                $fields[$name]['value'] = $formdata[$name] = $this->input->post($name);
            }

            $add = $this->CourseVocabulary_Model->update($formdata);
            if( $add ){
                set_error(lang('Success.'));
                redirect("admin/course/vocabulary/$course_id");
            }
        
        } else {
            $item = $this->CourseVocabulary_Model->get_item_by_id($id);
            foreach ($fields AS $field=>$val){
                if( isset($item->$field) ){
                    $fields[$field]['value']=$item->$field;
                }
            }
            $fields["course"]['value'] = $course_id;
        }
        $data = array( 'fields' => $fields );
        
        add_root_asset("wanakana/wanakana.js");
        add_module_asset("inputs.js",'Word');
        temp_view('backend/form',$data);
    }
    
}