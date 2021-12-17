<?php
	class Lead_category_model extends CI_Model{

		public function add_lead_category($data){
			$this->db->insert('ci_lead_category', $data);
			return true;
		}
		public function update_lead_category($id,$data){
			
			$this->db->where('id', $id);
			$this->db->update('ci_lead_category', $data)or die($this->db->_error_message()); 
			return ($this->db->affected_rows() != 1) ? 0 : 1;
			
		}
	

		public function get_all_lead_category(){
			$wh =array();
			$SQL ='SELECT * FROM ci_lead_category';
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
		public function get_lead_category_by_id($id){
			$query = $this->db->get_where('ci_lead_category', array('id' => $id,'deleted'=>0));
			return $result = $query->row_array();
		}

		//---------------------------------------------------
		// Change user status
		//-----------------------------------------------------
		function change_status()
		{		
			$this->db->set('is_active', $this->input->post('status'));
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('ci_lead_category');
		} 


	}

?>
