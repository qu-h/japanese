<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class TopicBackend extends Admin_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('TopicModel');
        $this->load->smarty("Word/smartadmin");

        set_temp_val('uri_add','word/topic/add' );
        add_git_assets("wanakana.min.js","input-method/wanakana",null,null,false);
        add_git_assets("vime.js","input-method/vime",null,null,false);
    }


    public function index(){
        return $this->items();
    }

    public function add(){
        return $this->form();
    }

    public function edit($id=0){
        return $this->form($id);
    }

    public function form($id=0){
        $this->fields = $this->TopicModel->fields();

        if ($this->input->post()) {
            $formdata = [];
            foreach ($this->fields as $name => $field) {
                $this->fields[$name]['value'] = $formdata[$name] = $this->input->post($name);
            }

            $add = $this->TopicModel->update($formdata);
            if( $add ){
                $newUri = url_to_edit(null,$add);
                if( input_post('back') ){
                    $newUri = url_to_list();
                }
                return redirect($newUri, 'refresh');
            }

        } else {
            $item = $this->TopicModel->get_item_by_id($id);

            foreach ($this->fields AS $field=>$val){
                if( !is_array($this->fields[$field]) ){
                    $this->fields[$field] = [];
                }
                if( isset($item->$field) ){
                    $this->fields[$field]['value']= $item->$field;
                }
            }
        }

        if( $id > 0 ) {
            $this->fields['source']['readonly'] = true;
            $this->fields['alias']['type'] = 'editable';
        }

        $data = array(
            'fields' => $this->fields
        );

        add_module_asset("inputs.js");
        temp_view('Word/topic-form-backend',$data);

    }

    /**
     * @var array TableColumn
     */
    var $table_fields = array(
        'id'=>array("#",5,false,'text-center'),
        'name'=>array("Name"),
        'total'=>array("Words"),
        'actions'=>array(NULL,5,false,'text-center'),
    );

    /**
     *
     * @return template : Datatable Topics
     */
    public function items(){
        if( $this->uri->extension =='json' ){
            return $this->TopicModel->items_json();
        }
        $data = columns_fields($this->table_fields);
        temp_view('backend/datatables',$data);
    }
}