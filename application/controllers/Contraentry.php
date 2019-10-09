<?php 

defined('BASEPATH') OR exit('No direct script access allowed');


class Contraentry extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Contra Entry';

        $this->load->library('number_to_word');
		
        $this->load->model('model_paymentmaster');

        $this->load->model('model_purchaseledger');
        $this->load->model('model_ledger');

		$this->load->model('model_contraentry');

        $this->load->model('model_company');
        $this->load->model('model_state');
	}

    public function fetchAllData()
    {
        $data = $this->model_contraentry->fecthAllData();
        // echo "<pre>"; print_r($data); exit;

        if(empty($data))
        {
            $result['data'] = '';
        }
        else
        {
            $no=1;
            foreach($data as $key => $value)
            {
                $from_paymenttype = $this->model_paymentmaster->fecthDataByID($value['from_paymenttypeid']);
                $to_paymenttype = $this->model_paymentmaster->fecthDataByID($value['to_paymenttypeid']);

                $buttons = '';
                
                $buttons .= '&nbsp; <a href="'.base_url().'contraentry/update/'.$value['id'].'" class="btn btn-sm btn-info"><i class="fa fa-edit"></i>Edit</a>';
                    
                $buttons .= '&nbsp; <a href="'.base_url().'contraentry/delete/'.$value['id'].'" onclick="return confirm(\' you want to delete?\');" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>Delete</a>';

                $buttons .= '&nbsp; <a href="'.base_url().'contraentry/printVoucher/'.$value['id'].'" class="btn btn-sm btn-info"><i class="fa fa-file-text"></i> Print</a>';

                
                $result['data'][$key] = array(
                                                $no,
                                                $value['date'],
                                                $from_paymenttype['payment_name'],
                                                $to_paymenttype['payment_name'],
                                                "Contra Entry ".$value['voucherno'],
                                                $value['voucherno'],
                                                $value['amount'],
                                                $buttons
                                            );
                $no++;
            }
        }
        // echo "<pre>"; print_r($result);
        echo json_encode($result);
        exit;
    }

	public function index()
	{
	   // $this->data['divisionDetails'] = $this->model_division->fecthAllData();
	    
		$this->render_template('admin_view/entriesMaster/contraMaster/index', $this->data);
	}
	   
	public function create()
	{
	   $this->form_validation->set_rules('voucher_no', 'Voucher Number', 'trim|required');

        if ($this->form_validation->run() == TRUE) {

            // echo "<pre>"; print_r($_POST);            exit();
            
        	$data = array(
        					'voucherno' => $this->input->post('voucher_no'),
                            'date' => $this->input->post('entry_date'),
                            'from_paymenttypeid' => $this->input->post('from_paymentType'),
                            'to_paymenttypeid' => $this->input->post('to_paymentType'),
                            'amount' => $this->input->post('amount'),
                            'referernceno' => $this->input->post('reference'),
                            'remark' => $this->input->post('remark'),
                            'company_id' => $this->session->userdata('wo_company'),
                            // 'city_id' => $this->session->userdata('wo_city'),
                            'store_id' => $this->session->userdata('wo_store'),
                            'created_by' => $this->session->userdata('wo_id')
        				);

        	// echo "<pre>"; print_r($data); exit();
        	$created_id = $this->model_contraentry->create($data);

        	if($created_id == true) {

                $fromPaymentTypeData = $this->model_paymentmaster->fecthDataByID($this->input->post('from_paymentType'));

                $fromLedgerData = $this->model_ledger->fecthDataByID1($fromPaymentTypeData['ledger_id']);

                $fromLedgerAmt = $fromLedgerData['closing_balance'] + $_POST['amount'];

                $fromLedgerDataUpdate = array(
                                                    'id' => $fromLedgerData['id'],
                                                    'opening_balance' => $fromLedgerData['closing_balance'],
                                                    'closing_balance' => $fromLedgerAmt
                                                );
                $fromLedgerData = array(
                                        'purchase_id' => $created_id,
                                        'ledger_id' => $fromLedgerData['id'],
                                        'invoice_date' => $_POST['entry_date'],

                                        'entry_date' => $_POST['entry_date'],
                                        'purchase_type' => "contraentry",
                                        'dr_cr' => 'CR',
                                        'amt' => $_POST['amount'],
                                        'opening_bal' => $fromLedgerData['closing_balance'],
                                        'closing_bal' => $fromLedgerAmt,
                                        'company_id' => $this->session->userdata('wo_company'),
                                        // 'city_id' => $this->session->userdata('wo_city'),
                                        'store_id' => $this->session->userdata('wo_store'),
                                        'created_by' => $this->session->userdata('wo_id')
                                    );
                
                $this->model_purchaseledger->create($fromLedgerData);
                $this->model_ledger->update($fromLedgerDataUpdate);
                
                $toPaymentTypeData = $this->model_paymentmaster->fecthDataByID($this->input->post('to_paymentType'));
                $toLedgerData = $this->model_ledger->fecthDataByID1($toPaymentTypeData['ledger_id']);

                $toLedgerAmt = $toLedgerData['closing_balance'] - $_POST['amount'];

                $toLedgerDataUpdate = array(
                                                    'id' => $toLedgerData['id'],
                                                    'opening_balance' => $toLedgerData['closing_balance'],
                                                    'closing_balance' => $toLedgerAmt
                                                );
                $toLedgerData = array(
                                        'purchase_id' => $created_id,
                                        'ledger_id' => $toLedgerData['id'],
                                        'invoice_date' => $_POST['entry_date'],
                                        
                                        'entry_date' => $_POST['entry_date'],
                                        'purchase_type' => "contraentry",
                                        'dr_cr' => 'DR',
                                        'amt' => $_POST['amount'],
                                        'opening_bal' => $toLedgerData['closing_balance'],
                                        'closing_bal' => $toLedgerAmt,
                                        'company_id' => $this->session->userdata('wo_company'),
                                        // 'city_id' => $this->session->userdata('wo_city'),
                                        'store_id' => $this->session->userdata('wo_store'),
                                        'created_by' => $this->session->userdata('wo_id')
                                    );
                
                $this->model_purchaseledger->create($toLedgerData);
                $this->model_ledger->update($toLedgerDataUpdate);
                

                if($_POST['save'])
                {
                    $this->session->set_flashdata('feedback','Data Saved Successfully');
                    $this->session->set_flashdata('feedback_class','alert alert-success');
                    return redirect('contraentry');
                }
                else
                {
                    redirect('contraentry/printVoucher/'.$created_id);
                }
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('contraentry/create');
        	}
        }
        else
        {
            $orderNo = $this->model_contraentry->lastrecord();
            
            if($orderNo == '')
            {
                $this->data['voucherno']  = '1';
               // echo $code = '0000001';
            }
            else
            {
                $np = $orderNo['voucherno'];
                // $code = substr($np, 1); 
                
                $np = $np + 1;
                // $code = sprintf('%05d',$code);
                
                $this->data['voucherno'] = $np;
            }

            $this->data['paymenttype'] = $this->model_paymentmaster->fecthAllData();

            $this->render_template('admin_view/entriesMaster/contraMaster/create', $this->data);
        }
	}
	
	public function update()
	{ 
        $id = $this->uri->segment(3);

	    $this->form_validation->set_rules('id', 'Contra ID', 'trim|required');

        if ($this->form_validation->run() == TRUE) {

            // echo "<pre>"; print_r($_POST); exit();

        	$data = array(
        	                'id' => $this->input->post('id'),
        					'voucherno' => $this->input->post('voucher_no'),
                            'date' => $this->input->post('entry_date'),
                            'from_paymenttypeid' => $this->input->post('from_paymentType'),
                            'to_paymenttypeid' => $this->input->post('to_paymentType'),
                            'amount' => $this->input->post('amount'),
                            'referernceno' => $this->input->post('reference'),
                            'remark' => $this->input->post('remark'),
                            'company_id' => $this->session->userdata('wo_company'),
                            // 'city_id' => $this->session->userdata('wo_city'),
                            'store_id' => $this->session->userdata('wo_store'),
        					'modified_by' => $this->session->userdata('wo_id')
        				);

        	// echo "<pre>"; print_r($data); exit();
        	
        	$update = $this->model_contraentry->update($data);

        	if($update == true) {

                $entryData = array(
                    'purchase_id' => $this->input->post('id'),
                    'purchase_type' => 'contraentry'
                );

                $ledgerData = $this->model_purchaseledger->fecthAllDataByPurchaseID($entryData);

                foreach ($ledgerData as $key => $value) {

                    $updateLedger = array(
                                            'id' => $value['id'],
                                            'amt' => $_POST['amount']
                                        );
                    // echo "<pre>"; print_r($updateLedger);
                    $this->model_purchaseledger->update($updateLedger);
                }

                if($_POST['save'])
                {
                    $this->session->set_flashdata('feedback','Data Saved Successfully');
                    $this->session->set_flashdata('feedback_class','alert alert-success');
                    return redirect('contraentry');
                }
                else
                {
                    redirect('contraentry/printVoucher/'.$this->input->post('id'));
                }
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('contraentry/update/'.$this->input->post('id'));
        	}
        }
        else
        {
            $this->data['paymenttype'] = $this->model_paymentmaster->fecthAllData();
            
            $this->data['allData'] = $this->model_contraentry->fecthDataByID($id);

            $this->render_template('admin_view/entriesMaster/contraMaster/update', $this->data);
        }
	}
	
	public function delete()
	{
		$id = $this->uri->segment(3);
		$delete = $this->model_contraentry->delete($id);	

		if($delete == true) {
		    
		     $type = "contraentry";
		    
		    $this->model_purchaseledger->deletePurchaseID($id, $type);

            $entryData = array(
                                    'purchase_id' => $this->input->post('id'),
                                    'purchase_type' => 'contraentry'
                                );

            $ledgerEntriesData = $this->model_purchaseledger->fecthAllDataByPurchaseID($entryData);

            foreach ($ledgerEntriesData as $key => $value) {

                $this->model_purchaseledger->delete($value['id']);
            }

    		$this->session->set_flashdata('feedback','Record Deleted Successfully');
			$this->session->set_flashdata('feedback_class','alert alert-success');
			return redirect('contraentry');
    	}
    	else{

    		$this->session->set_flashdata('feedback','Unable to Delete Record');
			$this->session->set_flashdata('feedback_class','alert alert-danger');
			return redirect('contraentry');
    	}
	}
	
    public function printVoucher()
    {
        $id = $this->uri->segment(3);
        // echo $id;

        $company_id = $this->session->userdata['wo_company'];
        $this->data['companyDetails'] = $this->model_company->fecthDataByID($company_id);

        $this->data['allData'] = $this->model_contraentry->fecthDataByID($id);

        $this->render_template('admin_view/entriesMaster/contraMaster/report', $this->data);
    }
}