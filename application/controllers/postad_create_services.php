<?php 

class Postad_create_services extends CI_Controller{
        public function __construct(){
                parent::__construct();
                  $this->load->model("category_model");
                
        }
        public function index(){

            if ($this->input->post("post_create_ad")) {
                    echo "<pre>";
                    echo $_FILES['file_video_platinum']['name'];
                    echo $_FILES['file']['name'];
                   print_r($this->input->post());
                     exit;
            }
            

        	 $data = array(
                    "services_sub_prof"     =>  $this->category_model->services_sub_prof(),
                    "services_sub_pop"     =>  $this->category_model->services_sub_pop(),
                                "title"     =>  "Classifieds",
                                "content"   =>  "postad_create_services"
                        );

             $cat = $this->input->post('services_cat');
             $sub_cat = $this->input->post('services_sub');
             $sub_sub_cat = $this->input->post('services_sub_sub');

             $sub_name = @mysql_result(mysql_query("SELECT * FROM `sub_category` WHERE sub_category_id = '$sub_cat'"), 0, 'sub_category_name');
             $sub_sub_name = @mysql_result(mysql_query("SELECT * FROM `sub_subcategory` WHERE `sub_subcategory_id` = '$sub_sub_cat'"), 0, 'sub_subcategory_name');
            if($sub_name == ''){
                redirect('postad');
            }
             $data['cat'] = $cat;   
             $data['sub_name'] = $sub_name;
             $data['sub_sub_name'] = $sub_sub_name;

	            $this->load->view("classified_layout/inner_template",$data);
        }
    }

 ?>