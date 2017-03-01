 <div class="container-fluid">
            <div class="block-header">
                <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                              ADMIN REPORT
                            </h2>
                        </div>
                        <div class="body">

                            
                            <table id="adminReport" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>STORE NAME</th>
                                        <th>VENDOR</th>
                                        <th>E-MAIL</th>
                                    </tr>
                                </thead>

                                <tbody>
                               
                                    <?php if(isset($adminreport)){ 
                                    foreach($adminreport as $row){
                                    ?>
                                    <tr>
                                        <td> <?= $row->store_name ?> </td>    
                                        <td> <?= $row->vendor_fname. ' ' . $row->vendor_lname ?> </td>
                                        <td> <?= $row->vendor_email ?> </td>
                                    <?php } } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Examples -->

            </div>
        </div>
