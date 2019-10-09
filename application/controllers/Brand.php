<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Brand extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Brand';
		
		$this->load->model('model_brand');
		$this->load->model('model_company');
		$this->load->model('model_barcode');
		$this->load->model('model_openingitem');
		$this->load->model('model_purchaseitem');
		
	}
	
	public function showBrand()
	{
	    $data = $this->model_brand->fecthAllData();
	    echo json_encode($data);
	}

	public function index()
	{
	    $this->data['brand'] = $this->model_brand->fecthAllData();
	    
		$this->render_template('admin_view/productMaster/brand/index', $this->data);
	}
	
	public function saveBrand()
	{
	    $brand = $_POST['brand'];
	   // $brand = 'brand1';
	    $data = $this->model_brand->fetchDataByName($brand);
	   // echo "<pre>"; print_r($data);exit;
	   
	   $count = count($data);
	   
	    if($count == 0)
	    {
	        $data = array(
	                        'brand_name' => $_POST['brand'],
	                        'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'created_by' => $this->session->userdata('wo_id')
	                    );
	                    
            $data=$this->model_brand->create($data);
		    echo json_encode($data);        
	    }
	    else
	    {
	        $status = "0";
	        echo json_encode($status);
	    }
	}
	
	public function create()
	{
	    $this->form_validation->set_rules('brand', 'Brand Name', 'trim|required|is_unique[wo_brand.brand_name]');

        if ($this->form_validation->run() == TRUE) {

        	$data = array(
        					'brand_name' => $this->input->post('brand'),
        					'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'created_by' => $this->session->userdata('wo_id')
        				);

        // 	print_r($data); exit();
        	$create = $this->model_brand->create($data);

        	if($create == true) {
        		
        		$this->session->set_flashdata('feedback','Data Saved Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				return redirect('brand');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('brand');
        	}
        }
        else
        {
            $this->data['brand'] = $this->model_brand->fecthAllData();
            
    		$this->render_template('admin_view/productMaster/brand/index', $this->data);
        }
	}
	
	public function update()
	{
	    $this->form_validation->set_rules('editbrand', 'Brand Name', 'trim|required');

        if ($this->form_validation->run() == TRUE) {

        	$data = array(
        					'id' => $this->input->post('id_edit'),
        					'brand_name' => $this->input->post('editbrand'),
        					'company_id' => $this->session->userdata('wo_company'),
        				// 	'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'modified_by' => $this->session->userdata('wo_id')
        				);

        // 	print_r($data); exit();
        	$create = $this->model_brand->update($data);

        	if($create == true) {
        		
        		$this->session->set_flashdata('feedback','Record Update Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				return redirect('brand');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Update Record');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('brand');
        	}
        }
        else
        {
            $this->data['brand'] = $this->model_brand->fecthAllData();
            
    		$this->render_template('admin_view/productMaster/brand/index', $this->data);
        }
	}
	
	public function delete()
	{
		$id = $this->input->post('id_edit');
		$delete = $this->model_brand->delete($id);	

		if($delete == true) {

    		$this->session->set_flashdata('feedback','Record Deleted Successfully');
			$this->session->set_flashdata('feedback_class','alert alert-success');
			return redirect('brand');
    	}
    	else{

    		$this->session->set_flashdata('feedback','Unable to Delete Record');
			$this->session->set_flashdata('feedback_class','alert alert-danger');
			return redirect('brand');
    	}
	}
	
	public function gerBarcodeByBrand()
	{
        $brand = $this->input->post('brand');
        // 	$brand = 2;
		$barcodeData = $this->model_barcode->fetchDataByBrand1($brand); 
		    
		foreach($barcodeData as $value)
		{
		    if($value['purchase_type'] == 'opening_stock' OR $value['purchase_type'] == 'production')
            {
                // echo "opening_stock <br>";
                $orderData = $this->model_openingitem->fecthAllDataByID($value['product_id']);
                $location = $orderData['location'];
            }
            if($value['purchase_type'] == 'pinvoice')
            {
                $orderData = $this->model_purchaseitem->fecthAllDataByID($value['product_id']);
                $location = $orderData['location_id'];
            }
            else if($value['purchase_type'] == 'internaltransfer')
            {
                $orderData = $this->model_internaltransfer->fecthAllDataByID($value['purchase_id']); 
                $location = $orderData['tolocation'];
            }
            
            $result[] = array(
                                    'sku_code' => $value['sku_code'],
                                    'loc' => $location
                                );
          
		}
		    
        // echo "<pre>"; print_r($result); exit;
        echo json_encode($result); exit;
	}

}