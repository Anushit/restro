<?php defined('BASEPATH') OR exit('No direct script access allowed');
class City extends MY_Controller {

	public function __construct(){
		
		parent::__construct();
		auth_check(); // check login auth
		check_premissions($this->router->fetch_class(), $this->router->fetch_method());
		check_user_premissions($this->session->userdata('admin_id'), $this->router->fetch_class(), $this->router->fetch_method());
		$this->load->model('city_model', 'city_model');
		$this->load->library('datatable'); // loaded my custom serverside datatable library
	}

	public function index(){

		$data['title'] = 'Lead category list';
		$this->load->view('includes/_header', $data);
		$this->load->view('city/city_list');
		$this->load->view('includes/_footer');
	}
	
	public function datatable_json(){				   					   
		$records = $this->city_model->get_all_city();
		$data = array();

		$i=0;
		foreach ($records['data']  as $row) 
		{  
			$status = ($row['is_active'] == 1)? 'checked': '';
			$action = "";
			if(@$this->general_user_premissions['city']['is_edit']==1){
				$action .= '<a title="edit" class="update btn btn-sm btn-warning" href="'.base_url('city/edit/'.$row['id']).'"> <i class="fa fa-edit"></i></a>';
			}
			if(@$this->general_user_premissions['city']['is_delete']==1){
				$action .= '<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("city/delete/".$row['id']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>';
			}
			$data[]= array(
				++$i,
				$row['name'],
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

		$this->city_model->change_status();
	}


	//-----------------------------------------------------------
	public function add(){
		$data['country'] = $this->city_model->getallcountry();
		if($this->input->post('submit')){
			$this->form_validation->set_rules('name', 'City', 'trim|required|strip_tags|xss_clean|is_unique[ci_city.name]');

			if ($this->form_validation->run() == FALSE) {
				$errors = array(
					'errors' => validation_errors()
				);
				$data['user'] = array( 
					'name' => $this->input->post('name'),
					'country_id'=>$this->input->post('country'),
					'state_id'=>$this->input->post('state'),
					'is_active' => $this->input->post('status'),
				);
				$this->session->set_flashdata('errors', $errors['errors']);
				$this->load->view('includes/_header');
				$this->load->view('city/add_city', $data);
				$this->load->view('includes/_footer');
			}
			else{
				$data = array(
					'name' => $this->input->post('name'),
					'country_id'=>$this->input->post('country'),
					'state_id'=>$this->input->post('state'),
					'is_active' => $this->input->post('status'),
				);
				
				$data = $this->security->xss_clean($data);
				$result = $this->city_model->add_city($data);

					if($result){
					$this->session->set_flashdata('success', 'City has been added successfully!');
					redirect(base_url('city'));
				}
			}
		}
		else{

			$data['title'] = 'Add City';

			$this->load->view('includes/_header', $data);
			$this->load->view('city/add_city');
			$this->load->view('includes/_footer');
		}
		
	}
	public function edit($id=NULL){
		$data['city'] = $this->city_model->get_city_by_id($id);
		$data['country'] = $this->city_model->getallcountry();
		$data['state'] = $this->city_model->getallstate();

		if($this->input->post('submit')){

			if($this->input->post('name') != $data['city']['name']) {
			   $uis_unique =  '|is_unique[ci_city.name]';
			} else {
			   $uis_unique =  '';
			}
			$this->form_validation->set_rules('name', 'City Name', 'trim|required|strip_tags|xss_clean'.$uis_unique);

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
				$this->load->view('city/edit_city', $data);
				$this->load->view('includes/_footer');

			}else{

				$data = array(
					'name' => $this->input->post('name'),
					'country_id'=>$this->input->post('country'),
					'state_id'=>$this->input->post('state'),
					'is_active' => $this->input->post('status'),
				);
				
				$data = $this->security->xss_clean($data);
				$result = $this->city_model->update_city($id,$data);

					if($result){
					$this->session->set_flashdata('success', 'City has been Update successfully!');
					redirect(base_url('city'));
					}else{
						$this->session->set_flashdata('errors', 'No any changes!');
					redirect(base_url('city'));
					}
			}
		}
		else{

			$data['title'] = 'Edit City';

			$this->load->view('includes/_header', $data);
			$this->load->view('city/edit_city');
			$this->load->view('includes/_footer');
		}
		
	}
	public function get_state(){
		$countryId = $this->input->post('type'); 
		$query = $this->db->get_where('ci_state', array('is_active'=>1,'country_id'=>$countryId));
		$result = $query->result_array();
		
			  $data = '<select name="state"onchange="get_city(this)" id="state"  class="form-control">
	            <option value="">Select State</option>' ;
	           foreach ($result as $key => $value) {
	           $data .= '<option value="'.$value["id"].' "'.set_value("state").'>'. $value["name"].'
	            </option>';
	            } 
	           $data .= '</select>';
		
		$res = array('status' => TRUE, 'data' => $data);
			
			echo json_encode($res); exit;
	}
	public function get_city(){
		$stateId = $this->input->post('type'); 
		$query = $this->db->get_where('ci_city', array('is_active'=>1,'state_id'=>$stateId));
		$result = $query->result_array();
		
			  $data = '<select name="city" id="city" class="form-control">
	            <option value="">Select City</option>' ;
	           foreach ($result as $key => $value) {
	           $data .= '<option value="'.$value["id"].' "'.set_value("city").'>'. $value["name"].'
	            </option>';
	            } 
	           $data .= '</select>';
		
		$res = array('status' => TRUE, 'data' => $data);
			
			echo json_encode($res); exit;
	}

	//-----------------------------------------------------------
	public function delete($id = 0)
	{		
		$this->db->where('id', $id);
		$this->db->update('ci_city', array('deleted'=>1,'is_active'=>0,'deleted_at'=>date('Y-m-d,H:i:s')));
		$this->session->set_flashdata('success', 'City has been deleted successfully!');
		redirect(base_url('city'));
	}

	//---------------------------------------------------------------


}


	?>
