<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Journalentry extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Journal Entry';

        $this->load->library('number_to_word');

		$this->load->model('model_ledger');
        $this->load->model('model_journalentry');
        $this->load->model('model_company');
        $this->load->model('model_state');
        $this->load->model('model_ledgerentry');
        $this->load->model('model_purchaseledger');
        $this->load->model('model_company');
        
	}

    public function fetchAllData()
    {
        $data = $this->model_journalentry->fecthAllData();
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
                $crledgerData = $this->model_ledger->fecthDataByID($value['cr_ledgerid']);
                $drledgerData = $this->model_ledger->fecthDataByID($value['dr_ledgerid']);

                $buttons = '';
                
                $buttons .= '&nbsp; <a href="'.base_url().'journalentry/update/'.$value['id'].'" class="btn btn-sm btn-info"><i class="fa fa-edit"></i>Edit</a>';
                    
                $buttons .= '&nbsp; <a href="'.base_url().'journalentry/delete/'.$value['id'].'" onclick="return confirm(\' you want to delete?\');" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>Delete</a>';

                $buttons .= '&nbsp; <a href="'.base_url().'journalentry/printVoucher/'.$value['id'].'" class="btn btn-sm btn-info"><i class="fa fa-file-text"></i> Print</a>';

                
                $result['data'][$key] = array(
                                                $no,
                                                $value['date'],
                                                $crledgerData['ledger_name'],
                                                $drledgerData['ledger_name'],
                                                $value['remark'],
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
		$this->render_template('admin_view/entriesMaster/journalEntries/index', $this->data);
	}
	   
	public function create()
	{
	   $this->form_validation->set_rules('voucher_no', 'Journal Number', 'trim|required');

        if ($this->form_validation->run() == TRUE) {

            $fromLedger = $this->model_ledger->fecthDataByID1($this->input->post('credit'));
            $toLedger = $this->model_ledger->fecthDataByID1($this->input->post('debit'));

            $fromclosing_balance = $fromLedger['closing_balance'] + $this->input->post('amount');
            $toclosing_balance = $toLedger['closing_balance'] - $this->input->post('amount');

            // echo "<pre>"; print_r($fromLedger); echo "<pre>"; print_r($toLedger); exit();

        	$data = array(
        					'voucherno' => $this->input->post('voucher_no'),
                            'date' => $this->input->post('entry_date'),
                            'cr_ledgerid' => $this->input->post('credit'),
                            'dr_ledgerid' => $this->input->post('debit'),
                            'amount' => $this->input->post('amount'),
                            'amount_dr' => $this->input->post('amount'),
                            'referernceno' => $this->input->post('reference'),
                            'remark' => $this->input->post('remark'),
                            'fromopeningstock' => $fromLedger['closing_balance'],
                            'fromclosingstock' => $fromclosing_balance,
                            'toopeningstock' => $toLedger['closing_balance'],
                            'toclosingstock' => $toclosing_balance,
                            'company_id' => $this->session->userdata('wo_company'),
                            // 'city_id' => $this->session->userdata('wo_city'),
                            'store_id' => $this->session->userdata('wo_store'),
                            'created_by' => $this->session->userdata('wo_id')
        				);
            // echo "<pre>"; print_r($data); //exit();
            // $fromLedgerUpdateData = array(
            //                 'id' => $fromLedger['id'],
            //                 'opening_balance' => $fromLedger['closing_balance'],
            //                 'closing_balance' => $fromclosing_balance
            //             );

            // $toLedgerUpdateData = array(
            //                 'id' => $toLedger['id'],
            //                 'opening_balance' => $toLedger['closing_balance'],
            //                 'closing_balance' => $toclosing_balance
            //             );

        	// echo "<pre>"; print_r($fromLedgerUpdateData); echo "<pre>"; print_r($toLedgerUpdateData); exit();

            // $created_id = 1;
        	$created_id = $this->model_journalentry->create($data);

        	if($created_id) {


                // ACCOUNT TYPE LEDGER 
                $fromLedgerAmt = $fromLedger['closing_balance'] + $_POST['amount'];

                $fromLedgerDataUpdate = array(
                                                    'id' => $fromLedger['id'],
                                                    'opening_balance' => $fromLedger['closing_balance'],
                                                    'closing_balance' => $fromLedgerAmt
                                                );
                $fromLedgerData = array(
                                        'purchase_id' => $created_id,
                                        'ledger_id' => $fromLedger['id'],
                                        'invoice_date' => $_POST['entry_date'],

                                        'entry_date' => $_POST['entry_date'],
                                        'purchase_type' => "journalentry",
                                        'dr_cr' => 'CR',
                                        'amt' => $_POST['amount'],
                                        'opening_bal' => $fromLedger['closing_balance'],
                                        'closing_bal' => $fromLedgerAmt,
                                        'company_id' => $this->session->userdata('wo_company'),
                                        // 'city_id' => $this->session->userdata('wo_city'),
                                        'store_id' => $this->session->userdata('wo_store'),
                                        'created_by' => $this->session->userdata('wo_id')
                                    );
                // echo "<pre>"; print_r($fromLedgerDataUpdate);
                // echo "<pre>"; print_r($fromLedgerData);
                
                $this->model_purchaseledger->create($fromLedgerData);
                $this->model_ledger->update($fromLedgerDataUpdate);

                $toLedgerAmt = $toLedger['closing_balance'] - $_POST['amount'];

                $toLedgerDataUpdate = array(
                                                    'id' => $toLedger['id'],
                                                    'opening_balance' => $toLedger['closing_balance'],
                                                    'closing_balance' => $toLedgerAmt
                                                );
                $toLedgerData = array(
                                        'purchase_id' => $created_id,
                                        'ledger_id' => $toLedger['id'],
                                        'invoice_date' => $_POST['entry_date'],
                                        
                                        'entry_date' => $_POST['entry_date'],
                                        'purchase_type' => "journalentry",
                                        'dr_cr' => 'DR',
                                        'amt' => $_POST['amount'],
                                        'opening_bal' => $toLedger['closing_balance'],
                                        'closing_bal' => $toLedgerAmt,
                                        'company_id' => $this->session->userdata('wo_company'),
                                        // 'city_id' => $this->session->userdata('wo_city'),
                                        'store_id' => $this->session->userdata('wo_store'),
                                        'created_by' => $this->session->userdata('wo_id')
                                    );
                // echo "<pre>"; print_r($toLedgerDataUpdate);
                // echo "<pre>"; print_r($toLedgerData);
                // exit();
                $this->model_purchaseledger->create($toLedgerData);
                $this->model_ledger->update($toLedgerDataUpdate);

                $journalEntries = array(
                                        'entry_type' => 'journalEntries',
                                        'entry_id' => $created_id,
                                        'fomledger_id' => $this->input->post('credit'),
                                        'toledger_id' => $this->input->post('debit'),
                                        'company_id' => $this->session->userdata('wo_company'),
                                        // 'city_id' => $this->session->userdata('wo_city'),
                                        'store_id' => $this->session->userdata('wo_store'),
                                        'created_by' => $this->session->userdata('wo_id')
                                    );
                $this->model_ledgerentry->create($journalEntries);

                $this->model_ledger->update($fromLedgerUpdateData);
                $this->model_ledger->update($toLedgerUpdateData);

                if($_POST['save'])
                {
                    $this->session->set_flashdata('feedback','Data Saved Successfully');
                    $this->session->set_flashdata('feedback_class','alert alert-success');
                    return redirect('journalentry');
                }
                else
                {
                    redirect('journalentry/printVoucher/'.$created_id);
                }
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('journalentry/create');
        	}
        }
        else
        {
            $orderNo = $this->model_journalentry->lastrecord();
            
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

            $this->data['ledger'] = $this->model_ledger->fecthDataByType();
            
            $this->render_template('admin_view/entriesMaster/journalEntries/create', $this->data);
        }
	}
	
	public function update()
	{
        $id = $this->uri->segment(3);

	    $this->form_validation->set_rules('id', 'Journal ID', 'trim|required');

        if ($this->form_validation->run() == TRUE) {

            $fromLedger = $this->model_ledger->fecthDataByID($this->input->post('credit'));
            $toLedger = $this->model_ledger->fecthDataByID($this->input->post('debit'));

            $oldFromClosingBalance = $fromLedger['closing_balance'] - $this->input->post('oldamount');
            $newFromClosingBalance = $fromLedger['opening_balance'] + $this->input->post('amount');

            $oldToClosingBalance = $toLedger['closing_balance'] - $this->input->post('oldamount');
            $newToClosingBalance = $toLedger['opening_balance'] + $this->input->post('amount');


            $fromLedgerUpdateData = array(
                            'id' => $this->input->post('credit'),
                            // 'opening_balance' => $this->input->post('opening_stock'),
                            'closing_balance' => $newFromClosingBalance
                        );

            $toLedgerUpdateData = array(
                            'id' => $this->input->post('debit'),
                            // 'opening_balance' => $this->input->post('opening_stock'),
                            'closing_balance' => $newToClosingBalance
                        );

            // echo "<pre>"; print_r($fromLedgerUpdateData); echo "<pre>"; print_r($toLedgerUpdateData); //exit();

        	$data = array(
        	                'id' => $this->input->post('id'),
        					'voucherno' => $this->input->post('voucher_no'),
                            'date' => $this->input->post('entry_date'),
                            'cr_ledgerid' => $this->input->post('credit'),
                            'dr_ledgerid' => $this->input->post('debit'),
                            'amount' => $this->input->post('amount'),
                            'referernceno' => $this->input->post('reference'),
                            'remark' => $this->input->post('remark'),
                            // 'fromopeningstock' => $fromLedger['closing_balance'],
                            'fromclosingstock' => $newFromClosingBalance,
                            // 'toopeningstock' => $toLedger['closing_balance'],
                            'toclosingstock' => $newToClosingBalance,
                            'company_id' => $this->session->userdata('wo_company'),
                            // 'city_id' => $this->session->userdata('wo_city'),
                            'store_id' => $this->session->userdata('wo_store'),
        					'modified_by' => $this->session->userdata('wo_id')
        				);

        	// print_r($data); exit();
        	
        	$update = $this->model_journalentry->update($data);

        	if($update == true) {

                $fromdata = array(
                                'purchase_id' => $this->input->post('id'),
                                'purchase_type' => 'journalentry'
                            );

                $fromledgerData = $this->model_purchaseledger->fecthAllDataByPurchaseID($fromdata);

                foreach ($fromledgerData as $key => $value) {

                    $updateLedger = array(
                                            'id' => $value['id'],
                                            'amt' => $_POST['amount']
                                        );

                    $this->model_purchaseledger->update($updateLedger);
                }

                $todata = array(
                                'purchase_id' => $this->input->post('id'),
                                'purchase_type' => 'journalentry'
                            );

                $toledgerData = $this->model_purchaseledger->fecthAllDataByPurchaseID($todata);

                foreach ($toledgerData as $key => $value) {

                    $updateLedger = array(
                                            'id' => $value['id'],
                                            'amt' => $_POST['amount']
                                        );

                    $this->model_purchaseledger->update($updateLedger);
                }

                // $type = "journalentry";
                // $this->model_purchaseledger->deletePurchaseID($this->input->post('id'), $type);

                

                if($_POST['save'])
                {
                    $this->model_ledger->update($fromLedgerUpdateData);
                    $this->model_ledger->update($toLedgerUpdateData);


                    $this->session->set_flashdata('feedback','Data Saved Successfully');
                    $this->session->set_flashdata('feedback_class','alert alert-success');
                    return redirect('journalentry');
                }
                else
                {
                    redirect('journalentry/printVoucher/'.$this->input->post('id'));
                }
        		
        		
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('journalentry/update/'.$this->input->post('id'));
        	}
        }
        else
        {
            $this->data['ledger'] = $this->model_ledger->fecthDataByType();

            $this->data['allData'] = $this->model_journalentry->fecthDataByID($id);

            $this->render_template('admin_view/entriesMaster/journalEntries/update', $this->data);
        }
	}
	
	public function delete()
	{
        $id = $this->uri->segment(3);
		
		$delete = $this->model_journalentry->delete($id);	

		if($delete == true) {
		    
		    $type = "journalentry";
		    
		    $this->model_purchaseledger->deletePurchaseID($id, $type);

            $data = array(
                            'entry_id' => $id,
                            'entry_type' => 'journalEntries'
                        );
            
            $this->model_ledgerentry->deleteByLEntryId($data);


            $data = array(
                            'purchase_id' => $id,
                            'purchase_type' => 'journalentry'
                        );

            $ledgerEntriesData = $this->model_purchaseledger->fecthAllDataByPurchaseID($data);

            foreach ($ledgerEntriesData as $key => $value) {

                $this->model_purchaseledger->delete($value['id']);
            }


    		$this->session->set_flashdata('feedback','Record Deleted Successfully');
			$this->session->set_flashdata('feedback_class','alert alert-success');
			return redirect('journalentry');
    	}
    	else{

    		$this->session->set_flashdata('feedback','Unable to Delete Record');
			$this->session->set_flashdata('feedback_class','alert alert-danger');
			return redirect('journalentry');
    	}
	}

    public function printVoucher()
    {
        $id = $this->uri->segment(3);
        // echo $id;
        $company_id = $this->session->userdata['wo_company'];
        $this->data['companyDetails'] = $this->model_company->fecthDataByID($company_id);

        $this->data['allData'] = $this->model_journalentry->fecthDataByID($id);

        $this->render_template('admin_view/entriesMaster/journalEntries/report', $this->data);
        
    }
	
}