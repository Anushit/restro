<?php
	class Referral_model extends CI_Model{

		public function add_referral($data){
			$this->db->insert('ci_referral', $data);
			return $this->db->insert_id();
		}

		public function get_all_referral(){
			$wh = array();
			$SQL ='SELECT * FROM ci_referral';
			$wh[] = " ci_referral.deleted = 0 and ci_referral.id > 1";
		
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

		public function edit_referral($data,$id){

			$this->db->where('id', $id);
			$this->db->update('ci_referral', $data);
			return $this->db->affected_rows();
		}
		//---------------------------------------------------

		public function get_referral_by_id($id){
			$query = $this->db->get_where('ci_referral', array('id' => $id));
			return $result = $query->row_array();
		}
		public function get_referral_for_export(){
		
		$this->db->select('id, name,firmname, address, phone,created_at');
		$this->db->from('ci_referral');
		$query = $this->db->get();
		return $result = $query->result_array();
		}

	}

?>