<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Referral extends MY_Controller {

	public function __construct(){

		parent::__construct();
		auth_check(); // check login auth
		check_premissions($this->router->fetch_class(), $this->router->fetch_method());
		check_user_premissions($this->session->userdata('admin_id'), $this->router->fetch_class(), $this->router->fetch_method());
		$this->load->model('referral_model', 'referral_model');
		$this->load->model('city_model', 'city_model');
		$this->load->library('datatable'); // loaded my custom serverside 
	}

	public function index(){
		
		$data['title'] = 'Referral List';
		
		$this->load->view('includes/_header', $data);
		$this->load->view('referral/referral_list');
		$this->load->view('includes/_footer');
	}

	public function datatable_json(){	
		
		$records = $this->referral_model->get_all_referral();
		$data = array(); 

		$i=0;
		foreach ($records['data']  as $row) 
		{  
			
			$action = "";
			if(@$this->general_user_premissions['referral']['is_delete']==1){
				$action .='<a title="Delete Inquiry" class="delete btn btn-sm btn-danger"onclick="return confirm(\'Do you want to delete ?\')" href="'.base_url('referral/delete/'.$row['id']).'"> <i class="fa fa-trash"></i></a>';
			}
			if(@$this->general_user_premissions['referral']['is_view']==1){
				$action .= '<a title="Edit Referral" class="delete btn btn-sm btn-info" href="'.base_url('referral/edit/'.$row['id']).'"> <i class="fa fa-edit"></i></a>';
			}
		
			$data[]= array(
				++$i,
				$row['name'],  
				$row['address'],
				$row['phone'],
				date_time($row['created_at']),
				$action
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}


	//-----------------------------------------------------------
	public function change_status(){   
		$this->referral_model->change_status();
	}

	public function add(){
		$data['country'] = $this->city_model->getallcountry();
		if($this->input->post('submit')){
			$this->form_validation->set_rules('name', 'name', 'trim|strip_tags|xss_clean|required');
			$this->form_validation->set_rules('firmname', 'Firmname', 'trim|strip_tags|xss_clean|required');
			$this->form_validation->set_rules('address', 'Address', 'trim|strip_tags|xss_clean|required');
			$this->form_validation->set_rules('state', 'State', 'trim|strip_tags|xss_clean|required');
			$this->form_validation->set_rules('phone', 'Mobile Number', 'trim|required|strip_tags|xss_clean|is_unique[ci_referral.phone]');
			$this->form_validation->set_rules('country', 'country', 'trim|strip_tags|xss_clean|required');
			$this->form_validation->set_rules('city_id', 'City', 'trim|strip_tags|xss_clean|required');		

			if ($this->form_validation->run() == FALSE) {
				$error = array(
					'errors' => validation_errors()
				);
				$error['user'] = array( 					
					'name' => $this->input->post('name'),
					'firmname' => $this->input->post('firmname'),
					'address' => $this->input->post('address'),
					'phone' => $this->input->post('phone'),
					'city' => $this->input->post('city'),
					'country' =>  $this->input->post('country'),
					'state' => $this->input->post('state'),
					'city' => $this->input->post('city_id'),
				);
				$this->session->set_flashdata('errors', $error['errors']);
				$this->load->view('includes/_header');
				$this->load->view('referral/add_referral', $data);
				$this->load->view('includes/_footer'); 
			}
			else{
			
				$data = array(
					'name' => $this->input->post('name'),
					'address' => $this->input->post('address'),
					'firmname' => $this->input->post('firmname'),
					'phone' => $this->input->post('phone'),
					'country' =>  $this->input->post('country'),
					'state' => $this->input->post('state'),
					'city' => $this->input->post('city_id'),
					'created_at' => date('Y-m-d,h:m:s')
				);
				$data = $this->security->xss_clean($data);
				$result = $this->referral_model->add_referral($data);
				if($result){				
					$this->session->set_flashdata('success', 'Referral has been added successfully!');
					redirect(base_url('referral'));
				}else{
					$this->session->set_flashdata('errors', 'Somthing Error!');
					redirect(base_url('referral'));
				}
			}
		}
		else{
			$data['title'] = 'Add Referral';

			$this->load->view('includes/_header', $data);
			$this->load->view('referral/add_referral');
			$this->load->view('includes/_footer');
		}
		
	}
	public function edit($id = 0){
		$data['referral'] = $this->referral_model->get_referral_by_id($id);
		
		if($id <= 1 OR empty($data['referral']) ){
			$this->session->set_flashdata('errors', 'Unauthorized access!');
			redirect(base_url('referral'));
		}
		$data['country'] = $this->city_model->getallcountry();
		$data['state'] = $this->city_model->getallstate();
		$data['city'] = $this->city_model->getallcity();
		
		if($this->input->post('submit')){
			$olddata = $this->referral_model->get_referral_by_id($id);
			if($this->input->post('phone') != $olddata['phone']) {
			   $uis_unique =  '';//'|is_unique[ci_referral.phone]';
			} else {
			   $uis_unique =  '';
			}
			$this->form_validation->set_rules('name', 'Name', 'trim|strip_tags|xss_clean|required');
			$this->form_validation->set_rules('firmname', 'Firmname', 'trim|strip_tags|xss_clean|required');
			$this->form_validation->set_rules('address', 'Address', 'trim|strip_tags|xss_clean|required');
			$this->form_validation->set_rules('phone', 'Mobile', 'trim|numeric|strip_tags|xss_clean|required'.$uis_unique); 
			$this->form_validation->set_rules('country', 'country', 'trim|strip_tags|xss_clean|required');
			$this->form_validation->set_rules('state', 'State', 'trim|strip_tags|xss_clean|required');
			$this->form_validation->set_rules('city_id', 'City', 'trim|strip_tags|xss_clean|required');
			
			
			if ($this->form_validation->run() == FALSE) {
				$partnerData = $this->referral_model->get_referral_by_id($id);
				$errors = array(
					'errors' => validation_errors()
				); 
				$errors['referral'] = array(
					'name' => $this->input->post('name'),
					'address' => $this->input->post('address'),
					'firmname' => $this->input->post('firmname'),
					'phone' => $this->input->post('phone'),
					'country' =>  $this->input->post('country'),
					'state' => $this->input->post('state'),
					'city' => $this->input->post('city_id'),
					'created_at' => date('Y-m-d,h:m:s')
				); 
				$this->session->set_flashdata('errors', $errors['errors']);
				$this->load->view('includes/_header');
				$this->load->view('referral/edit_referral', $data);
				$this->load->view('includes/_footer');
			}
			else{
				$data = array(
					'name' => $this->input->post('name'),
					'address' => $this->input->post('address'),
					'firmname' => $this->input->post('firmname'),
					'phone' => $this->input->post('phone'),
					'country' =>  $this->input->post('country'),
					'state' => $this->input->post('state'),
					'city' => $this->input->post('city_id'),
				); 
				
				$data = $this->security->xss_clean($data);
				$result = $this->referral_model->edit_referral($data, $id);
				
				if($result){
					$this->session->set_flashdata('success', 'Referral has been updated successfully!');
					redirect(base_url('referral'));
				}else{
					$this->session->set_flashdata('errors', 'Somthing Error!');
					redirect(base_url('referral'));
				}
			}
		}
		else{
			$data['title'] = 'Edit Referral';
			
			
			$this->load->view('includes/_header', $data);
			$this->load->view('referral/edit_referral', $data);
			$this->load->view('includes/_footer');
		}
	}

	//-----------------------------------------------------------
	public function delete($id = 0)
	{		
		$data = array('deleted'=>1,'deleted_at'=>date('Y-m-d,H:s:i'),'is_active'=>0);
		$this->db->where(array('id' => $id));
		$this->db->update('ci_referral', $data);
		$this->session->set_flashdata('success', 'Referral has been deleted successfully!');
		redirect(base_url('referral'));
	}
 	//---------------------------------------------------------------
	//  Export Categories PDF 
	public function create_referral_pdf(){
		$this->load->helper('pdf_helper'); // loaded pdf helper
		$data['all_referral'] = $this->referral_model->get_referral_for_export();		 
		$this->load->view('referral/referral_pdf', $data);
	}

	//---------------------------------------------------------------	
	// Export data in CSV format 
	public function export_csv(){ 

	   // file name 
		$filename = 'referral_'.date('Y-m-d').'.csv'; 
		header("Content-Description: File Transfer"); 
		header("Content-Disposition: attachment; filename=$filename"); 
		header("Content-Type: application/csv; ");

	   // get data 
		$all_referral = $this->referral_model->get_referral_for_export();		 

	   // file creation 
		$file = fopen('php://output', 'w');

		$header = array("ID", "Name","firmname", "address" ,"Mobile",  "Created Date"); 

		fputcsv($file, $header);
		foreach ($all_referral as $key=>$line){ 

			fputcsv($file,$line); 
		}
		fclose($file); 
		exit; 
	} 

	public function get_state(){
		$countryId = $this->input->post('type'); 
		$query = $this->db->get_where('ci_state', array('is_active'=>1,'country_id'=>$countryId));
		$result = $query->result_array();
		
			  $data = '<select name="state" id="state"  class="form-control">
	            <option value="">Select State</option>' ;
	           foreach ($result as $key => $value) {
	           $data .= '<option value="'.$value["id"].' "'.set_value("state").'>'. $value["name"].'
	            </option>';
	            } 
	           $data .= '</select>';
		
		$res = array('status' => TRUE, 'data' => $data);
			
			echo json_encode($res); exit;
	}
}

?>