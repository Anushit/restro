<?php
	class Inquiry_model extends CI_Model{

		public function add_inquiry($data){
			$this->db->insert('ci_inquiry', $data);
			return $this->db->insert_id();
		}

		public function add_assign_inquiry($data){
			$this->db->insert('ci_inquiry_assign', $data);
			return true;
		}
		public function add_inquiry_followup($data){
			$this->db->insert('ci_inquiry_followup', $data);
			return true;
		}
		public function add_package_inquiry_followup($data){
			$this->db->insert('ci_tour_booking_followup', $data);
			return true;
		}

		public function add_inquiry_followupdetail($data){
			$this->db->insert('ci_inquiry_followdetail', $data);
			return true;
		}
		

		public function get_created_by_id($id){
			$query = $this->db->get_where('ci_admin', array('admin_id' => $id));
			return $result = $query->row_array();
		}
		
		
		//---------------------------------------------------
		// get all inquiry for server-side datatable processing (ajax based)
		
		public function get_alltoday_inquiry (){
			$wh =array();
			$SQL ='SELECT ci_inquiry.*,ci_admin.firstname as firstname, ci_admin.lastname as lastname,
			case WHEN ci_inquiry.inquiry_type = 2 THEN ci_products.name  ELSE
			case WHEN ci_inquiry.inquiry_type = 3 THEN ci_services.name  END END as itm_name FROM ci_inquiry
			LEFT JOIN ci_products ON (ci_products.id = ci_inquiry.link_id)
			LEFT JOIN ci_inquiry_assign ON (ci_inquiry_assign.inquiry_id = ci_inquiry.id AND ci_inquiry_assign.status = 1)
			LEFT JOIN ci_services ON (ci_services.id = ci_inquiry.link_id)
			LEFT JOIN ci_admin ON (ci_admin.admin_id = ci_inquiry_assign.user_id)
			LEFT JOIN ci_inquiry_followdetail ON (ci_inquiry_followdetail.inquiry_id = ci_inquiry.id) and DATE(ci_inquiry.created_at) != "'. date('Y-m-d').'"';
			if($this->session->userdata('admin_id')==1){
				$wh[] = "ci_inquiry.deleted = 0 AND DATE(ci_inquiry.created_at) = '". date('Y-m-d')."' OR DATE(ci_inquiry_followdetail.next_followup_date) = '". date('Y-m-d')."'";
			}else{
				$wh[] = " ci_inquiry.deleted = 0 AND ci_inquiry_assign.user_id =".$this->session->userdata('admin_id')." AND DATE(ci_inquiry.created_at) = '". date('Y-m-d')."' OR DATE(ci_inquiry_followdetail.next_followup_date) = '". date('Y-m-d')."'";;
			}
			
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

		public function get_all_inquiry($where){
			$wh = $where;
			$SQL ='SELECT ci_inquiry.*,ci_admin.firstname as firstname, ci_admin.lastname as lastname,
			case WHEN ci_inquiry.inquiry_type = 2 THEN ci_products.name  ELSE
			case WHEN ci_inquiry.inquiry_type = 3 THEN ci_services.name  END END as itm_name FROM ci_inquiry
			LEFT JOIN ci_products ON (ci_products.id = ci_inquiry.link_id)
			LEFT JOIN ci_inquiry_assign ON (ci_inquiry_assign.inquiry_id = ci_inquiry.id AND ci_inquiry_assign.status = 1)
			LEFT JOIN ci_services ON (ci_services.id = ci_inquiry.link_id)
			LEFT JOIN ci_admin ON (ci_admin.admin_id = ci_inquiry_assign.user_id  )
			LEFT JOIN ci_inquiry_followdetail ON (ci_inquiry_followdetail.inquiry_id = ci_inquiry.id )';
			if($this->session->userdata('admin_id')==1){
				$wh[] = " ci_inquiry.deleted = 0";
			}else{
				$wh[] = " ci_inquiry.deleted = 0 AND ci_inquiry_assign.user_id =".$this->session->userdata('admin_id');
			}
			
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

		public function get_all_packages_inquiry(){
			$wh =' ci_tour_booking.deleted=0 ';
			$SQL ='SELECT ci_tour_booking.id,ci_tour_booking.name as user_name,ci_tour_booking.mobile,ci_tour_booking.email,ci_tour_booking.no_of_child,ci_tour_booking.no_of_adult,ci_tour_booking.message,ci_tour_booking.ip_address,ci_tour_booking.created_at,ci_tour_booking.created_at,ci_tour_booking.updated_at,ci_tour_categories.name,ci_tour_package.title FROM ci_tour_booking LEFT JOIN ci_tour_package ON ci_tour_package.id = ci_tour_booking.tour_package_id LEFT JOIN ci_tour_categories on ci_tour_categories.id = ci_tour_booking.tour_id'; 

			return $this->datatable->LoadJson($SQL,$wh);

		}

		public function get_all_reply_mail($id){
			$wh =array();
			$SQL ='SELECT ci_inquiry_followup.*,ci_inquiry.email as inquirymail FROM ci_inquiry_followup
			LEFT JOIN ci_inquiry ON (ci_inquiry.id = ci_inquiry_followup.inquiry_id)';
			$wh[] = " type = 1 AND inquiry_id =".$id;
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

		public function get_all_package_reply_mail($id){
			$wh =array();
			$SQL ='SELECT ci_tour_booking_followup.*,ci_tour_booking.email as inquirymail FROM ci_tour_booking_followup
			LEFT JOIN ci_tour_booking ON (ci_tour_booking.id = ci_tour_booking_followup.inquiry_id)';
			$wh[] = " inquiry_id =".$id;
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

		public function get_all_reply_msg($id){
			$wh =array();
			$SQL ='SELECT ci_inquiry_followup.*,ci_inquiry.mobile as mob_number FROM ci_inquiry_followup
			LEFT JOIN ci_inquiry ON (ci_inquiry.id = ci_inquiry_followup.inquiry_id)';
			$wh[] = " type = 2 AND inquiry_id =".$id;
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

		public function get_all_followup_details($id){

			$wh = array(); 
			$SQL ='(SELECT  `inquiry_id`, `type`, `subject`, `message`, `attachment`, "" as comments, `followup_date`, "" as next_followup_date FROM ci_inquiry_followup where inquiry_id ='.$id.') 
				Union 
				(SELECT  `inquiry_id`, 4 as type , "" as subject, "" as message, "" as attachment, `comments`, `followup_date`, `next_followup_date` FROM `ci_inquiry_followdetail`  where inquiry_id ='.$id.') ';

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

		public function get_all_reply_whatsapp($id){
			$wh =array();
			$SQL ='SELECT ci_inquiry_followup.*,ci_inquiry.mobile as mob_number FROM ci_inquiry_followup
			LEFT JOIN ci_inquiry ON (ci_inquiry.id = ci_inquiry_followup.inquiry_id)';
			$wh[] = " type = 3 AND inquiry_id =".$id;
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
		public function update_inquiry($data, $id,$userid=Null){
			$this->db->where('inquiry_id', $id);
			$this->db->where('user_id !=', $userid);
			$this->db->update('ci_inquiry_assign', $data);
			return true;
		}
		//---------------------------------------------------
		// Get inquiry detial by ID
		public function get_inquiry_by_id($id){
			$this->db->select('ci_inquiry.*,ci_admin.firstname as first_name,ci_admin.lastname as last_name,ci_products.name as productName,ci_services.name as serviceName');
			$this->db->from('ci_inquiry');
			$this->db->join('ci_inquiry_assign', 'ci_inquiry_assign.inquiry_id=ci_inquiry.id', 'left','ci_inquiry_assign.status = 1');
			$this->db->join('ci_admin', 'ci_admin.admin_id=ci_inquiry_assign.user_id', 'left');
			$this->db->join('ci_products', 'ci_products.id=ci_inquiry.link_id', 'left','ci_inquiry.inquiry_type = 2');
			$this->db->join('ci_services', 'ci_services.id=ci_inquiry.link_id', 'left','ci_inquiry.inquiry_type = 3');
			$this->db->where('ci_inquiry.id', $id);
			$query = $this->db->get();
			return $query->row_array();

		}

		# get package inquiry
		public function get_package_inquiry_by_id($id)
		{
			$SQL ='SELECT ci_tour_booking.id,ci_tour_booking.name as username,ci_tour_booking.mobile,ci_tour_booking.email,ci_tour_booking.no_of_child,ci_tour_booking.no_of_adult,ci_tour_booking.message,ci_tour_booking.ip_address,ci_tour_booking.created_at,ci_tour_booking.created_at,ci_tour_booking.updated_at,ci_tour_categories.name,ci_tour_package.title FROM ci_tour_booking  JOIN ci_tour_package ON ci_tour_package.id = ci_tour_booking.tour_package_id JOIN ci_tour_categories on ci_tour_categories.id = ci_tour_booking.tour_id WHERE ci_tour_booking.id='.$id;

			$query = $this->db->query($SQL);

			$result = $query->result_array();

			return $result;
		}

		public function get_assing_inquiry_by_id($id){
			$query = $this->db->get_where('ci_inquiry_assign', array('inquiry_id' => $id));
			return $result = $query->row_array();
		}
		public function assign_inquirys($data){
			$query = $this->db->get_where('ci_inquiry_assign', $data);
			return $result = $query->row_array();
		}
		 
		 public function get_allassing_inquiry_by_id($id){
		 	$this->db->select('ci_inquiry_assign.*,ci_admin.firstname as name,ci_inquiry.email,ci_inquiry.subject,ci_inquiry.mobile,ci_inquiry.inquiry_type');
			$this->db->from('ci_inquiry_assign');
			$this->db->join('ci_admin', 'ci_admin.admin_id=ci_inquiry_assign.user_id', 'left');
			$this->db->join('ci_inquiry', 'ci_inquiry.id=ci_inquiry_assign.inquiry_id', 'left');
			$this->db->where('ci_inquiry_assign.inquiry_id', $id);
			$this->db->order_by('id','desc');
			$query = $this->db->get();
			return $query->result_array();
			
		}

		//---------------------------------------------------
		// get inquirys for csv export
		public function get_inquirys_for_export(){
			///$this->db->where('is_admin', 0);
			$this->db->select('id, name, email, mobile, inquiry_type, subject, message, ip_address, created_at');
			$this->db->from('ci_inquiry');
			$query = $this->db->get();
			return $result = $query->result_array();
		}

		public function addgernalinquery($data){
			$this->db->insert('ci_inquiry', $data);
			return true;
		}

		public function addpackageinquery($data)
		{
			$this->db->insert('ci_tour_booking', $data);
			return true;
		}
		public function totalinquiery()
		{
			$this->db->where('deleted',0);
			$num_rows = $this->db->count_all_results('ci_inquiry');
			return $num_rows;
			
		}
		public function todayinquiery($id=NULL)
		{	
			$where = "";
			if(!empty($id=NULL)){
			$where .= 'ci_inquiry.created_by= '.$id;
			}
			$where .= " deleted = 0 AND DATE(ci_inquiry.created_at) = '". date('Y-m-d')."' OR DATE(ci_inquiry_followdetail.next_followup_date) = '". date('Y-m-d')."'";
			 //return $where ; exit;
			$this->db->select('ci_inquiry.* ,ci_inquiry_followdetail.id as followupId');
			$this->db->from('ci_inquiry');
			$this->db->join('ci_inquiry_followdetail','ci_inquiry.id=ci_inquiry_followdetail.inquiry_id', 'left');
			$this->db->where($where);
			$query = $this->db->get();
			return $result = $query->result_array();
			
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
		
		public function getallcategory()
		{
			$query = $this->db->get_where('ci_lead_category', array('is_active'=>1));
			return $result = $query->result_array();
			
		}
		public function getallreferral()
		{
			$query = $this->db->get_where('ci_referral', array('is_active'=>1,'id >'=>1));
			return $result = $query->result_array();
			
		}
	}

?>