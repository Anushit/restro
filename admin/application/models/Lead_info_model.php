<?php
	class Lead_info_model extends CI_Model{

		public function add_lead_info($data){
			$this->db->insert('ci_lead_info', $data);
			return true;
		}
		public function update_lead_info($id,$data){
			
			$this->db->where('id', $id);
			$this->db->update('ci_lead_info', $data)or die($this->db->_error_message()); 
			return ($this->db->affected_rows() != 1) ? 0 : 1;
			
		}
	

		public function get_all_lead_info(){
			$wh =array();
			$SQL ='SELECT ci_lead_info.*,ci_lead_category.name as catName, ci_lead_category.id as catid FROM ci_lead_info
			LEFT JOIN ci_lead_category ON (ci_lead_category.id = ci_lead_info.category_id) ';
			$wh[] = "ci_lead_info.deleted = 0";
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
		public function get_lead_info_by_id($id){
			$query = $this->db->get_where('ci_lead_info', array('id' => $id,'deleted'=>0));
			return $result = $query->row_array();
		}

		//---------------------------------------------------
		// Change user status
		//-----------------------------------------------------
		function change_status()
		{		
			$this->db->set('is_active', $this->input->post('status'));
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('ci_lead_info');
		} 
		public function get_leadinf_for_export(){
			///$this->db->where('is_admin', 0);
			$this->db->select('id, name, email, phone, created_at');
			$this->db->from('ci_lead_info');
			$this->db->where('deleted',0);
			$query = $this->db->get();
			return $result = $query->result_array();
		}
		
	}

?>
