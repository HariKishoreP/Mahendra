<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class  Deals_status extends CI_Controller{
        public function __construct(){
                parent::__construct();
                $this->load->model("classifed_model");
                $this->load->library('pagination');
        }
        public function index(){
            $this->session->unset_userdata("cancelad");
            $this->session->unset_userdata('postad_success');
            $config = array();
            $config['base_url'] = base_url().'deals_status/index';
            $config['total_rows'] = count($this->classifed_model->count_my_ads_user());
            $config['per_page'] = 10;
             $config['next_link'] = 'Next';
              $config['prev_link'] = 'Previous';
            $config['full_tag_open'] ='<div id="pagination" style="color:red;border:2px solid:blue">';
            $config['full_tag_close'] ='</div>';
            $this->pagination->initialize($config);
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $search_option = array(
                'limit' =>$config['per_page'],
                'start' =>$page
                );


                if ($this->session->userdata('login_id') == '') {
                   redirect('login');
                }

                $my_ads = $this->classifed_model->my_ads_user($search_option);
                $log_name = @mysql_result(mysql_query("SELECT first_name FROM login WHERE `login_id` = '".$this->session->userdata('login_id')."'"), 0, 'first_name');
                $data   =   array(
                        "title"     =>  "Classifieds",
                        "content"   =>  "deals_status",
                        'my_ads_details'=> $my_ads,
                        'log_name'=>$log_name,
                         'paging_links' =>$this->pagination->create_links()
                );
                // echo "<pre>"; print_r($this);
                
                $this->load->view("classified_layout/inner_template",$data);
        }
        
}

