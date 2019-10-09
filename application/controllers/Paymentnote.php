<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Paymentnote extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

        $this->load->library('number_to_word');
 
		$this->data['page_title'] = 'Payment Note';
		
        $this->load->model('model_paymentmaster');
        $this->load->model('model_ledger');
        $this->load->model('model_purchaseledger');

        $this->load->model('model_paymentnote');
        $this->load->model('model_company');
        $this->load->model('model_state');
        $this->load->model('model_journalentry');
		$this->load->model('model_ledgerentry');
	}

    public function fetchAllData()
    {
        $data = $this->model_paymentnote->fecthAllData();
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
                $ledgerData = $this->model_ledger->fecthDataByID($value['ledger_id']);
                $paymenttype = $this->model_paymentmaster->fecthDataByID($value['paymenttype_id']);

                $buttons = '';
                
                $buttons .= '&nbsp; <a href="'.base_url().'paymentnote/update/'.$value['id'].'" class="btn btn-sm btn-info"><i class="fa fa-edit"></i>Edit</a>';
                    
                $buttons .= '&nbsp; <a href="'.base_url().'paymentnote/delete/'.$value['id'].'" onclick="return confirm(\' you want to delete?\');" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>Delete</a>';

                $buttons .= '&nbsp; <a href="'.base_url().'paymentnote/printVoucher/'.$value['id'].'" class="btn btn-sm btn-info"><i class="fa fa-file-text"></i> Print</a>';

                
                $result['data'][$key] = array(
                                                $no,
                                                $value['date'],
                                                $ledgerData['ledger_name'],
                                                $paymenttype['payment_name'],
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
	   // $this->data['divisionDetails'] = $this->model_division->fecthAllData();
	    
		$this->render_template('admin_view/entriesMaster/paymentNote/index', $this->data);
	}
	   
	public function create()
	{
	    $this->form_validation->set_rules('voucher_no', 'Voucher Number', 'trim|required');

        if ($this->form_validation->run() == TRUE) {

            // echo "<pre>"; print_r($_POST); 

            $ledgerData = $this->model_ledger->fecthDataByID($this->input->post('ledger'));
            
            $closing_balance = $ledgerData['closing_balance'] + $this->input->post('amount');

            $data = array(
                            'voucherno' => $this->input->post('voucher_no'),
                            'date' => $this->input->post('entry_date'),
                            'adjustment' => $this->input->post('adjustment'),
                            'paymenttype_id' => $this->input->post('payment_type'),
                            'ledger_id' => $this->input->post('ledger'),
                            'amount' => $this->input->post('amount'),
                            'referernceno' => $this->input->post('reference'),
                            'remark' => $this->input->post('remark'),
                            'opening_stock' => $ledgerData['closing_balance'],
                            'closing_stock' => $closing_balance,
                            'company_id' => $this->session->userdata('wo_company'),
                            // 'city_id' => $this->session->userdata('wo_city'),
                            'store_id' => $this->session->userdata('wo_store'),
                            'created_by' => $this->session->userdata('wo_id')
                        );

            $LedgerUpdateData = array(
                            'id' => $ledgerData['id'],
                            'opening_balance' => $ledgerData['closing_balance'],
                            'closing_balance' => $closing_balance
                        );
            // echo "<pre>"; print_r($ledgerData); echo "<pre>"; print_r($LedgerUpdateData); exit();

            $created_id = $this->model_paymentnote->create($data);

        	if($created_id == true) {
    
                $journalEntries = array(
                                        'entry_type' => 'paymentNote',
                                        'entry_id' => $created_id,
                                        'fomledger_id' => $this->input->post('ledger'),
                                        'company_id' => $this->session->userdata('wo_company'),
                                        // 'city_id' => $this->session->userdata('wo_city'),
                                        'store_id' => $this->session->userdata('wo_store'),
                                        'created_by' => $this->session->userdata('wo_id')
                                    );
                $this->model_ledgerentry->create($journalEntries);

                $this->model_ledger->update($LedgerUpdateData);

                // ACCOUNT TYPE LEDGER 
                $accountLedgerData = $this->model_ledger->fecthDataByID1($_POST['ledger']);            
                $accountLedgerAmt = $accountLedgerData['closing_balance'] - $_POST['amount'];

                $accountLedgerDataUpdate = array(
                                                    'id' => $accountLedgerData['id'],
                                                    'opening_balance' => $accountLedgerData['closing_balance'],
                                                    'closing_balance' => $accountLedgerAmt
                                                );

                $accountLedger = array(
                                        'purchase_id' => $created_id,
                                        'ledger_id' => $accountLedgerData['id'],
                                        'invoice_date' => $_POST['entry_date'],
                                        'entry_date' => $_POST['entry_date'],
                                        'purchase_type' => "paymentnote",
                                        'dr_cr' => 'DR',
                                        'amt' => abs($_POST['amount']),
                                        'opening_bal' => $accountLedgerData['closing_balance'],
                                        'closing_bal' => $accountLedgerAmt,
                                        'company_id' => $this->session->userdata('wo_company'),
                                        // 'city_id' => $this->session->userdata('wo_city'),
                                        'store_id' => $this->session->userdata('wo_store'),
                                        'created_by' => $this->session->userdata('wo_id')
                                    );

                $this->model_purchaseledger->create($accountLedger);
                $this->model_ledger->update($accountLedgerDataUpdate);

                // PAYMENT TYPE LEDGER 
                $paymentType = $this->model_paymentmaster->fecthDataByID($this->input->post('payment_type'));
                $paymentLedgerData = $this->model_ledger->fecthDataByID1($paymentType['ledger_id']);
                
                $updatePaymentTypeLedgerAmt = $paymentLedgerData['closing_balance'] + $_POST['amount'];

                $paymentLedgerDataUpdate = array(
                                                    'id' => $paymentLedgerData['id'],
                                                    'opening_balance' => $paymentLedgerData['closing_balance'],
                                                    'closing_balance' => $updatePaymentTypeLedgerAmt
                                                );

                $paymentLedger = array(
                                        'purchase_id' => $created_id,
                                        'ledger_id' => $paymentLedgerData['id'],
                                        'invoice_date' => $_POST['entry_date'],
                                        
                                        'entry_date' => $_POST['entry_date'],
                                        'purchase_type' => "paymentnote",
                                        'dr_cr' => 'CR',
                                        'amt' => abs($_POST['amount']),
                                        'opening_bal' => $paymentLedgerData['closing_balance'],
                                        'closing_bal' => $updatePaymentTypeLedgerAmt,
                                        'company_id' => $this->session->userdata('wo_company'),
                                        // 'city_id' => $this->session->userdata('wo_city'),
                                        'store_id' => $this->session->userdata('wo_store'),
                                        'created_by' => $this->session->userdata('wo_id')
                                    );

                $this->model_purchaseledger->create($paymentLedger);
                $this->model_ledger->update($paymentLedgerDataUpdate);

                if($_POST['save'])
                {
                    $this->session->set_flashdata('feedback','Data Saved Successfully');
                    $this->session->set_flashdata('feedback_class','alert alert-success');
                    return redirect('paymentNote');
                }
                else
                {
                    redirect('paymentNote/printVoucher/'.$created_id);
                }
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('paymentNote/create');
        	}
        }
        else
        {
            $orderNo = $this->model_paymentnote->lastrecord();
            
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
            $this->data['ledger'] = $this->model_ledger->fecthDataByType();

            $this->render_template('admin_view/entriesMaster/paymentNote/create', $this->data);
        }
	}
	
	public function update()
	{
        $id = $this->uri->segment(3);

	    $this->form_validation->set_rules('id', 'Voucher ID', 'trim|required');

        if ($this->form_validation->run() == TRUE) {

            $paymentNotData = $this->model_paymentnote->fecthDataByID($this->input->post('id'));

            $oldClosingBalance = $paymentNotData['closing_stock'] - $this->input->post('oldamount');
            $newClosingBalance = $paymentNotData['opening_stock'] + $this->input->post('amount');
            // echo "<pre>"; print_r($paymentNotData); echo "<pre>"; print_r($_POST); exit();

            $LedgerUpdateData = array(
                            'id' => $this->input->post('ledger'),
                            // 'opening_balance' => $this->input->post('opening_stock'),
                            'closing_balance' => $newClosingBalance
                        );

        	$data = array(
                            'id' => $this->input->post('id'),
        	                'voucherno' => $this->input->post('voucher_no'),
                            'date' => $this->input->post('entry_date'),
                            'adjustment' => $this->input->post('adjustment'),
                            'paymenttype_id' => $this->input->post('payment_type'),
                            'ledger_id' => $this->input->post('ledger'),
                            'amount' => $this->input->post('amount'),
                            'referernceno' => $this->input->post('reference'),
                            'remark' => $this->input->post('remark'),
                            'closing_stock' => $newClosingBalance,
                            'company_id' => $this->session->userdata('wo_company'),
                            // 'city_id' => $this->session->userdata('wo_city'),
                            'store_id' => $this->session->userdata('wo_store'),
                            'modified_by' => $this->session->userdata('wo_id')
        				);

        	// echo "<pre>"; print_r($LedgerUpdateData); echo "<pre>"; print_r($data); exit();
        	
        	$update = $this->model_paymentnote->update($data);

        	if($update == true) {

                $data = array(
                                'purchase_id' => $this->input->post('id'),
                                'purchase_type' => 'paymentvoucher'
                            );

                $ledgerEntriesData = $this->model_purchaseledger->fecthAllDataByPurchaseID($data);

                foreach ($ledgerEntriesData as $key => $value) {
                    
                    $updateLedger = array(
                                            'id' => $value['id'],
                                            'amt' => $_POST['amount']
                                        );

                    $this->model_purchaseledger->update($updateLedger);
                }


                $type = "paymentnote";
                $this->model_purchaseledger->deletePurchaseID($this->input->post('id'), $type);

                // ACCOUNT TYPE LEDGER 
                $accountLedgerData = $this->model_ledger->fecthDataByID1($this->input->post('ledger'));            
                $accountLedgerAmt = $accountLedgerData['closing_balance'] - $this->input->post('amount');

                $accountLedgerDataUpdate = array(
                                                    'id' => $accountLedgerData['id'],
                                                    'opening_balance' => $accountLedgerData['closing_balance'],
                                                    'closing_balance' => $accountLedgerAmt
                                                );

                $accountLedger = array(
                                        'purchase_id' => $$this->input->post('id'),
                                        'ledger_id' => $accountLedgerData['id'],
                                        'invoice_date' => $this->input->post('entry_date'),
                                        'entry_date' => $this->input->post('entry_date'),
                                        'purchase_type' => "paymentnote",
                                        'dr_cr' => 'DR',
                                        'amt' => abs($this->input->post('amount')),
                                        'opening_bal' => $accountLedgerData['closing_balance'],
                                        'closing_bal' => $accountLedgerAmt,
                                        'company_id' => $this->session->userdata('wo_company'),
                                        // 'city_id' => $this->session->userdata('wo_city'),
                                        'store_id' => $this->session->userdata('wo_store'),
                                        'created_by' => $this->session->userdata('wo_id')
                                    );

                $this->model_purchaseledger->create($accountLedger);
                $this->model_ledger->update($accountLedgerDataUpdate);

                // PAYMENT TYPE LEDGER 
                $paymentType = $this->model_paymentmaster->fecthDataByID($this->input->post('payment_type'));
                $paymentLedgerData = $this->model_ledger->fecthDataByID1($paymentType['ledger_id']);
                
                $updatePaymentTypeLedgerAmt = $paymentLedgerData['closing_balance'] + $this->input->post('amount');

                $paymentLedgerDataUpdate = array(
                                                    'id' => $paymentLedgerData['id'],
                                                    'opening_balance' => $paymentLedgerData['closing_balance'],
                                                    'closing_balance' => $updatePaymentTypeLedgerAmt
                                                );

                $paymentLedger = array(
                                        'purchase_id' => $$this->input->post('id'),
                                        'ledger_id' => $paymentLedgerData['id'],
                                        'invoice_date' => $this->input->post('entry_date'),
                                        'entry_date' => $this->input->post('entry_date'),
                                        'purchase_type' => "paymentnote",
                                        'dr_cr' => 'CR',
                                        'amt' => abs($this->input->post('amount')),
                                        'opening_bal' => $paymentLedgerData['closing_balance'],
                                        'closing_bal' => $updatePaymentTypeLedgerAmt,
                                        'company_id' => $this->session->userdata('wo_company'),
                                        // 'city_id' => $this->session->userdata('wo_city'),
                                        'store_id' => $this->session->userdata('wo_store'),
                                        'created_by' => $this->session->userdata('wo_id')
                                    );

                $this->model_purchaseledger->create($paymentLedger);
                $this->model_ledger->update($paymentLedgerDataUpdate);



                if($_POST['save'])
                {
                    $this->model_ledger->update($LedgerUpdateData);

                    $this->session->set_flashdata('feedback','Data Saved Successfully');
                    $this->session->set_flashdata('feedback_class','alert alert-success');
                    return redirect('paymentNote');
                }
                else
                {
                    redirect('paymentNote/printVoucher/'.$this->input->post('id'));
                }
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('paymentNote/update/'.$this->input->post('id'));
        	}
        }
        else 
        {
            $this->data['paymenttype'] = $this->model_paymentmaster->fecthAllData();
            $this->data['ledger'] = $this->model_ledger->fecthDataByType();

            $this->data['allData'] = $this->model_paymentnote->fecthDataByID($id);

            $this->render_template('admin_view/entriesMaster/paymentNote/update', $this->data);
        }
	}
	
	public function delete()
	{
		$id = $this->uri->segment(3);

        $delete = $this->model_paymentnote->delete($id);

		if($delete) {
		    
		    $type = "paymentnote";
		    
		    $this->model_purchaseledger->deletePurchaseID($id, $type);

            $data = array(
                            'entry_id' => $id,
                            'entry_type' => 'paymentNote'
                        );

            $this->model_ledgerentry->deleteByLEntryId($data);

            $data = array(
                            'purchase_id' => $this->input->post('id'),
                            'purchase_type' => 'paymentvoucher'
                        );

            $ledgerEntriesData = $this->model_purchaseledger->fecthAllDataByPurchaseID($data);

            foreach ($ledgerEntriesData as $key => $value) {

                $this->model_purchaseledger->delete($value['id']);
            }

    		$this->session->set_flashdata('feedback','Record Deleted Successfully');
			$this->session->set_flashdata('feedback_class','alert alert-success');
			return redirect('paymentNote');
    	}
    	else{

    		$this->session->set_flashdata('feedback','Unable to Delete Record');
			$this->session->set_flashdata('feedback_class','alert alert-danger');
			return redirect('paymentNote');
    	}
	}

    public function printVoucher()
    {
        $id = $this->uri->segment(3);
        // echo $id;

        $company_id = $this->session->userdata['wo_company'];
        $this->data['companyDetails'] = $this->model_company->fecthDataByID($company_id);

        $this->data['allData'] = $this->model_paymentnote->fecthDataByID($id);

        $this->render_template('admin_view/entriesMaster/paymentNote/report', $this->data);
    }
	
}