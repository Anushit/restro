<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Scroll_image extends MY_Controller {

	public function __construct(){

		parent::__construct(); 
		auth_check(); // check login auth 
		check_premissions($this->router->fetch_class(), $this->router->fetch_method());
		check_user_premissions($this->session->userdata('admin_id'), $this->router->fetch_class(), $this->router->fetch_method());
		$this->load->model('Scroll_image_model', 'scroll_image_model');
		$this->load->library('datatable'); // loaded my custom serverside datatable library
	}

	public function index(){

		$data['title'] = 'Scroll Image List';

		$this->load->view('includes/_header', $data);
		$this->load->view('scroll_image/scroll_image_list');
		$this->load->view('includes/_footer');
	}
	
	public function datatable_json(){				   					   
		$records = $this->scroll_image_model->get_all_scroll_image();
		$data = array();

		$i=0;
		foreach ($records['data']  as $row) 
		{  
			$status = ($row['is_active'] == 1)? 'checked': '';
			$action = "";
			if(@$this->general_user_premissions['scroll_image']['is_edit']==1){
				$action .= '<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('scroll_image/edit/'.$row['id']).'"> <i class="fa fa-pencil-square-o"></i></a>';
			}
			if(@$this->general_user_premissions['scroll_image']['is_delete']==1){
				$action .= '<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("scroll_image/delete/".$row['id']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>';
			}
			$data[]= array(
				++$i,
				$row['title'],
				$row['url'],
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

		$this->scroll_image_model->change_status();
	}
	public function add(){

		if($this->input->post('submit')){
			$this->form_validation->set_rules('title', ' Title', 'trim|strip_tags|xss_clean|required');
			$this->form_validation->set_rules('status', 'Status', 'trim|strip_tags|xss_clean|required');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$data['scroll_image'] = array(
					'id' => $id,
					'title' => $this->input->post('title'), 
					'url' => $this->input->post('url'),
					'is_active' => $this->input->post('status')
				); 
				$this->session->set_flashdata('errors', $data['errors']); 
				$this->load->view('includes/_header');
				$this->load->view('scroll_image/scroll_image_add', $data);
				$this->load->view('includes/_footer');
			}
			else{
				$data = array( 
					'title' => $this->input->post('title'), 
					'url' => $this->input->post('url'),
					'is_active' => $this->input->post('status'),
					'created_at' => date('Y-m-d,H:m:s'),
					'created_by' => $this->session->userdata('admin_id'),
					'updated_by' => $this->session->userdata('admin_id'),
					'updated_at' => date('Y-m-d,H:m:s'),
				);
				$old_image = $this->input->post('old_image');
				$path="assets/img/scroll_image/"; 				
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
						redirect(base_url('scroll_image/add'), 'refresh');
					}
				}
				$data = $this->security->xss_clean($data);
				$result = $this->scroll_image_model->add_scroll_image($data);
				if($result){
					$this->session->set_flashdata('success', 'scroll_image has been added successfully!');
					redirect(base_url('scroll_image'));
				}
			}
		}
		else{
			$data['title'] = 'Add scroll_image';
			$this->load->view('includes/_header', $data);
			$this->load->view('scroll_image/scroll_image_add');
			$this->load->view('includes/_footer');
		}
		
	}

	//-----------------------------------------------------------
	public function edit($id = 0){
	$data['scroll_image'] = $this->scroll_image_model->get_scroll_image_by_id($id);
		if($this->input->post('submit')){
			$this->form_validation->set_rules('title', ' Title', 'trim|strip_tags|xss_clean|required');
			///$this->form_validation->set_rules('url', 'url ', 'trim|required');
			///$this->form_validation->set_rules('size_suggestion', 'size suggestion ', 'trim|required');
			$this->form_validation->set_rules('status', 'Status', 'trim|strip_tags|xss_clean|required');

			if ($this->form_validation->run() == FALSE) {
				///$data['cms'] = $this->cms_model->get_cms_by_id($id);
				$error = array(
					'errors' => validation_errors()
				);
				$data['scroll_image'] = array(
					'id' => $id,
					'title' => $this->input->post('title'), 
					'url' => $this->input->post('url'),
					'is_active' => $this->input->post('status')
				); 
				$this->session->set_flashdata('errors', $error['errors']);
				$this->load->view('includes/_header');
				$this->load->view('scroll_image/scroll_image_edit', $data);
				$this->load->view('includes/_footer');
			}
			else{
				$data = array( 
					'title' => $this->input->post('title'), 
					'url' => $this->input->post('url'),
					'is_active' => $this->input->post('status'),
					'updated_by' => $this->session->userdata('admin_id'),
					'updated_at' => date('Y-m-d,H:m:s'),
				);
				$old_image = $this->input->post('old_image');
				$path="assets/img/scroll_image/"; 				
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
						redirect(base_url('scroll_image/edit'), 'refresh');
					}
				}
				$data = $this->security->xss_clean($data);
				$result = $this->scroll_image_model->edit_scroll_image($data, $id);
				if($result){
					$this->session->set_flashdata('success', 'Site image has been updated successfully!');
					redirect(base_url('scroll_image'));
				}
			}
		}
		else{
			$data['title'] = 'Edit Site Image'; 
			
			$this->load->view('includes/_header', $data);
			$this->load->view('scroll_image/scroll_image_edit', $data);
			$this->load->view('includes/_footer');
		}
	}

	//-----------------------------------------------------------
	public function delete($id = 0)
	{		
		$this->db->where('id', $id);
		$this->db->update('ci_scroll_images', array('deleted'=>1,'is_active'=>0));
		$this->session->set_flashdata('success', 'Site image  has been deleted successfully!');
		redirect(base_url('scroll_image'));

	}  


}

?>