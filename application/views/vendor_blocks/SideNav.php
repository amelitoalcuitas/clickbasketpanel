<aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <a href="<?php echo base_url('vendor/profile'); ?>"><img src='<?php echo base_url("assets/images/prof_pic/".$vendordata->vendor_image);?>' width="48" height="48" alt="User" /></a>
                </div>

                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $this->session->userdata('store_name');?></div>
                    <div class="email"><?php echo $this->session->userdata('email');?></div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <?php  if(isset($page))
            {?>

            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li <?php if ($page == 'one') { echo 'class = "active"';} ?> >
                        <a  href="<?php echo site_url('vendor');?>">
                            <i class="material-icons">home</i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                     <li <?php if ($page == 'four' || $page == 'five' || $page =='six' || $page == 'categ' || $page == 'delprod' || $page == 'delcat') { echo 'class = "active"';}?> >
                        <a   href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">shop</i>
                            <span>Products</span>
                        </a>
                        <ul class="ml-menu">
                          <li  <?php if ($page == 'five') { echo 'class = "active"';} ?>>
                              <a href="<?php echo site_url('vendor/addproduct') ?>">Add New Product</a>
                          </li>
                          <li  <?php if ($page == 'four') { echo 'class = "active"';} ?> >
                              <a href="<?php echo site_url('vendor/viewproduct') ?>">View Products</a>
                          </li>
                          <li  <?php if ($page == 'delprod') { echo 'class = "active"';} ?> >
                              <a href="<?php echo site_url('vendor/deletedproducts') ?>">Deleted Products</a>
                          </li>
                          <li  <?php if ($page == 'categ') { echo 'class = "active"';} ?> >
                              <a href="<?php echo site_url('vendor/viewcategories') ?>">View Categories</a>
                          </li>
                          <li  <?php if ($page == 'delcat') { echo 'class = "active"';} ?> >
                              <a href="<?php echo site_url('vendor/deletedcategories') ?>">Deleted Categories</a>
                          </li>
                        </ul>
                    </li>

                    <li <?php if ($page == 'seven' || $page == 'eight' || $page == 'nine') { echo 'class = "active"';}?> >
                        <a   href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">shopping_cart</i>
                            <span>Orders</span>
                        </a>
                        <ul class="ml-menu">
                          <li  <?php if ($page == 'seven') { echo 'class = "active"';} ?> >
                              <a href="<?php echo site_url('vendor/viewOrders') ?>">View Orders</a>
                          </li>
                          <li  <?php if ($page == 'nine') { echo 'class = "active"';} ?>>
                              <a href="<?php echo site_url('vendor/orderHistory') ?>">Order History</a>
                          </li>
                        </ul>
                    </li>

                    <li <?php if ($page == 'coupon') { echo 'class = "active"';} ?> >
                        <a  href="<?php echo site_url('vendor/viewcoupons');?>">
                            <i class="material-icons">monetization_on</i>
                            <span>Coupons</span>
                        </a>
                    </li>

                    <li <?php if ($page == 'report') { echo 'class = "active"';} ?> >
                        <a  href="<?php echo site_url('vendor/vendorreport');?>">
                            <i class="material-icons">view_module</i>
                            <span>Report</span>
                        </a>
                    </li>

                    <?php }?>

                </ul>
            </div>
            <!-- #Menu -->

        </aside>
