<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class  Home_kitchen_search extends CI_Controller{
        public function __construct(){
                parent::__construct();
                //$this->load->model("login_model");
        }
        public function index(){
                if ($this->session->userdata('login_id') == '') {
                   redirect('login');
                }
                $data   =   array(
                        "title"     =>  "Classifieds",
                        "content"   =>  "home_kitchen_search"
                );
                
                $this->load->view("classified_layout/inner_template",$data);
        }
        
}

