<?php
	class Tour_package_model extends CI_Model{

		public function add_tour_package($data){
			$this->db->insert('ci_tour_package', $data);
			return true;
		}

		//---------------------------------------------------
		// get all tour_package for server-side datatable processing (ajax based)
		public function get_all_tour_package(){
			$wh =array();
			$SQL ='SELECT ci_tour_package.*,ci_tour_categories.id as catId, ci_tour_categories.name as catName  FROM ci_tour_package left join ci_tour_categories on ci_tour_categories.id=ci_tour_package.tour_cat_id';
			
			if(count($wh)>0)
			{
				$WHERE = implode(' and ',$wh);
				return $this->datatable->LoadJson($SQL,$WHERE);
			}
			else
			{
				return $this->datatable->LoadJson($SQL);
			}
		}


		//---------------------------------------------------
		// Get tour_package detial by ID
		public function get_tour_package_by_id($id){
			$query = $this->db->get_where('ci_tour_package', array('id' => $id));
			return $result = $query->row_array();
		}

		//---------------------------------------------------
		// Edit tour_package Record
		public function edit_tour_package($data, $id){
			$this->db->where('id', $id);
			$this->db->update('ci_tour_package', $data);
			return true;
		}

		//---------------------------------------------------
		// Change tour_package status
		//-----------------------------------------------------
		function change_status()
		{		
			$this->db->set('is_active', $this->input->post('status'));
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('ci_tour_package');
		}  
 
		//---------------------------------------------------
		// get tour_packages for csv export
		public function get_tour_packages_for_export(){
			///$this->db->where('is_admin', 0);
			$this->db->select('id, catName,tour_name, description, created_at');
			$this->db->from('ci_tour_package');
			$query = $this->db->get();
			return $result = $query->result_array();
		}


	}

?>