<?php 

class Postad_create_cloths extends CI_Controller{
        public function __construct(){
                parent::__construct();
                $this->load->model("category_model");
                $this->load->model("postad_cloths_model");
                
        }
        public function index(){

             if($this->session->userdata("login_id") == ''){
                redirect("login");
            }

            if($this->input->post('post_create_ad_cloths')){
                // echo "<pre>"; print_r($this->input->post()); exit;
                $this->postad_cloths_model->postad_creat();
            }


        	 $data = array(
                    "cloths_women"     =>  $this->category_model->cloths_women(),
                    "cloths_men"     =>  $this->category_model->cloths_men(),
                    "cloths_boy"     =>  $this->category_model->cloths_boy(),
                    "cloths_girls"     =>  $this->category_model->cloths_girls(),
                    "cloths_baby_boy"     =>  $this->category_model->cloths_baby_boy(),
                    "cloths_baby_girl"     =>  $this->category_model->cloths_baby_girls(),
                                "title"     =>  "Classifieds",
                                "content"   =>  "postad_create_cloths"
                        );

             $cat = $this->input->post('cloths_cat');
             $sub_cat = $this->input->post('cloths_sub');
             $sub_sub_cat = $this->input->post('cloths_sub_sub');

             $sub_name = @mysql_result(mysql_query("SELECT * FROM `sub_category` WHERE sub_category_id = '$sub_cat'"), 0, 'sub_category_name');
             $sub_sub_name = @mysql_result(mysql_query("SELECT * FROM `sub_subcategory` WHERE `sub_subcategory_id` = '$sub_sub_cat'"), 0, 'sub_subcategory_name');

            if($sub_name == ''){
                redirect('postad');
            }
             $data['cat'] = $cat;   
             $data['sub_name'] = $sub_name;
             $data['sub_sub_name'] = $sub_sub_name;

             /*id for category*/
              $data['sub_id'] = $sub_cat;
             $data['sub_sub_id'] = $sub_sub_cat;
             $data['login_id'] = $this->session->userdata("login_id");
             $data['package_name'] = $this->category_model->package_name();

                $this->load->view("classified_layout/inner_template",$data);
        }

       



    }

 ?>