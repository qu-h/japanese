<?php
/**
 * Created by PhpStorm.
 * User: hongq
 * Date: 5/5/2019
 * Time: 3:32 AM
 */

class VnjpclubBackend extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('SystemCrawler/simple_html_dom');
        $this->load->helper('SystemCrawler/html_get');


    }

    public function index(){

    }

    public function getMina($lesson){
        $this->getReading($lesson);
    }

    private function getReading($lesson){
        $url = sprintf('https://www.vnjpclub.com/minna-no-nihongo/bai-%s-luyen-doc.html',$lesson);
        $html = new simple_html_dom();
        $content = get_site_html_curl($url);
        dd($content);
        $html->load($url);
bug($url);
        $tabs = $html->find('.tab_container');
        if( $tabs ) foreach ($tabs AS $tab){
            bug($tab->plaintext);
        }
        bug($tabs->plaintext);
        die('xx');
    }
}