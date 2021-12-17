<?php
	class City_model extends CI_Model{

		public function add_city($data){
			$this->db->insert('ci_city', $data);
			return true;
		}
		public function update_city($id,$data){
			
			$this->db->where('id', $id);
			$this->db->update('ci_city', $data)or die($this->db->_error_message()); 
			return ($this->db->affected_rows() != 1) ? 0 : 1;
			
		}
	

		public function get_all_city(){
			$wh =array();
			$SQL ='SELECT * FROM ci_city';
			$wh[] = "deleted = 0";
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
		// Get user detial by ID
		public function get_city_by_id($id){
			$query = $this->db->get_where('ci_city', array('id' => $id,'deleted'=>0));
			return $result = $query->row_array();
		}

		//---------------------------------------------------
		// Change user status
		//-----------------------------------------------------
		function change_status()
		{		
			$this->db->set('is_active', $this->input->post('status'));
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('ci_city');
		} 
		public function getallcountry()
		{
			$query = $this->db->get_where('ci_country', array('is_active'=>1));
			return $result = $query->result_array();
			
		}
		public function getallstate()
		{
			$query = $this->db->get_where('ci_state', array('is_active'=>1));
			return $result = $query->result_array();
			
		}
		public function getallcity()
		{
			$query = $this->db->get_where('ci_city', array('is_active'=>1));
			return $result = $query->result_array();
			
		}


	}

?>
