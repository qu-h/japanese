<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class PhraseBackend extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        add_site_structure('phrase',lang("Phrase Manager") );
        set_temp_val('uri_add','phrase/add' );
    }

    public function index(){
        return $this->dataTables();
    }

    public function add(){
        return $this->form(0);
    }

    public function edit($id=0){
        return $this->form($id);
    }

    private function form($id){
        if ($this->input->method(true)==='POST') {
            $id = $this->updateDataSubmit();
            if( $id > 0 ){
                set_success('Success.');
                redirect(sprintf('phrase/edit/%d',$id));
            }
        }

        $kanjis = [];
        if ( $id > 0 ){
            $item = $this->model->findRow($id);
            $this->bindData2Fields($item);
            $kanjis = kanjiCount($item->phrase);
        }

        $fields = $this->fields;
        $this->template->build('Phrase/form', compact('fields','kanjis'));
    }


    /**
     * @var array TableColumn
     */
    private  $table_fields = array(
        'id'=>      ["#",5,false,'text-center'],
        'phrase'=>   ["Phrase"],
        'actions'=> [NULL,5,false,'text-center'],
    );

    /**
     *
     * @return template : Datatable items
     */
    private function dataTables(){
        if( $this->uri->extension =='json' ){
            $fields = array_keys($this->table_fields);
            return $this->model->items_json($fields);
        }
        $data = columns_fields($this->table_fields);
        temp_view('backend/datatables',$data);
    }
}