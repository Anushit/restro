<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Lead_info extends MY_Controller {

	public function __construct(){
		
		parent::__construct();
		auth_check(); // check login auth
		check_premissions($this->router->fetch_class(), $this->router->fetch_method());
		check_user_premissions($this->session->userdata('admin_id'), $this->router->fetch_class(), $this->router->fetch_method());
		$this->load->model('lead_info_model', 'lead_info_model');
		$this->load->model('inquiry_model', 'inquiry_model');
		$this->load->library('datatable'); // loaded my custom serverside datatable library
	}

	public function index(){

		$data['title'] = 'Lead category list';
		$this->load->view('includes/_header', $data);
		$this->load->view('lead_info/info_list');
		$this->load->view('includes/_footer');
	}
	
	public function datatable_json(){				   					   
		$records = $this->lead_info_model->get_all_lead_info();
		$data = array();

		$i=0;
		foreach ($records['data']  as $row) 
		{  
			$status = ($row['is_active'] == 1)? 'checked': '';
			$action = "";
			if(@$this->general_user_premissions['lead_info']['is_edit']==1){
				$action .= '<a title="Manage Permission" class="update btn btn-sm btn-warning" href="'.base_url('lead_info/edit/'.$row['id']).'"> <i class="fa fa-edit"></i></a>';
			}
			if(@$this->general_user_premissions['lead_info']['is_delete']==1){
				$action .= '<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("lead_info/delete/".$row['id']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>';
			}
			$data[]= array(
				++$i,
				$row['name'],
				$row['catName'],
				$row['phone'],
				$row['email'],
				date_time($row['created_at']),	
				'<input class="tgl_checkbox tgl-ios" 
				data-id="'.$row['id'].'" 
				id="cb_'.$row['id'].'"
				type="checkbox"  
				'.$status.'><label for="cb_'.$row['id'].'"></label>',	
				$action
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}

	//-----------------------------------------------------------
	public function change_status(){   

		$this->lead_info_model->change_status();
	}


	//-----------------------------------------------------------
	public function add(){
	$data['country'] = $this->inquiry_model->getallcountry();
	$data['category'] = $this->inquiry_model->getallcategory();
		if($this->input->post('submit')){
			$this->form_validation->set_rules('name', 'Name', 'trim|strip_tags|xss_clean|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|strip_tags|xss_clean|required');
			$this->form_validation->set_rules('category', 'Category', 'trim|strip_tags|xss_clean|required');
			$this->form_validation->set_rules('country', 'Country', 'trim|strip_tags|xss_clean|required');
			$this->form_validation->set_rules('state', 'State', 'trim|strip_tags|xss_clean|required');
			$this->form_validation->set_rules('phone', 'Phone Number', 'trim|required|strip_tags|xss_clean|is_unique[ci_lead_info.phone]');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$data['user'] = array( 
					'name' => $this->input->post('name'),
					'email' => $this->input->post('email'),
					'phone' => $this->input->post('phone'),
					'category_id' => $this->input->post('Category'),
					'country' => $this->input->post('country'),
					'state' => $this->input->post('state'),
					'is_active' => $this->input->post('status'),
				);
				$this->session->set_flashdata('errors', $data['errors']);
				$this->load->view('includes/_header');
				$this->load->view('lead_info/add_info', $data);
				$this->load->view('includes/_footer');
			}
			else{
				$data = array(
					'name' => $this->input->post('name'),
					'email' => $this->input->post('email'),
					'phone' => $this->input->post('phone'),
					'category_id' => $this->input->post('category'),
					'country' => $this->input->post('country'),
					'state' => $this->input->post('state'),
					'created_at' => date('Y-m-d,h:m:s'),
					'is_active' => $this->input->post('status'),
				);
				
				$data = $this->security->xss_clean($data);
				$result = $this->lead_info_model->add_lead_info($data);

					if($result){
					$this->session->set_flashdata('success', 'Lead Info has been added successfully!');
					redirect(base_url('lead_info'));
				}
			}
		}
		else{

			$data['title'] = 'Add Lead Info';

			$this->load->view('includes/_header', $data);
			$this->load->view('lead_info/add_info');
			$this->load->view('includes/_footer');
		}
		
	}
	public function importdata(){
	$data['country'] = $this->inquiry_model->getallcountry();
	$data['category'] = $this->inquiry_model->getallcategory();
		if($this->input->post('submit')){
			
			$this->form_validation->set_rules('category', 'Category', 'trim|strip_tags|xss_clean|required');
			$this->form_validation->set_rules('country', 'Country', 'trim|strip_tags|xss_clean|required');
			$this->form_validation->set_rules('state', 'State', 'trim|strip_tags|xss_clean|required');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$data['user'] = array( 
					
					'category_id' => $this->input->post('Category'),
					'country' => $this->input->post('country'),
					'state' => $this->input->post('state'),
					'is_active' => $this->input->post('status'),
				);
				$this->session->set_flashdata('errors', $data['errors']);
				$this->load->view('includes/_header');
				$this->load->view('lead_info/uploadcvc', $data);
				$this->load->view('includes/_footer');
			}
			else{
				
				$file = $_FILES['file']['tmp_name'];
				$handle = fopen($file, "r");
				$c = 0;//
				
				while(($filesop = fgetcsv($handle, 20000, ",")) !== false)
				{
					$data = array(
						'name'  => $filesop[0],
						'email' => $filesop[1],
						'phone' => $filesop[2],
						'category_id' => $this->input->post('category'),
						'country' => $this->input->post('country'),
						'state' => $this->input->post('state'),
						'created_at' => date('Y-m-d,h:m:s'),
						'is_active' => 1,
					);
					if($c<>0){					/* SKIP THE FIRST ROW */
						$this->lead_info_model->add_lead_info($data);
					}
					$c = $c + 1;
				}
					
				$this->session->set_flashdata('success', 'Lead Info has been Upload successfully!');
				redirect(base_url('lead_info'));
				
			}
		}
		else{

			$data['title'] = 'Upload Lead Info';

			$this->load->view('includes/_header', $data);
			$this->load->view('lead_info/uploadcvc');
			$this->load->view('includes/_footer');
		}
		
	}
	public function edit($id=NULL){
		$data['lead_info'] = $this->lead_info_model->get_lead_info_by_id($id);
		$data['category'] = $this->inquiry_model->getallcategory();
		$data['country'] = $this->inquiry_model->getallcountry();
		$data['state'] = $this->inquiry_model->getallstate();
		if($this->input->post('submit')){

			if($this->input->post('name') != $data['lead_info']['name']) {
			   $uis_unique =  '|is_unique[ci_lead_info.phone]';
			} else {
			   $uis_unique =  '';
			}
			$this->form_validation->set_rules('name', ' Name', 'trim|strip_tags|xss_clean|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|strip_tags|xss_clean|required');
			$this->form_validation->set_rules('category', 'Category', 'trim|required');
			$this->form_validation->set_rules('country', 'Country', 'trim|strip_tags|xss_clean|required');
			$this->form_validation->set_rules('state', 'State', 'trim|strip_tags|xss_clean|required');
			$this->form_validation->set_rules('phone', 'Phone number', 'trim|required|strip_tags|xss_clean'.$uis_unique);

			if ($this->form_validation->run() == FALSE) {
				$errors = array(
					'errors' => validation_errors()
				);
				$errors['user'] = array( 
					'name' => $this->input->post('name'),
					'email' => $this->input->post('email'),
					'phone' => $this->input->post('phone'),
					'category_id' => $this->input->post('Category'),
					'country' => $this->input->post('country'),
					'state' => $this->input->post('state'),
					'is_active' => $this->input->post('status'),
				);
				$this->session->set_flashdata('errors', $errors['errors']);
				$this->load->view('includes/_header');
				$this->load->view('lead_info/edit_info', $data);
				$this->load->view('includes/_footer');
			}
			else{
				$data = array(
					'name' => $this->input->post('name'),
					'email' => $this->input->post('email'),
					'phone' => $this->input->post('phone'),
					'category_id' => $this->input->post('category'),
					'country' => $this->input->post('country'),
					'state' => $this->input->post('state'),
					'updated_at' => date('Y-m-d,h:m:s'),
					'is_active' => $this->input->post('status'),
				);
				
				$data = $this->security->xss_clean($data);
				$result = $this->lead_info_model->update_lead_info($id,$data);

					if($result){
					$this->session->set_flashdata('success', 'Lead Info has been Update successfully!');
					redirect(base_url('lead_info'));
				}
			}
		}
		else{

			$data['title'] = 'Edit Lead Info';

			$this->load->view('includes/_header', $data);
			$this->load->view('lead_info/edit_info');
			$this->load->view('includes/_footer');
		}
		
	}


	//-----------------------------------------------------------
	public function delete($id = 0)
	{		
		$this->db->where('id', $id);
		$this->db->update('ci_lead_info', array('deleted'=>1,'is_active'=>0,'deleted_at'=>date('Y-m-d,H:i:s')));
		$this->session->set_flashdata('success', 'Lead Info has been deleted successfully!');
		redirect(base_url('lead_info'));
	}
	
	//---------------------------------------------------------------
	//  Export Categories PDF 
	public function create_lefdinfo_pdf(){
		$this->load->helper('pdf_helper'); // loaded pdf helper
		$data['all_leadinfo'] =$this->lead_info_model->get_leadinf_for_export();		 
		$this->load->view('lead_info/leadinfo_pdf', $data);
	}

	//---------------------------------------------------------------	
	// Export data in CSV format 
	public function export_csv(){ 

	   // file name

		$filename = 'leadinfo'.date('Y-m-d').'.csv'; 

		header("Content-Description: File Transfer"); 
		header("Content-Disposition: attachment; filename=$filename"); 
		header("Content-Type: application/csv; ");

	   // get data 
		$all_leadinfo = $this->lead_info_model->get_leadinf_for_export();

	   // file creation 
		$file = fopen('php://output', 'w');

		$header = array("ID", "Name", "Email" ,"Mobile", "Created Date"); 

		fputcsv($file, $header);
		foreach ($all_leadinfo as $key=>$line){ 
			fputcsv($file,$line); 
		}
		fclose($file); 
		exit; 
	} 

}


?>
