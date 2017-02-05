<aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <a href="<?php echo base_url('admin/profile'); ?>"><img src="<?php echo base_url('assets/images/prof_pic/default_admin.png');?>" width="48" height="48" alt="User" /></a>
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Super Admin</div>
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
                        <a  href="<?php echo site_url('admin');?>">
                            <i class="material-icons">home</i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li <?php if ($page == 'four' || $page == 'five' || $page == 'remStor') { echo 'class = "active"';}?>>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">store</i>
                            <span>Stores</span>
                        </a>
                        <ul class="ml-menu">
                          <li <?php if ($page == 'five') { echo 'class = "active"';} ?>>
                              <a href="<?php echo site_url('admin/addstore');?>">Add Store</a>
                          </li>
                          <li <?php if ($page == 'four') { echo 'class = "active"';} ?>>
                              <a href="<?php echo site_url('admin/viewstores');?>">View Stores</a>
                          </li>
                          <li <?php if ($page == 'remStor') { echo 'class = "active"';} ?>>
                              <a href="<?php echo site_url('admin/removedstores');?>">Removed Stores</a>
                          </li>
                        </ul>
                    </li>

                     <li <?php if ($page == 'two' || $page == 'three' || $page == 'remVen') { echo 'class = "active"';}?> >
                        <a   href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">people</i>
                            <span>Vendors</span>
                        </a>
                        <ul class="ml-menu">
                          <li  <?php if ($page == 'three') { echo 'class = "active"';} ?>>
                              <a href="<?php echo site_url('admin/register');?>">Register Vendor</a>
                          </li>
                          <li  <?php if ($page == 'two') { echo 'class = "active"';} ?> >
                              <a href="<?php echo site_url('admin/viewvendors');?>">View Vendors</a>
                          </li>
                          <li  <?php if ($page == 'remVen') { echo 'class = "active"';} ?>>
                              <a href="<?php echo site_url('admin/removedvendors');?>">Removed Vendors</a>
                          </li>
                        </ul>
                    </li>

                    <?php }?>

                </ul>
            </div>
            <!-- #Menu -->

        </aside>
