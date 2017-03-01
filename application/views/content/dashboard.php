
<div class="container-fluid">


<?php 
    $store = 0;
    $vendor = 0;
    if(isset($stores)){
        foreach($stores as $row){
            ++$store;
            $num1 = $store;
        }
    }else{
        $num1 = 0;
    }

    if(isset($vendorlist)){
        foreach($vendorlist as $row){
            ++$vendor;
            $num2 = $vendor;
        }
    }else{
        $num2 = 0;
    }

    $storenum = $num1;
    $vendornum = $num2;
?>

    <div class="row clearfix">

        <a href="<?= base_url('admin/viewstores'); ?>">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box hover-zoom-effect">
                    <div class="icon bg-blue">
                        <i class="material-icons">store</i>
                    </div>
                    <div class="content">
                        <div class="text">STORE/s</div>
                        <div class="number"><?= $storenum; ?></div>
                    </div>
                </div>

            </div>
        </a>

        <a href="<?= base_url('admin/viewstores'); ?>">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box hover-zoom-effect">
                    <div class="icon bg-green">
                        <i class="material-icons">people</i>
                    </div>
                    <div class="content">
                        <div class="text">VENDOR/s</div>
                        <div class="number"><?= $vendornum; ?></div>
                    </div>
                </div>

            </div>
        </a>

        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <div class="icon bg-indigo">
                    <i class="material-icons">person</i>
                </div>
                <div class="content">
                    <div class="text">CONSUMER/s</div>
                    <div class="number"><?= $consumernum->consumernum ?></div>
                </div>
            </div>

        </div>

    </div>
    
    <div class="row clearfix">

        <a href="<?= base_url('admin/addstore'); ?>">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box-3 bg-blue hover-zoom-effect">
                <div class="icon">
                    <i class="material-icons">add</i>
                </div>
                <div class="content">
                    <div class="text">MARKET</div>
                    <div class="number">Add Store</div>
                </div>
            </div>
        </div>
        </a>

        <a href="<?= base_url('admin/register'); ?>">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box-3 bg-green hover-zoom-effect">
                <div class="icon">
                    <i class="material-icons">add</i>
                </div>
                <div class="content">
                    <div class="text">VENDOR</div>
                    <div class="number">Add Vendor</div>
                </div>
            </div>
        </div>
        </a>

    </div>  

</div>
