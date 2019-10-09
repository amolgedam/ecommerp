
  <aside class="main-sidebar">

    <section class="sidebar">
     
      <ul class="sidebar-menu" data-widget="tree">
        
        <li class="header">MAIN NAVIGATION</li>
        
        <li>
          <a href="<?php echo base_url() ?>dashboard">
            <i class="fa fa-th"></i> <span>Dashboard</span>
          </a>
        </li>
        
        <?php if($_SESSION['wo_role'] != 'superadmin'){ ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-product-hunt"></i>
            <span>Master</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            <li><a href="<?php echo base_url() ?>ledger_master/"><i class="fa fa-circle-o"></i>Ledger Master</a></li>
            <li><a href="<?php echo base_url() ?>gst"><i class="fa fa-circle-o"></i>GST Master</a></li>
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i>Product Master
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li>
                  <a href="<?php echo base_url() ?>division"><i class="fa fa-circle-o"></i>Division Master</a>
                  <a href="<?php echo base_url(); ?>product_category"><i class="fa fa-circle-o"></i>Product / Service Category
                  </a>
                  <a href="<?php echo base_url(); ?>sku"><i class="fa fa-circle-o"></i>SKU</a>
                  <a href="<?php echo base_url(); ?>discount"><i class="fa fa-circle-o"></i>Discount Master</a>
                  <a href="<?php echo base_url(); ?>hsn"><i class="fa fa-circle-o"></i>HSN Master</a>
                  <a href="<?php echo base_url(); ?>unit"><i class="fa fa-circle-o"></i>Unit Master</a>
                  <a href="<?php echo base_url(); ?>weight"><i class="fa fa-circle-o"></i>Weight Master</a>
                  <a href="<?php echo base_url(); ?>attribute"><i class="fa fa-circle-o"></i>Attribute</a>
                  <a href="<?php echo base_url(); ?>barcode"><i class="fa fa-circle-o"></i>Product</a>
                  <a href="<?php echo base_url(); ?>brand"><i class="fa fa-circle-o"></i>Brand Master</a>
                </li>
              </ul>
            </li>
          </ul>
        </li>
        
        <?php } ?>

    <?php if($_SESSION['wo_role'] != 'superadmin'){ ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-product-hunt"></i>
            <span>Entry</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i>Purchase
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li>
                  <a href="<?php echo base_url(); ?>purchase_invoice"><i class="fa fa-circle-o"></i>Purchase Invoice</a>
                  <a href="<?php echo base_url(); ?>purchase_voucher"><i class="fa fa-circle-o"></i>Purchase Voucher</a>
                  <!--<a href="< ?php echo base_url(); ?>purchase_order"><i class="fa fa-circle-o"></i>Purchase Order</a>-->
                  <a href="<?php echo base_url(); ?>purchase_return"><i class="fa fa-circle-o"></i>Purchase Return</a>
                </li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i>Sales
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li>
                  <a href="<?php echo base_url(); ?>sales_invoice"><i class="fa fa-circle-o"></i>POS/Sales Invoice/Sales Vouchers</a>
                  <a href="<?php echo base_url(); ?>wsp"><i class="fa fa-circle-o"></i>WSP</a>
                  <a href="<?php echo base_url(); ?>sales_exchange"><i class="fa fa-circle-o"></i>Sales Exchange/Sales Return</a>
                </li>
              </ul>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>deliverymemo"><i class="fa fa-circle-o"></i>Delivery Memo</a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>paymentnote"><i class="fa fa-circle-o"></i>Payment Note</a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>receiptnote"><i class="fa fa-circle-o"></i>Receipt Note</a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>journalentry"><i class="fa fa-circle-o"></i>Journal Entry</a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>contraentry"><i class="fa fa-circle-o"></i>Contra Entry</a>
            </li>
          </ul>
        </li>
    <?php } ?>

    <?php if($_SESSION['wo_role'] != 'superadmin'){ ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-product-hunt"></i>
            <span>Inventory</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            <li><a href="<?php echo base_url() ?>opening_stock/"><i class="fa fa-circle-o"></i>Opening Stock</a></li>
            <li><a href="<?php echo base_url() ?>internal_consumption"><i class="fa fa-circle-o"></i>Internal Consumption</a></li>
            <li><a href="<?php echo base_url() ?>shortage"><i class="fa fa-circle-o"></i>Shortage</a></li>
            <li><a href="<?php echo base_url() ?>excesses"><i class="fa fa-circle-o"></i>Excesses</a></li>
            <li><a href="<?php echo base_url() ?>internal_transfer"><i class="fa fa-circle-o"></i>Internal Transfer</a></li>
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i>Inventory Reports
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li>
                  <a href="<?php echo base_url() ?>reports/consolidatedReport"><i class="fa fa-circle-o"></i>Consolidated Report
                  </a>
                  <a href="<?php echo base_url() ?>reports/customeReport"><i class="fa fa-circle-o"></i>Custom Report</a>
                  <a href="<?php echo base_url() ?>reports/agingReport"><i class="fa fa-circle-o"></i>Aging Report</a>
                </li>
              </ul>
            </li>
          </ul>
        </li>
    <?php } ?>

    <?php if($_SESSION['wo_role'] != 'superadmin'){ ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-product-hunt"></i>
            <span>Order Management System</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url() ?>purchase_order"><i class="fa fa-circle-o"></i>Purchase Order</a></li>
            <li><a href="<?php echo base_url() ?>sales_order"><i class="fa fa-circle-o"></i>Sales Order</a></li>
            <li><a href="<?php echo base_url() ?>reports/orderReport"><i class="fa fa-circle-o"></i>Order Report</a></li>
          </ul>
        </li>
    <?php } ?>

    <?php if($_SESSION['wo_role'] != 'superadmin'){ ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-product-hunt"></i>
            <span>Production</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url() ?>production"><i class="fa fa-circle-o"></i>Production Entry</a></li>
            <li><a href="<?php echo base_url() ?>reports/productionReport"><i class="fa fa-circle-o"></i>Production Reports</a></li>
          </ul>
        </li>
    <?php } ?>

    <?php if($_SESSION['wo_role'] != 'superadmin'){ ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-product-hunt"></i>
            <span>Budgeting</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url() ?>budget"><i class="fa fa-circle-o"></i>Budget</a></li>
            <li><a href="<?php echo base_url() ?>budget/report"><i class="fa fa-circle-o"></i>Budget Reports</a></li>
          </ul>
        </li>
    <?php } ?>
    
    <?php if($_SESSION['wo_role'] != 'superadmin'){ ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-product-hunt"></i>
            <span>CRM</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url() ?>contact"><i class="fa fa-circle-o"></i>Customer Information</a></li>
            <!-- <li><a href="< ?php echo base_url() ?>customer"><i class="fa fa-circle-o"></i>Customer Information</a></li> -->
            <li><a href="<?php echo base_url() ?>leads"><i class="fa fa-circle-o"></i>Leads Management</a></li>
            <li><a href="<?php echo base_url() ?>loyalty"><i class="fa fa-circle-o"></i>Loyalty Program</a></li>
            <li><a href="<?php echo base_url() ?>Customerconnect"><i class="fa fa-circle-o"></i>Customer Connect</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i>CRM Report</a></li>
          </ul>
        </li>
    <?php } ?>

    <?php if($_SESSION['wo_role'] != 'superadmin'){ ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-product-hunt"></i>
            <span>Reports</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url(); ?>reports/purchaseReport"><i class="fa fa-circle-o"></i>Purchase Report</a></li>
            <li><a href="<?php echo base_url(); ?>reports/salesReport"><i class="fa fa-circle-o"></i>Sales Report</a></li>
            <li><a href="<?php echo base_url(); ?>reports/ledgerGroupReport"><i class="fa fa-circle-o"></i>Ledger Group Report</a></li>
            <li><a href="<?php echo base_url(); ?>reports/ledgerReportSearch"><i class="fa fa-circle-o"></i>Ledger Report</a></li>

            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i>Financial Reports
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li>
                  <a href="<?php echo base_url(); ?>reports/tradingAc"><i class="fa fa-circle-o"></i>Trading A/c</a>
                  <a href="<?php echo base_url(); ?>reports/cashAccount"><i class="fa fa-circle-o"></i>Cash A/c</a>
                  <a href="<?php echo base_url(); ?>reports/profileAndLossReport"><i class="fa fa-circle-o"></i>Profite and loss A/c</a>
                  <a href="#"><i class="fa fa-circle-o"></i>Trial Balance</a>
                  <a href="#"><i class="fa fa-circle-o"></i>Balance Sheet</a>
                </li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i>Statutory Reports
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li>
                  <a href="<?php echo base_url(); ?>reports/gstReport"><i class="fa fa-circle-o"></i>GST Report</a>
                </li>
              </ul>
            </li>
          </ul>
        </li>
    <?php } ?>
    
    <?php if($_SESSION['wo_role'] == 'superadmin'){ ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-product-hunt"></i>
            <span>Email/SMS Settings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url() ?>compose/configEmail"><i class="fa fa-circle-o"></i>Email Config</a></li>
            <li><a href="<?php echo base_url() ?>compose/configSms"><i class="fa fa-circle-o"></i>SMS Config</a></li>
            <!--<li><a href="< ?php echo base_url() ?>compose"><i class="fa fa-circle-o"></i>Compose Email and SMS</a></li>-->
          </ul>
        </li>
    <?php } ?>


        <li class="treeview">
          <a href="#">
            <i class="fa fa-product-hunt"></i>
            <span>Settings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
              
            
                <!-- <li><a href="< ?php echo base_url() ?>coupon-list"><i class="fa fa-circle-o"></i>Coupons List</a></li> -->
                
                <!--<li><a href="< ?php echo base_url() ?>shipping_master"><i class="fa fa-circle-o"></i>Shipping Master</a></li>-->
                
                <!--< ?php if($_SESSION['wo_role'] != 'superadmin'){ ?>-->
                    <li><a href="<?php echo base_url() ?>payment_master"><i class="fa fa-circle-o"></i>Payment Type Master</a></li>
                <!--< ?php } ?>-->
                
                <!--< ?php if($_SESSION['wo_role'] != 'superadmin'){ ?>-->
                    <li><a href="<?php echo base_url() ?>service_master"><i class="fa fa-circle-o"></i>Service Type Master</a></li>
                <!--< ?php } ?>-->
                
                <!--< ?php if($_SESSION['wo_role'] != 'superadmin'){ ?>-->
                    <li><a href="<?php echo base_url() ?>designation_master"><i class="fa fa-circle-o"></i>Designation Master</a></li>
                <!--< ?php } ?>-->
                
                <?php if($_SESSION['wo_role'] != 'superadmin'){ ?>
                    <li class="treeview">
                      <a href="#"><i class="fa fa-circle-o"></i>Account Managment
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                      </a>
                      <ul class="treeview-menu">
                        <li>
                          <a href="<?php echo base_url(); ?>account_category"><i class="fa fa-circle-o"></i>Category and Subcategory
                          </a>
                          <a href="<?php echo base_url(); ?>ledger_type"><i class="fa fa-circle-o"></i>Ledger Type</a>
                        </li>
                      </ul>
                    </li>
                <?php } ?>
            
                <?php if($_SESSION['wo_role'] != 'admin'){ ?>
                <li class="treeview">
                  <a href="#"><i class="fa fa-circle-o"></i>User Managment
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li>
                      <a href="<?php echo base_url(); ?>role"><i class="fa fa-circle-o"></i>Manage Role
                      </a>
                       <a href="<?php echo base_url(); ?>users"><i class="fa fa-circle-o"></i>Manage User</a>
                      <a href="<?php echo base_url(); ?>group"><i class="fa fa-circle-o"></i>Manage Group</a> -->
                    </li>
                  </ul>
                </li>
                <?php } ?>
            
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i>Company Setting
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li>
                  <?php if($_SESSION['wo_role'] == 'superadmin'){ ?>
                    <a href="<?php echo base_url(); ?>company"><i class="fa fa-circle-o"></i>Company Details
                    </a>
                    <a href="<?php echo base_url() ?>store"><i class="fa fa-circle-o"></i>Store Master</a>
                  <?php
                    }
                  ?>
                  <!--<a href="< ?php echo base_url(); ?>division"><i class="fa fa-circle-o"></i>Division</a>-->
                  <!-- <a href="< ?php echo base_url(); ?>branch"><i class="fa fa-circle-o"></i>Branch</a> -->
                  
                  <?php if($_SESSION['wo_role'] != 'superadmin'){ ?>
                      <a href="<?php echo base_url(); ?>location"><i class="fa fa-circle-o"></i>Location</a>
                      <a href="<?php echo base_url(); ?>state"><i class="fa fa-circle-o"></i>State And City</a>
                    <?php } ?>
                </li>
              </ul>
            </li>
          </ul>
        </li>











        <!-- <li class="treeview">
          <a href="#">
            <i class="fa fa-book"></i>
            <span>Account</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="< ?php echo base_url() ?>account-ledger-list"><i class="fa fa-circle-o"></i> Ledger</a></li>
            <li><a href="< ?php echo base_url() ?>gst-details"><i class="fa fa-circle-o"></i> GST Master</a></li>
            <li><a href="< ?php echo base_url() ?>discount-master"><i class="fa fa-circle-o"></i> Discount Master</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-product-hunt"></i>
            <span>Product</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="< ?php echo base_url() ?>product-category"><i class="fa fa-circle-o"></i> Product / Service Category</a></li>
            <li><a href="< ?php echo base_url() ?>sku-master"><i class="fa fa-circle-o"></i> Add Product</a></li>
            <li><a href="< ?php echo base_url() ?>hsn-master"><i class="fa fa-circle-o"></i> HSN Master</a></li>
            <li><a href="< ?php echo base_url() ?>unit-master"><i class="fa fa-circle-o"></i> Unit</a></li>
            <li><a href="< ?php echo base_url() ?>product-attribute"><i class="fa fa-circle-o"></i> Attributes</a></li>
            <li><a href="< ?php echo base_url() ?>product-brand"><i class="fa fa-circle-o"></i> Brand</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-product-hunt"></i>
            <span>Entry Master</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="< ?php echo base_url() ?>delivery-memo"><i class="fa fa-circle-o"></i>Delivery Memo</a></li>
            <li><a href="< ?php echo base_url() ?>payment-voucher"><i class="fa fa-circle-o"></i>Payment Note</a></li>
            <li><a href="< ?php echo base_url() ?>receipt-voucher"><i class="fa fa-circle-o"></i>Receipt Note</a></li>
            <li><a href="< ?php echo base_url() ?>journal-entries"><i class="fa fa-circle-o"></i>Journal Entry</a></li>
            <li><a href="< ?php echo base_url() ?>contra-master"><i class="fa fa-circle-o"></i>Contra Entry</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-product-hunt"></i>
            <span>Purchase Master</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="< ?php echo base_url() ?>purchase-order-list"><i class="fa fa-circle-o"></i>Purchase Order</a></li>
            <li><a href="< ?php echo base_url() ?>purchase-invoice"><i class="fa fa-circle-o"></i>Purchase Invoice</a></li>
            <li><a href="< ?php echo base_url() ?>purchase-voucher"><i class="fa fa-circle-o"></i> Purchase Voucher</a></li>
            <li><a href="< ?php echo base_url() ?>purchase-return"><i class="fa fa-circle-o"></i> Purchase Return</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-product-hunt"></i>
            <span>Sales Master</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="< ?php echo base_url() ?>sales-order-list"><i class="fa fa-circle-o"></i>Sales Order</a></li>
            <li><a href="< ?php echo base_url() ?>sales-invoice"><i class="fa fa-circle-o"></i>Sales Invoice</a></li>
            <li><a href="< ?php echo base_url() ?>sales-wsp-list"><i class="fa fa-circle-o"></i> WSP</a></li>
            <li><a href="< ?php echo base_url() ?>sales-voucher"><i class="fa fa-circle-o"></i> Sales Voucher</a></li>
            <li><a href="< ?php echo base_url() ?>sales-exchange"><i class="fa fa-circle-o"></i> Sales Exchange</a></li>
          </ul>
        </li> -->
        <!-- already commernt start -->
                        <!-- <li>
                          <a href="#">
                            <i class="fa fa-product-hunt"></i> <span>Expenses</span>
                          </a>
                        </li> -->
                        
                        <!-- <li>
                          <a href="#">
                            <i class="fa fa-product-hunt"></i> <span>Banking and Transaction</span>
                          </a>
                        </li> -->
        <!-- already commernt end -->

        
        <!-- <li class="treeview">
          <a href="#">
            <i class="fa fa-product-hunt"></i>
            <span>Inventory</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="< ?php echo base_url() ?>opening-stock"><i class="fa fa-circle-o"></i>Opening Stock</a></li>
            <li><a href="< ?php echo base_url() ?>internal-consumssion"><i class="fa fa-circle-o"></i>Internal Consumption</a></li>
            <li><a href="< ?php echo base_url() ?>product-shortage"><i class="fa fa-circle-o"></i>Shortage</a></li>
            <li><a href="< ?php echo base_url() ?>excesses"><i class="fa fa-circle-o"></i>Excesses</a></li>
            <li><a href="< ?php echo base_url() ?>internal-transfer"><i class="fa fa-circle-o"></i>Internal Transfer</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-product-hunt"></i>
            <span>Production</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="< ?php echo base_url() ?>production-details"><i class="fa fa-circle-o"></i>Production</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i>Job Work</a></li>
            <li><a href="< ?php echo base_url() ?>production-measurement"><i class="fa fa-circle-o"></i>Measurement</a></li>
          </ul>
        </li>
        <li>
          <a href="< ?php echo base_url() ?>budget-details">
            <i class="fa fa-product-hunt"></i> <span>Budgeting Master</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-product-hunt"></i>
            <span>CRM</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="< ?php echo base_url() ?>contact-details"><i class="fa fa-circle-o"></i>Contact</a></li>
            <li><a href="< ?php echo base_url() ?>customer-information"><i class="fa fa-circle-o"></i>Customer Information</a></li>
            <li><a href="< ?php echo base_url() ?>leads-details"><i class="fa fa-circle-o"></i>Leads Management</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i>Loyalty Program</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i>Customer Communication</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-product-hunt"></i>
            <span>Reports</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="< ?php echo base_url() ?>config-email"><i class="fa fa-circle-o"></i>GST Report</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-product-hunt"></i>
            <span>Email/SMS Settings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="< ?php echo base_url() ?>config-email"><i class="fa fa-circle-o"></i>Email Config</a></li>
            <li><a href="< ?php echo base_url() ?>config-sms"><i class="fa fa-circle-o"></i>SMS Config</a></li>
            <li><a href="< ?php echo base_url() ?>compose-email-and-sms"><i class="fa fa-circle-o"></i>Compose Email and SMS</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-product-hunt"></i>
            <span>Settings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            <li><a href="< ?php echo base_url() ?>coupon-list"><i class="fa fa-circle-o"></i>Coupons List</a></li>
            <li><a href="< ?php echo base_url() ?>store-master"><i class="fa fa-circle-o"></i>Store Master</a></li>
            <li><a href="< ?php echo base_url() ?>shipping-master"><i class="fa fa-circle-o"></i>Shipping Master</a></li>
            <li><a href="< ?php echo base_url() ?>payment-master"><i class="fa fa-circle-o"></i>Payment Type Master</a></li>
            <li><a href="< ?php echo base_url() ?>service-type-master"><i class="fa fa-circle-o"></i>Service Type Master</a></li>
            <li><a href="< ?php echo base_url() ?>designation-master"><i class="fa fa-circle-o"></i>Designation Master</a></li>

            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i>Company Setting
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li>
                  <a href="< ?php echo base_url(); ?>company-details"><i class="fa fa-circle-o"></i>Company Details
                  </a>
                  <a href="< ?php echo base_url(); ?>division"><i class="fa fa-circle-o"></i>Division</a>
                  <a href="< ?php echo base_url(); ?>branch"><i class="fa fa-circle-o"></i>Branch</a>
                  <a href="< ?php echo base_url(); ?>location"><i class="fa fa-circle-o"></i>Location</a>
                </li>
              </ul>
            </li>
          </ul>
        </li> -->

      
      </ul>
    </section>

  </aside>