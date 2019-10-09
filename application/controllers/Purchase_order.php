<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase_order extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Purchase Order';
		
		$this->load->model('model_purchaseorder');
		$this->load->model('model_ledger');
		$this->load->model('model_paymentmaster');
		$this->load->model('model_division');
		$this->load->model('model_branch');
		$this->load->model('model_location');
        $this->load->model('model_purchaseitem');
		$this->load->model('model_sku');

        $this->load->model('model_company');
        
		
	}
	
	public function fetchAllDataByIDStatus()
	{
	    $id = $_POST['porder_id'];
	   // $id = '15';
	    $data = $this->model_purchaseorder->fetchAllDataByIDStatus($id);
	    echo json_encode($data);
	}

	public function index()
	{
		$this->render_template('admin_view/purchase/purchaseOrder/index', $this->data);
	}
	
	public function fetchAllData()
	{
	    $data = $this->model_purchaseorder->fecthAllData();
	   // echo "<pre>"; print_r($data);exit;
	    
        if(empty($data))
        {
            $result['data'] = '';
        }
        else
        {
    	    $no=1;
            foreach($data as $key => $value)
            {
                $buttons = '';
                
                if($value['order_status'] != 'Close')
                {
                    $buttons .= '&nbsp; <a href="'.base_url().'purchase_order/update/'.$value['id'].'" class="btn btn-sm btn-info"><i class="fa fa-edit"></i>Edit</a>';
                
                    $buttons .= '&nbsp; <a href="'.base_url().'purchase_order/delete/'.$value['id'].'" onclick="return confirm(\' you want to delete?\');" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>Delete</a>';
                }
                
                $result['data'][$key] = array(
                                                
                                                $no,
                                                $value['order_no'],
                                                $value['order_status'],
                                                $value['invoice_value'],
                                                $buttons
                                            );
                $no++;

                // echo $value['order_status'];
            }
        }
        // print_r($result);
        echo json_encode($result);
        exit;
	} 

	public function create()
	{
	    $this->form_validation->set_rules('porder_no', 'Order Number', 'trim|required|is_unique[wo_purchaseorder.order_no]');
	    
	    if ($this->form_validation->run() == TRUE) {
	        
	        $data = array(
        					'order_no' => $this->input->post('porder_no'),
        					'purac_id' => $this->input->post('purchase_account'),
        					'ledger_id' => $this->input->post('account'),
        					'payment_id' => $this->input->post('paytype'),
        					'division_id' => $this->input->post('division'),
        					'branch_id' => $this->input->post('branch'),
        					'location_id' => $this->input->post('location'),
        					'purtype_id' => $this->input->post('purchase_type'),
        					'invoice_value' => $this->input->post('total_invoice_value'),
        					'order_status' => $this->input->post('status'),
        					'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'created_by' => $this->session->userdata('wo_id')
        				);

        	// echo "<pre>"; print_r($data); exit();
        	$created_id = $this->model_purchaseorder->create($data);
        	
        	if($created_id == true) {
        		
        		$this->session->set_flashdata('feedback','Data Saved Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				
				return redirect('purchase_order/update/'.$created_id);
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('purchase_order');
        	}
	    }
	    else 
	    {
	        $this->data['ledgerPurAccount'] = $this->model_ledger->ledgerPurType();
    	    $this->data['ledgerAccount'] = $this->model_ledger->fecthLedgerAccountData();
    	    $this->data['ledgerPurType'] = $this->model_ledger->ledgerPurType();
    	    $this->data['paytype'] = $this->model_paymentmaster->fecthAllData();
    	    $this->data['division'] = $this->model_division->fecthAllData();
    	    $this->data['branch'] = $this->model_branch->fecthAllData();
    	    $this->data['location'] = $this->model_location->fecthAllData();
    	     
    		$this->render_template('admin_view/purchase/purchaseOrder/create', $this->data);   
	    }
	}

	public function update()
	{
	    $id = $this->uri->segment(3);
	    
	    
	    $this->form_validation->set_rules('porder_no', 'Order Number', 'trim|required');
	    
	    if ($this->form_validation->run() == TRUE) {
	        
	        $data = array(
        					'id' => $this->input->post('id'),
        					'order_no' => $this->input->post('porder_no'),
        					'purac_id' => $this->input->post('purchase_account'),
        					'ledger_id' => $this->input->post('account'),
        					'payment_id' => $this->input->post('paytype'),
        					'division_id' => $this->input->post('division'),
        					'branch_id' => $this->input->post('branch'),
        					'location_id' => $this->input->post('location'),
        					'purtype_id' => $this->input->post('purchase_type'),
        					'invoice_value' => $this->input->post('total_invoice_value'),
        					'order_status' => $this->input->post('status'),
        					'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'modified_by' => $this->session->userdata('wo_id')
        				);

        // 	echo "<pre>"; print_r($data); exit();
        	$create = $this->model_purchaseorder->update($data);

        	if($create == true) {
        		
        		$this->session->set_flashdata('feedback','Record Update Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				return redirect('purchase_order');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Update Record');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('purchase_order');
        	}
	    }
	    else
	    {
            $this->data['ledgerPurAccount'] = $this->model_ledger->ledgerPurType();
            $this->data['ledgerAccount'] = $this->model_ledger->fecthLedgerAccountData();
            
    	    // $this->data['ledgerPurAccount'] = $this->model_ledger->fecthLedgerPurAccount();
    	    // $this->data['ledgerAccount'] = $this->model_ledger->fecthLedgerAccount();
    	    $this->data['ledgerPurType'] = $this->model_ledger->ledgerPurType();
    	    $this->data['paytype'] = $this->model_paymentmaster->fecthAllData();
    	    $this->data['division'] = $this->model_division->fecthAllData();
    	    $this->data['branch'] = $this->model_branch->fecthAllData();
    	    $this->data['location'] = $this->model_location->fecthAllData();
    	    
    	    $this->data['allData'] = $this->model_purchaseorder->fecthAllDatabyID($id);
    	    
            $data = array(
                            'order_id' => $id,
                            'ordertype' => 'porder'
                        );

    	    // $this->data['allData'] = $this->model_purchaseitem->fecthAllDataByOrderID($id);
    	    $this->data['pitemData'] = $this->model_purchaseitem->fecthOrderByInvoiceIDType($data);;
    	   // echo "<pre>"; print_r($pitemData); exit;
    	    
    	    $this->render_template('admin_view/purchase/purchaseOrder/update', $this->data);
	    }
	}
	
	public function showUpdate()
	{
	    $id = $this->uri->segment(3);
	    
	    $this->data['allData'] = $this->model_purchaseorder->fecthAllDatabyID($id);
	    
	    $this->form_validation->set_rules('porder_no', 'Order Number', 'trim|required');
	    
	    if ($this->form_validation->run() == TRUE) {
	        
	        $data = array(
        					'id' => $this->input->post('id'),
        					'order_no' => $this->input->post('porder_no'),
        					'purac_id' => $this->input->post('purchase_account'),
        					'ledger_id' => $this->input->post('account'),
        					'payment_id' => $this->input->post('paytype'),
        					'division_id' => $this->input->post('division'),
        					'branch_id' => $this->input->post('branch'),
        					'location_id' => $this->input->post('location'),
        					'purtype_id' => $this->input->post('purchase_type'),
        					'invoice_value' => $this->input->post('total_invoice_value'),
        					'order_status' => $this->input->post('status'),
        					'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'modified_by' => $this->session->userdata('wo_id')
        				);

        // 	echo "<pre>"; print_r($data); exit();
        	$create = $this->model_purchaseorder->update($data);

        	if($create == true) {
        		
        		$this->session->set_flashdata('feedback','Record Update Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				return redirect('purchase_order');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Update Record');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('purchase_order');
        	}
	    }
	    else
	    {
    	    $this->data['ledgerPurAccount'] = $this->model_ledger->fecthLedgerPurAccount();
    	    $this->data['ledgerAccount'] = $this->model_ledger->fecthLedgerAccount();
    	    $this->data['ledgerPurType'] = $this->model_ledger->ledgerPurType();
    	    $this->data['paytype'] = $this->model_paymentmaster->fecthAllData();
    	    $this->data['division'] = $this->model_division->fecthAllData();
    	    $this->data['branch'] = $this->model_branch->fecthAllData();
    	    $this->data['location'] = $this->model_location->fecthAllData();
    	    
    	    $this->data['allData'] = $this->model_purchaseorder->fecthAllData($id);
    	    $this->data['pitemData'] = $this->model_purchaseitem->fecthAllDataByOrderID($id);
    	    
    		$this->render_template('admin_view/purchase/purchaseOrder/showUpdate', $this->data);
	    }
	}
	
	public function delete()
	{
		$id = $this->uri->segment(3);

		$delete = $this->model_purchaseorder->delete($id);	

		if($delete == true) {
            
            $this->model_purchaseitem->deleteOrderDataByOrderId($id);
            
            $this->model_purchaseitem->deleteItemByOrderId($id);
            
    		$this->session->set_flashdata('feedback','Record Deleted Successfully');
			$this->session->set_flashdata('feedback_class','alert alert-success');
			return redirect('purchase_order');
    	}
    	else{

    		$this->session->set_flashdata('feedback','Unable to Delete Record');
			$this->session->set_flashdata('feedback_class','alert alert-danger');
			return redirect('purchase_order');
    	}
	}
}