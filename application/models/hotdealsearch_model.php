<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class hotdealsearch_model extends CI_Model{

		/*ezone sub categories*/
		public function ezone_sub(){
			$this->db->select("*");
			$this->db->from("sub_category");
			$this->db->where('category_id',8);
			$rs = $this->db->get();
			return $rs->result();
		}

			/*motor point sub categories*/
			public function motor_sub(){
				$this->db->select("*");
			$this->db->from("sub_category");
			$this->db->where('category_id',3);
			$rs = $this->db->get();
			return $rs->result();
			}

			/*cloths sub categories*/
			public function cloths_sub(){
				$this->db->select("*");
			$this->db->from("sub_category");
			$this->db->where('category_id',6);
			$rs = $this->db->get();
			return $rs->result();
			}

			/*services sub categories*/
			public function services_sub(){
				$this->db->select("*");
			$this->db->from("sub_category");
			$this->db->where('category_id',2);
			$rs = $this->db->get();
			return $rs->result();
			}

			/*property sub categories*/
			public function property_sub(){
				$this->db->select("*");
			$this->db->from("sub_category");
			$this->db->where('category_id',4);
			$rs = $this->db->get();
			return $rs->result();
			}

			/*hkitchen sub categories*/
			public function hkitchen_sub(){
				$this->db->select("*");
			$this->db->from("sub_category");
			$this->db->where('category_id',7);
			$rs = $this->db->get();
			return $rs->result();
			}

			/*pets sub categories*/
			public function pets_sub(){
				$this->db->select("*");
			$this->db->from("sub_category");
			$this->db->where('category_id',5);
			$rs = $this->db->get();
			return $rs->result();
			}

			/*jobs sub categories*/
			public function jobs_sub(){
			$this->db->select("*");
			$this->db->from("sub_category");
			$this->db->where('category_id',1);
			$rs = $this->db->get();
			return $rs->result();
			}

			/*location list*/
			public function loc_list(){
			$this->db->select("*");
			$this->db->from("location");
			$this->db->group_by('latt');
			$rs = $this->db->get();
			return $rs->result();
			}

			public function subcat_hotdeals(){
				$cat_id =  $this->session->userdata('cat_id');
				$this->db->select("sub_category.*, COUNT(postad.sub_cat_id) AS no_ads");
				$this->db->from('sub_category');
				$this->db->join("postad", "postad.sub_cat_id = sub_category.sub_category_id AND postad.ad_status = 1", "left");
				if ($cat_id != 'all') {
					$this->db->where('sub_category.category_id', $cat_id);
				}
				$this->db->group_by("sub_category.sub_category_id");
				$rs = $this->db->get();
				return $rs->result();
			}

			/*search home filter*/
			public function subcat_searchdeals(){
				$date = date("Y-m-d H:i:s");
				$looking_search =  $this->session->userdata('s_looking_search');
	         	$cat_id =  $this->session->userdata('s_cat_id');
	         	$s_location = $this->session->userdata('s_location');
	         	$search_bustype = $this->session->userdata('s_search_bustype');
				if ($cat_id == 'all') {
					$this->db->select("sub_category.*, COUNT(postad.sub_cat_id) AS no_ads");
					$this->db->from('sub_category');
					
					if ($looking_search != '' && $search_bustype != 'all') {
						$this->db->join("postad", "postad.sub_cat_id = sub_category.sub_category_id AND postad.ad_status = 1 AND postad.expire_data >='$date' AND (postad.deal_tag LIKE '%$looking_search%' OR postad.deal_desc LIKE '%$looking_search%') AND postad.ad_type='$search_bustype' ", "left");
  					}
  					else if ($looking_search != '') {
						$this->db->join("postad", "postad.sub_cat_id = sub_category.sub_category_id AND postad.ad_status = 1 AND postad.expire_data >='$date' AND (postad.deal_tag LIKE '%$looking_search%' OR postad.deal_desc LIKE '%$looking_search%') ", "left");
  					}
  					else if ($search_bustype != 'all') {
						$this->db->join("postad", "postad.sub_cat_id = sub_category.sub_category_id AND postad.ad_status = 1 AND postad.expire_data >='$date' AND postad.ad_type='$search_bustype' ", "left");
					}
					else{
						$this->db->join("postad", "postad.sub_cat_id = sub_category.sub_category_id AND postad.ad_status = 1 AND postad.expire_data >='$date'", "left");
					}
					$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
					if ($looking_search) {
						if ($looking_search != '') {
							$this->db->where("(postad.deal_tag LIKE '%$looking_search%' OR postad.deal_tag LIKE '$looking_search%' OR postad.deal_tag LIKE '%$looking_search' 
	  						OR postad.deal_desc LIKE '%$looking_search%' OR postad.deal_desc LIKE '$looking_search%' OR postad.deal_desc LIKE '%$looking_search')");
						}
					}
					if ($s_location != '') {
						$this->db->where("(loc.loc_name LIKE '$s_location%' 
		  					OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')");
					}
					$this->db->group_by("sub_category.sub_category_id");
					$rs = $this->db->get();
					return $rs->result();
				}
				if ($cat_id == 1) {
					$this->db->select("sub_category.*, COUNT(postad.sub_cat_id) AS no_ads");
					$this->db->from('sub_category');
						if ($looking_search != '' && $search_bustype != 'all') {
							$this->db->join("postad", "postad.sub_cat_id = sub_category.sub_category_id AND postad.ad_status = 1 AND postad.expire_data >='$date' AND (postad.deal_tag LIKE '%$looking_search%' OR postad.deal_desc LIKE '%$looking_search%') AND postad.ad_type='$search_bustype' ", "left");
	  					}
	  					else if ($looking_search != '') {
							$this->db->join("postad", "postad.sub_cat_id = sub_category.sub_category_id AND postad.ad_status = 1 AND postad.expire_data >='$date' AND (postad.deal_tag LIKE '%$looking_search%' OR postad.deal_desc LIKE '%$looking_search%') ", "left");
	  					}
	  					else if ($search_bustype != 'all') {
							$this->db->join("postad", "postad.sub_cat_id = sub_category.sub_category_id AND postad.ad_status = 1 AND postad.expire_data >='$date' AND postad.ad_type='$search_bustype' ", "left");
						}
						else{
							$this->db->join("postad", "postad.sub_cat_id = sub_category.sub_category_id AND postad.ad_status = 1 AND postad.expire_data >='$date'", "left");
						}
						
					if ($s_location != '') {
						$this->db->join("location as loc", "loc.ad_id = postad.ad_id AND loc.loc_name LIKE '%$s_location%'  ", "left");
					}
					else{
						$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
					}
					$this->db->where('sub_category.category_id', $cat_id);
					$this->db->group_by("sub_category.sub_category_id");
					$rs = $this->db->get();
					 // echo $this->db->last_query(); exit;
					return $rs->result();
				}
			}
			/*services search sub category*/
			public function services_sub_prof(){
				$date = date("Y-m-d H:i:s");
				$this->db->select("sub_subcategory.*, COUNT(postad.sub_scat_id) AS no_ads");
				$this->db->from('sub_subcategory');
				$this->db->join("postad", "postad.sub_scat_id = sub_subcategory.sub_subcategory_id AND postad.ad_status = 1 AND postad.expire_data >='$date'", "left");
				$this->db->where("sub_subcategory.sub_category_id", '9');
				$this->db->group_by("sub_subcategory.sub_subcategory_id");
				$rs = $this->db->get();
				 // echo $this->db->last_query(); exit;
				return $rs->result();
			}

			public function services_sub_pop(){
				$data = date("Y-m-d H:i:s");
				$this->db->select("sub_subcategory.*, COUNT(postad.sub_scat_id) AS no_ads");
				$this->db->from('sub_subcategory');
				$this->db->join("postad", "postad.sub_scat_id = sub_subcategory.sub_subcategory_id AND postad.ad_status = 1 AND postad.expire_data >='$data'", "left");
				$this->db->where("sub_subcategory.sub_category_id", '10');
				$this->db->group_by("sub_subcategory.sub_subcategory_id");
				$rs = $this->db->get();
				 // echo $this->db->last_query(); exit;
				return $rs->result();
			}

			/* jobs sub category*/
			public function jobs_sub_search(){
				$data = date("Y-m-d H:i:s");
				$this->db->select("sub_category.*, COUNT(postad.sub_cat_id) AS no_ads");
				$this->db->from('sub_category');
				$this->db->join("postad", "postad.sub_cat_id = sub_category.sub_category_id AND postad.ad_status = 1 AND postad.expire_data >='$data'", "left");
				$this->db->where("sub_category.category_id", '1');
				$this->db->group_by("sub_category.sub_category_id");
				$rs = $this->db->get();
				 // echo $this->db->last_query(); exit;
				return $rs->result();
			}

			/* pets sub category*/
			public function pets_sub_search(){
				$data = date("Y-m-d H:i:s");
				$this->db->select("(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
				AND ad.`category_id` = '5' AND ad.`sub_cat_id`=1 AND ad.ad_status = 1 AND ad.expire_data >='19-04-2016 10:10:10') AS dogs,
				(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
				AND ad.`category_id` = '5' AND ad.`sub_cat_id`=2 AND ad.ad_status = 1 AND ad.expire_data >='19-04-2016 10:10:10') AS cats,
				(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
				AND ad.`category_id` = '5' AND ad.`sub_cat_id`=3 AND ad.ad_status = 1 AND ad.expire_data >='19-04-2016 10:10:10') AS fishes,
				(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
				AND ad.`category_id` = '5' AND ad.`sub_cat_id`=4 AND ad.ad_status = 1 AND ad.expire_data >='19-04-2016 10:10:10') AS birds,
				(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
				AND ad.`category_id` = '5' AND ad.`sub_cat_id`=8 AND ad.ad_status = 1 AND ad.expire_data >='19-04-2016 10:10:10') AS others");
				$rs = $this->db->get();
				return $rs->result();
			}
			public function pets_big_search(){
				$data = date("Y-m-d H:i:s");
				$this->db->select("(SELECT COUNT(*) FROM postad AS ad, `sub_subcategory` AS scat WHERE scat.`sub_subcategory_id` = ad.sub_scat_id
				AND ad.`category_id` = '5' AND ad.`sub_scat_id`=1 AND ad.ad_status = 1 AND ad.expire_data >='19-04-2016 10:10:10') AS cobs,
				(SELECT COUNT(*) FROM postad AS ad, `sub_subcategory` AS scat WHERE scat.`sub_subcategory_id` = ad.sub_scat_id
				AND ad.`category_id` = '5' AND ad.`sub_scat_id`=2 AND ad.ad_status = 1 AND ad.expire_data >='19-04-2016 10:10:10') AS donkeys,
				(SELECT COUNT(*) FROM postad AS ad, `sub_subcategory` AS scat WHERE scat.`sub_subcategory_id` = ad.sub_scat_id
				AND ad.`category_id` = '5' AND ad.`sub_scat_id`=3 AND ad.ad_status = 1 AND ad.expire_data >='19-04-2016 10:10:10') AS horses,
				(SELECT COUNT(*) FROM postad AS ad, `sub_subcategory` AS scat WHERE scat.`sub_subcategory_id` = ad.sub_scat_id
				AND ad.`category_id` = '5' AND ad.`sub_scat_id`=4 AND ad.ad_status = 1 AND ad.expire_data >='19-04-2016 10:10:10') AS ponies,
				(SELECT COUNT(*) FROM postad AS ad, `sub_subcategory` AS scat WHERE scat.`sub_subcategory_id` = ad.sub_scat_id
				AND ad.`category_id` = '5' AND ad.`sub_scat_id`=5 AND ad.ad_status = 1 AND ad.expire_data >='19-04-2016 10:10:10') AS beef,
				(SELECT COUNT(*) FROM postad AS ad, `sub_subcategory` AS scat WHERE scat.`sub_subcategory_id` = ad.sub_scat_id
				AND ad.`category_id` = '5' AND ad.`sub_scat_id`=6 AND ad.ad_status = 1 AND ad.expire_data >='19-04-2016 10:10:10') AS dailry,
				(SELECT COUNT(*) FROM postad AS ad, `sub_subcategory` AS scat WHERE scat.`sub_subcategory_id` = ad.sub_scat_id
				AND ad.`category_id` = '5' AND ad.`sub_scat_id`=7 AND ad.ad_status = 1 AND ad.expire_data >='19-04-2016 10:10:10') AS others");
				$rs = $this->db->get();
				return $rs->result();
			}
			public function pets_small_search(){
				$data = date("Y-m-d H:i:s");
				$this->db->select("(SELECT COUNT(*) FROM postad AS ad, `sub_subcategory` AS scat WHERE scat.`sub_subcategory_id` = ad.sub_scat_id
				AND ad.`category_id` = '5' AND ad.`sub_scat_id`=8 AND ad.ad_status = 1 AND ad.expire_data >='19-04-2016 10:10:10') AS pigs,
				(SELECT COUNT(*) FROM postad AS ad, `sub_subcategory` AS scat WHERE scat.`sub_subcategory_id` = ad.sub_scat_id
				AND ad.`category_id` = '5' AND ad.`sub_scat_id`=9 AND ad.ad_status = 1 AND ad.expire_data >='19-04-2016 10:10:10') AS sheeps,
				(SELECT COUNT(*) FROM postad AS ad, `sub_subcategory` AS scat WHERE scat.`sub_subcategory_id` = ad.sub_scat_id
				AND ad.`category_id` = '5' AND ad.`sub_scat_id`=10 AND ad.ad_status = 1 AND ad.expire_data >='19-04-2016 10:10:10') AS goats,
				(SELECT COUNT(*) FROM postad AS ad, `sub_subcategory` AS scat WHERE scat.`sub_subcategory_id` = ad.sub_scat_id
				AND ad.`category_id` = '5' AND ad.`sub_scat_id`=11 AND ad.ad_status = 1 AND ad.expire_data >='19-04-2016 10:10:10') AS poultry,
				(SELECT COUNT(*) FROM postad AS ad, `sub_subcategory` AS scat WHERE scat.`sub_subcategory_id` = ad.sub_scat_id
				AND ad.`category_id` = '5' AND ad.`sub_scat_id`=12 AND ad.ad_status = 1 AND ad.expire_data >='19-04-2016 10:10:10') AS reptiles,
				(SELECT COUNT(*) FROM postad AS ad, `sub_subcategory` AS scat WHERE scat.`sub_subcategory_id` = ad.sub_scat_id
				AND ad.`category_id` = '5' AND ad.`sub_scat_id`=13 AND ad.ad_status = 1 AND ad.expire_data >='19-04-2016 10:10:10') AS furry,
				(SELECT COUNT(*) FROM postad AS ad, `sub_subcategory` AS scat WHERE scat.`sub_subcategory_id` = ad.sub_scat_id
				AND ad.`category_id` = '5' AND ad.`sub_scat_id`=14 AND ad.ad_status = 1 AND ad.expire_data >='19-04-2016 10:10:10') AS others");
				$rs = $this->db->get();
				return $rs->result();
			}
			public function pets_access_search(){
				$data = date("Y-m-d H:i:s");
				$this->db->select("(SELECT COUNT(*) FROM postad AS ad, `sub_subcategory` AS scat WHERE scat.`sub_subcategory_id` = ad.sub_scat_id
				AND ad.`category_id` = '5' AND ad.`sub_scat_id`=15 AND ad.ad_status = 1 AND ad.expire_data >='19-04-2016 10:10:10') AS foods,
				(SELECT COUNT(*) FROM postad AS ad, `sub_subcategory` AS scat WHERE scat.`sub_subcategory_id` = ad.sub_scat_id
				AND ad.`category_id` = '5' AND ad.`sub_scat_id`=16 AND ad.ad_status = 1 AND ad.expire_data >='19-04-2016 10:10:10') AS toys,
				(SELECT COUNT(*) FROM postad AS ad, `sub_subcategory` AS scat WHERE scat.`sub_subcategory_id` = ad.sub_scat_id
				AND ad.`category_id` = '5' AND ad.`sub_scat_id`=17 AND ad.ad_status = 1 AND ad.expire_data >='19-04-2016 10:10:10') AS cloths,
				(SELECT COUNT(*) FROM postad AS ad, `sub_subcategory` AS scat WHERE scat.`sub_subcategory_id` = ad.sub_scat_id
				AND ad.`category_id` = '5' AND ad.`sub_scat_id`=18 AND ad.ad_status = 1 AND ad.expire_data >='19-04-2016 10:10:10') AS feed,
				(SELECT COUNT(*) FROM postad AS ad, `sub_subcategory` AS scat WHERE scat.`sub_subcategory_id` = ad.sub_scat_id
				AND ad.`category_id` = '5' AND ad.`sub_scat_id`=19 AND ad.ad_status = 1 AND ad.expire_data >='19-04-2016 10:10:10') AS beds,
				(SELECT COUNT(*) FROM postad AS ad, `sub_subcategory` AS scat WHERE scat.`sub_subcategory_id` = ad.sub_scat_id
				AND ad.`category_id` = '5' AND ad.`sub_scat_id`=20 AND ad.ad_status = 1 AND ad.expire_data >='19-04-2016 10:10:10') AS odour,
				(SELECT COUNT(*) FROM postad AS ad, `sub_subcategory` AS scat WHERE scat.`sub_subcategory_id` = ad.sub_scat_id
				AND ad.`category_id` = '5' AND ad.`sub_scat_id`=21 AND ad.ad_status = 1 AND ad.expire_data >='19-04-2016 10:10:10') AS fish,
				(SELECT COUNT(*) FROM postad AS ad, `sub_subcategory` AS scat WHERE scat.`sub_subcategory_id` = ad.sub_scat_id
				AND ad.`category_id` = '5' AND ad.`sub_scat_id`=22 AND ad.ad_status = 1 AND ad.expire_data >='19-04-2016 10:10:10') AS marine,
				(SELECT COUNT(*) FROM postad AS ad, `sub_subcategory` AS scat WHERE scat.`sub_subcategory_id` = ad.sub_scat_id
				AND ad.`category_id` = '5' AND ad.`sub_scat_id`=23 AND ad.ad_status = 1 AND ad.expire_data >='19-04-2016 10:10:10') AS land,
				(SELECT COUNT(*) FROM postad AS ad, `sub_subcategory` AS scat WHERE scat.`sub_subcategory_id` = ad.sub_scat_id
				AND ad.`category_id` = '5' AND ad.`sub_scat_id`=24 AND ad.ad_status = 1 AND ad.expire_data >='19-04-2016 10:10:10') AS stuff");
				$rs = $this->db->get();
				return $rs->result();
			}

			/* motor sub category*/
			public function motor_sub_search(){
				$data = date("Y-m-d H:i:s");
				        	$this->db->select("(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
								AND ad.`category_id` = '3' AND ad.`sub_cat_id`=12 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS car,
								(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
								AND ad.`category_id` = '3' AND ad.`sub_cat_id`=13 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS bikes,
								(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
								AND ad.`category_id` = '3' AND ad.`sub_cat_id`=14 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS motorhomes,
								(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
								AND ad.`category_id` = '3' AND ad.`sub_cat_id`=15 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS vans,
								(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
								AND ad.`category_id` = '3' AND ad.`sub_cat_id`=16 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS buses,
								(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
								AND ad.`category_id` = '3' AND ad.`sub_cat_id`=17 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS plants,
								(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
								AND ad.`category_id` = '3' AND ad.`sub_cat_id`=18 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS farming,
								(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
								AND ad.`category_id` = '3' AND ad.`sub_cat_id`=19 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS bloats");
		return $this->db->get()->result();
			}

			/*ezone sub category*/
			public function ezone_sub_search(){
				$data = date("Y-m-d H:i:s");
				        	$this->db->select("(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=59 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS phones,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=60 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS homes,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=61 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS small,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=62 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS lappy,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=63 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS access,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=64 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS pcare,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=65 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS entertain,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=66 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS grapy,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=70 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS computer,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=71 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS network,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=72 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS software");
									return $this->db->get()->result();
			}

			/*phone and tablets*/
			public function ptablets_sub_search(){
				$data = date("Y-m-d H:i:s");
				        	$this->db->select("(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=59 AND ad.sub_scat_id = 383 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS mphone,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=59 AND ad.sub_scat_id = 384 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS ipad,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=59 AND ad.sub_scat_id = 385 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS btooth,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=59 AND ad.sub_scat_id = 386 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS land,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=59 AND ad.sub_scat_id = 387 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS adap,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=59 AND ad.sub_scat_id = 388 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS docks,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=59 AND ad.sub_scat_id = 389 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS cases,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=59 AND ad.sub_scat_id = 390 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS guard,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=59 AND ad.sub_scat_id = 391 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS pbank,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=59 AND ad.sub_scat_id = 392 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS wdevice");
									return $this->db->get()->result();
			}

			/*home appliances for ezone*/
			public function happliance_sub_search(){
				$data = date("Y-m-d H:i:s");
				        	$this->db->select("(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=60 AND ad.sub_scat_id = 393 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS ac,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=60 AND ad.sub_scat_id = 394 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS acooler,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=60 AND ad.sub_scat_id = 395 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS fans,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=60 AND ad.sub_scat_id = 396 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS freez,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=60 AND ad.sub_scat_id = 397 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS wash,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=60 AND ad.sub_scat_id = 398 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS iron,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=60 AND ad.sub_scat_id = 399 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS vacum,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=60 AND ad.sub_scat_id = 400 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS heater,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=60 AND ad.sub_scat_id = 401 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS rheater,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=60 AND ad.sub_scat_id = 402 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS sewing,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=60 AND ad.sub_scat_id = 403 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS dryers,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=60 AND ad.sub_scat_id = 404 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS elight,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=60 AND ad.sub_scat_id = 494 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS inverters,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=60 AND ad.sub_scat_id = 495 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS others");
									return $this->db->get()->result();
			}
			/*small appliances for ezone*/
			public function sappliance_sub_search(){
				$data = date("Y-m-d H:i:s");
				        	$this->db->select("(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=61 AND ad.sub_scat_id = 405 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS oven,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=61 AND ad.sub_scat_id = 406 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS fprocess,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=61 AND ad.sub_scat_id = 407 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS mixer,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=61 AND ad.sub_scat_id = 408 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS cooker,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=61 AND ad.sub_scat_id = 409 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS sandwich,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=61 AND ad.sub_scat_id = 410 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS chopper,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=61 AND ad.sub_scat_id = 411 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS grill,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=61 AND ad.sub_scat_id = 412 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS kettle,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=61 AND ad.sub_scat_id = 413 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS fryer,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=61 AND ad.sub_scat_id = 414 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS purifier,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=61 AND ad.sub_scat_id = 415 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS dishwash,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=61 AND ad.sub_scat_id = 416 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS flour,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=61 AND ad.sub_scat_id = 496 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS stabilizer,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=61 AND ad.sub_scat_id = 497 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS others");
									return $this->db->get()->result();
			}
			/*laptop and computers */
			public function laptopcomputer_sub_search(){
				$data = date("Y-m-d H:i:s");
				        	$this->db->select("(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=62 AND ad.sub_scat_id = 417 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS laptop,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=62 AND ad.sub_scat_id = 418 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS allinone,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=62 AND ad.sub_scat_id = 419 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS printer,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=62 AND ad.sub_scat_id = 420 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS wifi,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=62 AND ad.sub_scat_id = 421 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS harddrive,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=62 AND ad.sub_scat_id = 422 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS pendrive,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=62 AND ad.sub_scat_id = 423 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS keyboard,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=62 AND ad.sub_scat_id = 424 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS mouse,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=62 AND ad.sub_scat_id = 425 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS headset,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=62 AND ad.sub_scat_id = 426 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS cables,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=62 AND ad.sub_scat_id = 427 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS ink,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=62 AND ad.sub_scat_id = 428 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS software");
									return $this->db->get()->result();
			}
			/*accessories for ezone */
			public function accesszone_sub_search(){
				$data = date("Y-m-d H:i:s");
				        	$this->db->select("(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=63 AND ad.sub_scat_id = 429 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS tablet,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=63 AND ad.sub_scat_id = 432 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS caccess,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=63 AND ad.sub_scat_id = 433 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS headphone,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=63 AND ad.sub_scat_id = 434 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS avaccess,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=63 AND ad.sub_scat_id = 435 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS camera,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=63 AND ad.sub_scat_id = 436 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS inverter,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=63 AND ad.sub_scat_id = 436 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS battery,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=63 AND ad.sub_scat_id = 437 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS others");
									return $this->db->get()->result();
			}
			/*personal care for ezone */
			public function pcarecnt_search(){
				$data = date("Y-m-d H:i:s");
				        	$this->db->select("(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=64 AND ad.sub_scat_id = 438 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS shavers,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=64 AND ad.sub_scat_id = 439 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS trimmer,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=64 AND ad.sub_scat_id = 440 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS goomers,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=64 AND ad.sub_scat_id = 441 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS dryers,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=64 AND ad.sub_scat_id = 442 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS stylers,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=64 AND ad.sub_scat_id = 443 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS epilator,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=64 AND ad.sub_scat_id = 444 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS pedometer,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=64 AND ad.sub_scat_id = 445 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS massage,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=64 AND ad.sub_scat_id = 446 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS others");
									return $this->db->get()->result();
			}
			/*Home Entertainment for ezone */
			public function hentertainment_search(){
				$data = date("Y-m-d H:i:s");
				        	$this->db->select("(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=65 AND ad.sub_scat_id = 447 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS lcdled,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=65 AND ad.sub_scat_id = 448 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS theatre,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=65 AND ad.sub_scat_id = 449 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS bluray,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=65 AND ad.sub_scat_id = 450 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS audio,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=65 AND ad.sub_scat_id = 451 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS gaming,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=65 AND ad.sub_scat_id = 452 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS musical,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=65 AND ad.sub_scat_id = 453 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS others");
									return $this->db->get()->result();
			}
			/*Home Entertainment for ezone */
			public function photography_search(){
				$data = date("Y-m-d H:i:s");
				        	$this->db->select("(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=66 AND ad.sub_scat_id = 454 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS digital,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=66 AND ad.sub_scat_id = 455 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS pointshoot,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=66 AND ad.sub_scat_id = 456 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS camcorder,
							(SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id
							AND ad.`category_id` = '8' AND ad.`sub_cat_id`=66 AND ad.sub_scat_id = 498 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS others");
									return $this->db->get()->result();
			}

			public function phone_sub_search(){
				$data = date("Y-m-d H:i:s");
				$this->db->select("sscat.*,COUNT(ad.ad_id) AS no_ads");
				$this->db->from('sub_subcategory AS sscat');
				$this->db->join("postad AS ad", "ad.sub_scat_id= sscat.sub_subcategory_id AND ad.ad_status = 1 AND ad.expire_data >='$data'", "left");
				$this->db->where("sscat.sub_category_id", '59');
				$this->db->group_by("sscat.sub_subcategory_id");
				$rs = $this->db->get();
				 // echo $this->db->last_query(); exit;
				return $rs->result();
			}

			public function homes_sub_search(){
				$data = date("Y-m-d H:i:s");
				$this->db->select("sscat.*,COUNT(ad.ad_id) AS no_ads");
				$this->db->from('sub_subcategory AS sscat');
				$this->db->join("postad AS ad", "ad.sub_scat_id= sscat.sub_subcategory_id AND ad.ad_status = 1 AND ad.expire_data >='$data'", "left");
				$this->db->where("sscat.sub_category_id", '60');
				$this->db->group_by("sscat.sub_subcategory_id");
				$rs = $this->db->get();
				 // echo $this->db->last_query(); exit;
				return $rs->result();
			}
			/*small appliances*/
			public function smalls_sub_search(){
				$data = date("Y-m-d H:i:s");
				$this->db->select("sub_subcategory.*, COUNT(postad.sub_scat_id) AS no_ads");
				$this->db->from('sub_subcategory');
				$this->db->join("postad", "postad.sub_scat_id = sub_subcategory.sub_subcategory_id AND postad.ad_status = 1 AND postad.expire_data >='$data'", "left");
				$this->db->where("sub_subcategory.sub_category_id", '61');
				$this->db->group_by("sub_subcategory.sub_subcategory_id");
				$rs = $this->db->get();
				 // echo $this->db->last_query(); exit;
				return $rs->result();
			}
			public function lappy_sub_search(){
				$data = date("Y-m-d H:i:s");
				$this->db->select("sub_subcategory.*, COUNT(postad.sub_scat_id) AS no_ads");
				$this->db->from('sub_subcategory');
				$this->db->join("postad", "postad.sub_scat_id = sub_subcategory.sub_subcategory_id AND postad.ad_status = 1 AND postad.expire_data >='$data'", "left");
				$this->db->where("sub_subcategory.sub_category_id", '62');
				$this->db->group_by("sub_subcategory.sub_subcategory_id");
				$rs = $this->db->get();
				 // echo $this->db->last_query(); exit;
				return $rs->result();
			}
			public function access_sub_search(){
				$data = date("Y-m-d H:i:s");
				$this->db->select("sub_subcategory.*, COUNT(postad.sub_scat_id) AS no_ads");
				$this->db->from('sub_subcategory');
				$this->db->join("postad", "postad.sub_scat_id = sub_subcategory.sub_subcategory_id AND postad.ad_status = 1 AND postad.expire_data >='$data'", "left");
				$this->db->where("sub_subcategory.sub_category_id", '63');
				$this->db->group_by("sub_subcategory.sub_subcategory_id");
				$rs = $this->db->get();
				 // echo $this->db->last_query(); exit;
				return $rs->result();
			}
			public function pcare_sub_search(){
				$data = date("Y-m-d H:i:s");
				$this->db->select("sub_subcategory.*, COUNT(postad.sub_scat_id) AS no_ads");
				$this->db->from('sub_subcategory');
				$this->db->join("postad", "postad.sub_scat_id = sub_subcategory.sub_subcategory_id AND postad.ad_status = 1 AND postad.expire_data >='$data'", "left");
				$this->db->where("sub_subcategory.sub_category_id", '64');
				$this->db->group_by("sub_subcategory.sub_subcategory_id");
				$rs = $this->db->get();
				 // echo $this->db->last_query(); exit;
				return $rs->result();
			}
			public function entertain_sub_search(){
				$data = date("Y-m-d H:i:s");
				$this->db->select("sub_subcategory.*, COUNT(postad.sub_scat_id) AS no_ads");
				$this->db->from('sub_subcategory');
				$this->db->join("postad", "postad.sub_scat_id = sub_subcategory.sub_subcategory_id AND postad.ad_status = 1 AND postad.expire_data >='$data'", "left");
				$this->db->where("sub_subcategory.sub_category_id", '65');
				$this->db->group_by("sub_subcategory.sub_subcategory_id");
				$rs = $this->db->get();
				 // echo $this->db->last_query(); exit;
				return $rs->result();
			}
			public function poto_sub_search(){
				$data = date("Y-m-d H:i:s");
				$this->db->select("sub_subcategory.*, COUNT(postad.sub_scat_id) AS no_ads");
				$this->db->from('sub_subcategory');
				$this->db->join("postad", "postad.sub_scat_id = sub_subcategory.sub_subcategory_id AND postad.ad_status = 1 AND postad.expire_data >='$data'", "left");
				$this->db->where("sub_subcategory.sub_category_id", '66');
				$this->db->group_by("sub_subcategory.sub_subcategory_id");
				$rs = $this->db->get();
				 // echo $this->db->last_query(); exit;
				return $rs->result();
			}

			/*boats sub category*/	
			public function boats_sub_search(){
				$this->db->select("sscat.*,COUNT(ad.ad_id) AS no_ads");
				$this->db->from('sub_subcategory AS sscat');
				$this->db->join("postad AS ad", "ad.sub_scat_id= sscat.sub_subcategory_id", "left");
				$this->db->where("sscat.sub_category_id", '19');
				$this->db->group_by("sscat.sub_subcategory_id");
				$rs = $this->db->get();
				 // echo $this->db->last_query(); exit;
				return $rs->result();
			}

			/*plant machinery sub category*/
			public function plants_sub_search(){
				$this->db->select("sscat.*,COUNT(ad.ad_id) AS no_ads");
				$this->db->from('sub_subcategory AS sscat');
				$this->db->join("postad AS ad", "ad.sub_scat_id= sscat.sub_subcategory_id", "left");
				$this->db->where("sscat.sub_category_id", '17');
				$this->db->group_by("sscat.sub_subcategory_id");
				$rs = $this->db->get();
				 // echo $this->db->last_query(); exit;
				return $rs->result();
			}
			/*farming vehicles sub category*/
			public function farming_sub_search(){
				$this->db->select("sscat.*,COUNT(ad.ad_id) AS no_ads");
				$this->db->from('sub_subcategory AS sscat');
				$this->db->join("postad AS ad", "ad.sub_scat_id= sscat.sub_subcategory_id", "left");
				$this->db->where("sscat.sub_category_id", '18');
				$this->db->group_by("sscat.sub_subcategory_id");
				$rs = $this->db->get();
				 // echo $this->db->last_query(); exit;
				return $rs->result();
			}

			public function motorcars_cnt(){
	        	$date = date("Y-m-d H:i:s");
	        	$this->db->select("*, COUNT(result.ad_id) AS no_ads");
	        	$this->db->from("sub_subcategory AS sscat");
	        	$this->db->join("(SELECT cars.* FROM `postad` AS ad, `motor_car_van_bus_ads` AS cars WHERE cars.`ad_id` = ad.`ad_id` AND ad.ad_status = 1 AND ad.expire_data >='$date') AS result", "result.manufacture = sscat.sub_subcategory_id", "left");
				$this->db->where("sscat.sub_category_id", 12);
	        	$this->db->group_by("sscat.sub_subcategory_id");
	        	$rs = $this->db->get();
	        	return $rs->result();
	        }
			public function petrolcnt(){
				$data = date("Y-m-d H:i:s");
				$this->db->select("(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_car_van_bus_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=12 AND mc.ad_id = ad.`ad_id` AND mc.`fueltype` = 'Petrol') AS petrol,
		(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_car_van_bus_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=12 AND mc.ad_id = ad.`ad_id` AND mc.`fueltype` = 'Diesel') AS diesel,
		(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_car_van_bus_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=12 AND mc.ad_id = ad.`ad_id` AND mc.`fueltype` = 'Electric') AS electric");
		return $this->db->get()->result();
			}
			public function caravans_petrolcnt(){
				$data = date("Y-m-d H:i:s");
				$this->db->select("(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_home_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=14 AND mc.ad_id = ad.`ad_id` AND mc.`fueltype` = 'Petrol') AS petrol,
		(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_home_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=14 AND mc.ad_id = ad.`ad_id` AND mc.`fueltype` = 'Diesel') AS diesel,
		(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_home_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=14 AND mc.ad_id = ad.`ad_id` AND mc.`fueltype` = 'Electric') AS electric");
		return $this->db->get()->result();
			}
			public function coaches_petrolcnt(){
				$data = date("Y-m-d H:i:s");
				$this->db->select("(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_car_van_bus_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=16 AND mc.ad_id = ad.`ad_id` AND mc.`fueltype` = 'Petrol') AS petrol,
		(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_car_van_bus_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=16 AND mc.ad_id = ad.`ad_id` AND mc.`fueltype` = 'Diesel') AS diesel,
		(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_car_van_bus_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=16 AND mc.ad_id = ad.`ad_id` AND mc.`fueltype` = 'Electric') AS electric");
		return $this->db->get()->result();
			}
			public function vans_petrolcnt(){
				$data = date("Y-m-d H:i:s");
				$this->db->select("(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_car_van_bus_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=15 AND mc.ad_id = ad.`ad_id` AND mc.`fueltype` = 'Petrol') AS petrol,
		(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_car_van_bus_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=15 AND mc.ad_id = ad.`ad_id` AND mc.`fueltype` = 'Diesel') AS diesel,
		(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_car_van_bus_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=15 AND mc.ad_id = ad.`ad_id` AND mc.`fueltype` = 'Electric') AS electric");
		return $this->db->get()->result();
			}
			public function bikepetrolcnt(){
				$data = date("Y-m-d H:i:s");
				$this->db->select("(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_bike_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=13 AND mc.ad_id = ad.`ad_id` AND mc.`fuel_type` = 'Petrol') AS petrol,
		(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_bike_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=13 AND mc.ad_id = ad.`ad_id` AND mc.`fuel_type` = 'Diesel') AS diesel");
		return $this->db->get()->result();
			}

			public function milagecnt(){
				$data = date("Y-m-d H:i:s");
				$this->db->select("(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_car_van_bus_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=12 AND mc.ad_id = ad.`ad_id` AND mc.`tot_miles` > '0') AS allmiles,
		(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_car_van_bus_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=12 AND mc.ad_id = ad.`ad_id` AND mc.`tot_miles` BETWEEN '1' AND '15000') AS fiftin,
		(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_car_van_bus_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=12 AND mc.ad_id = ad.`ad_id` AND mc.`tot_miles` BETWEEN '15001' AND '30000') AS thirty,
		(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_car_van_bus_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=12 AND mc.ad_id = ad.`ad_id` AND mc.`tot_miles` BETWEEN '30001' AND '50000') AS fifty,
		(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_car_van_bus_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=12 AND mc.ad_id = ad.`ad_id` AND mc.`tot_miles` > '50000') AS sixty");
		return $this->db->get()->result();
			}
			public function caravans_milagecnt(){
				$data = date("Y-m-d H:i:s");
				$this->db->select("(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_home_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=14 AND mc.ad_id = ad.`ad_id` AND mc.`tot_miles` > '0') AS allmiles,
		(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_home_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=14 AND mc.ad_id = ad.`ad_id` AND mc.`tot_miles` BETWEEN '1' AND '15000') AS fiftin,
		(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_home_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=14 AND mc.ad_id = ad.`ad_id` AND mc.`tot_miles` BETWEEN '15001' AND '30000') AS thirty,
		(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_home_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=14 AND mc.ad_id = ad.`ad_id` AND mc.`tot_miles` BETWEEN '30001' AND '50000') AS fifty,
		(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_home_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=14 AND mc.ad_id = ad.`ad_id` AND mc.`tot_miles` > '50000') AS sixty");
		return $this->db->get()->result();
			}
			public function coaches_milagecnt(){
				$data = date("Y-m-d H:i:s");
				$this->db->select("(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_car_van_bus_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=16 AND mc.ad_id = ad.`ad_id` AND mc.`tot_miles` > '0') AS allmiles,
		(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_car_van_bus_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=16 AND mc.ad_id = ad.`ad_id` AND mc.`tot_miles` BETWEEN '1' AND '15000') AS fiftin,
		(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_car_van_bus_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=16 AND mc.ad_id = ad.`ad_id` AND mc.`tot_miles` BETWEEN '15001' AND '30000') AS thirty,
		(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_car_van_bus_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=16 AND mc.ad_id = ad.`ad_id` AND mc.`tot_miles` BETWEEN '30001' AND '50000') AS fifty,
		(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_car_van_bus_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=16 AND mc.ad_id = ad.`ad_id` AND mc.`tot_miles` > '50000') AS sixty");
		return $this->db->get()->result();
			}
			public function vans_milagecnt(){
				$data = date("Y-m-d H:i:s");
				$this->db->select("(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_car_van_bus_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=15 AND mc.ad_id = ad.`ad_id` AND mc.`tot_miles` > '0') AS allmiles,
		(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_car_van_bus_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=15 AND mc.ad_id = ad.`ad_id` AND mc.`tot_miles` BETWEEN '1' AND '15000') AS fiftin,
		(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_car_van_bus_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=15 AND mc.ad_id = ad.`ad_id` AND mc.`tot_miles` BETWEEN '15001' AND '30000') AS thirty,
		(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_car_van_bus_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=15 AND mc.ad_id = ad.`ad_id` AND mc.`tot_miles` BETWEEN '30001' AND '50000') AS fifty,
		(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_car_van_bus_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=15 AND mc.ad_id = ad.`ad_id` AND mc.`tot_miles` > '50000') AS sixty");
		return $this->db->get()->result();
			}
			public function bikemilagecnt(){
				$data = date("Y-m-d H:i:s");
				$this->db->select("(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_bike_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=13 AND mc.ad_id = ad.`ad_id` AND mc.`no_of_miles` > '0') AS allmiles,
		(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_bike_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=13 AND mc.ad_id = ad.`ad_id` AND mc.`no_of_miles` BETWEEN '1' AND '15000') AS fiftin,
		(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_bike_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=13 AND mc.ad_id = ad.`ad_id` AND mc.`no_of_miles` BETWEEN '15001' AND '30000') AS thirty,
		(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_bike_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=13 AND mc.ad_id = ad.`ad_id` AND mc.`no_of_miles` BETWEEN '30001' AND '50000') AS fifty,
		(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_bike_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=13 AND mc.ad_id = ad.`ad_id` AND mc.`no_of_miles` > '50000') AS sixty");
		return $this->db->get()->result();
			}
			public function enginecnt(){
				$data = date("Y-m-d H:i:s");
				$this->db->select("(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_car_van_bus_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=12 AND mc.ad_id = ad.`ad_id` AND mc.`engine_size` > '0') AS allengine,
		(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_car_van_bus_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=12 AND mc.ad_id = ad.`ad_id` AND mc.`engine_size` BETWEEN '1' AND '1000') AS thousand,
		(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_car_van_bus_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=12 AND mc.ad_id = ad.`ad_id` AND mc.`engine_size` BETWEEN '1001' AND '2000') AS tthousand,
		(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_car_van_bus_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=12 AND mc.ad_id = ad.`ad_id` AND mc.`engine_size` BETWEEN '2001' AND '3000') AS ttthousand,
		(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_car_van_bus_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=12 AND mc.ad_id = ad.`ad_id` AND mc.`engine_size` > '3000') AS tttthousand");
		return $this->db->get()->result();
			}
			public function caravans_enginecnt(){
				$data = date("Y-m-d H:i:s");
				$this->db->select("(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_home_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=14 AND mc.ad_id = ad.`ad_id` AND mc.`engine_size` > '0') AS allengine,
		(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_home_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=14 AND mc.ad_id = ad.`ad_id` AND mc.`engine_size` BETWEEN '1' AND '1000') AS thousand,
		(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_home_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=14 AND mc.ad_id = ad.`ad_id` AND mc.`engine_size` BETWEEN '1001' AND '2000') AS tthousand,
		(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_home_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=14 AND mc.ad_id = ad.`ad_id` AND mc.`engine_size` BETWEEN '2001' AND '3000') AS ttthousand,
		(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_home_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=14 AND mc.ad_id = ad.`ad_id` AND mc.`engine_size` > '3000') AS tttthousand");
		return $this->db->get()->result();
			}
			public function coaches_enginecnt(){
				$data = date("Y-m-d H:i:s");
				$this->db->select("(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_car_van_bus_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=16 AND mc.ad_id = ad.`ad_id` AND mc.`engine_size` > '0') AS allengine,
		(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_car_van_bus_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=16 AND mc.ad_id = ad.`ad_id` AND mc.`engine_size` BETWEEN '1' AND '1000') AS thousand,
		(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_car_van_bus_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=16 AND mc.ad_id = ad.`ad_id` AND mc.`engine_size` BETWEEN '1001' AND '2000') AS tthousand,
		(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_car_van_bus_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=16 AND mc.ad_id = ad.`ad_id` AND mc.`engine_size` BETWEEN '2001' AND '3000') AS ttthousand,
		(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_car_van_bus_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=16 AND mc.ad_id = ad.`ad_id` AND mc.`engine_size` > '3000') AS tttthousand");
		return $this->db->get()->result();
			}
			public function vans_enginecnt(){
				$data = date("Y-m-d H:i:s");
				$this->db->select("(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_car_van_bus_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=15 AND mc.ad_id = ad.`ad_id` AND mc.`engine_size` > '0') AS allengine,
		(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_car_van_bus_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=15 AND mc.ad_id = ad.`ad_id` AND mc.`engine_size` BETWEEN '1' AND '1000') AS thousand,
		(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_car_van_bus_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=15 AND mc.ad_id = ad.`ad_id` AND mc.`engine_size` BETWEEN '1001' AND '2000') AS tthousand,
		(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_car_van_bus_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=15 AND mc.ad_id = ad.`ad_id` AND mc.`engine_size` BETWEEN '2001' AND '3000') AS ttthousand,
		(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_car_van_bus_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=15 AND mc.ad_id = ad.`ad_id` AND mc.`engine_size` > '3000') AS tttthousand");
		return $this->db->get()->result();
			}
			public function bikeenginecnt(){
				$data = date("Y-m-d H:i:s");
				$this->db->select("(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_bike_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=13 AND mc.ad_id = ad.`ad_id` AND mc.`engine_size` > '0') AS allengine,
		(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_bike_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=13 AND mc.ad_id = ad.`ad_id` AND mc.`engine_size` BETWEEN '1' AND '1000') AS thousand,
		(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_bike_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=13 AND mc.ad_id = ad.`ad_id` AND mc.`engine_size` BETWEEN '1001' AND '2000') AS tthousand,
		(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_bike_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=13 AND mc.ad_id = ad.`ad_id` AND mc.`engine_size` BETWEEN '2001' AND '3000') AS ttthousand,
		(SELECT COUNT(*) FROM postad AS ad, sub_category AS scat, motor_bike_ads AS mc WHERE scat.sub_category_id = ad.sub_cat_id
		AND ad.`category_id` = '3' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=13 AND mc.ad_id = ad.`ad_id` AND mc.`engine_size` > '3000') AS tttthousand");
		return $this->db->get()->result();
			}

			/* kitchen sub category*/
			public function kitchenhome_sub_cnt(){
				$data = date("Y-m-d H:i:s");
				$this->db->select(" (SELECT COUNT(*) FROM postad AS ad,`sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id AND ad.`category_id` = '7' 
	    AND ad.`sub_cat_id` = 67 AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS kitchen,
	  (SELECT COUNT(*) FROM postad AS ad, `sub_category` AS scat  WHERE scat.sub_category_id = ad.sub_cat_id  AND ad.`category_id` = '7' 
	    AND ad.`sub_cat_id` = 68  AND ad.ad_status = 1  AND ad.expire_data >= '$data') AS home,
	  (SELECT COUNT(*) FROM postad AS ad,`sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id AND ad.`category_id` = '7' 
	    AND ad.`sub_cat_id` = 69  AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS decor");
				return $this->db->get()->result();
			}

		public function kessentials_cnt(){
			$data = date("Y-m-d H:i:s");
			$this->db->select("(SELECT COUNT(*) FROM postad AS ad,`sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id AND ad.`category_id` = '7' 
				AND ad.`sub_cat_id` = 67 AND ad.`sub_scat_id`=457 AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS tools,
				(SELECT COUNT(*) FROM postad AS ad,`sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id AND ad.`category_id` = '7' 
				AND ad.`sub_cat_id` = 67 AND ad.`sub_scat_id`=458 AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS kstorage,
				(SELECT COUNT(*) FROM postad AS ad,`sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id AND ad.`category_id` = '7' 
				AND ad.`sub_cat_id` = 67 AND ad.`sub_scat_id`=459 AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS cookware,
				(SELECT COUNT(*) FROM postad AS ad,`sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id AND ad.`category_id` = '7' 
				AND ad.`sub_cat_id` = 67 AND ad.`sub_scat_id`=460 AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS bakeware,
				(SELECT COUNT(*) FROM postad AS ad,`sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id AND ad.`category_id` = '7' 
				AND ad.`sub_cat_id` = 67 AND ad.`sub_scat_id`=461 AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS burners,
				(SELECT COUNT(*) FROM postad AS ad,`sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id AND ad.`category_id` = '7' 
				AND ad.`sub_cat_id` = 67 AND ad.`sub_scat_id`=462 AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS furniture,
				(SELECT COUNT(*) FROM postad AS ad,`sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id AND ad.`category_id` = '7' 
				AND ad.`sub_cat_id` = 67 AND ad.`sub_scat_id`=463 AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS linen,
				(SELECT COUNT(*) FROM postad AS ad,`sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id AND ad.`category_id` = '7' 
				AND ad.`sub_cat_id` = 67 AND ad.`sub_scat_id`=464 AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS others");
				return $this->db->get()->result();
		}	
		public function homeessentials_cnt(){
			$data = date("Y-m-d H:i:s");
			$this->db->select("(SELECT COUNT(*) FROM postad AS ad,`sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id AND ad.`category_id` = '7' 
				AND ad.`sub_cat_id` = 68 AND ad.`sub_scat_id`=465 AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS bath,
				(SELECT COUNT(*) FROM postad AS ad,`sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id AND ad.`category_id` = '7' 
				AND ad.`sub_cat_id` = 68 AND ad.`sub_scat_id`=466 AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS bed,
				(SELECT COUNT(*) FROM postad AS ad,`sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id AND ad.`category_id` = '7' 
				AND ad.`sub_cat_id` = 68 AND ad.`sub_scat_id`=467 AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS carpet,
				(SELECT COUNT(*) FROM postad AS ad,`sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id AND ad.`category_id` = '7' 
				AND ad.`sub_cat_id` = 68 AND ad.`sub_scat_id`=468 AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS cleaning,
				(SELECT COUNT(*) FROM postad AS ad,`sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id AND ad.`category_id` = '7' 
				AND ad.`sub_cat_id` = 68 AND ad.`sub_scat_id`=469 AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS plumb,
				(SELECT COUNT(*) FROM postad AS ad,`sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id AND ad.`category_id` = '7' 
				AND ad.`sub_cat_id` = 68 AND ad.`sub_scat_id`=470 AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS wind,
				(SELECT COUNT(*) FROM postad AS ad,`sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id AND ad.`category_id` = '7' 
				AND ad.`sub_cat_id` = 68 AND ad.`sub_scat_id`=471 AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS door,
				(SELECT COUNT(*) FROM postad AS ad,`sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id AND ad.`category_id` = '7' 
				AND ad.`sub_cat_id` = 68 AND ad.`sub_scat_id`=472 AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS garden,
				(SELECT COUNT(*) FROM postad AS ad,`sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id AND ad.`category_id` = '7' 
				AND ad.`sub_cat_id` = 68 AND ad.`sub_scat_id`=473 AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS furniture,
				(SELECT COUNT(*) FROM postad AS ad,`sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id AND ad.`category_id` = '7' 
				AND ad.`sub_cat_id` = 68 AND ad.`sub_scat_id`=474 AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS shed,
				(SELECT COUNT(*) FROM postad AS ad,`sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id AND ad.`category_id` = '7' 
				AND ad.`sub_cat_id` = 68 AND ad.`sub_scat_id`=475 AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS plants,
				(SELECT COUNT(*) FROM postad AS ad,`sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id AND ad.`category_id` = '7' 
				AND ad.`sub_cat_id` = 68 AND ad.`sub_scat_id`=476 AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS dining,
				(SELECT COUNT(*) FROM postad AS ad,`sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id AND ad.`category_id` = '7' 
				AND ad.`sub_cat_id` = 68 AND ad.`sub_scat_id`=477 AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS living,
				(SELECT COUNT(*) FROM postad AS ad,`sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id AND ad.`category_id` = '7' 
				AND ad.`sub_cat_id` = 68 AND ad.`sub_scat_id`=478 AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS kids,
				(SELECT COUNT(*) FROM postad AS ad,`sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id AND ad.`category_id` = '7' 
				AND ad.`sub_cat_id` = 68 AND ad.`sub_scat_id`=479 AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS outdoor,
				(SELECT COUNT(*) FROM postad AS ad,`sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id AND ad.`category_id` = '7' 
				AND ad.`sub_cat_id` = 68 AND ad.`sub_scat_id`=480 AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS study,
				(SELECT COUNT(*) FROM postad AS ad,`sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id AND ad.`category_id` = '7' 
				AND ad.`sub_cat_id` = 68 AND ad.`sub_scat_id`=481 AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS others");
				return $this->db->get()->result();
		}
		public function decor_cnt(){
			$data = date("Y-m-d H:i:s");
			$this->db->select("(SELECT COUNT(*) FROM postad AS ad,`sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id AND ad.`category_id` = '7' 
				AND ad.`sub_cat_id` = 69 AND ad.`sub_scat_id`=482 AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS curtain,
				(SELECT COUNT(*) FROM postad AS ad,`sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id AND ad.`category_id` = '7' 
				AND ad.`sub_cat_id` = 69 AND ad.`sub_scat_id`=483 AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS candle,
				(SELECT COUNT(*) FROM postad AS ad,`sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id AND ad.`category_id` = '7' 
				AND ad.`sub_cat_id` = 69 AND ad.`sub_scat_id`=484 AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS vases,
				(SELECT COUNT(*) FROM postad AS ad,`sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id AND ad.`category_id` = '7' 
				AND ad.`sub_cat_id` = 69 AND ad.`sub_scat_id`=485 AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS wall,
				(SELECT COUNT(*) FROM postad AS ad,`sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id AND ad.`category_id` = '7' 
				AND ad.`sub_cat_id` = 69 AND ad.`sub_scat_id`=486 AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS home,
				(SELECT COUNT(*) FROM postad AS ad,`sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id AND ad.`category_id` = '7' 
				AND ad.`sub_cat_id` = 69 AND ad.`sub_scat_id`=487 AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS religon,
				(SELECT COUNT(*) FROM postad AS ad,`sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id AND ad.`category_id` = '7' 
				AND ad.`sub_cat_id` = 69 AND ad.`sub_scat_id`=488 AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS frame,
				(SELECT COUNT(*) FROM postad AS ad,`sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id AND ad.`category_id` = '7' 
				AND ad.`sub_cat_id` = 69 AND ad.`sub_scat_id`=489 AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS rugs,
				(SELECT COUNT(*) FROM postad AS ad,`sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id AND ad.`category_id` = '7' 
				AND ad.`sub_cat_id` = 69 AND ad.`sub_scat_id`=490 AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS cushions,
				(SELECT COUNT(*) FROM postad AS ad,`sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id AND ad.`category_id` = '7' 
				AND ad.`sub_cat_id` = 69 AND ad.`sub_scat_id`=491 AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS lamp,
				(SELECT COUNT(*) FROM postad AS ad,`sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id AND ad.`category_id` = '7' 
				AND ad.`sub_cat_id` = 69 AND ad.`sub_scat_id`=492 AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS outdoor,
				(SELECT COUNT(*) FROM postad AS ad,`sub_category` AS scat WHERE scat.sub_category_id = ad.sub_cat_id AND ad.`category_id` = '7' 
				AND ad.`sub_cat_id` = 69 AND ad.`sub_scat_id`=493 AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS others	");
				return $this->db->get()->result();
		}
			public function kitchen_sub_search(){
				$data = date("Y-m-d H:i:s");
				$this->db->select("sub_subcategory.*, COUNT(postad.sub_scat_id) AS no_ads");
				$this->db->from('sub_subcategory');
				$this->db->join("postad", "postad.sub_scat_id = sub_subcategory.sub_subcategory_id AND postad.ad_status = 1 AND postad.expire_data >='$data'", "left");
				$this->db->where("sub_subcategory.sub_category_id", '67');
				$this->db->group_by("sub_subcategory.sub_subcategory_id");
				$rs = $this->db->get();
				 // echo $this->db->last_query(); exit;
				return $rs->result();
			}
			/* home sub category*/
			public function home_sub_search(){
				$data = date("Y-m-d H:i:s");
				$this->db->select("sub_subcategory.*, COUNT(postad.sub_scat_id) AS no_ads");
				$this->db->from('sub_subcategory');
				$this->db->join("postad", "postad.sub_scat_id = sub_subcategory.sub_subcategory_id AND postad.ad_status = 1 AND postad.expire_data >='$data'", "left");
				$this->db->where("sub_subcategory.sub_category_id", '68');
				$this->db->group_by("sub_subcategory.sub_subcategory_id");
				$rs = $this->db->get();
				 // echo $this->db->last_query(); exit;
				return $rs->result();
			}
			/* decor sub category*/
			public function decor_sub_search(){
				$data = date("Y-m-d H:i:s");
				$this->db->select("sub_subcategory.*, COUNT(postad.sub_scat_id) AS no_ads");
				$this->db->from('sub_subcategory');
				$this->db->join("postad", "postad.sub_scat_id = sub_subcategory.sub_subcategory_id AND postad.ad_status = 1 AND postad.expire_data >='$data'", "left");
				$this->db->where("sub_subcategory.sub_category_id", '69');
				$this->db->group_by("sub_subcategory.sub_subcategory_id");
				$rs = $this->db->get();
				 // echo $this->db->last_query(); exit;
				return $rs->result();
			}

			/* decor sub category*/
			public function brand_kitchen(){
				$this->db->select("*");
				$this->db->from('kitchenhome_ads');
				$rs = $this->db->get();
				return $rs->result();
			}

		public function count_hotdeal_search(){
			/*top category*/
			$free = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'1','manage_likes.is_top'=>1))->row('likes_count');
			$freeurgent = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'2','manage_likes.is_top'=>1))->row('likes_count');
			$gold = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'3','manage_likes.is_top'=>1))->row('likes_count');

			/*low category*/
			$low_free = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'4','manage_likes.is_top'=>0))->row('likes_count');
			$low_freeurgent = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'5','manage_likes.is_top'=>0))->row('likes_count');
			$low_gold = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'6','manage_likes.is_top'=>0))->row('likes_count');
			
			
				$cat_id =  $this->session->userdata('cat_id');
				$seller_id =  $this->session->userdata('seller_id');
				$bus_id =  $this->session->userdata('bus_id');
				$search_sub =  $this->session->userdata('search_sub');
				$search_subsub =  $this->session->userdata('search_subsub');
				$search_bustype = $this->session->userdata('search_bustype');
				$dealtitle = $this->session->userdata('dealtitle');
				$dealprice = $this->session->userdata('dealprice');
				$dealurgent = $this->session->userdata('dealurgent');
				$recentdays = $this->session->userdata('recentdays');
				$latt = substr($this->session->userdata('latt'),0,strpos($this->session->userdata('latt'),".") + 4);
				$longg = substr($this->session->userdata('longg'),0,strpos($this->session->userdata('longg'),".") + 4);
				$s_location = $this->session->userdata('location');

				$car_van_bus = $this->session->userdata('car_van_bus');
	            $motor_hm = $this->session->userdata('motor_hm');
	            $bikes_sub = $this->session->userdata('bikes_sub');
	            $plant_farm = $this->session->userdata('plant_farm');
	            $boats_sub = $this->session->userdata('boats_sub');

	            $search_proptype = $this->session->userdata('search_proptype');
				$search_resisub = $this->session->userdata('search_resisub');
				$search_commsub = $this->session->userdata('search_commsub');
				$resi_prop = $this->session->userdata('resi_prop');
				$comm_prop = $this->session->userdata('comm_prop');

				if ($cat_id == 1 || $cat_id == 2 || $cat_id == 3 || $cat_id == 4) {
					$pcktype = '(
			(ad.package_type = "3" OR ad.package_type = "6") OR 
			((ad.package_type = "2" OR ad.package_type = "5" )AND ad.urgent_package != "0" )
			OR (ad.package_type = "1" AND ad.urgent_package != "0" AND ad.likes_count >= "'.$freeurgent.'")
			OR (ad.package_type = "1" AND ad.urgent_package = "0" AND ad.likes_count >= "'.$free.'")
			OR (ad.package_type = "2" AND ad.urgent_package = "0" AND ad.likes_count >= "'.$gold.'") )';
				}
			if ($cat_id == 5 || $cat_id == 6 || $cat_id == 7 || $cat_id == 8) {
					$pcktype = '(
			(ad.package_type = "3" OR ad.package_type = "6") OR 
			((ad.package_type = "2" OR ad.package_type = "5" )AND ad.urgent_package != "0" )
			OR (ad.package_type = "4" AND ad.urgent_package != "0" AND ad.likes_count >= "'.$low_freeurgent.'")
			OR (ad.package_type = "4" AND ad.urgent_package = "0" AND ad.likes_count >= "'.$low_free.'")
			OR (ad.package_type = "5" AND ad.urgent_package = "0" AND ad.likes_count >= "'.$low_gold.'") )';
				}

        		$this->db->select("*, COUNT(`img`.`ad_id`) AS img_count,ud.valid_to AS urg");
        		$this->db->from('postad AS ad');
				$this->db->join('ad_img as img', "img.ad_id = ad.ad_id", 'join');
				$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'join');
				$this->db->join('login as lg', "lg.login_id = ad.login_id", 'join');
				$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
				$this->db->where('ad.ad_status', 1);
				$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
				if ($cat_id) {
					if ($cat_id != 'all') {
						$this->db->where('ad.category_id', $cat_id);
					}
				}
				if (!empty($seller_id)) {
					if ($cat_id != 'all') {
						if ($cat_id == '2' || $cat_id == '3' || $cat_id == '5' || $cat_id == '6' || $cat_id == '7' || $cat_id == '8') {
							$this->db->where_in('ad.services', $seller_id);
						}
						elseif ($cat_id == '1') {
							$this->db->join('job_details AS jd', "jd.ad_id = ad.ad_id", 'left');
									$this->db->where_in('jd.jobtype_title', $seller_id);
						}
						elseif ($cat_id == '4') {
							$this->db->join('property_resid_commercial AS res', "res.ad_id = ad.ad_id", 'left');
								$this->db->where_in('res.offered_type', $seller_id);
						}
					}
				}
				if (!empty($search_sub)) {
					$this->db->where_in('ad.sub_cat_id', $search_sub);
				}
				if ($cat_id == 3) {
					if (!empty($car_van_bus)) {
						$this->db->join('motor_car_van_bus_ads AS cars', "cars.ad_id = ad.ad_id", 'join');
						$this->db->where_in('cars.manufacture', $car_van_bus);
					}
					if (!empty($bikes_sub)) {
						$this->db->join('motor_bike_ads AS bike', "bike.ad_id = ad.ad_id", 'join');
						$this->db->where_in('bike.manufacture', $bikes_sub);
					}
					if (!empty($motor_hm)) {
						$this->db->join('motor_home_ads AS mh', "mh.ad_id = ad.ad_id", 'join');
						$this->db->where_in('mh.manufacture', $motor_hm);
					}
					if (!empty($plant_farm)) {
						$this->db->join('motor_plant_farming AS pf', "pf.ad_id = ad.ad_id", 'join');
						$this->db->where_in('pf.manufacture', $plant_farm);
					}
					if (!empty($boats_sub)) {
						$this->db->join('motor_boats AS mb', "mb.ad_id = ad.ad_id", 'join');
						$this->db->where_in('mb.manufacture', $boats_sub);
					}
				}
				if ($search_proptype) {
					if ($search_proptype == '11' || $search_proptype == '26') {
						$this->db->where("ad.sub_cat_id", $search_proptype);
					}
				}
				if ($search_resisub) {
					$this->db->join('property_resid_commercial AS resi', "resi.ad_id = ad.ad_id", 'join');
					$this->db->where('resi.property_for', $search_resisub);
				}
				if ($search_commsub) {
					$this->db->join('property_resid_commercial AS resi', "resi.ad_id = ad.ad_id", 'join');
					$this->db->where('resi.property_for', $search_commsub);
				}
				if (!empty($resi_prop)) {
					$this->db->join('property_resid_commercial AS resi1', "resi1.ad_id = ad.ad_id", 'join');
					$this->db->where_in('resi1.property_type', $resi_prop);
				}
				if (!empty($comm_prop)) {
					$this->db->join('property_resid_commercial AS resi1', "resi1.ad_id = ad.ad_id", 'join');
					$this->db->where_in('resi1.property_type', $comm_prop);
				}
				if (!empty($search_subsub)) {
						if ($cat_id == 4) {
						$this->db->join('property_resid_commercial AS resi', "resi.ad_id = ad.ad_id", 'join');
						$this->db->where_in('resi.property_for', $search_subsub);
					}
					else{
						$this->db->where_in('ad.sub_scat_id', $search_subsub);
					}
				}
				if ($bus_id != '') {
					$this->db->where('ad.ad_type', $bus_id);
				}
				if ($search_bustype) {
					if ($search_bustype == 'business' || $search_bustype == 'consumer') {
						$this->db->where("ad.ad_type", $search_bustype);
					}
				}
			
			if ($cat_id == 1 || $cat_id == 2 || $cat_id == 3 || $cat_id == 4) {
						/*package search*/
						if (!empty($dealurgent)) {
							$pcklist = [];
							if (in_array("0", $dealurgent)) {
								$this->db->where('ad.urgent_package !=', '0');
							}
							else{
								$this->db->where('ad.urgent_package =', '0');
							}
							if (in_array(1, $dealurgent)){
								array_push($pcklist, 1);
							}
							if (in_array(2, $dealurgent)){
								array_push($pcklist, 2);
							}
							if (in_array(3, $dealurgent)){
								array_push($pcklist, 3);
							}
							if (!empty($pcklist)) {
								$this->db->where_in('ad.package_type', $pcklist);
							}
							
						}
					}
					if ($cat_id == 5 || $cat_id == 6 || $cat_id == 7 || $cat_id == 8) {
						/*package search*/
						if (!empty($dealurgent)) {
							$pcklist = [];
							if (in_array("0", $dealurgent)) {
								$this->db->where('ad.urgent_package !=', '0');
							}
							else{
								$this->db->where('ad.urgent_package =', '0');
							}
							if (in_array(4, $dealurgent)){
								array_push($pcklist, 4);
							}
							if (in_array(5, $dealurgent)){
								array_push($pcklist, 5);
							}
							if (in_array(6, $dealurgent)){
								array_push($pcklist, 6);
							}
							if (!empty($pcklist)) {
								$this->db->where_in('ad.package_type', $pcklist);
							}
							
						}
					}

					if (!empty($pcklist)) {
							$this->db->where_in('ad.package_type', $pcklist);
						}
				/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			/*if ($latt) {
				$this->db->where("(loc.latt LIKE '$latt%' 
  					OR loc.longg LIKE '$longg%')");
			}*/
			if ($s_location != '') {
				$this->db->where("(loc.loc_name LIKE '$s_location%' 
  					OR loc.loc_name LIKE '%$s_location' OR loc.loc_name LIKE '%$s_location%')");
			}

			/*likes counts*/
			/*top category*/
			

				if ($cat_id) {
					if ($cat_id != 'all') {
						$this->db->where($pcktype);
					}
				}
				
				$this->db->group_by("img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
				$this->db->order_by("ad.approved_on", "DESC");
				$m_res = $this->db->get();
				// echo $this->db->last_query(); exit;
				return $m_res->result();
		}

	    public function hotdeal_search($data){
	    	/*top category*/
			$free = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'1','manage_likes.is_top'=>1))->row('likes_count');
			$freeurgent = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'2','manage_likes.is_top'=>1))->row('likes_count');
			$gold = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'3','manage_likes.is_top'=>1))->row('likes_count');

			/*low category*/
			$low_free = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'4','manage_likes.is_top'=>0))->row('likes_count');
			$low_freeurgent = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'5','manage_likes.is_top'=>0))->row('likes_count');
			$low_gold = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'6','manage_likes.is_top'=>0))->row('likes_count');
			
			
	    		$cat_id =  $this->session->userdata('cat_id');
	    		$seller_id =  $this->session->userdata('seller_id');
	    		$bus_id =  $this->session->userdata('bus_id');
	    		$search_sub =  $this->session->userdata('search_sub');
	    		$search_subsub =  $this->session->userdata('search_subsub');
	    		$search_bustype = $this->session->userdata('search_bustype');
				$dealtitle = $this->session->userdata('dealtitle');
				$dealprice = $this->session->userdata('dealprice');
				$recentdays = $this->session->userdata('recentdays');
				$dealurgent = $this->session->userdata('dealurgent');
				$latt = substr($this->session->userdata('latt'),0,strpos($this->session->userdata('latt'),".") + 4);
				$longg = substr($this->session->userdata('longg'),0,strpos($this->session->userdata('longg'),".") + 4);
	    		$s_location = $this->session->userdata('location');

	    		$car_van_bus = $this->session->userdata('car_van_bus');
		        $motor_hm = $this->session->userdata('motor_hm');
		        $bikes_sub = $this->session->userdata('bikes_sub');
		        $plant_farm = $this->session->userdata('plant_farm');
		        $boats_sub = $this->session->userdata('boats_sub');

		        $search_proptype = $this->session->userdata('search_proptype');
				$search_resisub = $this->session->userdata('search_resisub');
				$search_commsub = $this->session->userdata('search_commsub');
				$resi_prop = $this->session->userdata('resi_prop');
				$comm_prop = $this->session->userdata('comm_prop');

				if ($cat_id == 1 || $cat_id == 2 || $cat_id == 3 || $cat_id == 4) {
					$pcktype = '(
					(ad.package_type = "3" OR ad.package_type = "6") OR 
					((ad.package_type = "2" OR ad.package_type = "5" )AND ad.urgent_package != "0" )
					OR (ad.package_type = "1" AND ad.urgent_package != "0" AND ad.likes_count >= "'.$freeurgent.'")
					OR (ad.package_type = "1" AND ad.urgent_package = "0" AND ad.likes_count >= "'.$free.'")
					OR (ad.package_type = "2" AND ad.urgent_package = "0" AND ad.likes_count >= "'.$gold.'"))';
				}
				if ($cat_id == 5 || $cat_id == 6 || $cat_id == 7 || $cat_id == 8) {
					$pcktype = '(
					(ad.package_type = "3" OR ad.package_type = "6") OR 
					((ad.package_type = "2" OR ad.package_type = "5" )AND ad.urgent_package != "0" )
					OR (ad.package_type = "4" AND ad.urgent_package != "0" AND ad.likes_count >= "'.$low_freeurgent.'")
					OR (ad.package_type = "4" AND ad.urgent_package = "0" AND ad.likes_count >= "'.$low_free.'")
					OR (ad.package_type = "5" AND ad.urgent_package = "0" AND ad.likes_count >= "'.$low_gold.'") )';
				}

	    		$this->db->select("*, COUNT(`img`.`ad_id`) AS img_count,ud.valid_to AS urg");
				$this->db->join('ad_img as img', "img.ad_id = ad.ad_id", 'join');
				$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'join');
				$this->db->join('login as lg', "lg.login_id = ad.login_id", 'join');
				$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
				$this->db->where('ad.ad_status', 1);
				$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
				if ($cat_id) {
					if ($cat_id != 'all') {
						$this->db->where('ad.category_id', $cat_id);
					}
				}
				if (!empty($seller_id)) {
					if ($cat_id != 'all') {
						if ($cat_id == '2' || $cat_id == '3' || $cat_id == '5' || $cat_id == '6' || $cat_id == '7' || $cat_id == '8') {
							$this->db->where_in('ad.services', $seller_id);
						}
						elseif ($cat_id == '1') {
							$this->db->join('job_details AS jd', "jd.ad_id = ad.ad_id", 'left');
									$this->db->where_in('jd.jobtype_title', $seller_id);
						}
						elseif ($cat_id == '4') {
							$this->db->join('property_resid_commercial AS res', "res.ad_id = ad.ad_id", 'left');
								$this->db->where_in('res.offered_type', $seller_id);
						}
					}
				}
				if ($bus_id != '') {
					$this->db->where('ad.ad_type', $bus_id);
				}
				if (!empty($search_sub)) {
					$this->db->where_in('ad.sub_cat_id', $search_sub);
				}
				if ($cat_id == 3) {
					if (!empty($car_van_bus)) {
					$this->db->join('motor_car_van_bus_ads AS cars', "cars.ad_id = ad.ad_id", 'join');
					$this->db->where_in('cars.manufacture', $car_van_bus);
					}
					if (!empty($bikes_sub)) {
					$this->db->join('motor_bike_ads AS bike', "bike.ad_id = ad.ad_id", 'join');
					$this->db->where_in('bike.manufacture', $bikes_sub);
					}
					if (!empty($motor_hm)) {
					$this->db->join('motor_home_ads AS mh', "mh.ad_id = ad.ad_id", 'join');
					$this->db->where_in('mh.manufacture', $motor_hm);
					}
					if (!empty($plant_farm)) {
					$this->db->join('motor_plant_farming AS pf', "pf.ad_id = ad.ad_id", 'join');
					$this->db->where_in('pf.manufacture', $plant_farm);
					}
					if (!empty($boats_sub)) {
					$this->db->join('motor_boats AS mb', "mb.ad_id = ad.ad_id", 'join');
					$this->db->where_in('mb.manufacture', $boats_sub);
					}
				}

				if ($search_proptype) {
					if ($search_proptype == '11' || $search_proptype == '26') {
						$this->db->where("ad.sub_cat_id", $search_proptype);
					}
				}
				if ($search_resisub) {
					$this->db->join('property_resid_commercial AS resi', "resi.ad_id = ad.ad_id", 'join');
					$this->db->where('resi.property_for', $search_resisub);
				}
				if ($search_commsub) {
					$this->db->join('property_resid_commercial AS resi', "resi.ad_id = ad.ad_id", 'join');
					$this->db->where('resi.property_for', $search_commsub);
				}
				if (!empty($resi_prop)) {
					$this->db->join('property_resid_commercial AS resi1', "resi1.ad_id = ad.ad_id", 'join');
					$this->db->where_in('resi1.property_type', $resi_prop);
				}
				if (!empty($comm_prop)) {
					$this->db->join('property_resid_commercial AS resi1', "resi1.ad_id = ad.ad_id", 'join');
					$this->db->where_in('resi1.property_type', $comm_prop);
				}
				if (!empty($search_subsub)) {
						if ($cat_id == 4) {
						$this->db->join('property_resid_commercial AS resi', "resi.ad_id = ad.ad_id", 'join');
						$this->db->where_in('resi.property_for', $search_subsub);
					}
					else{
						$this->db->where_in('ad.sub_scat_id', $search_subsub);
					}
				}
				if ($search_bustype) {
					if ($search_bustype == 'business' || $search_bustype == 'consumer') {
						$this->db->where("ad.ad_type", $search_bustype);
					}
				}

				if ($cat_id == 1 || $cat_id == 2 || $cat_id == 3 || $cat_id == 4) {
						/*package search*/
						if (!empty($dealurgent)) {
							$pcklist = [];
							if (in_array("0", $dealurgent)) {
								$this->db->where('ad.urgent_package !=', '0');
							}
							else{
								$this->db->where('ad.urgent_package =', '0');
							}
							if (in_array(1, $dealurgent)){
								array_push($pcklist, 1);
							}
							if (in_array(2, $dealurgent)){
								array_push($pcklist, 2);
							}
							if (in_array(3, $dealurgent)){
								array_push($pcklist, 3);
							}
							if (!empty($pcklist)) {
								$this->db->where_in('ad.package_type', $pcklist);
							}
							
						}
					}
					if ($cat_id == 5 || $cat_id == 6 || $cat_id == 7 || $cat_id == 8) {
						/*package search*/
						if (!empty($dealurgent)) {
							$pcklist = [];
							if (in_array("0", $dealurgent)) {
								$this->db->where('ad.urgent_package !=', '0');
							}
							else{
								$this->db->where('ad.urgent_package =', '0');
							}
							if (in_array(4, $dealurgent)){
								array_push($pcklist, 4);
							}
							if (in_array(5, $dealurgent)){
								array_push($pcklist, 5);
							}
							if (in_array(6, $dealurgent)){
								array_push($pcklist, 6);
							}
							if (!empty($pcklist)) {
								$this->db->where_in('ad.package_type', $pcklist);
							}
							
						}
					}
			
				/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			/*if ($latt) {
				$this->db->where("(loc.latt LIKE '$latt%' 
  				OR loc.longg LIKE '$longg%')");
			}*/
			if ($s_location != '') {
				$this->db->where("(loc.loc_name LIKE '$s_location%' 
  					OR loc.loc_name LIKE '%$s_location' OR loc.loc_name LIKE '%$s_location%')");
			}

				if ($cat_id) {
					if ($cat_id != 'all') {
						$this->db->where($pcktype);
					}
				}
				$this->db->group_by("img.ad_id");
				/*deal title ascending or descending*/
				if ($dealtitle == 'atoz') {
					$this->db->order_by("ad.deal_tag","ASC");
				}
				else if ($dealtitle == 'ztoa'){
					$this->db->order_by("ad.deal_tag", "DESC");
				}
				/*deal price ascending or descending*/
				if ($dealprice == 'lowtohigh'){
					$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
				}
				else if ($dealprice == 'hightolow'){
					$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
				}
				$this->db->order_by("ad.approved_on", "DESC");
				$m_res = $this->db->get('postad AS ad', $data['limit'], $data['start']);
				 // echo $this->db->last_query();exit;
				return $m_res->result();

			
        }

        public function search_filters(){
        		$this->db->select("*, COUNT(`img`.`ad_id`) AS img_count");
        		$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
  				'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
				$this->db->from("postad as ad");
				$this->db->join('ad_img as img', "img.ad_id = ad.ad_id", 'join');
				$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'join');
				if ($this->input->post('cat') != 'all') {
					$this->db->where('ad.category_id', $this->input->post('cat'));
				}
				if ($this->input->post('bustype') != '0') {
					$this->db->where('ad.ad_type', $this->input->post('bustype'));
				}
				if ($this->input->post('latt') != '') {
					$this->db->where('loc.latt', $this->input->post('latt'));
					$this->db->where('loc.longg', $this->input->post('longg'));
				}
				/*search urgent and platinum */
				$ur = $this->input->post("urgenttime_list");
				if (!empty($ur)) {
					foreach ($ur as $ur_val) {
						if ($ur_val =='urgent') {
							$this->db->where('ad.urgent_package !=', '');
						}
						else if ($ur_val =='platinum') {
							$this->db->where('ad.package_type', 'platinum');
						}
					}
				}
				/*search location */
				$loc = $this->input->post('location_list');
				$tot_latt = '';
				$tot_longg = '';
				if (!empty($loc)) {
					foreach ($loc as $lval) {
						$lval1 = explode(",", $lval);
						$tot_latt .= ",".$lval1[0];
						$tot_longg .= ",".$lval1[1];
					}
					$this->db->where_in('loc.latt', explode(",",ltrim($tot_latt,',')));
					$this->db->where_in('loc.longg', explode(",",ltrim($tot_longg,',')));
				}

				/*deal posted days 24hr/3day/7day/14day/1month */
					if ($this->input->post("recentdays") == 'last24hours'){
						$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
					}
					else if ($this->input->post("recentdays") == 'last3days'){
						$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
					}
					else if ($this->input->post("recentdays") == 'last7days'){
						$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
					}
					else if ($this->input->post("recentdays") == 'last14days'){
						$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
					}	
					else if ($this->input->post("recentdays") == 'last1month'){
						$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
					}

				$this->db->group_by("img.ad_id");
				/*deal title ascending or descending*/
					if ($this->input->post("dealtitle") == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($this->input->post("dealtitle") == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					
					/*deal price ascending or descending*/
					if ($this->input->post("priceval") == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($this->input->post("priceval") == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
				
				$res = $this->db->get();
				return $res->result();
			
        }

        /*services search fo prof sub category*/
        public function servicesprof_search($data){
        	$profpop = array_merge($this->session->userdata('prof_service'),$this->session->userdata('pop_service'));
        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*, lg.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->join('login as lg', "lg.login_id = ad.login_id", 'join');
			$this->db->where("ad.category_id", "2");
			$this->db->where("ad.ad_status", "1");
			if (!empty($profpop)) {
				$this->db->where_in('ad.sub_scat_id', $profpop);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array(3, $dealurgent)){
					array_push($pcklist, 3);
				}
				if (in_array(2, $dealurgent)){
					array_push($pcklist, 2);
				}
				if (in_array(1, $dealurgent)){
					array_push($pcklist, 1);
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}
			
			/*seller search*/
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
					$m_res = $this->db->get('postad AS ad',$data['limit'], $data['start']);
			// echo $this->db->last_query(); exit;
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }

        public function sprof_search($data){
        	$profpop = array_merge($this->session->userdata('prof_service'),$this->session->userdata('pop_service'));
        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*, lg.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join('login as lg', "lg.login_id = ad.login_id", 'join');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->where("ad.category_id", "2");
			$this->db->where("ad.sub_cat_id", "9");
			$this->db->where("ad.ad_status", "1");
			if (!empty($profpop)) {
				$this->db->where_in('ad.sub_scat_id', $profpop);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array(3, $dealurgent)){
					array_push($pcklist, 3);
				}
				if (in_array(2, $dealurgent)){
					array_push($pcklist, 2);
				}
				if (in_array(1, $dealurgent)){
					array_push($pcklist, 1);
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}
			
			/*seller search*/
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
					$m_res = $this->db->get('postad AS ad',$data['limit'], $data['start']);
			// echo $this->db->last_query(); exit;
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }
        public function spop_search($data){
        	$profpop = array_merge($this->session->userdata('prof_service'),$this->session->userdata('pop_service'));
        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*, lg.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join('login as lg', "lg.login_id = ad.login_id", 'join');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->where("ad.category_id", "2");
			$this->db->where("ad.sub_cat_id", "10");
			$this->db->where("ad.ad_status", "1");
			if (!empty($profpop)) {
				$this->db->where_in('ad.sub_scat_id', $profpop);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array(3, $dealurgent)){
					array_push($pcklist, 3);
				}
				if (in_array(2, $dealurgent)){
					array_push($pcklist, 2);
				}
				if (in_array(1, $dealurgent)){
					array_push($pcklist, 1);
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}
			
			/*seller search*/
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
					$m_res = $this->db->get('postad AS ad',$data['limit'], $data['start']);
			// echo $this->db->last_query(); exit;
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }

        /*count of searched filters for services*/
        public function count_servicesprof_search(){
        	$profpop = array_merge($this->session->userdata('prof_service'),$this->session->userdata('pop_service'));
        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*, lg.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->from("postad AS ad");
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->join('login as lg', "lg.login_id = ad.login_id", 'join');
			$this->db->where("ad.category_id", "2");
			$this->db->where("ad.ad_status", "1");
			if (!empty($profpop)) {
				$this->db->where_in('ad.sub_scat_id', $profpop);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array("3", $dealurgent)){
					array_push($pcklist, '3');
				}
				if (in_array("2", $dealurgent)){
					array_push($pcklist, '2');
				}
				if (in_array("1", $dealurgent)){
					array_push($pcklist, '1');
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*seller search*/
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get();
				return $m_res->result();
        }
        public function count_sprof_search(){
        	$profpop = array_merge($this->session->userdata('prof_service'),$this->session->userdata('pop_service'));
        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*, lg.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->from("postad AS ad");
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join('login as lg', "lg.login_id = ad.login_id", 'join');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->where("ad.category_id", "2");
			$this->db->where("ad.sub_cat_id", "9");
			$this->db->where("ad.ad_status", "1");
			if (!empty($profpop)) {
				$this->db->where_in('ad.sub_scat_id', $profpop);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array("3", $dealurgent)){
					array_push($pcklist, '3');
				}
				if (in_array("2", $dealurgent)){
					array_push($pcklist, '2');
				}
				if (in_array("1", $dealurgent)){
					array_push($pcklist, '1');
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*seller search*/
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get();
				return $m_res->result();
        }
        public function count_spop_search(){
        	$profpop = array_merge($this->session->userdata('prof_service'),$this->session->userdata('pop_service'));
        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*, lg.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->from("postad AS ad");
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join('login as lg', "lg.login_id = ad.login_id", 'join');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->where("ad.category_id", "2");
			$this->db->where("ad.sub_cat_id", "10");
			$this->db->where("ad.ad_status", "1");
			if (!empty($profpop)) {
				$this->db->where_in('ad.sub_scat_id', $profpop);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array("3", $dealurgent)){
					array_push($pcklist, '3');
				}
				if (in_array("2", $dealurgent)){
					array_push($pcklist, '2');
				}
				if (in_array("1", $dealurgent)){
					array_push($pcklist, '1');
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*seller search*/
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get();
				return $m_res->result();
        }

        /*count of searched filters for clothstyles*/
        public function count_clothstyle_search(){
        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,ud.valid_to AS urg
");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->from("postad AS ad");
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->where("ad.category_id", "6");
			$this->db->where("ad.ad_status", "1");
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array("6", $dealurgent)){
					array_push($pcklist, '6');
				}
				if (in_array("5", $dealurgent)){
					array_push($pcklist, '5');
				}
				if (in_array("4", $dealurgent)){
					array_push($pcklist, '4');
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*seller search*/
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get();
				return $m_res->result();
        }

        public function clothstyle_list(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad AS ad, `sub_subcategory` AS sscat WHERE sscat.`sub_subcategory_id`=ad.`sub_scat_id`
		AND ad.`category_id` = '6' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=20 AND ad.ad_status = 1) AS women,
		(SELECT COUNT(*) FROM postad AS ad, `sub_subcategory` AS sscat WHERE sscat.`sub_subcategory_id`=ad.`sub_scat_id`
		AND ad.`category_id` = '6' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=21 AND ad.ad_status = 1) AS men,
		(SELECT COUNT(*) FROM postad AS ad, `sub_subcategory` AS sscat WHERE sscat.`sub_subcategory_id`=ad.`sub_scat_id`
		AND ad.`category_id` = '6' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=22 AND ad.ad_status = 1) AS boy,
		(SELECT COUNT(*) FROM postad AS ad, `sub_subcategory` AS sscat WHERE sscat.`sub_subcategory_id`=ad.`sub_scat_id`
		AND ad.`category_id` = '6' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=23 AND ad.ad_status = 1) AS girls,
		(SELECT COUNT(*) FROM postad AS ad, `sub_subcategory` AS sscat WHERE sscat.`sub_subcategory_id`=ad.`sub_scat_id`
		AND ad.`category_id` = '6' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=24 AND ad.ad_status = 1) AS babyboy,
		(SELECT COUNT(*) FROM postad AS ad, `sub_subcategory` AS sscat WHERE sscat.`sub_subcategory_id`=ad.`sub_scat_id`
		AND ad.`category_id` = '6' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=25 AND ad.ad_status = 1) AS babygirl");
		return $this->db->get()->result();
        }

        public function clothstyle_search($data){
        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,ud.valid_to AS urg
");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			// $this->db->from("postad AS ad");
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->where("ad.category_id", "6");
			$this->db->where("ad.ad_status", "1");
			// if (!empty($profpop)) {
			// 	$this->db->where_in('ad.sub_scat_id', $profpop);
			// }
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array("6", $dealurgent)){
					array_push($pcklist, '6');
				}
				if (in_array("5", $dealurgent)){
					array_push($pcklist, '5');
				}
				if (in_array("4", $dealurgent)){
					array_push($pcklist, '4');
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*seller search*/
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
			// $this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get('postad AS ad',$data['limit'], $data['start']);
			// echo $this->db->last_query(); exit;
				return $m_res->result();
        }

        	/*women view*/
        	public function women_view_search($data){
        	$sub_cat = $this->session->userdata('sub_cat');
	        $search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			// $this->db->from("postad AS ad");
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->where("ad.category_id", "6");
			$this->db->where("ad.sub_cat_id", "20");
			$this->db->where("ad.ad_status", "1");
			if (!empty($sub_cat)) {
				$this->db->where_in('ad.sub_scat_id', $sub_cat);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array("6", $dealurgent)){
					array_push($pcklist, '6');
				}
				if (in_array("5", $dealurgent)){
					array_push($pcklist, '5');
				}
				if (in_array("4", $dealurgent)){
					array_push($pcklist, '4');
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*seller search*/
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
			// $this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get('postad AS ad',$data['limit'], $data['start']);
			// echo $this->db->last_query(); exit;
				return $m_res->result();
        }

        /*men search*/
        public function count_men_view_search(){
        	$sub_cat = $this->session->userdata('men_list');
	        $search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->from("postad AS ad");
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->where("ad.category_id", "6");
			$this->db->where("ad.sub_cat_id", "21");
			$this->db->where("ad.ad_status", "1");
			
			if (!empty($sub_cat)) {
				$this->db->where_in('ad.sub_scat_id', $sub_cat);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array("6", $dealurgent)){
					array_push($pcklist, '6');
				}
				if (in_array("5", $dealurgent)){
					array_push($pcklist, '5');
				}
				if (in_array("4", $dealurgent)){
					array_push($pcklist, '4');
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*seller search*/
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}
			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get();
				return $m_res->result();
        }
        public function men_view_search($data){
        	$sub_cat = $this->session->userdata('men_list');
	        $search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->where("ad.category_id", "6");
			$this->db->where("ad.sub_cat_id", "21");
			$this->db->where("ad.ad_status", "1");
			if (!empty($sub_cat)) {
				$this->db->where_in('ad.sub_scat_id', $sub_cat);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array("6", $dealurgent)){
					array_push($pcklist, '6');
				}
				if (in_array("5", $dealurgent)){
					array_push($pcklist, '5');
				}
				if (in_array("4", $dealurgent)){
					array_push($pcklist, '4');
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*seller search*/
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get('postad AS ad',$data['limit'], $data['start']);
			// echo $this->db->last_query(); exit;
				return $m_res->result();
        }
        /*boys search*/
        public function count_boys_view_search(){
        	$boys_list = $this->session->userdata('boys_list');
	        $search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->from("postad AS ad");
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->where("ad.category_id", "6");
			$this->db->where("ad.sub_cat_id", "22");
			$this->db->where("ad.ad_status", "1");
			// if (!empty($profpop)) {
			// 	$this->db->where_in('ad.sub_scat_id', $profpop);
			// }
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array("6", $dealurgent)){
					array_push($pcklist, '6');
				}
				if (in_array("5", $dealurgent)){
					array_push($pcklist, '5');
				}
				if (in_array("4", $dealurgent)){
					array_push($pcklist, '4');
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*seller search*/
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}

			if (!empty($boys_list)) {
				$this->db->where_in('ad.sub_scat_id', $boys_list);
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get();
			// echo $this->db->last_query(); exit;
				return $m_res->result();
        }
        public function boys_view_search($data){
        	$boys_list = $this->session->userdata('boys_list');
	        $search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->where("ad.category_id", "6");
			$this->db->where("ad.sub_cat_id", "22");
			$this->db->where("ad.ad_status", "1");
			
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array("6", $dealurgent)){
					array_push($pcklist, '6');
				}
				if (in_array("5", $dealurgent)){
					array_push($pcklist, '5');
				}
				if (in_array("4", $dealurgent)){
					array_push($pcklist, '4');
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*seller search*/
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}

			if (!empty($boys_list)) {
				$this->db->where_in('ad.sub_scat_id', $boys_list);
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get('postad AS ad',$data['limit'], $data['start']);
			// echo $this->db->last_query(); exit;
				return $m_res->result();
        }
        public function count_girls_view_search(){
        	$girls_list = $this->session->userdata('girls_list');
	        $search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->from("postad AS ad");
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->where("ad.category_id", "6");
			$this->db->where("ad.sub_cat_id", "23");
			$this->db->where("ad.ad_status", "1");
			// if (!empty($profpop)) {
			// 	$this->db->where_in('ad.sub_scat_id', $profpop);
			// }
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array("6", $dealurgent)){
					array_push($pcklist, '6');
				}
				if (in_array("5", $dealurgent)){
					array_push($pcklist, '5');
				}
				if (in_array("4", $dealurgent)){
					array_push($pcklist, '4');
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*seller search*/
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}

			if (!empty($girls_list)) {
				$this->db->where_in('ad.sub_scat_id', $girls_list);
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get();
				return $m_res->result();
        }
        public function count_babyboy_view_search(){
        	$babyboy_list = $this->session->userdata('babyboy_list');
	        $search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->from("postad AS ad");
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->where("ad.category_id", "6");
			$this->db->where("ad.sub_cat_id", "24");
			$this->db->where("ad.ad_status", "1");
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array("6", $dealurgent)){
					array_push($pcklist, '6');
				}
				if (in_array("5", $dealurgent)){
					array_push($pcklist, '5');
				}
				if (in_array("4", $dealurgent)){
					array_push($pcklist, '4');
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*seller search*/
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}

			if (!empty($babyboy_list)) {
				$this->db->where_in('ad.sub_scat_id', $babyboy_list);
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get();
				return $m_res->result();
        }
        public function count_babygirl_view_search(){
        	$babygirl_list = $this->session->userdata('babygirl_list');
	        $search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->from("postad AS ad");
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->where("ad.category_id", "6");
			$this->db->where("ad.sub_cat_id", "25");
			$this->db->where("ad.ad_status", "1");
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array("6", $dealurgent)){
					array_push($pcklist, '6');
				}
				if (in_array("5", $dealurgent)){
					array_push($pcklist, '5');
				}
				if (in_array("4", $dealurgent)){
					array_push($pcklist, '4');
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*seller search*/
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}

			if (!empty($babygirl_list)) {
				$this->db->where_in('ad.sub_scat_id', $babygirl_list);
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get();
				return $m_res->result();
        }
        public function girls_view_search($data){
        	$girls_list = $this->session->userdata('girls_list');
	        $search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->where("ad.category_id", "6");
			$this->db->where("ad.sub_cat_id", "23");
			$this->db->where("ad.ad_status", "1");
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array("6", $dealurgent)){
					array_push($pcklist, '6');
				}
				if (in_array("5", $dealurgent)){
					array_push($pcklist, '5');
				}
				if (in_array("4", $dealurgent)){
					array_push($pcklist, '4');
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*seller search*/
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}

			if (!empty($girls_list)) {
				$this->db->where_in('ad.sub_scat_id', $girls_list);
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get('postad AS ad',$data['limit'], $data['start']);
			 // echo $this->db->last_query(); exit;
				return $m_res->result();
        }
        public function babyboy_view_search($data){
        	$babyboy_list = $this->session->userdata('babyboy_list');
	        $search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->where("ad.category_id", "6");
			$this->db->where("ad.sub_cat_id", "24");
			$this->db->where("ad.ad_status", "1");
			// if (!empty($profpop)) {
			// 	$this->db->where_in('ad.sub_scat_id', $profpop);
			// }
			if ($this->input->post('bustype')) {
				if ($this->input->post('bustype') == 'business' || $this->input->post('bustype') == 'consumer') {
					$this->db->where("ad.ad_type", $this->input->post('bustype'));
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array("6", $dealurgent)){
					array_push($pcklist, '6');
				}
				if (in_array("5", $dealurgent)){
					array_push($pcklist, '5');
				}
				if (in_array("4", $dealurgent)){
					array_push($pcklist, '4');
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*seller search*/
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}

			if (!empty($babyboy_list)) {
				$this->db->where_in('ad.sub_scat_id', $babyboy_list);
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get('postad AS ad',$data['limit'], $data['start']);
			// echo $this->db->last_query(); exit;
				return $m_res->result();
        }
        public function babygirl_view_search($data){
        	$babygirl_list = $this->session->userdata('babygirl_list');
	        $search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->where("ad.category_id", "6");
			$this->db->where("ad.sub_cat_id", "25");
			$this->db->where("ad.ad_status", "1");
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array("6", $dealurgent)){
					array_push($pcklist, '6');
				}
				if (in_array("5", $dealurgent)){
					array_push($pcklist, '5');
				}
				if (in_array("4", $dealurgent)){
					array_push($pcklist, '4');
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*seller search*/
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}

			if (!empty($babygirl_list)) {
				$this->db->where_in('ad.sub_scat_id', $babygirl_list);
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get('postad AS ad',$data['limit'], $data['start']);
				return $m_res->result();
        }

        public function women_list_count(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad AS ad, `sub_subcategory` AS sscat WHERE sscat.`sub_subcategory_id`=ad.`sub_scat_id`
			AND ad.`category_id` = '6' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=20 AND ad.`sub_scat_id`=359) AS clothes,
			(SELECT COUNT(*) FROM postad AS ad, `sub_subcategory` AS sscat WHERE sscat.`sub_subcategory_id`=ad.`sub_scat_id`
			AND ad.`category_id` = '6' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=20 AND ad.`sub_scat_id`=360) AS shoes,
			(SELECT COUNT(*) FROM postad AS ad, `sub_subcategory` AS sscat WHERE sscat.`sub_subcategory_id`=ad.`sub_scat_id`
			AND ad.`category_id` = '6' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=20 AND ad.`sub_scat_id`=361) AS accessories,
			(SELECT COUNT(*) FROM postad AS ad, `sub_subcategory` AS sscat WHERE sscat.`sub_subcategory_id`=ad.`sub_scat_id`
			AND ad.`category_id` = '6' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=20 AND ad.`sub_scat_id`=362) AS wedding
			");
        	return $this->db->get()->result();
        }

         public function men_list_count(){
         	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad AS ad, `sub_subcategory` AS sscat WHERE sscat.`sub_subcategory_id`=ad.`sub_scat_id`
			AND ad.`category_id` = '6' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=21 AND ad.`sub_scat_id`=363) AS clothes,
			(SELECT COUNT(*) FROM postad AS ad, `sub_subcategory` AS sscat WHERE sscat.`sub_subcategory_id`=ad.`sub_scat_id`
			AND ad.`category_id` = '6' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=21 AND ad.`sub_scat_id`=364) AS shoes,
			(SELECT COUNT(*) FROM postad AS ad, `sub_subcategory` AS sscat WHERE sscat.`sub_subcategory_id`=ad.`sub_scat_id`
			AND ad.`category_id` = '6' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=21 AND ad.`sub_scat_id`=365) AS accessories,
			(SELECT COUNT(*) FROM postad AS ad, `sub_subcategory` AS sscat WHERE sscat.`sub_subcategory_id`=ad.`sub_scat_id`
			AND ad.`category_id` = '6' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=21 AND ad.`sub_scat_id`=366) AS wedding
			");
        	return $this->db->get()->result();
        }
         public function boys_list_count(){
         	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad AS ad, `sub_subcategory` AS sscat WHERE sscat.`sub_subcategory_id`=ad.`sub_scat_id`
			AND ad.`category_id` = '6' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=22 AND ad.`sub_scat_id`=367) AS clothes,
			(SELECT COUNT(*) FROM postad AS ad, `sub_subcategory` AS sscat WHERE sscat.`sub_subcategory_id`=ad.`sub_scat_id`
			AND ad.`category_id` = '6' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=22 AND ad.`sub_scat_id`=368) AS shoes,
			(SELECT COUNT(*) FROM postad AS ad, `sub_subcategory` AS sscat WHERE sscat.`sub_subcategory_id`=ad.`sub_scat_id`
			AND ad.`category_id` = '6' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=22 AND ad.`sub_scat_id`=369) AS accessories
			");
        	return $this->db->get()->result();
        }
        public function girls_list_count(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad AS ad, `sub_subcategory` AS sscat WHERE sscat.`sub_subcategory_id`=ad.`sub_scat_id`
			AND ad.`category_id` = '6' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=23 AND ad.`sub_scat_id`=370) AS clothes,
			(SELECT COUNT(*) FROM postad AS ad, `sub_subcategory` AS sscat WHERE sscat.`sub_subcategory_id`=ad.`sub_scat_id`
			AND ad.`category_id` = '6' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=23 AND ad.`sub_scat_id`=371) AS shoes,
			(SELECT COUNT(*) FROM postad AS ad, `sub_subcategory` AS sscat WHERE sscat.`sub_subcategory_id`=ad.`sub_scat_id`
			AND ad.`category_id` = '6' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=23 AND ad.`sub_scat_id`=372) AS accessories
			");
        	return $this->db->get()->result();
        }

        public function babyboy_list_count(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad AS ad, `sub_subcategory` AS sscat WHERE sscat.`sub_subcategory_id`=ad.`sub_scat_id`
			AND ad.`category_id` = '6' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=24 AND ad.`sub_scat_id`=373) AS clothes,
			(SELECT COUNT(*) FROM postad AS ad, `sub_subcategory` AS sscat WHERE sscat.`sub_subcategory_id`=ad.`sub_scat_id`
			AND ad.`category_id` = '6' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=24 AND ad.`sub_scat_id`=374) AS accessories
			");
        	return $this->db->get()->result();
        }
         public function babygirl_list_count(){
         	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad AS ad, `sub_subcategory` AS sscat WHERE sscat.`sub_subcategory_id`=ad.`sub_scat_id`
			AND ad.`category_id` = '6' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=25 AND ad.`sub_scat_id`=373) AS clothes,
			(SELECT COUNT(*) FROM postad AS ad, `sub_subcategory` AS sscat WHERE sscat.`sub_subcategory_id`=ad.`sub_scat_id`
			AND ad.`category_id` = '6' AND ad.ad_status = 1 AND ad.expire_data >='$data' AND ad.`sub_cat_id`=25 AND ad.`sub_scat_id`=374) AS accessories
			");
        	return $this->db->get()->result();
        }

        public function count_women_view_search(){
        	$sub_cat = $this->session->userdata('sub_cat');
        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->from("postad AS ad");
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->where("ad.category_id", "6");
			$this->db->where("ad.sub_cat_id", "20");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			if (!empty($sub_cat)) {
				$this->db->where_in('ad.sub_scat_id', $sub_cat);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array("6", $dealurgent)){
					array_push($pcklist, '6');
				}
				if (in_array("5", $dealurgent)){
					array_push($pcklist, '5');
				}
				if (in_array("4", $dealurgent)){
					array_push($pcklist, '4');
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*seller search*/
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get();
			// echo $this->db->last_query(); exit;
				return $m_res->result();
        }

        /*jobs search fo  sub category*/
        public function jobs_search($data){
        	$jobslist = $this->session->userdata('job_search');
        	$jobs_pos = $this->session->userdata('positionfor');
        	$seller = $this->session->userdata('seller_deals');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$recentdays = $this->session->userdata('recentdays');
        	$search_bustype = $this->session->userdata('search_bustype');
        	$location = $this->session->userdata('location');
        	$this->db->select("ad.*, img.*, COUNT(img.ad_id) AS img_count, loc.*, jd.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			// $this->db->from("postad AS ad");
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join('job_details AS jd', "jd.ad_id = ad.ad_id", 'left');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->where("ad.category_id", "1");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			if (!empty($jobslist)) {
				$this->db->where_in('ad.sub_cat_id', $jobslist);
			}
			if (!empty($jobs_pos)) {
				$this->db->where_in('jd.positionfor', $jobs_pos);
			}
			if (!empty($seller)) {
				$this->db->where_in('jd.jobtype_title', $seller);
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array(1, $dealurgent)){
					array_push($pcklist, 1);
				}
				if (in_array(2, $dealurgent)){
					array_push($pcklist, 2);
				}
				if (in_array(3, $dealurgent)){
					array_push($pcklist, 3);
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}

			
			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}
			$this->db->group_by(" img.ad_id");
			/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get('postad AS ad',$data['limit'], $data['start']);
			   // echo $this->db->last_query(); exit;
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }

         public function count_jobs_search(){
        	$jobslist = $this->session->userdata('job_search');
        	$jobs_pos = $this->session->userdata('positionfor');
        	$seller = $this->session->userdata('seller_deals');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$recentdays = $this->session->userdata('recentdays');
        	$search_bustype = $this->session->userdata('search_bustype');
        	$latt = $this->session->userdata('latt');
        	$longg = $this->session->userdata('longg');
        	$location = $this->session->userdata('location');
        	$this->db->select("ad.*, img.*, COUNT(img.ad_id) AS img_count, loc.*, jd.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->from("postad AS ad");
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join('job_details AS jd', "jd.ad_id = ad.ad_id", 'left');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->where("ad.category_id", "1");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			if (!empty($jobslist)) {
				$this->db->where_in('ad.sub_cat_id', $jobslist);
			}
			if (!empty($jobs_pos)) {
				$this->db->where_in('jd.positionfor', $jobs_pos);
			}
			if (!empty($seller)) {
				$this->db->where_in('jd.jobtype_title', $seller);
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array(1, $dealurgent)){
					array_push($pcklist, 1);
				}
				if (in_array(2, $dealurgent)){
					array_push($pcklist, 2);
				}
				if (in_array(3, $dealurgent)){
					array_push($pcklist, 3);
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}

			
			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}
			$this->db->group_by(" img.ad_id");
			/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get();
			   // echo $this->db->last_query(); exit;
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }

        /*pets search*/
        public function pets_search($data){
        	$pets_sub = $this->session->userdata('pets_sub');
        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,lg.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join('login as lg', "lg.login_id = ad.login_id", 'join');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->where("ad.category_id", "5");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			if (!empty($pets_sub)) {
				$this->db->where_in('ad.sub_cat_id', $pets_sub);
			}
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}
			if ($search_bustype) {
				if ($this->session->userdata('search_bustype') == 'business' || $this->session->userdata('search_bustype') == 'consumer') {
					$this->db->where("ad.ad_type", $this->session->userdata('search_bustype'));
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array(4, $dealurgent)){
					array_push($pcklist, 4);
				}
				if (in_array(5, $dealurgent)){
					array_push($pcklist, 5);
				}
				if (in_array(6, $dealurgent)){
					array_push($pcklist, 6);
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}
			
			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get('postad AS ad', $data['limit'], $data['start']);
			 // echo $this->db->last_query(); exit;
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }

         public function count_pets_search(){
        	$pets_sub = $this->session->userdata('pets_sub');
        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*, lg.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->from("postad AS ad");
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join('login as lg', "lg.login_id = ad.login_id", 'join');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->where("ad.category_id", "5");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			if (!empty($pets_sub)) {
				$this->db->where_in('ad.sub_cat_id', $pets_sub);
			}
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array(4, $dealurgent)){
					array_push($pcklist, 4);
				}
				if (in_array(5, $dealurgent)){
					array_push($pcklist, 5);
				}
				if (in_array(6, $dealurgent)){
					array_push($pcklist, 6);
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get();
			 // echo $this->db->last_query(); exit;
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }

        /*motor point search*/
        public function motors_search($data){
        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,lg.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join('login as lg', "lg.login_id = ad.login_id", 'join');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->where("ad.category_id", "3");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array(1, $dealurgent)){
					array_push($pcklist, 1);
				}
				if (in_array(2, $dealurgent)){
					array_push($pcklist, 2);
				}
				if (in_array(3, $dealurgent)){
					array_push($pcklist, 3);
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get('postad AS ad', $data['limit'], $data['start']);
			 // echo $this->db->last_query(); exit;
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }
        public function ezone_search($data){
        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,lg.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join('login as lg', "lg.login_id = ad.login_id", 'join');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->where("ad.category_id", "8");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array(4, $dealurgent)){
					array_push($pcklist, 4);
				}
				if (in_array(5, $dealurgent)){
					array_push($pcklist, 5);
				}
				if (in_array(6, $dealurgent)){
					array_push($pcklist, 6);
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get('postad AS ad', $data['limit'], $data['start']);
			 // echo $this->db->last_query(); exit;
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }
        public function phone_search($data){
        	$phone_sub = $this->session->userdata('phone_sub');
        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,lg.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join('login as lg', "lg.login_id = ad.login_id", 'join');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->where("ad.category_id", "8");
			$this->db->where("ad.sub_cat_id", "59");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			if (!empty($phone_sub)) {
				$this->db->where_in('ad.sub_scat_id', $phone_sub);
			}
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array(4, $dealurgent)){
					array_push($pcklist, 4);
				}
				if (in_array(5, $dealurgent)){
					array_push($pcklist, 5);
				}
				if (in_array(6, $dealurgent)){
					array_push($pcklist, 6);
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get('postad AS ad', $data['limit'], $data['start']);
			 // echo $this->db->last_query(); exit;
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }
        public function homes_search($data){
        	$homes_sub = $this->session->userdata('homes_sub');
        	$phone_sub = $this->session->userdata('phone_sub');
        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,lg.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join('login as lg', "lg.login_id = ad.login_id", 'join');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->where("ad.category_id", "8");
			$this->db->where("ad.sub_cat_id", "60");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			if (!empty($homes_sub)) {
				$this->db->where_in('ad.sub_scat_id', $homes_sub);
			}
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array(4, $dealurgent)){
					array_push($pcklist, 4);
				}
				if (in_array(5, $dealurgent)){
					array_push($pcklist, 5);
				}
				if (in_array(6, $dealurgent)){
					array_push($pcklist, 6);
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get('postad AS ad', $data['limit'], $data['start']);
			 // echo $this->db->last_query(); exit;
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }
        public function smalls_search($data){
        	$smalls_sub = $this->session->userdata('smalls_sub');
        	$phone_sub = $this->session->userdata('phone_sub');
        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,lg.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join('login as lg', "lg.login_id = ad.login_id", 'join');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->where("ad.category_id", "8");
			$this->db->where("ad.sub_cat_id", "61");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			if (!empty($smalls_sub)) {
				$this->db->where_in('ad.sub_scat_id', $smalls_sub);
			}
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array(4, $dealurgent)){
					array_push($pcklist, 4);
				}
				if (in_array(5, $dealurgent)){
					array_push($pcklist, 5);
				}
				if (in_array(6, $dealurgent)){
					array_push($pcklist, 6);
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get('postad AS ad', $data['limit'], $data['start']);
			 // echo $this->db->last_query(); exit;
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }
         public function lappy_search($data){
        	$lappy_sub = $this->session->userdata('lappy_sub');
        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,lg.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join('login as lg', "lg.login_id = ad.login_id", 'join');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->where("ad.category_id", "8");
			$this->db->where("ad.sub_cat_id", "62");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			if (!empty($lappy_sub)) {
				$this->db->where_in('ad.sub_scat_id', $lappy_sub);
			}
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array(4, $dealurgent)){
					array_push($pcklist, 4);
				}
				if (in_array(5, $dealurgent)){
					array_push($pcklist, 5);
				}
				if (in_array(6, $dealurgent)){
					array_push($pcklist, 6);
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get('postad AS ad', $data['limit'], $data['start']);
			 // echo $this->db->last_query(); exit;
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }
         public function pcare_search($data){
        	$pcare_sub = $this->session->userdata('pcare_sub');
        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,lg.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join('login as lg', "lg.login_id = ad.login_id", 'join');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->where("ad.category_id", "8");
			$this->db->where("ad.sub_cat_id", "64");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			if (!empty($pcare_sub)) {
				$this->db->where_in('ad.sub_scat_id', $pcare_sub);
			}
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array(4, $dealurgent)){
					array_push($pcklist, 4);
				}
				if (in_array(5, $dealurgent)){
					array_push($pcklist, 5);
				}
				if (in_array(6, $dealurgent)){
					array_push($pcklist, 6);
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get('postad AS ad', $data['limit'], $data['start']);
			 // echo $this->db->last_query(); exit;
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }
        public function entertain_search($data){
        	$entertain_sub = $this->session->userdata('entertain_sub');
        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,lg.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join('login as lg', "lg.login_id = ad.login_id", 'join');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->where("ad.category_id", "8");
			$this->db->where("ad.sub_cat_id", "65");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			if (!empty($entertain_sub)) {
				$this->db->where_in('ad.sub_scat_id', $entertain_sub);
			}
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array(4, $dealurgent)){
					array_push($pcklist, 4);
				}
				if (in_array(5, $dealurgent)){
					array_push($pcklist, 5);
				}
				if (in_array(6, $dealurgent)){
					array_push($pcklist, 6);
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get('postad AS ad', $data['limit'], $data['start']);
			 // echo $this->db->last_query(); exit;
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }
        public function poto_search($data){
        	$poto_sub = $this->session->userdata('poto_sub');
        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,lg.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join('login as lg', "lg.login_id = ad.login_id", 'join');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->where("ad.category_id", "8");
			$this->db->where("ad.sub_cat_id", "66");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			if (!empty($poto_sub)) {
				$this->db->where_in('ad.sub_scat_id', $poto_sub);
			}
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array(4, $dealurgent)){
					array_push($pcklist, 4);
				}
				if (in_array(5, $dealurgent)){
					array_push($pcklist, 5);
				}
				if (in_array(6, $dealurgent)){
					array_push($pcklist, 6);
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get('postad AS ad', $data['limit'], $data['start']);
			 // echo $this->db->last_query(); exit;
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }
        public function access_search($data){
        	$access_sub = $this->session->userdata('access_sub');
        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,lg.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join('login as lg', "lg.login_id = ad.login_id", 'join');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->where("ad.category_id", "8");
			$this->db->where("ad.sub_cat_id", "63");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			if (!empty($access_sub)) {
				$this->db->where_in('ad.sub_scat_id', $access_sub);
			}
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array(4, $dealurgent)){
					array_push($pcklist, 4);
				}
				if (in_array(5, $dealurgent)){
					array_push($pcklist, 5);
				}
				if (in_array(6, $dealurgent)){
					array_push($pcklist, 6);
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get('postad AS ad', $data['limit'], $data['start']);
			 // echo $this->db->last_query(); exit;
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }
         public function count_motors_search(){
        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,lg.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->from("postad AS ad");
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join('login as lg', "lg.login_id = ad.login_id", 'join');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->where("ad.category_id", "3");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array(1, $dealurgent)){
					array_push($pcklist, 1);
				}
				if (in_array(2, $dealurgent)){
					array_push($pcklist, 2);
				}
				if (in_array(3, $dealurgent)){
					array_push($pcklist, 3);
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get();
			 // echo $this->db->last_query(); exit;
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }
        public function miles2kms($miles) { 
			$ratio = 1.609344; 
			$kms = $miles * $ratio; 
			return $kms; 
			} 
         public function count_searchviewsearch(){
         	$search_proptype = $this->session->userdata('search_proptype');
         	$search_resisub = $this->session->userdata('search_resisub');
			$search_commsub = $this->session->userdata('search_commsub');
			$resi_prop = $this->session->userdata('resi_prop');
			$comm_prop = $this->session->userdata('comm_prop');

         	$miles =  $this->session->userdata('miles');
         	$looking_search =  $this->session->userdata('s_looking_search');
         	$cat_id =  $this->session->userdata('s_cat_id');
         	$search_sub =  $this->session->userdata('s_search_sub');
         	$search_subsub =  $this->session->userdata('s_search_subsub');
        	$search_bustype = $this->session->userdata('s_search_bustype');
        	$dealtitle = $this->session->userdata('s_dealtitle');
        	$dealprice = $this->session->userdata('s_dealprice');
        	$recentdays = $this->session->userdata('s_recentdays');
        	$seller_deals = $this->session->userdata('s_seller_deals');
			$dealurgent = $this->session->userdata('s_dealurgent');
			$s_location = $this->session->userdata('s_location');

			$car_van_bus = $this->session->userdata('car_van_bus');
            $motor_hm = $this->session->userdata('motor_hm');
            $bikes_sub = $this->session->userdata('bikes_sub');
            $plant_farm = $this->session->userdata('plant_farm');
            $boats_sub = $this->session->userdata('boats_sub');

        	$distance = round($this->miles2kms($miles));
			$earthRadius = 6371;
			if ($this->session->userdata('s_latt') !='') {
				$lat1 = deg2rad($this->session->userdata('s_latt'));
				$lon1 = deg2rad($this->session->userdata('s_longg'));
			}
			else{
				$lat1 = 0;
				$lon1 = 0;
			}
			$bearing = deg2rad(0);

			$lat2 = asin(sin($lat1) * cos($distance / $earthRadius) + cos($lat1) * sin($distance / $earthRadius) * cos($bearing));
			$lon2 = $lon1 + atan2(sin($bearing) * sin($distance / $earthRadius) * cos($lat1), cos($distance / $earthRadius) - sin($lat1) * sin($lat2));
			$latt = substr(rad2deg($lat2),0,strpos(rad2deg($lat2),".") + 5);
			$longg = substr(rad2deg($lon2),0,strpos(rad2deg($lon2),".") + 5);
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,lg.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->from("postad AS ad");
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join('login as lg', "lg.login_id = ad.login_id", 'join');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
				if ($looking_search) {
					if ($looking_search != '') {
						$this->db->where("(ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' 
  						OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search')");
					}
				}

				if ($cat_id) {
					if ($cat_id != 'all') {
						$this->db->where('ad.category_id', $cat_id);
					}
					/*jobs*/
					if ($cat_id == '1') {
						$this->db->join('job_details AS jd', "jd.ad_id = ad.ad_id", 'left');
						if (!empty($seller_deals)) {
							$this->db->where_in('jd.jobtype_title', $seller_deals);
						}
					}
					/*services, pets, cloths*/
					if ($cat_id == '2' || $cat_id == '5' || $cat_id == '6' || $cat_id == '7') {
						if (!empty($seller_deals)) {
							$this->db->where_in('ad.services', $seller_deals);
						}
					}
					if ($cat_id == '4') {
						$this->db->join('property_resid_commercial AS res', "res.ad_id = ad.ad_id", 'left');
						if (!empty($seller_deals)) {
							$this->db->where_in('res.offered_type', $seller_deals);
						}
					}
					if ($cat_id == 1 || $cat_id == 2 || $cat_id == 3 || $cat_id == 4) {
						/*package search*/
						if (!empty($dealurgent)) {
							$pcklist = [];
							if (in_array("0", $dealurgent)) {
								$this->db->where('ud.valid_to !=', '');
							}
							/*else{
								$this->db->where('ad.urgent_package =', '0');
							}*/
							if (in_array(1, $dealurgent)){
								array_push($pcklist, 1);
							}
							if (in_array(2, $dealurgent)){
								array_push($pcklist, 2);
							}
							if (in_array(3, $dealurgent)){
								array_push($pcklist, 3);
							}
							if (!empty($pcklist)) {
								$this->db->where_in('ad.package_type', $pcklist);
							}
							
						}
					}
					if ($cat_id == 5 || $cat_id == 6 || $cat_id == 7 || $cat_id == 8) {
						/*package search*/
						if (!empty($dealurgent)) {
							$pcklist = [];
							if (in_array("0", $dealurgent)) {
								$this->db->where('ud.valid_to !=', '');
							}
							/*else{
								$this->db->where('ad.urgent_package =', '0');
							}*/
							if (in_array(4, $dealurgent)){
								array_push($pcklist, 4);
							}
							if (in_array(5, $dealurgent)){
								array_push($pcklist, 5);
							}
							if (in_array(6, $dealurgent)){
								array_push($pcklist, 6);
							}
							if (!empty($pcklist)) {
								$this->db->where_in('ad.package_type', $pcklist);
							}
							
						}
					}
					if ($cat_id == 'all') {
						/*package search*/
						if (!empty($dealurgent)) {
							$pcklist = [];
							if (in_array("0", $dealurgent)) {
								$this->db->where('ud.valid_to !=', '');
							}
							/*else{
								$this->db->where("ad.urgent_package = 0");
							}*/
							if (in_array('1,4', $dealurgent)){
								array_push($pcklist, '1');
								array_push($pcklist, '4');
							}
							if (in_array('2,5', $dealurgent)){
								array_push($pcklist, '2');
								array_push($pcklist, '5');
							}
							if (in_array('3,6', $dealurgent)){
								array_push($pcklist, '3');
								array_push($pcklist, '6');
							}
							if (!empty($pcklist)) {
								$this->db->where_in('ad.package_type', $pcklist);
							}
							
						}
					}
					if (!empty($pcklist)) {
							$this->db->where_in('ad.package_type', $pcklist);
						}
					if (!empty($search_sub)) {
						$this->db->where_in('ad.sub_cat_id', $search_sub);
					}
					if ($cat_id == 3) {
							if (!empty($car_van_bus)) {
								$this->db->join('motor_car_van_bus_ads AS cars', "cars.ad_id = ad.ad_id", 'join');
								$this->db->where_in('cars.manufacture', $car_van_bus);
							}
							if (!empty($bikes_sub)) {
								$this->db->join('motor_bike_ads AS bike', "bike.ad_id = ad.ad_id", 'join');
								$this->db->where_in('bike.manufacture', $bikes_sub);
							}
							if (!empty($motor_hm)) {
								$this->db->join('motor_home_ads AS mh', "mh.ad_id = ad.ad_id", 'join');
								$this->db->where_in('mh.manufacture', $motor_hm);
							}
							if (!empty($plant_farm)) {
								$this->db->join('motor_plant_farming AS pf', "pf.ad_id = ad.ad_id", 'join');
								$this->db->where_in('pf.manufacture', $plant_farm);
							}
							if (!empty($boats_sub)) {
								$this->db->join('motor_boats AS mb', "mb.ad_id = ad.ad_id", 'join');
								$this->db->where_in('mb.manufacture', $boats_sub);
							}
						}
						if ($search_proptype) {
							if ($search_proptype == '11' || $search_proptype == '26') {
								$this->db->where("ad.sub_cat_id", $search_proptype);
							}
						}
						if ($search_resisub) {
							$this->db->join('property_resid_commercial AS resi', "resi.ad_id = ad.ad_id", 'join');
							$this->db->where('resi.property_for', $search_resisub);
						}
						if ($search_commsub) {
							$this->db->join('property_resid_commercial AS resi', "resi.ad_id = ad.ad_id", 'join');
							$this->db->where('resi.property_for', $search_commsub);
						}
						if (!empty($resi_prop)) {
							$this->db->join('property_resid_commercial AS resi1', "resi1.ad_id = ad.ad_id", 'join');
							$this->db->where_in('resi1.property_type', $resi_prop);
						}
						if (!empty($comm_prop)) {
							$this->db->join('property_resid_commercial AS resi1', "resi1.ad_id = ad.ad_id", 'join');
							$this->db->where_in('resi1.property_type', $comm_prop);
						}
					if (!empty($search_subsub)) {
							if ($cat_id == 4) {
								$this->db->join('property_resid_commercial AS resi', "resi.ad_id = ad.ad_id", 'join');
								$this->db->where_in('resi.property_for', $search_subsub);
							}
						else{
							$this->db->where_in('ad.sub_scat_id', $search_subsub);
						}
					}
					
				}

			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			
			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				// $this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
				$this->db->where("ad.approved_on >=", date("Y-m-d H:i:s", strtotime("-1 day")));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("ad.approved_on >=", date("Y-m-d H:i:s", strtotime("-3 days")));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("ad.approved_on >=", date("Y-m-d H:i:s", strtotime("-7 days")));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("ad.approved_on >=", date("Y-m-d H:i:s", strtotime("-14 days")));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("ad.approved_on >=", date("Y-m-d H:i:s", strtotime("-1 month")));
			}

			/*location search*/
			
			if ($s_location != '') {
				$this->db->where("(loc.loc_name LIKE '$s_location%' 
  					OR loc.loc_name LIKE '%$s_location' OR loc.loc_name LIKE '%$s_location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get();
			     // echo $this->db->last_query(); exit;
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }
        public function searchviewsearch($data){
        	$search_proptype = $this->session->userdata('search_proptype');
        	$search_resisub = $this->session->userdata('search_resisub');
			$search_commsub = $this->session->userdata('search_commsub');
			$resi_prop = $this->session->userdata('resi_prop');
			$comm_prop = $this->session->userdata('comm_prop');

        	$miles =  $this->session->userdata('miles');
        	$looking_search =  $this->session->userdata('s_looking_search');
        	$cat_id =  $this->session->userdata('s_cat_id');
        	$search_sub =  $this->session->userdata('s_search_sub');
        	$search_subsub =  $this->session->userdata('s_search_subsub');
        	$search_bustype = $this->session->userdata('s_search_bustype');
        	$dealtitle = $this->session->userdata('s_dealtitle');
        	$dealprice = $this->session->userdata('s_dealprice');
        	$recentdays = $this->session->userdata('s_recentdays');
        	$seller_deals = $this->session->userdata('s_seller_deals');
			$dealurgent = $this->session->userdata('s_dealurgent');
			$s_location = $this->session->userdata('s_location');
			
			$car_van_bus = $this->session->userdata('car_van_bus');
            $motor_hm = $this->session->userdata('motor_hm');
            $bikes_sub = $this->session->userdata('bikes_sub');
            $plant_farm = $this->session->userdata('plant_farm');
            $boats_sub = $this->session->userdata('boats_sub');

        	$distance = round($this->miles2kms($miles));
			$earthRadius = 6371;
			if ($this->session->userdata('s_latt') !='') {
				$lat1 = deg2rad($this->session->userdata('s_latt'));
				$lon1 = deg2rad($this->session->userdata('s_longg'));
			}
			else{
				$lat1 = 0;
				$lon1 = 0;
			}
			
			$bearing = deg2rad(0);

			$lat2 = asin(sin($lat1) * cos($distance / $earthRadius) + cos($lat1) * sin($distance / $earthRadius) * cos($bearing));
			$lon2 = $lon1 + atan2(sin($bearing) * sin($distance / $earthRadius) * cos($lat1), cos($distance / $earthRadius) - sin($lat1) * sin($lat2));
			$latt = substr(rad2deg($lat2),0,strpos(rad2deg($lat2),".") + 5);
			$longg = substr(rad2deg($lon2),0,strpos(rad2deg($lon2),".") + 5);
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,lg.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join('login as lg', "lg.login_id = ad.login_id", 'join');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
				if ($looking_search) {
					if ($looking_search != '') {
						$this->db->where("(ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' 
  						OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search')");
					}
				}
				if ($cat_id) {
					if ($cat_id != 'all') {
						$this->db->where('ad.category_id', $cat_id);
					}
					/*jobs*/
					if ($cat_id == '1') {
						$this->db->join('job_details AS jd', "jd.ad_id = ad.ad_id", 'left');
						if (!empty($seller_deals)) {
							$this->db->where_in('jd.jobtype_title', $seller_deals);
						}
					}
					/*services, pets, cloths*/
					if ($cat_id == '2' || $cat_id == '5' || $cat_id == '6' || $cat_id == '7') {
						if (!empty($seller_deals)) {
							$this->db->where_in('ad.services', $seller_deals);
						}
					}
					if ($cat_id == '4') {
						$this->db->join('property_resid_commercial AS res', "res.ad_id = ad.ad_id", 'left');
						if (!empty($seller_deals)) {
							$this->db->where_in('res.offered_type', $seller_deals);
						}
					}
					if ($cat_id == 1 || $cat_id == 2 || $cat_id == 3 || $cat_id == 4) {
						/*package search*/
						if (!empty($dealurgent)) {
							$pcklist = [];
							if (in_array("0", $dealurgent)) {
								$this->db->where('ud.valid_to !=', '');
							}
							/*else{
								$this->db->where('ad.urgent_package =', '0');
							}*/
							if (in_array(1, $dealurgent)){
								array_push($pcklist, 1);
							}
							if (in_array(2, $dealurgent)){
								array_push($pcklist, 2);
							}
							if (in_array(3, $dealurgent)){
								array_push($pcklist, 3);
							}
							if (!empty($pcklist)) {
								$this->db->where_in('ad.package_type', $pcklist);
							}
							
						}
					}
					if ($cat_id == 5 || $cat_id == 6 || $cat_id == 7 || $cat_id == 8) {
						/*package search*/
						if (!empty($dealurgent)) {
							$pcklist = [];
							if (in_array("0", $dealurgent)) {
								$this->db->where('ud.valid_to !=', '');
							}
							/*else{
								$this->db->where('ad.urgent_package =', '0');
							}*/
							if (in_array(4, $dealurgent)){
								array_push($pcklist, 4);
							}
							if (in_array(5, $dealurgent)){
								array_push($pcklist, 5);
							}
							if (in_array(6, $dealurgent)){
								array_push($pcklist, 6);
							}
							if (!empty($pcklist)) {
								$this->db->where_in('ad.package_type', $pcklist);
							}
							
						}
					}
					if ($cat_id == 'all') {
						/*package search*/
						if (!empty($dealurgent)) {
							$pcklist = [];
							if (in_array("0", $dealurgent)) {
								$this->db->where('ud.valid_to !=', '');
							}
							/*else{
								$this->db->where('ad.urgent_package =', '0');
							}*/
							if (in_array('1,4', $dealurgent)){
								array_push($pcklist, '1');
								array_push($pcklist, '4');
							}
							if (in_array('2,5', $dealurgent)){
								array_push($pcklist, '2');
								array_push($pcklist, '5');
							}
							if (in_array('3,6', $dealurgent)){
								array_push($pcklist, '3');
								array_push($pcklist, '6');
							}
							if (!empty($pcklist)) {
								$this->db->where_in('ad.package_type', $pcklist);
							}
							
						}
					}
					if (!empty($pcklist)) {
							$this->db->where_in('ad.package_type', $pcklist);
						}
					if (!empty($search_sub)) {
						$this->db->where_in('ad.sub_cat_id', $search_sub);
					}
					if ($cat_id == 3) {
							if (!empty($car_van_bus)) {
								$this->db->join('motor_car_van_bus_ads AS cars', "cars.ad_id = ad.ad_id", 'join');
								$this->db->where_in('cars.manufacture', $car_van_bus);
							}
							if (!empty($bikes_sub)) {
								$this->db->join('motor_bike_ads AS bike', "bike.ad_id = ad.ad_id", 'join');
								$this->db->where_in('bike.manufacture', $bikes_sub);
							}
							if (!empty($motor_hm)) {
								$this->db->join('motor_home_ads AS mh', "mh.ad_id = ad.ad_id", 'join');
								$this->db->where_in('mh.manufacture', $motor_hm);
							}
							if (!empty($plant_farm)) {
								$this->db->join('motor_plant_farming AS pf', "pf.ad_id = ad.ad_id", 'join');
								$this->db->where_in('pf.manufacture', $plant_farm);
							}
							if (!empty($boats_sub)) {
								$this->db->join('motor_boats AS mb', "mb.ad_id = ad.ad_id", 'join');
								$this->db->where_in('mb.manufacture', $boats_sub);
							}
						}
						if ($search_proptype) {
							if ($search_proptype == '11' || $search_proptype == '26') {
								$this->db->where("ad.sub_cat_id", $search_proptype);
							}
						}
							if ($search_resisub) {
								$this->db->join('property_resid_commercial AS resi', "resi.ad_id = ad.ad_id", 'join');
								$this->db->where('resi.property_for', $search_resisub);
							}
							if ($search_commsub) {
								$this->db->join('property_resid_commercial AS resi', "resi.ad_id = ad.ad_id", 'join');
								$this->db->where('resi.property_for', $search_commsub);
							}
							if (!empty($resi_prop)) {
								$this->db->join('property_resid_commercial AS resi1', "resi1.ad_id = ad.ad_id", 'join');
								$this->db->where_in('resi1.property_type', $resi_prop);
							}
							if (!empty($comm_prop)) {
								$this->db->join('property_resid_commercial AS resi1', "resi1.ad_id = ad.ad_id", 'join');
								$this->db->where_in('resi1.property_type', $comm_prop);
							}
					if (!empty($search_subsub)) {
							if ($cat_id == 4) {
							$this->db->join('property_resid_commercial AS resi', "resi.ad_id = ad.ad_id", 'join');
							$this->db->where_in('resi.property_for', $search_subsub);
						}
						else{
							$this->db->where_in('ad.sub_scat_id', $search_subsub);
						}
					}
				}
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			
			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("ad.approved_on >=", date("Y-m-d H:i:s", strtotime("-1 day")));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("ad.approved_on >=", date("Y-m-d H:i:s", strtotime("-3 days")));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("ad.approved_on >=", date("Y-m-d H:i:s", strtotime("-7 days")));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("ad.approved_on >=", date("Y-m-d H:i:s", strtotime("-14 days")));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("ad.approved_on >=", date("Y-m-d H:i:s", strtotime("-1 month")));
			}

			/*location search*/
			if ($s_location != '') {
				$this->db->where("(loc.loc_name LIKE '$s_location%' 
  					OR loc.loc_name LIKE '%$s_location' OR loc.loc_name LIKE '%$s_location%')");
			}


				$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get('postad AS ad', $data['limit'], $data['start']);
			     // echo $this->db->last_query(); exit;
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }
         public function count_ezone_search(){
        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,lg.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->from("postad AS ad");
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join('login as lg', "lg.login_id = ad.login_id", 'join');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->where("ad.category_id", "8");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array(4, $dealurgent)){
					array_push($pcklist, 4);
				}
				if (in_array(5, $dealurgent)){
					array_push($pcklist, 5);
				}
				if (in_array(6, $dealurgent)){
					array_push($pcklist, 6);
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get();
			 // echo $this->db->last_query(); exit;
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }
        public function count_phone_search(){
        	$phone_sub = $this->session->userdata('phone_sub');
        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,lg.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->from("postad AS ad");
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join('login as lg', "lg.login_id = ad.login_id", 'join');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->where("ad.category_id", "8");
			$this->db->where("ad.sub_cat_id", "59");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			if (!empty($phone_sub)) {
				$this->db->where_in('ad.sub_scat_id', $phone_sub);
			}
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array(4, $dealurgent)){
					array_push($pcklist, 4);
				}
				if (in_array(5, $dealurgent)){
					array_push($pcklist, 5);
				}
				if (in_array(6, $dealurgent)){
					array_push($pcklist, 6);
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get();
			 // echo $this->db->last_query(); exit;
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }

        public function count_homes_search(){
        	$homes_sub = $this->session->userdata('homes_sub');
        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,lg.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->from("postad AS ad");
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->join('login as lg', "lg.login_id = ad.login_id", 'join');
			$this->db->where("ad.category_id", "8");
			$this->db->where("ad.sub_cat_id", "60");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			if (!empty($homes_sub)) {
				$this->db->where_in('ad.sub_scat_id', $homes_sub);
			}
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array(4, $dealurgent)){
					array_push($pcklist, 4);
				}
				if (in_array(5, $dealurgent)){
					array_push($pcklist, 5);
				}
				if (in_array(6, $dealurgent)){
					array_push($pcklist, 6);
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get();
			 // echo $this->db->last_query(); exit;
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }
         public function count_smalls_search(){
        	$smalls_sub = $this->session->userdata('smalls_sub');
        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,lg.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->from("postad AS ad");
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->join('login as lg', "lg.login_id = ad.login_id", 'join');
			$this->db->where("ad.category_id", "8");
			$this->db->where("ad.sub_cat_id", "61");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			if (!empty($smalls_sub)) {
				$this->db->where_in('ad.sub_scat_id', $smalls_sub);
			}
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array(4, $dealurgent)){
					array_push($pcklist, 4);
				}
				if (in_array(5, $dealurgent)){
					array_push($pcklist, 5);
				}
				if (in_array(6, $dealurgent)){
					array_push($pcklist, 6);
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get();
			 // echo $this->db->last_query(); exit;
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }
        public function count_lappy_search(){
        	$lappy_sub = $this->session->userdata('lappy_sub');
        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,lg.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->from("postad AS ad");
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->join('login as lg', "lg.login_id = ad.login_id", 'join');
			$this->db->where("ad.category_id", "8");
			$this->db->where("ad.sub_cat_id", "62");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			if (!empty($lappy_sub)) {
				$this->db->where_in('ad.sub_scat_id', $lappy_sub);
			}
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array(4, $dealurgent)){
					array_push($pcklist, 4);
				}
				if (in_array(5, $dealurgent)){
					array_push($pcklist, 5);
				}
				if (in_array(6, $dealurgent)){
					array_push($pcklist, 6);
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get();
			 // echo $this->db->last_query(); exit;
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }
        public function count_access_search(){
        	$access_sub = $this->session->userdata('access_sub');
        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,lg.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->from("postad AS ad");
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->join('login as lg', "lg.login_id = ad.login_id", 'join');
			$this->db->where("ad.category_id", "8");
			$this->db->where("ad.sub_cat_id", "63");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			if (!empty($access_sub)) {
				$this->db->where_in('ad.sub_scat_id', $access_sub);
			}
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array(4, $dealurgent)){
					array_push($pcklist, 4);
				}
				if (in_array(5, $dealurgent)){
					array_push($pcklist, 5);
				}
				if (in_array(6, $dealurgent)){
					array_push($pcklist, 6);
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get();
			 // echo $this->db->last_query(); exit;
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }
        public function count_pcare_search(){
        	$pcare_sub = $this->session->userdata('pcare_sub');
        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,lg.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->from("postad AS ad");
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->join('login as lg', "lg.login_id = ad.login_id", 'join');
			$this->db->where("ad.category_id", "8");
			$this->db->where("ad.sub_cat_id", "64");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			if (!empty($pcare_sub)) {
				$this->db->where_in('ad.sub_scat_id', $pcare_sub);
			}
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array(4, $dealurgent)){
					array_push($pcklist, 4);
				}
				if (in_array(5, $dealurgent)){
					array_push($pcklist, 5);
				}
				if (in_array(6, $dealurgent)){
					array_push($pcklist, 6);
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get();
			 // echo $this->db->last_query(); exit;
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }

        public function count_entertain_search(){
        	$entertain_sub = $this->session->userdata('entertain_sub');
        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,lg.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->from("postad AS ad");
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');

			$this->db->join('login as lg', "lg.login_id = ad.login_id", 'join');
			$this->db->where("ad.category_id", "8");
			$this->db->where("ad.sub_cat_id", "65");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			if (!empty($entertain_sub)) {
				$this->db->where_in('ad.sub_scat_id', $entertain_sub);
			}
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array(4, $dealurgent)){
					array_push($pcklist, 4);
				}
				if (in_array(5, $dealurgent)){
					array_push($pcklist, 5);
				}
				if (in_array(6, $dealurgent)){
					array_push($pcklist, 6);
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get();
			 // echo $this->db->last_query(); exit;
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }

        

        public function count_cars_search(){
        	$car_sub = $this->session->userdata('cars_sub');
        	$engine = $this->session->userdata('engine');
        	$nomiles = $this->session->userdata('nomiles');
        	$fueltype = $this->session->userdata('fueltype');
        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->from("postad AS ad");
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join('motor_car_van_bus_ads as mc', "mc.ad_id = ad.ad_id", 'left');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->where("ad.category_id", "3");
			$this->db->where("ad.sub_cat_id", "12");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			if (!empty($car_sub)) {
				$this->db->where_in('mc.manufacture', $car_sub);
			}
			if ($nomiles) {
				if ($nomiles != 'all') {
					if ($nomiles == '15000') {
						$this->db->where('mc.tot_miles BETWEEN 1 AND 15000');
					}
					if ($nomiles == '30000') {
						$this->db->where('mc.tot_miles BETWEEN 15001 AND 30000');
					}
					if ($nomiles == '50000') {
						$this->db->where('mc.tot_miles  BETWEEN 30001 AND 50000');
					}
					if ($nomiles == '60000') {
						$this->db->where('mc.tot_miles BETWEEN 50001 AND 50000');
					}
				}
			}
			if ($engine) {
				if ($engine != 'any') {
					if ($engine == '1000') {
						$this->db->where('mc.engine_size BETWEEN 1 AND 1000');
					}
					if ($engine == '2000') {
						$this->db->where('mc.engine_size BETWEEN 1001 AND 2000');
					}
					if ($engine == '3000') {
						$this->db->where('mc.engine_size BETWEEN 2001 AND 3000');
					}
					if ($engine == '3001') {
						$this->db->where('mc.engine_size >', '3001');
					}
				}
			}
			if (!empty($fueltype)) {
				$this->db->where_in('mc.fueltype', $fueltype);
			}
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array(1, $dealurgent)){
					array_push($pcklist, 1);
				}
				if (in_array(2, $dealurgent)){
					array_push($pcklist, 2);
				}
				if (in_array(3, $dealurgent)){
					array_push($pcklist, 3);
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get();
			 // echo $this->db->last_query(); exit;
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }
          public function count_plants_search(){
          	$plants_sub = $this->session->userdata('plants_sub');
        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->from("postad AS ad");
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join('motor_plant_farming as mc', "mc.ad_id = ad.ad_id", 'left');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->where("ad.category_id", "3");
			$this->db->where("ad.sub_cat_id", "17");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			if (!empty($plants_sub)) {
				$this->db->where_in('ad.sub_scat_id', $plants_sub);
			}
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array(1, $dealurgent)){
					array_push($pcklist, 1);
				}
				if (in_array(2, $dealurgent)){
					array_push($pcklist, 2);
				}
				if (in_array(3, $dealurgent)){
					array_push($pcklist, 3);
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get();
			 // echo $this->db->last_query(); exit;
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }
         public function count_farming_search(){
         	$farming_sub =  $this->session->userdata('farming_sub');
        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->from("postad AS ad");
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join('motor_plant_farming as mc', "mc.ad_id = ad.ad_id", 'left');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->where("ad.category_id", "3");
			$this->db->where("ad.sub_cat_id", "18");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			if (!empty($farming_sub)) {
				$this->db->where_in('ad.sub_scat_id', $farming_sub);
			}
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array(1, $dealurgent)){
					array_push($pcklist, 1);
				}
				if (in_array(2, $dealurgent)){
					array_push($pcklist, 2);
				}
				if (in_array(3, $dealurgent)){
					array_push($pcklist, 3);
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get();
			 // echo $this->db->last_query(); exit;
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }
         public function count_boats_search(){
         	$boats_sub = $this->session->userdata('boats_sub');
        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->from("postad AS ad");
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join('motor_plant_farming as mc', "mc.ad_id = ad.ad_id", 'left');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->where("ad.category_id", "3");
			$this->db->where("ad.sub_cat_id", "19");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			if (!empty($boats_sub)) {
				$this->db->where_in('ad.sub_scat_id', $boats_sub);
			}
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array(1, $dealurgent)){
					array_push($pcklist, 1);
				}
				if (in_array(2, $dealurgent)){
					array_push($pcklist, 2);
				}
				if (in_array(3, $dealurgent)){
					array_push($pcklist, 3);
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get();
			 // echo $this->db->last_query(); exit;
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }
        public function plants_search($data){
        	$plants_sub = $this->session->userdata('plants_sub');
        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join('motor_home_ads as mc', "mc.ad_id = ad.ad_id", 'left');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->where("ad.category_id", "3");
			$this->db->where("ad.sub_cat_id", "17");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			if (!empty($plants_sub)) {
				$this->db->where_in('ad.sub_scat_id', $plants_sub);
			}
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array(1, $dealurgent)){
					array_push($pcklist, 1);
				}
				if (in_array(2, $dealurgent)){
					array_push($pcklist, 2);
				}
				if (in_array(3, $dealurgent)){
					array_push($pcklist, 3);
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get('postad AS ad', $data['limit'], $data['start']);
			 // echo $this->db->last_query(); exit;
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }
        public function farming_search($data){
        	$farming_sub =  $this->session->userdata('farming_sub');
        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join('motor_home_ads as mc', "mc.ad_id = ad.ad_id", 'left');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->where("ad.category_id", "3");
			$this->db->where("ad.sub_cat_id", "18");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			if (!empty($farming_sub)) {
				$this->db->where_in('ad.sub_scat_id', $farming_sub);
			}
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array(1, $dealurgent)){
					array_push($pcklist, 1);
				}
				if (in_array(2, $dealurgent)){
					array_push($pcklist, 2);
				}
				if (in_array(3, $dealurgent)){
					array_push($pcklist, 3);
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get('postad AS ad', $data['limit'], $data['start']);
			 // echo $this->db->last_query(); exit;
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }
        public function boats_search($data){
        	$boats_sub = $this->session->userdata('boats_sub');
        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join('motor_home_ads as mc', "mc.ad_id = ad.ad_id", 'left');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->where("ad.category_id", "3");
			$this->db->where("ad.sub_cat_id", "19");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			if (!empty($boats_sub)) {
				$this->db->where_in('ad.sub_scat_id', $boats_sub);
			}
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array(1, $dealurgent)){
					array_push($pcklist, 1);
				}
				if (in_array(2, $dealurgent)){
					array_push($pcklist, 2);
				}
				if (in_array(3, $dealurgent)){
					array_push($pcklist, 3);
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get('postad AS ad', $data['limit'], $data['start']);
			 // echo $this->db->last_query(); exit;
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }
        public function carvans_search($data){
        	$engine = $this->session->userdata('engine');
        	$nomiles = $this->session->userdata('nomiles');
        	$fueltype = $this->session->userdata('fueltype');
        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$latt = $this->session->userdata('latt');
        	$longg = $this->session->userdata('longg');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join('motor_home_ads as mc', "mc.ad_id = ad.ad_id", 'left');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->where("ad.category_id", "3");
			$this->db->where("ad.sub_cat_id", "14");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			if ($engine) {
				if ($engine != 'any') {
					if ($engine == '1000') {
						$this->db->where('mc.engine_size <=', '1000');
					}
					if ($engine == '2000') {
						$this->db->where('mc.engine_size <=', '2000');
					}
					if ($engine == '3000') {
						$this->db->where('mc.engine_size <=', '3000');
					}
					if ($engine == '3001') {
						$this->db->where('mc.engine_size >', '3001');
					}
				}
			}
			if ($nomiles) {
				if ($nomiles != 'all') {
					if ($nomiles == '15000') {
						$this->db->where('mc.tot_miles <=', '15000');
					}
					if ($nomiles == '30000') {
						$this->db->where('mc.tot_miles <=', '30000');
					}
					if ($nomiles == '50000') {
						$this->db->where('mc.tot_miles <=', '50000');
					}
					if ($nomiles == '60000') {
						$this->db->where('mc.tot_miles >', '50000');
					}
				}
			}
			if (!empty($fueltype)) {
				$this->db->where_in('mc.fueltype', $fueltype);
			}
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array(1, $dealurgent)){
					array_push($pcklist, 1);
				}
				if (in_array(2, $dealurgent)){
					array_push($pcklist, 2);
				}
				if (in_array(3, $dealurgent)){
					array_push($pcklist, 3);
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($latt) {
				$this->db->where("loc.latt", $latt);
				$this->db->where("loc.longg", $longg);
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get('postad AS ad', $data['limit'], $data['start']);
			 // echo $this->db->last_query(); exit;
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }
        public function coaches_search($data){
        	$engine = $this->session->userdata('engine');
        	$nomiles = $this->session->userdata('nomiles');
        	$fueltype = $this->session->userdata('fueltype');
        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join('motor_car_van_bus_ads as mc', "mc.ad_id = ad.ad_id", 'left');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->where("ad.category_id", "3");
			$this->db->where("ad.sub_cat_id", "16");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			if ($engine) {
				if ($engine != 'any') {
					if ($engine == '1000') {
						$this->db->where('mc.engine_size <=', '1000');
					}
					if ($engine == '2000') {
						$this->db->where('mc.engine_size <=', '2000');
					}
					if ($engine == '3000') {
						$this->db->where('mc.engine_size <=', '3000');
					}
					if ($engine == '3001') {
						$this->db->where('mc.engine_size >', '3001');
					}
				}
			}
			if ($nomiles) {
				if ($nomiles != 'all') {
					if ($nomiles == '15000') {
						$this->db->where('mc.tot_miles <=', '15000');
					}
					if ($nomiles == '30000') {
						$this->db->where('mc.tot_miles <=', '30000');
					}
					if ($nomiles == '50000') {
						$this->db->where('mc.tot_miles <=', '50000');
					}
					if ($nomiles == '60000') {
						$this->db->where('mc.tot_miles >', '50000');
					}
				}
			}
			if (!empty($fueltype)) {
				$this->db->where_in('mc.fueltype', $fueltype);
			}
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array(1, $dealurgent)){
					array_push($pcklist, 1);
				}
				if (in_array(2, $dealurgent)){
					array_push($pcklist, 2);
				}
				if (in_array(3, $dealurgent)){
					array_push($pcklist, 3);
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get('postad AS ad', $data['limit'], $data['start']);
			 // echo $this->db->last_query(); exit;
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }
        public function vans_search($data){
        	$engine = $this->session->userdata('engine');
        	$nomiles = $this->session->userdata('nomiles');
        	$fueltype = $this->session->userdata('fueltype');
        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join('motor_car_van_bus_ads as mc', "mc.ad_id = ad.ad_id", 'left');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->where("ad.category_id", "3");
			$this->db->where("ad.sub_cat_id", "15");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			if ($engine) {
				if ($engine != 'any') {
					if ($engine == '1000') {
						$this->db->where('mc.engine_size <=', '1000');
					}
					if ($engine == '2000') {
						$this->db->where('mc.engine_size <=', '2000');
					}
					if ($engine == '3000') {
						$this->db->where('mc.engine_size <=', '3000');
					}
					if ($engine == '3001') {
						$this->db->where('mc.engine_size >', '3001');
					}
				}
			}
			if ($nomiles) {
				if ($nomiles != 'all') {
					if ($nomiles == '15000') {
						$this->db->where('mc.tot_miles <=', '15000');
					}
					if ($nomiles == '30000') {
						$this->db->where('mc.tot_miles <=', '30000');
					}
					if ($nomiles == '50000') {
						$this->db->where('mc.tot_miles <=', '50000');
					}
					if ($nomiles == '60000') {
						$this->db->where('mc.tot_miles >', '50000');
					}
				}
			}
			if (!empty($fueltype)) {
				$this->db->where_in('mc.fueltype', $fueltype);
			}
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array(1, $dealurgent)){
					array_push($pcklist, 1);
				}
				if (in_array(2, $dealurgent)){
					array_push($pcklist, 2);
				}
				if (in_array(3, $dealurgent)){
					array_push($pcklist, 3);
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get('postad AS ad', $data['limit'], $data['start']);
			 // echo $this->db->last_query(); exit;
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }
        public function count_carvans_search(){
        	$engine = $this->session->userdata('engine');
        	$nomiles = $this->session->userdata('nomiles');
        	$fueltype = $this->session->userdata('fueltype');
        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->from("postad AS ad");
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join('motor_home_ads as mc', "mc.ad_id = ad.ad_id", 'left');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->where("ad.category_id", "3");
			$this->db->where("ad.sub_cat_id", "14");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			if ($nomiles) {
				if ($nomiles != 'all') {
					if ($nomiles == '15000') {
						$this->db->where('mc.tot_miles BETWEEN 1 AND 15000');
					}
					if ($nomiles == '30000') {
						$this->db->where('mc.tot_miles BETWEEN 15001 AND 30000');
					}
					if ($nomiles == '50000') {
						$this->db->where('mc.tot_miles  BETWEEN 30001 AND 50000');
					}
					if ($nomiles == '60000') {
						$this->db->where('mc.tot_miles BETWEEN 50001 AND 50000');
					}
				}
			}
			if ($engine) {
				if ($engine != 'any') {
					if ($engine == '1000') {
						$this->db->where('mc.engine_size BETWEEN 1 AND 1000');
					}
					if ($engine == '2000') {
						$this->db->where('mc.engine_size BETWEEN 1001 AND 2000');
					}
					if ($engine == '3000') {
						$this->db->where('mc.engine_size BETWEEN 2001 AND 3000');
					}
					if ($engine == '3001') {
						$this->db->where('mc.engine_size >', '3001');
					}
				}
			}
			if (!empty($fueltype)) {
				$this->db->where_in('mc.fueltype', $fueltype);
			}
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array(1, $dealurgent)){
					array_push($pcklist, 1);
				}
				if (in_array(2, $dealurgent)){
					array_push($pcklist, 2);
				}
				if (in_array(3, $dealurgent)){
					array_push($pcklist, 3);
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get();
			 // echo $this->db->last_query(); exit;
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }

        public function count_coaches_search(){
        	$engine = $this->session->userdata('engine');
        	$nomiles = $this->session->userdata('nomiles');
        	$fueltype = $this->session->userdata('fueltype');
        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->from("postad AS ad");
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join('motor_car_van_bus_ads as mc', "mc.ad_id = ad.ad_id", 'left');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->where("ad.category_id", "3");
			$this->db->where("ad.sub_cat_id", "16");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			if ($nomiles) {
				if ($nomiles != 'all') {
					if ($nomiles == '15000') {
						$this->db->where('mc.tot_miles BETWEEN 1 AND 15000');
					}
					if ($nomiles == '30000') {
						$this->db->where('mc.tot_miles BETWEEN 15001 AND 30000');
					}
					if ($nomiles == '50000') {
						$this->db->where('mc.tot_miles  BETWEEN 30001 AND 50000');
					}
					if ($nomiles == '60000') {
						$this->db->where('mc.tot_miles BETWEEN 50001 AND 50000');
					}
				}
			}
			if ($engine) {
				if ($engine != 'any') {
					if ($engine == '1000') {
						$this->db->where('mc.engine_size BETWEEN 1 AND 1000');
					}
					if ($engine == '2000') {
						$this->db->where('mc.engine_size BETWEEN 1001 AND 2000');
					}
					if ($engine == '3000') {
						$this->db->where('mc.engine_size BETWEEN 2001 AND 3000');
					}
					if ($engine == '3001') {
						$this->db->where('mc.engine_size >', '3001');
					}
				}
			}
			if (!empty($fueltype)) {
				$this->db->where_in('mc.fueltype', $fueltype);
			}
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array(1, $dealurgent)){
					array_push($pcklist, 1);
				}
				if (in_array(2, $dealurgent)){
					array_push($pcklist, 2);
				}
				if (in_array(3, $dealurgent)){
					array_push($pcklist, 3);
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get();
			 // echo $this->db->last_query(); exit;
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }
         public function count_vans_search(){
        	$engine = $this->session->userdata('engine');
        	$nomiles = $this->session->userdata('nomiles');
        	$fueltype = $this->session->userdata('fueltype');
        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->from("postad AS ad");
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join('motor_car_van_bus_ads as mc', "mc.ad_id = ad.ad_id", 'left');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->where("ad.category_id", "3");
			$this->db->where("ad.sub_cat_id", "15");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			if ($nomiles) {
				if ($nomiles != 'all') {
					if ($nomiles == '15000') {
						$this->db->where('mc.tot_miles BETWEEN 1 AND 15000');
					}
					if ($nomiles == '30000') {
						$this->db->where('mc.tot_miles BETWEEN 15001 AND 30000');
					}
					if ($nomiles == '50000') {
						$this->db->where('mc.tot_miles  BETWEEN 30001 AND 50000');
					}
					if ($nomiles == '60000') {
						$this->db->where('mc.tot_miles BETWEEN 50001 AND 50000');
					}
				}
			}
			if ($engine) {
				if ($engine != 'any') {
					if ($engine == '1000') {
						$this->db->where('mc.engine_size BETWEEN 1 AND 1000');
					}
					if ($engine == '2000') {
						$this->db->where('mc.engine_size BETWEEN 1001 AND 2000');
					}
					if ($engine == '3000') {
						$this->db->where('mc.engine_size BETWEEN 2001 AND 3000');
					}
					if ($engine == '3001') {
						$this->db->where('mc.engine_size >', '3001');
					}
				}
			}
			if (!empty($fueltype)) {
				$this->db->where_in('mc.fueltype', $fueltype);
			}
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array(1, $dealurgent)){
					array_push($pcklist, 1);
				}
				if (in_array(2, $dealurgent)){
					array_push($pcklist, 2);
				}
				if (in_array(3, $dealurgent)){
					array_push($pcklist, 3);
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get();
			 // echo $this->db->last_query(); exit;
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }

        public function count_bikes_search(){
        	$engine = $this->session->userdata('engine');
        	$nomiles = $this->session->userdata('nomiles');
        	$fueltype = $this->session->userdata('fueltype');
        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->from("postad AS ad");
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join('motor_bike_ads as mc', "mc.ad_id = ad.ad_id", 'left');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->where("ad.category_id", "3");
			$this->db->where("ad.sub_cat_id", "13");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			if ($nomiles) {
				if ($nomiles != 'all') {
					if ($nomiles == '15000') {
						$this->db->where('mc.no_of_miles BETWEEN 1 AND 15000');
					}
					if ($nomiles == '30000') {
						$this->db->where('mc.no_of_miles BETWEEN 15001 AND 30000');
					}
					if ($nomiles == '50000') {
						$this->db->where('mc.no_of_miles  BETWEEN 30001 AND 50000');
					}
					if ($nomiles == '60000') {
						$this->db->where('mc.no_of_miles BETWEEN 50001 AND 50000');
					}
				}
			}
			if ($engine) {
				if ($engine != 'any') {
					if ($engine == '1000') {
						$this->db->where('mc.engine_size BETWEEN 1 AND 1000');
					}
					if ($engine == '2000') {
						$this->db->where('mc.engine_size BETWEEN 1001 AND 2000');
					}
					if ($engine == '3000') {
						$this->db->where('mc.engine_size BETWEEN 2001 AND 3000');
					}
					if ($engine == '3001') {
						$this->db->where('mc.engine_size >', '3001');
					}
				}
			}
			if (!empty($fueltype)) {
				$this->db->where_in('mc.fuel_type', $fueltype);
			}
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array(1, $dealurgent)){
					array_push($pcklist, 1);
				}
				if (in_array(2, $dealurgent)){
					array_push($pcklist, 2);
				}
				if (in_array(3, $dealurgent)){
					array_push($pcklist, 3);
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get();
			 // echo $this->db->last_query(); exit;
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }

        public function cars_search($data){
        	$car_sub = $this->session->userdata('cars_sub');
        	$engine = $this->session->userdata('engine');
        	$nomiles = $this->session->userdata('nomiles');
        	$fueltype = $this->session->userdata('fueltype');
        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join('motor_car_van_bus_ads as mc', "mc.ad_id = ad.ad_id", 'left');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->where("ad.category_id", "3");
			$this->db->where("ad.sub_cat_id", "12");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			if (!empty($car_sub)) {
				$this->db->where_in('mc.manufacture', $car_sub);
			}
			if ($engine) {
				if ($engine != 'any') {
					if ($engine == '1000') {
						$this->db->where('mc.engine_size <=', '1000');
					}
					if ($engine == '2000') {
						$this->db->where('mc.engine_size <=', '2000');
					}
					if ($engine == '3000') {
						$this->db->where('mc.engine_size <=', '3000');
					}
					if ($engine == '3001') {
						$this->db->where('mc.engine_size >', '3001');
					}
				}
			}
			if ($nomiles) {
				if ($nomiles != 'all') {
					if ($nomiles == '15000') {
						$this->db->where('mc.tot_miles <=', '15000');
					}
					if ($nomiles == '30000') {
						$this->db->where('mc.tot_miles <=', '30000');
					}
					if ($nomiles == '50000') {
						$this->db->where('mc.tot_miles <=', '50000');
					}
					if ($nomiles == '60000') {
						$this->db->where('mc.tot_miles >', '50000');
					}
				}
			}
			if (!empty($fueltype)) {
				$this->db->where_in('mc.fueltype', $fueltype);
			}
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array(1, $dealurgent)){
					array_push($pcklist, 1);
				}
				if (in_array(2, $dealurgent)){
					array_push($pcklist, 2);
				}
				if (in_array(3, $dealurgent)){
					array_push($pcklist, 3);
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get('postad AS ad', $data['limit'], $data['start']);
			 // echo $this->db->last_query(); exit;
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }
        public function bikes_search($data){
        	$engine = $this->session->userdata('engine');
        	$nomiles = $this->session->userdata('nomiles');
        	$fueltype = $this->session->userdata('fueltype');
        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join('motor_bike_ads as mc', "mc.ad_id = ad.ad_id", 'left');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->where("ad.category_id", "3");
			$this->db->where("ad.sub_cat_id", "13");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			if ($engine) {
				if ($engine != 'any') {
					if ($engine == '1000') {
						$this->db->where('mc.engine_size <=', '1000');
					}
					if ($engine == '2000') {
						$this->db->where('mc.engine_size <=', '2000');
					}
					if ($engine == '3000') {
						$this->db->where('mc.engine_size <=', '3000');
					}
					if ($engine == '3001') {
						$this->db->where('mc.engine_size >', '3001');
					}
				}
			}
			if ($nomiles) {
				if ($nomiles != 'all') {
					if ($nomiles == '15000') {
						$this->db->where('mc.no_of_miles <=', '15000');
					}
					if ($nomiles == '30000') {
						$this->db->where('mc.no_of_miles <=', '30000');
					}
					if ($nomiles == '50000') {
						$this->db->where('mc.no_of_miles <=', '50000');
					}
					if ($nomiles == '60000') {
						$this->db->where('mc.no_of_miles >', '50000');
					}
				}
			}
			if (!empty($fueltype)) {
				$this->db->where_in('mc.fuel_type', $fueltype);
			}
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array(1, $dealurgent)){
					array_push($pcklist, 1);
				}
				if (in_array(2, $dealurgent)){
					array_push($pcklist, 2);
				}
				if (in_array(3, $dealurgent)){
					array_push($pcklist, 3);
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get('postad AS ad', $data['limit'], $data['start']);
			 // echo $this->db->last_query(); exit;
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }

        /*kitchen home search*/
       	public function kitchenhome_search($data){
        	$kitchen_sub = $this->session->userdata('kitchen_search');
	        $search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->where("ad.category_id", "7");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			if (!empty($kitchen_sub)) {
				$this->db->where_in('ad.sub_scat_id', $kitchen_sub);
			}
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array("6", $dealurgent)){
					array_push($pcklist, '6');
				}
				if (in_array("5", $dealurgent)){
					array_push($pcklist, '5');
				}
				if (in_array("4", $dealurgent)){
					array_push($pcklist, '4');
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get('postad AS ad', $data['limit'], $data['start']);
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }

        public function count_kitchenhome_search(){
        	$kitchen_sub = $this->session->userdata('kitchen_search');
	        $search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->from("postad AS ad");
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->where("ad.category_id", "7");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			if (!empty($kitchen_sub)) {
				$this->db->where_in('ad.sub_scat_id', $kitchen_sub);
			}
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array("6", $dealurgent)){
					array_push($pcklist, '6');
				}
				if (in_array("5", $dealurgent)){
					array_push($pcklist, '5');
				}
				if (in_array("4", $dealurgent)){
					array_push($pcklist, '4');
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get();
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }

        /*find a property*/
        public function residential_search($data){
	 		$proptype = $this->session->userdata('proptype');
            $bedrooms = $this->session->userdata('bed_rooms');
            $bathroom = $this->session->userdata('bathroom');
            $area = $this->session->userdata('area_square');

        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			// $this->db->from("postad AS ad");
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join('property_resid_commercial as prc', "ad.ad_id = prc.ad_id", 'join');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->where("ad.category_id", "4");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			if (!empty($proptype)) {
				$this->db->where_in('ad.sub_cat_id', $proptype);
			}
			if (!empty($seller)) {
				$this->db->where_in('prc.offered_type', $seller);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array("3", $dealurgent)){
					array_push($pcklist, '3');
				}
				if (in_array("2", $dealurgent)){
					array_push($pcklist, '2');
				}
				if (in_array("1", $dealurgent)){
					array_push($pcklist, '1');
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}
			/*bedrooms search*/
			if (!empty($bedrooms)) {
				$bed_where = '';
				foreach ($bedrooms as $bedroomval) {
					if ($bedroomval == '1') {
						$bed_where .= '(prc.bed_rooms = 1)';
					}
					else if ($bedroomval == '2') {
						$bed_where .= 'OR (prc.bed_rooms = 2)';
					}
					else if ($bedroomval == '3') {
						$bed_where .= 'OR (prc.bed_rooms = 3)';
					}
					else if ($bedroomval == '4') {
						$bed_where .= 'OR (prc.bed_rooms > 4)';
					}
				}
				$this->db->where(ltrim($bed_where,"OR "));
			}
			/*bathroom search*/
			if (!empty($bathroom)) {
				$bath_where = '';
				foreach ($bathroom as $bathroomval) {
					if ($bathroomval == '1') {
						$bath_where .= '(prc.bath_rooms = 1)';
					}
					else if ($bathroomval == '2') {
						$bath_where .= 'OR (prc.bath_rooms = 2)';
					}
					else if ($bathroomval == '3') {
						$bath_where .= 'OR (prc.bath_rooms = 3)';
					}
					else if ($bathroomval == '4') {
						$bath_where .= 'OR (prc.bath_rooms > 4)';
					}
				}
				$this->db->where(ltrim($bath_where,"OR "));
			}
			/*area square*/
			if (!empty($area)) {
				$area_where = '';
				foreach ($area as $aval) {
					if ($aval == '<500') {
						$area_where .= '(prc.build_area < 500)';
					}
					else if ($aval == '500-1000') {
						$area_where .= 'OR (prc.build_area BETWEEN 500 AND 1000)';
					}
					else if ($aval == '1000-1500') {
						$area_where .= 'OR (prc.build_area BETWEEN 1000 AND 1500)';
					}
					else if ($aval == '1500-2000') {
						$area_where .= 'OR (prc.build_area BETWEEN 1500 AND 2000)';
					}
					else if ($aval == '>2000') {
						$area_where .= 'OR (prc.build_area > 2000)';
					}
				}
				$this->db->where(ltrim($area_where,"OR "));
			}
			


			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get('postad AS ad', $data['limit'], $data['start']);
			 // echo $this->db->last_query(); exit;
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }
         public function propertyresi_search($data){
         	$search_proptype = $this->session->userdata('search_proptype');
			$search_resisub = $this->session->userdata('search_resisub');
			$search_commsub = $this->session->userdata('search_commsub');
			$resi_prop = $this->session->userdata('resi_prop');
			$comm_prop = $this->session->userdata('comm_prop');
	 		$proptype = $this->session->userdata('proptype');
            $bedrooms = $this->session->userdata('bed_rooms');
            $bathroom = $this->session->userdata('bathroom');
            $area = $this->session->userdata('area_square');

        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			// $this->db->from("postad AS ad");
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->join('property_resid_commercial as prc', "ad.ad_id = prc.ad_id", 'join');
			$this->db->where("ad.category_id", "4");
			$this->db->where("ad.sub_cat_id", "11");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			if (!empty($proptype)) {
				$this->db->where_in('ad.sub_cat_id', $proptype);
			}
			if (!empty($seller)) {
				$this->db->where_in('prc.offered_type', $seller);
			}
			if ($search_resisub) {
				$this->db->where('prc.property_for', $search_resisub);
			}
			if (!empty($resi_prop)) {
				$this->db->where_in('prc.property_type', $resi_prop);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array("3", $dealurgent)){
					array_push($pcklist, '3');
				}
				if (in_array("2", $dealurgent)){
					array_push($pcklist, '2');
				}
				if (in_array("1", $dealurgent)){
					array_push($pcklist, '1');
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}
			/*bedrooms search*/
			if (!empty($bedrooms)) {
				$bed_where = '';
				foreach ($bedrooms as $bedroomval) {
					if ($bedroomval == '1') {
						$bed_where .= '(prc.bed_rooms = 1)';
					}
					else if ($bedroomval == '2') {
						$bed_where .= 'OR (prc.bed_rooms = 2)';
					}
					else if ($bedroomval == '3') {
						$bed_where .= 'OR (prc.bed_rooms = 3)';
					}
					else if ($bedroomval == '4') {
						$bed_where .= 'OR (prc.bed_rooms > 4)';
					}
				}
				$this->db->where(ltrim($bed_where,"OR "));
			}
			/*bathroom search*/
			if (!empty($bathroom)) {
				$bath_where = '';
				foreach ($bathroom as $bathroomval) {
					if ($bathroomval == '1') {
						$bath_where .= '(prc.bath_rooms = 1)';
					}
					else if ($bathroomval == '2') {
						$bath_where .= 'OR (prc.bath_rooms = 2)';
					}
					else if ($bathroomval == '3') {
						$bath_where .= 'OR (prc.bath_rooms = 3)';
					}
					else if ($bathroomval == '4') {
						$bath_where .= 'OR (prc.bath_rooms > 4)';
					}
				}
				$this->db->where(ltrim($bath_where,"OR "));
			}
			/*area square*/
			if (!empty($area)) {
				$area_where = '';
				foreach ($area as $aval) {
					if ($aval == '<500') {
						$area_where .= '(prc.build_area < 500)';
					}
					else if ($aval == '500-1000') {
						$area_where .= 'OR (prc.build_area BETWEEN 500 AND 1000)';
					}
					else if ($aval == '1000-1500') {
						$area_where .= 'OR (prc.build_area BETWEEN 1000 AND 1500)';
					}
					else if ($aval == '1500-2000') {
						$area_where .= 'OR (prc.build_area BETWEEN 1500 AND 2000)';
					}
					else if ($aval == '>2000') {
						$area_where .= 'OR (prc.build_area > 2000)';
					}
				}
				$this->db->where(ltrim($area_where,"OR "));
			}
			


			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get('postad AS ad', $data['limit'], $data['start']);
			 // echo $this->db->last_query(); exit;
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }
         public function propertycomm_search($data){
         	$search_commsub = $this->session->userdata('search_commsub');
			$comm_prop = $this->session->userdata('comm_prop');
	 		$proptype = $this->session->userdata('proptype');
            $bedrooms = $this->session->userdata('bed_rooms');
            $bathroom = $this->session->userdata('bathroom');
            $area = $this->session->userdata('area_square');

        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			// $this->db->from("postad AS ad");
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->join('property_resid_commercial as prc', "ad.ad_id = prc.ad_id", 'join');
			$this->db->where("ad.category_id", "4");
			$this->db->where("ad.sub_cat_id", "26");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			if (!empty($proptype)) {
				$this->db->where_in('ad.sub_cat_id', $proptype);
			}
			if (!empty($seller)) {
				$this->db->where_in('prc.offered_type', $seller);
			}
			if ($search_commsub) {
				$this->db->where('prc.property_for', $search_commsub);
			}
			if (!empty($comm_prop)) {
				$this->db->where_in('prc.property_type', $comm_prop);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array("3", $dealurgent)){
					array_push($pcklist, '3');
				}
				if (in_array("2", $dealurgent)){
					array_push($pcklist, '2');
				}
				if (in_array("1", $dealurgent)){
					array_push($pcklist, '1');
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}
			/*bedrooms search*/
			if (!empty($bedrooms)) {
				$bed_where = '';
				foreach ($bedrooms as $bedroomval) {
					if ($bedroomval == '1') {
						$bed_where .= '(prc.bed_rooms = 1)';
					}
					else if ($bedroomval == '2') {
						$bed_where .= 'OR (prc.bed_rooms = 2)';
					}
					else if ($bedroomval == '3') {
						$bed_where .= 'OR (prc.bed_rooms = 3)';
					}
					else if ($bedroomval == '4') {
						$bed_where .= 'OR (prc.bed_rooms > 4)';
					}
				}
				$this->db->where(ltrim($bed_where,"OR "));
			}
			/*bathroom search*/
			if (!empty($bathroom)) {
				$bath_where = '';
				foreach ($bathroom as $bathroomval) {
					if ($bathroomval == '1') {
						$bath_where .= '(prc.bath_rooms = 1)';
					}
					else if ($bathroomval == '2') {
						$bath_where .= 'OR (prc.bath_rooms = 2)';
					}
					else if ($bathroomval == '3') {
						$bath_where .= 'OR (prc.bath_rooms = 3)';
					}
					else if ($bathroomval == '4') {
						$bath_where .= 'OR (prc.bath_rooms > 4)';
					}
				}
				$this->db->where(ltrim($bath_where,"OR "));
			}
			/*area square*/
			if (!empty($area)) {
				$area_where = '';
				foreach ($area as $aval) {
					if ($aval == '<500') {
						$area_where .= '(prc.build_area < 500)';
					}
					else if ($aval == '500-1000') {
						$area_where .= 'OR (prc.build_area BETWEEN 500 AND 1000)';
					}
					else if ($aval == '1000-1500') {
						$area_where .= 'OR (prc.build_area BETWEEN 1000 AND 1500)';
					}
					else if ($aval == '1500-2000') {
						$area_where .= 'OR (prc.build_area BETWEEN 1500 AND 2000)';
					}
					else if ($aval == '>2000') {
						$area_where .= 'OR (prc.build_area > 2000)';
					}
				}
				$this->db->where(ltrim($area_where,"OR "));
			}
			


			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get('postad AS ad', $data['limit'], $data['start']);
			 // echo $this->db->last_query(); exit;
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }

        public function count_residential_search(){
        	$proptype = $this->session->userdata('proptype');
            $bedrooms = $this->session->userdata('bed_rooms');
            $bathroom = $this->session->userdata('bathroom');
            $area = $this->session->userdata('area_square');
        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->from("postad AS ad");
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join('property_resid_commercial as prc', "ad.ad_id = prc.ad_id", 'join');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->where("ad.category_id", "4");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			if (!empty($proptype)) {
				$this->db->where_in('ad.sub_cat_id', $proptype);
			}
			if (!empty($seller)) {
				$this->db->where_in('prc.offered_type', $seller);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array("3", $dealurgent)){
					array_push($pcklist, '3');
				}
				if (in_array("2", $dealurgent)){
					array_push($pcklist, '2');
				}
				if (in_array("1", $dealurgent)){
					array_push($pcklist, '1');
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}
			/*bedrooms search*/
			if (!empty($bedrooms)) {
				$bed_where = '';
				foreach ($bedrooms as $bedroomval) {
					if ($bedroomval == '1') {
						$bed_where .= '(prc.bed_rooms = 1)';
					}
					else if ($bedroomval == '2') {
						$bed_where .= 'OR (prc.bed_rooms = 2)';
					}
					else if ($bedroomval == '3') {
						$bed_where .= 'OR (prc.bed_rooms = 3)';
					}
					else if ($bedroomval == '4') {
						$bed_where .= 'OR (prc.bed_rooms > 4)';
					}
				}
				$this->db->where(ltrim($bed_where,"OR "));
			}
			/*bathroom search*/
			if (!empty($bathroom)) {
				$bath_where = '';
				foreach ($bathroom as $bathroomval) {
					if ($bathroomval == '1') {
						$bath_where .= '(prc.bath_rooms = 1)';
					}
					else if ($bathroomval == '2') {
						$bath_where .= 'OR (prc.bath_rooms = 2)';
					}
					else if ($bathroomval == '3') {
						$bath_where .= 'OR (prc.bath_rooms = 3)';
					}
					else if ($bathroomval == '4') {
						$bath_where .= 'OR (prc.bath_rooms > 4)';
					}
				}
				$this->db->where(ltrim($bath_where,"OR "));
			}
			/*area square*/
			if (!empty($area)) {
				$area_where = '';
				foreach ($area as $aval) {
					if ($aval == '<500') {
						$area_where .= '(prc.build_area < 500)';
					}
					else if ($aval == '500-1000') {
						$area_where .= 'OR (prc.build_area BETWEEN 500 AND 1000)';
					}
					else if ($aval == '1000-1500') {
						$area_where .= 'OR (prc.build_area BETWEEN 1000 AND 1500)';
					}
					else if ($aval == '1500-2000') {
						$area_where .= 'OR (prc.build_area BETWEEN 1500 AND 2000)';
					}
					else if ($aval == '>2000') {
						$area_where .= 'OR (prc.build_area > 2000)';
					}
				}
				$this->db->where(ltrim($area_where,"OR "));
			}
			


			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get();
			  // echo $this->db->last_query(); exit;
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }
        public function count_propertyresi_search(){
        	$search_proptype = $this->session->userdata('search_proptype');
			$search_resisub = $this->session->userdata('search_resisub');
			$search_commsub = $this->session->userdata('search_commsub');
			$resi_prop = $this->session->userdata('resi_prop');
			$comm_prop = $this->session->userdata('comm_prop');
        	$proptype = $this->session->userdata('proptype');
            $bedrooms = $this->session->userdata('bed_rooms');
            $bathroom = $this->session->userdata('bathroom');
            $area = $this->session->userdata('area_square');
        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->from("postad AS ad");
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join('property_resid_commercial as prc', "ad.ad_id = prc.ad_id", 'join');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->where("ad.category_id", "4");
			$this->db->where("ad.sub_cat_id", "11");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			if (!empty($proptype)) {
				$this->db->where_in('ad.sub_cat_id', $proptype);
			}
			if (!empty($seller)) {
				$this->db->where_in('prc.offered_type', $seller);
			}
			if ($search_resisub) {
				$this->db->where('prc.property_for', $search_resisub);
			}
			if (!empty($resi_prop)) {
				$this->db->where_in('prc.property_type', $resi_prop);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array("3", $dealurgent)){
					array_push($pcklist, '3');
				}
				if (in_array("2", $dealurgent)){
					array_push($pcklist, '2');
				}
				if (in_array("1", $dealurgent)){
					array_push($pcklist, '1');
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}
			/*bedrooms search*/
			if (!empty($bedrooms)) {
				$bed_where = '';
				foreach ($bedrooms as $bedroomval) {
					if ($bedroomval == '1') {
						$bed_where .= '(prc.bed_rooms = 1)';
					}
					else if ($bedroomval == '2') {
						$bed_where .= 'OR (prc.bed_rooms = 2)';
					}
					else if ($bedroomval == '3') {
						$bed_where .= 'OR (prc.bed_rooms = 3)';
					}
					else if ($bedroomval == '4') {
						$bed_where .= 'OR (prc.bed_rooms > 4)';
					}
				}
				$this->db->where(ltrim($bed_where,"OR "));
			}
			/*bathroom search*/
			if (!empty($bathroom)) {
				$bath_where = '';
				foreach ($bathroom as $bathroomval) {
					if ($bathroomval == '1') {
						$bath_where .= '(prc.bath_rooms = 1)';
					}
					else if ($bathroomval == '2') {
						$bath_where .= 'OR (prc.bath_rooms = 2)';
					}
					else if ($bathroomval == '3') {
						$bath_where .= 'OR (prc.bath_rooms = 3)';
					}
					else if ($bathroomval == '4') {
						$bath_where .= 'OR (prc.bath_rooms > 4)';
					}
				}
				$this->db->where(ltrim($bath_where,"OR "));
			}
			/*area square*/
			if (!empty($area)) {
				$area_where = '';
				foreach ($area as $aval) {
					if ($aval == '<500') {
						$area_where .= '(prc.build_area < 500)';
					}
					else if ($aval == '500-1000') {
						$area_where .= 'OR (prc.build_area BETWEEN 500 AND 1000)';
					}
					else if ($aval == '1000-1500') {
						$area_where .= 'OR (prc.build_area BETWEEN 1000 AND 1500)';
					}
					else if ($aval == '1500-2000') {
						$area_where .= 'OR (prc.build_area BETWEEN 1500 AND 2000)';
					}
					else if ($aval == '>2000') {
						$area_where .= 'OR (prc.build_area > 2000)';
					}
				}
				$this->db->where(ltrim($area_where,"OR "));
			}
			


			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get();
			  // echo $this->db->last_query(); exit;
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }
        public function count_propertycomm_search(){
        	$search_commsub = $this->session->userdata('search_commsub');
			$comm_prop = $this->session->userdata('comm_prop');
        	$proptype = $this->session->userdata('proptype');
            $bedrooms = $this->session->userdata('bed_rooms');
            $bathroom = $this->session->userdata('bathroom');
            $area = $this->session->userdata('area_square');
        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->from("postad AS ad");
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->join('property_resid_commercial as prc', "ad.ad_id = prc.ad_id", 'join');
			$this->db->where("ad.category_id", "4");
			$this->db->where("ad.sub_cat_id", "26");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			if (!empty($proptype)) {
				$this->db->where_in('ad.sub_cat_id', $proptype);
			}
			if (!empty($seller)) {
				$this->db->where_in('prc.offered_type', $seller);
			}
			if ($search_commsub) {
				$this->db->where('prc.property_for', $search_commsub);
			}
			if (!empty($comm_prop)) {
				$this->db->where_in('prc.property_type', $comm_prop);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array("3", $dealurgent)){
					array_push($pcklist, '3');
				}
				if (in_array("2", $dealurgent)){
					array_push($pcklist, '2');
				}
				if (in_array("1", $dealurgent)){
					array_push($pcklist, '1');
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}
			/*bedrooms search*/
			if (!empty($bedrooms)) {
				$bed_where = '';
				foreach ($bedrooms as $bedroomval) {
					if ($bedroomval == '1') {
						$bed_where .= '(prc.bed_rooms = 1)';
					}
					else if ($bedroomval == '2') {
						$bed_where .= 'OR (prc.bed_rooms = 2)';
					}
					else if ($bedroomval == '3') {
						$bed_where .= 'OR (prc.bed_rooms = 3)';
					}
					else if ($bedroomval == '4') {
						$bed_where .= 'OR (prc.bed_rooms > 4)';
					}
				}
				$this->db->where(ltrim($bed_where,"OR "));
			}
			/*bathroom search*/
			if (!empty($bathroom)) {
				$bath_where = '';
				foreach ($bathroom as $bathroomval) {
					if ($bathroomval == '1') {
						$bath_where .= '(prc.bath_rooms = 1)';
					}
					else if ($bathroomval == '2') {
						$bath_where .= 'OR (prc.bath_rooms = 2)';
					}
					else if ($bathroomval == '3') {
						$bath_where .= 'OR (prc.bath_rooms = 3)';
					}
					else if ($bathroomval == '4') {
						$bath_where .= 'OR (prc.bath_rooms > 4)';
					}
				}
				$this->db->where(ltrim($bath_where,"OR "));
			}
			/*area square*/
			if (!empty($area)) {
				$area_where = '';
				foreach ($area as $aval) {
					if ($aval == '<500') {
						$area_where .= '(prc.build_area < 500)';
					}
					else if ($aval == '500-1000') {
						$area_where .= 'OR (prc.build_area BETWEEN 500 AND 1000)';
					}
					else if ($aval == '1000-1500') {
						$area_where .= 'OR (prc.build_area BETWEEN 1000 AND 1500)';
					}
					else if ($aval == '1500-2000') {
						$area_where .= 'OR (prc.build_area BETWEEN 1500 AND 2000)';
					}
					else if ($aval == '>2000') {
						$area_where .= 'OR (prc.build_area > 2000)';
					}
				}
				$this->db->where(ltrim($area_where,"OR "));
			}
			


			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get();
			  // echo $this->db->last_query(); exit;
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }

        /*business and consumer count in hotdeals*/
        public function busconcount_hotdeals(){
        	/*top category*/
			$free = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'1','manage_likes.is_top'=>1))->row('likes_count');
			$freeurgent = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'2','manage_likes.is_top'=>1))->row('likes_count');
			$gold = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'3','manage_likes.is_top'=>1))->row('likes_count');

			/*low category*/
			$low_free = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'4','manage_likes.is_top'=>0))->row('likes_count');
			$low_freeurgent = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'5','manage_likes.is_top'=>0))->row('likes_count');
			$low_gold = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'6','manage_likes.is_top'=>0))->row('likes_count');
        	$date = date("Y-m-d H:i:s");
        	$cat_id =  $this->session->userdata('cat_id');
        	if ($cat_id) {
	        	if ($cat_id != 'all') {
	        		if ($cat_id == 1 || $cat_id == 2 || $cat_id == 3 || $cat_id == 4) {
	        			$this->db->select("(SELECT COUNT(*) FROM postad WHERE
	        			(
					(package_type = '3' OR package_type = '6') OR 
					((package_type = '2' OR package_type = '5' )AND urgent_package != '0' )
					OR ((package_type = '1' OR package_type = '4' )AND urgent_package != '0' AND likes_count >= '$freeurgent')
					OR ((package_type = '1' OR package_type = '4' )AND urgent_package = '0' AND likes_count >= '$free')
					OR ((package_type = '2' OR package_type = '5' )AND urgent_package = '0' AND likes_count >= '$gold')   ) AND
	        		 category_id = '$cat_id' AND ad_status = 1 AND expire_data >='$date' AND (ad_type = 'business' || ad_type = 'consumer')) AS allbustype,
					(SELECT COUNT(*) FROM postad WHERE
						(
					(package_type = '3' OR package_type = '6') OR 
					((package_type = '2' OR package_type = '5' )AND urgent_package != '0' )
					OR ((package_type = '1' OR package_type = '4' )AND urgent_package != '0' AND likes_count >= '$freeurgent')
					OR ((package_type = '1' OR package_type = '4' )AND urgent_package = '0' AND likes_count >= '$free')
					OR ((package_type = '2' OR package_type = '5' )AND urgent_package = '0' AND likes_count >= '$gold')   ) AND
					 category_id = '$cat_id' AND ad_status = 1 AND expire_data >='$date' AND ad_type = 'business') AS business,
					(SELECT COUNT(*) FROM postad WHERE
						(
					(package_type = '3' OR package_type = '6') OR 
					((package_type = '2' OR package_type = '5' )AND urgent_package != '0' )
					OR ((package_type = '1' OR package_type = '4' )AND urgent_package != '0' AND likes_count >= '$freeurgent')
					OR ((package_type = '1' OR package_type = '4' )AND urgent_package = '0' AND likes_count >= '$free')
					OR ((package_type = '2' OR package_type = '5' )AND urgent_package = '0' AND likes_count >= '$gold')   ) AND
					 category_id = '$cat_id' AND ad_status = 1 AND expire_data >='$date' AND ad_type = 'consumer') AS consumer");
							$rs = $this->db->get();
		        			return $rs->result();
	        		}
	        		else{
	        		$this->db->select("(SELECT COUNT(*) FROM postad WHERE
	        			(
					(package_type = '3' OR package_type = '6') OR 
					((package_type = '2' OR package_type = '5' )AND urgent_package != '0' )
					OR ((package_type = '1' OR package_type = '4' )AND urgent_package != '0' AND likes_count >= '$low_freeurgent')
					OR ((package_type = '1' OR package_type = '4' )AND urgent_package = '0' AND likes_count >= '$low_free')
					OR ((package_type = '2' OR package_type = '5' )AND urgent_package = '0' AND likes_count >= '$low_gold')   ) AND
	        		 category_id = '$cat_id' AND ad_status = 1 AND expire_data >='$date' AND (ad_type = 'business' || ad_type = 'consumer')) AS allbustype,
					(SELECT COUNT(*) FROM postad WHERE
						(
					(package_type = '3' OR package_type = '6') OR 
					((package_type = '2' OR package_type = '5' )AND urgent_package != '0' )
					OR ((package_type = '1' OR package_type = '4' )AND urgent_package != '0' AND likes_count >= '$low_freeurgent')
					OR ((package_type = '1' OR package_type = '4' )AND urgent_package = '0' AND likes_count >= '$low_free')
					OR ((package_type = '2' OR package_type = '5' )AND urgent_package = '0' AND likes_count >= '$low_gold')   ) AND
					 category_id = '$cat_id' AND ad_status = 1 AND expire_data >='$date' AND ad_type = 'business') AS business,
					(SELECT COUNT(*) FROM postad WHERE
						(
					(package_type = '3' OR package_type = '6') OR 
					((package_type = '2' OR package_type = '5' )AND urgent_package != '0' )
					OR ((package_type = '1' OR package_type = '4' )AND urgent_package != '0' AND likes_count >= '$low_freeurgent')
					OR ((package_type = '1' OR package_type = '4' )AND urgent_package = '0' AND likes_count >= '$low_free')
					OR ((package_type = '2' OR package_type = '5' )AND urgent_package = '0' AND likes_count >= '$low_gold')   ) AND
					 category_id = '$cat_id' AND ad_status = 1 AND expire_data >='$date' AND ad_type = 'consumer') AS consumer");
							$rs = $this->db->get();
		        			return $rs->result();	
	        		}
	        	}
	        	else{
	        		$this->db->select("(SELECT COUNT(*) FROM postad WHERE
	        			(
					(package_type = '3' OR package_type = '6') OR 
					((package_type = '2' OR package_type = '5' )AND urgent_package != '0' )
					OR ((package_type = '1' OR package_type = '4' )AND urgent_package != '0' AND likes_count >= '75')
					OR ((package_type = '1' OR package_type = '4' )AND urgent_package = '0' AND likes_count >= '50')
					OR ((package_type = '2' OR package_type = '5' )AND urgent_package = '0' AND likes_count >= '25')   )  AND ad_status = 1 AND expire_data >='$date' AND (ad_type = 'business' || ad_type = 'consumer')) AS allbustype,
					(SELECT COUNT(*) FROM postad WHERE
						(
					(package_type = '3' OR package_type = '6') OR 
					((package_type = '2' OR package_type = '5' )AND urgent_package != '0' )
					OR ((package_type = '1' OR package_type = '4' )AND urgent_package != '0' AND likes_count >= '75')
					OR ((package_type = '1' OR package_type = '4' )AND urgent_package = '0' AND likes_count >= '50')
					OR ((package_type = '2' OR package_type = '5' )AND urgent_package = '0' AND likes_count >= '25')   ) AND
					  ad_status = 1 AND expire_data >='$date' AND ad_type = 'business') AS business,
					(SELECT COUNT(*) FROM postad WHERE
						(
					(package_type = '3' OR package_type = '6') OR 
					((package_type = '2' OR package_type = '5' )AND urgent_package != '0' )
					OR ((package_type = '1' OR package_type = '4' )AND urgent_package != '0' AND likes_count >= '75')
					OR ((package_type = '1' OR package_type = '4' )AND urgent_package = '0' AND likes_count >= '50')
					OR ((package_type = '2' OR package_type = '5' )AND urgent_package = '0' AND likes_count >= '25')   ) AND
					 ad_status = 1 AND expire_data >='$date' AND ad_type = 'consumer') AS consumer");
							$rs = $this->db->get();
		        			return $rs->result();
	        	}
        	  }
        	else{
        		$this->db->select("(SELECT COUNT(*) FROM postad WHERE
        			(
					(package_type = '3' OR package_type = '6') OR 
					((package_type = '2' OR package_type = '5' )AND urgent_package != '0' )
					OR ((package_type = '1' OR package_type = '4' )AND urgent_package != '0' AND likes_count >= '75')
					OR ((package_type = '1' OR package_type = '4' )AND urgent_package = '0' AND likes_count >= '50')
					OR ((package_type = '2' OR package_type = '5' )AND urgent_package = '0' AND likes_count >= '25')   ) AND
        		 ad_status = 1 AND (ad_type = 'business' || ad_type = 'consumer')) AS allbustype,
				(SELECT COUNT(*) FROM postad WHERE ad_status = 1 AND ad_type = 'business') AS business,
				(SELECT COUNT(*) FROM postad WHERE ad_status = 1 AND ad_type = 'consumer') AS consumer");
					$rs = $this->db->get();
	        		return $rs->result();
        	}
        	
        }

        public function busconcount_search(){
        	$date = date("Y-m-d H:i:s");
        	$looking_search =  $this->session->userdata('s_looking_search');
         	$cat_id =  $this->session->userdata('s_cat_id');
         	$s_location = $this->session->userdata('s_location');
        	if ($cat_id) {
	        	if ($cat_id != 'all') {
		        			$this->db->select('COUNT(*) as allbustype', false);
	        		$this->db->from('postad');
	        		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
					$this->db->where("category_id = '$cat_id' AND ad_status = 1 AND expire_data >='$date' AND (ad_type = 'business' || ad_type = 'consumer')");
					if ($looking_search) {
						if ($looking_search != '') {
							$this->db->where("(deal_tag LIKE '%$looking_search%' OR deal_tag LIKE '$looking_search%' OR deal_tag LIKE '%$looking_search' 
	  						OR deal_desc LIKE '%$looking_search%' OR deal_desc LIKE '$looking_search%' OR deal_desc LIKE '%$looking_search')");
						}
					}
					if ($s_location != '') {
						$this->db->where("(loc.loc_name LIKE '$s_location%' 
		  					OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')");
					}
					
					// echo $this->db->last_query(); exit;
					$allbustype = $this->db->get()->row('allbustype');

					$this->db->select('COUNT(*) as business', false);
	        		$this->db->from('postad');
	        		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
					$this->db->where("category_id = '$cat_id' AND ad_status = 1 AND expire_data >='$date' AND ad_type = 'business'");
					if ($looking_search) {
						if ($looking_search != '') {
							$this->db->where("(deal_tag LIKE '%$looking_search%' OR deal_tag LIKE '$looking_search%' OR deal_tag LIKE '%$looking_search' 
	  						OR deal_desc LIKE '%$looking_search%' OR deal_desc LIKE '$looking_search%' OR deal_desc LIKE '%$looking_search')");
						}
					}
					if ($s_location != '') {
						$this->db->where("(loc.loc_name LIKE '$s_location%' 
		  					OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')");
					}
					$business = $this->db->get()->row('business');

					$this->db->select('COUNT(*) as consumer', false);
	        		$this->db->from('postad');
	        		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
					$this->db->where("category_id = '$cat_id' AND ad_status = 1 AND expire_data >='$date' AND ad_type = 'consumer'");
					if ($looking_search) {
						if ($looking_search != '') {
							$this->db->where("(deal_tag LIKE '%$looking_search%' OR deal_tag LIKE '$looking_search%' OR deal_tag LIKE '%$looking_search' 
	  						OR deal_desc LIKE '%$looking_search%' OR deal_desc LIKE '$looking_search%' OR deal_desc LIKE '%$looking_search')");
						}
					}
					if ($s_location != '') {
						$this->db->where("(loc.loc_name LIKE '$s_location%' 
		  					OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')");
					}
					$consumer = $this->db->get()->row('consumer');

					$rs = array('allbustype'=>$allbustype,
								'business'=>$business,
								'consumer'=>$consumer);
	        		return $rs;
	        	}
	        	else{
	        		$this->db->select('COUNT(*) as allbustype', false);
	        		$this->db->from('postad');
	        		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
					$this->db->where("ad_status = 1 AND expire_data >='$date' AND (ad_type = 'business' || ad_type = 'consumer')");
					if ($looking_search) {
						if ($looking_search != '') {
							$this->db->where("(deal_tag LIKE '%$looking_search%' OR deal_tag LIKE '$looking_search%' OR deal_tag LIKE '%$looking_search' 
	  						OR deal_desc LIKE '%$looking_search%' OR deal_desc LIKE '$looking_search%' OR deal_desc LIKE '%$looking_search')");
						}
					}
					if ($s_location != '') {
						$this->db->where("(loc.loc_name LIKE '$s_location%' 
		  					OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')");
					}

					$allbustype = $this->db->get()->row('allbustype');

					$this->db->select('COUNT(*) as business', false);
	        		$this->db->from('postad');
	        		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
					$this->db->where("ad_status = 1 AND expire_data >='$date' AND ad_type = 'business'");
					if ($looking_search) {
						if ($looking_search != '') {
							$this->db->where("(deal_tag LIKE '%$looking_search%' OR deal_tag LIKE '$looking_search%' OR deal_tag LIKE '%$looking_search' 
	  						OR deal_desc LIKE '%$looking_search%' OR deal_desc LIKE '$looking_search%' OR deal_desc LIKE '%$looking_search')");
						}
					}
					if ($s_location != '') {
						$this->db->where("(loc.loc_name LIKE '$s_location%' 
		  					OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')");
					}
					$business = $this->db->get()->row('business');

					$this->db->select('COUNT(*) as consumer', false);
	        		$this->db->from('postad');
	        		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
					$this->db->where("ad_status = 1 AND expire_data >='$date' AND ad_type = 'consumer'");
					if ($looking_search) {
						if ($looking_search != '') {
							$this->db->where("(deal_tag LIKE '%$looking_search%' OR deal_tag LIKE '$looking_search%' OR deal_tag LIKE '%$looking_search' 
	  						OR deal_desc LIKE '%$looking_search%' OR deal_desc LIKE '$looking_search%' OR deal_desc LIKE '%$looking_search')");
						}
					}
					if ($s_location != '') {
						$this->db->where("(loc.loc_name LIKE '$s_location%' 
		  					OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')");
					}
					$consumer = $this->db->get()->row('consumer');

					$rs = array('allbustype'=>$allbustype,
								'business'=>$business,
								'consumer'=>$consumer);
	        		return $rs;
        		}
        	  }
        	  else{
        		$this->db->select("(SELECT COUNT(*) FROM postad WHERE
        		 ad_status = 1 AND (ad_type = 'business' || ad_type = 'consumer')) AS allbustype,
				(SELECT COUNT(*) FROM postad WHERE ad_status = 1 AND expire_data >='$date' AND ad_type = 'business') AS business,
				(SELECT COUNT(*) FROM postad WHERE ad_status = 1 AND expire_data >='$date' AND ad_type = 'consumer') AS consumer");
					$rs = $this->db->get();
	        		return $rs->result();
        		}
        	
        	
        }

        public function deals_pck_hotdeals(){
        	$cat_id =  $this->session->userdata('cat_id');
        	if ($cat_id != 'all') {
        		if ($cat_id == 1 || $cat_id == 2 || $cat_id == 3 || $cat_id == 4) {
        			$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '$cat_id' AND urgent_package != '0' AND postad.ad_status = 1) AS urgentcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '$cat_id' AND package_type = 3 AND urgent_package = '0' AND postad.ad_status = 1) AS platinumcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '$cat_id' AND package_type = 2 AND urgent_package = '0' AND postad.ad_status = 1) AS goldcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '$cat_id' AND package_type = 1 AND urgent_package = '0' AND postad.ad_status = 1) AS freecount");
        		}
        		else{
  					$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '$cat_id' AND urgent_package != '0' AND postad.ad_status = 1) AS urgentcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '$cat_id' AND package_type = 6 AND urgent_package = '0' AND postad.ad_status = 1) AS platinumcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '$cat_id' AND package_type = 5 AND urgent_package = '0' AND postad.ad_status = 1) AS goldcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '$cat_id' AND package_type = 4 AND urgent_package = '0' AND postad.ad_status = 1) AS freecount");      			
        		}
        	}
        	else{
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE urgent_package != '0' AND postad.ad_status = 1) AS urgentcount,
			(SELECT COUNT(*) FROM postad WHERE (package_type = 3 OR package_type = 6) AND urgent_package = '0' AND postad.ad_status = 1) AS platinumcount,
			(SELECT COUNT(*) FROM postad WHERE (package_type = 2 OR package_type = 5) AND urgent_package = '0' AND postad.ad_status = 1) AS goldcount,
			(SELECT COUNT(*) FROM postad WHERE (package_type = 1 OR package_type = 4) AND urgent_package = '0' AND postad.ad_status = 1) AS freecount");	
        	}
        	
        	$rs = $this->db->get();
        	return $rs->result();
        }
        /*business and consumer count in services*/
        public function busconcount_services(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '2' AND ad_status = 1 AND expire_data >='$data' AND(ad_type = 'business' || ad_type = 'consumer')) AS allbustype,
			(SELECT COUNT(*) FROM postad WHERE category_id = '2' AND ad_status = 1 AND expire_data >='$data' AND ad_type = 'business') AS business,
			(SELECT COUNT(*) FROM postad WHERE category_id = '2' AND ad_status = 1 AND expire_data >='$data' AND ad_type = 'consumer') AS consumer");
        	$rs = $this->db->get();
        	return $rs->result();
        }
         public function busconcount_serviceprof(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '2' AND sub_cat_id = 9 AND ad_status = 1 AND expire_data >='$data' AND(ad_type = 'business' || ad_type = 'consumer')) AS allbustype,
			(SELECT COUNT(*) FROM postad WHERE category_id = '2' AND sub_cat_id = 9 AND ad_status = 1 AND expire_data >='$data' AND ad_type = 'business') AS business,
			(SELECT COUNT(*) FROM postad WHERE category_id = '2' AND sub_cat_id = 9 AND ad_status = 1 AND expire_data >='$data' AND ad_type = 'consumer') AS consumer");
        	$rs = $this->db->get();
        	return $rs->result();
        }
         public function busconcount_servicepop(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '2' AND sub_cat_id = 10 AND ad_status = 1 AND expire_data >='$data' AND(ad_type = 'business' || ad_type = 'consumer')) AS allbustype,
			(SELECT COUNT(*) FROM postad WHERE category_id = '2' AND sub_cat_id = 10 AND ad_status = 1 AND expire_data >='$data' AND ad_type = 'business') AS business,
			(SELECT COUNT(*) FROM postad WHERE category_id = '2' AND sub_cat_id = 10 AND ad_status = 1 AND expire_data >='$data' AND ad_type = 'consumer') AS consumer");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        /*jobs count business or consumer*/
        public function busconcount_jobs(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '1' AND ad_status = 1 AND expire_data >='$data' AND(ad_type = 'business' || ad_type = 'consumer')) AS allbustype,
			(SELECT COUNT(*) FROM postad WHERE category_id = '1' AND ad_status = 1 AND expire_data >='$data' AND ad_type = 'business') AS business,
			(SELECT COUNT(*) FROM postad WHERE category_id = '1' AND ad_status = 1 AND expire_data >='$data' AND ad_type = 'consumer') AS consumer");
        	$rs = $this->db->get();
        	return $rs->result();
        }

        /*pets count business or consumer*/
        public function busconcount_pets(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '5' AND ad_status = 1 AND expire_data >='$data' AND(ad_type = 'business' || ad_type = 'consumer')) AS allbustype,
			(SELECT COUNT(*) FROM postad WHERE category_id = '5' AND ad_status = 1 AND expire_data >='$data' AND ad_type = 'business') AS business,
			(SELECT COUNT(*) FROM postad WHERE category_id = '5' AND ad_status = 1 AND expire_data >='$data' AND ad_type = 'consumer') AS consumer");
        	$rs = $this->db->get();
        	return $rs->result();
        }

        /*motorc count business or consumer*/
        public function busconcount_motors(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$data' AND ad_status = 1 AND expire_data >='$data' AND(ad_type = 'business' || ad_type = 'consumer')) AS allbustype,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$data' AND ad_status = 1 AND expire_data >='$data' AND ad_type = 'business') AS business,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$data' AND ad_status = 1 AND expire_data >='$data' AND ad_type = 'consumer') AS consumer");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function busconcount_ezone(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND ad_status = 1 AND expire_data >='$data' AND(ad_type = 'business' || ad_type = 'consumer')) AS allbustype,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND ad_status = 1 AND expire_data >='$data' AND ad_type = 'business') AS business,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND ad_status = 1 AND expire_data >='$data' AND ad_type = 'consumer') AS consumer");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function busconcount_phones(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = '59' AND(ad_type = 'business' || ad_type = 'consumer')) AS allbustype,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = '59' AND ad_type = 'business') AS business,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = '59' AND ad_type = 'consumer') AS consumer");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function busconcount_homes(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = '60' AND(ad_type = 'business' || ad_type = 'consumer')) AS allbustype,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = '60' AND ad_type = 'business') AS business,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = '60' AND ad_type = 'consumer') AS consumer");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function busconcount_smalls(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = '61' AND(ad_type = 'business' || ad_type = 'consumer')) AS allbustype,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = '61' AND ad_type = 'business') AS business,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = '61' AND ad_type = 'consumer') AS consumer");
        	$rs = $this->db->get();
        	return $rs->result();
        }
         public function busconcount_lappy(){
         	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = '62' AND(ad_type = 'business' || ad_type = 'consumer')) AS allbustype,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = '62' AND ad_type = 'business') AS business,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = '62' AND ad_type = 'consumer') AS consumer");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function busconcount_access(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = '63' AND(ad_type = 'business' || ad_type = 'consumer')) AS allbustype,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = '63' AND ad_type = 'business') AS business,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = '63' AND ad_type = 'consumer') AS consumer");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function busconcount_pcare(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = '64' AND(ad_type = 'business' || ad_type = 'consumer')) AS allbustype,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = '64' AND ad_type = 'business') AS business,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = '64' AND ad_type = 'consumer') AS consumer");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function busconcount_entertain(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = '65' AND(ad_type = 'business' || ad_type = 'consumer')) AS allbustype,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = '65' AND ad_type = 'business') AS business,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = '65' AND ad_type = 'consumer') AS consumer");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function busconcount_poto(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = '66' AND(ad_type = 'business' || ad_type = 'consumer')) AS allbustype,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = '66' AND ad_type = 'business') AS business,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = '66' AND ad_type = 'consumer') AS consumer");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function busconcount_cars(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = '12' AND(ad_type = 'business' || ad_type = 'consumer')) AS allbustype,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = '12' AND ad_type = 'business') AS business,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = '12' AND ad_type = 'consumer') AS consumer");
        	$rs = $this->db->get();
        	return $rs->result();
        }
         public function busconcount_plants(){
         	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = '17' AND(ad_type = 'business' || ad_type = 'consumer')) AS allbustype,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = '17' AND ad_type = 'business') AS business,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = '17' AND ad_type = 'consumer') AS consumer");
        	$rs = $this->db->get();
        	return $rs->result();
        }
         public function busconcount_farming(){
         	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = '18' AND(ad_type = 'business' || ad_type = 'consumer')) AS allbustype,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = '18' AND ad_type = 'business') AS business,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = '18' AND ad_type = 'consumer') AS consumer");
        	$rs = $this->db->get();
        	return $rs->result();
        }
         public function busconcount_boats(){
         	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = '19' AND(ad_type = 'business' || ad_type = 'consumer')) AS allbustype,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = '19' AND ad_type = 'business') AS business,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = '19' AND ad_type = 'consumer') AS consumer");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function busconcount_caravans(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND sub_cat_id = '14' AND(ad_type = 'business' || ad_type = 'consumer')) AS allbustype,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND sub_cat_id = '14' AND ad_type = 'business') AS business,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND sub_cat_id = '14' AND ad_type = 'consumer') AS consumer");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function busconcount_coaches(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = '16' AND(ad_type = 'business' || ad_type = 'consumer')) AS allbustype,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = '16' AND ad_type = 'business') AS business,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = '16' AND ad_type = 'consumer') AS consumer");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function busconcount_vans(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND sub_cat_id = '15' AND(ad_type = 'business' || ad_type = 'consumer')) AS allbustype,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND sub_cat_id = '15' AND ad_type = 'business') AS business,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND sub_cat_id = '15' AND ad_type = 'consumer') AS consumer");
        	$rs = $this->db->get();
        	return $rs->result();
        }
         public function busconcount_bikes(){
         	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = '13' AND(ad_type = 'business' || ad_type = 'consumer')) AS allbustype,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = '13' AND ad_type = 'business') AS business,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = '13' AND ad_type = 'consumer') AS consumer");
        	$rs = $this->db->get();
        	return $rs->result();
        }

        /*kitchenhome count business or consumer*/
        public function busconcount_kitchen(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '7' AND ad_status = 1 AND expire_data >='$data' AND(ad_type = 'business' || ad_type = 'consumer')) AS allbustype,
			(SELECT COUNT(*) FROM postad WHERE category_id = '7' AND ad_status = 1 AND expire_data >='$data' AND ad_type = 'business') AS business,
			(SELECT COUNT(*) FROM postad WHERE category_id = '7' AND ad_status = 1 AND expire_data >='$data' AND ad_type = 'consumer') AS consumer");
        	$rs = $this->db->get();
        	return $rs->result();
        }

         /*findproperty count business or consumer*/
        public function busconcount_property(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '4' AND ad_status = 1 AND expire_data >='$data' AND(ad_type = 'business' || ad_type = 'consumer')) AS allbustype,
			(SELECT COUNT(*) FROM postad WHERE category_id = '4' AND ad_status = 1 AND expire_data >='$data' AND ad_type = 'business') AS business,
			(SELECT COUNT(*) FROM postad WHERE category_id = '4' AND ad_status = 1 AND expire_data >='$data' AND ad_type = 'consumer') AS consumer");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function busconcount_propertyresi(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '4' AND sub_cat_id = 11 AND ad_status = 1 AND expire_data >='$data' AND(ad_type = 'business' || ad_type = 'consumer')) AS allbustype,
			(SELECT COUNT(*) FROM postad WHERE category_id = '4' AND sub_cat_id = 11 AND ad_status = 1 AND expire_data >='$data' AND ad_type = 'business') AS business,
			(SELECT COUNT(*) FROM postad WHERE category_id = '4' AND sub_cat_id = 11 AND ad_status = 1 AND expire_data >='$data' AND ad_type = 'consumer') AS consumer");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function busconcount_propertycomm(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '4' AND sub_cat_id = 26 AND ad_status = 1 AND expire_data >='$data' AND(ad_type = 'business' || ad_type = 'consumer')) AS allbustype,
			(SELECT COUNT(*) FROM postad WHERE category_id = '4' AND sub_cat_id = 26 AND ad_status = 1 AND expire_data >='$data' AND ad_type = 'business') AS business,
			(SELECT COUNT(*) FROM postad WHERE category_id = '4' AND sub_cat_id = 26 AND ad_status = 1 AND expire_data >='$data' AND ad_type = 'consumer') AS consumer");
        	$rs = $this->db->get();
        	return $rs->result();
        }

        /*cloths and lifestyles count business or consumer*/
        public function busconcount_clothstyle(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '6' AND ad_status = 1 AND expire_data >='$data' AND ad_status =1 AND(ad_type = 'business' || ad_type = 'consumer')) AS allbustype,
			(SELECT COUNT(*) FROM postad WHERE category_id = '6' AND ad_status = 1 AND expire_data >='$data' AND ad_status =1 AND ad_type = 'business') AS business,
			(SELECT COUNT(*) FROM postad WHERE category_id = '6' AND ad_status = 1 AND expire_data >='$data' AND ad_status =1 AND ad_type = 'consumer') AS consumer");
        	$rs = $this->db->get();
        	return $rs->result();
        }

        public function busconcount_womenview(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '6' AND sub_cat_id = 20 AND(ad_type = 'business' || ad_type = 'consumer')) AS allbustype,
		(SELECT COUNT(*) FROM postad WHERE category_id = '6' AND sub_cat_id = 20 AND ad_type = 'business') AS business,
		(SELECT COUNT(*) FROM postad WHERE category_id = '6' AND sub_cat_id = 20 AND ad_type = 'consumer') AS consumer");
        	$rs = $this->db->get();
        	return $rs->result();
        }

        public function busconcount_menview(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '6' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = 21 AND(ad_type = 'business' || ad_type = 'consumer')) AS allbustype,
		(SELECT COUNT(*) FROM postad WHERE category_id = '6' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = 21 AND ad_type = 'business') AS business,
		(SELECT COUNT(*) FROM postad WHERE category_id = '6' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = 21 AND ad_type = 'consumer') AS consumer");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function busconcount_boysview(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '6' AND sub_cat_id = 22 AND(ad_type = 'business' || ad_type = 'consumer')) AS allbustype,
		(SELECT COUNT(*) FROM postad WHERE category_id = '6' AND sub_cat_id = 22 AND ad_type = 'business') AS business,
		(SELECT COUNT(*) FROM postad WHERE category_id = '6' AND sub_cat_id = 22 AND ad_type = 'consumer') AS consumer");
        	$rs = $this->db->get();
        	return $rs->result();
        }
         public function busconcount_girlsview(){
         	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '6' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = 23 AND(ad_type = 'business' || ad_type = 'consumer')) AS allbustype,
		(SELECT COUNT(*) FROM postad WHERE category_id = '6' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = 23 AND ad_type = 'business') AS business,
		(SELECT COUNT(*) FROM postad WHERE category_id = '6' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = 23 AND ad_type = 'consumer') AS consumer");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function busconcount_babyboyview(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '6' AND sub_cat_id = 24 AND(ad_type = 'business' || ad_type = 'consumer')) AS allbustype,
		(SELECT COUNT(*) FROM postad WHERE category_id = '6' AND sub_cat_id = 24 AND ad_type = 'business') AS business,
		(SELECT COUNT(*) FROM postad WHERE category_id = '6' AND sub_cat_id = 24 AND ad_type = 'consumer') AS consumer");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function busconcount_babygirlview(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '6' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = 25 AND(ad_type = 'business' || ad_type = 'consumer')) AS allbustype,
		(SELECT COUNT(*) FROM postad WHERE category_id = '6' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = 25 AND ad_type = 'business') AS business,
		(SELECT COUNT(*) FROM postad WHERE category_id = '6' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = 25 AND ad_type = 'consumer') AS consumer");
        	$rs = $this->db->get();
        	return $rs->result();
        }

        public function sellercount_hotdeals(){
			$cat_id =  $this->session->userdata('cat_id');
				if ($cat_id == '5') {
					/*pets*/
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '5' AND services = 'Seller') AS Seller,
			(SELECT COUNT(*) FROM postad WHERE category_id = '5' AND services = 'Needed') AS Needed");
        	$rs = $this->db->get();
        	return $rs->result_array();
				}
				elseif ($cat_id == '3') {
					/*motors*/
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND services = 'Seller') AS Seller,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND services = 'Needed') AS Needed,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND services = 'ForHire') AS Forhire");
        	$rs = $this->db->get();
        	return $rs->result_array();
				}
				elseif ($cat_id == '8') {
					/*ezone*/
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND services = 'Seller') AS Seller,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND services = 'Needed') AS Needed");
        	$rs = $this->db->get();
        	return $rs->result_array();
				}
				elseif ($cat_id == '2') {
					/*services*/
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '2' AND services = 'service_provider') AS Serviceprovided,
			(SELECT COUNT(*) FROM postad WHERE category_id = '2' AND services = 'service_needed') AS Serviceneeded");
        	$rs = $this->db->get();
        	return $rs->result_array();
				}
				elseif ($cat_id == '1') {
					/*jobs*/
        	$this->db->select("(SELECT COUNT(*) FROM job_details, postad WHERE job_details.ad_id = postad.ad_id AND job_details.jobtype_title = 'Company') AS Company,
			(SELECT COUNT(*) FROM job_details, postad WHERE job_details.ad_id = postad.ad_id AND job_details.jobtype_title = 'Agency') AS Agency,
			(SELECT COUNT(*) FROM job_details, postad WHERE job_details.ad_id = postad.ad_id AND job_details.jobtype_title = 'Other') AS Other");
        	$rs = $this->db->get();
        	return $rs->result_array();
				}
				elseif ($cat_id == '7') {
					/*home and kitchen*/
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '7' AND services = 'Seller') AS Seller,
			(SELECT COUNT(*) FROM postad WHERE category_id = '7' AND services = 'Needed') AS Needed,
			(SELECT COUNT(*) FROM postad WHERE category_id = '7' AND services = 'Charity') AS Charity");
        	$rs = $this->db->get();
        	return $rs->result_array();
				}
				elseif ($cat_id == '4') {
					/*property*/
        	$this->db->select("(SELECT COUNT(*) FROM postad AS ad, property_resid_commercial AS prc WHERE ad.ad_id = prc.ad_id AND
			ad.category_id = '4' AND prc.offered_type = 'Offered') AS Offered,
			(SELECT COUNT(*) FROM postad AS ad, property_resid_commercial AS prc WHERE ad.ad_id = prc.ad_id AND
			ad.category_id = '4' AND prc.offered_type = 'Wanted') AS Wanted");
        	$rs = $this->db->get();
        	return $rs->result_array();
				}
				elseif ($cat_id == '6') {
					/*cloths*/
        	$this->db->select("(SELECT COUNT(*) FROM postad AS ad WHERE ad.services = 'Seller' AND ad.category_id = '6') AS Seller,
			(SELECT COUNT(*) FROM postad AS ad WHERE ad.services = 'Needed' AND ad.category_id = '6') AS Needed,
			(SELECT COUNT(*) FROM postad AS ad WHERE ad.services = 'Charity' AND ad.category_id = '6') AS Charity");
        	$rs = $this->db->get();
        	return $rs->result_array();
				}
        }

        /*pets seller and needed count*/
        public function sellerneeded_pets(){
        	$date = date("Y-m-d H:i:s");
        	$looking_search = $this->session->userdata('s_looking_search'); 
        	$s_location = $this->session->userdata('s_location');
        	$search_bustype = $this->session->userdata('s_search_bustype');
        	$this->db->select('COUNT(*) as seller', false);
    		$this->db->from('postad');
    		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
			$this->db->where("category_id = '5' AND services = 'Seller' AND ad_status = 1 AND expire_data >='$date'");
			if ($looking_search) {
				if ($looking_search != '') {
					$this->db->where("(postad.deal_tag LIKE '%$looking_search%' OR postad.deal_tag LIKE '$looking_search%' OR deal_tag LIKE '%$looking_search' 
						OR deal_desc LIKE '%$looking_search%' OR deal_desc LIKE '$looking_search%' OR deal_desc LIKE '%$looking_search')");
				}
			}
			if ($s_location != '') {
				$this->db->where("(loc.loc_name LIKE '$s_location%' 
  					OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')");
			}
			if ($search_bustype != 'all') {
				$this->db->where("postad.ad_type",$search_bustype);
			}
			$seller = $this->db->get()->row('seller');

			$this->db->select('COUNT(*) as needed', false);
    		$this->db->from('postad');
    		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
			$this->db->where("category_id = '5' AND services = 'Needed' AND ad_status = 1 AND expire_data >='$date'");
			if ($looking_search) {
				if ($looking_search != '') {
					$this->db->where("(postad.deal_tag LIKE '%$looking_search%' OR postad.deal_tag LIKE '$looking_search%' OR deal_tag LIKE '%$looking_search' 
						OR deal_desc LIKE '%$looking_search%' OR deal_desc LIKE '$looking_search%' OR deal_desc LIKE '%$looking_search')");
				}
			}
			if ($s_location != '') {
				$this->db->where("(loc.loc_name LIKE '$s_location%' 
  					OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')");
			}
			$needed = $this->db->get()->row('needed');
			$rs = array("seller"=>$seller,
						"needed"=>$needed);
        	return $rs;
        }

        /*motors seller and needed count*/
        public function sellerneeded_motors(){
        	$date = date("Y-m-d H:i:s");
        	$looking_search = $this->session->userdata('s_looking_search'); 
        	$s_location = $this->session->userdata('s_location');
        	$search_bustype = $this->session->userdata('s_search_bustype');

        	$this->db->select('COUNT(*) as seller', false);
    		$this->db->from('postad');
    		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
			$this->db->where("category_id = '3' AND services = 'Seller' AND ad_status = 1 AND expire_data >='$date'");
			if ($looking_search) {
				if ($looking_search != '') {
					$this->db->where("(postad.deal_tag LIKE '%$looking_search%' OR postad.deal_tag LIKE '$looking_search%' OR deal_tag LIKE '%$looking_search' 
						OR deal_desc LIKE '%$looking_search%' OR deal_desc LIKE '$looking_search%' OR deal_desc LIKE '%$looking_search')");
				}
			}
			if ($s_location != '') {
				$this->db->where("(loc.loc_name LIKE '$s_location%' 
  					OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')");
			}
			if ($search_bustype != 'all') {
				$this->db->where("postad.ad_type",$search_bustype);
			}
			$seller = $this->db->get()->row('seller');

			$this->db->select('COUNT(*) as needed', false);
    		$this->db->from('postad');
    		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
			$this->db->where("category_id = '3' AND services = 'Needed' AND ad_status = 1 AND expire_data >='$date'");
			if ($looking_search) {
				if ($looking_search != '') {
					$this->db->where("(postad.deal_tag LIKE '%$looking_search%' OR postad.deal_tag LIKE '$looking_search%' OR deal_tag LIKE '%$looking_search' 
						OR deal_desc LIKE '%$looking_search%' OR deal_desc LIKE '$looking_search%' OR deal_desc LIKE '%$looking_search')");
				}
			}
			if ($s_location != '') {
				$this->db->where("(loc.loc_name LIKE '$s_location%' 
  					OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')");
			}
			$needed = $this->db->get()->row('needed');

			$this->db->select('COUNT(*) as ForHire', false);
    		$this->db->from('postad');
    		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
			$this->db->where("category_id = '3' AND services = 'ForHire' AND ad_status = 1 AND expire_data >='$date'");
			if ($looking_search) {
				if ($looking_search != '') {
					$this->db->where("(postad.deal_tag LIKE '%$looking_search%' OR postad.deal_tag LIKE '$looking_search%' OR deal_tag LIKE '%$looking_search' 
						OR deal_desc LIKE '%$looking_search%' OR deal_desc LIKE '$looking_search%' OR deal_desc LIKE '%$looking_search')");
				}
			}
			if ($s_location != '') {
				$this->db->where("(loc.loc_name LIKE '$s_location%' 
  					OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')");
			}
			$ForHire = $this->db->get()->row('ForHire');

			$rs = array("seller"=>$seller,
						"needed"=>$needed,
						"forhire"=>$ForHire);
        	return $rs;
        }
        public function sellerneeded_ezone(){
        	$date = date("Y-m-d H:i:s");
        	$looking_search = $this->session->userdata('s_looking_search'); 
        	$s_location = $this->session->userdata('s_location');
        	$search_bustype = $this->session->userdata('s_search_bustype');
        	$this->db->select('COUNT(*) as seller', false);
    		$this->db->from('postad');
    		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
			$this->db->where("category_id = '8' AND services = 'Seller' AND ad_status = 1 AND expire_data >='$date'");
			if ($looking_search) {
				if ($looking_search != '') {
					$this->db->where("(postad.deal_tag LIKE '%$looking_search%' OR postad.deal_tag LIKE '$looking_search%' OR deal_tag LIKE '%$looking_search' 
						OR deal_desc LIKE '%$looking_search%' OR deal_desc LIKE '$looking_search%' OR deal_desc LIKE '%$looking_search')");
				}
			}
			if ($s_location != '') {
				$this->db->where("(loc.loc_name LIKE '$s_location%' 
  					OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')");
			}
			if ($search_bustype != 'all') {
				$this->db->where("postad.ad_type",$search_bustype);
			}
			$seller = $this->db->get()->row('seller');

			$this->db->select('COUNT(*) as needed', false);
    		$this->db->from('postad');
    		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
			$this->db->where("category_id = '8' AND services = 'Needed' AND ad_status = 1 AND expire_data >='$date'");
			if ($looking_search) {
				if ($looking_search != '') {
					$this->db->where("(postad.deal_tag LIKE '%$looking_search%' OR postad.deal_tag LIKE '$looking_search%' OR deal_tag LIKE '%$looking_search' 
						OR deal_desc LIKE '%$looking_search%' OR deal_desc LIKE '$looking_search%' OR deal_desc LIKE '%$looking_search')");
				}
			}
			if ($s_location != '') {
				$this->db->where("(loc.loc_name LIKE '$s_location%' 
  					OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')");
			}
			$needed = $this->db->get()->row('needed');
        	/*$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND services = 'Seller' AND ad_status = 1 AND expire_data >='$date') AS seller,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND services = 'Needed' AND ad_status = 1 AND expire_data >='$date') AS needed");*/
        	$rs = array("seller"=>$seller,
        				"needed"=>$needed);
        	return $rs;
        }
        public function sellerneeded_phone(){
        	$date = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND sub_cat_id='59' AND services = 'Seller' AND ad_status = 1 AND expire_data >='$date') AS seller,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND sub_cat_id='59' AND services = 'Needed' AND ad_status = 1 AND expire_data >='$date') AS needed,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND sub_cat_id='59' AND services = 'ForHire' AND ad_status = 1 AND expire_data >='$date') AS forhire");
        	$rs = $this->db->get();
        	return $rs->result();
        }
         public function sellerneeded_homes(){
         	$date = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND sub_cat_id='60' AND services = 'Seller' AND ad_status = 1 AND expire_data >='$date') AS seller,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND sub_cat_id='60' AND services = 'Needed' AND ad_status = 1 AND expire_data >='$date') AS needed,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND sub_cat_id='60' AND services = 'ForHire' AND ad_status = 1 AND expire_data >='$date') AS forhire");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function sellerneeded_smalls(){
        	$date = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND sub_cat_id='61' AND services = 'Seller' AND ad_status = 1 AND expire_data >='$date') AS seller,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND sub_cat_id='61' AND services = 'Needed' AND ad_status = 1 AND expire_data >='$date') AS needed,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND sub_cat_id='61' AND services = 'ForHire' AND ad_status = 1 AND expire_data >='$date') AS forhire");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function sellerneeded_lappy(){
        	$date = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND sub_cat_id='62' AND services = 'Seller' AND ad_status = 1 AND expire_data >='$date') AS seller,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND sub_cat_id='62' AND services = 'Needed' AND ad_status = 1 AND expire_data >='$date') AS needed,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND sub_cat_id='62' AND services = 'ForHire' AND ad_status = 1 AND expire_data >='$date') AS forhire");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function sellerneeded_access(){
        	$date = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND sub_cat_id='63' AND services = 'Seller' AND ad_status = 1 AND expire_data >='$date') AS seller,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND sub_cat_id='63' AND services = 'Needed' AND ad_status = 1 AND expire_data >='$date') AS needed,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND sub_cat_id='63' AND services = 'ForHire' AND ad_status = 1 AND expire_data >='$date') AS forhire");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function sellerneeded_pcare(){
        	$date = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND sub_cat_id='64' AND services = 'Seller' AND ad_status = 1 AND expire_data >='$date') AS seller,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND sub_cat_id='64' AND services = 'Needed' AND ad_status = 1 AND expire_data >='$date') AS needed,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND sub_cat_id='64' AND services = 'ForHire' AND ad_status = 1 AND expire_data >='$date') AS forhire");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function sellerneeded_entertain(){
        	$date = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND sub_cat_id='65' AND services = 'Seller' AND ad_status = 1 AND expire_data >='$date') AS seller,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND sub_cat_id='65' AND services = 'Needed' AND ad_status = 1 AND expire_data >='$date') AS needed,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND sub_cat_id='65' AND services = 'ForHire' AND ad_status = 1 AND expire_data >='$date') AS forhire");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function sellerneeded_poto(){
        	$date = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND sub_cat_id='66' AND services = 'Seller' AND ad_status = 1 AND expire_data >='$date') AS seller,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND sub_cat_id='66' AND services = 'Needed' AND ad_status = 1 AND expire_data >='$date') AS needed,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND sub_cat_id='66' AND services = 'ForHire' AND ad_status = 1 AND expire_data >='$date') AS forhire");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function sellerneeded_cars(){
        	$date = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$date' AND sub_cat_id='12' AND services = 'Seller') AS seller,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$date' AND sub_cat_id='12' AND services = 'Needed') AS needed,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$date' AND sub_cat_id='12' AND services = 'ForHire') AS forhire");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function sellerneeded_plants(){
        	$date = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$date' AND sub_cat_id='17' AND services = 'Seller') AS seller,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$date' AND sub_cat_id='17' AND services = 'Needed') AS needed,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$date' AND sub_cat_id='17' AND services = 'ForHire') AS forhire");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function sellerneeded_farming(){
        	$date = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$date' AND sub_cat_id='18' AND services = 'Seller') AS seller,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$date' AND sub_cat_id='18' AND services = 'Needed') AS needed,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$date' AND sub_cat_id='18' AND services = 'ForHire') AS forhire");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function sellerneeded_boats(){
        	$date = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$date' AND sub_cat_id='19' AND services = 'Seller') AS seller,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$date' AND sub_cat_id='19' AND services = 'Needed') AS needed,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$date' AND sub_cat_id='19' AND services = 'ForHire') AS forhire");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function sellerneeded_caravans(){
        	$date = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$date' AND sub_cat_id='14' AND services = 'Seller') AS seller,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$date' AND sub_cat_id='14' AND services = 'Needed') AS needed,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$date' AND sub_cat_id='14' AND services = 'ForHire') AS forhire");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function sellerneeded_coaches(){
        	$date = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$date' AND sub_cat_id='16' AND services = 'Seller') AS seller,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$date' AND sub_cat_id='16' AND services = 'Needed') AS needed,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$date' AND sub_cat_id='16' AND services = 'ForHire') AS forhire");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function sellerneeded_vans(){
        	$date = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$date' AND sub_cat_id='15' AND services = 'Seller') AS seller,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$date' AND sub_cat_id='15' AND services = 'Needed') AS needed,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$date' AND sub_cat_id='15' AND services = 'ForHire') AS forhire");
        	$rs = $this->db->get();
        	return $rs->result();
        }
         public function sellerneeded_bikes(){
         	$date = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$date' AND sub_cat_id='13' AND services = 'Seller') AS seller,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$date' AND sub_cat_id='13' AND services = 'Needed') AS needed,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$date' AND sub_cat_id='13' AND services = 'ForHire') AS forhire");
        	$rs = $this->db->get();
        	return $rs->result();
        }

        /*services seller and needed count*/
        public function sellerneeded_services(){
        	$date = date("Y-m-d H:i:s");
        	$looking_search = $this->session->userdata('s_looking_search'); 
        	$s_location = $this->session->userdata('s_location');
        	$search_bustype = $this->session->userdata('s_search_bustype');

        	$this->db->select('COUNT(*) as provider', false);
    		$this->db->from('postad');
    		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
			$this->db->where("category_id = '2' AND services = 'service_provider' AND ad_status = 1 AND expire_data >='$date'");
			if ($looking_search) {
				if ($looking_search != '') {
					$this->db->where("(postad.deal_tag LIKE '%$looking_search%' OR postad.deal_tag LIKE '$looking_search%' OR deal_tag LIKE '%$looking_search' 
						OR deal_desc LIKE '%$looking_search%' OR deal_desc LIKE '$looking_search%' OR deal_desc LIKE '%$looking_search')");
				}
			}
			if ($s_location != '') {
				$this->db->where("(loc.loc_name LIKE '$s_location%' 
  					OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')");
			}
			if ($search_bustype != 'all') {
				$this->db->where("postad.ad_type",$search_bustype);
			}
			$provider = $this->db->get()->row('provider');

			$this->db->select('COUNT(*) as needed', false);
    		$this->db->from('postad');
    		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
			$this->db->where("category_id = '2' AND services = 'service_needed' AND ad_status = 1 AND expire_data >='$date'");
			if ($looking_search) {
				if ($looking_search != '') {
					$this->db->where("(postad.deal_tag LIKE '%$looking_search%' OR postad.deal_tag LIKE '$looking_search%' OR deal_tag LIKE '%$looking_search' 
						OR deal_desc LIKE '%$looking_search%' OR deal_desc LIKE '$looking_search%' OR deal_desc LIKE '%$looking_search')");
				}
			}
			if ($s_location != '') {
				$this->db->where("(loc.loc_name LIKE '$s_location%' 
  					OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')");
			}
			$needed = $this->db->get()->row('needed');
			$rs = array("provider"=>$provider,
						"needed"=>$needed);
        	return $rs;
        }

        public function sellerneeded_jobs(){
        	$date = date("Y-m-d H:i:s");
        	$looking_search = $this->session->userdata('s_looking_search'); 
        	$s_location = $this->session->userdata('s_location');
        	$search_bustype = $this->session->userdata('s_search_bustype');

        	$this->db->select('COUNT(*) as company', false);
    		$this->db->from('job_details, postad');
    		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
			$this->db->where("job_details.ad_id = postad.ad_id AND job_details.jobtype_title = 'Company' AND postad.ad_status = 1 AND postad.expire_data >='$date'");
			if ($looking_search) {
				if ($looking_search != '') {
					$this->db->where("(postad.deal_tag LIKE '%$looking_search%' OR postad.deal_tag LIKE '$looking_search%' OR deal_tag LIKE '%$looking_search' 
						OR deal_desc LIKE '%$looking_search%' OR deal_desc LIKE '$looking_search%' OR deal_desc LIKE '%$looking_search')");
				}
			}
			if ($s_location != '') {
				$this->db->where("(loc.loc_name LIKE '$s_location%' 
  					OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')");
			}
			if ($search_bustype != 'all') {
				$this->db->where("postad.ad_type",$search_bustype);
			}
			$company = $this->db->get()->row('company');

			$this->db->select('COUNT(*) as Agency', false);
    		$this->db->from('job_details, postad');
    		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
			$this->db->where("job_details.ad_id = postad.ad_id AND job_details.jobtype_title = 'Agency' AND postad.ad_status = 1 AND postad.expire_data >='$date'");
			if ($looking_search) {
				if ($looking_search != '') {
					$this->db->where("(postad.deal_tag LIKE '%$looking_search%' OR postad.deal_tag LIKE '$looking_search%' OR deal_tag LIKE '%$looking_search' 
						OR deal_desc LIKE '%$looking_search%' OR deal_desc LIKE '$looking_search%' OR deal_desc LIKE '%$looking_search')");
				}
			}
			if ($s_location != '') {
				$this->db->where("(loc.loc_name LIKE '$s_location%' 
  					OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')");
			}
			$Agency = $this->db->get()->row('Agency');

			$this->db->select('COUNT(*) as Other', false);
    		$this->db->from('job_details, postad');
    		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
			$this->db->where("job_details.ad_id = postad.ad_id AND job_details.jobtype_title = 'Other' AND postad.ad_status = 1 AND postad.expire_data >='$date'");
			if ($looking_search) {
				if ($looking_search != '') {
					$this->db->where("(postad.deal_tag LIKE '%$looking_search%' OR postad.deal_tag LIKE '$looking_search%' OR deal_tag LIKE '%$looking_search' 
						OR deal_desc LIKE '%$looking_search%' OR deal_desc LIKE '$looking_search%' OR deal_desc LIKE '%$looking_search')");
				}
			}
			if ($s_location != '') {
				$this->db->where("(loc.loc_name LIKE '$s_location%' 
  					OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')");
			}
			$Other = $this->db->get()->row('Other');

			$rs = array('company'=>$company,
						'Agency'=>$Agency,
						'Other'=>$Other);

			return $rs;
        }

        /*kitchen seller and needed count*/
        public function sellerneeded_kitchen(){
        	$date = date("Y-m-d H:i:s");
        	$looking_search = $this->session->userdata('s_looking_search'); 
        	$s_location = $this->session->userdata('s_location');
        	$search_bustype = $this->session->userdata('s_search_bustype');

        	$this->db->select('COUNT(*) as seller', false);
    		$this->db->from('postad');
    		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
			$this->db->where("category_id = '7' AND services = 'Seller' AND ad_status = 1 AND expire_data >='$date'");
			if ($looking_search) {
				if ($looking_search != '') {
					$this->db->where("(deal_tag LIKE '%$looking_search%' OR deal_tag LIKE '$looking_search%' OR deal_tag LIKE '%$looking_search' 
						OR deal_desc LIKE '%$looking_search%' OR deal_desc LIKE '$looking_search%' OR deal_desc LIKE '%$looking_search')");
				}
			}
			if ($s_location != '') {
				$this->db->where("(loc.loc_name LIKE '$s_location%' 
  					OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')");
			}
			if ($search_bustype != 'all') {
				$this->db->where("postad.ad_type",$search_bustype);
			}
			$seller = $this->db->get()->row('seller');

			$this->db->select('COUNT(*) as needed', false);
    		$this->db->from('postad');
    		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
			$this->db->where("category_id = '7' AND services = 'Needed' AND ad_status = 1 AND expire_data >='$date'");
			if ($looking_search) {
				if ($looking_search != '') {
					$this->db->where("(deal_tag LIKE '%$looking_search%' OR deal_tag LIKE '$looking_search%' OR deal_tag LIKE '%$looking_search' 
						OR deal_desc LIKE '%$looking_search%' OR deal_desc LIKE '$looking_search%' OR deal_desc LIKE '%$looking_search')");
				}
			}
			if ($s_location != '') {
				$this->db->where("(loc.loc_name LIKE '$s_location%' 
  					OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')");
			}
			$needed = $this->db->get()->row('needed');

			$this->db->select('COUNT(*) as charity', false);
    		$this->db->from('postad');
    		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
			$this->db->where("category_id = '7' AND services = 'Charity' AND ad_status = 1 AND expire_data >='$date'");
			if ($looking_search) {
				if ($looking_search != '') {
					$this->db->where("(deal_tag LIKE '%$looking_search%' OR deal_tag LIKE '$looking_search%' OR deal_tag LIKE '%$looking_search' 
						OR deal_desc LIKE '%$looking_search%' OR deal_desc LIKE '$looking_search%' OR deal_desc LIKE '%$looking_search')");
				}
			}
			if ($s_location != '') {
				$this->db->where("(loc.loc_name LIKE '$s_location%' 
  					OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')");
			}
			$charity = $this->db->get()->row('charity');

        	/*$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '7' AND services = 'Seller' AND ad_status = 1 AND expire_data >='$date') AS seller,
			(SELECT COUNT(*) FROM postad WHERE category_id = '7' AND services = 'Needed' AND ad_status = 1 AND expire_data >='$date') AS needed,
			(SELECT COUNT(*) FROM postad WHERE category_id = '7' AND services = 'Charity' AND ad_status = 1 AND expire_data >='$date') AS charity");*/

        	$rs = array('seller'=>$seller,
        				'needed'=>$needed,
        				'charity'=>$charity);
        	return $rs;
        }

        /*findproperty seller and needed count*/
        public function sellerneeded_property(){
        	$date = date("Y-m-d H:i:s");
        	$looking_search = $this->session->userdata('s_looking_search'); 
        	$s_location = $this->session->userdata('s_location');
        	$search_bustype = $this->session->userdata('s_search_bustype');

        	$this->db->select('COUNT(*) as offered', false);
    		$this->db->from('postad AS ad, property_resid_commercial AS prc');
    		$this->db->join("location as loc", "loc.ad_id = ad.ad_id", "left");
			$this->db->where("ad.ad_id = prc.ad_id AND ad.category_id = '4' AND prc.offered_type = 'Offered' AND ad.ad_status = 1 AND ad.expire_data >='$date'");
			if ($looking_search) {
				if ($looking_search != '') {
					$this->db->where("(ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' 
						OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search')");
				}
			}
			if ($s_location != '') {
				$this->db->where("(loc.loc_name LIKE '$s_location%' 
  					OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')");
			}
			if ($search_bustype != 'all') {
				$this->db->where("ad.ad_type",$search_bustype);
			}
			$offered = $this->db->get()->row('offered');

			$this->db->select('COUNT(*) as wanted', false);
    		$this->db->from('postad AS ad, property_resid_commercial AS prc');
    		$this->db->join("location as loc", "loc.ad_id = ad.ad_id", "left");
			$this->db->where("ad.ad_id = prc.ad_id AND ad.category_id = '4' AND prc.offered_type = 'Wanted' AND ad.ad_status = 1 AND ad.expire_data >='$date'");
			if ($looking_search) {
				if ($looking_search != '') {
					$this->db->where("(ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' 
						OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search')");
				}
			}
			if ($s_location != '') {
				$this->db->where("(loc.loc_name LIKE '$s_location%' 
  					OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')");
			}
			$wanted = $this->db->get()->row('wanted');
        	$rs = array('offered'=>$offered,
        				'wanted'=>$wanted);
        	return $rs;
        }

        /*clothstyles seller and needed count*/
        public function sellerneeded_clothstyle(){
        	$date = date("Y-m-d H:i:s");
        	$looking_search = $this->session->userdata('s_looking_search'); 
        	$s_location = $this->session->userdata('s_location');
        	$search_bustype = $this->session->userdata('s_search_bustype');

        	$this->db->select('COUNT(*) as seller', false);
    		$this->db->from('postad AS ad');
    		$this->db->join("location as loc", "loc.ad_id = ad.ad_id", "left");
			$this->db->where("ad.services = 'Seller' AND ad.category_id = '6'  AND ad.ad_status = 1 AND ad.expire_data >='$date'");
			if ($looking_search) {
				if ($looking_search != '') {
					$this->db->where("(ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' 
						OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search')");
				}
			}
			if ($s_location != '') {
				$this->db->where("(loc.loc_name LIKE '$s_location%' 
  					OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')");
			}
			if ($search_bustype != 'all') {
				$this->db->where("ad.ad_type",$search_bustype);
			}
			$seller = $this->db->get()->row('seller');

			$this->db->select('COUNT(*) as needed', false);
    		$this->db->from('postad AS ad');
    		$this->db->join("location as loc", "loc.ad_id = ad.ad_id", "left");
			$this->db->where("ad.services = 'Needed' AND ad.category_id = '6'  AND ad.ad_status = 1 AND ad.expire_data >='$date'");
			if ($looking_search) {
				if ($looking_search != '') {
					$this->db->where("(ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' 
						OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search')");
				}
			}
			if ($s_location != '') {
				$this->db->where("(loc.loc_name LIKE '$s_location%' 
  					OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')");
			}
			$needed = $this->db->get()->row('needed');

			$this->db->select('COUNT(*) as charity', false);
    		$this->db->from('postad AS ad');
    		$this->db->join("location as loc", "loc.ad_id = ad.ad_id", "left");
			$this->db->where("ad.services = 'Charity' AND ad.category_id = '6' AND ad.ad_status = 1 AND ad.expire_data >='$date'");
			if ($looking_search) {
				if ($looking_search != '') {
					$this->db->where("(ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' 
						OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search')");
				}
			}
			if ($s_location != '') {
				$this->db->where("(loc.loc_name LIKE '$s_location%' 
  					OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')");
			}
			$charity = $this->db->get()->row('charity');

        	/*$this->db->select("(SELECT COUNT(*) FROM postad AS ad WHERE ad.services = 'Seller' AND ad.category_id = '6'  AND ad.ad_status = 1 AND ad.expire_data >='$date') AS seller,
			(SELECT COUNT(*) FROM postad AS ad WHERE ad.services = 'Needed' AND ad.category_id = '6'  AND ad.ad_status = 1 AND ad.expire_data >='$date') AS needed,
			(SELECT COUNT(*) FROM postad AS ad WHERE ad.services = 'Charity' AND ad.category_id = '6' AND ad.ad_status = 1 AND ad.expire_data >='$date') AS charity");*/
        	$rs = array("seller"=>$seller,
        				"needed"=>$needed,
        				"charity"=>$charity);
        	return $rs;
        }

        public function sellerneeded_womenview(){
        	$date = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad AS ad WHERE ad.services = 'Seller' AND ad.sub_cat_id = 20 AND ad.category_id = '6' AND ad.ad_status = 1 AND ad.expire_data >='$date') AS seller,
			(SELECT COUNT(*) FROM postad AS ad WHERE ad.services = 'Needed'AND ad.sub_cat_id = 20 AND ad.category_id = '6' AND ad.ad_status = 1 AND ad.expire_data >='$date') AS needed,
			(SELECT COUNT(*) FROM postad AS ad WHERE ad.services = 'Charity'AND ad.sub_cat_id = 20 AND ad.category_id = '6' AND ad.ad_status = 1 AND ad.expire_data >='$date') AS charity");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function sellerneeded_menview(){
        	$date = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad AS ad WHERE ad.services = 'Seller' AND ad.sub_cat_id = 21 AND ad.category_id = '6' AND ad.ad_status = 1 AND ad.expire_data >='$date') AS seller,
			(SELECT COUNT(*) FROM postad AS ad WHERE ad.services = 'Needed'AND ad.sub_cat_id = 21 AND ad.category_id = '6' AND ad.ad_status = 1 AND ad.expire_data >='$date') AS needed,
			(SELECT COUNT(*) FROM postad AS ad WHERE ad.services = 'Charity'AND ad.sub_cat_id = 21 AND ad.category_id = '6' AND ad.ad_status = 1 AND ad.expire_data >='$date') AS charity");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function sellerneeded_boyview(){
        	$date = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad AS ad WHERE ad.services = 'Seller' AND ad.sub_cat_id = 22 AND ad.category_id = '6' AND ad.ad_status = 1 AND ad.expire_data >='$date') AS seller,
			(SELECT COUNT(*) FROM postad AS ad WHERE ad.services = 'Needed'AND ad.sub_cat_id = 22 AND ad.category_id = '6' AND ad.ad_status = 1 AND ad.expire_data >='$date') AS needed,
			(SELECT COUNT(*) FROM postad AS ad WHERE ad.services = 'Charity'AND ad.sub_cat_id = 22 AND ad.category_id = '6' AND ad.ad_status = 1 AND ad.expire_data >='$date') AS charity");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function sellerneeded_girlsview(){
        	$date = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad AS ad WHERE ad.services = 'Seller' AND ad.sub_cat_id = 23 AND ad.category_id = '6' AND ad.ad_status = 1 AND ad.expire_data >='$date') AS seller,
			(SELECT COUNT(*) FROM postad AS ad WHERE ad.services = 'Needed'AND ad.sub_cat_id = 23 AND ad.category_id = '6' AND ad.ad_status = 1 AND ad.expire_data >='$date') AS needed,
			(SELECT COUNT(*) FROM postad AS ad WHERE ad.services = 'Charity'AND ad.sub_cat_id = 23 AND ad.category_id = '6' AND ad.ad_status = 1 AND ad.expire_data >='$date') AS charity");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function sellerneeded_babyboyview(){
        	$date = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad AS ad WHERE ad.services = 'Seller' AND ad.sub_cat_id = 24 AND ad.category_id = '6' AND ad.ad_status = 1 AND ad.expire_data >='$date') AS seller,
			(SELECT COUNT(*) FROM postad AS ad WHERE ad.services = 'Needed'AND ad.sub_cat_id = 24 AND ad.category_id = '6' AND ad.ad_status = 1 AND ad.expire_data >='$date') AS needed,
			(SELECT COUNT(*) FROM postad AS ad WHERE ad.services = 'Charity'AND ad.sub_cat_id = 24 AND ad.category_id = '6' AND ad.ad_status = 1 AND ad.expire_data >='$date') AS charity");
        	$rs = $this->db->get();
        	return $rs->result();
        }
         public function sellerneeded_babygirlview(){
         	$date = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad AS ad WHERE ad.services = 'Seller' AND ad.sub_cat_id = 25 AND ad.category_id = '6' AND ad.ad_status = 1 AND ad.expire_data >='$date') AS seller,
			(SELECT COUNT(*) FROM postad AS ad WHERE ad.services = 'Needed'AND ad.sub_cat_id = 25 AND ad.category_id = '6' AND ad.ad_status = 1 AND ad.expire_data >='$date') AS needed,
			(SELECT COUNT(*) FROM postad AS ad WHERE ad.services = 'Charity'AND ad.sub_cat_id = 25 AND ad.category_id = '6' AND ad.ad_status = 1 AND ad.expire_data >='$date') AS charity");
        	$rs = $this->db->get();
        	return $rs->result();
        }

        /*findproperty area count*/
        public function areacount_property(){
        	$date = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad AS ad, property_resid_commercial AS prc WHERE ad.ad_id = prc.ad_id AND
			ad.category_id = '4' AND ad.ad_status = 1 AND ad.expire_data >='$date' AND prc.`build_area` < 500) AS less500,
			(SELECT COUNT(*) FROM postad AS ad, property_resid_commercial AS prc WHERE ad.ad_id = prc.ad_id AND
			ad.category_id = '4' AND ad.ad_status = 1 AND ad.expire_data >='$date' AND (prc.`build_area` BETWEEN 500 AND 1000)) AS plus500,
			(SELECT COUNT(*) FROM postad AS ad, property_resid_commercial AS prc WHERE ad.ad_id = prc.ad_id AND
			ad.category_id = '4' AND ad.ad_status = 1 AND ad.expire_data >='$date' AND (prc.`build_area` BETWEEN 1000 AND 1500)) AS plus1000,
			(SELECT COUNT(*) FROM postad AS ad, property_resid_commercial AS prc WHERE ad.ad_id = prc.ad_id AND
			ad.category_id = '4' AND ad.ad_status = 1 AND ad.expire_data >='$date' AND (prc.`build_area` BETWEEN 1500 AND 2000)) AS plus1500,
			(SELECT COUNT(*) FROM postad AS ad, property_resid_commercial AS prc WHERE ad.ad_id = prc.ad_id AND
			ad.category_id = '4' AND ad.ad_status = 1 AND ad.expire_data >='$date' AND prc.build_area > 2000) AS plus2000");
        	$rs = $this->db->get();
        	return $rs->row();
        }
         public function areacount_propertyresi(){
        	$date = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad AS ad, property_resid_commercial AS prc WHERE ad.ad_id = prc.ad_id AND
			ad.category_id = '4' AND ad.sub_cat_id = 11 AND ad.ad_status = 1 AND ad.expire_data >='$date' AND prc.`build_area` < 500) AS less500,
			(SELECT COUNT(*) FROM postad AS ad, property_resid_commercial AS prc WHERE ad.ad_id = prc.ad_id AND
			ad.category_id = '4' AND ad.sub_cat_id = 11 AND ad.ad_status = 1 AND ad.expire_data >='$date' AND (prc.`build_area` BETWEEN 500 AND 1000)) AS plus500,
			(SELECT COUNT(*) FROM postad AS ad, property_resid_commercial AS prc WHERE ad.ad_id = prc.ad_id AND
			ad.category_id = '4' AND ad.sub_cat_id = 11 AND ad.ad_status = 1 AND ad.expire_data >='$date' AND (prc.`build_area` BETWEEN 1000 AND 1500)) AS plus1000,
			(SELECT COUNT(*) FROM postad AS ad, property_resid_commercial AS prc WHERE ad.ad_id = prc.ad_id AND
			ad.category_id = '4' AND ad.sub_cat_id = 11 AND ad.ad_status = 1 AND ad.expire_data >='$date' AND (prc.`build_area` BETWEEN 1500 AND 2000)) AS plus1500,
			(SELECT COUNT(*) FROM postad AS ad, property_resid_commercial AS prc WHERE ad.ad_id = prc.ad_id AND
			ad.category_id = '4' AND ad.sub_cat_id = 11 AND ad.ad_status = 1 AND ad.expire_data >='$date' AND prc.build_area > 2000) AS plus2000");
        	$rs = $this->db->get();
        	return $rs->row();
        }
        public function areacount_propertycomm(){
        	$date = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad AS ad, property_resid_commercial AS prc WHERE ad.ad_id = prc.ad_id AND
			ad.category_id = '4' AND ad.sub_cat_id = 26 AND ad.ad_status = 1 AND ad.expire_data >='$date' AND prc.`build_area` < 500) AS less500,
			(SELECT COUNT(*) FROM postad AS ad, property_resid_commercial AS prc WHERE ad.ad_id = prc.ad_id AND
			ad.category_id = '4' AND ad.sub_cat_id = 26 AND ad.ad_status = 1 AND ad.expire_data >='$date' AND (prc.`build_area` BETWEEN 500 AND 1000)) AS plus500,
			(SELECT COUNT(*) FROM postad AS ad, property_resid_commercial AS prc WHERE ad.ad_id = prc.ad_id AND
			ad.category_id = '4' AND ad.sub_cat_id = 26 AND ad.ad_status = 1 AND ad.expire_data >='$date' AND (prc.`build_area` BETWEEN 1000 AND 1500)) AS plus1000,
			(SELECT COUNT(*) FROM postad AS ad, property_resid_commercial AS prc WHERE ad.ad_id = prc.ad_id AND
			ad.category_id = '4' AND ad.sub_cat_id = 26 AND ad.ad_status = 1 AND ad.expire_data >='$date' AND (prc.`build_area` BETWEEN 1500 AND 2000)) AS plus1500,
			(SELECT COUNT(*) FROM postad AS ad, property_resid_commercial AS prc WHERE ad.ad_id = prc.ad_id AND
			ad.category_id = '4' AND ad.sub_cat_id = 26 AND ad.ad_status = 1 AND ad.expire_data >='$date' AND prc.build_area > 2000) AS plus2000");
        	$rs = $this->db->get();
        	return $rs->row();
        }

        /*findproperty bedrooms count*/
        public function bedroomcount_property(){
        	$date = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad AS ad, property_resid_commercial AS prc WHERE ad.ad_id = prc.ad_id AND
		ad.category_id = '4' AND ad.ad_status = 1 AND ad.expire_data >='$date' AND prc.bed_rooms = 1) AS one1,
		(SELECT COUNT(*) FROM postad AS ad, property_resid_commercial AS prc WHERE ad.ad_id = prc.ad_id AND
		ad.category_id = '4' AND ad.ad_status = 1 AND ad.expire_data >='$date' AND prc.bed_rooms = 2) AS secon2,
		(SELECT COUNT(*) FROM postad AS ad, property_resid_commercial AS prc WHERE ad.ad_id = prc.ad_id AND
		ad.category_id = '4' AND ad.ad_status = 1 AND ad.expire_data >='$date' AND prc.bed_rooms = 3) AS third3,
		(SELECT COUNT(*) FROM postad AS ad, property_resid_commercial AS prc WHERE ad.ad_id = prc.ad_id AND
		ad.category_id = '4' AND ad.ad_status = 1 AND ad.expire_data >='$date' AND prc.bed_rooms >= 4) AS four4");
        	$rs = $this->db->get();
        	return $rs->row();
        }
        public function bedroomcount_propertyresi(){
        	$date = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad AS ad, property_resid_commercial AS prc WHERE ad.ad_id = prc.ad_id AND
		ad.category_id = '4' AND ad.sub_cat_id = 11 AND ad.ad_status = 1 AND ad.expire_data >='$date' AND prc.bed_rooms = 1) AS one1,
		(SELECT COUNT(*) FROM postad AS ad, property_resid_commercial AS prc WHERE ad.ad_id = prc.ad_id AND
		ad.category_id = '4' AND ad.sub_cat_id = 11 AND ad.ad_status = 1 AND ad.expire_data >='$date' AND prc.bed_rooms = 2) AS secon2,
		(SELECT COUNT(*) FROM postad AS ad, property_resid_commercial AS prc WHERE ad.ad_id = prc.ad_id AND
		ad.category_id = '4' AND ad.sub_cat_id = 11 AND ad.ad_status = 1 AND ad.expire_data >='$date' AND prc.bed_rooms = 3) AS third3,
		(SELECT COUNT(*) FROM postad AS ad, property_resid_commercial AS prc WHERE ad.ad_id = prc.ad_id AND
		ad.category_id = '4' AND ad.sub_cat_id = 11 AND ad.ad_status = 1 AND ad.expire_data >='$date' AND prc.bed_rooms >= 4) AS four4");
        	$rs = $this->db->get();
        	return $rs->row();
        }
        public function bedroomcount_propertycomm(){
        	$date = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad AS ad, property_resid_commercial AS prc WHERE ad.ad_id = prc.ad_id AND
		ad.category_id = '4' AND ad.sub_cat_id = 26 AND ad.ad_status = 1 AND ad.expire_data >='$date' AND prc.bed_rooms = 1) AS one1,
		(SELECT COUNT(*) FROM postad AS ad, property_resid_commercial AS prc WHERE ad.ad_id = prc.ad_id AND
		ad.category_id = '4' AND ad.sub_cat_id = 26 AND ad.ad_status = 1 AND ad.expire_data >='$date' AND prc.bed_rooms = 2) AS secon2,
		(SELECT COUNT(*) FROM postad AS ad, property_resid_commercial AS prc WHERE ad.ad_id = prc.ad_id AND
		ad.category_id = '4' AND ad.sub_cat_id = 26 AND ad.ad_status = 1 AND ad.expire_data >='$date' AND prc.bed_rooms = 3) AS third3,
		(SELECT COUNT(*) FROM postad AS ad, property_resid_commercial AS prc WHERE ad.ad_id = prc.ad_id AND
		ad.category_id = '4' AND ad.sub_cat_id = 26 AND ad.ad_status = 1 AND ad.expire_data >='$date' AND prc.bed_rooms >= 4) AS four4");
        	$rs = $this->db->get();
        	return $rs->row();
        }

         /*findproperty bathroomcount_property count*/
        public function bathroomcount_property(){
        	$date = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad AS ad, property_resid_commercial AS prc WHERE ad.ad_id = prc.ad_id AND
		ad.category_id = '4' AND ad.ad_status = 1 AND ad.expire_data >='$date' AND prc.bath_rooms = 1) AS one1,
		(SELECT COUNT(*) FROM postad AS ad, property_resid_commercial AS prc WHERE ad.ad_id = prc.ad_id AND
		ad.category_id = '4' AND ad.ad_status = 1 AND ad.expire_data >='$date' AND prc.bath_rooms = 2) AS secon2,
		(SELECT COUNT(*) FROM postad AS ad, property_resid_commercial AS prc WHERE ad.ad_id = prc.ad_id AND
		ad.category_id = '4' AND ad.ad_status = 1 AND ad.expire_data >='$date' AND prc.bath_rooms = 3) AS third3,
		(SELECT COUNT(*) FROM postad AS ad, property_resid_commercial AS prc WHERE ad.ad_id = prc.ad_id AND
		ad.category_id = '4' AND ad.ad_status = 1 AND ad.expire_data >='$date' AND prc.bath_rooms >= 4) AS four4");
        	$rs = $this->db->get();
        	return $rs->row();
        }
        public function bathroomcount_propertyresi(){
        	$date = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad AS ad, property_resid_commercial AS prc WHERE ad.ad_id = prc.ad_id AND
		ad.category_id = '4' AND ad.sub_cat_id = 11 AND ad.ad_status = 1 AND ad.expire_data >='$date' AND prc.bath_rooms = 1) AS one1,
		(SELECT COUNT(*) FROM postad AS ad, property_resid_commercial AS prc WHERE ad.ad_id = prc.ad_id AND
		ad.category_id = '4' AND ad.sub_cat_id = 11 AND ad.ad_status = 1 AND ad.expire_data >='$date' AND prc.bath_rooms = 2) AS secon2,
		(SELECT COUNT(*) FROM postad AS ad, property_resid_commercial AS prc WHERE ad.ad_id = prc.ad_id AND
		ad.category_id = '4' AND ad.sub_cat_id = 11 AND ad.ad_status = 1 AND ad.expire_data >='$date' AND prc.bath_rooms = 3) AS third3,
		(SELECT COUNT(*) FROM postad AS ad, property_resid_commercial AS prc WHERE ad.ad_id = prc.ad_id AND
		ad.category_id = '4' AND ad.sub_cat_id = 11 AND ad.ad_status = 1 AND ad.expire_data >='$date' AND prc.bath_rooms >= 4) AS four4");
        	$rs = $this->db->get();
        	return $rs->row();
        }
        public function bathroomcount_propertycomm(){
        	$date = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad AS ad, property_resid_commercial AS prc WHERE ad.ad_id = prc.ad_id AND
		ad.category_id = '4' AND ad.sub_cat_id = 26 AND ad.ad_status = 1 AND ad.expire_data >='$date' AND prc.bath_rooms = 1) AS one1,
		(SELECT COUNT(*) FROM postad AS ad, property_resid_commercial AS prc WHERE ad.ad_id = prc.ad_id AND
		ad.category_id = '4' AND ad.sub_cat_id = 26 AND ad.ad_status = 1 AND ad.expire_data >='$date' AND prc.bath_rooms = 2) AS secon2,
		(SELECT COUNT(*) FROM postad AS ad, property_resid_commercial AS prc WHERE ad.ad_id = prc.ad_id AND
		ad.category_id = '4' AND ad.sub_cat_id = 26 AND ad.ad_status = 1 AND ad.expire_data >='$date' AND prc.bath_rooms = 3) AS third3,
		(SELECT COUNT(*) FROM postad AS ad, property_resid_commercial AS prc WHERE ad.ad_id = prc.ad_id AND
		ad.category_id = '4' AND ad.sub_cat_id = 26 AND ad.ad_status = 1 AND ad.expire_data >='$date' AND prc.bath_rooms >= 4) AS four4");
        	$rs = $this->db->get();
        	return $rs->row();
        }

        /*findproperty resi_comm_count_property count*/
        public function resi_comm_count_property(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad AS ad WHERE ad.category_id = '4' AND ad.sub_cat_id = 11  AND ad.ad_status = 1 AND ad.expire_data >='$data') AS residential,
			(SELECT COUNT(*) FROM postad AS ad WHERE ad.category_id = '4' AND ad.sub_cat_id = 26 AND ad.ad_status = 1 AND ad.expire_data >='$data') AS commercial");
        	$rs = $this->db->get();
        	return $rs->row();
        }

        /*packages count for services*/
        public function deals_pck_services(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(ud.valid_to) AS aa FROM postad AS ad LEFT JOIN urgent_details AS ud ON ud.ad_id = ad.ad_id AND ud.valid_to >='$data'
				WHERE ad.category_id = '2' AND ad.urgent_package != '0' AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS urgentcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '2' AND package_type = 3 AND urgent_package = '0'  AND ad_status = 1 AND expire_data >='$data') AS platinumcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '2' AND package_type = 2 AND urgent_package = '0'  AND ad_status = 1 AND expire_data >='$data') AS goldcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '2' AND package_type = 1 AND urgent_package = '0'  AND ad_status = 1 AND expire_data >='$data') AS freecount");
        	$rs = $this->db->get();
        	// echo $this->db->last_query(); exit;
        	return $rs->result();
        }
        public function deals_pck_serviceprof(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(ud.valid_to) AS aa FROM postad AS ad LEFT JOIN urgent_details AS ud ON ud.ad_id = ad.ad_id AND ud.valid_to >='$data'
				WHERE ad.category_id = '2' AND sub_cat_id = 9 AND ad.urgent_package != '0' AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS urgentcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '2' AND sub_cat_id = 9 AND package_type = 3 AND urgent_package = '0'  AND ad_status = 1 AND expire_data >='$data') AS platinumcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '2' AND sub_cat_id = 9 AND package_type = 2 AND urgent_package = '0'  AND ad_status = 1 AND expire_data >='$data') AS goldcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '2' AND sub_cat_id = 9 AND package_type = 1 AND urgent_package = '0'  AND ad_status = 1 AND expire_data >='$data') AS freecount");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function deals_pck_servicepop(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(ud.valid_to) AS aa FROM postad AS ad LEFT JOIN urgent_details AS ud ON ud.ad_id = ad.ad_id AND ud.valid_to >='$data'
				WHERE ad.category_id = '2' AND sub_cat_id = 10 AND ad.urgent_package != '0' AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS urgentcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '2' AND sub_cat_id = 10 AND package_type = 3 AND urgent_package = '0'  AND ad_status = 1 AND expire_data >='$data') AS platinumcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '2' AND sub_cat_id = 10 AND package_type = 2 AND urgent_package = '0'  AND ad_status = 1 AND expire_data >='$data') AS goldcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '2' AND sub_cat_id = 10 AND package_type = 1 AND urgent_package = '0'  AND ad_status = 1 AND expire_data >='$data') AS freecount");
        	$rs = $this->db->get();
        	return $rs->result();
        }

        /*packages count for jobs*/
        public function deals_pck_jobs(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(ud.valid_to) AS aa FROM postad AS ad LEFT JOIN urgent_details AS ud ON ud.ad_id = ad.ad_id AND ud.valid_to >='$data'
				WHERE ad.category_id = '1' AND ad.urgent_package != '0' AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS urgentcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '1' AND package_type = '3'  AND urgent_package = '0'  AND ad_status = 1 AND expire_data >='$data') AS platinumcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '1' AND package_type = '2'  AND urgent_package = '0'  AND ad_status = 1 AND expire_data >='$data') AS goldcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '1' AND package_type = '1'  AND urgent_package = '0'  AND ad_status = 1 AND expire_data >='$data') AS freecount");
        	$rs = $this->db->get();
        	return $rs->result();
        }

         /*packages count for pets*/
        public function deals_pck_pets(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(ud.valid_to) AS aa FROM postad AS ad LEFT JOIN urgent_details AS ud ON ud.ad_id = ad.ad_id AND ud.valid_to >='$data'
				WHERE ad.category_id = '5' AND ad.urgent_package != '0' AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS urgentcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '5' AND package_type = '6'  AND urgent_package = '0'  AND ad_status = 1 AND expire_data >='$data') AS platinumcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '5' AND package_type = '5'  AND urgent_package = '0'  AND ad_status = 1 AND expire_data >='$data') AS goldcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '5' AND package_type = '4'  AND urgent_package = '0'  AND ad_status = 1 AND expire_data >='$data') AS freecount");
        	$rs = $this->db->get();
        	return $rs->result();
        }

        /*packages count for motors*/
        public function deals_pck_motors(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(ud.valid_to) AS aa FROM postad AS ad LEFT JOIN urgent_details AS ud ON ud.ad_id = ad.ad_id AND ud.valid_to >='$data'
				WHERE ad.category_id = '3' AND ad.urgent_package != '0' AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS urgentcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND package_type = '3'  AND urgent_package = '0'  AND ad_status = 1 AND expire_data >='$data') AS platinumcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND package_type = '2'  AND urgent_package = '0'  AND ad_status = 1 AND expire_data >='$data') AS goldcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND package_type = '1'  AND urgent_package = '0'  AND ad_status = 1 AND expire_data >='$data') AS freecount");
        	$rs = $this->db->get();
        	return $rs->result();
        }
         public function deals_pck_ezone(){
         	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(ud.valid_to) AS aa FROM postad AS ad LEFT JOIN urgent_details AS ud ON ud.ad_id = ad.ad_id AND ud.valid_to >='$data'
                    WHERE ad.category_id = '8' AND ad.urgent_package != '0' AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS urgentcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND package_type = '6'  AND urgent_package = '0' AND ad_status = 1 AND expire_data >='$data') AS platinumcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND package_type = '5'  AND urgent_package = '0' AND ad_status = 1 AND expire_data >='$data') AS goldcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND package_type = '4'  AND urgent_package = '0' AND ad_status = 1 AND expire_data >='$data') AS freecount");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function deals_pck_phone(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(ud.valid_to) AS aa FROM postad AS ad LEFT JOIN urgent_details AS ud ON ud.ad_id = ad.ad_id AND ud.valid_to >='$data'
                    WHERE ad.category_id = '8' AND sub_cat_id='59' AND ad.urgent_package != '0' AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS urgentcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8'  AND sub_cat_id='59' AND package_type = '6'  AND urgent_package = '0' AND ad_status = 1 AND expire_data >='$data') AS platinumcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8'  AND sub_cat_id='59' AND package_type = '5'  AND urgent_package = '0' AND ad_status = 1 AND expire_data >='$data') AS goldcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8'  AND sub_cat_id='59' AND package_type = '4'  AND urgent_package = '0' AND ad_status = 1 AND expire_data >='$data') AS freecount");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function deals_pck_homes(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(ud.valid_to) AS aa FROM postad AS ad LEFT JOIN urgent_details AS ud ON ud.ad_id = ad.ad_id AND ud.valid_to >='$data'
                    WHERE ad.category_id = '8' AND sub_cat_id='60' AND ad.urgent_package != '0' AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS urgentcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8'  AND sub_cat_id='60' AND package_type = '6'  AND urgent_package = '0' AND ad_status = 1 AND expire_data >='$data') AS platinumcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8'  AND sub_cat_id='60' AND package_type = '5'  AND urgent_package = '0' AND ad_status = 1 AND expire_data >='$data') AS goldcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8'  AND sub_cat_id='60' AND package_type = '4'  AND urgent_package = '0' AND ad_status = 1 AND expire_data >='$data') AS freecount");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function deals_pck_smalls(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(ud.valid_to) AS aa FROM postad AS ad LEFT JOIN urgent_details AS ud ON ud.ad_id = ad.ad_id AND ud.valid_to >='$data'
                    WHERE ad.category_id = '8' AND sub_cat_id='61' AND ad.urgent_package != '0' AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS urgentcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8'  AND sub_cat_id='61' AND package_type = '6'  AND urgent_package = '0' AND ad_status = 1 AND expire_data >='$data') AS platinumcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8'  AND sub_cat_id='61' AND package_type = '5'  AND urgent_package = '0' AND ad_status = 1 AND expire_data >='$data') AS goldcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8'  AND sub_cat_id='61' AND package_type = '4'  AND urgent_package = '0' AND ad_status = 1 AND expire_data >='$data') AS freecount");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function deals_pck_lappy(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(ud.valid_to) AS aa FROM postad AS ad LEFT JOIN urgent_details AS ud ON ud.ad_id = ad.ad_id AND ud.valid_to >='$data'
                    WHERE ad.category_id = '8' AND sub_cat_id='62' AND ad.urgent_package != '0' AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS urgentcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8'  AND sub_cat_id='62' AND package_type = '6'  AND urgent_package = '0' AND ad_status = 1 AND expire_data >='$data') AS platinumcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8'  AND sub_cat_id='62' AND package_type = '5'  AND urgent_package = '0' AND ad_status = 1 AND expire_data >='$data') AS goldcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8'  AND sub_cat_id='62' AND package_type = '4'  AND urgent_package = '0' AND ad_status = 1 AND expire_data >='$data') AS freecount");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function deals_pck_access(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(ud.valid_to) AS aa FROM postad AS ad LEFT JOIN urgent_details AS ud ON ud.ad_id = ad.ad_id AND ud.valid_to >='$data'
                    WHERE ad.category_id = '8' AND sub_cat_id='63' AND ad.urgent_package != '0' AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS urgentcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8'  AND sub_cat_id='63' AND package_type = '6'  AND urgent_package = '0' AND ad_status = 1 AND expire_data >='$data') AS platinumcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8'  AND sub_cat_id='63' AND package_type = '5'  AND urgent_package = '0' AND ad_status = 1 AND expire_data >='$data') AS goldcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8'  AND sub_cat_id='63' AND package_type = '4'  AND urgent_package = '0' AND ad_status = 1 AND expire_data >='$data') AS freecount");
        	$rs = $this->db->get();
        	return $rs->result();
        }
         public function deals_pck_pcare(){
         	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '8'  AND sub_cat_id='64' AND urgent_package != '0' AND ad_status = 1 AND expire_data >='$data') AS urgentcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8'  AND sub_cat_id='64' AND package_type = '6'  AND urgent_package = '0' AND ad_status = 1 AND expire_data >='$data') AS platinumcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8'  AND sub_cat_id='64' AND package_type = '5'  AND urgent_package = '0' AND ad_status = 1 AND expire_data >='$data') AS goldcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8'  AND sub_cat_id='64' AND package_type = '4'  AND urgent_package = '0' AND ad_status = 1 AND expire_data >='$data') AS freecount");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function deals_pck_entertain(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(ud.valid_to) AS aa FROM postad AS ad LEFT JOIN urgent_details AS ud ON ud.ad_id = ad.ad_id AND ud.valid_to >='$data'
                    WHERE ad.category_id = '8' AND sub_cat_id='65' AND ad.urgent_package != '0' AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS urgentcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8'  AND sub_cat_id='65' AND package_type = '6'  AND urgent_package = '0' AND ad_status = 1 AND expire_data >='$data') AS platinumcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8'  AND sub_cat_id='65' AND package_type = '5'  AND urgent_package = '0' AND ad_status = 1 AND expire_data >='$data') AS goldcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8'  AND sub_cat_id='65' AND package_type = '4'  AND urgent_package = '0' AND ad_status = 1 AND expire_data >='$data') AS freecount");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function deals_pck_poto(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(ud.valid_to) AS aa FROM postad AS ad LEFT JOIN urgent_details AS ud ON ud.ad_id = ad.ad_id AND ud.valid_to >='$data'
                    WHERE ad.category_id = '8' AND sub_cat_id='66' AND ad.urgent_package != '0' AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS urgentcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8'  AND sub_cat_id='66' AND package_type = '6'  AND urgent_package = '0' AND ad_status = 1 AND expire_data >='$data') AS platinumcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8'  AND sub_cat_id='66' AND package_type = '5'  AND urgent_package = '0' AND ad_status = 1 AND expire_data >='$data') AS goldcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8'  AND sub_cat_id='66' AND package_type = '4'  AND urgent_package = '0' AND ad_status = 1 AND expire_data >='$data') AS freecount");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function deals_pck_cars(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id='12' AND urgent_package != '0') AS urgentcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id='12' AND package_type = '3'  AND urgent_package = '0') AS platinumcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id='12' AND package_type = '2'  AND urgent_package = '0') AS goldcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id='12' AND package_type = '1'  AND urgent_package = '0') AS freecount");
        	$rs = $this->db->get();
        	return $rs->result();
        }
         public function deals_pck_plants(){
         	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id='17' AND urgent_package != '0') AS urgentcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id='17' AND package_type = '3'  AND urgent_package = '0') AS platinumcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id='17' AND package_type = '2'  AND urgent_package = '0') AS goldcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id='17' AND package_type = '1'  AND urgent_package = '0') AS freecount");
        	$rs = $this->db->get();
        	return $rs->result();
        }
         public function deals_pck_farming(){
         	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id='18' AND urgent_package != '0') AS urgentcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id='18' AND package_type = '3'  AND urgent_package = '0') AS platinumcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id='18' AND package_type = '2'  AND urgent_package = '0') AS goldcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id='18' AND package_type = '1'  AND urgent_package = '0') AS freecount");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function deals_pck_boats(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id='19' AND urgent_package != '0') AS urgentcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id='19' AND package_type = '3'  AND urgent_package = '0') AS platinumcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id='19' AND package_type = '2'  AND urgent_package = '0') AS goldcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id='19' AND package_type = '1'  AND urgent_package = '0') AS freecount");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function deals_pck_caravans(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id='14' AND urgent_package != '0') AS urgentcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id='14' AND package_type = '3'  AND urgent_package = '0') AS platinumcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id='14' AND package_type = '2'  AND urgent_package = '0') AS goldcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id='14' AND package_type = '1'  AND urgent_package = '0') AS freecount");
        	$rs = $this->db->get();
        	return $rs->result();
        }
         public function deals_pck_coaches(){
         	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id='16' AND urgent_package != '0') AS urgentcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id='16' AND package_type = '3'  AND urgent_package = '0') AS platinumcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id='16' AND package_type = '2'  AND urgent_package = '0') AS goldcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id='16' AND package_type = '1'  AND urgent_package = '0') AS freecount");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function deals_pck_vans(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id='15' AND urgent_package != '0') AS urgentcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id='15' AND package_type = '3'  AND urgent_package = '0') AS platinumcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id='15' AND package_type = '2'  AND urgent_package = '0') AS goldcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id='15' AND package_type = '1'  AND urgent_package = '0') AS freecount");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function deals_pck_bikes(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id='13' AND urgent_package != '0') AS urgentcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id='13' AND package_type = '3'  AND urgent_package = '0') AS platinumcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id='13' AND package_type = '2'  AND urgent_package = '0') AS goldcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id='13' AND package_type = '1'  AND urgent_package = '0') AS freecount");
        	$rs = $this->db->get();
        	return $rs->result();
        }

         /*packages count for pets*/
        public function deals_pck_kitchen(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '7' AND ad_status = 1 AND expire_data >='$data' AND urgent_package != '0') AS urgentcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '7' AND ad_status = 1 AND expire_data >='$data' AND package_type = '6'  AND urgent_package = '0') AS platinumcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '7' AND ad_status = 1 AND expire_data >='$data' AND package_type = '5'  AND urgent_package = '0') AS goldcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '7' AND ad_status = 1 AND expire_data >='$data' AND package_type = '4'  AND urgent_package = '0') AS freecount");
        	$rs = $this->db->get();
        	return $rs->result();
        }

        /*packages count for findproperty*/
        public function deals_pck_property(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(ud.valid_to) AS aa FROM postad AS ad LEFT JOIN urgent_details AS ud ON ud.ad_id = ad.ad_id AND ud.valid_to >='$data'
                    WHERE ad.category_id = '4' AND ad.urgent_package != '0' AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS urgentcount,
		(SELECT COUNT(*) FROM postad WHERE category_id = '4' AND ad_status = 1 AND expire_data >='$data' AND package_type = '3'  AND urgent_package = '0') AS platinumcount,
		(SELECT COUNT(*) FROM postad WHERE category_id = '4' AND ad_status = 1 AND expire_data >='$data' AND package_type = '2'  AND urgent_package = '0') AS goldcount,
		(SELECT COUNT(*) FROM postad WHERE category_id = '4' AND ad_status = 1 AND expire_data >='$data' AND package_type = '1'  AND urgent_package = '0') AS freecount");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function deals_pck_propertyresi(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(ud.valid_to) AS aa FROM postad AS ad LEFT JOIN urgent_details AS ud ON ud.ad_id = ad.ad_id AND ud.valid_to >='$data'
                    WHERE ad.category_id = '4' AND sub_cat_id = 11 AND ad.urgent_package != '0' AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS urgentcount,
		(SELECT COUNT(*) FROM postad WHERE category_id = '4' AND sub_cat_id = 11 AND ad_status = 1 AND expire_data >='$data' AND package_type = '3'  AND urgent_package = '0') AS platinumcount,
		(SELECT COUNT(*) FROM postad WHERE category_id = '4' AND sub_cat_id = 11 AND ad_status = 1 AND expire_data >='$data' AND package_type = '2'  AND urgent_package = '0') AS goldcount,
		(SELECT COUNT(*) FROM postad WHERE category_id = '4' AND sub_cat_id = 11 AND ad_status = 1 AND expire_data >='$data' AND package_type = '1'  AND urgent_package = '0') AS freecount");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function deals_pck_propertycomm(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(ud.valid_to) AS aa FROM postad AS ad LEFT JOIN urgent_details AS ud ON ud.ad_id = ad.ad_id AND ud.valid_to >='$data'
                    WHERE ad.category_id = '4' AND sub_cat_id = 26 AND ad.urgent_package != '0' AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS urgentcount,
		(SELECT COUNT(*) FROM postad WHERE category_id = '4' AND sub_cat_id = 26 AND ad_status = 1 AND expire_data >='$data' AND package_type = '3'  AND urgent_package = '0') AS platinumcount,
		(SELECT COUNT(*) FROM postad WHERE category_id = '4' AND sub_cat_id = 26 AND ad_status = 1 AND expire_data >='$data' AND package_type = '2'  AND urgent_package = '0') AS goldcount,
		(SELECT COUNT(*) FROM postad WHERE category_id = '4' AND sub_cat_id = 26 AND ad_status = 1 AND expire_data >='$data' AND package_type = '1'  AND urgent_package = '0') AS freecount");
        	$rs = $this->db->get();
        	return $rs->result();
        }

        /*packages count for findproperty*/
        public function deals_pck_clothstyle(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(ud.valid_to) AS aa FROM postad AS ad LEFT JOIN urgent_details AS ud ON ud.ad_id = ad.ad_id AND ud.valid_to >='$data'
                    WHERE ad.category_id = '6' AND ad.urgent_package != '0' AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS urgentcount,
		(SELECT COUNT(*) FROM postad WHERE category_id = '6' AND ad_status = 1 AND expire_data >='$data' AND package_type = '6' AND urgent_package = '0' AND ad_status = 1) AS platinumcount,
		(SELECT COUNT(*) FROM postad WHERE category_id = '6' AND ad_status = 1 AND expire_data >='$data' AND package_type = '5' AND urgent_package = '0' AND ad_status = 1) AS goldcount,
		(SELECT COUNT(*) FROM postad WHERE category_id = '6' AND ad_status = 1 AND expire_data >='$data' AND package_type = '4' AND urgent_package = '0' AND ad_status = 1) AS freecount");
        	$rs = $this->db->get();
        	return $rs->result();
        }

         public function deals_pck_womenview(){
         	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(ud.valid_to) AS aa FROM postad AS ad LEFT JOIN urgent_details AS ud ON ud.ad_id = ad.ad_id AND ud.valid_to >='$data'
                    WHERE ad.category_id = '6' AND sub_cat_id = 20 AND ad.urgent_package != '0' AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS urgentcount,
		(SELECT COUNT(*) FROM postad WHERE category_id = '6' AND ad_status = 1 AND expire_data >='$data'  AND sub_cat_id = 20 AND package_type = '6' AND urgent_package = '0') AS platinumcount,
		(SELECT COUNT(*) FROM postad WHERE category_id = '6' AND ad_status = 1 AND expire_data >='$data'  AND sub_cat_id = 20 AND package_type = '5' AND urgent_package = '0') AS goldcount,
		(SELECT COUNT(*) FROM postad WHERE category_id = '6' AND ad_status = 1 AND expire_data >='$data'  AND sub_cat_id = 20 AND package_type = '4' AND urgent_package = '0') AS freecount");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function deals_pck_menview(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(ud.valid_to) AS aa FROM postad AS ad LEFT JOIN urgent_details AS ud ON ud.ad_id = ad.ad_id AND ud.valid_to >='$data'
                    WHERE ad.category_id = '6' AND sub_cat_id = 21 AND ad.urgent_package != '0' AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS urgentcount,
		(SELECT COUNT(*) FROM postad WHERE category_id = '6' AND ad_status = 1 AND expire_data >='$data'  AND sub_cat_id = 21 AND package_type = '6' AND urgent_package = '0') AS platinumcount,
		(SELECT COUNT(*) FROM postad WHERE category_id = '6' AND ad_status = 1 AND expire_data >='$data'  AND sub_cat_id = 21 AND package_type = '5' AND urgent_package = '0') AS goldcount,
		(SELECT COUNT(*) FROM postad WHERE category_id = '6' AND ad_status = 1 AND expire_data >='$data'  AND sub_cat_id = 21 AND package_type = '4' AND urgent_package = '0') AS freecount");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function deals_pck_boysview(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(ud.valid_to) AS aa FROM postad AS ad LEFT JOIN urgent_details AS ud ON ud.ad_id = ad.ad_id AND ud.valid_to >='$data'
                    WHERE ad.category_id = '6' AND sub_cat_id = 22 AND ad.urgent_package != '0' AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS urgentcount,
		(SELECT COUNT(*) FROM postad WHERE category_id = '6' AND ad_status = 1 AND expire_data >='$data'  AND sub_cat_id = 22 AND package_type = '6' AND urgent_package = '0') AS platinumcount,
		(SELECT COUNT(*) FROM postad WHERE category_id = '6' AND ad_status = 1 AND expire_data >='$data'  AND sub_cat_id = 22 AND package_type = '5' AND urgent_package = '0') AS goldcount,
		(SELECT COUNT(*) FROM postad WHERE category_id = '6' AND ad_status = 1 AND expire_data >='$data'  AND sub_cat_id = 22 AND package_type = '4' AND urgent_package = '0') AS freecount");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function deals_pck_girlsview(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(ud.valid_to) AS aa FROM postad AS ad LEFT JOIN urgent_details AS ud ON ud.ad_id = ad.ad_id AND ud.valid_to >='$data'
                    WHERE ad.category_id = '6' AND sub_cat_id = 23 AND ad.urgent_package != '0' AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS urgentcount,
		(SELECT COUNT(*) FROM postad WHERE category_id = '6' AND ad_status = 1 AND expire_data >='$data'  AND sub_cat_id = 23 AND package_type = '6' AND urgent_package = '0') AS platinumcount,
		(SELECT COUNT(*) FROM postad WHERE category_id = '6' AND ad_status = 1 AND expire_data >='$data'  AND sub_cat_id = 23 AND package_type = '5' AND urgent_package = '0') AS goldcount,
		(SELECT COUNT(*) FROM postad WHERE category_id = '6' AND ad_status = 1 AND expire_data >='$data'  AND sub_cat_id = 23 AND package_type = '4' AND urgent_package = '0') AS freecount");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function deals_pck_babyboyview(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(ud.valid_to) AS aa FROM postad AS ad LEFT JOIN urgent_details AS ud ON ud.ad_id = ad.ad_id AND ud.valid_to >='$data'
                    WHERE ad.category_id = '6' AND sub_cat_id = 24 AND ad.urgent_package != '0' AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS urgentcount,
		(SELECT COUNT(*) FROM postad WHERE category_id = '6' AND ad_status = 1 AND expire_data >='$data'  AND sub_cat_id = 24 AND package_type = '6' AND urgent_package = '0') AS platinumcount,
		(SELECT COUNT(*) FROM postad WHERE category_id = '6' AND ad_status = 1 AND expire_data >='$data'  AND sub_cat_id = 24 AND package_type = '5' AND urgent_package = '0') AS goldcount,
		(SELECT COUNT(*) FROM postad WHERE category_id = '6' AND ad_status = 1 AND expire_data >='$data'  AND sub_cat_id = 24 AND package_type = '4' AND urgent_package = '0') AS freecount");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function deals_pck_babygirlview(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(ud.valid_to) AS aa FROM postad AS ad LEFT JOIN urgent_details AS ud ON ud.ad_id = ad.ad_id AND ud.valid_to >='$data'
                    WHERE ad.category_id = '6' AND sub_cat_id = 25 AND ad.urgent_package != '0' AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS urgentcount,
		(SELECT COUNT(*) FROM postad WHERE category_id = '6' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = 25 AND package_type = '6' AND urgent_package = '0') AS platinumcount,
		(SELECT COUNT(*) FROM postad WHERE category_id = '6' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = 25 AND package_type = '5' AND urgent_package = '0') AS goldcount,
		(SELECT COUNT(*) FROM postad WHERE category_id = '6' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = 25 AND package_type = '4' AND urgent_package = '0') AS freecount");
        	$rs = $this->db->get();
        	return $rs->result();
        }

        public function deals_pck_search(){
        	$date = date("Y-m-d H:i:s");
        	$looking_search =  $this->session->userdata('s_looking_search');
         	$cat_id =  $this->session->userdata('s_cat_id');
         	$s_location = $this->session->userdata('s_location');
         	$search_bustype = $this->session->userdata('s_search_bustype');
        	if ($cat_id != 'all') {
        		if ($cat_id == 1 || $cat_id == 2 || $cat_id == 3 || $cat_id == 4) {
        			$this->db->select('COUNT(ud.valid_to) as urgentcount', false);
	        		$this->db->from('postad');
	        		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
	        		$this->db->join("urgent_details AS ud", "ud.ad_id=postad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
					$this->db->where("category_id = '$cat_id' AND urgent_package != '0' AND ad_status = 1 AND expire_data >='$date'");
					if ($search_bustype) {
						if ($search_bustype != 'all') {
							$this->db->where("ad_type", $search_bustype);
						}
					}
					if ($looking_search) {
						if ($looking_search != '') {
							$this->db->where("(deal_tag LIKE '%$looking_search%' OR deal_tag LIKE '$looking_search%' OR deal_tag LIKE '%$looking_search' 
	  						OR deal_desc LIKE '%$looking_search%' OR deal_desc LIKE '$looking_search%' OR deal_desc LIKE '%$looking_search')");
						}
					}
					if ($s_location != '') {
						$this->db->where("(loc.loc_name LIKE '$s_location%' 
		  					OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')");
					}
					$urgentcount = $this->db->get()->row('urgentcount');


					$this->db->select('COUNT(*) as platinumcount', false);
	        		$this->db->from('postad');
	        		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
					$this->db->where("category_id = '$cat_id' AND package_type = 3 AND urgent_package = '0' AND ad_status = 1 AND expire_data >='$date'");
					if ($search_bustype) {
						if ($search_bustype != 'all') {
							$this->db->where("ad_type", $search_bustype);
						}
					}
					if ($looking_search) {
						if ($looking_search != '') {
							$this->db->where("(deal_tag LIKE '%$looking_search%' OR deal_tag LIKE '$looking_search%' OR deal_tag LIKE '%$looking_search' 
	  						OR deal_desc LIKE '%$looking_search%' OR deal_desc LIKE '$looking_search%' OR deal_desc LIKE '%$looking_search')");
						}
					}
					if ($s_location != '') {
						$this->db->where("(loc.loc_name LIKE '$s_location%' 
		  					OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')");
					}
					$this->db->get();
					$platinumcount = $this->db->last_query();
					/*urgent label expiry*/
					$this->db->select('COUNT(ud.valid_to) as platinumcount', false);
	        		$this->db->from('postad');
	        		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
	        		$this->db->join("urgent_details AS ud", "ud.ad_id=postad.ad_id AND ud.valid_to < '".date("Y-m-d H:i:s")."'", "left");
					$this->db->where("category_id = '$cat_id' AND package_type = 3 AND urgent_package != '0' AND ad_status = 1 AND expire_data >='$date'");
					if ($search_bustype) {
						if ($search_bustype != 'all') {
							$this->db->where("ad_type", $search_bustype);
						}
					}
					if ($looking_search) {
						if ($looking_search != '') {
							$this->db->where("(deal_tag LIKE '%$looking_search%' OR deal_tag LIKE '$looking_search%' OR deal_tag LIKE '%$looking_search' 
	  						OR deal_desc LIKE '%$looking_search%' OR deal_desc LIKE '$looking_search%' OR deal_desc LIKE '%$looking_search')");
						}
					}
					if ($s_location != '') {
						$this->db->where("(loc.loc_name LIKE '$s_location%' 
		  					OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')");
					}
					$this->db->get();
					$platinumcount1 = $this->db->last_query();
					$query = $this->db->query($platinumcount." UNION ".$platinumcount1);
					$query1 = $query->result();
					$platinumsum = 0;
					foreach ($query1 as $k) {
						 $platinumsum = $platinumsum + $k->platinumcount;
					}


					$this->db->select('COUNT(*) as goldcount', false);
	        		$this->db->from('postad');
	        		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
					$this->db->where("category_id = '$cat_id' AND package_type = 2 AND urgent_package = '0' AND ad_status = 1 AND expire_data >='$date'");
					if ($search_bustype) {
						if ($search_bustype != 'all') {
							$this->db->where("ad_type", $search_bustype);
						}
					}
					if ($looking_search) {
						if ($looking_search != '') {
							$this->db->where("(deal_tag LIKE '%$looking_search%' OR deal_tag LIKE '$looking_search%' OR deal_tag LIKE '%$looking_search' 
	  						OR deal_desc LIKE '%$looking_search%' OR deal_desc LIKE '$looking_search%' OR deal_desc LIKE '%$looking_search')");
						}
					}
					if ($s_location != '') {
						$this->db->where("(loc.loc_name LIKE '$s_location%' 
		  					OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')");
					}
					$this->db->get();
					$goldcount = $this->db->last_query();

					/*urgent label expiry*/
					$this->db->select('COUNT(ud.valid_to) as goldcount', false);
	        		$this->db->from('postad');
	        		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
	        		$this->db->join("urgent_details AS ud", "ud.ad_id=postad.ad_id AND ud.valid_to < '".date("Y-m-d H:i:s")."'", "left");
					$this->db->where("category_id = '$cat_id' AND package_type = 2 AND urgent_package != '0' AND ad_status = 1 AND expire_data >='$date'");
					if ($search_bustype) {
						if ($search_bustype != 'all') {
							$this->db->where("ad_type", $search_bustype);
						}
					}
					if ($looking_search) {
						if ($looking_search != '') {
							$this->db->where("(deal_tag LIKE '%$looking_search%' OR deal_tag LIKE '$looking_search%' OR deal_tag LIKE '%$looking_search' 
	  						OR deal_desc LIKE '%$looking_search%' OR deal_desc LIKE '$looking_search%' OR deal_desc LIKE '%$looking_search')");
						}
					}
					if ($s_location != '') {
						$this->db->where("(loc.loc_name LIKE '$s_location%' 
		  					OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')");
					}
					$this->db->get();
					$goldcount1 = $this->db->last_query();
					$query = $this->db->query($goldcount." UNION ".$goldcount1);
					$query1 = $query->result();
					$goldsum = 0;
					foreach ($query1 as $k) {
						 $goldsum = $goldsum + $k->goldcount;
					}


					$this->db->select('COUNT(*) as freecount', false);
	        		$this->db->from('postad');
	        		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
					$this->db->where("category_id = '$cat_id' AND package_type = 1 AND urgent_package = '0' AND ad_status = 1 AND expire_data >='$date'");
					if ($search_bustype) {
						if ($search_bustype != 'all') {
							$this->db->where("ad_type", $search_bustype);
						}
					}
					if ($looking_search) {
						if ($looking_search != '') {
							$this->db->where("(deal_tag LIKE '%$looking_search%' OR deal_tag LIKE '$looking_search%' OR deal_tag LIKE '%$looking_search' 
	  						OR deal_desc LIKE '%$looking_search%' OR deal_desc LIKE '$looking_search%' OR deal_desc LIKE '%$looking_search')");
						}
					}
					if ($s_location != '') {
						$this->db->where("(loc.loc_name LIKE '$s_location%' 
		  					OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')");
					}
					$this->db->get();
					$freecount = $this->db->last_query();

					/*urgent label expiry*/
					$this->db->select('COUNT(ud.valid_to) as freecount', false);
	        		$this->db->from('postad');
	        		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
	        		$this->db->join("urgent_details AS ud", "ud.ad_id=postad.ad_id AND ud.valid_to < '".date("Y-m-d H:i:s")."'", "left");
					$this->db->where("category_id = '$cat_id' AND package_type = 1 AND urgent_package != '0' AND ad_status = 1 AND expire_data >='$date'");
					if ($search_bustype) {
						if ($search_bustype != 'all') {
							$this->db->where("ad_type", $search_bustype);
						}
					}
					if ($looking_search) {
						if ($looking_search != '') {
							$this->db->where("(deal_tag LIKE '%$looking_search%' OR deal_tag LIKE '$looking_search%' OR deal_tag LIKE '%$looking_search' 
	  						OR deal_desc LIKE '%$looking_search%' OR deal_desc LIKE '$looking_search%' OR deal_desc LIKE '%$looking_search')");
						}
					}
					if ($s_location != '') {
						$this->db->where("(loc.loc_name LIKE '$s_location%' 
		  					OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')");
					}
					$this->db->get();
					$freecount1 = $this->db->last_query();
					$query = $this->db->query($freecount." UNION ".$freecount1);
					$query1 = $query->result();
					$freesum = 0;
					foreach ($query1 as $k) {
						 $freesum = $freesum + $k->freecount;
					}



				$res = array('urgentcount'=>$urgentcount,
							'platinumcount'=>$platinumsum,
							'goldcount'=>$goldsum,
							'freecount'=>$freesum);
        	
        		}
        		else{
        			$this->db->select('COUNT(ud.valid_to) as urgentcount', false);
	        		$this->db->from('postad');
	        		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
	        		$this->db->join("urgent_details AS ud", "ud.ad_id=postad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
					$this->db->where("category_id = '$cat_id' AND urgent_package != '0' AND ad_status = 1 AND expire_data >='$date'");
					if ($search_bustype) {
						if ($search_bustype != 'all') {
							$this->db->where("ad_type", $search_bustype);
						}
					}
					if ($looking_search) {
						if ($looking_search != '') {
							$this->db->where("(deal_tag LIKE '%$looking_search%' OR deal_tag LIKE '$looking_search%' OR deal_tag LIKE '%$looking_search' 
	  						OR deal_desc LIKE '%$looking_search%' OR deal_desc LIKE '$looking_search%' OR deal_desc LIKE '%$looking_search')");
						}
					}
					if ($s_location != '') {
						$this->db->where("(loc.loc_name LIKE '$s_location%' 
		  					OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')");
					}
					$urgentcount = $this->db->get()->row('urgentcount');

					$this->db->select('COUNT(*) as platinumcount', false);
	        		$this->db->from('postad');
	        		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
					$this->db->where("category_id = '$cat_id' AND package_type = 6 AND urgent_package = '0' AND ad_status = 1 AND expire_data >='$date'");
					if ($search_bustype) {
						if ($search_bustype != 'all') {
							$this->db->where("ad_type", $search_bustype);
						}
					}
					if ($looking_search) {
						if ($looking_search != '') {
							$this->db->where("(deal_tag LIKE '%$looking_search%' OR deal_tag LIKE '$looking_search%' OR deal_tag LIKE '%$looking_search' 
	  						OR deal_desc LIKE '%$looking_search%' OR deal_desc LIKE '$looking_search%' OR deal_desc LIKE '%$looking_search')");
						}
					}
					if ($s_location != '') {
						$this->db->where("(loc.loc_name LIKE '$s_location%' 
		  					OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')");
					}
					$this->db->get();
					$platinumcount = $this->db->last_query();

					/*urgent label expiry*/
					$this->db->select('COUNT(ud.valid_to) as platinumcount', false);
	        		$this->db->from('postad');
	        		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
	        		$this->db->join("urgent_details AS ud", "ud.ad_id=postad.ad_id AND ud.valid_to < '".date("Y-m-d H:i:s")."'", "left");
					$this->db->where("category_id = '$cat_id' AND package_type = 6 AND urgent_package != '0' AND ad_status = 1 AND expire_data >='$date'");
					if ($search_bustype) {
						if ($search_bustype != 'all') {
							$this->db->where("ad_type", $search_bustype);
						}
					}
					if ($looking_search) {
						if ($looking_search != '') {
							$this->db->where("(deal_tag LIKE '%$looking_search%' OR deal_tag LIKE '$looking_search%' OR deal_tag LIKE '%$looking_search' 
	  						OR deal_desc LIKE '%$looking_search%' OR deal_desc LIKE '$looking_search%' OR deal_desc LIKE '%$looking_search')");
						}
					}
					if ($s_location != '') {
						$this->db->where("(loc.loc_name LIKE '$s_location%' 
		  					OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')");
					}
					$this->db->get();
					$platinumcount1 = $this->db->last_query();
					$query = $this->db->query($platinumcount." UNION ".$platinumcount1);
					$query1 = $query->result();
					$platinumsum = 0;
					foreach ($query1 as $k) {
						 $platinumsum = $platinumsum + $k->platinumcount;
					}

					$this->db->select('COUNT(*) as goldcount', false);
	        		$this->db->from('postad');
	        		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
					$this->db->where("category_id = '$cat_id' AND package_type = 5 AND urgent_package = '0' AND ad_status = 1 AND expire_data >='$date'");
					if ($search_bustype) {
						if ($search_bustype != 'all') {
							$this->db->where("ad_type", $search_bustype);
						}
					}
					if ($looking_search) {
						if ($looking_search != '') {
							$this->db->where("(deal_tag LIKE '%$looking_search%' OR deal_tag LIKE '$looking_search%' OR deal_tag LIKE '%$looking_search' 
	  						OR deal_desc LIKE '%$looking_search%' OR deal_desc LIKE '$looking_search%' OR deal_desc LIKE '%$looking_search')");
						}
					}
					if ($s_location != '') {
						$this->db->where("(loc.loc_name LIKE '$s_location%' 
		  					OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')");
					}
					$this->db->get();
					$goldcount = $this->db->last_query();

					/*urgent label expiry*/
					$this->db->select('COUNT(ud.valid_to) as goldcount', false);
	        		$this->db->from('postad');
	        		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
	        		$this->db->join("urgent_details AS ud", "ud.ad_id=postad.ad_id AND ud.valid_to < '".date("Y-m-d H:i:s")."'", "left");
					$this->db->where("category_id = '$cat_id' AND package_type = 5 AND urgent_package != '0' AND ad_status = 1 AND expire_data >='$date'");
					if ($search_bustype) {
						if ($search_bustype != 'all') {
							$this->db->where("ad_type", $search_bustype);
						}
					}
					if ($looking_search) {
						if ($looking_search != '') {
							$this->db->where("(deal_tag LIKE '%$looking_search%' OR deal_tag LIKE '$looking_search%' OR deal_tag LIKE '%$looking_search' 
	  						OR deal_desc LIKE '%$looking_search%' OR deal_desc LIKE '$looking_search%' OR deal_desc LIKE '%$looking_search')");
						}
					}
					if ($s_location != '') {
						$this->db->where("(loc.loc_name LIKE '$s_location%' 
		  					OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')");
					}
					$this->db->get();
					$goldcount1 = $this->db->last_query();
					$query = $this->db->query($goldcount." UNION ".$goldcount1);
					$query1 = $query->result();
					$goldsum = 0;
					foreach ($query1 as $k) {
						 $goldsum = $goldsum + $k->goldcount;
					}

					$this->db->select('COUNT(*) as freecount', false);
	        		$this->db->from('postad');
	        		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
					$this->db->where("category_id = '$cat_id' AND package_type = 4 AND urgent_package = '0' AND ad_status = 1 AND expire_data >='$date'");
					if ($search_bustype) {
						if ($search_bustype != 'all') {
							$this->db->where("ad_type", $search_bustype);
						}
					}
					if ($looking_search) {
						if ($looking_search != '') {
							$this->db->where("(deal_tag LIKE '%$looking_search%' OR deal_tag LIKE '$looking_search%' OR deal_tag LIKE '%$looking_search' 
	  						OR deal_desc LIKE '%$looking_search%' OR deal_desc LIKE '$looking_search%' OR deal_desc LIKE '%$looking_search')");
						}
					}
					if ($s_location != '') {
						$this->db->where("(loc.loc_name LIKE '$s_location%' 
		  					OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')");
					}
					$this->db->get();
					$freecount = $this->db->last_query();

					/*urgent label expiry */
					$this->db->select('COUNT(ud.valid_to) as freecount', false);
	        		$this->db->from('postad');
	        		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
	        		$this->db->join("urgent_details AS ud", "ud.ad_id=postad.ad_id AND ud.valid_to < '".date("Y-m-d H:i:s")."'", "left");
					$this->db->where("category_id = '$cat_id' AND package_type = 4 AND urgent_package != '0' AND ad_status = 1 AND expire_data >='$date'");
					if ($search_bustype) {
						if ($search_bustype != 'all') {
							$this->db->where("ad_type", $search_bustype);
						}
					}
					if ($looking_search) {
						if ($looking_search != '') {
							$this->db->where("(deal_tag LIKE '%$looking_search%' OR deal_tag LIKE '$looking_search%' OR deal_tag LIKE '%$looking_search' 
	  						OR deal_desc LIKE '%$looking_search%' OR deal_desc LIKE '$looking_search%' OR deal_desc LIKE '%$looking_search')");
						}
					}
					if ($s_location != '') {
						$this->db->where("(loc.loc_name LIKE '$s_location%' 
		  					OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')");
					}
					$this->db->get();
					$freecount1 = $this->db->last_query();
					$query = $this->db->query($freecount." UNION ".$freecount1);
					$query1 = $query->result();
					$freesum = 0;
					foreach ($query1 as $k) {
						 $freesum = $freesum + $k->freecount;
					}

				$res = array('urgentcount'=>$urgentcount,
							'platinumcount'=>$platinumsum,
							'goldcount'=>$goldsum,
							'freecount'=>$freesum);
        		
        		}
        	}
        	else{
        		$this->db->select('COUNT(ud.valid_to) as urgentcount', false);
        		$this->db->from('postad');
        		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
        		$this->db->join("urgent_details AS ud", "ud.ad_id=postad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
				$this->db->where("urgent_package != '0' AND ad_status = 1 AND expire_data >='$date'");
				if ($search_bustype) {
						if ($search_bustype != 'all') {
							$this->db->where("ad_type", $search_bustype);
						}
					}
				if ($looking_search) {
						if ($looking_search != '') {
							$this->db->where("(deal_tag LIKE '%$looking_search%' OR deal_tag LIKE '$looking_search%' OR deal_tag LIKE '%$looking_search' 
	  						OR deal_desc LIKE '%$looking_search%' OR deal_desc LIKE '$looking_search%' OR deal_desc LIKE '%$looking_search')");
						}
					}
					if ($s_location != '') {
						$this->db->where("(loc.loc_name LIKE '$s_location%' 
		  					OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')");
					}
				$urgentcount = $this->db->get()->row('urgentcount');
				
				$this->db->select('COUNT(*) as platinumcount', false);
        		$this->db->from('postad');
        		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
				$this->db->where("(package_type = 3 || package_type = 6) AND urgent_package = '0' AND ad_status = 1 AND expire_data >='$date'");
				if ($search_bustype) {
					if ($search_bustype != 'all') {
						$this->db->where("ad_type", $search_bustype);
					}
				}
				if ($looking_search) {
						if ($looking_search != '') {
							$this->db->where("(deal_tag LIKE '%$looking_search%' OR deal_tag LIKE '$looking_search%' OR deal_tag LIKE '%$looking_search' 
	  						OR deal_desc LIKE '%$looking_search%' OR deal_desc LIKE '$looking_search%' OR deal_desc LIKE '%$looking_search')");
						}
					}
					if ($s_location != '') {
						$this->db->where("(loc.loc_name LIKE '$s_location%' 
		  					OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')");
					}
				$this->db->get();
				$platinumcount = $this->db->last_query();

				/*urgent label expiry*/
				$this->db->select('COUNT(ud.valid_to) as platinumcount', false);
        		$this->db->from('postad');
        		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
        		$this->db->join("urgent_details AS ud", "ud.ad_id=postad.ad_id AND ud.valid_to < '".date("Y-m-d H:i:s")."'", "left");
				$this->db->where("(package_type = 3 || package_type = 6) AND urgent_package != '0' AND ad_status = 1 AND expire_data >='$date'");
				if ($search_bustype) {
					if ($search_bustype != 'all') {
						$this->db->where("ad_type", $search_bustype);
					}
				}
				if ($looking_search) {
						if ($looking_search != '') {
							$this->db->where("(deal_tag LIKE '%$looking_search%' OR deal_tag LIKE '$looking_search%' OR deal_tag LIKE '%$looking_search' 
	  						OR deal_desc LIKE '%$looking_search%' OR deal_desc LIKE '$looking_search%' OR deal_desc LIKE '%$looking_search')");
						}
					}
					if ($s_location != '') {
						$this->db->where("(loc.loc_name LIKE '$s_location%' 
		  					OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')");
					}
				$this->db->get();
				$platinumcount1 = $this->db->last_query();
				$query = $this->db->query($platinumcount." UNION ".$platinumcount1);
				$query1 = $query->result();
				$platinumsum = 0;
				foreach ($query1 as $k) {
					 $platinumsum = $platinumsum + $k->platinumcount;
				}


				$this->db->select('COUNT(*) as goldcount', false);
        		$this->db->from('postad');
        		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
				$this->db->where("(package_type = 2 || package_type = 5) AND urgent_package = '0' AND ad_status = 1 AND expire_data >='$date'");
				if ($search_bustype) {
					if ($search_bustype != 'all') {
						$this->db->where("ad_type", $search_bustype);
					}
				}
				if ($looking_search) {
						if ($looking_search != '') {
							$this->db->where("(deal_tag LIKE '%$looking_search%' OR deal_tag LIKE '$looking_search%' OR deal_tag LIKE '%$looking_search' 
	  						OR deal_desc LIKE '%$looking_search%' OR deal_desc LIKE '$looking_search%' OR deal_desc LIKE '%$looking_search')");
						}
					}
					if ($s_location != '') {
						$this->db->where("(loc.loc_name LIKE '$s_location%' 
		  					OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')");
					}
					$this->db->get();
				$goldcount = $this->db->last_query();

				/*urgent label expiry */
				$this->db->select('COUNT(ud.valid_to) as goldcount', false);
        		$this->db->from('postad');
        		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
        		$this->db->join("urgent_details AS ud", "ud.ad_id=postad.ad_id AND ud.valid_to < '".date("Y-m-d H:i:s")."'", "left");
				$this->db->where("(package_type = 2 || package_type = 5) AND urgent_package != '0' AND ad_status = 1 AND expire_data >='$date'");
				if ($search_bustype) {
					if ($search_bustype != 'all') {
						$this->db->where("ad_type", $search_bustype);
					}
				}
				if ($looking_search) {
						if ($looking_search != '') {
							$this->db->where("(deal_tag LIKE '%$looking_search%' OR deal_tag LIKE '$looking_search%' OR deal_tag LIKE '%$looking_search' 
	  						OR deal_desc LIKE '%$looking_search%' OR deal_desc LIKE '$looking_search%' OR deal_desc LIKE '%$looking_search')");
						}
					}
					if ($s_location != '') {
						$this->db->where("(loc.loc_name LIKE '$s_location%' 
		  					OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')");
					}
					$this->db->get();
				$goldcount1 = $this->db->last_query();
				$query = $this->db->query($goldcount." UNION ".$goldcount1);
				$query1 = $query->result();
				$goldsum = 0;
				foreach ($query1 as $k) {
					 $goldsum = $goldsum + $k->goldcount;
				}



				$this->db->select('COUNT(*) as freecount', false);
        		$this->db->from('postad');
        		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
        		$this->db->join("urgent_details AS ud", "ud.ad_id=postad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
				$this->db->where("(package_type = 1 || package_type = 4) AND urgent_package = '0' AND ad_status = 1 AND expire_data >='$date'");
				if ($search_bustype) {
					if ($search_bustype != 'all') {
						$this->db->where("ad_type", $search_bustype);
					}
				}
				if ($looking_search) {
						if ($looking_search != '') {
							$this->db->where("(deal_tag LIKE '%$looking_search%' OR deal_tag LIKE '$looking_search%' OR deal_tag LIKE '%$looking_search' 
	  						OR deal_desc LIKE '%$looking_search%' OR deal_desc LIKE '$looking_search%' OR deal_desc LIKE '%$looking_search')");
						}
					}
					if ($s_location != '') {
						$this->db->where("(loc.loc_name LIKE '$s_location%' 
		  					OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')");
					}
				$this->db->get();
				$freecount = $this->db->last_query();

				/*urgent label expiry free deals*/
				$this->db->select('COUNT(ud.valid_to) as freecount', false);
        		$this->db->from('postad');
        		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
        		$this->db->join("urgent_details AS ud", "ud.ad_id=postad.ad_id AND ud.valid_to < '".date("Y-m-d H:i:s")."'", "left");
				$this->db->where("(package_type = 1 || package_type = 4) AND urgent_package != '0' AND ad_status = 1 AND expire_data >='$date'");
				if ($search_bustype) {
					if ($search_bustype != 'all') {
						$this->db->where("ad_type", $search_bustype);
					}
				}
				if ($looking_search) {
						if ($looking_search != '') {
							$this->db->where("(deal_tag LIKE '%$looking_search%' OR deal_tag LIKE '$looking_search%' OR deal_tag LIKE '%$looking_search' 
	  						OR deal_desc LIKE '%$looking_search%' OR deal_desc LIKE '$looking_search%' OR deal_desc LIKE '%$looking_search')");
						}
					}
					if ($s_location != '') {
						$this->db->where("(loc.loc_name LIKE '$s_location%' 
		  					OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')");
					}
					$this->db->get();
				$freecount1 = $this->db->last_query();
				$query = $this->db->query($freecount." UNION ".$freecount1);
				$query1 = $query->result();
				$freesum = 0;
				foreach ($query1 as $k) {
					 $freesum = $freesum + $k->freecount;
				}
				$res = array('urgentcount'=>$urgentcount,
							'platinumcount'=>$platinumsum,
							'goldcount'=>$goldsum,
							'freecount'=>$freesum);
        	
        	
        	}
        	return $res;
        }

        /*job positon count*/
        public function jobpositioncnt(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad AS ad, job_details AS jd 
		WHERE ad.`ad_id`=jd.`ad_id` AND ad.ad_status = 1 AND ad.expire_data >='$data' AND jd.`positionfor` = 'Student_(Higher_Education_Graduate)')AS students,
		(SELECT COUNT(*) FROM postad AS ad, job_details AS jd 
		WHERE ad.`ad_id`=jd.`ad_id` AND ad.ad_status = 1 AND ad.expire_data >='$data' AND jd.`positionfor` = 'Entry-level')AS entrylevel,
		(SELECT COUNT(*) FROM postad AS ad, job_details AS jd 
		WHERE ad.`ad_id`=jd.`ad_id` AND ad.ad_status = 1 AND ad.expire_data >='$data' AND jd.`positionfor` = 'Expirenced_(Non-Manager)')AS nonmanager,
		(SELECT COUNT(*) FROM postad AS ad, job_details AS jd 
		WHERE ad.`ad_id`=jd.`ad_id` AND ad.ad_status = 1 AND ad.expire_data >='$data' AND jd.`positionfor` = 'Manager_(Managing_the_staff)')AS manager,
		(SELECT COUNT(*) FROM postad AS ad, job_details AS jd 
		WHERE ad.`ad_id`=jd.`ad_id` AND ad.ad_status = 1 AND ad.expire_data >='$data' AND jd.`positionfor` = 'Executive_(Director_/_Dept.Head)')AS executive");
        	$rs = $this->db->get();
        	return $rs->result();
        }

        public function category(){
        	$this->db->select();
        	$this->db->from("catergory");
        	$rs = $this->db->get();
        	return $rs->result();
        }

        public function subcat_prof_searchdeals(){
        	$looking_search = $this->session->userdata('s_looking_search'); 
        	$s_location = $this->session->userdata('s_location');
        	$search_bustype = $this->session->userdata('s_search_bustype');

        	$date = date("Y-m-d H:i:s");
        	$this->db->select("*, COUNT(postad.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        	if ($looking_search != '' && $search_bustype != 'all') {
				$this->db->join("postad", "postad.sub_scat_id = sscat.sub_subcategory_id AND postad.ad_status = 1 AND postad.expire_data >='$date' AND (postad.deal_tag LIKE '%$looking_search%' OR postad.deal_desc LIKE '%$looking_search%') AND postad.ad_type='$search_bustype' ", "left");
			}
			else if ($looking_search != '') {
				$this->db->join("postad", "postad.sub_scat_id = sscat.sub_subcategory_id AND postad.ad_status = 1 AND postad.expire_data >='$date' AND (postad.deal_tag LIKE '%$looking_search%' OR postad.deal_desc LIKE '%$looking_search%') ", "left");
			}
			else if ($search_bustype != 'all') {
				$this->db->join("postad", "postad.sub_scat_id = sscat.sub_subcategory_id AND postad.ad_status = 1 AND postad.expire_data >='$date' AND postad.ad_type='$search_bustype' ", "left");
			}
			else{
				$this->db->join("postad", "postad.sub_scat_id = sscat.sub_subcategory_id AND postad.ad_status = 1 AND postad.expire_data >='$date'", "left");
			}
			if ($s_location != '') {
				$this->db->join("location as loc", "loc.ad_id = postad.ad_id AND (loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')", "left");
			}
        	$this->db->where("sscat.sub_category_id", 9);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	return $rs->result();
        }

        public function subcat_pop_searchdeals(){
        	$looking_search = $this->session->userdata('s_looking_search'); 
        	$s_location = $this->session->userdata('s_location');
        	$search_bustype = $this->session->userdata('s_search_bustype');

        	$date = date("Y-m-d H:i:s");
        	$this->db->select("*, COUNT(postad.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        	if ($looking_search != '' && $search_bustype != 'all') {
				$this->db->join("postad", "postad.sub_scat_id = sscat.sub_subcategory_id AND postad.ad_status = 1 AND postad.expire_data >='$date' AND (postad.deal_tag LIKE '%$looking_search%' OR postad.deal_desc LIKE '%$looking_search%') AND postad.ad_type='$search_bustype' ", "left");
			}
			else if ($looking_search != '') {
				$this->db->join("postad", "postad.sub_scat_id = sscat.sub_subcategory_id AND postad.ad_status = 1 AND postad.expire_data >='$date' AND (postad.deal_tag LIKE '%$looking_search%' OR postad.deal_desc LIKE '%$looking_search%') ", "left");
			}
			else if ($search_bustype != 'all') {
				$this->db->join("postad", "postad.sub_scat_id = sscat.sub_subcategory_id AND postad.ad_status = 1 AND postad.expire_data >='$date' AND postad.ad_type='$search_bustype' ", "left");
			}
			else{
				$this->db->join("postad", "postad.sub_scat_id = sscat.sub_subcategory_id AND postad.ad_status = 1 AND postad.expire_data >='$date'", "left");
			}
			if ($s_location != '') {
				$this->db->join("location as loc", "loc.ad_id = postad.ad_id AND (loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')", "left");
			}
        	$this->db->where("sscat.sub_category_id", 10);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	return $rs->result();
        }


        public function cnt_findpropery(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '4' AND ad_status = 1 AND expire_data >='$data') AS propall,
			(SELECT COUNT(*) FROM postad WHERE category_id = '4' AND sub_cat_id=11 AND ad_status = 1 AND expire_data >='$data') AS resi,
			(SELECT COUNT(*) FROM postad WHERE category_id = '4' AND sub_cat_id=26 AND ad_status = 1 AND expire_data >='$data') AS comm");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function cnt_ezone(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '8'AND sub_cat_id=70 AND ad_status = 1 AND expire_data >='$data') AS computer,
								(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND sub_cat_id=71 AND ad_status = 1 AND expire_data >='$data') AS network,
								(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND sub_cat_id=72 AND ad_status = 1 AND expire_data >='$data') AS software");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function cnt_findpropery_hotdeal(){
        	/*top category*/
			$free = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'1','manage_likes.is_top'=>1))->row('likes_count');
			$freeurgent = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'2','manage_likes.is_top'=>1))->row('likes_count');
			$gold = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'3','manage_likes.is_top'=>1))->row('likes_count');
        	$data = date("Y-m-d H:i:s");
        	$pcktype = "((package_type = '3') OR ((package_type = '2')AND urgent_package != '0' ) OR ((package_type = '1')AND urgent_package != '0' AND likes_count >= '$freeurgent')OR ((package_type = '1')AND urgent_package = '0' AND likes_count >= '$free')OR ((package_type = '2')AND urgent_package = '0' AND likes_count >= '$gold'))";
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '4' AND ad_status = 1 AND expire_data >='$data' AND $pcktype) AS propall,
			(SELECT COUNT(*) FROM postad WHERE category_id = '4' AND sub_cat_id=11 AND ad_status = 1 AND expire_data >='$data' AND $pcktype) AS resi,
			(SELECT COUNT(*) FROM postad WHERE category_id = '4' AND sub_cat_id=26 AND ad_status = 1 AND expire_data >='$data' AND $pcktype) AS comm");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function cnt_ezone_hotdeals(){
        	/*low category*/
			$low_free = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'4','manage_likes.is_top'=>0))->row('likes_count');
			$low_freeurgent = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'5','manage_likes.is_top'=>0))->row('likes_count');
			$low_gold = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'6','manage_likes.is_top'=>0))->row('likes_count');
        	$data = date("Y-m-d H:i:s");
        	$pcktype = "((package_type = '3') OR ((package_type = '2')AND urgent_package != '0' ) OR ((package_type = '1')AND urgent_package != '0' AND likes_count >= '$low_freeurgent')OR ((package_type = '1')AND urgent_package = '0' AND likes_count >= '$low_free')OR ((package_type = '2')AND urgent_package = '0' AND likes_count >= '$low_gold'))";
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '8'AND sub_cat_id=70 AND ad_status = 1 AND expire_data >='$data' AND $pcktype) AS computer,
								(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND sub_cat_id=71 AND ad_status = 1 AND expire_data >='$data' AND $pcktype) AS network,
								(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND sub_cat_id=72 AND ad_status = 1 AND expire_data >='$data' AND $pcktype) AS software");
        	$rs = $this->db->get();
        	return $rs->result();
        }


        public function subcat_resi_searchdeals(){
        	$date = date("Y-m-d H:i:s");
        	$looking_search = $this->session->userdata('s_looking_search'); 
        	$s_location = $this->session->userdata('s_location');
        	$search_bustype = $this->session->userdata('s_search_bustype');

        	$this->db->select("*, COUNT(result.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        		if ($looking_search != '' && $search_bustype != 'all') {
					$this->db->join("(SELECT resi.* FROM postad AS ad, property_resid_commercial AS resi WHERE resi.`ad_id` = ad.`ad_id` AND ad.`ad_status` = 1 AND ad.expire_data >='$date' AND ad.ad_type='$search_bustype' AND (ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search' )) AS result", "result.property_for = sscat.`sub_subcategory_id`", "left");
				}
				else if ($looking_search != '') {
					$this->db->join("(SELECT resi.* FROM postad AS ad, property_resid_commercial AS resi WHERE resi.`ad_id` = ad.`ad_id` AND ad.`ad_status` = 1 AND ad.expire_data >='$date' AND (ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search' )) AS result", "result.property_for = sscat.`sub_subcategory_id`", "left");
				}
				else if ($search_bustype != 'all') {
					$this->db->join("(SELECT resi.* FROM postad AS ad, property_resid_commercial AS resi WHERE resi.`ad_id` = ad.`ad_id` AND ad.`ad_status` = 1 AND ad.expire_data >='$date' AND ad.ad_type='$search_bustype') AS result", "result.property_for = sscat.`sub_subcategory_id`", "left");
				}
				else{
					$this->db->join("(SELECT resi.* FROM postad AS ad, property_resid_commercial AS resi WHERE resi.`ad_id` = ad.`ad_id` AND ad.`ad_status` = 1 AND ad.expire_data >='$date') AS result", "result.property_for = sscat.`sub_subcategory_id`", "left");
				}
			if ($s_location != '') {
				$this->db->join("location as loc", "loc.ad_id = result.ad_id AND (loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')", "left");
			}
			$this->db->where("sscat.sub_category_id", 11);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	// echo $this->db->last_query(); exit;
        	return $rs->result();
        }
        public function subcat_resi_deals(){
        	$date = date("Y-m-d H:i:s");
        	$this->db->select("*, COUNT(result.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        	$this->db->join("(SELECT resi.* FROM postad AS ad, property_resid_commercial AS resi WHERE resi.`ad_id` = ad.`ad_id` AND ad.`ad_status` = 1 AND ad.expire_data >='$date') AS result", "result.property_for = sscat.`sub_subcategory_id`", "left");
			$this->db->where("sscat.sub_category_id", 11);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	// echo $this->db->last_query(); exit;
        	return $rs->result();
        }

        public function resi_sub(){
        	$date = date("Y-m-d H:i:s");
        	$looking_search = $this->session->userdata('s_looking_search'); 
        	$s_location = $this->session->userdata('s_location');
        	$search_bustype = $this->session->userdata('s_search_bustype');
        	$search_resisub = $this->session->userdata('search_resisub');

        	$this->db->select("*, COUNT(result.ad_id) AS no_ads");
        	$this->db->from("sub_sub_subcategory AS ssscat");
        		if ($looking_search != '' && $search_bustype != 'all') {
					$this->db->join("(SELECT resi.* FROM postad AS ad, property_resid_commercial AS resi WHERE resi.`ad_id` = ad.`ad_id` AND ad.`ad_status` = 1 AND ad.expire_data >='$date' AND ad.ad_type='$search_bustype' AND (ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search' )) AS result", "result.property_type = ssscat.`sub_sub_subcategory_id`", "left");
				}
				else if ($looking_search != '') {
					$this->db->join("(SELECT resi.* FROM postad AS ad, property_resid_commercial AS resi WHERE resi.`ad_id` = ad.`ad_id` AND ad.`ad_status` = 1 AND ad.expire_data >='$date' AND (ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search' )) AS result", "result.property_type = ssscat.`sub_sub_subcategory_id`", "left");
				}
				else if ($search_bustype != 'all') {
					$this->db->join("(SELECT resi.* FROM postad AS ad, property_resid_commercial AS resi WHERE resi.`ad_id` = ad.`ad_id` AND ad.`ad_status` = 1 AND ad.expire_data >='$date' AND ad.ad_type='$search_bustype') AS result", "result.property_type = ssscat.`sub_sub_subcategory_id`", "left");
				}
				else{
					$this->db->join("(SELECT resi.* FROM postad AS ad, property_resid_commercial AS resi WHERE resi.`ad_id` = ad.`ad_id` AND ad.`ad_status` = 1 AND ad.expire_data >='$date') AS result", "result.property_type = ssscat.`sub_sub_subcategory_id`", "left");
				}
			if ($s_location != '') {
				$this->db->join("location as loc", "loc.ad_id = result.ad_id AND (loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')", "left");
			}
			if($search_resisub){
				$this->db->where("ssscat.sub_subcategory_id", $search_resisub);	
			}
			
        	$this->db->group_by("ssscat.sub_sub_subcategory_id");
        	$rs = $this->db->get();
        	 // echo $this->db->last_query(); exit;
        	return $rs->result();
        }

        public function resi_sub_hotdeals(){
        	/*top category*/
			$free = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'1','manage_likes.is_top'=>1))->row('likes_count');
			$freeurgent = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'2','manage_likes.is_top'=>1))->row('likes_count');
			$gold = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'3','manage_likes.is_top'=>1))->row('likes_count');
        	$date = date("Y-m-d H:i:s");
        	$bustype = $this->session->userdata('bus_id');
			$locname = $this->session->userdata('location');
			$pcktype = "((ad.package_type = '3') OR ((ad.package_type = '2')AND ad.urgent_package != '0' ) OR ((ad.package_type = '1')AND ad.urgent_package != '0' AND ad.likes_count >= '$freeurgent')OR ((ad.package_type = '1')AND ad.urgent_package = '0' AND ad.likes_count >= '$free')OR ((ad.package_type = '2')AND ad.urgent_package = '0' AND ad.likes_count >= '$gold'))";
        	$search_resisub = $this->session->userdata('search_resisub');

        	$this->db->select("*, COUNT(result.ad_id) AS no_ads");
        	$this->db->from("sub_sub_subcategory AS ssscat");
        		if ($bustype !='all') {
	        		$this->db->join("(SELECT resi.* FROM postad AS ad, property_resid_commercial AS resi WHERE resi.`ad_id` = ad.`ad_id` AND ad.`ad_status` = 1 AND ad.expire_data >='$date' AND $pcktype AND ad.ad_type='$bustype') AS result", "result.property_type = ssscat.`sub_sub_subcategory_id`", "left");
	        	}
	        	else{
	        		$this->db->join("(SELECT resi.* FROM postad AS ad, property_resid_commercial AS resi WHERE resi.`ad_id` = ad.`ad_id` AND ad.`ad_status` = 1 AND ad.expire_data >='$date' AND $pcktype) AS result", "result.property_type = ssscat.`sub_sub_subcategory_id`", "left");
	        	}
			if ($locname != '') {
				$this->db->join("location as loc", "loc.ad_id = result.ad_id AND (loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname' OR loc.loc_name LIKE '%$locname%')", "left");
			}
			if($search_resisub){
				$this->db->where("ssscat.sub_subcategory_id", $search_resisub);	
			}			
        	$this->db->group_by("ssscat.sub_sub_subcategory_id");
        	$rs = $this->db->get();
        	 // echo $this->db->last_query(); exit;
        	return $rs->result();
        }

        public function comm_sub(){
        	$date = date("Y-m-d H:i:s");
        	$looking_search = $this->session->userdata('s_looking_search'); 
        	$s_location = $this->session->userdata('s_location');
        	$search_bustype = $this->session->userdata('s_search_bustype');
        	$search_commsub = $this->session->userdata('search_commsub');

        	$this->db->select("*, COUNT(result.ad_id) AS no_ads");
        	$this->db->from("sub_sub_subcategory AS ssscat");
        		if ($looking_search != '' && $search_bustype != 'all') {
					$this->db->join("(SELECT resi.* FROM postad AS ad, property_resid_commercial AS resi WHERE resi.`ad_id` = ad.`ad_id` AND ad.`ad_status` = 1 AND ad.expire_data >='$date' AND ad.ad_type='$search_bustype' AND (ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search' )) AS result", "result.property_type = ssscat.`sub_sub_subcategory_id`", "left");
				}
				else if ($looking_search != '') {
					$this->db->join("(SELECT resi.* FROM postad AS ad, property_resid_commercial AS resi WHERE resi.`ad_id` = ad.`ad_id` AND ad.`ad_status` = 1 AND ad.expire_data >='$date' AND (ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search' )) AS result", "result.property_type = ssscat.`sub_sub_subcategory_id`", "left");
				}
				else if ($search_bustype != 'all') {
					$this->db->join("(SELECT resi.* FROM postad AS ad, property_resid_commercial AS resi WHERE resi.`ad_id` = ad.`ad_id` AND ad.`ad_status` = 1 AND ad.expire_data >='$date' AND ad.ad_type='$search_bustype') AS result", "result.property_type = ssscat.`sub_sub_subcategory_id`", "left");
				}
				else{
					$this->db->join("(SELECT resi.* FROM postad AS ad, property_resid_commercial AS resi WHERE resi.`ad_id` = ad.`ad_id` AND ad.`ad_status` = 1 AND ad.expire_data >='$date') AS result", "result.property_type = ssscat.`sub_sub_subcategory_id`", "left");
				}
			if ($s_location != '') {
				$this->db->join("location as loc", "loc.ad_id = result.ad_id AND (loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')", "left");
			}
			if($search_commsub){
				$this->db->where("ssscat.sub_subcategory_id", $search_commsub);	
			}
			
        	$this->db->group_by("ssscat.sub_sub_subcategory_id");
        	$rs = $this->db->get();
        	 // echo $this->db->last_query(); exit;
        	return $rs->result();
        }

        public function comm_sub_hotdeals(){
        	/*top category*/
			$free = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'1','manage_likes.is_top'=>1))->row('likes_count');
			$freeurgent = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'2','manage_likes.is_top'=>1))->row('likes_count');
			$gold = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'3','manage_likes.is_top'=>1))->row('likes_count');
        	$date = date("Y-m-d H:i:s");
        	$bustype = $this->session->userdata('bus_id');
			$locname = $this->session->userdata('location');
			$pcktype = "((ad.package_type = '3') OR ((ad.package_type = '2')AND ad.urgent_package != '0' ) OR ((ad.package_type = '1')AND ad.urgent_package != '0' AND ad.likes_count >= '$freeurgent')OR ((ad.package_type = '1')AND ad.urgent_package = '0' AND ad.likes_count >= '$free')OR ((ad.package_type = '2')AND ad.urgent_package = '0' AND ad.likes_count >= '$gold'))";
        	$search_commsub = $this->session->userdata('search_commsub');
        	$this->db->select("*, COUNT(result.ad_id) AS no_ads");
        	$this->db->from("sub_sub_subcategory AS ssscat");
        		if ($bustype !='all') {
	        		$this->db->join("(SELECT resi.* FROM postad AS ad, property_resid_commercial AS resi WHERE resi.`ad_id` = ad.`ad_id` AND ad.`ad_status` = 1 AND ad.expire_data >='$date' AND $pcktype AND ad.ad_type='$bustype') AS result", "result.property_type = ssscat.`sub_sub_subcategory_id`", "left");
	        	}
	        	else{
	        		$this->db->join("(SELECT resi.* FROM postad AS ad, property_resid_commercial AS resi WHERE resi.`ad_id` = ad.`ad_id` AND ad.`ad_status` = 1 AND ad.expire_data >='$date' AND $pcktype) AS result", "result.property_type = ssscat.`sub_sub_subcategory_id`", "left");
	        	}
			if ($locname != '') {
				$this->db->join("location as loc", "loc.ad_id = result.ad_id AND (loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname' OR loc.loc_name LIKE '%$locname%')", "left");
			}		
			if($search_commsub){
				$this->db->where("ssscat.sub_subcategory_id", $search_commsub);	
			}
        	$this->db->group_by("ssscat.sub_sub_subcategory_id");
        	$rs = $this->db->get();
        	 // echo $this->db->last_query(); exit;
        	return $rs->result();
        }

        public function subcat_comm_searchdeals(){
        	$date = date("Y-m-d H:i:s");
        	$looking_search = $this->session->userdata('s_looking_search'); 
        	$s_location = $this->session->userdata('s_location');
        	$search_bustype = $this->session->userdata('s_search_bustype');
        	$this->db->select("*, COUNT(result.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        		if ($looking_search != '' && $search_bustype != 'all') {
					$this->db->join("(SELECT resi.* FROM postad AS ad, property_resid_commercial AS resi WHERE resi.`ad_id` = ad.`ad_id` AND ad.`ad_status` = 1 AND ad.expire_data >='$date' AND ad.ad_type='$search_bustype' AND (ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search' )) AS result", "result.property_for = sscat.`sub_subcategory_id`", "left");
				}
				else if ($looking_search != '') {
					$this->db->join("(SELECT resi.* FROM postad AS ad, property_resid_commercial AS resi WHERE resi.`ad_id` = ad.`ad_id` AND ad.`ad_status` = 1 AND ad.expire_data >='$date' AND (ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search' )) AS result", "result.property_for = sscat.`sub_subcategory_id`", "left");
				}
				else if ($search_bustype != 'all') {
					$this->db->join("(SELECT resi.* FROM postad AS ad, property_resid_commercial AS resi WHERE resi.`ad_id` = ad.`ad_id` AND ad.`ad_status` = 1 AND ad.expire_data >='$date' AND ad.ad_type='$search_bustype') AS result", "result.property_for = sscat.`sub_subcategory_id`", "left");
				}
				else{
					$this->db->join("(SELECT resi.* FROM postad AS ad, property_resid_commercial AS resi WHERE resi.`ad_id` = ad.`ad_id` AND ad.`ad_status` = 1 AND ad.expire_data >='$date') AS result", "result.property_for = sscat.`sub_subcategory_id`", "left");
				}
			if ($s_location != '') {
				$this->db->join("location as loc", "loc.ad_id = result.ad_id AND (loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')", "left");
			}
        	$this->db->where("sscat.sub_category_id", 26);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	// echo $this->db->last_query(); exit;
        	return $rs->result();
        }

        public function subcat_comm_deals(){
        	$date = date("Y-m-d H:i:s");
        	$this->db->select("*, COUNT(result.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        	$this->db->join("(SELECT resi.* FROM postad AS ad, property_resid_commercial AS resi WHERE resi.`ad_id` = ad.`ad_id` AND ad.`ad_status` = 1 AND ad.expire_data >='$date') AS result", "result.property_for = sscat.`sub_subcategory_id`", "left");
			$this->db->where("sscat.sub_category_id", 26);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	// echo $this->db->last_query(); exit;
        	return $rs->result();
        }

        public function subcat_pets_searchdeals(){
        	$date = date("Y-m-d H:i:s");
        	$looking_search = $this->session->userdata('s_looking_search'); 
        	$s_location = $this->session->userdata('s_location');
        	$search_bustype = $this->session->userdata('s_search_bustype');

        	$this->db->select("sub_category.*, COUNT(postad.sub_cat_id) AS no_ads");
			$this->db->from('sub_category');
				if ($looking_search != '' && $search_bustype != 'all') {
					$this->db->join("postad", "postad.sub_cat_id = sub_category.sub_category_id AND postad.ad_status = 1 AND postad.expire_data >='$date'AND postad.ad_type='$search_bustype' AND (postad.deal_tag LIKE '%$looking_search%' OR postad.deal_tag LIKE '$looking_search%' OR postad.deal_tag LIKE '%$looking_search' OR postad.deal_desc LIKE '%$looking_search%' OR postad.deal_desc LIKE '$looking_search%' OR postad.deal_desc LIKE '%$looking_search' )", "left");
				}
				else if ($looking_search != '') {
					$this->db->join("postad", "postad.sub_cat_id = sub_category.sub_category_id AND postad.ad_status = 1 AND postad.expire_data >='$date' AND (postad.deal_tag LIKE '%$looking_search%' OR postad.deal_tag LIKE '$looking_search%' OR postad.deal_tag LIKE '%$looking_search' OR postad.deal_desc LIKE '%$looking_search%' OR postad.deal_desc LIKE '$looking_search%' OR postad.deal_desc LIKE '%$looking_search' )", "left");
				}
				else if ($search_bustype != 'all') {
					$this->db->join("postad", "postad.sub_cat_id = sub_category.sub_category_id AND postad.ad_status = 1 AND postad.expire_data >='$date' AND postad.ad_type='$search_bustype'", "left");
				}
				else{
					$this->db->join("postad", "postad.sub_cat_id = sub_category.sub_category_id AND postad.ad_status = 1 AND postad.expire_data >='$date'", "left");
				}
			if ($s_location != '') {
				$this->db->join("location as loc", "loc.ad_id = postad.ad_id AND (loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')", "left");
			}
			$this->db->where('sub_category.category_id', 5);
			$this->db->group_by("sub_category.sub_category_id");
			$this->db->limit(4);
			$rs = $this->db->get();
			return $rs->result();
        }
        public function subcat_bigpets_searchdeals(){
        	$date = date("Y-m-d H:i:s");
        	$looking_search = $this->session->userdata('s_looking_search'); 
        	$s_location = $this->session->userdata('s_location');
        	$search_bustype = $this->session->userdata('s_search_bustype');

        	$this->db->select("*, COUNT(ad.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        		if ($looking_search != '' && $search_bustype != 'all') {
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id AND ad.ad_status = 1 AND ad.expire_data >='$date' AND ad.ad_type='$search_bustype' AND (ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search' )", "left");
				}
				else if ($looking_search != '') {
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id AND ad.ad_status = 1 AND ad.expire_data >='$date' AND (ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search' )", "left");
				}
				else if ($search_bustype != 'all') {
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id AND ad.ad_status = 1 AND ad.expire_data >='$date' AND ad.ad_type='$search_bustype'", "left");
				}
				else{
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id AND ad.ad_status = 1 AND ad.expire_data >='$date'", "left");
				}
			if ($s_location != '') {
				$this->db->join("location as loc", "loc.ad_id = ad.ad_id AND (loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')", "left");
			}
        	$this->db->where("sscat.sub_category_id", 5);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	return $rs->result();
        }
         public function subcat_smallpets_searchdeals(){
         	$date = date("Y-m-d H:i:s");
        	$looking_search = $this->session->userdata('s_looking_search'); 
        	$s_location = $this->session->userdata('s_location');
        	$search_bustype = $this->session->userdata('s_search_bustype');

        	$this->db->select("*, COUNT(ad.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        		if ($looking_search != '' && $search_bustype != 'all') {
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id AND ad.ad_status = 1 AND ad.expire_data >='$date' AND ad.ad_type='$search_bustype' AND (ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search' )", "left");
				}
				else if ($looking_search != '') {
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id AND ad.ad_status = 1 AND ad.expire_data >='$date' AND (ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search' )", "left");
				}
				else if ($search_bustype != 'all') {
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id AND ad.ad_status = 1 AND ad.expire_data >='$date' AND ad.ad_type='$search_bustype'", "left");
				}
				else{
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id AND ad.ad_status = 1 AND ad.expire_data >='$date'", "left");
				}
			if ($s_location != '') {
				$this->db->join("location as loc", "loc.ad_id = ad.ad_id AND (loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')", "left");
			}
        	$this->db->where("sscat.sub_category_id", 6);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	return $rs->result();
        }

        public function subcat_petsaccess_searchdeals(){
        	$date = date("Y-m-d H:i:s");
        	$looking_search = $this->session->userdata('s_looking_search'); 
        	$s_location = $this->session->userdata('s_location');
        	$search_bustype = $this->session->userdata('s_search_bustype');

        	$this->db->select("*, COUNT(ad.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        		if ($looking_search != '' && $search_bustype != 'all') {
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id AND ad.ad_status = 1 AND ad.expire_data >='$date' AND ad.ad_type='$search_bustype' AND (ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search' )", "left");
				}
				else if ($looking_search != '') {
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id AND ad.ad_status = 1 AND ad.expire_data >='$date' AND (ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search' )", "left");
				}
				else if ($search_bustype != 'all') {
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id AND ad.ad_status = 1 AND ad.expire_data >='$date' AND ad.ad_type='$search_bustype'", "left");
				}
				else{
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id AND ad.ad_status = 1 AND ad.expire_data >='$date'", "left");
				}
			if ($s_location != '') {
				$this->db->join("location as loc", "loc.ad_id = ad.ad_id AND (loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')", "left");
			}
        	$this->db->where("sscat.sub_category_id", 7);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	return $rs->result();
        }

        /*cloths sub sub*/
        /*women*/
        public function subcat_women_searchdeals(){
        	$date = date("Y-m-d H:i:s");
        	$looking_search = $this->session->userdata('s_looking_search'); 
        	$s_location = $this->session->userdata('s_location');
        	$search_bustype = $this->session->userdata('s_search_bustype');

        	$this->db->select("*, COUNT(ad.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        		if ($looking_search != '' && $search_bustype != 'all') {
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND ad.ad_type='$search_bustype' AND (ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search' )", "left");
				}
				else if ($looking_search != '') {
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND (ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search' )", "left");
				}
				else if ($search_bustype != 'all') {
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND ad.ad_type='$search_bustype' ", "left");
				}
				else{
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' ", "left");
				}
			if ($s_location != '') {
				$this->db->join("location as loc", "loc.ad_id = ad.ad_id AND (loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')", "left");
			}
        	$this->db->where("sscat.sub_category_id", 20);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        /*men*/
        public function subcat_men_searchdeals(){
        	$date = date("Y-m-d H:i:s");
        	$looking_search = $this->session->userdata('s_looking_search'); 
        	$s_location = $this->session->userdata('s_location');
        	$search_bustype = $this->session->userdata('s_search_bustype');
        	$this->db->select("*, COUNT(ad.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        		if ($looking_search != '' && $search_bustype != 'all') {
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND ad.ad_type='$search_bustype' AND (ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search' )", "left");
				}
				else if ($looking_search != '') {
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND (ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search' )", "left");
				}
				else if ($search_bustype != 'all') {
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND ad.ad_type='$search_bustype' ", "left");
				}
				else{
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' ", "left");
				}
			if ($s_location != '') {
				$this->db->join("location as loc", "loc.ad_id = ad.ad_id AND (loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')", "left");
			}
        	$this->db->where("sscat.sub_category_id", 21);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        /*boy*/
        public function subcat_boy_searchdeals(){
        	$date = date("Y-m-d H:i:s");
        	$looking_search = $this->session->userdata('s_looking_search'); 
        	$s_location = $this->session->userdata('s_location');
        	$search_bustype = $this->session->userdata('s_search_bustype');
        	$this->db->select("*, COUNT(ad.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        		if ($looking_search != '' && $search_bustype != 'all') {
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND ad.ad_type='$search_bustype' AND (ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search' )", "left");
				}
				else if ($looking_search != '') {
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND (ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search' )", "left");
				}
				else if ($search_bustype != 'all') {
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND ad.ad_type='$search_bustype' ", "left");
				}
				else{
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' ", "left");
				}
			if ($s_location != '') {
				$this->db->join("location as loc", "loc.ad_id = ad.ad_id AND (loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')", "left");
			}
        	$this->db->where("sscat.sub_category_id", 22);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	return $rs->result();
        }
         /*girl*/
        public function subcat_girl_searchdeals(){
        	$date = date("Y-m-d H:i:s");
        	$looking_search = $this->session->userdata('s_looking_search'); 
        	$s_location = $this->session->userdata('s_location');
        	$search_bustype = $this->session->userdata('s_search_bustype');
        	$this->db->select("*, COUNT(ad.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        	if ($looking_search != '' && $search_bustype != 'all') {
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND ad.ad_type='$search_bustype' AND (ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search' )", "left");
				}
				else if ($looking_search != '') {
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND (ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search' )", "left");
				}
				else if ($search_bustype != 'all') {
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND ad.ad_type='$search_bustype' ", "left");
				}
				else{
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' ", "left");
				}
			if ($s_location != '') {
				$this->db->join("location as loc", "loc.ad_id = ad.ad_id AND (loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')", "left");
			}
        	$this->db->where("sscat.sub_category_id", 23);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	return $rs->result();
        }
         /*bboy*/
        public function subcat_bboy_searchdeals(){
        	$date = date("Y-m-d H:i:s");
        	$looking_search = $this->session->userdata('s_looking_search'); 
        	$s_location = $this->session->userdata('s_location');
        	$search_bustype = $this->session->userdata('s_search_bustype');
        	$this->db->select("*, COUNT(ad.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        	if ($looking_search != '' && $search_bustype != 'all') {
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND ad.ad_type='$search_bustype' AND (ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search' )", "left");
				}
				else if ($looking_search != '') {
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND (ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search' )", "left");
				}
				else if ($search_bustype != 'all') {
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND ad.ad_type='$search_bustype' ", "left");
				}
				else{
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' ", "left");
				}
			if ($s_location != '') {
				$this->db->join("location as loc", "loc.ad_id = ad.ad_id AND (loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')", "left");
			}
        	$this->db->where("sscat.sub_category_id", 24);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	return $rs->result();
        }
         /*bgirl*/
        public function subcat_bgirl_searchdeals(){
        	$date = date("Y-m-d H:i:s");
        	$looking_search = $this->session->userdata('s_looking_search'); 
        	$s_location = $this->session->userdata('s_location');
        	$search_bustype = $this->session->userdata('s_search_bustype');
        	$this->db->select("*, COUNT(ad.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        	if ($looking_search != '' && $search_bustype != 'all') {
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND ad.ad_type='$search_bustype' AND (ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search' )", "left");
				}
				else if ($looking_search != '') {
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND (ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search' )", "left");
				}
				else if ($search_bustype != 'all') {
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND ad.ad_type='$search_bustype' ", "left");
				}
				else{
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' ", "left");
				}
			if ($s_location != '') {
				$this->db->join("location as loc", "loc.ad_id = ad.ad_id AND (loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')", "left");
			}
        	$this->db->where("sscat.sub_category_id", 25);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	return $rs->result();
        }

        /*home and kitchen*/
        /*kitchen*/
        public function subcat_kitchen_searchdeals(){
        	$date = date("Y-m-d H:i:s");
        	$looking_search = $this->session->userdata('s_looking_search'); 
        	$s_location = $this->session->userdata('s_location');
        	$search_bustype = $this->session->userdata('s_search_bustype');
        	$this->db->select("*, COUNT(ad.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        		
				if ($looking_search != '' && $search_bustype != 'all') {
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND ad.ad_type='$search_bustype' AND (ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search' )", "left");
				}
				else if ($looking_search != '') {
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND (ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search' )", "left");
				}
				else if ($search_bustype != 'all') {
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND ad.ad_type='$search_bustype'", "left");
				}
				else{
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date'", "left");
				}
			if ($s_location != '') {
				$this->db->join("location as loc", "loc.ad_id = ad.ad_id AND (loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')", "left");
			}
        	$this->db->where("sscat.sub_category_id", 67);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        /*home*/
        public function subcat_home_searchdeals(){
        	$date = date("Y-m-d H:i:s");
        	$looking_search = $this->session->userdata('s_looking_search'); 
        	$s_location = $this->session->userdata('s_location');
        	$search_bustype = $this->session->userdata('s_search_bustype');
        	$this->db->select("*, COUNT(ad.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        	if ($looking_search != '' && $search_bustype != 'all') {
				$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND ad.ad_type='$search_bustype' AND (ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search' )", "left");
			}
			else if ($looking_search != '') {
				$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND (ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search' )", "left");
			}
			else if ($search_bustype != 'all') {
				$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND ad.ad_type='$search_bustype'", "left");
			}
			else{
				$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date'", "left");
			}
			if ($s_location != '') {
				$this->db->join("location as loc", "loc.ad_id = ad.ad_id AND (loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')", "left");
			}
        	$this->db->where("sscat.sub_category_id", 68);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        /*decor*/
        public function subcat_decor_searchdeals(){
        	$date = date("Y-m-d H:i:s");
        	$looking_search = $this->session->userdata('s_looking_search'); 
        	$s_location = $this->session->userdata('s_location');
        	$search_bustype = $this->session->userdata('s_search_bustype');
        	$this->db->select("*, COUNT(ad.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        	if ($looking_search != '' && $search_bustype != 'all') {
				$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND ad.ad_type='$search_bustype' AND (ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search' )", "left");
			}
			else if ($looking_search != '') {
				$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND (ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search' )", "left");
			}
			else if ($search_bustype != 'all') {
				$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND ad.ad_type='$search_bustype'", "left");
			}
			else{
				$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date'", "left");
			}
			if ($s_location != '') {
				$this->db->join("location as loc", "loc.ad_id = ad.ad_id AND (loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')", "left");
			}
        	$this->db->where("sscat.sub_category_id", 69);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	return $rs->result();
        }

        /*ezone sub sub*/
        /*phone tablets*/
        public function subcat_phone_searchdeals(){
        	$date = date("Y-m-d H:i:s");
        	$looking_search = $this->session->userdata('s_looking_search'); 
        	$s_location = $this->session->userdata('s_location');
        	$search_bustype = $this->session->userdata('s_search_bustype');
        	$this->db->select("*, COUNT(ad.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        		
				if ($looking_search != '' && $search_bustype != 'all') {
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND ad.ad_type='$search_bustype' AND (ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search' )", "left");
				}
				else if ($looking_search != '') {
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND (ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search' )", "left");
				}
				else if ($search_bustype != 'all') {
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND ad.ad_type='$search_bustype'", "left");
				}
				else{
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date'", "left");
				}
			if ($s_location != '') {
				$this->db->join("location as loc", "loc.ad_id = ad.ad_id AND (loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')", "left");
			}
        	
        	$this->db->where("sscat.sub_category_id", 59);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        /*home apps*/
        public function subcat_homeapp_searchdeals(){
        	$date = date("Y-m-d H:i:s");
        	$looking_search = $this->session->userdata('s_looking_search'); 
        	$s_location = $this->session->userdata('s_location');
        	$search_bustype = $this->session->userdata('s_search_bustype');
        	$this->db->select("*, COUNT(ad.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        	if ($looking_search != '' && $search_bustype != 'all') {
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND ad.ad_type='$search_bustype' AND (ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search' )", "left");
				}
				else if ($looking_search != '') {
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND (ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search' )", "left");
				}
				else if ($search_bustype != 'all') {
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND ad.ad_type='$search_bustype'", "left");
				}
				else{
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date'", "left");
				}
			if ($s_location != '') {
				$this->db->join("location as loc", "loc.ad_id = ad.ad_id AND (loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')", "left");
			}
        	$this->db->where("sscat.sub_category_id", 60);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        /*small apps*/
        public function subcat_smallapp_searchdeals(){
        	$date = date("Y-m-d H:i:s");
        	$looking_search = $this->session->userdata('s_looking_search'); 
        	$s_location = $this->session->userdata('s_location');
        	$search_bustype = $this->session->userdata('s_search_bustype');
        	$this->db->select("*, COUNT(ad.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        	if ($looking_search != '' && $search_bustype != 'all') {
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND ad.ad_type='$search_bustype' AND (ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search' )", "left");
				}
				else if ($looking_search != '') {
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND (ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search' )", "left");
				}
				else if ($search_bustype != 'all') {
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND ad.ad_type='$search_bustype'", "left");
				}
				else{
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date'", "left");
				}
			if ($s_location != '') {
				$this->db->join("location as loc", "loc.ad_id = ad.ad_id AND (loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')", "left");
			}
        	$this->db->where("sscat.sub_category_id", 61);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        /*laptop apps*/
        public function subcat_lappy_searchdeals(){
        	$date = date("Y-m-d H:i:s");
        	$looking_search = $this->session->userdata('s_looking_search'); 
        	$s_location = $this->session->userdata('s_location');
        	$search_bustype = $this->session->userdata('s_search_bustype');
        	$this->db->select("*, COUNT(ad.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        	if ($looking_search != '' && $search_bustype != 'all') {
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND ad.ad_type='$search_bustype' AND (ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search' )", "left");
				}
				else if ($looking_search != '') {
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND (ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search' )", "left");
				}
				else if ($search_bustype != 'all') {
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND ad.ad_type='$search_bustype'", "left");
				}
				else{
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date'", "left");
				}
			if ($s_location != '') {
				$this->db->join("location as loc", "loc.ad_id = ad.ad_id AND (loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')", "left");
			}
        	$this->db->where("sscat.sub_category_id", 62);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        /*accessories*/
        public function subcat_access_searchdeals(){
        	$date = date("Y-m-d H:i:s");
        	$looking_search = $this->session->userdata('s_looking_search'); 
        	$s_location = $this->session->userdata('s_location');
        	$search_bustype = $this->session->userdata('s_search_bustype');
        	$this->db->select("*, COUNT(ad.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        	if ($looking_search != '' && $search_bustype != 'all') {
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND ad.ad_type='$search_bustype' AND (ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search' )", "left");
				}
				else if ($looking_search != '') {
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND (ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search' )", "left");
				}
				else if ($search_bustype != 'all') {
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND ad.ad_type='$search_bustype'", "left");
				}
				else{
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date'", "left");
				}
			if ($s_location != '') {
				$this->db->join("location as loc", "loc.ad_id = ad.ad_id AND (loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')", "left");
			}
        	$this->db->where("sscat.sub_category_id", 63);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	return $rs->result();
        }
       	/*personal care*/
        public function subcat_pcare_searchdeals(){
        	$date = date("Y-m-d H:i:s");
        	$looking_search = $this->session->userdata('s_looking_search'); 
        	$s_location = $this->session->userdata('s_location');
        	$search_bustype = $this->session->userdata('s_search_bustype');
        	$this->db->select("*, COUNT(ad.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        	if ($looking_search != '' && $search_bustype != 'all') {
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND ad.ad_type='$search_bustype' AND (ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search' )", "left");
				}
				else if ($looking_search != '') {
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND (ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search' )", "left");
				}
				else if ($search_bustype != 'all') {
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND ad.ad_type='$search_bustype'", "left");
				}
				else{
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date'", "left");
				}
			if ($s_location != '') {
				$this->db->join("location as loc", "loc.ad_id = ad.ad_id AND (loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')", "left");
			}
        	$this->db->where("sscat.sub_category_id", 64);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	return $rs->result();
        }
         /*home entertainment*/
        public function subcat_henter_searchdeals(){
        	$date = date("Y-m-d H:i:s");
        	$looking_search = $this->session->userdata('s_looking_search'); 
        	$s_location = $this->session->userdata('s_location');
        	$search_bustype = $this->session->userdata('s_search_bustype');
        	$this->db->select("*, COUNT(ad.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        	if ($looking_search != '' && $search_bustype != 'all') {
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND ad.ad_type='$search_bustype' AND (ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search' )", "left");
				}
				else if ($looking_search != '') {
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND (ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search' )", "left");
				}
				else if ($search_bustype != 'all') {
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND ad.ad_type='$search_bustype'", "left");
				}
				else{
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date'", "left");
				}
			if ($s_location != '') {
				$this->db->join("location as loc", "loc.ad_id = ad.ad_id AND (loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')", "left");
			}
        	$this->db->where("sscat.sub_category_id", 65);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        /*Photography*/
        public function subcat_pgraphy_searchdeals(){
        	$date = date("Y-m-d H:i:s");
        	$looking_search = $this->session->userdata('s_looking_search'); 
        	$s_location = $this->session->userdata('s_location');
        	$search_bustype = $this->session->userdata('s_search_bustype');
        	$this->db->select("*, COUNT(ad.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        	if ($looking_search != '' && $search_bustype != 'all') {
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND ad.ad_type='$search_bustype' AND (ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search' )", "left");
				}
				else if ($looking_search != '') {
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND (ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search' )", "left");
				}
				else if ($search_bustype != 'all') {
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND ad.ad_type='$search_bustype'", "left");
				}
				else{
					$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date'", "left");
				}
			if ($s_location != '') {
				$this->db->join("location as loc", "loc.ad_id = ad.ad_id AND (loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')", "left");
			}
        	$this->db->where("sscat.sub_category_id", 66);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	return $rs->result();
        }

        /*motor point*/
        /*cars*/
        public function subcat_cars_searchdeals(){
        	$date = date("Y-m-d H:i:s");
        	$looking_search = $this->session->userdata('s_looking_search'); 
        	$s_location = $this->session->userdata('s_location');

        	$this->db->select("*, COUNT(result.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        	if ($looking_search) {
				if ($looking_search != '') {
					$this->db->join("(SELECT cars.* FROM `postad` AS ad, `motor_car_van_bus_ads` AS cars WHERE cars.`ad_id` = ad.`ad_id` AND ad.ad_status = 1 AND ad.expire_data >='$date' AND (ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search' )) AS result", "result.manufacture = sscat.sub_subcategory_id", "left");
				}
				else{
					$this->db->join("(SELECT cars.* FROM `postad` AS ad, `motor_car_van_bus_ads` AS cars WHERE cars.`ad_id` = ad.`ad_id` AND ad.ad_status = 1 AND ad.expire_data >='$date') AS result", "result.manufacture = sscat.sub_subcategory_id", "left");
				}
			}
			else{
				$this->db->join("(SELECT cars.* FROM `postad` AS ad, `motor_car_van_bus_ads` AS cars WHERE cars.`ad_id` = ad.`ad_id` AND ad.ad_status = 1 AND ad.expire_data >='$date') AS result", "result.manufacture = sscat.sub_subcategory_id", "left");
			}
			if ($s_location != '') {
				$this->db->join("location as loc", "loc.ad_id = result.ad_id AND (loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')", "left");
			}
        	$this->db->where("sscat.sub_category_id", 12);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	return $rs->result();
        }

        /*bikes*/
        public function subcat_bikes_searchdeals(){
        	$date = date("Y-m-d H:i:s");
        	$looking_search = $this->session->userdata('s_looking_search'); 
        	$s_location = $this->session->userdata('s_location');

        	$this->db->select("*, COUNT(result.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        	if ($looking_search) {
				if ($looking_search != '') {
					$this->db->join("(SELECT bikes.* FROM `postad` AS ad, `motor_bike_ads` AS bikes	WHERE bikes.`ad_id` = ad.`ad_id` AND ad.ad_status = 1 AND ad.expire_data >='$date' AND (ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search' )) AS result", "result.manufacture = sscat.sub_subcategory_id", "left");
				}
				else{
					$this->db->join("(SELECT bikes.* FROM `postad` AS ad, `motor_bike_ads` AS bikes	WHERE bikes.`ad_id` = ad.`ad_id` AND ad.ad_status = 1 AND ad.expire_data >='$date') AS result", "result.manufacture = sscat.sub_subcategory_id", "left");
				}
			}
			else{
				$this->db->join("(SELECT bikes.* FROM `postad` AS ad, `motor_bike_ads` AS bikes	WHERE bikes.`ad_id` = ad.`ad_id` AND ad.ad_status = 1 AND ad.expire_data >='$date') AS result", "result.manufacture = sscat.sub_subcategory_id", "left");
			}
			if ($s_location != '') {
				$this->db->join("location as loc", "loc.ad_id = result.ad_id AND (loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')", "left");
			}
        	$this->db->where("sscat.sub_category_id", 13);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	 // echo $this->db->last_query(); exit;
        	return $rs->result();
        }

        /*motor homes*/
        public function subcat_motorhomes_searchdeals(){
        	$date = date("Y-m-d H:i:s");
        	$looking_search = $this->session->userdata('s_looking_search'); 
        	$s_location = $this->session->userdata('s_location');

        	$this->db->select("*, COUNT(result.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        	if ($looking_search) {
				if ($looking_search != '') {
					$this->db->join("(SELECT mh.* FROM `postad` AS ad, `motor_home_ads` AS mh WHERE mh.`ad_id` = ad.`ad_id` AND ad.ad_status = 1 AND ad.expire_data >='$date' AND (ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search' )) AS result", "result.manufacture = sscat.sub_subcategory_id", "left");
				}
				else{
					$this->db->join("(SELECT mh.* FROM `postad` AS ad, `motor_home_ads` AS mh WHERE mh.`ad_id` = ad.`ad_id` AND ad.ad_status = 1 AND ad.expire_data >='$date') AS result", "result.manufacture = sscat.sub_subcategory_id", "left");
				}
			}
			else{
				$this->db->join("(SELECT mh.* FROM `postad` AS ad, `motor_home_ads` AS mh WHERE mh.`ad_id` = ad.`ad_id` AND ad.ad_status = 1 AND ad.expire_data >='$date') AS result", "result.manufacture = sscat.sub_subcategory_id", "left");
			}
			if ($s_location != '') {
				$this->db->join("location as loc", "loc.ad_id = result.ad_id AND (loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')", "left");
			}
        	$this->db->where("sscat.sub_category_id", 14);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	 // echo $this->db->last_query(); exit;
        	return $rs->result();
        }
        /*vans*/
        public function subcat_vans_searchdeals(){
        	$date = date("Y-m-d H:i:s");
        	$looking_search = $this->session->userdata('s_looking_search'); 
        	$s_location = $this->session->userdata('s_location');

        	$this->db->select("*, COUNT(result.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        	if ($looking_search) {
				if ($looking_search != '') {
					$this->db->join("(SELECT cars.* FROM `postad` AS ad, `motor_car_van_bus_ads` AS cars WHERE cars.`ad_id` = ad.`ad_id` AND ad.ad_status = 1 AND ad.expire_data >='$date' AND (ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search' )) AS result", "result.manufacture = sscat.sub_subcategory_id", "left");
				}
				else{
					$this->db->join("(SELECT cars.* FROM `postad` AS ad, `motor_car_van_bus_ads` AS cars WHERE cars.`ad_id` = ad.`ad_id` AND ad.ad_status = 1 AND ad.expire_data >='$date') AS result", "result.manufacture = sscat.sub_subcategory_id", "left");
				}
			}
			else{
				$this->db->join("(SELECT cars.* FROM `postad` AS ad, `motor_car_van_bus_ads` AS cars WHERE cars.`ad_id` = ad.`ad_id` AND ad.ad_status = 1 AND ad.expire_data >='$date') AS result", "result.manufacture = sscat.sub_subcategory_id", "left");
			}
			if ($s_location != '') {
				$this->db->join("location as loc", "loc.ad_id = result.ad_id AND (loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')", "left");
			}
			$this->db->where("sscat.sub_category_id", 15);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	// echo $this->db->last_query(); exit;
        	return $rs->result();
        }
        /*coaches buses*/
        public function subcat_buses_searchdeals(){
        	$date = date("Y-m-d H:i:s");
        	$looking_search = $this->session->userdata('s_looking_search'); 
        	$s_location = $this->session->userdata('s_location');

        	$this->db->select("*, COUNT(result.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        	if ($looking_search) {
				if ($looking_search != '') {
					$this->db->join("(SELECT cars.* FROM `postad` AS ad, `motor_car_van_bus_ads` AS cars WHERE cars.`ad_id` = ad.`ad_id` AND ad.ad_status = 1 AND ad.expire_data >='$date' AND (ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search' )) AS result", "result.manufacture = sscat.sub_subcategory_id", "left");
				}
				else{
					$this->db->join("(SELECT cars.* FROM `postad` AS ad, `motor_car_van_bus_ads` AS cars WHERE cars.`ad_id` = ad.`ad_id` AND ad.ad_status = 1 AND ad.expire_data >='$date') AS result", "result.manufacture = sscat.sub_subcategory_id", "left");
				}
			}
			else{
				$this->db->join("(SELECT cars.* FROM `postad` AS ad, `motor_car_van_bus_ads` AS cars WHERE cars.`ad_id` = ad.`ad_id` AND ad.ad_status = 1 AND ad.expire_data >='$date') AS result", "result.manufacture = sscat.sub_subcategory_id", "left");
			}
			if ($s_location != '') {
				$this->db->join("location as loc", "loc.ad_id = result.ad_id AND (loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')", "left");
			}
			$this->db->where("sscat.sub_category_id", 16);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	// echo $this->db->last_query(); exit;
        	return $rs->result();
        }
        /*plant machinery*/
        public function subcat_plant_searchdeals(){
        	$date = date("Y-m-d H:i:s");
        	$looking_search = $this->session->userdata('s_looking_search'); 
        	$s_location = $this->session->userdata('s_location');

        	$this->db->select("*, COUNT(result.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        	if ($looking_search) {
				if ($looking_search != '') {
					$this->db->join("(SELECT pf.* FROM `postad` AS ad, `motor_plant_farming` AS pf WHERE pf.`ad_id` = ad.`ad_id` AND ad.ad_status = 1 AND ad.expire_data >='$date' AND (ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search' )) AS result", "result.manufacture = sscat.sub_subcategory_id", "left");
				}
				else{
					$this->db->join("(SELECT pf.* FROM `postad` AS ad, `motor_plant_farming` AS pf WHERE pf.`ad_id` = ad.`ad_id` AND ad.ad_status = 1 AND ad.expire_data >='$date') AS result", "result.manufacture = sscat.sub_subcategory_id", "left");
				}
			}
			else{
					$this->db->join("(SELECT pf.* FROM `postad` AS ad, `motor_plant_farming` AS pf WHERE pf.`ad_id` = ad.`ad_id` AND ad.ad_status = 1 AND ad.expire_data >='$date') AS result", "result.manufacture = sscat.sub_subcategory_id", "left");
			}
			if ($s_location != '') {
				$this->db->join("location as loc", "loc.ad_id = result.ad_id AND (loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')", "left");
			}
			$this->db->where("sscat.sub_category_id", 17);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	// echo $this->db->last_query(); exit;
        	return $rs->result();
        }

        /*farming vehicles*/
        public function subcat_farming_searchdeals(){
        	$date = date("Y-m-d H:i:s");
        	$looking_search = $this->session->userdata('s_looking_search'); 
        	$s_location = $this->session->userdata('s_location');

        	$this->db->select("*, COUNT(result.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        	if ($looking_search) {
				if ($looking_search != '') {
					$this->db->join("(SELECT pf.* FROM `postad` AS ad, `motor_plant_farming` AS pf WHERE pf.`ad_id` = ad.`ad_id` AND ad.ad_status = 1 AND ad.expire_data >='$date' AND (ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search' )) AS result", "result.manufacture = sscat.sub_subcategory_id", "left");
				}
				else{
					$this->db->join("(SELECT pf.* FROM `postad` AS ad, `motor_plant_farming` AS pf WHERE pf.`ad_id` = ad.`ad_id` AND ad.ad_status = 1 AND ad.expire_data >='$date') AS result", "result.manufacture = sscat.sub_subcategory_id", "left");
				}
			}
			else{
					$this->db->join("(SELECT pf.* FROM `postad` AS ad, `motor_plant_farming` AS pf WHERE pf.`ad_id` = ad.`ad_id` AND ad.ad_status = 1 AND ad.expire_data >='$date') AS result", "result.manufacture = sscat.sub_subcategory_id", "left");
			}
			if ($s_location != '') {
				$this->db->join("location as loc", "loc.ad_id = result.ad_id AND (loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')", "left");
			}
        	$this->db->where("sscat.sub_category_id", 18);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	// echo $this->db->last_query(); exit;
        	return $rs->result();
        }
        /*boating */
        public function subcat_boats_searchdeals(){
        	$date = date("Y-m-d H:i:s");
        	$looking_search = $this->session->userdata('s_looking_search'); 
        	$s_location = $this->session->userdata('s_location');

        	$this->db->select("*, COUNT(result.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        	if ($looking_search) {
				if ($looking_search != '') {
					$this->db->join("(SELECT mb.* FROM `postad` AS ad, `motor_boats` AS mb WHERE mb.`ad_id` = ad.`ad_id` AND ad.ad_status = 1 AND ad.expire_data >='$date' AND (ad.deal_tag LIKE '%$looking_search%' OR ad.deal_tag LIKE '$looking_search%' OR ad.deal_tag LIKE '%$looking_search' OR ad.deal_desc LIKE '%$looking_search%' OR ad.deal_desc LIKE '$looking_search%' OR ad.deal_desc LIKE '%$looking_search' )) AS result", "result.manufacture = sscat.sub_subcategory_id", "left");
				}
				else{
					$this->db->join("(SELECT mb.* FROM `postad` AS ad, `motor_boats` AS mb WHERE mb.`ad_id` = ad.`ad_id` AND ad.ad_status = 1 AND ad.expire_data >='$date') AS result", "result.manufacture = sscat.sub_subcategory_id", "left");
				}
			}
			else{
					$this->db->join("(SELECT mb.* FROM `postad` AS ad, `motor_boats` AS mb WHERE mb.`ad_id` = ad.`ad_id` AND ad.ad_status = 1 AND ad.expire_data >='$date') AS result", "result.manufacture = sscat.sub_subcategory_id", "left");
			}
			if ($s_location != '') {
				$this->db->join("location as loc", "loc.ad_id = result.ad_id AND (loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '$s_location%' OR loc.loc_name LIKE '%$s_location%')", "left");
			}
			$this->db->where("sscat.sub_category_id", 19);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	// echo $this->db->last_query(); exit;
        	return $rs->result();
        }

        public function jobs_hotdeals(){
        	/*top category*/
			$free = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'1','manage_likes.is_top'=>1))->row('likes_count');
			$freeurgent = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'2','manage_likes.is_top'=>1))->row('likes_count');
			$gold = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'3','manage_likes.is_top'=>1))->row('likes_count');
        		$date = date("Y-m-d H:i:s");
        		$bustype = $this->session->userdata('bus_id');
        		$locname = $this->session->userdata('location');
				$cat_id =  $this->session->userdata('cat_id');
				$this->db->select("sub_category.*, COUNT(postad.sub_cat_id) AS no_ads");
				$this->db->from('sub_category');
				if ($bustype) {
		        	if ($bustype !='all') {
		        		$this->db->join("postad", "postad.sub_cat_id = sub_category.sub_category_id AND postad.ad_status = 1 AND postad.expire_data >='$date' AND postad.ad_type ='$bustype' AND ((postad.package_type = '3' OR postad.package_type = '6') OR ((postad.package_type = '2' OR postad.package_type = '5' )AND postad.urgent_package != '0') OR ((postad.package_type = '1' OR postad.package_type = '4' )AND postad.urgent_package != '0' AND postad.likes_count >= '$freeurgent') OR ((postad.package_type = '1' OR postad.package_type = '4' )AND postad.urgent_package = '0' AND postad.likes_count >= '$free')OR ((postad.package_type = '2' OR postad.package_type = '5' )AND postad.urgent_package = '0' AND postad.likes_count >= '$gold'))", "left");
		        	}
		        	else{
		        		$this->db->join("postad", "postad.sub_cat_id = sub_category.sub_category_id AND postad.ad_status = 1 AND postad.expire_data >='$date' AND ((postad.package_type = '3' OR postad.package_type = '6') OR ((postad.package_type = '2' OR postad.package_type = '5' )AND postad.urgent_package != '0') OR ((postad.package_type = '1' OR postad.package_type = '4' )AND postad.urgent_package != '0' AND postad.likes_count >= '$freeurgent') OR ((postad.package_type = '1' OR postad.package_type = '4' )AND postad.urgent_package = '0' AND postad.likes_count >= '$free')OR ((postad.package_type = '2' OR postad.package_type = '5' )AND postad.urgent_package = '0' AND postad.likes_count >= '$gold'))", "left");
		        	}
		        }
		        else{
	        		$this->db->join("postad", "postad.sub_cat_id = sub_category.sub_category_id AND postad.ad_status = 1 AND postad.expire_data >='$date' AND ((postad.package_type = '3' OR postad.package_type = '6') OR ((postad.package_type = '2' OR postad.package_type = '5' )AND postad.urgent_package != '0') OR ((postad.package_type = '1' OR postad.package_type = '4' )AND postad.urgent_package != '0' AND postad.likes_count >= '$freeurgent') OR ((postad.package_type = '1' OR postad.package_type = '4' )AND postad.urgent_package = '0' AND postad.likes_count >= '$free')OR ((postad.package_type = '2' OR postad.package_type = '5' )AND postad.urgent_package = '0' AND postad.likes_count >= '$gold'))", "left");
	        	}

	        	if ($locname != '') {
					$this->db->join("location as loc", "loc.ad_id = postad.ad_id AND (loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname' OR loc.loc_name LIKE '%$locname%')", "left");
				}
				
				$this->db->where('sub_category.category_id', 1);
				$this->db->group_by("sub_category.sub_category_id");
				$rs = $this->db->get();
				 // echo $this->db->last_query(); exit;
				return $rs->result();
			}

			public function hotdeals_pck_hotdeals(){
				/*top category*/
			$free = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'1','manage_likes.is_top'=>1))->row('likes_count');
			$freeurgent = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'2','manage_likes.is_top'=>1))->row('likes_count');
			$gold = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'3','manage_likes.is_top'=>1))->row('likes_count');

			/*low category*/
			$low_free = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'4','manage_likes.is_top'=>0))->row('likes_count');
			$low_freeurgent = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'5','manage_likes.is_top'=>0))->row('likes_count');
			$low_gold = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'6','manage_likes.is_top'=>0))->row('likes_count');

				$date = date("Y-m-d H:i:s");
        	$cat_id =  $this->session->userdata('cat_id');
        	$bustype = $this->session->userdata('bus_id');
        	$locname = $this->session->userdata('location');
        	if ($cat_id == 1 || $cat_id == 2 || $cat_id == 3 || $cat_id == 4) {
        	$pcktype = '((postad.package_type = "3" OR postad.package_type = "6") OR ((postad.package_type = "2" OR postad.package_type = "5" )AND postad.urgent_package != "0" ) OR ((postad.package_type = "1" OR postad.package_type = "4" )AND postad.urgent_package != "0" AND postad.likes_count >= "'.$freeurgent.'") OR ((postad.package_type = "1" OR postad.package_type = "4" )AND postad.urgent_package = "0" AND postad.likes_count >= "'.$free.'") OR ((postad.package_type = "2" OR postad.package_type = "5" )AND postad.urgent_package = "0" AND postad.likes_count >= "'.$gold.'"))';
        	}
        	else{
        	$pcktype = '((postad.package_type = "3" OR postad.package_type = "6") OR ((postad.package_type = "2" OR postad.package_type = "5" )AND postad.urgent_package != "0" ) OR ((postad.package_type = "1" OR postad.package_type = "4" )AND postad.urgent_package != "0" AND postad.likes_count >= "'.$low_freeurgent.'") OR ((postad.package_type = "1" OR postad.package_type = "4" )AND postad.urgent_package = "0" AND postad.likes_count >= "'.$low_free.'") OR ((postad.package_type = "2" OR postad.package_type = "5" )AND postad.urgent_package = "0" AND postad.likes_count >= "'.$low_gold.'"))';
        	}
        	if ($cat_id != 'all') {
        		if ($cat_id == 1 || $cat_id == 2 || $cat_id == 3 || $cat_id == 4) {

        			$this->db->select('COUNT(*) as urgentcount', false);
	        		$this->db->from('postad');
	        		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
					$this->db->where("category_id = '$cat_id' AND urgent_package != '0' AND ad_status = 1 AND expire_data >='$date' AND $pcktype");
					if ($locname != '') {
						$this->db->where("(loc.loc_name LIKE '$locname%' 
		  					OR loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname%')");
					}
					if ($bustype != 'all') {
						$this->db->where("ad_type",$bustype);
					}
					$urgentcount = $this->db->get()->row('urgentcount');

					$this->db->select('COUNT(*) as platinumcount', false);
	        		$this->db->from('postad');
	        		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
					$this->db->where("category_id = '$cat_id' AND package_type = 3 AND urgent_package = '0' AND postad.ad_status = 1 AND postad.expire_data >='$date'");
					if ($locname != '') {
						$this->db->where("(loc.loc_name LIKE '$locname%' 
		  					OR loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname%')");
					}
					if ($bustype != 'all') {
						$this->db->where("ad_type",$bustype);
					}
					$platinumcount = $this->db->get()->row('platinumcount');

					$this->db->select('COUNT(*) as goldcount', false);
	        		$this->db->from('postad');
	        		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
					$this->db->where("category_id = '$cat_id' AND package_type = 2 AND urgent_package = '0' AND postad.ad_status = 1 AND postad.expire_data >='$date' AND postad.likes_count >= '25'");
					if ($locname != '') {
						$this->db->where("(loc.loc_name LIKE '$locname%' 
		  					OR loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname%')");
					}
					if ($bustype != 'all') {
						$this->db->where("ad_type",$bustype);
					}
					$goldcount = $this->db->get()->row('goldcount');

					$this->db->select('COUNT(*) as freecount', false);
	        		$this->db->from('postad');
	        		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
					$this->db->where("category_id = '$cat_id' AND package_type = 1 AND urgent_package = '0' AND postad.ad_status = 1 AND postad.expire_data >='$date' AND postad.likes_count >= '75'");
					if ($locname != '') {
						$this->db->where("(loc.loc_name LIKE '$locname%' 
		  					OR loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname%')");
					}
					if ($bustype != 'all') {
						$this->db->where("ad_type",$bustype);
					}
					$freecount = $this->db->get()->row('freecount');
					$rs = array('urgentcount'=>$urgentcount,'platinumcount'=>$platinumcount,'goldcount'=>$goldcount,'freecount'=>$freecount);
        		}
        		else{
        			$this->db->select('COUNT(*) as urgentcount', false);
	        		$this->db->from('postad');
	        		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
					$this->db->where("category_id = '$cat_id' AND urgent_package != '0' AND postad.ad_status = 1 AND postad.expire_data >='$date' AND $pcktype");
					if ($locname != '') {
						$this->db->where("(loc.loc_name LIKE '$locname%' 
		  					OR loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname%')");
					}
					if ($bustype != 'all') {
						$this->db->where("ad_type",$bustype);
					}
					$urgentcount = $this->db->get()->row('urgentcount');

					$this->db->select('COUNT(*) as platinumcount', false);
	        		$this->db->from('postad');
	        		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
					$this->db->where("category_id = '$cat_id' AND package_type = 6 AND urgent_package = '0' AND postad.ad_status = 1 AND postad.expire_data >='$date'");
					if ($locname != '') {
						$this->db->where("(loc.loc_name LIKE '$locname%' 
		  					OR loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname%')");
					}
					if ($bustype != 'all') {
						$this->db->where("ad_type",$bustype);
					}
					$platinumcount = $this->db->get()->row('platinumcount');

					$this->db->select('COUNT(*) as goldcount', false);
	        		$this->db->from('postad');
	        		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
					$this->db->where("category_id = '$cat_id' AND package_type = 5 AND urgent_package = '0' AND postad.ad_status = 1 AND postad.expire_data >='$date' AND postad.likes_count >= '25'");
					if ($locname != '') {
						$this->db->where("(loc.loc_name LIKE '$locname%' 
		  					OR loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname%')");
					}
					if ($bustype != 'all') {
						$this->db->where("ad_type",$bustype);
					}
					$goldcount = $this->db->get()->row('goldcount');

					$this->db->select('COUNT(*) as freecount', false);
	        		$this->db->from('postad');
	        		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
					$this->db->where("category_id = '$cat_id' AND package_type = 4 AND urgent_package = '0' AND postad.ad_status = 1 AND postad.expire_data >='$date' AND postad.likes_count >= '75'");
					if ($locname != '') {
						$this->db->where("(loc.loc_name LIKE '$locname%' 
		  					OR loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname%')");
					}
					if ($bustype != 'all') {
						$this->db->where("ad_type",$bustype);
					}
					$freecount = $this->db->get()->row('freecount');
					$rs = array('urgentcount'=>$urgentcount,'platinumcount'=>$platinumcount,'goldcount'=>$goldcount,'freecount'=>$freecount);
        			/*$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '$cat_id' AND urgent_package != '0' AND postad.ad_status = 1 AND postad.expire_data >='$date' AND $pcktype) AS urgentcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '$cat_id' AND package_type = 6 AND urgent_package = '0' AND postad.ad_status = 1 AND postad.expire_data >='$date'  AND $pcktype) AS platinumcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '$cat_id' AND package_type = 5 AND urgent_package = '0' AND postad.ad_status = 1 AND postad.expire_data >='$date' AND postad.likes_count >= '25' AND $pcktype) AS goldcount,
			(SELECT COUNT(*) FROM postad WHERE category_id = '$cat_id' AND package_type = 4 AND urgent_package = '0' AND postad.ad_status = 1 AND postad.expire_data >='$date' AND postad.likes_count >= '75' AND $pcktype) AS freecount");*/
        		}
        	}
        	else{
        		$this->db->select('COUNT(*) as urgentcount', false);
	        		$this->db->from('postad');
	        		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
					$this->db->where("category_id = '$cat_id' AND urgent_package != '0' AND postad.ad_status = 1 AND postad.expire_data >='$date' AND $pcktype");
					if ($locname != '') {
						$this->db->where("(loc.loc_name LIKE '$locname%' 
		  					OR loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname%')");
					}
					if ($bustype != 'all') {
						$this->db->where("ad_type",$bustype);
					}
					$urgentcount = $this->db->get()->row('urgentcount');

					$this->db->select('COUNT(*) as platinumcount', false);
	        		$this->db->from('postad');
	        		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
					$this->db->where("(package_type = 3 OR package_type = 6) AND urgent_package = '0' AND postad.ad_status = 1 AND postad.expire_data >='$date'");
					if ($locname != '') {
						$this->db->where("(loc.loc_name LIKE '$locname%' 
		  					OR loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname%')");
					}
					if ($bustype != 'all') {
						$this->db->where("ad_type",$bustype);
					}
					$platinumcount = $this->db->get()->row('platinumcount');

					$this->db->select('COUNT(*) as goldcount', false);
	        		$this->db->from('postad');
	        		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
					$this->db->where("(package_type = 2 OR package_type = 5) AND urgent_package = '0' AND postad.ad_status = 1 AND postad.expire_data >='$date' AND postad.likes_count >= '25'");
					if ($locname != '') {
						$this->db->where("(loc.loc_name LIKE '$locname%' 
		  					OR loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname%')");
					}
					if ($bustype != 'all') {
						$this->db->where("ad_type",$bustype);
					}
					$goldcount = $this->db->get()->row('goldcount');

					$this->db->select('COUNT(*) as freecount', false);
	        		$this->db->from('postad');
	        		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
					$this->db->where("(package_type = 1 OR package_type = 4) AND urgent_package = '0' AND postad.ad_status = 1 AND postad.expire_data >='$date' AND postad.likes_count >= '75'");
					if ($locname != '') {
						$this->db->where("(loc.loc_name LIKE '$locname%' 
		  					OR loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname%')");
					}
					if ($bustype != 'all') {
						$this->db->where("ad_type",$bustype);
					}
					$freecount = $this->db->get()->row('freecount');
					$rs = array('urgentcount'=>$urgentcount,'platinumcount'=>$platinumcount,'goldcount'=>$goldcount,'freecount'=>$freecount);

		     }
        	
        	return $rs;
        }

		public function sellerneededhot_jobs(){
			/*top category*/
			$free = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'1','manage_likes.is_top'=>1))->row('likes_count');
			$freeurgent = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'2','manage_likes.is_top'=>1))->row('likes_count');
			$gold = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'3','manage_likes.is_top'=>1))->row('likes_count');
			$date = date("Y-m-d H:i:s");
			$bustype = $this->session->userdata('bus_id');
			$pcktype = '((postad.package_type = "3" OR postad.package_type = "6") OR ((postad.package_type = "2" OR postad.package_type = "5" )AND postad.urgent_package != "0" ) OR ((postad.package_type = "1" OR postad.package_type = "4" )AND postad.urgent_package != "0" AND postad.likes_count >= "'.$freeurgent.'")	OR ((postad.package_type = "1" OR postad.package_type = "4" )AND postad.urgent_package = "0" AND postad.likes_count >= "'.$free.'") OR ((postad.package_type = "2" OR postad.package_type = "5" )AND postad.urgent_package = "0" AND postad.likes_count >= "'.$gold.'")   )';
        	$locname = $this->session->userdata('location');

        	$this->db->select('COUNT(*) as company', false);
    		$this->db->from('job_details, postad');
    		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
			$this->db->where("job_details.ad_id = postad.ad_id AND job_details.jobtype_title = 'Company' AND postad.ad_status = 1 AND postad.expire_data >='$date' AND $pcktype");
			if ($locname != '') {
				$this->db->where("(loc.loc_name LIKE '$locname%' 
  					OR loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname%')");
			}
			if ($bustype != 'all') {
				$this->db->where("ad_type",$bustype);
			}
			$company = $this->db->get()->row('company');

			$this->db->select('COUNT(*) as agency', false);
    		$this->db->from('job_details, postad');
    		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
			$this->db->where("job_details.ad_id = postad.ad_id AND job_details.jobtype_title = 'Agency' AND postad.ad_status = 1 AND postad.expire_data >='$date' AND $pcktype");
			if ($locname != '') {
				$this->db->where("(loc.loc_name LIKE '$locname%' 
  					OR loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname%')");
			}
			if ($bustype != 'all') {
				$this->db->where("ad_type",$bustype);
			}
			$agency = $this->db->get()->row('agency');

			$this->db->select('COUNT(*) as other', false);
    		$this->db->from('job_details, postad');
    		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
			$this->db->where("job_details.ad_id = postad.ad_id AND job_details.jobtype_title = 'Other' AND postad.ad_status = 1 AND postad.expire_data >='$date' AND $pcktype");
			if ($locname != '') {
				$this->db->where("(loc.loc_name LIKE '$locname%' 
  					OR loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname%')");
			}
			if ($bustype != 'all') {
				$this->db->where("ad_type",$bustype);
			}
			$other = $this->db->get()->row('other');

        	$rs = array('company'=>$company,'agency'=>$agency,'other'=>$other);
        	return $rs;
        }

         /*services seller and needed count*/
        public function sellerneededhot_services(){
        	/*top category*/
			$free = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'1','manage_likes.is_top'=>1))->row('likes_count');
			$freeurgent = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'2','manage_likes.is_top'=>1))->row('likes_count');
			$gold = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'3','manage_likes.is_top'=>1))->row('likes_count');
        	$date = date("Y-m-d H:i:s");
        	$bustype = $this->session->userdata('bus_id');
        	$locname = $this->session->userdata('location');
        	$pcktype = '((postad.package_type = "3" OR postad.package_type = "6") OR ((postad.package_type = "2" OR postad.package_type = "5" )AND postad.urgent_package != "0" ) OR ((postad.package_type = "1" OR postad.package_type = "4" )AND postad.urgent_package != "0" AND postad.likes_count >= "'.$freeurgent.'")	OR ((postad.package_type = "1" OR postad.package_type = "4" )AND postad.urgent_package = "0" AND postad.likes_count >= "'.$freeurgent.'") OR ((postad.package_type = "2" OR postad.package_type = "5" )AND postad.urgent_package = "0" AND postad.likes_count >= "'.$freeurgent.'"))';
        	
        	$this->db->select('COUNT(*) as provider', false);
    		$this->db->from('postad');
    		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
			$this->db->where("category_id = '2' AND services = 'service_provider' AND ad_status = 1 AND expire_data >='$date' AND $pcktype");
			if ($locname != '') {
				$this->db->where("(loc.loc_name LIKE '$locname%' 
  					OR loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname%')");
			}
			if ($bustype != 'all') {
				$this->db->where("ad_type",$bustype);
			}
			$provider = $this->db->get()->row('provider');

			$this->db->select('COUNT(*) as needed', false);
    		$this->db->from('postad');
    		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
			$this->db->where("category_id = '2' AND services = 'service_needed' AND ad_status = 1 AND expire_data >='$date' AND $pcktype");
			if ($locname != '') {
				$this->db->where("(loc.loc_name LIKE '$locname%' 
  					OR loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname%')");
			}
			if ($bustype != 'all') {
				$this->db->where("ad_type",$bustype);
			}
			$needed = $this->db->get()->row('needed');

        	$rs = array('provider'=>$provider,'needed'=>$needed);
        	// echo $this->db->last_query(); exit;
        	return $rs;
        }

        public function sellerneededhot_motors(){
        	/*top category*/
			$free = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'1','manage_likes.is_top'=>1))->row('likes_count');
			$freeurgent = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'2','manage_likes.is_top'=>1))->row('likes_count');
			$gold = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'3','manage_likes.is_top'=>1))->row('likes_count');
        	$date = date("Y-m-d H:i:s");
        	$locname = $this->session->userdata('location');
        	$bustype = $this->session->userdata('bus_id');
        	$pcktype = '((postad.package_type = "3" OR postad.package_type = "6") OR ((postad.package_type = "2" OR postad.package_type = "5" )AND postad.urgent_package != "0" ) OR ((postad.package_type = "1" OR postad.package_type = "4" )AND postad.urgent_package != "0" AND postad.likes_count >= "'.$freeurgent.'")	OR ((postad.package_type = "1" OR postad.package_type = "4" )AND postad.urgent_package = "0" AND postad.likes_count >= "'.$free.'") OR ((postad.package_type = "2" OR postad.package_type = "5" )AND postad.urgent_package = "0" AND postad.likes_count >= "'.$gold.'"))';
        	$this->db->select('COUNT(*) as seller', false);
    		$this->db->from('postad');
    		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
			$this->db->where("category_id = '3' AND services = 'Seller' AND ad_status = 1 AND expire_data >='$date' AND $pcktype");
			if ($locname != '') {
				$this->db->where("(loc.loc_name LIKE '$locname%' 
  					OR loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname%')");
			}
			if ($bustype != 'all') {
				$this->db->where("ad_type",$bustype);
			}
			$seller = $this->db->get()->row('seller');

			$this->db->select('COUNT(*) as needed', false);
    		$this->db->from('postad');
    		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
			$this->db->where("category_id = '3' AND services = 'Needed' AND ad_status = 1 AND expire_data >='$date' AND $pcktype");
			if ($locname != '') {
				$this->db->where("(loc.loc_name LIKE '$locname%' 
  					OR loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname%')");
			}
			if ($bustype != 'all') {
				$this->db->where("ad_type",$bustype);
			}
			$needed = $this->db->get()->row('needed');

			$this->db->select('COUNT(*) as forhire', false);
    		$this->db->from('postad');
    		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
			$this->db->where("category_id = '3' AND services = 'ForHire' AND ad_status = 1 AND expire_data >='$date' AND $pcktype");
			if ($locname != '') {
				$this->db->where("(loc.loc_name LIKE '$locname%' 
  					OR loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname%')");
			}
			if ($bustype != 'all') {
				$this->db->where("ad_type",$bustype);
			}
			$forhire = $this->db->get()->row('forhire');

        	$rs = array('seller'=>$seller,'needed'=>$needed,'forhire'=>$forhire);
        	return $rs;
        }

         public function sellerneededhot_property(){
         	/*top category*/
			$free = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'1','manage_likes.is_top'=>1))->row('likes_count');
			$freeurgent = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'2','manage_likes.is_top'=>1))->row('likes_count');
			$gold = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'3','manage_likes.is_top'=>1))->row('likes_count');
         	$date = date("Y-m-d H:i:s");
         	$locname = $this->session->userdata('location');
         	$bustype = $this->session->userdata('bus_id');
         	$pcktype = '((ad.package_type = "3" OR ad.package_type = "6") OR ((ad.package_type = "2" OR ad.package_type = "5" )AND ad.urgent_package != "0" ) OR ((ad.package_type = "1" OR ad.package_type = "4" )AND ad.urgent_package != "0" AND ad.likes_count >= "'.$freeurgent.'")	OR ((ad.package_type = "1" OR ad.package_type = "4" )AND ad.urgent_package = "0" AND ad.likes_count >= "'.$free.'") OR ((ad.package_type = "2" OR ad.package_type = "5" )AND ad.urgent_package = "0" AND ad.likes_count >= "'.$gold.'"))';
			
			$this->db->select('COUNT(*) as offered', false);
    		$this->db->from('postad AS ad, property_resid_commercial AS prc');
    		$this->db->join("location as loc", "loc.ad_id = ad.ad_id", "left");
			$this->db->where("ad.ad_id = prc.ad_id AND ad.category_id = '4' AND prc.offered_type = 'Offered' AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype");
			if ($locname != '') {
				$this->db->where("(loc.loc_name LIKE '$locname%' 
  					OR loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname%')");
			}
			if ($bustype != 'all') {
				$this->db->where("ad.ad_type = '$bustype'");
			}
			$offered = $this->db->get()->row('offered');

			$this->db->select('COUNT(*) as wanted', false);
    		$this->db->from('postad AS ad, property_resid_commercial AS prc');
    		$this->db->join("location as loc", "loc.ad_id = ad.ad_id", "left");
			$this->db->where("ad.ad_id = prc.ad_id AND ad.category_id = '4' AND prc.offered_type = 'Wanted' AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype");
			if ($locname != '') {
				$this->db->where("(loc.loc_name LIKE '$locname%' 
  					OR loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname%')");
			}
			if ($bustype != 'all') {
				$this->db->where("ad.ad_type = '$bustype'");
			}
			$wanted = $this->db->get()->row('wanted');

        	$rs = array('offered'=>$offered,'wanted'=>$wanted);
        	return $rs;
        }

        public function sellerneededhot_pets(){
        				/*low category*/
			$low_free = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'4','manage_likes.is_top'=>0))->row('likes_count');
			$low_freeurgent = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'5','manage_likes.is_top'=>0))->row('likes_count');
			$low_gold = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'6','manage_likes.is_top'=>0))->row('likes_count');
        	$date = date("Y-m-d H:i:s");
        	$locname = $this->session->userdata('location');
        	$bustype = $this->session->userdata('bus_id');
        	$pcktype = '((postad.package_type = "3" OR postad.package_type = "6") OR ((postad.package_type = "2" OR postad.package_type = "5" )AND postad.urgent_package != "0" ) OR ((postad.package_type = "1" OR postad.package_type = "4" )AND postad.urgent_package != "0" AND postad.likes_count >= "'.$low_freeurgent.'")	OR ((postad.package_type = "1" OR postad.package_type = "4" )AND postad.urgent_package = "0" AND postad.likes_count >= "'.$low_free.'") OR ((postad.package_type = "2" OR postad.package_type = "5" )AND postad.urgent_package = "0" AND postad.likes_count >= "'.$low_gold.'"))';
        	
        	$this->db->select('COUNT(*) as seller', false);
    		$this->db->from('postad');
    		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
			$this->db->where("category_id = '5' AND services = 'Seller' AND ad_status = 1 AND expire_data >='$date' AND $pcktype");
			if ($locname != '') {
				$this->db->where("(loc.loc_name LIKE '$locname%' 
  					OR loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname%')");
			}
			if ($bustype != 'all') {
				$this->db->where("ad_type",$bustype);
			}
			$seller = $this->db->get()->row('seller');

			$this->db->select('COUNT(*) as needed', false);
    		$this->db->from('postad');
    		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
			$this->db->where("category_id = '5' AND services = 'Needed' AND ad_status = 1 AND expire_data >='$date' AND $pcktype");
			if ($locname != '') {
				$this->db->where("(loc.loc_name LIKE '$locname%' 
  					OR loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname%')");
			}
			if ($bustype != 'all') {
				$this->db->where("ad_type",$bustype);
			}
			$needed = $this->db->get()->row('needed');
			$rs = array('seller'=>$seller,'needed'=>$needed);
        	return $rs;
        }

        public function sellerneededhot_clothstyle(){
        				/*low category*/
			$low_free = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'4','manage_likes.is_top'=>0))->row('likes_count');
			$low_freeurgent = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'5','manage_likes.is_top'=>0))->row('likes_count');
			$low_gold = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'6','manage_likes.is_top'=>0))->row('likes_count');
        	$date = date("Y-m-d H:i:s");
        	$locname = $this->session->userdata('location');
        	$bustype = $this->session->userdata('bus_id');
        	$pcktype = '((package_type = "3" OR package_type = "6") OR ((package_type = "2" OR package_type = "5" )AND urgent_package != "0" ) OR ((package_type = "1" OR package_type = "4" )AND urgent_package != "0" AND likes_count >= "'.$low_freeurgent.'")	OR ((package_type = "1" OR package_type = "4" )AND urgent_package = "0" AND likes_count >= "'.$low_free.'") OR ((package_type = "2" OR package_type = "5" )AND urgent_package = "0" AND likes_count >= "'.$low_gold.'"))';
        	
        	$this->db->select('COUNT(*) as seller', false);
    		$this->db->from('postad');
    		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
			$this->db->where("services = 'Seller' AND category_id = '6'  AND ad_status = 1 AND expire_data >='$date' AND $pcktype");
			if ($locname != '') {
				$this->db->where("(loc.loc_name LIKE '$locname%' 
  					OR loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname%')");
			}
			if ($bustype != 'all') {
				$this->db->where("ad_type",$bustype);
			}
			$seller = $this->db->get()->row('seller');

			$this->db->select('COUNT(*) as needed', false);
    		$this->db->from('postad');
    		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
			$this->db->where("services = 'Needed' AND category_id = '6'  AND ad_status = 1 AND expire_data >='$date' AND $pcktype");
			if ($locname != '') {
				$this->db->where("(loc.loc_name LIKE '$locname%' 
  					OR loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname%')");
			}
			if ($bustype != 'all') {
				$this->db->where("ad_type",$bustype);
			}
			$needed = $this->db->get()->row('needed');

			$this->db->select('COUNT(*) as charity', false);
    		$this->db->from('postad');
    		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
			$this->db->where("services = 'Charity' AND category_id = '6' AND ad_status = 1 AND expire_data >='$date' AND $pcktype");
			if ($locname != '') {
				$this->db->where("(loc.loc_name LIKE '$locname%' 
  					OR loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname%')");
			}
			if ($bustype != 'all') {
				$this->db->where("ad_type",$bustype);
			}
			$charity = $this->db->get()->row('charity');

        	$rs = array('seller'=>$seller,'needed'=>$needed,'charity'=>$charity);
        	return $rs;
        }

         public function sellerneededhot_kitchen(){
         				/*low category*/
			$low_free = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'4','manage_likes.is_top'=>0))->row('likes_count');
			$low_freeurgent = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'5','manage_likes.is_top'=>0))->row('likes_count');
			$low_gold = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'6','manage_likes.is_top'=>0))->row('likes_count');
         	$date = date("Y-m-d H:i:s");
         	$locname = $this->session->userdata('location');
         	$bustype = $this->session->userdata('bus_id');
         	$pcktype = '((postad.package_type = "3" OR postad.package_type = "6") OR ((postad.package_type = "2" OR postad.package_type = "5" )AND postad.urgent_package != "0" ) OR ((postad.package_type = "1" OR postad.package_type = "4" )AND postad.urgent_package != "0" AND postad.likes_count >= "'.$low_freeurgent.'") OR ((postad.package_type = "1" OR postad.package_type = "4" )AND postad.urgent_package = "0" AND postad.likes_count >= "'.$low_free.'") OR ((postad.package_type = "2" OR postad.package_type = "5" )AND postad.urgent_package = "0" AND postad.likes_count >= "'.$low_gold.'"))';
        	$this->db->select('COUNT(*) as seller', false);
    		$this->db->from('postad');
    		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
			$this->db->where("category_id = '7' AND services = 'Seller' AND ad_status = 1 AND expire_data >='$date' AND $pcktype");
			if ($locname != '') {
				$this->db->where("(loc.loc_name LIKE '$locname%' 
  					OR loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname%')");
			}
			if ($bustype != 'all') {
				$this->db->where("ad_type",$bustype);
			}
			$seller = $this->db->get()->row('seller');

			$this->db->select('COUNT(*) as needed', false);
    		$this->db->from('postad');
    		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
			$this->db->where("category_id = '7' AND services = 'Needed' AND ad_status = 1 AND expire_data >='$date' AND $pcktype");
			if ($locname != '') {
				$this->db->where("(loc.loc_name LIKE '$locname%' 
  					OR loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname%')");
			}
			if ($bustype != 'all') {
				$this->db->where("ad_type",$bustype);
			}
			$needed = $this->db->get()->row('needed');

			$this->db->select('COUNT(*) as charity', false);
    		$this->db->from('postad');
    		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
			$this->db->where("category_id = '7' AND services = 'Charity' AND ad_status = 1 AND expire_data >='$date' AND $pcktype");
			if ($locname != '') {
				$this->db->where("(loc.loc_name LIKE '$locname%' 
  					OR loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname%')");
			}
			if ($bustype != 'all') {
				$this->db->where("ad_type",$bustype);
			}
			$charity = $this->db->get()->row('charity');

        	$rs = array('seller'=>$seller,'needed'=>$needed,'charity'=>$charity);
        	return $rs;
        }

        public function sellerneededhot_ezone(){
        				/*low category*/
			$low_free = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'4','manage_likes.is_top'=>0))->row('likes_count');
			$low_freeurgent = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'5','manage_likes.is_top'=>0))->row('likes_count');
			$low_gold = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'6','manage_likes.is_top'=>0))->row('likes_count');
        	$date = date("Y-m-d H:i:s");
        	$locname = $this->session->userdata('location');
        	$bustype = $this->session->userdata('bus_id');
        	$pcktype = '((postad.package_type = "3" OR postad.package_type = "6") OR ((postad.package_type = "2" OR postad.package_type = "5" )AND postad.urgent_package != "0" ) OR ((postad.package_type = "1" OR postad.package_type = "4" )AND postad.urgent_package != "0" AND postad.likes_count >= "'.$low_freeurgent.'") OR ((postad.package_type = "1" OR postad.package_type = "4" )AND postad.urgent_package = "0" AND postad.likes_count >= "'.$low_free.'") OR ((postad.package_type = "2" OR postad.package_type = "5" )AND postad.urgent_package = "0" AND postad.likes_count >= "'.$low_gold.'"))';
        	$this->db->select('COUNT(*) as seller', false);
    		$this->db->from('postad');
    		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
			$this->db->where("category_id = '8' AND services = 'Seller' AND ad_status = 1 AND expire_data >='$date' AND $pcktype");
			if ($locname != '') {
				$this->db->where("(loc.loc_name LIKE '$locname%' 
  					OR loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname%')");
			}
			if ($bustype != 'all') {
				$this->db->where("ad_type",$bustype);
			}
			$seller = $this->db->get()->row('seller');

			$this->db->select('COUNT(*) as needed', false);
    		$this->db->from('postad');
    		$this->db->join("location as loc", "loc.ad_id = postad.ad_id", "left");
			$this->db->where("category_id = '8' AND services = 'Needed' AND ad_status = 1 AND expire_data >='$date' AND $pcktype");
			if ($locname != '') {
				$this->db->where("(loc.loc_name LIKE '$locname%' 
  					OR loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname%')");
			}
			if ($bustype != 'all') {
				$this->db->where("ad_type",$bustype);
			}
			$needed = $this->db->get()->row('needed');
        	
        	$rs = array('seller'=>$seller,'needed'=>$needed);
        	return $rs;
        }

        public function subcat_prof_hotdeals(){
        	/*top category*/
			$free = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'1','manage_likes.is_top'=>1))->row('likes_count');
			$freeurgent = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'2','manage_likes.is_top'=>1))->row('likes_count');
			$gold = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'3','manage_likes.is_top'=>1))->row('likes_count');
        	$date = date("Y-m-d H:i:s");
        	$bustype = $this->session->userdata('bus_id');
        	$locname = $this->session->userdata('location');
        	$pcktype = "((ad.package_type = '3') OR ((ad.package_type = '2')AND ad.urgent_package != '0' ) OR ((ad.package_type = '1')AND ad.urgent_package != '0' AND ad.likes_count >= '$freeurgent')OR ((ad.package_type = '1')AND ad.urgent_package = '0' AND ad.likes_count >= '$free')OR ((ad.package_type = '2')AND ad.urgent_package = '0' AND ad.likes_count >= '$gold'))";
        	$this->db->select("*, COUNT(ad.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        	$this->db->where("sscat.sub_category_id", 9);
        	if ($bustype) {
	        	if ($bustype !='all') {
	        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND ad.ad_type='$bustype' AND $pcktype", "left");
	        	}
	        	else{
	        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype", "left");
	        	}
	        }
	        else{
        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype", "left");
        	}
        	if ($locname != '') {
				$this->db->join("location as loc", "loc.ad_id = ad.ad_id AND (loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname' OR loc.loc_name LIKE '%$locname%')", "left");
			}
			
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	return $rs->result();
        }

        public function subcat_pop_hotdeals(){
        	/*top category*/
			$free = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'1','manage_likes.is_top'=>1))->row('likes_count');
			$freeurgent = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'2','manage_likes.is_top'=>1))->row('likes_count');
			$gold = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'3','manage_likes.is_top'=>1))->row('likes_count');
        	$date = date("Y-m-d H:i:s");
        	$bustype = $this->session->userdata('bus_id');
        	$locname = $this->session->userdata('location');
        	$pcktype = "((ad.package_type = '3') OR ((ad.package_type = '2')AND ad.urgent_package != '0' ) OR ((ad.package_type = '1')AND ad.urgent_package != '0' AND ad.likes_count >= '$freeurgent')OR ((ad.package_type = '1')AND ad.urgent_package = '0' AND ad.likes_count >= '$free')OR ((ad.package_type = '2')AND ad.urgent_package = '0' AND ad.likes_count >= '$gold'))";
        	$this->db->select("*, COUNT(ad.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        	$this->db->where("sscat.sub_category_id", 10);
        	if ($bustype) {
	        	if ($bustype !='all') {
	        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND ad.ad_type='$bustype' AND $pcktype", "left");
	        	}
	        	else{
	        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype", "left");
	        	}
	        }
	        else{
        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype", "left");
        	}
        	if ($locname != '') {
				$this->db->join("location as loc", "loc.ad_id = ad.ad_id AND (loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname' OR loc.loc_name LIKE '%$locname%')", "left");
			}
			
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	return $rs->result();
        }

        /*find a property*/
        public function subcat_resi_hotdeals(){
        	/*top category*/
			$free = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'1','manage_likes.is_top'=>1))->row('likes_count');
			$freeurgent = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'2','manage_likes.is_top'=>1))->row('likes_count');
			$gold = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'3','manage_likes.is_top'=>1))->row('likes_count');
        	$date = date("Y-m-d H:i:s");
        	$bustype = $this->session->userdata('bus_id');
        	$locname = $this->session->userdata('location');
        	$pcktype = "((ad.package_type = '3') OR ((ad.package_type = '2')AND ad.urgent_package != '0' ) OR ((ad.package_type = '1')AND ad.urgent_package != '0' AND ad.likes_count >= '$freeurgent')OR ((ad.package_type = '1')AND ad.urgent_package = '0' AND ad.likes_count >= '$free')OR ((ad.package_type = '2')AND ad.urgent_package = '0' AND ad.likes_count >= '$gold'))";
        	$this->db->select("*, COUNT(result.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        	if ($bustype) {
	        	if ($bustype !='all') {
	        		$this->db->join("(SELECT resi.* FROM postad AS ad, property_resid_commercial AS resi WHERE resi.`ad_id` = ad.`ad_id` AND ad.`ad_status` = 1 AND ad.expire_data >='$date' AND $pcktype AND ad.ad_type='$bustype') AS result", "result.property_for = sscat.`sub_subcategory_id`", "left");
	        	}
	        	else{
	        		$this->db->join("(SELECT resi.* FROM postad AS ad, property_resid_commercial AS resi WHERE resi.`ad_id` = ad.`ad_id` AND ad.`ad_status` = 1 AND ad.expire_data >='$date' AND $pcktype) AS result", "result.property_for = sscat.`sub_subcategory_id`", "left");
	        	}
	        }
	        else{
        		$this->db->join("(SELECT resi.* FROM postad AS ad, property_resid_commercial AS resi WHERE resi.`ad_id` = ad.`ad_id` AND ad.`ad_status` = 1 AND ad.expire_data >='$date' AND $pcktype) AS result", "result.property_for = sscat.`sub_subcategory_id`", "left");
        	}
        	if ($locname != '') {
				$this->db->join("location as loc", "loc.ad_id = result.ad_id AND (loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname' OR loc.loc_name LIKE '%$locname%')", "left");
			}
			$this->db->where("sscat.sub_category_id", 11);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	 // echo $this->db->last_query(); exit;
        	return $rs->result();
        }

        public function subcat_comm_hotdeals(){
        	/*top category*/
			$free = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'1','manage_likes.is_top'=>1))->row('likes_count');
			$freeurgent = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'2','manage_likes.is_top'=>1))->row('likes_count');
			$gold = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'3','manage_likes.is_top'=>1))->row('likes_count');
        	$date = date("Y-m-d H:i:s");
        	$bustype = $this->session->userdata('bus_id');
        	$locname = $this->session->userdata('location');
        	$pcktype = "((ad.package_type = '3') OR ((ad.package_type = '2')AND ad.urgent_package != '0' ) OR ((ad.package_type = '1')AND ad.urgent_package != '0' AND ad.likes_count >= '$freeurgent')OR ((ad.package_type = '1')AND ad.urgent_package = '0' AND ad.likes_count >= '$free')OR ((ad.package_type = '2')AND ad.urgent_package = '0' AND ad.likes_count >= '$gold'))";
        	$this->db->select("*, COUNT(result.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        	if ($bustype) {
	        	if ($bustype !='all') {
	        		$this->db->join("(SELECT resi.* FROM postad AS ad, property_resid_commercial AS resi WHERE resi.`ad_id` = ad.`ad_id` AND ad.`ad_status` = 1 AND ad.expire_data >='$date' AND $pcktype AND ad.ad_type='$bustype') AS result", "result.property_for = sscat.`sub_subcategory_id`", "left");
	        	}
	        	else{
	        		$this->db->join("(SELECT resi.* FROM postad AS ad, property_resid_commercial AS resi WHERE resi.`ad_id` = ad.`ad_id` AND ad.`ad_status` = 1 AND ad.expire_data >='$date' AND $pcktype) AS result", "result.property_for = sscat.`sub_subcategory_id`", "left");
	        	}
	        }
	        else{
        		$this->db->join("(SELECT resi.* FROM postad AS ad, property_resid_commercial AS resi WHERE resi.`ad_id` = ad.`ad_id` AND ad.`ad_status` = 1 AND ad.expire_data >='$date' AND $pcktype) AS result", "result.property_for = sscat.`sub_subcategory_id`", "left");
        	}
        	if ($locname != '') {
				$this->db->join("location as loc", "loc.ad_id = result.ad_id AND (loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname' OR loc.loc_name LIKE '%$locname%')", "left");
			}
        	$this->db->where("sscat.sub_category_id", 26);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	// echo $this->db->last_query(); exit;
        	return $rs->result();
        }

        /*pets sub sub*/
        public function subcat_pets_hotdeals(){
        	/*low category*/
			$low_free = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'4','manage_likes.is_top'=>0))->row('likes_count');
			$low_freeurgent = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'5','manage_likes.is_top'=>0))->row('likes_count');
			$low_gold = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'6','manage_likes.is_top'=>0))->row('likes_count');
        	$date = date("Y-m-d H:i:s");
        	$bustype = $this->session->userdata('bus_id');
        	$locname = $this->session->userdata('location');
        	$pcktype = "((postad.package_type = '6') OR ((postad.package_type = '5')AND postad.urgent_package != '0' ) OR ((postad.package_type = '4')AND postad.urgent_package != '0' AND postad.likes_count >= '$low_freeurgent')OR ((postad.package_type = '4')AND postad.urgent_package = '0' AND postad.likes_count >= '$low_free')OR ((postad.package_type = '5')AND postad.urgent_package = '0' AND postad.likes_count >= '$low_gold'))";
        	$this->db->select("sub_category.*, COUNT(postad.sub_cat_id) AS no_ads");
			$this->db->from('sub_category');
        	if ($bustype) {
	        	if ($bustype !='all') {
	        		$this->db->join("postad", "postad.sub_cat_id = sub_category.sub_category_id AND postad.ad_status = 1 AND postad.expire_data >='$date' AND $pcktype AND postad.ad_type='$bustype'", "left");
	        	}
	        	else{
	        		$this->db->join("postad", "postad.sub_cat_id = sub_category.sub_category_id AND postad.ad_status = 1 AND postad.expire_data >='$date' AND $pcktype", "left");
	        	}
	        }
	        else{
        		$this->db->join("postad", "postad.sub_cat_id = sub_category.sub_category_id AND postad.ad_status = 1 AND postad.expire_data >='$date' AND $pcktype", "left");
        	}
        	if ($locname != '') {
				$this->db->join("location as loc", "loc.ad_id = postad.ad_id AND (loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname' OR loc.loc_name LIKE '%$locname%')", "left");
			}
			$this->db->where('sub_category.category_id', 5);
			$this->db->group_by("sub_category.sub_category_id");
			$this->db->limit(4);
			$rs = $this->db->get();
			return $rs->result();
        }
        public function subcat_bigpets_hotdeals(){
        	/*low category*/
			$low_free = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'4','manage_likes.is_top'=>0))->row('likes_count');
			$low_freeurgent = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'5','manage_likes.is_top'=>0))->row('likes_count');
			$low_gold = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'6','manage_likes.is_top'=>0))->row('likes_count');
        	$date = date("Y-m-d H:i:s");
        	$bustype = $this->session->userdata('bus_id');
        	$locname = $this->session->userdata('location');
        	$pcktype = "((ad.package_type = '6') OR ((ad.package_type = '5')AND ad.urgent_package != '0' ) OR ((ad.package_type = '4')AND ad.urgent_package != '0' AND ad.likes_count >= '$low_freeurgent')OR ((ad.package_type = '4')AND ad.urgent_package = '0' AND ad.likes_count >= '$low_free')OR ((ad.package_type = '5')AND ad.urgent_package = '0' AND ad.likes_count >= '$low_gold'))";
        	$this->db->select("*, COUNT(ad.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        	if ($bustype) {
	        	if ($bustype !='all') {
	        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype AND ad.ad_type='$bustype'", "left");
	        	}
	        	else{
	        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype", "left");
	        	}
	        }
	        else{
        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype", "left");
        	}
        	if ($locname != '') {
				$this->db->join("location as loc", "loc.ad_id = ad.ad_id AND (loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname' OR loc.loc_name LIKE '%$locname%')", "left");
			}
			$this->db->where("sscat.sub_category_id", 5);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	return $rs->result();
        }
         public function subcat_smallpets_hotdeals(){
         	/*low category*/
			$low_free = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'4','manage_likes.is_top'=>0))->row('likes_count');
			$low_freeurgent = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'5','manage_likes.is_top'=>0))->row('likes_count');
			$low_gold = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'6','manage_likes.is_top'=>0))->row('likes_count');
         	$date = date("Y-m-d H:i:s");
        	$bustype = $this->session->userdata('bus_id');
        	$locname = $this->session->userdata('location');
        	$pcktype = "((ad.package_type = '6') OR ((ad.package_type = '5')AND ad.urgent_package != '0' ) OR ((ad.package_type = '4')AND ad.urgent_package != '0' AND ad.likes_count >= '$low_freeurgent')OR ((ad.package_type = '4')AND ad.urgent_package = '0' AND ad.likes_count >= '$low_free')OR ((ad.package_type = '5')AND ad.urgent_package = '0' AND ad.likes_count >= '$low_gold'))";
        	$this->db->select("*, COUNT(ad.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        	if ($bustype) {
	        	if ($bustype !='all') {
	        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype AND ad.ad_type='$bustype'", "left");
	        	}
	        	else{
	        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype", "left");
	        	}
	        }
	        else{
        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype", "left");
        	}
        	if ($locname != '') {
				$this->db->join("location as loc", "loc.ad_id = ad.ad_id AND (loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname' OR loc.loc_name LIKE '%$locname%')", "left");
			}
        	$this->db->where("sscat.sub_category_id", 6);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	return $rs->result();
        }

        public function subcat_petsaccess_hotdeals(){
        	/*low category*/
			$low_free = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'4','manage_likes.is_top'=>0))->row('likes_count');
			$low_freeurgent = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'5','manage_likes.is_top'=>0))->row('likes_count');
			$low_gold = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'6','manage_likes.is_top'=>0))->row('likes_count');
        	$date = date("Y-m-d H:i:s");
        	$bustype = $this->session->userdata('bus_id');
        	$locname = $this->session->userdata('location');
        	$pcktype = "((ad.package_type = '6') OR ((ad.package_type = '5')AND ad.urgent_package != '0' ) OR ((ad.package_type = '4')AND ad.urgent_package != '0' AND ad.likes_count >= '$low_freeurgent')OR ((ad.package_type = '4')AND ad.urgent_package = '0' AND ad.likes_count >= '$low_free')OR ((ad.package_type = '5')AND ad.urgent_package = '0' AND ad.likes_count >= '$low_gold'))";
        	$this->db->select("*, COUNT(ad.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        	if ($bustype) {
	        	if ($bustype !='all') {
	        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype AND ad.ad_type='$bustype'", "left");
	        	}
	        	else{
	        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype", "left");
	        	}
	        }
	        else{
        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype", "left");
        	}
        	if ($locname != '') {
				$this->db->join("location as loc", "loc.ad_id = ad.ad_id AND (loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname' OR loc.loc_name LIKE '%$locname%')", "left");
			}
        	$this->db->where("sscat.sub_category_id", 7);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	return $rs->result();
        }

        /*cloths hot deals*/
        /*women*/
        public function subcat_women_hotdeals(){
        	/*low category*/
			$low_free = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'4','manage_likes.is_top'=>0))->row('likes_count');
			$low_freeurgent = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'5','manage_likes.is_top'=>0))->row('likes_count');
			$low_gold = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'6','manage_likes.is_top'=>0))->row('likes_count');
        	$date = date("Y-m-d H:i:s");
        	$bustype = $this->session->userdata('bus_id');
        	$locname = $this->session->userdata('location');
        	$pcktype = "((ad.package_type = '6') OR ((ad.package_type = '5')AND ad.urgent_package != '0' ) OR ((ad.package_type = '4')AND ad.urgent_package != '0' AND ad.likes_count >= '$low_freeurgent')OR ((ad.package_type = '4')AND ad.urgent_package = '0' AND ad.likes_count >= '$low_free')OR ((ad.package_type = '5')AND ad.urgent_package = '0' AND ad.likes_count >= '$low_gold'))";
        	$this->db->select("*, COUNT(ad.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        	if ($bustype) {
	        	if ($bustype !='all') {
	        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype AND ad.ad_type='$bustype'", "left");
	        	}
	        	else{
	        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype", "left");
	        	}
	        }
	        else{
        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype", "left");
        	}
        	if ($locname != '') {
				$this->db->join("location as loc", "loc.ad_id = ad.ad_id AND (loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname' OR loc.loc_name LIKE '%$locname%')", "left");
			}
        	$this->db->where("sscat.sub_category_id", 20);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        /*men*/
        public function subcat_men_hotdeals(){
        	/*low category*/
			$low_free = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'4','manage_likes.is_top'=>0))->row('likes_count');
			$low_freeurgent = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'5','manage_likes.is_top'=>0))->row('likes_count');
			$low_gold = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'6','manage_likes.is_top'=>0))->row('likes_count');
        	$date = date("Y-m-d H:i:s");
        	$bustype = $this->session->userdata('bus_id');
        	$locname = $this->session->userdata('location');
        	$pcktype = "((ad.package_type = '6') OR ((ad.package_type = '5')AND ad.urgent_package != '0' ) OR ((ad.package_type = '4')AND ad.urgent_package != '0' AND ad.likes_count >= '$low_freeurgent')OR ((ad.package_type = '4')AND ad.urgent_package = '0' AND ad.likes_count >= '$low_free')OR ((ad.package_type = '5')AND ad.urgent_package = '0' AND ad.likes_count >= '$low_gold'))";
        	$this->db->select("*, COUNT(ad.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        	if ($bustype) {
	        	if ($bustype !='all') {
	        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype AND ad.ad_type='$bustype'", "left");
	        	}
	        	else{
	        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype", "left");
	        	}
	        }
	        else{
        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype", "left");
        	}
        	if ($locname != '') {
				$this->db->join("location as loc", "loc.ad_id = ad.ad_id AND (loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname' OR loc.loc_name LIKE '%$locname%')", "left");
			}
        	$this->db->where("sscat.sub_category_id", 21);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        /*boy*/
        public function subcat_boy_hotdeals(){
        	/*low category*/
			$low_free = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'4','manage_likes.is_top'=>0))->row('likes_count');
			$low_freeurgent = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'5','manage_likes.is_top'=>0))->row('likes_count');
			$low_gold = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'6','manage_likes.is_top'=>0))->row('likes_count');
        	$date = date("Y-m-d H:i:s");
        	$bustype = $this->session->userdata('bus_id');
        	$locname = $this->session->userdata('location');
        	$pcktype = "((ad.package_type = '6') OR ((ad.package_type = '5')AND ad.urgent_package != '0' ) OR ((ad.package_type = '4')AND ad.urgent_package != '0' AND ad.likes_count >= '$low_freeurgent')OR ((ad.package_type = '4')AND ad.urgent_package = '0' AND ad.likes_count >= '$low_free')OR ((ad.package_type = '5')AND ad.urgent_package = '0' AND ad.likes_count >= '$low_gold'))";
        	$this->db->select("*, COUNT(ad.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        	if ($bustype) {
	        	if ($bustype !='all') {
	        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype AND ad.ad_type='$bustype'", "left");
	        	}
	        	else{
	        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype", "left");
	        	}
	        }
	        else{
        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype", "left");
        	}
        	if ($locname != '') {
				$this->db->join("location as loc", "loc.ad_id = ad.ad_id AND (loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname' OR loc.loc_name LIKE '%$locname%')", "left");
			}
        	$this->db->where("sscat.sub_category_id", 22);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	return $rs->result();
        }
         /*girl*/
        public function subcat_girl_hotdeals(){
        	/*low category*/
			$low_free = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'4','manage_likes.is_top'=>0))->row('likes_count');
			$low_freeurgent = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'5','manage_likes.is_top'=>0))->row('likes_count');
			$low_gold = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'6','manage_likes.is_top'=>0))->row('likes_count');
        	$date = date("Y-m-d H:i:s");
        	$bustype = $this->session->userdata('bus_id');
        	$locname = $this->session->userdata('location');
        	$pcktype = "((ad.package_type = '6') OR ((ad.package_type = '5')AND ad.urgent_package != '0' ) OR ((ad.package_type = '4')AND ad.urgent_package != '0' AND ad.likes_count >= '$low_freeurgent')OR ((ad.package_type = '4')AND ad.urgent_package = '0' AND ad.likes_count >= '$low_free')OR ((ad.package_type = '5')AND ad.urgent_package = '0' AND ad.likes_count >= '$low_gold'))";
        	$this->db->select("*, COUNT(ad.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        	if ($bustype) {
	        	if ($bustype !='all') {
	        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype AND ad.ad_type='$bustype'", "left");
	        	}
	        	else{
	        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype", "left");
	        	}
	        }
	        else{
        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype", "left");
        	}
        	if ($locname != '') {
				$this->db->join("location as loc", "loc.ad_id = ad.ad_id AND (loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname' OR loc.loc_name LIKE '%$locname%')", "left");
			}
        	$this->db->where("sscat.sub_category_id", 23);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	return $rs->result();
        }
         /*bboy*/
        public function subcat_bboy_hotdeals(){
        	/*low category*/
			$low_free = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'4','manage_likes.is_top'=>0))->row('likes_count');
			$low_freeurgent = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'5','manage_likes.is_top'=>0))->row('likes_count');
			$low_gold = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'6','manage_likes.is_top'=>0))->row('likes_count');
        	$date = date("Y-m-d H:i:s");
        	$bustype = $this->session->userdata('bus_id');
        	$locname = $this->session->userdata('location');
        	$pcktype = "((ad.package_type = '6') OR ((ad.package_type = '5')AND ad.urgent_package != '0' ) OR ((ad.package_type = '4')AND ad.urgent_package != '0' AND ad.likes_count >= '$low_freeurgent')OR ((ad.package_type = '4')AND ad.urgent_package = '0' AND ad.likes_count >= '$low_free')OR ((ad.package_type = '5')AND ad.urgent_package = '0' AND ad.likes_count >= '$low_gold'))";
        	$this->db->select("*, COUNT(ad.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        	if ($bustype) {
	        	if ($bustype !='all') {
	        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype AND ad.ad_type='$bustype'", "left");
	        	}
	        	else{
	        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype", "left");
	        	}
	        }
	        else{
        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype", "left");
        	}
        	if ($locname != '') {
				$this->db->join("location as loc", "loc.ad_id = ad.ad_id AND (loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname' OR loc.loc_name LIKE '%$locname%')", "left");
			}
        	$this->db->where("sscat.sub_category_id", 24);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	return $rs->result();
        }
         /*bgirl*/
        public function subcat_bgirl_hotdeals(){
        	/*low category*/
			$low_free = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'4','manage_likes.is_top'=>0))->row('likes_count');
			$low_freeurgent = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'5','manage_likes.is_top'=>0))->row('likes_count');
			$low_gold = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'6','manage_likes.is_top'=>0))->row('likes_count');
        	$date = date("Y-m-d H:i:s");
        	$bustype = $this->session->userdata('bus_id');
        	$locname = $this->session->userdata('location');
        	$pcktype = "((ad.package_type = '6') OR ((ad.package_type = '5')AND ad.urgent_package != '0' ) OR ((ad.package_type = '4')AND ad.urgent_package != '0' AND ad.likes_count >= '$low_freeurgent')OR ((ad.package_type = '4')AND ad.urgent_package = '0' AND ad.likes_count >= '$low_free')OR ((ad.package_type = '5')AND ad.urgent_package = '0' AND ad.likes_count >= '$low_gold'))";
        	$this->db->select("*, COUNT(ad.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        	if ($bustype) {
	        	if ($bustype !='all') {
	        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype AND ad.ad_type='$bustype'", "left");
	        	}
	        	else{
	        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype", "left");
	        	}
	        }
	        else{
        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype", "left");
        	}
        	if ($locname != '') {
				$this->db->join("location as loc", "loc.ad_id = ad.ad_id AND (loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname' OR loc.loc_name LIKE '%$locname%')", "left");
			}
        	$this->db->where("sscat.sub_category_id", 25);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	return $rs->result();
        }

        /*kitchen home hot deals*/
        /*kitchen*/
        public function subcat_kitchen_hotdeals(){
        	/*low category*/
			$low_free = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'4','manage_likes.is_top'=>0))->row('likes_count');
			$low_freeurgent = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'5','manage_likes.is_top'=>0))->row('likes_count');
			$low_gold = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'6','manage_likes.is_top'=>0))->row('likes_count');
        	$date = date("Y-m-d H:i:s");
        	$bustype = $this->session->userdata('bus_id');
        	$locname = $this->session->userdata('location');
        	$pcktype = "((ad.package_type = '6') OR ((ad.package_type = '5')AND ad.urgent_package != '0' ) OR ((ad.package_type = '4')AND ad.urgent_package != '0' AND ad.likes_count >= '$low_freeurgent')OR ((ad.package_type = '4')AND ad.urgent_package = '0' AND ad.likes_count >= '$low_free')OR ((ad.package_type = '5')AND ad.urgent_package = '0' AND ad.likes_count >= '$low_gold'))";
        	$this->db->select("*, COUNT(ad.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        	if ($bustype) {
	        	if ($bustype !='all') {
	        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype AND ad.ad_type='$bustype'", "left");
	        	}
	        	else{
	        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype", "left");
	        	}
	        }
	        else{
        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype", "left");
        	}
        	if ($locname != '') {
				$this->db->join("location as loc", "loc.ad_id = ad.ad_id AND (loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname' OR loc.loc_name LIKE '%$locname%')", "left");
			}
        	$this->db->where("sscat.sub_category_id", 67);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        /*home*/
        public function subcat_home_hotdeals(){
        	/*low category*/
			$low_free = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'4','manage_likes.is_top'=>0))->row('likes_count');
			$low_freeurgent = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'5','manage_likes.is_top'=>0))->row('likes_count');
			$low_gold = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'6','manage_likes.is_top'=>0))->row('likes_count');
        	$date = date("Y-m-d H:i:s");
        	$bustype = $this->session->userdata('bus_id');
        	$locname = $this->session->userdata('location');
        	$pcktype = "((ad.package_type = '6') OR ((ad.package_type = '5')AND ad.urgent_package != '0' ) OR ((ad.package_type = '4')AND ad.urgent_package != '0' AND ad.likes_count >= '$low_freeurgent')OR ((ad.package_type = '4')AND ad.urgent_package = '0' AND ad.likes_count >= '$low_free')OR ((ad.package_type = '5')AND ad.urgent_package = '0' AND ad.likes_count >= '$low_gold'))";
        	$this->db->select("*, COUNT(ad.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        	if ($bustype) {
	        	if ($bustype !='all') {
	        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype AND ad.ad_type='$bustype'", "left");
	        	}
	        	else{
	        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype", "left");
	        	}
	        }
	        else{
        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype", "left");
        	}
        	if ($locname != '') {
				$this->db->join("location as loc", "loc.ad_id = ad.ad_id AND (loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname' OR loc.loc_name LIKE '%$locname%')", "left");
			}
        	$this->db->where("sscat.sub_category_id", 68);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        /*decor*/
        public function subcat_decor_hotdeals(){
        	/*low category*/
			$low_free = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'4','manage_likes.is_top'=>0))->row('likes_count');
			$low_freeurgent = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'5','manage_likes.is_top'=>0))->row('likes_count');
			$low_gold = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'6','manage_likes.is_top'=>0))->row('likes_count');
        	$date = date("Y-m-d H:i:s");
        	$bustype = $this->session->userdata('bus_id');
        	$locname = $this->session->userdata('location');
        	$pcktype = "((ad.package_type = '6') OR ((ad.package_type = '5')AND ad.urgent_package != '0' ) OR ((ad.package_type = '4')AND ad.urgent_package != '0' AND ad.likes_count >= '$low_freeurgent')OR ((ad.package_type = '4')AND ad.urgent_package = '0' AND ad.likes_count >= '$low_free')OR ((ad.package_type = '5')AND ad.urgent_package = '0' AND ad.likes_count >= '$low_gold'))";
        	$this->db->select("*, COUNT(ad.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        	if ($bustype) {
	        	if ($bustype !='all') {
	        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype AND ad.ad_type='$bustype'", "left");
	        	}
	        	else{
	        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype", "left");
	        	}
	        }
	        else{
        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype", "left");
        	}
        	if ($locname != '') {
				$this->db->join("location as loc", "loc.ad_id = ad.ad_id AND (loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname' OR loc.loc_name LIKE '%$locname%')", "left");
			}
        	$this->db->where("sscat.sub_category_id", 69);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	return $rs->result();
        }

        /*ezone*/
        /*phone tablets*/
        public function subcat_phone_hotdeals(){
        	/*low category*/
			$low_free = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'4','manage_likes.is_top'=>0))->row('likes_count');
			$low_freeurgent = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'5','manage_likes.is_top'=>0))->row('likes_count');
			$low_gold = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'6','manage_likes.is_top'=>0))->row('likes_count');
        	$date = date("Y-m-d H:i:s");
        	$bustype = $this->session->userdata('bus_id');
        	$locname = $this->session->userdata('location');
        	$pcktype = "((ad.package_type = '6') OR ((ad.package_type = '5')AND ad.urgent_package != '0' ) OR ((ad.package_type = '4')AND ad.urgent_package != '0' AND ad.likes_count >= '$low_freeurgent')OR ((ad.package_type = '4')AND ad.urgent_package = '0' AND ad.likes_count >= '$low_free')OR ((ad.package_type = '5')AND ad.urgent_package = '0' AND ad.likes_count >= '$low_gold'))";
        	$this->db->select("*, COUNT(ad.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        	if ($bustype) {
	        	if ($bustype !='all') {
	        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype AND ad.ad_type='$bustype'", "left");
	        	}
	        	else{
	        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype", "left");
	        	}
	        }
	        else{
        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype", "left");
        	}
        	if ($locname != '') {
				$this->db->join("location as loc", "loc.ad_id = ad.ad_id AND (loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname' OR loc.loc_name LIKE '%$locname%')", "left");
			}
        	$this->db->where("sscat.sub_category_id", 59);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        /*home apps*/
        public function subcat_homeapp_hotdeals(){
        	/*low category*/
			$low_free = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'4','manage_likes.is_top'=>0))->row('likes_count');
			$low_freeurgent = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'5','manage_likes.is_top'=>0))->row('likes_count');
			$low_gold = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'6','manage_likes.is_top'=>0))->row('likes_count');
        	$date = date("Y-m-d H:i:s");
        	$bustype = $this->session->userdata('bus_id');
        	$locname = $this->session->userdata('location');
        	$pcktype = "((ad.package_type = '6') OR ((ad.package_type = '5')AND ad.urgent_package != '0' ) OR ((ad.package_type = '4')AND ad.urgent_package != '0' AND ad.likes_count >= '$low_freeurgent')OR ((ad.package_type = '4')AND ad.urgent_package = '0' AND ad.likes_count >= '$low_free')OR ((ad.package_type = '5')AND ad.urgent_package = '0' AND ad.likes_count >= '$low_gold'))";
        	$this->db->select("*, COUNT(ad.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        	if ($bustype) {
	        	if ($bustype !='all') {
	        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype AND ad.ad_type='$bustype'", "left");
	        	}
	        	else{
	        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype", "left");
	        	}
	        }
	        else{
        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype", "left");
        	}
        	if ($locname != '') {
				$this->db->join("location as loc", "loc.ad_id = ad.ad_id AND (loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname' OR loc.loc_name LIKE '%$locname%')", "left");
			}
        	$this->db->where("sscat.sub_category_id", 60);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        /*small apps*/
        public function subcat_smallapp_hotdeals(){
        	/*low category*/
			$low_free = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'4','manage_likes.is_top'=>0))->row('likes_count');
			$low_freeurgent = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'5','manage_likes.is_top'=>0))->row('likes_count');
			$low_gold = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'6','manage_likes.is_top'=>0))->row('likes_count');
        	$date = date("Y-m-d H:i:s");
        	$bustype = $this->session->userdata('bus_id');
        	$locname = $this->session->userdata('location');
        	$pcktype = "((ad.package_type = '6') OR ((ad.package_type = '5')AND ad.urgent_package != '0' ) OR ((ad.package_type = '4')AND ad.urgent_package != '0' AND ad.likes_count >= '$low_freeurgent')OR ((ad.package_type = '4')AND ad.urgent_package = '0' AND ad.likes_count >= '$low_free')OR ((ad.package_type = '5')AND ad.urgent_package = '0' AND ad.likes_count >= '$low_gold'))";
        	$this->db->select("*, COUNT(ad.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        	if ($bustype) {
	        	if ($bustype !='all') {
	        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype AND ad.ad_type='$bustype'", "left");
	        	}
	        	else{
	        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype", "left");
	        	}
	        }
	        else{
        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype", "left");
        	}
        	if ($locname != '') {
				$this->db->join("location as loc", "loc.ad_id = ad.ad_id AND (loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname' OR loc.loc_name LIKE '%$locname%')", "left");
			}
        	$this->db->where("sscat.sub_category_id", 61);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        /*laptop apps*/
        public function subcat_lappy_hotdeals(){
        	/*low category*/
			$low_free = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'4','manage_likes.is_top'=>0))->row('likes_count');
			$low_freeurgent = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'5','manage_likes.is_top'=>0))->row('likes_count');
			$low_gold = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'6','manage_likes.is_top'=>0))->row('likes_count');
        	$date = date("Y-m-d H:i:s");
        	$bustype = $this->session->userdata('bus_id');
        	$locname = $this->session->userdata('location');
        	$pcktype = "((ad.package_type = '6') OR ((ad.package_type = '5')AND ad.urgent_package != '0' ) OR ((ad.package_type = '4')AND ad.urgent_package != '0' AND ad.likes_count >= '$low_freeurgent')OR ((ad.package_type = '4')AND ad.urgent_package = '0' AND ad.likes_count >= '$low_free')OR ((ad.package_type = '5')AND ad.urgent_package = '0' AND ad.likes_count >= '$low_gold'))";
        	$this->db->select("*, COUNT(ad.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        	if ($bustype) {
	        	if ($bustype !='all') {
	        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype AND ad.ad_type='$bustype'", "left");
	        	}
	        	else{
	        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype", "left");
	        	}
	        }
	        else{
        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype", "left");
        	}
        	if ($locname != '') {
				$this->db->join("location as loc", "loc.ad_id = ad.ad_id AND (loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname' OR loc.loc_name LIKE '%$locname%')", "left");
			}
        	$this->db->where("sscat.sub_category_id", 62);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        /*accessories*/
        public function subcat_access_hotdeals(){
        	/*low category*/
			$low_free = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'4','manage_likes.is_top'=>0))->row('likes_count');
			$low_freeurgent = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'5','manage_likes.is_top'=>0))->row('likes_count');
			$low_gold = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'6','manage_likes.is_top'=>0))->row('likes_count');
        	$date = date("Y-m-d H:i:s");
        	$bustype = $this->session->userdata('bus_id');
        	$locname = $this->session->userdata('location');
        	$pcktype = "((ad.package_type = '6') OR ((ad.package_type = '5')AND ad.urgent_package != '0' ) OR ((ad.package_type = '4')AND ad.urgent_package != '0' AND ad.likes_count >= '$low_freeurgent')OR ((ad.package_type = '4')AND ad.urgent_package = '0' AND ad.likes_count >= '$low_free')OR ((ad.package_type = '5')AND ad.urgent_package = '0' AND ad.likes_count >= '$low_gold'))";
        	$this->db->select("*, COUNT(ad.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        	if ($bustype) {
	        	if ($bustype !='all') {
	        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype AND ad.ad_type='$bustype'", "left");
	        	}
	        	else{
	        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype", "left");
	        	}
	        }
	        else{
        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype", "left");
        	}
        	if ($locname != '') {
				$this->db->join("location as loc", "loc.ad_id = ad.ad_id AND (loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname' OR loc.loc_name LIKE '%$locname%')", "left");
			}
        	$this->db->where("sscat.sub_category_id", 63);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	return $rs->result();
        }
       	/*personal care*/
        public function subcat_pcare_hotdeals(){
        	/*low category*/
			$low_free = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'4','manage_likes.is_top'=>0))->row('likes_count');
			$low_freeurgent = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'5','manage_likes.is_top'=>0))->row('likes_count');
			$low_gold = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'6','manage_likes.is_top'=>0))->row('likes_count');
        	$date = date("Y-m-d H:i:s");
        	$bustype = $this->session->userdata('bus_id');
        	$locname = $this->session->userdata('location');
        	$pcktype = "((ad.package_type = '6') OR ((ad.package_type = '5')AND ad.urgent_package != '0' ) OR ((ad.package_type = '4')AND ad.urgent_package != '0' AND ad.likes_count >= '$low_freeurgent')OR ((ad.package_type = '4')AND ad.urgent_package = '0' AND ad.likes_count >= '$low_free')OR ((ad.package_type = '5')AND ad.urgent_package = '0' AND ad.likes_count >= '$low_gold'))";
        	$this->db->select("*, COUNT(ad.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        	if ($bustype) {
	        	if ($bustype !='all') {
	        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype AND ad.ad_type='$bustype'", "left");
	        	}
	        	else{
	        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype", "left");
	        	}
	        }
	        else{
        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype", "left");
        	}
        	if ($locname != '') {
				$this->db->join("location as loc", "loc.ad_id = ad.ad_id AND (loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname' OR loc.loc_name LIKE '%$locname%')", "left");
			}
        	$this->db->where("sscat.sub_category_id", 64);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	return $rs->result();
        }
         /*home entertainment*/
        public function subcat_henter_hotdeals(){
        	/*low category*/
			$low_free = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'4','manage_likes.is_top'=>0))->row('likes_count');
			$low_freeurgent = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'5','manage_likes.is_top'=>0))->row('likes_count');
			$low_gold = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'6','manage_likes.is_top'=>0))->row('likes_count');
        	$date = date("Y-m-d H:i:s");
        	$bustype = $this->session->userdata('bus_id');
        	$locname = $this->session->userdata('location');
        	$pcktype = "((ad.package_type = '3') OR ((ad.package_type = '2')AND ad.urgent_package != '0' ) OR ((ad.package_type = '1')AND ad.urgent_package != '0' AND ad.likes_count >= '$low_freeurgent')OR ((ad.package_type = '1')AND ad.urgent_package = '0' AND ad.likes_count >= '$low_free')OR ((ad.package_type = '2')AND ad.urgent_package = '0' AND ad.likes_count >= '$low_gold'))";
        	$this->db->select("*, COUNT(ad.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        	if ($bustype) {
	        	if ($bustype !='all') {
	        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype AND ad.ad_type='$bustype'", "left");
	        	}
	        	else{
	        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype", "left");
	        	}
	        }
	        else{
        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype", "left");
        	}
        	if ($locname != '') {
				$this->db->join("location as loc", "loc.ad_id = ad.ad_id AND (loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname' OR loc.loc_name LIKE '%$locname%')", "left");
			}
        	$this->db->where("sscat.sub_category_id", 65);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        /*Photography*/
        public function subcat_pgraphy_hotdeals(){
        	/*low category*/
			$low_free = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'4','manage_likes.is_top'=>0))->row('likes_count');
			$low_freeurgent = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'5','manage_likes.is_top'=>0))->row('likes_count');
			$low_gold = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'6','manage_likes.is_top'=>0))->row('likes_count');
        	$date = date("Y-m-d H:i:s");
        	$bustype = $this->session->userdata('bus_id');
        	$locname = $this->session->userdata('location');
        	$pcktype = "((ad.package_type = '3') OR ((ad.package_type = '2')AND ad.urgent_package != '0' ) OR ((ad.package_type = '1')AND ad.urgent_package != '0' AND ad.likes_count >= '$low_freeurgent')OR ((ad.package_type = '1')AND ad.urgent_package = '0' AND ad.likes_count >= '$low_free')OR ((ad.package_type = '2')AND ad.urgent_package = '0' AND ad.likes_count >= '$low_gold'))";
        	$this->db->select("*, COUNT(ad.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        	if ($bustype) {
	        	if ($bustype !='all') {
	        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype AND ad.ad_type='$bustype'", "left");
	        	}
	        	else{
	        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype", "left");
	        	}
	        }
	        else{
        		$this->db->join("postad AS ad", "ad.sub_scat_id = sscat.sub_subcategory_id  AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype", "left");
        	}
        	if ($locname != '') {
				$this->db->join("location as loc", "loc.ad_id = ad.ad_id AND (loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname' OR loc.loc_name LIKE '%$locname%')", "left");
			}
        	$this->db->where("sscat.sub_category_id", 66);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	return $rs->result();
        }

        /*motor point*/
        /*cars*/
        public function subcat_cars_hotdeals(){
        	/*top category*/
			$free = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'1','manage_likes.is_top'=>1))->row('likes_count');
			$freeurgent = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'2','manage_likes.is_top'=>1))->row('likes_count');
			$gold = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'3','manage_likes.is_top'=>1))->row('likes_count');
        	$date = date("Y-m-d H:i:s");
        	$bustype = $this->session->userdata('bus_id');
        	$locname = $this->session->userdata('location');
        	$pcktype = "((ad.package_type = '3') OR ((ad.package_type = '2')AND ad.urgent_package != '0' ) OR ((ad.package_type = '1')AND ad.urgent_package != '0' AND ad.likes_count >= '$freeurgent')OR ((ad.package_type = '1')AND ad.urgent_package = '0' AND ad.likes_count >= '$free')OR ((ad.package_type = '2')AND ad.urgent_package = '0' AND ad.likes_count >= '$gold'))";
        	
        	$this->db->select("*, COUNT(result.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        	if ($bustype) {
				if ($bustype != '') {
					$this->db->join("(SELECT cars.* FROM `postad` AS ad, `motor_car_van_bus_ads` AS cars WHERE cars.`ad_id` = ad.`ad_id` AND ad.ad_status = 1 AND ad.expire_data >='$date' AND ad.ad_type='$bustype' AND $pcktype) AS result", "result.manufacture = sscat.sub_subcategory_id", "left");
				}
				else{
					$this->db->join("(SELECT cars.* FROM `postad` AS ad, `motor_car_van_bus_ads` AS cars WHERE cars.`ad_id` = ad.`ad_id` AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype) AS result", "result.manufacture = sscat.sub_subcategory_id", "left");
				}
			}
			else{
				$this->db->join("(SELECT cars.* FROM `postad` AS ad, `motor_car_van_bus_ads` AS cars WHERE cars.`ad_id` = ad.`ad_id` AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype) AS result", "result.manufacture = sscat.sub_subcategory_id", "left");
			}
			if ($locname != '') {
				$this->db->join("location as loc", "loc.ad_id = result.ad_id AND (loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname' OR loc.loc_name LIKE '%$locname%')", "left");
			}
        	$this->db->where("sscat.sub_category_id", 12);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	// echo $this->db->last_query(); exit;
        	return $rs->result();
        }

        /*bikes*/
        public function subcat_bikes_hotdeals(){
        	/*top category*/
			$free = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'1','manage_likes.is_top'=>1))->row('likes_count');
			$freeurgent = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'2','manage_likes.is_top'=>1))->row('likes_count');
			$gold = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'3','manage_likes.is_top'=>1))->row('likes_count');
        	$date = date("Y-m-d H:i:s");
        	$bustype = $this->session->userdata('bus_id');
        	$locname = $this->session->userdata('location');
        	$pcktype = "((ad.package_type = '3') OR ((ad.package_type = '2')AND ad.urgent_package != '0' ) OR ((ad.package_type = '1')AND ad.urgent_package != '0' AND ad.likes_count >= '$freeurgent')OR ((ad.package_type = '1')AND ad.urgent_package = '0' AND ad.likes_count >= '$free')OR ((ad.package_type = '2')AND ad.urgent_package = '0' AND ad.likes_count >= '$gold'))";
        	
        	$this->db->select("*, COUNT(result.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        	if ($bustype) {
				if ($bustype != '') {
					$this->db->join("(SELECT bikes.* FROM `postad` AS ad, `motor_bike_ads` AS bikes	WHERE bikes.`ad_id` = ad.`ad_id` AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype AND ad.ad_type='$bustype') AS result", "result.manufacture = sscat.sub_subcategory_id", "left");
				}
				else{
					$this->db->join("(SELECT bikes.* FROM `postad` AS ad, `motor_bike_ads` AS bikes WHERE bikes.`ad_id` = ad.`ad_id` AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype) AS result", "result.manufacture = sscat.sub_subcategory_id", "left");
				}
			}
			else{
				$this->db->join("(SELECT bikes.* FROM `postad` AS ad, `motor_bike_ads` AS bikes WHERE bikes.`ad_id` = ad.`ad_id` AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype) AS result", "result.manufacture = sscat.sub_subcategory_id", "left");
			}
			if ($locname != '') {
				$this->db->join("location as loc", "loc.ad_id = result.ad_id AND (loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname' OR loc.loc_name LIKE '%$locname%')", "left");
			}
        	
        	$this->db->where("sscat.sub_category_id", 13);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	 // echo $this->db->last_query(); exit;
        	return $rs->result();
        }

        /*motor homes*/
        public function subcat_motorhomes_hotdeals(){
        	/*top category*/
			$free = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'1','manage_likes.is_top'=>1))->row('likes_count');
			$freeurgent = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'2','manage_likes.is_top'=>1))->row('likes_count');
			$gold = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'3','manage_likes.is_top'=>1))->row('likes_count');
        	$date = date("Y-m-d H:i:s");
        	$bustype = $this->session->userdata('bus_id');
        	$locname = $this->session->userdata('location');
        	$pcktype = "((ad.package_type = '3') OR ((ad.package_type = '2')AND ad.urgent_package != '0' ) OR ((ad.package_type = '1')AND ad.urgent_package != '0' AND ad.likes_count >= '$freeurgent')OR ((ad.package_type = '1')AND ad.urgent_package = '0' AND ad.likes_count >= '$free')OR ((ad.package_type = '2')AND ad.urgent_package = '0' AND ad.likes_count >= '$gold'))";
        	
        	$this->db->select("*, COUNT(result.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        	if ($bustype) {
				if ($bustype != '') {
					$this->db->join("(SELECT mh.* FROM `postad` AS ad, `motor_home_ads` AS mh WHERE mh.`ad_id` = ad.`ad_id` AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype AND ad.ad_type='$bustype') AS result", "result.manufacture = sscat.sub_subcategory_id", "left");
				}
				else{
					$this->db->join("(SELECT mh.* FROM `postad` AS ad, `motor_home_ads` AS mh WHERE mh.`ad_id` = ad.`ad_id` AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype) AS result", "result.manufacture = sscat.sub_subcategory_id", "left");
				}
			}
			else{
				$this->db->join("(SELECT mh.* FROM `postad` AS ad, `motor_home_ads` AS mh WHERE mh.`ad_id` = ad.`ad_id` AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype) AS result", "result.manufacture = sscat.sub_subcategory_id", "left");
			}
			if ($locname != '') {
				$this->db->join("location as loc", "loc.ad_id = result.ad_id AND (loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname' OR loc.loc_name LIKE '%$locname%')", "left");
			}
        	$this->db->where("sscat.sub_category_id", 14);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	 // echo $this->db->last_query(); exit;
        	return $rs->result();
        }
        /*vans*/
        public function subcat_vans_hotdeals(){
        	/*top category*/
			$free = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'1','manage_likes.is_top'=>1))->row('likes_count');
			$freeurgent = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'2','manage_likes.is_top'=>1))->row('likes_count');
			$gold = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'3','manage_likes.is_top'=>1))->row('likes_count');
        	$date = date("Y-m-d H:i:s");
        	$bustype = $this->session->userdata('bus_id');
        	$locname = $this->session->userdata('location');
        	$pcktype = "((ad.package_type = '3') OR ((ad.package_type = '2')AND ad.urgent_package != '0' ) OR ((ad.package_type = '1')AND ad.urgent_package != '0' AND ad.likes_count >= '$freeurgent')OR ((ad.package_type = '1')AND ad.urgent_package = '0' AND ad.likes_count >= '$free')OR ((ad.package_type = '2')AND ad.urgent_package = '0' AND ad.likes_count >= '$gold'))";
        	
        	$this->db->select("*, COUNT(result.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        	if ($bustype) {
				if ($bustype != '') {
					$this->db->join("(SELECT cars.* FROM `postad` AS ad, `motor_car_van_bus_ads` AS cars WHERE cars.`ad_id` = ad.`ad_id` AND ad.ad_status = 1 AND ad.expire_data >='$date' AND ad.ad_type='$bustype' AND $pcktype) AS result", "result.manufacture = sscat.sub_subcategory_id", "left");
				}
				else{
					$this->db->join("(SELECT cars.* FROM `postad` AS ad, `motor_car_van_bus_ads` AS cars WHERE cars.`ad_id` = ad.`ad_id` AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype) AS result", "result.manufacture = sscat.sub_subcategory_id", "left");
				}
			}
			else{
				$this->db->join("(SELECT cars.* FROM `postad` AS ad, `motor_car_van_bus_ads` AS cars WHERE cars.`ad_id` = ad.`ad_id` AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype) AS result", "result.manufacture = sscat.sub_subcategory_id", "left");
			}
			if ($locname != '') {
				$this->db->join("location as loc", "loc.ad_id = result.ad_id AND (loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname' OR loc.loc_name LIKE '%$locname%')", "left");
			}
        	$this->db->where("sscat.sub_category_id", 15);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	// echo $this->db->last_query(); exit;
        	return $rs->result();
        }
        /*coaches buses*/
        public function subcat_buses_hotdeals(){
        	/*top category*/
			$free = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'1','manage_likes.is_top'=>1))->row('likes_count');
			$freeurgent = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'2','manage_likes.is_top'=>1))->row('likes_count');
			$gold = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'3','manage_likes.is_top'=>1))->row('likes_count');
        	$date = date("Y-m-d H:i:s");
        	$bustype = $this->session->userdata('bus_id');
        	$locname = $this->session->userdata('location');
        	$pcktype = "((ad.package_type = '3') OR ((ad.package_type = '2')AND ad.urgent_package != '0' ) OR ((ad.package_type = '1')AND ad.urgent_package != '0' AND ad.likes_count >= '$freeurgent')OR ((ad.package_type = '1')AND ad.urgent_package = '0' AND ad.likes_count >= '$free')OR ((ad.package_type = '2')AND ad.urgent_package = '0' AND ad.likes_count >= '$gold'))";
        	
        	$this->db->select("*, COUNT(result.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        	if ($bustype) {
				if ($bustype != '') {
					$this->db->join("(SELECT cars.* FROM `postad` AS ad, `motor_car_van_bus_ads` AS cars WHERE cars.`ad_id` = ad.`ad_id` AND ad.ad_status = 1 AND ad.expire_data >='$date' AND ad.ad_type='$bustype' AND $pcktype) AS result", "result.manufacture = sscat.sub_subcategory_id", "left");
				}
				else{
					$this->db->join("(SELECT cars.* FROM `postad` AS ad, `motor_car_van_bus_ads` AS cars WHERE cars.`ad_id` = ad.`ad_id` AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype) AS result", "result.manufacture = sscat.sub_subcategory_id", "left");
				}
			}
			else{
				$this->db->join("(SELECT cars.* FROM `postad` AS ad, `motor_car_van_bus_ads` AS cars WHERE cars.`ad_id` = ad.`ad_id` AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype) AS result", "result.manufacture = sscat.sub_subcategory_id", "left");
			}
			if ($locname != '') {
				$this->db->join("location as loc", "loc.ad_id = result.ad_id AND (loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname' OR loc.loc_name LIKE '%$locname%')", "left");
			}
        	$this->db->where("sscat.sub_category_id", 16);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	// echo $this->db->last_query(); exit;
        	return $rs->result();
        }
        /*plant machinery*/
        public function subcat_plant_hotdeals(){
        	/*top category*/
			$free = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'1','manage_likes.is_top'=>1))->row('likes_count');
			$freeurgent = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'2','manage_likes.is_top'=>1))->row('likes_count');
			$gold = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'3','manage_likes.is_top'=>1))->row('likes_count');
        	$date = date("Y-m-d H:i:s");
        	$bustype = $this->session->userdata('bus_id');
        	$locname = $this->session->userdata('location');
        	$pcktype = "((ad.package_type = '3') OR ((ad.package_type = '2')AND ad.urgent_package != '0' ) OR ((ad.package_type = '1')AND ad.urgent_package != '0' AND ad.likes_count >= '$freeurgent')OR ((ad.package_type = '1')AND ad.urgent_package = '0' AND ad.likes_count >= '$free')OR ((ad.package_type = '2')AND ad.urgent_package = '0' AND ad.likes_count >= '$gold'))";
        	
        	$this->db->select("*, COUNT(result.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        	if ($bustype) {
				if ($bustype != '') {
					$this->db->join("(SELECT pf.* FROM `postad` AS ad, `motor_plant_farming` AS pf WHERE pf.`ad_id` = ad.`ad_id` AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype AND ad.ad_type='$bustype') AS result", "result.manufacture = sscat.sub_subcategory_id", "left");
				}
				else{
					$this->db->join("(SELECT pf.* FROM `postad` AS ad, `motor_plant_farming` AS pf WHERE pf.`ad_id` = ad.`ad_id` AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype) AS result", "result.manufacture = sscat.sub_subcategory_id", "left");
				}
			}
			else{
				$this->db->join("(SELECT pf.* FROM `postad` AS ad, `motor_plant_farming` AS pf WHERE pf.`ad_id` = ad.`ad_id` AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype) AS result", "result.manufacture = sscat.sub_subcategory_id", "left");
			}
			if ($locname != '') {
				$this->db->join("location as loc", "loc.ad_id = result.ad_id AND (loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname' OR loc.loc_name LIKE '%$locname%')", "left");
			}
        	
        	$this->db->where("sscat.sub_category_id", 17);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	// echo $this->db->last_query(); exit;
        	return $rs->result();
        }

        /*farming vehicles*/
        public function subcat_farming_hotdeals(){
        	/*top category*/
			$free = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'1','manage_likes.is_top'=>1))->row('likes_count');
			$freeurgent = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'2','manage_likes.is_top'=>1))->row('likes_count');
			$gold = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'3','manage_likes.is_top'=>1))->row('likes_count');
        	$date = date("Y-m-d H:i:s");
        	$bustype = $this->session->userdata('bus_id');
        	$locname = $this->session->userdata('location');
        	$pcktype = "((ad.package_type = '3') OR ((ad.package_type = '2')AND ad.urgent_package != '0' ) OR ((ad.package_type = '1')AND ad.urgent_package != '0' AND ad.likes_count >= '$freeurgent')OR ((ad.package_type = '1')AND ad.urgent_package = '0' AND ad.likes_count >= '$free')OR ((ad.package_type = '2')AND ad.urgent_package = '0' AND ad.likes_count >= '$gold'))";
        	
        	$this->db->select("*, COUNT(result.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        	if ($bustype) {
				if ($bustype != '') {
					$this->db->join("(SELECT pf.* FROM `postad` AS ad, `motor_plant_farming` AS pf WHERE pf.`ad_id` = ad.`ad_id` AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype AND ad.ad_type='$bustype') AS result", "result.manufacture = sscat.sub_subcategory_id", "left");
				}
				else{
					$this->db->join("(SELECT pf.* FROM `postad` AS ad, `motor_plant_farming` AS pf WHERE pf.`ad_id` = ad.`ad_id` AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype) AS result", "result.manufacture = sscat.sub_subcategory_id", "left");
				}
			}
			else{
				$this->db->join("(SELECT pf.* FROM `postad` AS ad, `motor_plant_farming` AS pf WHERE pf.`ad_id` = ad.`ad_id` AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype) AS result", "result.manufacture = sscat.sub_subcategory_id", "left");
			}
			if ($locname != '') {
				$this->db->join("location as loc", "loc.ad_id = result.ad_id AND (loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname' OR loc.loc_name LIKE '%$locname%')", "left");
			}
        	$this->db->where("sscat.sub_category_id", 18);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	// echo $this->db->last_query(); exit;
        	return $rs->result();
        }
        /*boating */
        public function subcat_boats_hotdeals(){
        	/*top category*/
			$free = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'1','manage_likes.is_top'=>1))->row('likes_count');
			$freeurgent = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'2','manage_likes.is_top'=>1))->row('likes_count');
			$gold = $this->db->get_Where('manage_likes', array('manage_likes.id'=>'3','manage_likes.is_top'=>1))->row('likes_count');
        	$date = date("Y-m-d H:i:s");
        	$bustype = $this->session->userdata('bus_id');
        	$locname = $this->session->userdata('location');
        	$pcktype = "((ad.package_type = '3') OR ((ad.package_type = '2')AND ad.urgent_package != '0' ) OR ((ad.package_type = '1')AND ad.urgent_package != '0' AND ad.likes_count >= '$freeurgent')OR ((ad.package_type = '1')AND ad.urgent_package = '0' AND ad.likes_count >= '$free')OR ((ad.package_type = '2')AND ad.urgent_package = '0' AND ad.likes_count >= '$gold'))";
        	
        	$this->db->select("*, COUNT(result.ad_id) AS no_ads");
        	$this->db->from("sub_subcategory AS sscat");
        	if ($bustype) {
				if ($bustype != '') {
					$this->db->join("(SELECT mb.* FROM `postad` AS ad, `motor_boats` AS mb WHERE mb.`ad_id` = ad.`ad_id` AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype AND ad.ad_type='$bustype') AS result", "result.manufacture = sscat.sub_subcategory_id", "left");
				}
				else{
					$this->db->join("(SELECT mb.* FROM `postad` AS ad, `motor_boats` AS mb WHERE mb.`ad_id` = ad.`ad_id` AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype) AS result", "result.manufacture = sscat.sub_subcategory_id", "left");
				}
			}
			else{
				$this->db->join("(SELECT mb.* FROM `postad` AS ad, `motor_boats` AS mb WHERE mb.`ad_id` = ad.`ad_id` AND ad.ad_status = 1 AND ad.expire_data >='$date' AND $pcktype) AS result", "result.manufacture = sscat.sub_subcategory_id", "left");
			}
			if ($locname != '') {
				$this->db->join("location as loc", "loc.ad_id = result.ad_id AND (loc.loc_name LIKE '$locname%' OR loc.loc_name LIKE '%$locname' OR loc.loc_name LIKE '%$locname%')", "left");
			}
        	
        	$this->db->where("sscat.sub_category_id", 19);
        	$this->db->group_by("sscat.sub_subcategory_id");
        	$rs = $this->db->get();
        	// echo $this->db->last_query(); exit;
        	return $rs->result();
        }

		public function sellerneeded_services1(){
        	$date = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '2' AND services = 'service_provider' AND ad_status = 1 AND expire_data >='$date') AS provider,
			(SELECT COUNT(*) FROM postad WHERE category_id = '2' AND services = 'service_needed' AND ad_status = 1 AND expire_data >='$date') AS needed");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function sellerneeded_servicesprof(){
        	$date = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '2' AND sub_cat_id = 9 AND services = 'service_provider' AND ad_status = 1 AND expire_data >='$date') AS provider,
			(SELECT COUNT(*) FROM postad WHERE category_id = '2' AND sub_cat_id = 9 AND services = 'service_needed' AND ad_status = 1 AND expire_data >='$date') AS needed");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function sellerneeded_servicespop(){
        	$date = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '2' AND sub_cat_id = 10 AND services = 'service_provider' AND ad_status = 1 AND expire_data >='$date') AS provider,
			(SELECT COUNT(*) FROM postad WHERE category_id = '2' AND sub_cat_id = 10 AND services = 'service_needed' AND ad_status = 1 AND expire_data >='$date') AS needed");
        	$rs = $this->db->get();
        	return $rs->result();
        }

        public function sellerneeded_jobs1(){
        	$date = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM job_details, postad WHERE job_details.ad_id = postad.ad_id AND job_details.jobtype_title = 'Company' AND postad.ad_status = 1 AND postad.expire_data >='$date') AS company,
			(SELECT COUNT(*) FROM job_details, postad WHERE job_details.ad_id = postad.ad_id AND job_details.jobtype_title = 'Agency' AND postad.ad_status = 1 AND postad.expire_data >='$date') AS agency,
			(SELECT COUNT(*) FROM job_details, postad WHERE job_details.ad_id = postad.ad_id AND job_details.jobtype_title = 'Other' AND postad.ad_status = 1 AND postad.expire_data >='$date') AS other");
        	$rs = $this->db->get();
        	return $rs->result();
        }

        /*pets seller and needed count*/
        public function sellerneeded_kitchen1(){
        	$date = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '7' AND services = 'Seller' AND ad_status = 1 AND expire_data >='$date') AS seller,
			(SELECT COUNT(*) FROM postad WHERE category_id = '7' AND services = 'Needed' AND ad_status = 1 AND expire_data >='$date') AS needed,
			(SELECT COUNT(*) FROM postad WHERE category_id = '7' AND services = 'Charity' AND ad_status = 1 AND expire_data >='$date') AS charity");
        	$rs = $this->db->get();
        	return $rs->result();
        }

        /*findproperty seller and needed count*/
        public function sellerneeded_property1(){
        	$date = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad AS ad, property_resid_commercial AS prc WHERE ad.ad_id = prc.ad_id AND
			ad.category_id = '4' AND prc.offered_type = 'Offered' AND ad.ad_status = 1 AND ad.expire_data >='$date' ) AS offered,
			(SELECT COUNT(*) FROM postad AS ad, property_resid_commercial AS prc WHERE ad.ad_id = prc.ad_id AND
			ad.category_id = '4' AND prc.offered_type = 'Wanted' AND ad.ad_status = 1 AND ad.expire_data >='$date' ) AS wanted");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function sellerneeded_property1resi(){
        	$date = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad AS ad, property_resid_commercial AS prc WHERE ad.ad_id = prc.ad_id AND
			ad.category_id = '4' AND ad.sub_cat_id = 11 AND prc.offered_type = 'Offered' AND ad.ad_status = 1 AND ad.expire_data >='$date' ) AS offered,
			(SELECT COUNT(*) FROM postad AS ad, property_resid_commercial AS prc WHERE ad.ad_id = prc.ad_id AND
			ad.category_id = '4' AND ad.sub_cat_id = 11 AND prc.offered_type = 'Wanted' AND ad.ad_status = 1 AND ad.expire_data >='$date' ) AS wanted");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function sellerneeded_property1comm(){
        	$date = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad AS ad, property_resid_commercial AS prc WHERE ad.ad_id = prc.ad_id AND
			ad.category_id = '4' AND ad.sub_cat_id = 26 AND prc.offered_type = 'Offered' AND ad.ad_status = 1 AND ad.expire_data >='$date' ) AS offered,
			(SELECT COUNT(*) FROM postad AS ad, property_resid_commercial AS prc WHERE ad.ad_id = prc.ad_id AND
			ad.category_id = '4' AND ad.sub_cat_id = 26 AND prc.offered_type = 'Wanted' AND ad.ad_status = 1 AND ad.expire_data >='$date' ) AS wanted");
        	$rs = $this->db->get();
        	return $rs->result();
        }

        /*clothstyles seller and needed count*/
        public function sellerneeded_clothstyle1(){
        	$date = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad AS ad WHERE ad.services = 'Seller' AND ad.category_id = '6'  AND ad.ad_status = 1 AND ad.expire_data >='$date') AS seller,
			(SELECT COUNT(*) FROM postad AS ad WHERE ad.services = 'Needed' AND ad.category_id = '6'  AND ad.ad_status = 1 AND ad.expire_data >='$date') AS needed,
			(SELECT COUNT(*) FROM postad AS ad WHERE ad.services = 'Charity' AND ad.category_id = '6' AND ad.ad_status = 1 AND ad.expire_data >='$date') AS charity");
        	$rs = $this->db->get();
        	return $rs->result();
        }
		
		/*pets seller and needed count*/
        public function sellerneeded_pets1(){
        	$date = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '5' AND services = 'Seller' AND ad_status = 1 AND expire_data >='$date') AS seller,
			(SELECT COUNT(*) FROM postad WHERE category_id = '5' AND services = 'Needed' AND ad_status = 1 AND expire_data >='$date') AS needed");
        	$rs = $this->db->get();
        	// echo $this->db->last_query(); exit;
        	return $rs->result();
        }

        /*motors seller and needed count*/
        public function sellerneeded_motors1(){
        	$date = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND services = 'Seller' AND ad_status = 1 AND expire_data >='$date' ) AS seller,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND services = 'Needed' AND ad_status = 1 AND expire_data >='$date' ) AS needed,
			(SELECT COUNT(*) FROM postad WHERE category_id = '3' AND services = 'ForHire' AND ad_status = 1 AND expire_data >='$date' ) AS forhire");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function sellerneeded_ezone1(){
        	$date = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND services = 'Seller' AND ad_status = 1 AND expire_data >='$date') AS seller,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND services = 'Needed' AND ad_status = 1 AND expire_data >='$date') AS needed");
        	$rs = $this->db->get();
        	return $rs->result();
        }

        /* Computer Periperals*/
        public function busconcount_compoterperiperals(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = '70' AND(ad_type = 'business' || ad_type = 'consumer')) AS allbustype,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = '70' AND ad_type = 'business') AS business,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = '70' AND ad_type = 'consumer') AS consumer");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function sellerneeded_compoterperiperals(){
        	$date = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND sub_cat_id='70' AND services = 'Seller' AND ad_status = 1 AND expire_data >='$date') AS seller,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND sub_cat_id='70' AND services = 'Needed' AND ad_status = 1 AND expire_data >='$date') AS needed,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND sub_cat_id='70' AND services = 'ForHire' AND ad_status = 1 AND expire_data >='$date') AS forhire");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function deals_pck_compoterperiperals(){
	        	$data = date("Y-m-d H:i:s");
	        	$this->db->select("(SELECT COUNT(ud.valid_to) AS aa FROM postad AS ad LEFT JOIN urgent_details AS ud ON ud.ad_id = ad.ad_id AND ud.valid_to >='$data'
	                    WHERE ad.category_id = '8' AND sub_cat_id='70' AND ad.urgent_package != '0' AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS urgentcount,
				(SELECT COUNT(*) FROM postad WHERE category_id = '8'  AND sub_cat_id='70' AND package_type = '6'  AND urgent_package = '0' AND ad_status = 1 AND expire_data >='$data') AS platinumcount,
				(SELECT COUNT(*) FROM postad WHERE category_id = '8'  AND sub_cat_id='70' AND package_type = '5'  AND urgent_package = '0' AND ad_status = 1 AND expire_data >='$data') AS goldcount,
				(SELECT COUNT(*) FROM postad WHERE category_id = '8'  AND sub_cat_id='70' AND package_type = '4'  AND urgent_package = '0' AND ad_status = 1 AND expire_data >='$data') AS freecount");
	        	$rs = $this->db->get();
	        	return $rs->result();
	        }
		public function count_compoterperiperals_view(){
			$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,lg.*,ud.valid_to AS urg
			");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->from("postad AS ad");
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "join");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'join');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->join('login as lg', "lg.login_id = ad.login_id", 'join');
			$this->db->where("ad.category_id", "8");
			$this->db->where("ad.sub_cat_id", "70");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			$this->db->group_by(" img.ad_id");
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get();

			return $m_res->result();
		}
		public function compoterperiperals_view($data){
			$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,lg.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "join");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'join');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->join('login as lg', "lg.login_id = ad.login_id", 'join');
			$this->db->where("ad.category_id", "8");
			$this->db->where("ad.sub_cat_id", "70");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			$this->db->group_by(" img.ad_id");
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get("postad AS ad", $data['limit'], $data['start']);

			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
			}
		public function count_compoterperiperals_search(){
        	$poto_sub = $this->session->userdata('poto_sub');
        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,lg.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->from("postad AS ad");
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->join('login as lg', "lg.login_id = ad.login_id", 'join');
			$this->db->where("ad.category_id", "8");
			$this->db->where("ad.sub_cat_id", "70");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			if (!empty($poto_sub)) {
				$this->db->where_in('ad.sub_scat_id', $poto_sub);
			}
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array(4, $dealurgent)){
					array_push($pcklist, 4);
				}
				if (in_array(5, $dealurgent)){
					array_push($pcklist, 5);
				}
				if (in_array(6, $dealurgent)){
					array_push($pcklist, 6);
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get();
			 // echo $this->db->last_query(); exit;
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }
        public function compoterperiperals_search($data){
        	$poto_sub = $this->session->userdata('poto_sub');
        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,lg.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join('login as lg', "lg.login_id = ad.login_id", 'join');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->where("ad.category_id", "8");
			$this->db->where("ad.sub_cat_id", "70");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			if (!empty($poto_sub)) {
				$this->db->where_in('ad.sub_scat_id', $poto_sub);
			}
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array(4, $dealurgent)){
					array_push($pcklist, 4);
				}
				if (in_array(5, $dealurgent)){
					array_push($pcklist, 5);
				}
				if (in_array(6, $dealurgent)){
					array_push($pcklist, 6);
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get('postad AS ad', $data['limit'], $data['start']);
			 // echo $this->db->last_query(); exit;
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }

        /* Network components */
        public function busconcount_networkcomponents(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = '71' AND(ad_type = 'business' || ad_type = 'consumer')) AS allbustype,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = '71' AND ad_type = 'business') AS business,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = '71' AND ad_type = 'consumer') AS consumer");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function sellerneeded_networkcomponents(){
        	$date = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND sub_cat_id='71' AND services = 'Seller' AND ad_status = 1 AND expire_data >='$date') AS seller,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND sub_cat_id='71' AND services = 'Needed' AND ad_status = 1 AND expire_data >='$date') AS needed,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND sub_cat_id='71' AND services = 'ForHire' AND ad_status = 1 AND expire_data >='$date') AS forhire");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function deals_pck_networkcomponents(){
	        	$data = date("Y-m-d H:i:s");
	        	$this->db->select("(SELECT COUNT(ud.valid_to) AS aa FROM postad AS ad LEFT JOIN urgent_details AS ud ON ud.ad_id = ad.ad_id AND ud.valid_to >='$data'
	                    WHERE ad.category_id = '8' AND sub_cat_id='71' AND ad.urgent_package != '0' AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS urgentcount,
				(SELECT COUNT(*) FROM postad WHERE category_id = '8'  AND sub_cat_id='71' AND package_type = '6'  AND urgent_package = '0' AND ad_status = 1 AND expire_data >='$data') AS platinumcount,
				(SELECT COUNT(*) FROM postad WHERE category_id = '8'  AND sub_cat_id='71' AND package_type = '5'  AND urgent_package = '0' AND ad_status = 1 AND expire_data >='$data') AS goldcount,
				(SELECT COUNT(*) FROM postad WHERE category_id = '8'  AND sub_cat_id='71' AND package_type = '4'  AND urgent_package = '0' AND ad_status = 1 AND expire_data >='$data') AS freecount");
	        	$rs = $this->db->get();
	        	return $rs->result();
	        }
		public function count_networkcomponents_view(){
			$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,lg.*,ud.valid_to AS urg
			");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->from("postad AS ad");
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "join");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'join');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->join('login as lg', "lg.login_id = ad.login_id", 'join');
			$this->db->where("ad.category_id", "8");
			$this->db->where("ad.sub_cat_id", "71");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			$this->db->group_by(" img.ad_id");
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get();

			return $m_res->result();
		}
		public function networkcomponents_view($data){
			$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,lg.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "join");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'join');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->join('login as lg', "lg.login_id = ad.login_id", 'join');
			$this->db->where("ad.category_id", "8");
			$this->db->where("ad.sub_cat_id", "71");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			$this->db->group_by(" img.ad_id");
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get("postad AS ad", $data['limit'], $data['start']);

			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
			}
		public function count_networkcomponents_search(){
        	$poto_sub = $this->session->userdata('poto_sub');
        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,lg.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->from("postad AS ad");
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->join('login as lg', "lg.login_id = ad.login_id", 'join');
			$this->db->where("ad.category_id", "8");
			$this->db->where("ad.sub_cat_id", "71");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			if (!empty($poto_sub)) {
				$this->db->where_in('ad.sub_scat_id', $poto_sub);
			}
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array(4, $dealurgent)){
					array_push($pcklist, 4);
				}
				if (in_array(5, $dealurgent)){
					array_push($pcklist, 5);
				}
				if (in_array(6, $dealurgent)){
					array_push($pcklist, 6);
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get();
			 // echo $this->db->last_query(); exit;
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }
        public function networkcomponents_search($data){
        	$poto_sub = $this->session->userdata('poto_sub');
        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,lg.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join('login as lg', "lg.login_id = ad.login_id", 'join');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->where("ad.category_id", "8");
			$this->db->where("ad.sub_cat_id", "71");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			if (!empty($poto_sub)) {
				$this->db->where_in('ad.sub_scat_id', $poto_sub);
			}
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array(4, $dealurgent)){
					array_push($pcklist, 4);
				}
				if (in_array(5, $dealurgent)){
					array_push($pcklist, 5);
				}
				if (in_array(6, $dealurgent)){
					array_push($pcklist, 6);
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get('postad AS ad', $data['limit'], $data['start']);
			 // echo $this->db->last_query(); exit;
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }


        /* Softwares */
        public function busconcount_softwares(){
        	$data = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = '72' AND(ad_type = 'business' || ad_type = 'consumer')) AS allbustype,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = '72' AND ad_type = 'business') AS business,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND ad_status = 1 AND expire_data >='$data' AND sub_cat_id = '72' AND ad_type = 'consumer') AS consumer");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function sellerneeded_softwares(){
        	$date = date("Y-m-d H:i:s");
        	$this->db->select("(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND sub_cat_id='72' AND services = 'Seller' AND ad_status = 1 AND expire_data >='$date') AS seller,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND sub_cat_id='72' AND services = 'Needed' AND ad_status = 1 AND expire_data >='$date') AS needed,
			(SELECT COUNT(*) FROM postad WHERE category_id = '8' AND sub_cat_id='72' AND services = 'ForHire' AND ad_status = 1 AND expire_data >='$date') AS forhire");
        	$rs = $this->db->get();
        	return $rs->result();
        }
        public function deals_pck_softwares(){
	        	$data = date("Y-m-d H:i:s");
	        	$this->db->select("(SELECT COUNT(ud.valid_to) AS aa FROM postad AS ad LEFT JOIN urgent_details AS ud ON ud.ad_id = ad.ad_id AND ud.valid_to >='$data'
	                    WHERE ad.category_id = '8' AND sub_cat_id='72' AND ad.urgent_package != '0' AND ad.ad_status = 1 AND ad.expire_data >= '$data') AS urgentcount,
				(SELECT COUNT(*) FROM postad WHERE category_id = '8'  AND sub_cat_id='72' AND package_type = '6'  AND urgent_package = '0' AND ad_status = 1 AND expire_data >='$data') AS platinumcount,
				(SELECT COUNT(*) FROM postad WHERE category_id = '8'  AND sub_cat_id='72' AND package_type = '5'  AND urgent_package = '0' AND ad_status = 1 AND expire_data >='$data') AS goldcount,
				(SELECT COUNT(*) FROM postad WHERE category_id = '8'  AND sub_cat_id='72' AND package_type = '4'  AND urgent_package = '0' AND ad_status = 1 AND expire_data >='$data') AS freecount");
	        	$rs = $this->db->get();
	        	return $rs->result();
	        }
		public function count_softwares_view(){
			$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,lg.*,ud.valid_to AS urg
			");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->from("postad AS ad");
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "join");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'join');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->join('login as lg', "lg.login_id = ad.login_id", 'join');
			$this->db->where("ad.category_id", "8");
			$this->db->where("ad.sub_cat_id", "72");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			$this->db->group_by(" img.ad_id");
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get();

			return $m_res->result();
		}
		public function softwares_view($data){
			$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,lg.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "join");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'join');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->join('login as lg', "lg.login_id = ad.login_id", 'join');
			$this->db->where("ad.category_id", "8");
			$this->db->where("ad.sub_cat_id", "72");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			$this->db->group_by(" img.ad_id");
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get("postad AS ad", $data['limit'], $data['start']);

			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
			}
		public function count_softwares_search(){
        	$poto_sub = $this->session->userdata('poto_sub');
        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,lg.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->from("postad AS ad");
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->join('login as lg', "lg.login_id = ad.login_id", 'join');
			$this->db->where("ad.category_id", "8");
			$this->db->where("ad.sub_cat_id", "72");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			if (!empty($poto_sub)) {
				$this->db->where_in('ad.sub_scat_id', $poto_sub);
			}
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array(4, $dealurgent)){
					array_push($pcklist, 4);
				}
				if (in_array(5, $dealurgent)){
					array_push($pcklist, 5);
				}
				if (in_array(6, $dealurgent)){
					array_push($pcklist, 6);
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get();
			 // echo $this->db->last_query(); exit;
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }
        public function softwares_search($data){
        	$poto_sub = $this->session->userdata('poto_sub');
        	$search_bustype = $this->session->userdata('search_bustype');
        	$dealurgent = $this->session->userdata('dealurgent');
        	$dealtitle = $this->session->userdata('dealtitle');
        	$dealprice = $this->session->userdata('dealprice');
        	$recentdays = $this->session->userdata('recentdays');
        	$location = $this->session->userdata('location');
        	$seller = $this->session->userdata('seller_deals');
        	$this->db->select("ad.*, img.*, COUNT(`img`.`ad_id`) AS img_count, loc.*,lg.*,ud.valid_to AS urg");
			$this->db->select("DATE_FORMAT(STR_TO_DATE(ad.created_on,
	  		'%d-%m-%Y %H:%i:%s'), '%Y-%m-%d %H:%i:%s') as dtime", FALSE);
			$this->db->join("ad_img AS img", "img.ad_id = ad.ad_id", "left");
			$this->db->join('location as loc', "loc.ad_id = ad.ad_id", 'left');
			$this->db->join('login as lg', "lg.login_id = ad.login_id", 'join');
			$this->db->join("urgent_details AS ud", "ud.ad_id=ad.ad_id AND ud.valid_to >= '".date("Y-m-d H:i:s")."'", "left");
			$this->db->where("ad.category_id", "8");
			$this->db->where("ad.sub_cat_id", "72");
			$this->db->where("ad.ad_status", "1");
			$this->db->where("ad.expire_data >= ", date("Y-m-d H:i:s"));
			if (!empty($poto_sub)) {
				$this->db->where_in('ad.sub_scat_id', $poto_sub);
			}
			if (!empty($seller)) {
				$this->db->where_in('ad.services', $seller);
			}
			if ($search_bustype) {
				if ($search_bustype == 'business' || $search_bustype == 'consumer') {
					$this->db->where("ad.ad_type", $search_bustype);
				}
			}
			/*package search*/
			if (!empty($dealurgent)) {
				$pcklist = [];
				if (in_array("0", $dealurgent)) {
					$this->db->where('ad.urgent_package !=', '0');
				}
				else{
					$this->db->where('ad.urgent_package =', '0');
				}
				if (in_array(4, $dealurgent)){
					array_push($pcklist, 4);
				}
				if (in_array(5, $dealurgent)){
					array_push($pcklist, 5);
				}
				if (in_array(6, $dealurgent)){
					array_push($pcklist, 6);
				}
				if (!empty($pcklist)) {
					$this->db->where_in('ad.package_type', $pcklist);
				}
				
			}

			/*deal posted days 24hr/3day/7day/14day/1month */
			if ($recentdays == 'last24hours'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 day"))));
			}
			else if ($recentdays == 'last3days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-3 days"))));
			}
			else if ($recentdays == 'last7days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-7 days"))));
			}
			else if ($recentdays == 'last14days'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-14 days"))));
			}	
			else if ($recentdays == 'last1month'){
				$this->db->where("UNIX_TIMESTAMP(STR_TO_DATE(ad.`created_on`, '%d-%m-%Y %h:%i:%s')) >=", strtotime(date("d-m-Y H:i:s", strtotime("-1 month"))));
			}

			/*location search*/
			if ($location) {
				$this->db->where("(loc.loc_name LIKE '$location%' OR loc.loc_name LIKE '%$location' OR loc.loc_name LIKE '%$location%')");
			}


			$this->db->group_by(" img.ad_id");
				/*deal title ascending or descending*/
					if ($dealtitle == 'atoz') {
						$this->db->order_by("ad.deal_tag","ASC");
					}
					else if ($dealtitle == 'ztoa'){
						$this->db->order_by("ad.deal_tag", "DESC");
					}
					/*deal price ascending or descending*/
					if ($dealprice == 'lowtohigh'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "ASC");
					}
					else if ($dealprice == 'hightolow'){
						$this->db->order_by("CAST(`ad`.`price` AS UNSIGNED)", "DESC");
					}
					else{
						$this->db->order_by('ad.approved_on', 'DESC');
					}
			$this->db->order_by('ad.approved_on', 'DESC');
			$m_res = $this->db->get('postad AS ad', $data['limit'], $data['start']);
			 // echo $this->db->last_query(); exit;
			if($m_res->num_rows() > 0){
				return $m_res->result();
			}
			else{
				return array();
			}
        }
        
}
?>