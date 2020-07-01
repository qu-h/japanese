<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class GrammarBackend
 * @property REST $rest
 * @property Curl $curl
 * @property AnalyzeSentenceModel $AnalyzeSentenceModel
 */
class SentenceBackend extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->fields = $this->AnalyzeSentenceModel->fields();
    }

    public function index(){
        return $this->dataTables();
    }

    var $table_fields = array(
        'id'=>array("#",5,true,'text-center'),
        'word'=>array("Word"),
        'onyomi'=>["am On"],
        'kunyomi'=>["am Kun"],
        'level'=>["Level"],
        'actions'=>array(),
    );

    private function dataTables(){
        if( !function_exists("columns_fields") ){
            $this->load->helper('backend/datatables');
        }

        if( $this->uri->extension =='json' ){
            return $this->AnalyzeSentenceModel->items_json(array_keys($this->table_fields));
        }

        $data = columns_fields($this->table_fields);

        $this->template->build('backend/dataTables',$data);
    }
}