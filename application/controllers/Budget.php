<?php 

defined('BASEPATH') OR exit('No direct script access allowed');


class Budget extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		// error_reporting(0);

		$this->data['page_title'] = 'Budget';

		$this->load->model('model_ledger');
		$this->load->model('model_budget');
		$this->load->model('model_globalsearch');
		$this->load->model('model_company');
		

	}

	public function index()
	{
		$this->data['allData'] = $this->model_budget->fecthAllData();
		// echo "<pre>"; print_r($allData); exit();
		$this->render_template('admin_view/budgetingMaster/index', $this->data);
	}

	public function create()
	{
		$this->form_validation->set_rules('start_date', 'Budger Start Date', 'trim|required');
		$this->form_validation->set_rules('end_date', 'Budger End Date', 'trim|required');
	    
	    if ($this->form_validation->run() == TRUE) {
	        
	       	// echo "<pre>"; print_r($_POST); //exit();

	    	$data = array(
	    					'fromdate' => $this->input->post('start_date'),
	    					'todate' => $this->input->post('end_date'),
	    					'annualsales' => $this->input->post('annual_sale'),
	    					'quarterlysales' => $this->input->post('quarterly_sale'),
	    					'monthlysales' => $this->input->post('monthly_sale'),
	    					'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'created_by' => $this->session->userdata('wo_id')
	    				);

	       	// echo "<pre>"; print_r($data); //exit();

	        $created_id = $this->model_budget->create($data);
	        // $created_id = 1;

	        if($created_id) {

	        	$countLedger = count($this->input->post('ledgerValue'));

	        	for ($i=0; $i < $countLedger ; $i++) { 
	        		
	        		$ledgerData = $this->model_ledger->fecthAllDatabyName($this->input->post('ledgerValue')[$i]);

	        		// echo "<pre>"; print_r($ledgerData);

	        		$budgetData = array(
	        						'budget_id' => $created_id,
	        						'ledger_id' => $ledgerData['id'],
	        						'annual' => $this->input->post('annualPerValue')[$i],
	        						'percentage' => $this->input->post('percentageValue')[$i],
	        						'quarterly' => $this->input->post('quarterlyValue')[$i],
	        						'monthly' => $this->input->post('monthlyValue')[$i],
	        						'company_id' => $this->session->userdata('wo_company'),
		        					// 'city_id' => $this->session->userdata('wo_city'),
		        					'store_id' => $this->session->userdata('wo_store'),
		        					'created_by' => $this->session->userdata('wo_id')
	        					);

	        		$result = $this->model_budget->createItem($budgetData);
	        	}

	        	if($result)
	        	{
	        		$this->session->set_flashdata('feedback','Data Saved Successfully');
					$this->session->set_flashdata('feedback_class','alert alert-success');
					return redirect('budget');
	        	}
	        	else
	        	{
	        		$this->session->set_flashdata('feedback','Unable to Saved Data');
					$this->session->set_flashdata('feedback_class','alert alert-danger');
					return redirect('budget/create');
	        	}

	        }
	        else
	        {
	        	$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('budget/create');
	        }
	   	}
	   	else
	   	{
	   		// $this->data['ledger'] = $this->model_ledger->fecthDataByType();

	   		$this->data['ledger'] = $this->model_ledger->fecthAllData(); 
			// echo "<pre>"; print_r($ledger); exit();
			$this->render_template('admin_view/budgetingMaster/create', $this->data);
	   	}
	}

	public function update()
	{
		$id = $this->uri->segment(3);

		$this->form_validation->set_rules('start_date', 'Budger Start Date', 'trim|required');
		$this->form_validation->set_rules('end_date', 'Budger End Date', 'trim|required');
	    
	    if ($this->form_validation->run() == TRUE) {
	        
	       	// echo "<pre>"; print_r($_POST); //exit();

	    	$data = array(
	    					'id' => $this->input->post('id'),
	    					'fromdate' => $this->input->post('start_date'),
	    					'todate' => $this->input->post('end_date'),
	    					'annualsales' => $this->input->post('annual_sale'),
	    					'quarterlysales' => $this->input->post('quarterly_sale'),
	    					'monthlysales' => $this->input->post('monthly_sale'),
	    					'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'created_by' => $this->session->userdata('wo_id')
	    				);

	       	// echo "<pre>"; print_r($data); //exit();

	        $created_id = $this->model_budget->update($data);
	        // $created_id = 1;

	        if($created_id) {

				$this->model_budget->deleteBudgetItem($this->input->post('id'));	

	        	$countLedger = count($this->input->post('ledgerValue'));

	        	for ($i=0; $i < $countLedger ; $i++) { 
	        		
	        		$ledgerData = $this->model_ledger->fecthAllDatabyName($this->input->post('ledgerValue')[$i]);

	        		// echo "<pre>"; print_r($ledgerData);

	        		$budgetData = array(
	        						'budget_id' => $this->input->post('id'),
	        						'ledger_id' => $ledgerData['id'],
	        						'annual' => $this->input->post('annualPerValue')[$i],
	        						'percentage' => $this->input->post('percentageValue')[$i],
	        						'quarterly' => $this->input->post('quarterlyValue')[$i],
	        						'monthly' => $this->input->post('monthlyValue')[$i],
	        						'company_id' => $this->session->userdata('wo_company'),
		        					// 'city_id' => $this->session->userdata('wo_city'),
		        					'store_id' => $this->session->userdata('wo_store'),
		        					'created_by' => $this->session->userdata('wo_id')
	        					);
	       			// echo "<pre>"; print_r($budgetData); //exit();

	        		$result = $this->model_budget->createItem($budgetData);
	        	}
	        	// exit();
	        	if($result)
	        	{
	        		$this->session->set_flashdata('feedback','Data Saved Successfully');
					$this->session->set_flashdata('feedback_class','alert alert-success');
					return redirect('budget');
	        	}
	        	else
	        	{
	        		$this->session->set_flashdata('feedback','Unable to Saved Data');
					$this->session->set_flashdata('feedback_class','alert alert-danger');
					return redirect('budget/update/'.$this->input->post('id'));
	        	}
	        }
	        else
	        {
	        	$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('budget/update/'.$this->input->post('id'));
	        }
	   	}
	   	else
	   	{
	   		$this->data['ledger'] = $this->model_ledger->fecthAllData();
	   		// $this->data['ledger'] = $this->model_ledger->fecthDataByType();
	   		$this->data['allData'] = $this->model_budget->fecthDataById($id);

			// echo "<pre>"; print_r($allData); exit();
			$this->render_template('admin_view/budgetingMaster/update', $this->data);
	   	}
	}

	public function delete()
	{
		$id = $this->uri->segment(3);
		$delete = $this->model_budget->delete($id);	

		if($delete == true) {

			$delete = $this->model_budget->deleteBudgetItem($id);	

    		$this->session->set_flashdata('feedback','Record Deleted Successfully');
			$this->session->set_flashdata('feedback_class','alert alert-success');
			return redirect('budget');
    	}
    	else{

    		$this->session->set_flashdata('feedback','Unable to Delete Record');
			$this->session->set_flashdata('feedback_class','alert alert-danger');
			return redirect('budget');
    	}
	}

	public function report()
	{
		$this->form_validation->set_rules('report', 'Budget Report', 'trim|required');
		
        if ($this->form_validation->run() == TRUE) {

        	// echo "<pre>"; print_r($_POST);

        	if($_POST['monthly'] != '0' && $_POST['quater'] == '0' && $_POST['year'] == '0')
        	{
				// echo "<pre>"; print_r($_POST);
				$this->data['budgetItem_month'] = $this->model_budget->fecthDatayBudgerItem();
				
				$this->data['month'] = $_POST['monthly'];
				$this->data['quater'] = $_POST['quater'];  
				$this->data['year'] = $_POST['year'];  
        	}
        	else if($_POST['quater'] != '0' && $_POST['monthly'] == '0' && $_POST['year'] == '0')
        	{
        		$this->data['budgetItem_quater'] = $this->model_budget->fecthDatayBudgerItem();
				
				$this->data['month'] = $_POST['monthly'];
				$this->data['quater'] = $_POST['quater'];
				$this->data['year'] = $_POST['year'];  

        	}
        	else if($_POST['year'] != '0' && $_POST['monthly'] == '0' && $_POST['quater'] == '0')
        	{
        		$this->data['budgetItem_year'] = $this->model_budget->fecthDatayBudgerItem();
				
				$this->data['month'] = $_POST['monthly'];
				$this->data['quater'] = $_POST['quater'];
				$this->data['year'] = $_POST['year'];  
        	}
        	else
        	{
        		$this->session->set_flashdata('feedback','Select Any One Option');
				$this->session->set_flashdata('feedback_class','alert alert-danger');

        		return redirect('budget/report');
        	}

			$this->render_template('admin_view/budgetingMaster/report', $this->data);

        }
        else
        {
        	$this->data['allData'] = $this->model_budget->fecthAllData();

			$this->render_template('admin_view/budgetingMaster/report', $this->data);
        }
	}

}