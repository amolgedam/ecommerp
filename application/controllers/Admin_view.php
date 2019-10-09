<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Admin_view extends CI_Controller
	{
		function __construct()
		{
			parent :: __construct();
		}

		// public function adminLogin()
		// {
		// 	$this->load->view('admin_view/login');
		// }

		// public function mdaForm()
		// {
		// 	$this->load->view('admin_view/mdaForm');
		// }

		// public function dashboard()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/dashboard');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// ACCOUNT MENU START
		// public function ledgerList()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/account/ledger/ledgerList');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function addAccount()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/account/ledger/addAccount');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function editAccount()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/account/ledger/editAccount');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function gstDetails()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/account/gst/gstDetails');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function discountMaster()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/account/discountMaster/discountMaster');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }
		// ACCOUNT MENU END

		// PRODUCT MENU START
		// public function productCategory()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/product/category/productCategory');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// Product Details
		// public function skuDetails()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/product/sku/skuMaster');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function addProduct()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/product/sku/addProduct');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function editProduct()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/product/sku/editProduct');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function hsnDetails()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/product/hsn/hsnMaster');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function unitDetails()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/product/unit/unitMaster');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function attribute()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/product/attribute/attribute');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function attributeList()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/product/attribute/attributeList');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function productBrand()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/product/brand/productBrand');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }
		// PRODUCT MENU END

		// PURCHASE MASTER MENU START
		// public function purchaseInvoice()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/purchase/purchaseInvoice/purchaseInvoice');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function addPurchaseInvoice()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/purchase/purchaseInvoice/addPurchaseInvoice');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function editPurchaseInvoice()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/purchase/purchaseInvoice/editPurchaseInvoice');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function addInvoiceItem()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/purchase/purchaseInvoice/addInvoiceItem');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function editInvoiceItem()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/purchase/purchaseInvoice/editInvoiceItem');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function purchaseVoucher()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/purchase/purchaseVoucher/purchaseVoucher');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function addPurchaseVoucher()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/purchase/purchaseVoucher/addPurchaseVoucher');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function editPurchaseVoucher()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/purchase/purchaseVoucher/editPurchaseVoucher');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function purchaseReturn()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/purchase/purchaseReturn/purchaseReturn');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function addPurchaseReturn()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/purchase/purchaseReturn/addPurchaseReturn');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function editPurchaseReturn()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/purchase/purchaseReturn/editPurchaseReturn');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function purchaseOrderList()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/purchase/purchaseOrder/purchaseOrderList');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');	
		// }

		// public function addPurchaseOrder()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/purchase/purchaseOrder/addPurchaseOrder');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');	
		// }

		// public function editPurchaseOrder()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/purchase/purchaseOrder/editPurchaseOrder');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');	
		// }
		// // PURCHASE MASTER MENU START

		// // SALES MASTER MENU START
		// public function salesInvoice()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/salesMaster/salesInvoice/salesInvoice');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function addSalesInvoice()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/salesMaster/salesInvoice/addSalesInvoice');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function editSalesInvoice()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/salesMaster/salesInvoice/editSalesInvoice');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function salesOrderList()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/salesMaster/salesOrder/salesOrderList');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function addSalesOrder()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/salesMaster/salesOrder/addSalesOrder');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function editSalesOrder()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/salesMaster/salesOrder/editSalesOrder');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }


		// public function wspList()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/salesMaster/wsp/wspList');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function addWsp()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/salesMaster/wsp/addWsp');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function editWsp()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/salesMaster/wsp/editWsp');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function salesVoucher()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/salesMaster/salesVoucher/salesVoucher');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function addSalesVoucher()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/salesMaster/salesVoucher/addSalesVoucher');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function editSalesVoucher()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/salesMaster/salesVoucher/editSalesVoucher');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function salesExchange()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/salesMaster/salesExchange/salesExchange');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function addExchangeItem()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/salesMaster/salesExchange/addExchangeItem');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function editExchangeItem()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/salesMaster/salesExchange/editExchangeItem');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }
		// // SALES MASTER MENU MENU END

		// // ENTRY MASTER MENU END
		// public function deliveryMemo()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/entriesMaster/deliveryMemo/deliveryMemo');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function addMemo()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/entriesMaster/deliveryMemo/addMemo');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function editMemo()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/entriesMaster/deliveryMemo/editMemo');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function paymentNote()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/entriesMaster/paymentNote/paymentNote');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function addPaymentVoucher()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/entriesMaster/paymentNote/addPaymentVoucher');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function editPaymentVoucher()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/entriesMaster/paymentNote/editPaymentVoucher');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function receiptNote()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/entriesMaster/receiptNote/receiptNote');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function addReceiptVoucher()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/entriesMaster/receiptNote/addReceiptVoucher');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function editReceiptVoucher()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/entriesMaster/receiptNote/editReceiptVoucher');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function journalEntries()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/entriesMaster/journalEntries/journalEntries');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function addJournalEntry()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/entriesMaster/journalEntries/addJournalEntry');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');	
		// }

		// public function editJournalEntry()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/entriesMaster/journalEntries/editJournalEntry');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');	
		// }

		// public function contraMaster()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/entriesMaster/contraMaster/contraMaster');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');	
		// }

		// public function addContraEntry()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/entriesMaster/contraMaster/addContraEntry');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');	
		// }

		// public function editContraEntry()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/entriesMaster/contraMaster/editContraEntry');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');	
		// }
		// // ENTRY MASTER MENU END

		// // INVENTORY MENU START
		// public function openingStock()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/inventory/stock/openingStock');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function addOpeningStock()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/inventory/stock/addOpeningStock');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function editOpeningStock()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/inventory/stock/editOpeningStock');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function internalConsumssion()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/inventory/internalConsumssion/internalConsumssion');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function addInternalConsumssion()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/inventory/internalConsumssion/addInternalConsumssion');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function editInternalConsumssion()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/inventory/internalConsumssion/editInternalConsumssion');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function productShortage()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/inventory/shortage/productShortage');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function addProductShortage()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/inventory/shortage/addProductShortage');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function editProductShortage()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/inventory/shortage/editProductShortage');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function excesses()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/inventory/excesses/excesses');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function addExcesses()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/inventory/excesses/addExcesses');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function editExcesses()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/inventory/excesses/editExcesses');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function internalTransfer()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/inventory/internalTransfer/internalTransfer');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function addInternalTransfer()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/inventory/internalTransfer/addInternalTransfer');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }
		// // INVENTORY MENU END

		// // PRODUCTION MENU START
		// public function productionDetails()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/productionMaster/production/productionDetails');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function manageProduction()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/productionMaster/production/manageProduction');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function furtherProcess()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/productionMaster/production/process');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function furtherProcessSearchResult()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/productionMaster/production/furtherProcessSearchResult');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function alterationSearch()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/productionMaster/production/alterationSearch');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function alterationSearchResult()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/productionMaster/production/alterationSearchResult');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function editProductJobsheet()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/productionMaster/production/editProductJobsheet');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function productionMeasurement()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/productionMaster/measurement/productionMeasurement');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function addMeasurement()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/productionMaster/measurement/addMeasurement');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function editMeasurement()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/productionMaster/measurement/editMeasurement');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function measurementDetails()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/productionMaster/measurement/measurementDetails');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// // PRODUCTION MENU END

		// public function budgetDetails()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/budgetingMaster/budgetList');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function budgetForm()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/budgetingMaster/budgetForm');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function budgetReport()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/budgetingMaster/budgetReport');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function contactDetails()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/crm/contactDetails/contactDetails');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function addContact()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/crm/contactDetails/addContact');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function editContact()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/crm/contactDetails/editContact');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function customerInformation()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/crm/customerInformation/customersInformation');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function customerDetails()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/crm/customerInformation/customerDetails');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function leadsDetails()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/crm/leadsManagement/leadsDetails');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function addLead()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/crm/leadsManagement/addLead');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function editLead()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/crm/leadsManagement/editLead');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function usersRights()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/usersRights/usersRights');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function addRole()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/usersRights/addRole');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');	
		// }

		// public function editRole()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/usersRights/editRole');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');	
		// }

		// public function storeMaster()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/settings/storeMaster/storeMaster');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function shippingMaster()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/settings/shippingMaster/shippingMaster');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function paymentMaster()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/settings/paymentMaster/paymentMaster');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function serviceTypeMaster()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/settings/serviceTypeMaster/serviceTypeMaster');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function designationMaster()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/settings/designationMaster/designation');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function companyDetails()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/settings/companyDetails/companydetails/companyDetails');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function addCompanyDetails()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/settings/companyDetails/companydetails/addCompany');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function editCompanyDetails()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/settings/companyDetails/companydetails/editCompany');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function division()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/settings/companyDetails/division/division');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');	
		// }

		// public function branch()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/settings/companyDetails/branch/branch');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function location()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/settings/companyDetails/location/location');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function configEmail()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/emailAndSms/configEmail/configEmail');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function configSms()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/emailAndSms/configSms/configSms');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function composeEmailSms()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/emailAndSms/composeEmailSms/composeEmailSms');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }

		// public function couponList()
		// {
		// 	$this->load->view('admin_view/templates/head');
		// 	$this->load->view('admin_view/templates/header');
		// 	$this->load->view('admin_view/templates/aside');
		// 	$this->load->view('admin_view/settings/coupon/couponList');
		// 	$this->load->view('admin_view/templates/aside_control');
		// 	$this->load->view('admin_view/templates/script');
		// }


	}
?>