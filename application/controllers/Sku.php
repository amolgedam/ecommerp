<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Sku extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'SKU';
		
		$this->load->model('model_sku');
		$this->load->model('model_category');
        $this->load->model('model_weight');
        $this->load->model('model_unit');
        $this->load->model('model_hsn');
        $this->load->model('model_attribute');
        $this->load->model('model_brand');
        $this->load->model('model_gst');
        $this->load->model('model_division');
        $this->load->model('model_company');
        
	}
	
	public function saveSKU()
	{
	   // $sku = "SY2344-K1001";
	    $sku = $_POST['sku'];
	    $skuData = $this->model_sku->fecthSkuDataBySKU($sku);
	   // echo "<pre>"; print_r($skuData);
	    
	    $count = count($skuData);
	    
	    if($count == 0)
	    {
	        $data = array(
	                        'product_name' => $_POST['product_name'],
	                        'product_code' => $_POST['sku'],
	                        'gst' => $_POST['gstData'],
	                        'category_id' => $_POST['pcat'],
	                        'subcategory_id' => $_POST['psubcat'],
	                        'unit_id' => $_POST['unitData'],
	                        'description' => $_POST['desc'],
	                        'status' => 'active',
                            'websitestatus' => $_POST['website'],
	                        'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'created_by' => $this->session->userdata('wo_id')
	                    );
	       //$data = "empty";
	                    
            $data=$this->model_sku->create($data);
		    echo json_encode($data);        
	    }
	    else
	    {
	        $status = "0";
	        echo json_encode($status);
	    }

	}
	
	public function getDataBySkuID()
	{
	    $sku = $_POST['sku'];
        // $sku = '9';
        $skuData = $this->model_sku->fecthSkuDataByID($sku);
         echo json_encode($skuData);
	}

    public function getUnitBySku()
    {
        $sku = $_POST['sku'];
        // $sku = 'sku0001';
        $skuData = $this->model_sku->fecthSkuDataBySKU($sku);
        // echo "<pre>"; print_r($skuData);
        $data=$this->model_unit->fecthUnitDataByID($skuData['unit_id']);
        echo json_encode($data);
    }

    public function getGlobalSearchData()
    {
        $sku = $_POST['sku'];
        // $sku = '0001';
        $skuData = $this->model_sku->fecthSkuDataBySKU($sku);

        $catData = $this->model_category->fecthCatDataByID($skuData['category_id']);
        $subcatData = $this->model_category->fecthSubCatDataByID($skuData['subcategory_id']);
        // echo "<pre>"; print_r($catData);
        // echo "<pre>"; print_r($subcatData); exit();

        $data = array(
                        'sku_id' => $skuData['id'],
                        'sku_code' => $skuData['product_code'],
                        'category' => $catData['catgory_name'],
                        'subcategory' => $subcatData['subcategory_name'],
                    );
        // echo "<pre>"; print_r($data); exit();
        echo json_encode($data);
        exit();
    }

	public function index()
	{
	   // $this->data['allData'] = $this->model_sku->fecthAllData();
	    
		$this->render_template('admin_view/productMaster/sku/index', $this->data);
	}
	
	public function fetchAllSkuData()
	{
	     $data = $this->model_sku->fecthAllData();
	     echo json_encode($data);
	}
	
	public function fetchAllSkuData1()
	{
	     $data = $this->model_sku->fecthAllData1();
	     echo json_encode($data);
	}
	
	public function fecthSkuByCatID()
	{
	    $id = $_POST['cat_id'];
	    $data = $this->model_sku->fecthSkuByCatID($id);
	    echo json_encode($data);
	}
	
	public function fetchAllData()
	{
	    $data = $this->model_sku->fecthAllData();
	   // echo "<pre>";print_r($data); //exit;
	    
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
                
                $buttons .= '&nbsp; <a href="'.base_url().'sku/update/'.$value['id'].'" class="btn btn-sm btn-info"><i class="fa fa-edit"></i>Edit</a>';
                
                $buttons .= '&nbsp; <a href="'.base_url().'sku/delete/'.$value['id'].'" onclick="return confirm(\' you want to delete?\');" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>Delete</a>';
                
                
                $result['data'][$key] = array(
                                                
                                                $no,
                                                $value['product_code'],
                                                $value['product_name'],
                                                $value['catgory_name'],
                                                $value['subcategory_name'],
                                                $value['gst_name'],
                                                $buttons
                                            );
                                            
                $no++;   
            }
        }
        echo json_encode($result);
        exit;
	}

	public function create()
	{
	    $this->form_validation->set_rules('product_name', 'Product Name', 'required|trim|is_unique[wo_product.product_name]');
	    // $this->form_validation->set_rules('product_code', 'Product Code', 'required|trim|is_unique[wo_product.product_code]');
		$this->form_validation->set_rules('purchase_price', 'Product Purchase Price', 'required|trim');
		$this->form_validation->set_rules('sales_price', 'Product Sales Price', 'required|trim');
		$this->form_validation->set_rules('quantity', 'Product Quantity', 'required|trim');
		$this->form_validation->set_rules('gst', 'GST', 'required|trim');
		
		
		if ($this->form_validation->run() == TRUE){
		    
		   // echo "<pre>"; print_r($_POST); exit;
            
                    
                    $data = array(
                                    'product_name' => $this->input->post('product_name'),
                                    'product_code' => $this->input->post('product_code'),
                                    'purchase_price' => $this->input->post('purchase_price'),
                                    'sales_price' => $this->input->post('sales_price'),
                                    'weight' => $this->input->post('weight'),
                                    'quantity' => $this->input->post('quantity'),
                                    'gst' => $this->input->post('gst'),
                                    'category_id' => $this->input->post('category'),
                                    'subcategory_id' => $this->input->post('subcategory'),
                                    'unit_id' => $this->input->post('unit'),
                                    'hsn_id' => $this->input->post('hsn'),
                                    'attr_id' => $this->input->post('attribute'),
                                    'brand_id' => $this->input->post('brand'),
                                    'description' => $this->input->post('descirption'),
                                    'status' => $this->input->post('status'),
                                    'websitestatus' => $this->input->post('website'),
                                    'company_id' => $this->session->userdata('wo_company'),
                					// 'city_id' => $this->session->userdata('wo_city'),
                					'store_id' => $this->session->userdata('wo_store'),
                					'division_id' => $this->input->post('division'),
                					'created_by' => $this->session->userdata('wo_id')
                            );
               
        	
        	$create = $this->model_sku->create($data);

        	if($create == true) {
        		
        		$this->session->set_flashdata('feedback','Data Saved Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				return redirect('sku');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('sku');
        	}
		}
		else
		{
		  //  $this->data['product_code'] =  mt_rand(11111111,99999999);
	    
    	    $this->data['category'] = $this->model_category->fecthAllData();
            $this->data['subcategory'] = $this->model_category->fecthAllSubCatData();
            $this->data['weight'] = $this->model_weight->fecthAllData();
            $this->data['unit'] = $this->model_unit->fecthAllData();
            $this->data['hsn'] = $this->model_hsn->fecthAllData();
            $this->data['attr'] = $this->model_attribute->fecthAllData();
            $this->data['brand'] = $this->model_brand->fecthAllData();
            $this->data['gst'] = $this->model_gst->fecthAllData();
            $this->data['division'] = $this->model_division->fecthAllData();
    	
    		$this->render_template('admin_view/productMaster/sku/create', $this->data);   
		}
	}

	public function update()
	{
	    $id = $this->uri->segment(3);
	    
	    $this->data['allData'] = $this->model_sku->fecthSkuDataByID($id);
	    
	    
	    $this->form_validation->set_rules('product_name', 'Product Name', 'required|trim');
	    $this->form_validation->set_rules('product_code', 'Product Code', 'required|trim');
// 		$this->form_validation->set_rules('purchase_price', 'Product Purchase Price', 'required|trim');
// 		$this->form_validation->set_rules('sales_price', 'Product Sales Price', 'required|trim');
// 		$this->form_validation->set_rules('quantity', 'Product Quantity', 'required|trim');
		$this->form_validation->set_rules('gst', 'GST', 'required|trim');
		
		
		if ($this->form_validation->run() == TRUE){
		    
            // echo "<pre>"; print_r($_POST);
                
                $data = array(
                                'id' => $this->input->post('id'),
                                'product_name' => $this->input->post('product_name'),
                                'product_code' => $this->input->post('product_code'),
                                'purchase_price' => $this->input->post('purchase_price'),
                                'sales_price' => $this->input->post('sales_price'),
                                'weight' => $this->input->post('weight'),
                                'quantity' => $this->input->post('quantity'),
                                'gst' => $this->input->post('gst'),
                                'category_id' => $this->input->post('category'),
                                'subcategory_id' => $this->input->post('subcategory'),
                                'unit_id' => $this->input->post('unit'),
                                'hsn_id' => $this->input->post('hsn'),
                                'attr_id' => $this->input->post('attribute'),
                                'brand_id' => $this->input->post('brand'),
                                'description' => $this->input->post('descirption'),
                                'status' => $this->input->post('status'),
                                    'websitestatus' => $this->input->post('website'),

                                'company_id' => $this->session->userdata('wo_company'),
            					// 'city_id' => $this->session->userdata('wo_city'),
            					'store_id' => $this->session->userdata('wo_store'),
            					'division_id' => $this->input->post('division'),
            					'modified_by' => $this->session->userdata('wo_id')
                        );
            
		   // echo "<pre>"; print_r($data); exit;
        	
        	$create = $this->model_sku->update($data);

        	if($create == true) {
        		
        		$this->session->set_flashdata('feedback','Data Saved Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				return redirect('sku');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('sku');
        	}
		}
		else
		{
		  //  $this->data['product_code'] =  mt_rand(11111111,99999999);
	    
    	    $this->data['category'] = $this->model_category->fecthAllData();
            $this->data['subcategory'] = $this->model_category->fecthAllSubCatData();
            $this->data['weight'] = $this->model_weight->fecthAllData();
            $this->data['unit'] = $this->model_unit->fecthAllData();
            $this->data['hsn'] = $this->model_hsn->fecthAllData();
            $this->data['attr'] = $this->model_attribute->fecthAllData();
            $this->data['brand'] = $this->model_brand->fecthAllData();
            $this->data['gst'] = $this->model_gst->fecthAllData();
            $this->data['division'] = $this->model_division->fecthAllData();

            $this->data['imgData'] = $this->model_sku->fetchImgDataBySkuId($id);
    	
    		$this->render_template('admin_view/productMaster/sku/update', $this->data); 
		}
	}
	
	public function delete()
	{
		$id = $this->uri->segment(3); 
// 		echo $id; exit;
		$delete = $this->model_sku->delete($id);	
        
		if($delete == true) {

    		$this->session->set_flashdata('feedback','Record Deleted Successfully');
			$this->session->set_flashdata('feedback_class','alert alert-success');
			return redirect('sku');
    	}
    	else{

    		$this->session->set_flashdata('feedback','Unable to Delete Record');
			$this->session->set_flashdata('feedback_class','alert alert-danger');
			return redirect('sku');
    	}
	}
}