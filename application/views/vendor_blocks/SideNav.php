<aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="<?php echo base_url().'assets/images/user.png';?>" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $this->session->userdata('name').' - '.$this->session->userdata('store_name');?></div>
                    <div class="email"><?php echo $this->session->userdata('email');?></div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="<?php echo site_url('vendorpagescontroller/logout');?>"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>
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

                     <li <?php if ($page == 'four' || $page == 'five' || $page =='six' || $page == 'categ') { echo 'class = "active"';}?> >
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
                          <li  <?php if ($page == 'categ') { echo 'class = "active"';} ?> >
                              <a href="<?php echo site_url('vendor/viewcategories') ?>">View Categories</a>
                          </li>
                        </ul>
                    </li>

                    <li <?php if ($page == 'seven' || $page == 'eight' || $page == 'nine') { echo 'class = "active"';}?> >
                        <a   href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">work</i>
                            <span>Orders</span>
                        </a>
                        <ul class="ml-menu">
                          <li  <?php if ($page == 'seven') { echo 'class = "active"';} ?> >
                              <a href="<?php echo site_url('vendor/viewOrders') ?>">View Orders</a>
                          </li>
                          <li  <?php if ($page == 'eight') { echo 'class = "active"';} ?>>
                              <a href="<?php echo site_url('vendor/deliveryStatus') ?>">Delivery Status</a>
                          </li>
                          <li  <?php if ($page == 'nine') { echo 'class = "active"';} ?>>
                              <a href="<?php echo site_url('vendor/orderHistory') ?>">Order History</a>
                          </li>
                        </ul>
                    </li>

                    <?php }?>

                </ul>
            </div>
            <!-- #Menu -->

        </aside>
