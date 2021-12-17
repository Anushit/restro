<?php
	class Tour_list_model extends CI_Model{

		public function add_tour_list($data){
			$this->db->insert('ci_tour_list', $data);
			return true;
		}

		//---------------------------------------------------
		// get all tour_list for server-side datatable processing (ajax based)
		public function get_all_tour_list(){
			$wh =array();
			$SQL ='SELECT ci_tour_list.*,ci_tour_categories.id as catId, ci_tour_categories.name as catName  FROM ci_tour_list left join ci_tour_categories on ci_tour_categories.id=ci_tour_list.tour_cat_id';
			
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
		// Get tour_list detial by ID
		public function get_tour_list_by_id($id){
			$query = $this->db->get_where('ci_tour_list', array('id' => $id));
			return $result = $query->row_array();
		}

		//---------------------------------------------------
		// Edit tour_list Record
		public function edit_tour_list($data, $id){
			$this->db->where('id', $id);
			$this->db->update('ci_tour_list', $data);
			return true;
		}

		//---------------------------------------------------
		// Change tour_list status
		//-----------------------------------------------------
		function change_status()
		{		
			$this->db->set('is_active', $this->input->post('status'));
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('ci_tour_list');
		}  
 
		//---------------------------------------------------
		// get tour_lists for csv export
		public function get_tour_lists_for_export(){
			///$this->db->where('is_admin', 0);
			$this->db->select('id, catName,tour_name, description, created_at');
			$this->db->from('ci_tour_list');
			$query = $this->db->get();
			return $result = $query->result_array();
		}


	}

?>