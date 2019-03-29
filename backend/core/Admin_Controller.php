<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Admin_Controller
 * @property Template $template
 * @property ArrayObject $fields
 */
class Admin_Controller extends MX_Controller
{
    //presumes you use hmvc

    // this is the main controller, it feeds data to its child(extended) controllers
    // use the protected keyword over the private keyword for methods and vars

    protected $user, $permissions = array(), $group;

    // define some permission constants to check with ICT_Controller scope including
    // children(extended)
    const PERM_READ = 'read';
    const PERM_EDIT = 'edit';
    const PERM_DELETE = 'delete';

    // an alternative is to use bit and bitewise operations
    // tutorial here http://codingrecipes.com/how-to-write-a-permission-system-using-bits-and-bitwise-operations-in-php


    public function __construct()
    {
        parent::__construct();

        //check the session data and assign a user to the user var

        $this->load->module('backend');
        $this->load->module('SystemLayouts');
        $this->template->set_theme('smartadmin')->set_layout('main');
        Modules::run('SystemUser/checkLogin','user/login');

        $this->SetLink();
//        $this->datatableValue();

//        $this->user = ($uid = $this->session->userdata('user_id'))
//            ? ICTUserModel::find($uid)
//            : NULL;

        if ($this->user !== NULL) {
            $this->_assign_group();
            $this->_assign_permissions();
        }
        $this->loadFormModel();
        add_asset("backend.js");
    }

    private function SetLink(){
        set_temp_val("SignOutLink", "/user/logout");
        add_site_structure('',lang("Admin area") );
    }



    public function _assign_group()
    {
        return $this->group = $this->user->group;
    }

    public function _assign_permissions()
    {
        // permissions are stored as json object in the database
        // this works fine as we dont need to do a serach on the object
        // we simply store and return
        // {["read", "update", "delete"]}

        return $this->permissions = (array)json_decode($this->user->permissions);
    }

    public function _can_read()
    {
        return (bool)(in_array(self::PERM_READ, $this->permissions));
    }

    public function _can_edit()
    {
        return (bool)(in_array(self::PERM_EDIT, $this->permissions));
    }

    public function _can_delete()
    {
        return (bool)(in_array(self::PERM_DELETE, $this->permissions));
    }

    private function datatableValue()
    {
        $length = $this->session->userdata('page_length');
        if ($length) {
            set_temp_val("dataLength", $length);
        }
        $start = $this->session->userdata('page_start');
        if ($start) {
            set_temp_val("dataStart", $start);
        }

        $order = $this->session->userdata('page_order');
        $page_order = [];
        if ($order) {

            foreach ($order AS $c) {
                $page_order[] = '[' . $c['column'] . ',"' . $c['dir'] . '"]';
            }
        }
        if (empty($page_order)) {
            $page_order[] = '[0,"desc"]';
        }
        set_temp_val("page_order", implode(',', $page_order));
    }

    protected $fieldKeys = [];
    private function loadFormModel(){
        $className = get_class ($this);
        $moduleName = $this->load->getModule();
        $className = str_replace(['Backend','Frontend'],null,$className);
        $modelName = sprintf('%sModel',$className);

        if( class_exists($modelName) ) {
            $this->model = $this->$modelName;
            $this->fields = $this->$modelName->fields();
            $this->fieldKeys = array_keys($this->fields);
        }
    }

    protected function updateDataSubmit(){
        $data = [];
        foreach ($this->fieldKeys AS $key){
            $data[$key] = $this->input->post($key);
        }
        return $this->model->updateRow($data);
    }

    protected function bindData2Fields($row){
        foreach ($this->fields AS $field=>$val){
            if( isset($row->$field) ){
                $this->fields[$field]['value']=$row->$field;
            }
        }
    }
}