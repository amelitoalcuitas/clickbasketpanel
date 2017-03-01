 <div class="container-fluid">
            <div class="block-header">
                <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                              VENDOR REPORT
                            </h2>
                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="col-md-5">
                                    <select class="form-control" id="changeMonth">
                                        <option> Select Month</option>
                                        <option value="1">January</option>
                                        <option value="2">February</option>
                                        <option value="3">March</option>
                                        <option value="4">April</option>
                                        <option value="5">May</option>
                                        <option value="6">June</option>
                                        <option value="7">July</option>
                                        <option value="8">August</option>
                                        <option value="9">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                </div>
                                <button id="monthbutton" class="btn btn-primary">
                                    CHANGE
                                </button>
                            </div>
                                
                            <table id="adminReport" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ADDRESS</th>
                                        <th>BRANCH</th>
                                        <th>DATE</th>
                                        <th>SALES</th>
                                    </tr>
                                </thead>
                                    
                                <tbody>
                                    <?php if(isset($vendorreport)){ 
                                    foreach($vendorreport as $row){
                                    ?>
                                    <tr>
                                        <td> <?= $row->store_address ?> </td>    
                                        <td> <?= $row->store_branch ?> </td>
                                        <td> <?= $row->order_date ?> </td>
                                        <td> &#8369; <?= $row->dailytotal ?> </td>
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
