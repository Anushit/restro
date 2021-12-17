<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Lead_category extends MY_Controller {

	public function __construct(){
		
		parent::__construct();
		auth_check(); // check login auth
		check_premissions($this->router->fetch_class(), $this->router->fetch_method());
		check_user_premissions($this->session->userdata('admin_id'), $this->router->fetch_class(), $this->router->fetch_method());
		$this->load->model('lead_category_model', 'lead_category_model');
		$this->load->library('datatable'); // loaded my custom serverside datatable library
	}

	public function index(){

		$data['title'] = 'Lead category list';
		$this->load->view('includes/_header', $data);
		$this->load->view('lead_category/category_list');
		$this->load->view('includes/_footer');
	}
	
	public function datatable_json(){				   					   
		$records = $this->lead_category_model->get_all_lead_category();
		$data = array();

		$i=0;
		foreach ($records['data']  as $row) 
		{  
			$status = ($row['is_active'] == 1)? 'checked': '';
			$action = "";
			if(@$this->general_user_premissions['lead_category']['is_edit']==1){
				$action .= '<a title="Manage Permission" class="update btn btn-sm btn-warning" href="'.base_url('lead_category/edit/'.$row['id']).'"> <i class="fa fa-edit"></i></a>';
			}
			if(@$this->general_user_premissions['lead_category']['is_delete']==1){
				$action .= '<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("lead_category/delete/".$row['id']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>';
			}
			$data[]= array(
				++$i,
				$row['name'],
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

		$this->lead_category_model->change_status();
	}


	//-----------------------------------------------------------
	public function add(){

		if($this->input->post('submit')){
			$this->form_validation->set_rules('name', 'role Name', 'trim|required|strip_tags|xss_clean|is_unique[ci_lead_category.name]');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$data['user'] = array( 
					'name' => $this->input->post('name'),
					'is_active' => $this->input->post('status'),
				);
				$this->session->set_flashdata('errors', $data['errors']);
				$this->load->view('includes/_header');
				$this->load->view('lead_category/add_category', $data);
				$this->load->view('includes/_footer');
			}
			else{
				$data = array(
					'name' => $this->input->post('name'),
					'created_at' => date('Y-m-d,h:m:s'),
					'is_active' => $this->input->post('status'),
				);
				
				$data = $this->security->xss_clean($data);
				$result = $this->lead_category_model->add_lead_category($data);

					if($result){
					$this->session->set_flashdata('success', 'Lead Category has been added successfully!');
					redirect(base_url('lead_category'));
				}
			}
		}
		else{

			$data['title'] = 'Add Lead Category';

			$this->load->view('includes/_header', $data);
			$this->load->view('lead_category/add_category');
			$this->load->view('includes/_footer');
		}
		
	}
	public function edit($id=NULL){
		$data['lead_category'] = $this->lead_category_model->get_lead_category_by_id($id);
		if($this->input->post('submit')){

			if($this->input->post('name') != $data['lead_category']['name']) {
			   $uis_unique =  '|is_unique[ci_lead_category.name]';
			} else {
			   $uis_unique =  '';
			}
			$this->form_validation->set_rules('name', 'Category Name', 'trim|required|strip_tags|xss_clean'.$uis_unique);

			if ($this->form_validation->run() == FALSE) {
				$errors = array(
					'errors' => validation_errors()
				);
				$errors['user'] = array( 
					'name' => $this->input->post('name'),
					'is_active' => $this->input->post('status'),
				);
				$this->session->set_flashdata('errors', $errors['errors']);
				$this->load->view('includes/_header');
				$this->load->view('lead_category/edit_category', $data);
				$this->load->view('includes/_footer');
			}
			else{
				$data = array(
					'name' => $this->input->post('name'),
					'created_at' => date('Y-m-d,h:m:s'),
					'is_active' => $this->input->post('status'),
				);
				
				$data = $this->security->xss_clean($data);
				$result = $this->lead_category_model->update_lead_category($id,$data);

					if($result){
					$this->session->set_flashdata('success', 'Lead Category has been Update successfully!');
					redirect(base_url('lead_category'));
				}
			}
		}
		else{

			$data['title'] = 'Edit Lead Category';

			$this->load->view('includes/_header', $data);
			$this->load->view('lead_category/edit_category');
			$this->load->view('includes/_footer');
		}
		
	}


	//-----------------------------------------------------------
	public function delete($id = 0)
	{		
		$this->db->where('id', $id);
		$this->db->update('ci_lead_category', array('deleted'=>1,'is_active'=>0,'deleted_at'=>date('Y-m-d,H:i:s')));
		$this->session->set_flashdata('success', 'Lead Category has been deleted successfully!');
		redirect(base_url('lead_category'));
	}

	//---------------------------------------------------------------


}


	?>
