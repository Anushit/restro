<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Tour_package extends MY_Controller {

	public function __construct(){

		parent::__construct();
		auth_check(); // check login auth
		check_premissions($this->router->fetch_class(), $this->router->fetch_method());
		check_user_premissions($this->session->userdata('admin_id'), $this->router->fetch_class(), $this->router->fetch_method());
		$this->load->model('tour_package_model', 'tour_package_model');
		$this->load->model('tour_categories_model', 'tour_categories_model');		
		$this->load->library('datatable'); // loaded my custom serverside datatable library
	}

	public function index(){
		$data['title'] = 'Tour List';

		$this->load->view('includes/_header', $data);
		$this->load->view('tour_package/tour_package_list');
		$this->load->view('includes/_footer');
	}
	
	public function datatable_json(){				   					   
		$records = $this->tour_package_model->get_all_tour_package();
		$data = array();

		$i=0;
		foreach ($records['data']  as $row) 
		{  
			$status = ($row['is_active'] == 1)? 'checked': '';
			$action = "";
			if(@$this->general_user_premissions['tour_package']['is_edit']==1){
				$action .= '<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('tour_package/edit/'.$row['id']).'"> <i class="fa fa-pencil-square-o"></i></a>';
			}
			if(@$this->general_user_premissions['tour_package']['is_delete']==1){
				$action .= '<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("tour_package/delete/".$row['id']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>';
			}
			$data[]= array(
				++$i,
				$row['catName'],
				$row['title'], 
				$row['price'], 
				'<img src="'.base_url($row["image"]).'" class="image" height="50">', 
				date_time($row['created_at']),	
				'<input class="tgl_checkbox tgl-ios" 
				data-id="'.$row['id'].'" 
				id="cb_'.$row['id'].'"
				type="checkbox" '.$status.'><label for="cb_'.$row['id'].'"></label>',	
				$action					 
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}

	//-----------------------------------------------------------
	public function change_status(){   

		$this->tour_package_model->change_status();
	}

	//-----------------------------------------------------------
	public function add(){

		if($this->input->post('submit')){
			$this->form_validation->set_rules('title', 'Name', 'trim|strip_tags|xss_clean|required');
			$this->form_validation->set_rules('status', 'Status', 'trim|strip_tags|xss_clean|required');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$data['tour_package'] = array(
					'tour_cat_id' => $this->input->post('tour_cat_id'),
					'title' => $this->input->post('title'), 
					'price' => $this->input->post('price'), 
					'offer_price' => $this->input->post('offer_price'), 
					'duration' => $this->input->post('duration'), 
					'description' => $this->input->post('description'), 
					'is_active' => $this->input->post('status') 
				); 
				$data['parcat']=$this->tour_categories_model->getallCategory();
				$this->session->set_flashdata('errors', $data['errors']); 
				$this->load->view('includes/_header');
				$this->load->view('tour_package/tour_package_add', $data);
				$this->load->view('includes/_footer');
			}
			else{
				$data = array(
					'tour_cat_id' => $this->input->post('tour_cat_id'),
					'title' => $this->input->post('title'), 
					'price' => $this->input->post('price'), 
					'offer_price' => $this->input->post('offer_price'), 
					'duration' => $this->input->post('duration'), 
					'description' => $this->input->post('description'), 
					'is_active' => $this->input->post('status'),
					'created_by' => $this->session->userdata('admin_id'),
					'updated_by' => $this->session->userdata('admin_id'),
					'created_at' => date('Y-m-d : h:m:s'),
					'updated_at' => date('Y-m-d : h:m:s'),
				); 
				$old_image = $this->input->post('old_image');
				$path="assets/img/tour_package/"; 			
				if(!empty($_FILES['image']['name']))
				{
					if(!empty($old_image)){
						$this->functions->delete_file($old_image);
					}
					$result = $this->functions->file_insert($path, 'image', 'image', '9097152');
					if($result['status'] == 1){
						$data['image'] = $path.$result['msg'];
					}
					else{
						$this->session->set_flashdata('error', $result['msg']);
						redirect(base_url('tour_package/add'), 'refresh');
					}
				}
				$data = $this->security->xss_clean($data);
				$result = $this->tour_package_model->add_tour_package($data);
				if($result){
					$this->session->set_flashdata('success', 'tour_package has been added successfully!');
					redirect(base_url('tour_package'));
				}
			}
		}
		else{

			$data['title'] = 'Add Tour List';
			$data['parcat']=$this->tour_categories_model->getallCategory();

			$this->load->view('includes/_header', $data);
			$this->load->view('tour_package/tour_package_add');
			$this->load->view('includes/_footer');
		}
		
	}

	//-----------------------------------------------------------
	public function edit($id = 0){

		if($this->input->post('submit')){
			$this->form_validation->set_rules('title', 'Name', 'trim|strip_tags|xss_clean|required');
			$this->form_validation->set_rules('status', 'Status', 'trim|strip_tags|xss_clean|required');
			
			if ($this->form_validation->run() == FALSE) {
				$tour_packageData = $this->tour_package_model->get_tour_package_by_id($id);
				$data = array(
					'errors' => validation_errors()
				); 
				$data['tour_package'] = array(
					'tour_cat_id' => $this->input->post('tour_cat_id'),
					'title' => $this->input->post('title'), 
					'price' => $this->input->post('price'), 
					'offer_price' => $this->input->post('offer_price'), 
					'duration' => $this->input->post('duration'), 
					'description' => $this->input->post('description'), 
					'is_active' => $this->input->post('status')  
				); 
				$data['parcat']=$this->tour_categories_model->getallCategory();
				$this->session->set_flashdata('errors', $data['errors']);
				$this->load->view('includes/_header');
				$this->load->view('tour_package/tour_package_edit', $data);
				$this->load->view('includes/_footer');
			}
			else{
				$data = array(
					'tour_cat_id' => $this->input->post('tour_cat_id'),
					'title' => $this->input->post('title'), 
					'price' => $this->input->post('price'), 
					'offer_price' => $this->input->post('offer_price'), 
					'duration' => $this->input->post('duration'), 
					'description' => $this->input->post('description'), 
					'is_active' => $this->input->post('status'),
					'created_by' => $this->session->userdata('admin_id'),
					'updated_by' => $this->session->userdata('admin_id'),
					'created_at' => date('Y-m-d : h:m:s'),
					'updated_at' => date('Y-m-d : h:m:s'),
				); 
				$old_image = $this->input->post('old_image');
				$path="assets/img/tour_package/"; 			
				if(!empty($_FILES['image']['name']))
				{
					if(!empty($old_image)){
						$this->functions->delete_file($old_image);
					}
					$result = $this->functions->file_insert($path, 'image', 'image', '9097152');
					if($result['status'] == 1){
						$data['image'] = $path.$result['msg'];
					}
					else{
						$this->session->set_flashdata('error', $result['msg']);
						redirect(base_url('tour_package/edit/'.$id), 'refresh');
					}
				}
				$data = $this->security->xss_clean($data);
				$result = $this->tour_package_model->edit_tour_package($data, $id);
				if($result){
					$this->session->set_flashdata('success', 'Tour List has been updated successfully!');
					redirect(base_url('tour_package'));
				}
			}
		}
		else{
			$data['title'] = 'Edit Tour List';
			$data['tour_package'] = $this->tour_package_model->get_tour_package_by_id($id);
			$data['parcat']=$this->tour_categories_model->getallCategory();
			$this->load->view('includes/_header', $data);
			$this->load->view('tour_package/tour_package_edit', $data);
			$this->load->view('includes/_footer');
		}
	}

	//-----------------------------------------------------------
	public function delete($id = 0)
	{		
		$this->db->delete('ci_tour_package', array('id' => $id));
		$this->session->set_flashdata('success', 'tour_package has been deleted successfully!');
		redirect(base_url('tour_package'));
	}
 
	
	//---------------------------------------------------------------
	//  Export Categories PDF 
	public function create_tour_package_pdf(){
		$this->load->helper('pdf_helper'); // loaded pdf helper
		$data['all_tour_packages'] = $this->tour_package_model->get_tour_packages_for_export();		 
		$this->load->view('tour_package/tour_package_pdf', $data);
	}

	//---------------------------------------------------------------	
	// Export data in CSV format 
	public function export_csv(){ 

	   // file name 
		$filename = 'tour_packages_'.date('Y-m-d').'.csv'; 
		header("Content-Description: File Transfer"); 
		header("Content-Disposition: attachment; filename=$filename"); 
		header("Content-Type: application/csv; ");

	   // get data 
		$all_tour_packages = $this->tour_package_model->get_tour_packages_for_export();		 

	   // file creation 
		$file = fopen('php://output', 'w');

		$header = array("ID", "Name", "Email" ,"Mobile", "Created Date"); 

		fputcsv($file, $header);
		foreach ($all_tour_packages as $key=>$line){ 
			fputcsv($file,$line); 
		}
		fclose($file); 
		exit; 
	} 
}
?>