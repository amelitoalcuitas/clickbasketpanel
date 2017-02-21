 <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="<?php echo base_url(); ?>">CLICKBASKET</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Notifications -->
                    <!-- <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">notifications</i>
                            <span class="label-count" id="notif_count"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">NOTIFICATIONS</li>
                            <li class="body">
                                <ul class="menu" id="notif_li">

                                </ul>
                            </li>
                            <li class="footer">
                                <a href="<?php echo base_url('vendor/viewOrders'); ?>">View All Orders</a>
                            </li>
                        </ul>
                    </li> -->
                    <!-- #END# Notifications -->
                    <li class="pull-right">
                        <a href="javascript:void(0);" class="js-right-sidebar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <?php echo $this->session->userdata('name'); ?>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="<?php echo site_url('vendor/profile');?>"><i class="material-icons">person</i>Profile</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="<?php echo site_url('vendorpagescontroller/logout');?>"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
