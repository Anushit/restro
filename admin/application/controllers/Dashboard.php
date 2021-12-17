<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends My_Controller {

	public function __construct(){
		parent::__construct();
		auth_check(); // check login auth
		check_premissions($this->router->fetch_class(), $this->router->fetch_method());
		
		$this->load->model('dashboard_model', 'dashboard_model');
	}

	//--------------------------------------------------------------------------
	public function index(){

		$data['all_users'] = $this->dashboard_model->get_all_users();
		$data['active_users'] = $this->dashboard_model->get_active_users();
		$data['deactive_users'] = $this->dashboard_model->get_deactive_users();
		$data['subadmin_users'] = $this->dashboard_model->get_subadmin_users();
		$data['sms'] = $this->dashboard_model->get_sms();
		$data['mail'] = $this->dashboard_model->get_mail();
		$data['whatsapp'] = $this->dashboard_model->get_whatsapp();
		$data['photo_gallery'] = $this->dashboard_model->get_photogallery();
		$data['video_gallery'] = $this->dashboard_model->get_vide3ogallery();
		$tables = array(
				'0'=>'ci_tour_package',
			    '1' => 'ci_banners',
			    '2' => 'ci_blogs',
			    '3' => 'ci_career',
			    '4' => 'ci_categories',
			    '5' => 'ci_cms',
			    '6' => 'ci_events',
			    '7' => 'ci_faq',
			    '8' => 'ci_gallery',
			    '9' => 'ci_inquiry',
			    '10' => 'ci_job_application',
			    '11' => 'ci_message',
			    '12' => 'ci_newsletter',
			    '13' => 'ci_newsupdates',
			    '14' => 'ci_partners',
			    '15' => 'ci_portfolio',
			    '16' => 'ci_products',
			    '17' => 'ci_role',
			    '18' => 'ci_scroll_images',
			    '19' => 'ci_services',
			    '20' => 'ci_site_images',
			    '21' => 'ci_teams',
			    '22' => 'ci_testimonials',
			    '23' => 'ci_tour_booking',
			    '24' => 'ci_tour_list'

		);
		for ($i=0; $i < count($tables); $i++) { 
			$coutnalltable[$tables[$i]] =  $this->db->count_all_results($tables[$i]);
		}


			
		$data['allcounts'] =$coutnalltable;
	
		$data['title'] = 'Dashboard';

		$this->load->view('includes/_header');
    	$this->load->view('dashboard/index', $data);
    	$this->load->view('includes/_footer');
	}

	 
	
}

?>	