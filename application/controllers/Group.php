<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Group extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'User Group';
		
		$this->load->model('model_company');
		
	}

	public function index()
	{
		$this->render_template('admin_view/settings/userManagement/group/index', $this->data);
	}

	public function create()
	{
		$this->render_template('admin_view/settings/userManagement/group/create', $this->data);
	}

	public function update()
	{
	    $this->render_template('admin_view/settings/userManagement/group/edit', $this->data);
	}
	
// 	public function delete()
// 	{
// 		$id = $this->input->post('id_edit');
// 		$delete = $this->model_company->delete($id);	

// 		if($delete == true) {

//     		$this->session->set_flashdata('feedback','Record Deleted Successfully');
// 			$this->session->set_flashdata('feedback_class','alert alert-success');
// 			return redirect('group');
//     	}
//     	else{

//     		$this->session->set_flashdata('feedback','Unable to Delete Record');
// 			$this->session->set_flashdata('feedback_class','alert alert-danger');
// 			return redirect('group');
//     	}
// 	}
}