﻿

    <!-- Header-->
    <!-- Remove "navbar-sticky" class to make navigation bar scrollable with the page.-->
    <header class="site-header navbar-sticky">
      <!-- Topbar-->
      <div class="topbar d-flex justify-content-between">
        <!-- Logo-->
        <div class="site-branding d-flex"><a class="site-logo align-self-center" href="#"><img src="<?php echo base_url() ?>assets/ecommerce_assets/img/logo/logo.png" alt="Unishop"></a></div>
        <!-- Search / Categories-->
        <div class="search-box-wrap d-flex">
          <div class="search-box-inner align-self-center">
            <div class="search-box d-flex">
              <div class="btn-group categories-btn">
                
                <div class="dropdown-menu mega-dropdown">
                  <div class="row">
                    <div class="col-sm-3"><a class="d-block navi-link text-center mb-30" href="shop-grid-ls.html"><img class="d-block" src="<?php echo base_url() ?>assets/ecommerce_assets/img/shop/header-categories/01.jpg"><span class="text-gray-dark">Computers &amp; Accessories</span></a></div>
                    <div class="col-sm-3"><a class="d-block navi-link text-center mb-30" href="shop-grid-ls.html"><img class="d-block" src="<?php echo base_url() ?>assets/ecommerce_assets/img/shop/header-categories/02.jpg"><span class="text-gray-dark">Smartphones &amp; Tablets</span></a></div>
                    <div class="col-sm-3"><a class="d-block navi-link text-center mb-30" href="shop-grid-ls.html"><img class="d-block" src="<?php echo base_url() ?>assets/ecommerce_assets/img/shop/header-categories/03.jpg"><span class="text-gray-dark">TV, Video &amp; Audio</span></a></div>
                    <div class="col-sm-3"><a class="d-block navi-link text-center mb-30" href="shop-grid-ls.html"><img class="d-block" src="<?php echo base_url() ?>assets/ecommerce_assets/img/shop/header-categories/04.jpg"><span class="text-gray-dark">Cameras, Photo &amp; Video</span></a></div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3"><a class="d-block navi-link text-center mb-30" href="shop-grid-ls.html"><img class="d-block" src="<?php echo base_url() ?>assets/ecommerce_assets/img/shop/header-categories/05.jpg"><span class="text-gray-dark">Headphones</span></a></div>
                    <div class="col-sm-3"><a class="d-block navi-link text-center mb-30" href="shop-grid-ls.html"><img class="d-block" src="<?php echo base_url() ?>assets/ecommerce_assets/img/shop/header-categories/06.jpg"><span class="text-gray-dark">Wearable Electronics</span></a></div>
                    <div class="col-sm-3"><a class="d-block navi-link text-center mb-30" href="shop-grid-ls.html"><img class="d-block" src="<?php echo base_url() ?>assets/ecommerce_assets/img/shop/header-categories/07.jpg"><span class="text-gray-dark">Printers &amp; Ink</span></a></div>
                    <div class="col-sm-3"><a class="d-block navi-link text-center mb-30" href="shop-grid-ls.html"><img class="d-block" src="<?php echo base_url() ?>assets/ecommerce_assets/img/shop/header-categories/08.jpg"><span class="text-gray-dark">Video Games</span></a></div>
                  </div>
                </div>
              </div>
              <form class="input-group" method="get"><span class="input-group-btn">
                  <button type="submit"><i class="icon-search"></i></button></span>
                <input class="form-control" type="search" placeholder="Search for anything">
              </form>
            </div>
          </div>
        </div>
        <!-- Toolbar-->
        <div class="toolbar d-flex">
          <div class="toolbar-item visible-on-mobile mobile-menu-toggle"><a href="#">
              <div><i class="icon-menu"></i><span class="text-label">Menu</span></div></a></div>
          <div class="toolbar-item hidden-on-mobile"><a href="#">
              <div><i class="icon-user"></i><span class="text-label">Sign In / Up</span></div></a>
            <div class="toolbar-dropdown text-center px-3">
              <p class="text-xs mb-3 pt-2">Sign in to your account or register new one to have full control over your orders, receive bonuses and more.</p><a class="btn btn-primary btn-sm btn-block" href="account-login.html">Sign In</a>
              <p class="text-xs text-muted mb-2">New customer?&nbsp;<a href="#">Register</a></p>
            </div>
          </div>
          <div class="toolbar-item"><a href="#">
              <div><span class="cart-icon"><i class="icon-shopping-cart"></i><span class="count-label">3   </span></span><span class="text-label">Cart</span></div></a>
            <div class="toolbar-dropdown cart-dropdown widget-cart hidden-on-mobile">
              <!-- Entry-->
              <div class="entry">
                <div class="entry-thumb"><a href="shop-single.html"><img src="<?php echo base_url() ?>assets/ecommerce_assets/img/shop/widget/04.jpg" alt="Product"></a></div>
                <div class="entry-content">
                  <h4 class="entry-title"><a href="shop-single.html">Canon EOS M50 Mirrorless Camera</a></h4><span class="entry-meta">1 x $910.00</span>
                </div>
                <div class="entry-delete"><i class="icon-x"></i></div>
              </div>
              <!-- Entry-->
              <div class="entry">
                <div class="entry-thumb"><a href="shop-single.html"><img src="<?php echo base_url() ?>assets/ecommerce_assets/img/shop/widget/05.jpg" alt="Product"></a></div>
                <div class="entry-content">
                  <h4 class="entry-title"><a href="shop-single.html">Apple iPhone X 256 GB Space Gray</a></h4><span class="entry-meta">1 x $1,450.00</span>
                </div>
                <div class="entry-delete"><i class="icon-x"></i></div>
              </div>
              <!-- Entry-->
              <div class="entry">
                <div class="entry-thumb"><a href="shop-single.html"><img src="<?php echo base_url() ?>assets/ecommerce_assets/img/shop/widget/06.jpg" alt="Product"></a></div>
                <div class="entry-content">
                  <h4 class="entry-title"><a href="shop-single.html">HP LaserJet Pro Laser Printer</a></h4><span class="entry-meta">1 x $188.50</span>
                </div>
                <div class="entry-delete"><i class="icon-x"></i></div>
              </div>
              <div class="text-right">
                <p class="text-gray-dark py-2 mb-0"><span class='text-muted'>Subtotal:</span> &nbsp;$2,548.50</p>
              </div>
              <div class="d-flex">
                <div class="pr-2 w-50"><a class="btn btn-secondary btn-sm btn-block mb-0" href="cart.html">Expand Cart</a></div>
                <div class="pl-2 w-50"><a class="btn btn-primary btn-sm btn-block mb-0" href="checkout.html">Checkout</a></div>
              </div>
            </div>
          </div>
        </div>
        <!-- Mobile Menu-->
        <div class="mobile-menu">
          <!-- Search Box-->
          <div class="mobile-search">
            <form class="input-group" method="get"><span class="input-group-btn">
                <button type="submit"><i class="icon-search"></i></button></span>
              <input class="form-control" type="search" placeholder="Search site">
            </form>
          </div>
          <!-- Toolbar-->
          <div class="toolbar">
            <div class="toolbar-item"><a href="account-login.html">
                <div><i class="icon-user"></i><span class="text-label">Sign In / Up</span></div></a></div>
          </div>
          <!-- Slideable (Mobile) Menu-->
          <nav class="slideable-menu">
            <ul class="menu" data-initial-height="385">
              <li class="has-children active"><span><a href="index.html">Home</a><span class="sub-menu-toggle"></span></span>
                <ul class="slideable-submenu">
                    <li class="active"><a href="index.html">Hero Slider</a></li>
                    <li><a href="home-featured-categories.html">Categories Grid</a></li>
                </ul>
              </li>
              <li class="has-children"><span><a href="shop-grid-ls.html">Shop</a><span class="sub-menu-toggle"></span></span>
                <ul class="slideable-submenu">
                    <li><a href="shop-categories.html">Shop Categories</a></li>
                  <li class="has-children"><span><a href="shop-grid-ls.html">Shop Grid</a><span class="sub-menu-toggle"></span></span>
                    <ul class="slideable-submenu">
                        <li><a href="shop-grid-ls.html">Grid Left Sidebar</a></li>
                        <li><a href="shop-grid-rs.html">Grid Right Sidebar</a></li>
                        <li><a href="shop-grid-ns.html">Grid No Sidebar</a></li>
                    </ul>
                  </li>
                  <li class="has-children"><span><a href="shop-list-ls.html">Shop List</a><span class="sub-menu-toggle"></span></span>
                    <ul class="slideable-submenu">
                        <li><a href="shop-list-ls.html">List Left Sidebar</a></li>
                        <li><a href="shop-list-rs.html">List Right Sidebar</a></li>
                        <li><a href="shop-list-ns.html">List No Sidebar</a></li>
                    </ul>
                  </li>
                    <li><a href="shop-single.html">Single Product</a></li>
                    <li><a href="cart.html">Cart</a></li>
                  <li class="has-children"><span><a href="checkout-address.html">Checkout</a><span class="sub-menu-toggle"></span></span>
                    <ul class="slideable-submenu">
                        <li><a href="checkout-address.html">Address</a></li>
                        <li><a href="checkout-shipping.html">Shipping</a></li>
                        <li><a href="checkout-payment.html">Payment</a></li>
                        <li><a href="checkout-review.html">Review</a></li>
                        <li><a href="checkout-complete.html">Complete</a></li>
                    </ul>
                  </li>
                </ul>
              </li>
              <li class="has-children"><span><a href="#">Categories</a><span class="sub-menu-toggle"></span></span>
                <ul class="slideable-submenu">
                  <li><a href="#">Computers &amp; Accessories</a></li>
                  <li><a href="#">Smartphones &amp; Tablets</a></li>
                  <li><a href="#">TV, Video &amp; Audio</a></li>
                  <li><a href="#">Cameras, Photo &amp; Video</a></li>
                  <li><a href="#">Headphones</a></li>
                  <li><a href="#">Wearable Electronics</a></li>
                  <li><a href="#">Printers &amp; Ink</a></li>
                  <li><a href="#">Video Games</a></li>
                </ul>
              </li>
              <li class="has-children"><span><a href="account-orders.html">Account</a><span class="sub-menu-toggle"></span></span>
                <ul class="slideable-submenu">
                    <li><a href="account-login.html">Login / Register</a></li>
                    <li><a href="account-password-recovery.html">Password Recovery</a></li>
                    <li><a href="account-orders.html">Orders List</a></li>
                    <li><a href="account-wishlist.html">Wishlist</a></li>
                    <li><a href="account-profile.html">Profile Page</a></li>
                    <li><a href="account-address.html">Contact / Shipping Address</a></li>
                    <li><a href="account-open-ticket.html">Open Ticket</a></li>
                    <li><a href="account-tickets.html">My Tickets</a></li>
                    <li><a href="account-single-ticket.html">Single Ticket</a></li>
                </ul>
              </li>
              <li class="has-children"><span><a href="blog-rs.html">Blog</a><span class="sub-menu-toggle"></span></span>
                <ul class="slideable-submenu">
                  <li class="has-children"><span><a href="blog-rs.html">Blog Layout</a><span class="sub-menu-toggle"></span></span>
                    <ul class="slideable-submenu">
                        <li><a href="blog-rs.html">Blog Right Sidebar</a></li>
                        <li><a href="blog-ls.html">Blog Left Sidebar</a></li>
                        <li><a href="blog-ns.html">Blog No Sidebar</a></li>
                    </ul>
                  </li>
                  <li class="has-children"><span><a href="blog-single-rs.html">Single Post Layout</a><span class="sub-menu-toggle"></span></span>
                    <ul class="slideable-submenu">
                        <li><a href="blog-single-rs.html">Post Right Sidebar</a></li>
                        <li><a href="blog-single-ls.html">Post Left Sidebar</a></li>
                        <li><a href="blog-single-ns.html">Post No Sidebar</a></li>
                    </ul>
                  </li>
                </ul>
              </li>
              <li class="has-children"><span><a href="#">Pages</a><span class="sub-menu-toggle"></span></span>
                <ul class="slideable-submenu">
                    <li><a href="about.html">About Us</a></li>
                    <li><a href="contacts.html">Contacts</a></li>
                    <li><a href="faq.html">Help / FAQ</a></li>
                    <li><a href="product-comparison.html">Product Comparison</a></li>
                    <li><a href="order-tracking.html">Order Tracking</a></li>
                    <li><a href="search-results.html">Search Results</a></li>
                    <li><a href="404.html">404 Not Found</a></li>
                    <li><a href="coming-soon.html">Coming Soon</a></li>
                  <li><a class="text-danger" href="docs\dev-setup.html">Documentation</a></li>
                </ul>
              </li>
              <li class="has-children"><span><a href="components\accordion.html">Components</a><span class="sub-menu-toggle"></span></span>
                <ul class="slideable-submenu">
                    <li><a href="components\accordion.html">Accordion</a></li>
                    <li><a href="components\alerts.html">Alerts</a></li>
                    <li><a href="components\buttons.html">Buttons</a></li>
                    <li><a href="components\cards.html">Cards</a></li>
                    <li><a href="components\carousel.html">Carousel</a></li>
                    <li><a href="components\countdown.html">Countdown</a></li>
                    <li><a href="components\forms.html">Forms</a></li>
                    <li><a href="components\gallery.html">Gallery</a></li>
                    <li><a href="components\google-maps.html">Google Maps</a></li>
                    <li><a href="components\images.html">Images &amp; Figures</a></li>
                    <li><a href="components\list-group.html">List Group</a></li>
                    <li><a href="components\market-social-buttons.html">Market &amp; Social Buttons</a></li>
                    <li><a href="components\media.html">Media Object</a></li>
                    <li><a href="components\modal.html">Modal</a></li>
                    <li><a href="components\pagination.html">Pagination</a></li>
                    <li><a href="components\pills.html">Pills</a></li>
                    <li><a href="components\progress-bars.html">Progress Bars</a></li>
                    <li><a href="components\shop-items.html">Shop Items</a></li>
                    <li><a href="components\steps.html">Steps</a></li>
                    <li><a href="components\tables.html">Tables</a></li>
                    <li><a href="components\tabs.html">Tabs</a></li>
                    <li><a href="components\team.html">Team</a></li>
                    <li><a href="components\toasts.html">Toast Notifications</a></li>
                    <li><a href="components\tooltips-popovers.html">Tooltips &amp; Popovers</a></li>
                    <li><a href="components\typography.html">Typography</a></li>
                    <li><a href="components\video-player.html">Video Player</a></li>
                    <li><a href="components\widgets.html">Widgets</a></li>
                </ul>
              </li>
            </ul>
          </nav>
        </div>
      </div>
      <!-- Navbar-->
      <div class="navbar">
        <!-- <div class="btn-group categories-btn">
          <div class="site-branding d-flex">
            <a class="site-logo align-self-center" href="#">
              <img src="< ?php echo base_url() ?>assets/ecommerce_assets/logo/favicon.png" alt="Unishop">
            </a>
          </div>
        </div> -->
        <!-- Main Navigation-->
        <nav class="site-menu">
          <ul>
            <li class="has-submenu active"><a href="index.html">Home</a>
              <ul class="sub-menu">
                <li class="active has-children"><a href="index.html">Hero Slider</a>
                  <ul class="sub-menu w-400 p-0 overflow-hidden">
                    <li><a class="p-0" href="index.html"><img src="img\banners\home01.jpg" alt="Hero Slider Home"></a></li>
                  </ul>
                </li>
                <li class="has-children"><a href="home-featured-categories.html">Categories Grid</a>
                  <ul class="sub-menu w-400 p-0 overflow-hidden">
                    <li><a class="p-0" href="home-featured-categories.html"><img src="img\banners\home02.jpg" alt="Categories Grid Home"></a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li class="has-submenu"><a href="shop-grid-ls.html">Shop</a>
              <ul class="sub-menu">
                  <li><a href="shop-categories.html">Shop Categories</a></li>
                <li class="has-children"><a href="shop-grid-ls.html">Shop Grid</a>
                  <ul class="sub-menu">
                      <li><a href="shop-grid-ls.html">Grid Left Sidebar</a></li>
                      <li><a href="shop-grid-rs.html">Grid Right Sidebar</a></li>
                      <li><a href="shop-grid-ns.html">Grid No Sidebar</a></li>
                  </ul>
                </li>
                <li class="has-children"><a href="shop-list-ls.html">Shop List</a>
                  <ul class="sub-menu">
                      <li><a href="shop-list-ls.html">List Left Sidebar</a></li>
                      <li><a href="shop-list-rs.html">List Right Sidebar</a></li>
                      <li><a href="shop-list-ns.html">List No Sidebar</a></li>
                  </ul>
                </li>
                  <li><a href="shop-single.html">Single Product</a></li>
                  <li><a href="cart.html">Cart</a></li>
                <li class="has-children"><a href="checkout-address.html">Checkout</a>
                  <ul class="sub-menu">             
                      <li><a href="checkout-address.html">Address</a></li>
                      <li><a href="checkout-shipping.html">Shipping</a></li>
                      <li><a href="checkout-payment.html">Payment</a></li>
                      <li><a href="checkout-review.html">Review</a></li>
                      <li><a href="checkout-complete.html">Complete</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li class="has-megamenu"><a href="#">Mega Menu</a>
              <ul class="mega-menu">
                <li><span class="mega-menu-title">Top Categories</span>
                  <ul class="sub-menu">
                    <li><a href="#">Computers &amp; Accessories</a></li>
                    <li><a href="#">Smartphones &amp; Tablets</a></li>
                    <li><a href="#">TV, Video &amp; Audio</a></li>
                    <li><a href="#">Cameras, Photo &amp; Video</a></li>
                    <li><a href="#">Headphones</a></li>
                    <li><a href="#">Wearable Electronics</a></li>
                    <li><a href="#">Printers &amp; Ink</a></li>
                    <li><a href="#">Video Games</a></li>
                  </ul>
                </li>
                <li><span class="mega-menu-title">Popular Brands</span>
                  <ul class="sub-menu">
                    <li><a href="#">Apple</a></li>
                    <li><a href="#">Canon Inc.</a></li>
                    <li><a href="#">Hewlett-Packard</a></li>
                    <li><a href="#">Lenovo</a></li>
                    <li><a href="#">Panasonic</a></li>
                    <li><a href="#">Samsung Electronics</a></li>
                    <li><a href="#">Sony</a></li>
                    <li><a href="#">Toshiba</a></li>
                  </ul>
                </li>
                <li><span class="mega-menu-title">Store Locator</span>
                  <div class="card mb-3">
                    <div class="card-body">
                      <ul class="list-icon">
                        <li> <i class="icon-map-pin text-muted"></i>514 S. Magnolia St. Orlando, FL 32806, USA</li>
                        <li> <i class="icon-phone text-muted"></i>+1 (786) 322 560 40</li>
                        <li class="mb-0"><i class="icon-mail text-muted"></i><a class="navi-link" href="mailto:orlando.store@unishop.com">orlando.store@unishop.com</a></li>
                      </ul>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-body">
                      <ul class="list-icon">
                        <li> <i class="icon-map-pin text-muted"></i>44 Shirley Ave. West Chicago, IL 60185, USA</li>
                        <li> <i class="icon-phone text-muted"></i>+1 (847) 252 765 33</li>
                        <li class="mb-0"><i class="icon-mail text-muted"></i><a class="navi-link" href="mailto:chicago.store@unishop.comm">chicago.store@unishop.com</a></li>
                      </ul>
                    </div>
                  </div>
                </li>
                <li><a class="card border-0 bg-secondary rounded-0" href="shop-grid-ls.html"><img class="d-block mx-auto" alt="Samsung Galaxy S9" src="img\banners\mega-menu.jpg"></a></li>
              </ul>
            </li>
            <li class="has-submenu"><a href="account-orders.html">Account</a>
              <ul class="sub-menu">
                  <li><a href="account-login.html">Login / Register</a></li>
                  <li><a href="account-password-recovery.html">Password Recovery</a></li>
                  <li><a href="account-orders.html">Orders List</a></li>
                  <li><a href="account-wishlist.html">Wishlist</a></li>
                  <li><a href="account-profile.html">Profile Page</a></li>
                  <li><a href="account-address.html">Contact / Shipping Address</a></li>
                  <li><a href="account-tickets.html">My Tickets</a></li>
                  <li><a href="account-single-ticket.html">Single Ticket</a></li>
              </ul>
            </li>
            <li class="has-submenu"><a href="blog-rs.html">Blog</a>
              <ul class="sub-menu">
                <li class="has-children"><a href="blog-rs.html">Blog Layout</a>
                  <ul class="sub-menu">
                      <li><a href="blog-rs.html">Blog Right Sidebar</a></li>
                      <li><a href="blog-ls.html">Blog Left Sidebar</a></li>
                      <li><a href="blog-ns.html">Blog No Sidebar</a></li>
                  </ul>
                </li>
                <li class="has-children"><a href="blog-single-rs.html">Single Post Layout</a>
                  <ul class="sub-menu">
                      <li><a href="blog-single-rs.html">Post Right Sidebar</a></li>
                      <li><a href="blog-single-ls.html">Post Left Sidebar</a></li>
                      <li><a href="blog-single-ns.html">Post No Sidebar</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li class="has-submenu"><a href="#">Pages</a>
              <ul class="sub-menu">
                  <li><a href="about.html">About Us</a></li>
                  <li><a href="contacts.html">Contacts</a></li>
                  <li><a href="faq.html">Help / FAQ</a></li>
                  <li><a href="product-comparison.html">Product Comparison</a></li>
                  <li><a href="order-tracking.html">Order Tracking</a></li>
                  <li><a href="search-results.html">Search Results</a></li>
                  <li><a href="404.html">404 Not Found</a></li>
                  <li><a href="coming-soon.html">Coming Soon</a></li>
                <li><a class="text-danger" href="docs\dev-setup.html">Documentation</a></li>
              </ul>
            </li>
            <li class="has-megamenu"><a href="components\accordion.html">Components</a>
              <ul class="mega-menu">
                <li><span class="mega-menu-title">A - F</span>
                    <ul class="sub-menu">
                      <li><a href="components\accordion.html">Accordion</a></li>
                      <li><a href="components\alerts.html">Alerts</a></li>
                      <li><a href="components\buttons.html">Buttons</a></li>
                      <li><a href="components\cards.html">Cards</a></li>
                      <li><a href="components\carousel.html">Carousel</a></li>
                      <li><a href="components\countdown.html">Countdown</a></li>
                      <li><a href="components\forms.html">Forms</a></li>
                    </ul>
                </li>
                <li><span class="mega-menu-title">G - M</span>
                    <ul class="sub-menu">
                      <li><a href="components\gallery.html">Gallery</a></li>
                      <li><a href="components\google-maps.html">Google Maps</a></li>
                      <li><a href="components\images.html">Images &amp; Figures</a></li>
                      <li><a href="components\list-group.html">List Group</a></li>
                      <li><a href="components\market-social-buttons.html">Market &amp; Social Buttons</a></li>
                      <li><a href="components\media.html">Media Object</a></li>
                      <li><a href="components\modal.html">Modal</a></li>
                    </ul>
                </li>
                <li><span class="mega-menu-title">P - T</span>
                    <ul class="sub-menu">
                      <li><a href="components\pagination.html">Pagination</a></li>
                      <li><a href="components\pills.html">Pills</a></li>
                      <li><a href="components\progress-bars.html">Progress Bars</a></li>
                      <li><a href="components\shop-items.html">Shop Items</a></li>
                      <li><a href="components\spinners.html">Spinners</a></li>
                      <li><a href="components\steps.html">Steps</a></li>
                      <li><a href="components\tables.html">Tables</a></li>
                    </ul>
                </li>
                <li><span class="mega-menu-title">T - W</span>
                    <ul class="sub-menu">
                      <li><a href="components\tabs.html">Tabs</a></li>
                      <li><a href="components\team.html">Team</a></li>
                      <li><a href="components\toasts.html">Toast Notifications</a></li>
                      <li><a href="components\tooltips-popovers.html">Tooltips &amp; Popovers</a></li>
                      <li><a href="components\typography.html">Typography</a></li>
                      <li><a href="components\video-player.html">Video Player</a></li>
                      <li><a href="components\widgets.html">Widgets</a></li>
                    </ul>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
        <!-- Toolbar ( Put toolbar here only if you enable sticky navbar )-->
        <div class="toolbar">
          <div class="toolbar-inner">
            <div class="toolbar-item"><a href="product-comparison.html">
                <div><span class="compare-icon"><i class="icon-repeat"></i><span class="count-label">3</span></span><span class="text-label">Compare</span></div></a></div>
            <div class="toolbar-item"><a href="cart.html">
                <div><span class="cart-icon"><i class="icon-shopping-cart"></i><span class="count-label">3   </span></span><span class="text-label">Cart</span></div></a>
              <div class="toolbar-dropdown cart-dropdown widget-cart">
                <!-- Entry-->
                <div class="entry">
                  <div class="entry-thumb"><a href="shop-single.html"><img src="img\shop\widget\04.jpg" alt="Product"></a></div>
                  <div class="entry-content">
                    <h4 class="entry-title"><a href="shop-single.html">Canon EOS M50 Mirrorless Camera</a></h4><span class="entry-meta">1 x $910.00</span>
                  </div>
                  <div class="entry-delete"><i class="icon-x"></i></div>
                </div>
                <!-- Entry-->
                <div class="entry">
                  <div class="entry-thumb"><a href="shop-single.html"><img src="img\shop\widget\05.jpg" alt="Product"></a></div>
                  <div class="entry-content">
                    <h4 class="entry-title"><a href="shop-single.html">Apple iPhone X 256 GB Space Gray</a></h4><span class="entry-meta">1 x $1,450.00</span>
                  </div>
                  <div class="entry-delete"><i class="icon-x"></i></div>
                </div>
                <!-- Entry-->
                <div class="entry">
                  <div class="entry-thumb"><a href="shop-single.html"><img src="img\shop\widget\06.jpg" alt="Product"></a></div>
                  <div class="entry-content">
                    <h4 class="entry-title"><a href="shop-single.html">HP LaserJet Pro Laser Printer</a></h4><span class="entry-meta">1 x $188.50</span>
                  </div>
                  <div class="entry-delete"><i class="icon-x"></i></div>
                </div>
                <div class="text-right">
                  <p class="text-gray-dark py-2 mb-0"><span class='text-muted'>Subtotal:</span> &nbsp;$2,548.50</p>
                </div>
                <div class="d-flex">
                  <div class="pr-2 w-50"><a class="btn btn-secondary btn-sm btn-block mb-0" href="cart.html">Expand Cart</a></div>
                  <div class="pl-2 w-50"><a class="btn btn-primary btn-sm btn-block mb-0" href="checkout.html">Checkout</a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>
    <!-- Page Content-->
    <!-- Main Slider-->
    <section class="hero-slider" style="background-image: url(<?php echo base_url()?>assets/ecommerce_assets/img/hero-slider/main-bg.jpg);">
      <div class="owl-carousel large-controls dots-inside" data-owl-carousel="{ &quot;nav&quot;: true, &quot;dots&quot;: true, &quot;loop&quot;: true, &quot;autoplay&quot;: true, &quot;autoplayTimeout&quot;: 7000 }">
        <div class="item">
          <div class="container padding-top-3x">
            <div class="row justify-content-center align-items-center">
              <div class="col-lg-5 col-md-6 padding-bottom-2x text-md-left text-center">
                <div class="from-bottom"><img class="d-inline-block w-150 mb-4" src="<?php echo base_url()?>assets/ecommerce_assets/img/hero-slider/logo02.png" alt="Puma">
                  <div class="h2 text-body mb-2 pt-1">Google Home - Smart Speaker</div>
                  <div class="h2 text-body mb-4 pb-1">starting at <span class="text-medium">$129.00</span></div>
                </div><a class="btn btn-primary scale-up delay-1" href="shop-grid-ls.html">View Offers&nbsp;<i class="icon-arrow-right"></i></a>
              </div>
              <div class="col-md-6 padding-bottom-2x mb-3"><img class="d-block mx-auto" src="<?php echo base_url()?>assets/ecommerce_assets/img/hero-slider/02.png" alt="Puma Backpack"></div>
            </div>
          </div>
        </div>
        <div class="item">
          <div class="container padding-top-3x">
            <div class="row justify-content-center align-items-center">
              <div class="col-lg-5 col-md-6 padding-bottom-2x text-md-left text-center">
                <div class="from-bottom"><img class="d-inline-block w-150 mb-3" src="img\hero-slider\logo01.png" alt="Sony">
                  <div class="h2 text-body mb-2 pt-1">Modern Powerful Laptop</div>
                  <div class="h2 text-body mb-4 pb-1">for only <span class="text-medium">$1,459.99</span></div>
                </div><a class="btn btn-primary scale-up delay-1" href="shop-single.html">Shop Now&nbsp;<i class="icon-arrow-right"></i></a>
              </div>
              <div class="col-md-6 padding-bottom-2x mb-3"><img class="d-block mx-auto" src="<?php echo base_url()?>assets/ecommerce_assets/img/hero-slider/01.png" alt="Chuck Taylor All Star II"></div>
            </div>
          </div>
        </div>
        <div class="item">
          <div class="container padding-top-3x">
            <div class="row justify-content-center align-items-center">
              <div class="col-lg-5 col-md-6 padding-bottom-2x text-md-left text-center">
                <div class="from-bottom"><img class="d-inline-block w-150 mb-3" src="img\hero-slider\logo03.png" alt="Motorola">
                  <div class="h2 text-body mb-2 pt-1">Beats Studio by Dr.Dre</div>
                  <div class="h2 text-body mb-4 pb-1">for only <span class="text-medium">$349.50</span></div>
                </div><a class="btn btn-primary scale-up delay-1" href="shop-single.html">Shop Now&nbsp;<i class="icon-arrow-right"></i></a>
              </div>
              <div class="col-md-6 padding-bottom-2x mb-3"><img class="d-block mx-auto" src="<?php echo base_url()?>assets/ecommerce_assets/img/hero-slider/03.png" alt="Moto 360"></div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Top Categories/Deals-->
    <section class="container padding-top-3x padding-bottom-2x">
      <div class="row">
        <div class="col-lg-4 col-sm-6">
          <div class="card border-0 bg-secondary mb-30">
            <div class="card-body d-table w-100">
              <div class="d-table-cell align-middle"><img class="d-block w-100" src="<?php echo base_url()?>assets/ecommerce_assets/img/shop/categories/29.png" alt="Image"></div>
              <div class="d-table-cell align-middle pl-2">
                <h3 class="h6 text-thin">Tablets, Smartphones <br><strong>And more...</strong></h3>
                <h4 class="h6 d-table w-100 text-thin"><span class="d-table-cell align-bottom" style="line-height: 1.2;">UP<br>TO&nbsp;</span><span class="d-table-cell align-bottom h1 text-medium">50%</span><span class="d-table-cell align-bottom">&nbsp;off</span></h4><a class="text-decoration-none" href="shop-grid-ls.html">Shop now&nbsp;<i class="icon-chevron-right d-inline-block align-middle text-lg"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-sm-6">
          <div class="card border-0 bg-secondary mb-30">
            <div class="card-body d-table w-100">
              <div class="d-table-cell align-middle"><img class="d-block w-100" src="<?php echo base_url()?>assets/ecommerce_assets/img/shop/categories/30.png" alt="Image"></div>
              <div class="d-table-cell align-middle pl-2">
                <h3 class="h6 text-thin">DJ Phantom <span style='white-space: nowrap;'>HD Video Drone</span> <br><strong>Arrives</strong></h3>
                <h4 class="h6 d-table w-100 text-thin"><span class="d-table-cell align-top text-right" style="line-height: 1.2;">From&nbsp;<br><strong>$&nbsp;</strong></span><span class="d-table-cell align-top h1 text-medium">990</span></h4><a class="text-decoration-none" href="shop-grid-ls.html">Shop now&nbsp;<i class="icon-chevron-right d-inline-block align-middle text-lg"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-sm-6">
          <div class="card border-0 bg-secondary mb-30">
            <div class="card-body d-table w-100">
              <div class="d-table-cell align-middle"><img class="d-block w-100" src="<?php echo base_url()?>assets/ecommerce_assets/img/shop/categories/31.png" alt="Image"></div>
              <div class="d-table-cell align-middle pl-2">
                <h3 class="h6 text-thin">Watches, Fitness Bands <br><strong>And more...</strong></h3>
                <h4 class="h6 d-table w-100 text-thin"><span class="d-table-cell align-bottom" style="line-height: 1.2;">UP<br>TO&nbsp;</span><span class="d-table-cell align-bottom h1 text-medium">39%</span><span class="d-table-cell align-bottom">&nbsp;off</span></h4><a class="text-decoration-none" href="shop-grid-ls.html">Shop now&nbsp;<i class="icon-chevron-right d-inline-block align-middle text-lg"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Featured Products-->
    <section class="container padding-bottom-2x mb-2">
      <h2 class="h3 pb-3 text-center">Featured Products</h2>
      <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-6">
          <div class="product-card mb-30">
            <div class="product-badge bg-danger">Sale</div><a class="product-thumb" href="shop-single.html"><img src="<?php echo base_url()?>assets/ecommerce_assets/img/shop/products/01.jpg" alt="Product"></a>
            <div class="product-card-body">
              <div class="product-category"><a href="#">Smart home</a></div>
              <h3 class="product-title"><a href="shop-single.html">Echo Dot (2nd Generation)</a></h3>
              <h4 class="product-price">
                <del>$62.00</del>$49.99
              </h4>
            </div>
            <div class="product-button-group"><a class="product-button btn-wishlist" href="#"><i class="icon-heart"></i><span>Wishlist</span></a><a class="product-button btn-compare" href="#"><i class="icon-repeat"></i><span>Compare</span></a><a class="product-button" href="#" data-toast="" data-toast-type="success" data-toast-position="topRight" data-toast-icon="icon-check-circle" data-toast-title="Product" data-toast-message="successfuly added to cart!"><i class="icon-shopping-cart"></i><span>To Cart</span></a></div>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
          <div class="product-card mb-30">
              <div class="rating-stars"><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star"></i>
              </div><a class="product-thumb" href="shop-single.html"><img src="<?php echo base_url()?>assets/ecommerce_assets/img/shop/products/02.jpg" alt="Product"></a>
            <div class="product-card-body">
              <div class="product-category"><a href="#">Photo cameras</a></div>
              <h3 class="product-title"><a href="shop-single.html">Aberg Best 21 Mega Pixels</a></h3>
              <h4 class="product-price">$35.00</h4>
            </div>
            <div class="product-button-group"><a class="product-button btn-wishlist" href="#"><i class="icon-heart"></i><span>Wishlist</span></a><a class="product-button btn-compare" href="#"><i class="icon-repeat"></i><span>Compare</span></a><a class="product-button" href="#" data-toast="" data-toast-type="success" data-toast-position="topRight" data-toast-icon="icon-check-circle" data-toast-title="Product" data-toast-message="successfuly added to cart!"><i class="icon-shopping-cart"></i><span>To Cart</span></a></div>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
          <div class="product-card mb-30"><a class="product-thumb" href="shop-single.html"><img src="<?php echo base_url()?>assets/ecommerce_assets/img/shop/products/05.jpg" alt="Product"></a>
            <div class="product-card-body">
              <div class="product-category"><a href="#">Headphones</a></div>
              <h3 class="product-title"><a href="shop-single.html">Zeus Bluetooth Headphones</a></h3>
              <h4 class="product-price">$28.99</h4>
            </div>
            <div class="product-button-group"><a class="product-button btn-wishlist" href="#"><i class="icon-heart"></i><span>Wishlist</span></a><a class="product-button btn-compare" href="#"><i class="icon-repeat"></i><span>Compare</span></a><a class="product-button" href="#" data-toast="" data-toast-type="success" data-toast-position="topRight" data-toast-icon="icon-check-circle" data-toast-title="Product" data-toast-message="successfuly added to cart!"><i class="icon-shopping-cart"></i><span>To Cart</span></a></div>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
          <div class="product-card mb-30"><a class="product-thumb" href="shop-single.html"><img src="<?php echo base_url()?>assets/ecommerce_assets/img/shop/products/07.jpg" alt="Product"></a>
            <div class="product-card-body">
              <div class="product-category"><a href="#">Smartphones</a></div>
              <h3 class="product-title"><a href="shop-single.html">Samsung Galaxy S9+</a></h3>
              <h4 class="product-price">$839.99</h4>
            </div>
            <div class="product-button-group"><a class="product-button btn-wishlist" href="#"><i class="icon-heart"></i><span>Wishlist</span></a><a class="product-button btn-compare" href="#"><i class="icon-repeat"></i><span>Compare</span></a><a class="product-button" href="#" data-toast="" data-toast-type="success" data-toast-position="topRight" data-toast-icon="icon-check-circle" data-toast-title="Product" data-toast-message="successfuly added to cart!"><i class="icon-shopping-cart"></i><span>To Cart</span></a></div>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
          <div class="product-card mb-30">
              <div class="rating-stars"><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star"></i><i class="icon-star"></i>
              </div><a class="product-thumb" href="shop-single.html"><img src="<?php echo base_url()?>assets/ecommerce_assets/img/shop/products/11.jpg" alt="Product"></a>
            <div class="product-card-body">
              <div class="product-category"><a href="#">Headphones</a></div>
              <h3 class="product-title"><a href="shop-single.html">Edifier W855BT Bluetooth</a></h3>
              <h4 class="product-price">$99.75</h4>
            </div>
            <div class="product-button-group"><a class="product-button btn-wishlist" href="#"><i class="icon-heart"></i><span>Wishlist</span></a><a class="product-button btn-compare" href="#"><i class="icon-repeat"></i><span>Compare</span></a><a class="product-button" href="#" data-toast="" data-toast-type="success" data-toast-position="topRight" data-toast-icon="icon-check-circle" data-toast-title="Product" data-toast-message="successfuly added to cart!"><i class="icon-shopping-cart"></i><span>To Cart</span></a></div>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
          <div class="product-card mb-30">
            <div class="product-badge bg-secondary border-default text-body">Out of stock</div><a class="product-thumb" href="shop-single.html"><img src="<?php echo base_url()?>assets/ecommerce_assets/img/shop/products/03.jpg" alt="Product"></a>
            <div class="product-card-body">
              <div class="product-category"><a href="#">Computers, laptops</a></div>
              <h3 class="product-title"><a href="shop-single.html">Microsoft Surface Pro 4</a></h3>
              <h4 class="product-price">$1,049.10</h4>
            </div>
            <div class="product-button-group"><a class="product-button btn-wishlist" href="#"><i class="icon-heart"></i><span>Wishlist</span></a><a class="product-button btn-compare" href="#"><i class="icon-repeat"></i><span>Compare</span></a><a class="product-button" href="shop-single.html"><i class="icon-arrow-right"></i><span>Details</span></a></div>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
          <div class="product-card mb-30"><a class="product-thumb" href="shop-single.html"><img src="<?php echo base_url()?>assets/ecommerce_assets/img/shop/products/12.jpg" alt="Product"></a>
            <div class="product-card-body">
              <div class="product-category"><a href="#">Wearable electornics</a></div>
              <h3 class="product-title"><a href="shop-single.html">Apple Watch Series 3</a></h3>
              <h4 class="product-price">$329.10</h4>
            </div>
            <div class="product-button-group"><a class="product-button btn-wishlist" href="#"><i class="icon-heart"></i><span>Wishlist</span></a><a class="product-button btn-compare" href="#"><i class="icon-repeat"></i><span>Compare</span></a><a class="product-button" href="#" data-toast="" data-toast-type="success" data-toast-position="topRight" data-toast-icon="icon-check-circle" data-toast-title="Product" data-toast-message="successfuly added to cart!"><i class="icon-shopping-cart"></i><span>To Cart</span></a></div>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">     
          <div class="product-card mb-30">
            <div class="product-badge bg-danger">Sale</div><a class="product-thumb" href="shop-single.html"><img src="<?php echo base_url()?>assets/ecommerce_assets/img/shop/products/09.jpg" alt="Product"></a>
            <div class="product-card-body">
              <div class="product-category"><a href="#">Action cameras</a></div>
              <h3 class="product-title"><a href="shop-single.html">Samsung Gear 360 Camera</a></h3>
              <h4 class="product-price">
                <del>$74.00</del>$68.00
              </h4>
            </div>
            <div class="product-button-group"><a class="product-button btn-wishlist" href="#"><i class="icon-heart"></i><span>Wishlist</span></a><a class="product-button btn-compare" href="#"><i class="icon-repeat"></i><span>Compare</span></a><a class="product-button" href="#" data-toast="" data-toast-type="success" data-toast-position="topRight" data-toast-icon="icon-check-circle" data-toast-title="Product" data-toast-message="successfuly added to cart!"><i class="icon-shopping-cart"></i><span>To Cart</span></a></div>
          </div>
        </div>
      </div>
      <div class="text-center"><a class="btn btn-outline-secondary" href="shop-grid-ls.html">View All Products</a></div>
    </section>
    <!-- CTA-->
    <section class="fw-section padding-top-4x padding-bottom-8x" style="background-image: url(<?php echo base_url()?>assets/ecommerce_assets/img/banners/shop-banner-bg-02.jpg);"><span class="overlay" style="opacity: .7;"></span>
      <div class="container text-center">
        <div class="d-inline-block bg-danger text-white text-lg py-2 px-3 rounded">Limited Time Offer</div>
        <div class="display-4 text-white py-4">Ultimate Printing Solution From</div>
        <div class="d-inline-block w-200 pt-2"><img class="d-block w-100" src="<?php echo base_url()?>assets/ecommerce_assets/img/banners/shop-banner-logo.png" alt="Canon"></div>
        <div class="pt-5"></div>
        <div class="countdown countdown-inverse" data-date-time="12/30/2019 12:00:00">
          <div class="item">
            <div class="days">00</div><span class="days_ref">Days</span>
          </div>
          <div class="item">
            <div class="hours">00</div><span class="hours_ref">Hours</span>
          </div>
          <div class="item">
            <div class="minutes">00</div><span class="minutes_ref">Mins</span>
          </div>
          <div class="item">
            <div class="seconds">00</div><span class="seconds_ref">Secs</span>
          </div>
        </div>
      </div>
    </section><a class="d-block position-relative mx-auto" href="shop-grid-ls.html" style="max-width: 682px; margin-top: -130px; z-index: 10;"><img class="d-block w-100" src="<?php echo base_url()?>assets/ecommerce_assets/img/banners/shop-banner-02.png" alt="Printers"></a>
    <!-- Staff Picks (Widgets)-->
    <section class="container padding-top-3x padding-bottom-2x">
      <h2 class="h3 pb-3 text-center">Staff Picks</h2>
      <div class="row pt-1">
        <div class="col-md-4 col-sm-6">
          <div class="widget widget-featured-products">
            <h3 class="widget-title">Best Sellers</h3>
            <!-- Entry-->
            <div class="entry">
              <div class="entry-thumb"><a href="shop-single.html"><img src="<?php echo base_url()?>assets/ecommerce_assets/img/shop/widget/01.jpg" alt="Product"></a></div>
              <div class="entry-content">
                <h4 class="entry-title"><a href="shop-single.html">GoPro Hero4 Silver</a></h4><span class="entry-meta">$287.99</span>
              </div>
            </div>
            <!-- Entry-->
            <div class="entry">
              <div class="entry-thumb"><a href="shop-single.html"><img src="<?php echo base_url()?>assets/ecommerce_assets/img/shop/widget/02.jpg" alt="Product"></a></div>
              <div class="entry-content">
                <h4 class="entry-title"><a href="shop-single.html">Puro Sound Labs BT2200</a></h4><span class="entry-meta">$95.99</span>
              </div>
            </div>
            <!-- Entry-->
            <div class="entry">
              <div class="entry-thumb"><a href="shop-single.html"><img src="<?php echo base_url()?>assets/ecommerce_assets/img/shop/widget/03.jpg" alt="Product"></a></div>
              <div class="entry-content">
                <h4 class="entry-title"><a href="shop-single.html">HP OfficeJet Pro 8710</a></h4><span class="entry-meta">$89.70</span>
              </div>
            </div><a class="btn btn-outline-secondary btn-sm mb-0" href="shop-grid-ls.html">View More</a>
          </div>
        </div>
        <div class="col-md-4 col-sm-6">
          <div class="widget widget-featured-products">
            <h3 class="widget-title">New Arrivals</h3>
            <!-- Entry-->
            <div class="entry pb-2">
              <div class="entry-thumb"><a href="shop-single.html"><img src="<?php echo base_url()?>assets/ecommerce_assets/img/shop/widget/05.jpg" alt="Product"></a></div>
              <div class="entry-content">
                <h4 class="entry-title"><a href="shop-single.html">iPhone X 256 GB Space Gray</a></h4><span class="entry-meta">$1,450.00</span>
              </div>
            </div>
            <!-- Entry-->
            <div class="entry">
              <div class="entry-thumb"><a href="shop-single.html"><img src="<?php echo base_url()?>assets/ecommerce_assets/img/shop/widget/04.jpg" alt="Product"></a></div>
              <div class="entry-content">
                <h4 class="entry-title"><a href="shop-single.html">Canon EOS M50 Mirrorless Camera</a></h4><span class="entry-meta">$910.00</span>
              </div>
            </div>
            <!-- Entry-->
            <div class="entry">
              <div class="entry-thumb"><a href="shop-single.html"><img src="<?php echo base_url()?>assets/ecommerce_assets/img/shop/widget/07.jpg" alt="Product"></a></div>
              <div class="entry-content">
                <h4 class="entry-title"><a href="shop-single.html">Microsoft Xbox One S</a></h4><span class="entry-meta">$298.99</span>
              </div>
            </div><a class="btn btn-outline-secondary btn-sm mb-0" href="shop-grid-ls.html">View More</a>
          </div>
        </div>
        <div class="col-md-4 col-sm-6">
          <div class="widget widget-featured-products">
            <h3 class="widget-title">Top Rated</h3>
            <!-- Entry-->
            <div class="entry pb-2">
              <div class="entry-thumb"><a href="shop-single.html"><img src="<?php echo base_url()?>assets/ecommerce_assets/img/shop/widget/08.jpg" alt="Product"></a></div>
              <div class="entry-content">
                <h4 class="entry-title"><a href="shop-single.html">Samsung Gear 360 VR Camera</a></h4><span class="entry-meta">$68.00</span>
              </div>
            </div>
            <!-- Entry-->
            <div class="entry">
              <div class="entry-thumb"><a href="shop-single.html"><img src="<?php echo base_url()?>assets/ecommerce_assets/img/shop/widget/09.jpg" alt="Product"></a></div>
              <div class="entry-content">
                <h4 class="entry-title"><a href="shop-single.html">Samsung Galaxy S9+ 64 GB</a></h4><span class="entry-meta">$839.99</span>
              </div>
            </div>
            <!-- Entry-->
            <div class="entry">
              <div class="entry-thumb"><a href="shop-single.html"><img src="<?php echo base_url()?>assets/ecommerce_assets/img/shop/widget/10.jpg" alt="Product"></a></div>
              <div class="entry-content">
                <h4 class="entry-title"><a href="shop-single.html">Zeus Bluetooth Headphones</a></h4><span class="entry-meta">$28.99</span>
              </div>
            </div><a class="btn btn-outline-secondary btn-sm mb-0" href="shop-grid-ls.html">View More</a>
          </div>
        </div>
      </div>
    </section>
    <!-- Popular Brands Carousel-->
    <section class="bg-secondary padding-top-3x padding-bottom-3x">
      <div class="container">
        <h2 class="h3 text-center mb-30 pb-3">Popular Brands</h2>
        <div class="owl-carousel" data-owl-carousel="{ &quot;nav&quot;: false, &quot;dots&quot;: false, &quot;loop&quot;: true, &quot;autoplay&quot;: true, &quot;autoplayTimeout&quot;: 4000, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:2}, &quot;470&quot;:{&quot;items&quot;:3},&quot;630&quot;:{&quot;items&quot;:4},&quot;991&quot;:{&quot;items&quot;:5},&quot;1200&quot;:{&quot;items&quot;:6}} }"><img class="d-block w-110 opacity-75 m-auto" src="<?php echo base_url()?>assets/ecommerce_assets/img/brands/01.png" alt="IBM"><img class="d-block w-110 opacity-75 m-auto" src="<?php echo base_url()?>assets/ecommerce_assets/img/brands/02.png" alt="Sony"><img class="d-block w-110 opacity-75 m-auto" src="<?php echo base_url()?>assets/ecommerce_assets/img/brands/03.png" alt="HP"><img class="d-block w-110 opacity-75 m-auto" src="<?php echo base_url()?>assets/ecommerce_assets/img/brands/04.png" alt="Canon"><img class="d-block w-110 opacity-75 m-auto" src="<?php echo base_url()?>assets/ecommerce_assets/img/brands/05.png" alt="Bosh"><img class="d-block w-110 opacity-75 m-auto" src="<?php echo base_url()?>assets/ecommerce_assets/img/brands/06.png" alt="Dell"><img class="d-block w-110 opacity-75 m-auto" src="<?php echo base_url()?>assets/ecommerce_assets/img/brands/07.png" alt="Samsung"></div>
      </div>
    </section>
    <!-- Services-->
    <section class="container padding-top-3x padding-bottom-2x">
      <div class="row">
        <div class="col-md-3 col-sm-6 text-center mb-30"><img class="d-block w-90 img-thumbnail rounded mx-auto mb-4" src="<?php echo base_url()?>assets/ecommerce_assets/img/services/01.png" alt="Shipping">
          <h6 class="mb-2">Free Worldwide Shipping</h6>
          <p class="text-sm text-muted mb-0">Free shipping for all orders over $100</p>
        </div>
        <div class="col-md-3 col-sm-6 text-center mb-30"><img class="d-block w-90 img-thumbnail rounded mx-auto mb-4" src="<?php echo base_url()?>assets/ecommerce_assets/img/services/02.png" alt="Money Back">
          <h6 class="mb-2">Money Back Guarantee</h6>
          <p class="text-sm text-muted mb-0">We return money within 30 days</p>
        </div>
        <div class="col-md-3 col-sm-6 text-center mb-30"><img class="d-block w-90 img-thumbnail rounded mx-auto mb-4" src="<?php echo base_url()?>assets/ecommerce_assets/img/services/03.png" alt="Support">
          <h6 class="mb-2">24/7 Customer Support</h6>
          <p class="text-sm text-muted mb-0">Friendly 24/7 customer support</p>
        </div>
        <div class="col-md-3 col-sm-6 text-center mb-30"><img class="d-block w-90 img-thumbnail rounded mx-auto mb-4" src="<?php echo base_url()?>assets/ecommerce_assets/img/services/04.png" alt="Payment">
          <h6 class="mb-2">Secure Online Payment</h6>
          <p class="text-sm text-muted mb-0">We posess SSL / Secure Certificate</p>
        </div>
      </div>
    </section>
    <!-- Site Footer-->
    <footer class="site-footer" style="background-image: url(<?php echo base_url()?>assets/ecommerce_assets/img/footer-bg.png);">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <!-- Categories-->
            <section class="widget widget-links widget-light-skin">
              <h3 class="widget-title">Shop Departments</h3>
              <div class="row">
                <div class="col-md-6">
                  <ul>
                    <li><a href="#">Computers &amp; Accessories</a></li>
                    <li><a href="#">Smartphones &amp; Tablets</a></li>
                    <li><a href="#">TV, Video &amp; Audio</a></li>
                    <li><a href="#">Cameras, Photo &amp; Video</a></li>
                    <li><a href="#">Headphones</a></li>
                    <li><a href="#">Wearable Electronics</a></li>
                  </ul>
                </div>
                <div class="col-md-6">
                  <ul>
                    <li><a href="#">Printers &amp; Ink</a></li>
                    <li><a href="#">Video Games</a></li>
                    <li><a href="#">Car Electronics</a></li>
                    <li><a href="#">Smart Home, IoT</a></li>
                    <li><a href="#">Musical Instruments</a></li>
                    <li><a href="#">Software</a></li>
                  </ul>
                </div>
              </div>
            </section>
          </div>
          <div class="col-lg-3 col-md-6">
            <!-- About Us-->
            <section class="widget widget-links widget-light-skin">
              <h3 class="widget-title">About Us</h3>
              <ul>
                <li><a href="#">Careers</a></li>
                <li><a href="#">About Unishop</a></li>
                <li><a href="#">Our Story</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Our Blog</a></li>
                <li><a href="#">Contacts</a></li>
              </ul>
            </section>
          </div>
          <div class="col-lg-3 col-md-6">
            <!-- Account / Shipping Info-->
            <section class="widget widget-links widget-light-skin">
              <h3 class="widget-title">Account &amp; Shipping Info</h3>
              <ul>
                <li><a href="#">My Account</a></li>
                <li><a href="#">Shipping Rates & Policies</a></li>
                <li><a href="#">Refunds & Replacements</a></li>
                <li><a href="#">Taxes</a></li>
                <li><a href="#">Delivery Info</a></li>
                <li><a href="#">Affiliate Program</a></li>
              </ul>
            </section>
          </div>
        </div>
        <hr class="hr-light mt-2 margin-bottom-2x hidden-md-down">
        <div class="row">
          <div class="col-lg-3 col-md-6">
            <!-- Contact Info-->
            <section class="widget widget-light-skin">
              <h3 class="widget-title">Get In Touch With Us</h3>
              <p class="text-white">Phone: +1 (900) 33 169 7720</p>
              <ul class="list-unstyled text-sm text-white">
                <li><span class="opacity-50">Monday-Friday:&nbsp;</span>9.00 am - 8.00 pm</li>
                <li><span class="opacity-50">Saturday:&nbsp;</span>10.00 am - 6.00 pm</li>
              </ul>
              <p><a class="navi-link-light" href="#">support@unishop.com</a></p><a class="social-button shape-circle sb-facebook sb-light-skin" href="#"><i class="socicon-facebook"></i></a><a class="social-button shape-circle sb-twitter sb-light-skin" href="#"><i class="socicon-twitter"></i></a><a class="social-button shape-circle sb-instagram sb-light-skin" href="#"><i class="socicon-instagram"></i></a><a class="social-button shape-circle sb-google-plus sb-light-skin" href="#"><i class="socicon-googleplus"></i></a>
            </section>
          </div>
          <div class="col-lg-3 col-md-6">
            <!-- Mobile App Buttons-->
            <section class="widget widget-light-skin">
              <h3 class="widget-title">Our Mobile App</h3><a class="market-button apple-button mb-light-skin" href="#"><span class="mb-subtitle">Download on the</span><span class="mb-title">App Store</span></a><a class="market-button google-button mb-light-skin" href="#"><span class="mb-subtitle">Download on the</span><span class="mb-title">Google Play</span></a><a class="market-button windows-button mb-light-skin" href="#"><span class="mb-subtitle">Download on the</span><span class="mb-title">Windows Store</span></a>
            </section>
          </div>
          <div class="col-lg-6">
            <!-- Subscription-->
            <section class="widget widget-light-skin">
              <h3 class="widget-title">Be Informed</h3>
              <form class="row" action="//rokaux.us12.list-manage.com/subscribe/post?u=c7103e2c981361a6639545bd5&amp;amp;id=1194bb7544" method="post" target="_blank" novalidate="">
                <div class="col-sm-9">
                  <div class="input-group input-light">
                    <input class="form-control" type="email" name="EMAIL" placeholder="Your e-mail"><span class="input-group-addon"><i class="icon-mail"></i></span>
                  </div>
                  <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                  <div style="position: absolute; left: -5000px;" aria-hidden="true">
                    <input type="text" name="b_c7103e2c981361a6639545bd5_1194bb7544" tabindex="-1">
                  </div>
                  <p class="form-text text-sm text-white opacity-50 pt-2">Subscribe to our Newsletter to receive early discount offers, latest news, sales and promo information.</p>
                </div>
                <div class="col-sm-3">
                  <button class="btn btn-primary btn-block mt-0" type="submit">Subscribe</button>
                </div>
              </form>
              <div class="pt-3"><img class="d-block" style="width: 324px;" alt="Cerdit Cards" src="img\credit-cards-footer.png"></div>
            </section>
          </div>
        </div>
        <!-- Copyright-->
        <!-- <p class="footer-copyright">© All rights reserved. Made with &nbsp;<i class="icon-heart text-danger"></i><a href="http://rokaux.com/" target="_blank"> &nbsp;by rokaux</a></p> -->
      </div>
    </footer>
    <!-- Back To Top Button--><a class="scroll-to-top-btn" href="#"><i class="icon-chevron-up"></i></a>
    <!-- Backdrop-->
    