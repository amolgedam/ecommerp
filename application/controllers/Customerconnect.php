<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Customerconnect extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Customer';
		
		$this->load->model('model_ledgertype');
		$this->load->model('model_customer');
		$this->load->model('model_ledger');
        $this->load->model('model_company');
        
	}

	public function index()
	{
	    $this->data['for'] = $this->model_ledgertype->fecthNotOtherType(8);
	    $this->data['to'] = $this->model_ledger->fecthLedgerAccount();
	    
		$this->render_template('admin_view/crm/customerConnect/index', $this->data);
	}
	
	public function sendEmail()
	{
	   // $this->form_validation->set_rules('for', 'First Name', 'trim|required');
	   // $this->form_validation->set_rules('emailAdd', 'TO', 'trequired');
	    $this->form_validation->set_rules('subject', 'Subject', 'trim|required');
	    $this->form_validation->set_rules('message', 'Message', 'trim|required');

	    if ($this->form_validation->run() == TRUE) {
	        
            // echo "<pre>"; print_r($_POST); exit;
            
            // Email configuration
            // $config = Array(
            //     'protocol' => 'smtp',
            //     'smtp_host' => 'smtp.yourdomainname.com.',
            //     'smtp_port' => 465,
            //     'smtp_user' => 'admin@yourdomainname.com', // change it to yours
            //     'smtp_pass' => '******', // change it to yours
            //     'mailtype' => 'html',
            //     'charset' => 'iso-8859-1',
            //     'wordwrap' => TRUE
            // );
            
            // $this->load->library('email', $config);
            
            $emails = count($_POST['emailAdd']);
            $from = 'demo@admin.com';
            
            for($i=0; $i<$emails; $i++)
            {
                // $this->email->from($from, "");
                // $this->email->to($this->input->post('emailAdd')[$i]);
                
                // $this->email->subject($this->input->post('subject'));
                // $this->email->message($this->input->post('message'));
                
                // $success = $this->email->send();
                // $success=true;
                // if($success)
                // {
                    $data = array(
                                    'emailto' => $this->input->post('emailAdd')[$i],
                                    'emailfrom' => $from,
                                    'subject' => $this->input->post('subject'),
                                    'msg' => $this->input->post('message'),
                                    'company_id' => $this->session->userdata('wo_company'),
                    				// 'city_id' => $this->session->userdata('wo_city'),
                    				'store_id' => $this->session->userdata('wo_store'),
                    				'created_by' => $this->session->userdata('wo_id')
                                );
                    // echo "<pre>"; print_r($data);
                    
                    $success = $this->model_customer->createEmail($data);
                // }
            }
            
            // $data = array(
            //                 'to' => $_POST['emailAdd'],
            //                 'subject' => $_POST['subject'],
            //                 'msg' => $_POST['message']
            //             );
            // echo "<pre>"; print_r($data);
            
            // $from_email = "amolgedam.1994@gmail.com";
                        
            // $emails = count($_POST['emailAdd']);
            
            // for($i=0; $i<$emails; $i++)
            // {
            //     $to_email = $_POST['emailAdd'][$i];
                
            //     $this->email->from($from_email, 'Identification');
            //     $this->email->to($to_email);
                
            //     $this->email->subject($_POST['subject']);
            //     $this->email->message($_POST['message']);
                
            //     $success = $this->email->send();
            // }
            
            
            if($success)
            {
                $this->session->set_flashdata('feedback','Congragulation Email Send Successfully.');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				
				return redirect('customerconnect');
            }
            else
            {
                $this->session->set_flashdata('feedback','Unable to Send Email');
				$this->session->set_flashdata('feedback_class','alert alert-danger');

				return redirect('customerconnect');				
            }
            
	    }
	    else
	    {
	        
	        $this->data['for'] = $this->model_ledgertype->fecthNotOtherType(8);
    	    $this->data['to'] = $this->model_ledger->fecthLedgerAccount();
    	    
    		$this->render_template('admin_view/crm/customerConnect/index', $this->data);
	    }
	}
	
	
}