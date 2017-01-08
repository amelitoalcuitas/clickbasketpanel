 <div class="container-fluid">
            <div class="block-header">
                <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                              REMOVED VENDOR LIST
                            </h2>
                        </div>
                        <div class="body">
                            <table id="vendorListTable" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>FIRST NAME</th>
                                        <th>LAST NAME</th>
                                        <th>USERNAME</th>
                                        <th>E-MAIL</th>
                                        <th>STORE</th>
                                        <th width="20px"></th>
                                    </tr>
                                </thead>

                                <tbody>

                                <?php if (isset($vendorlist)){
                                    foreach($vendorlist as $row){ ?>
                                    <tr id="vendor_<?php echo $row->vendor_id; ?>" name="<?php echo $row->vendor_fname.' '.$row->vendor_lname; ?>">
                                        <td><?php echo $row->vendor_fname; ?></td>
                                        <td><?php echo $row->vendor_lname;?></td>
                                        <td><?php echo $row->vendor_username;?></td>
                                        <td><?php echo $row->vendor_email;?></td>
                                        <td><?php echo $row->store_name;?></td>
                                        <td> <button onclick="unblockThisVendor(<?php echo $row->vendor_id; ?>)" class="btn btn-danger"><i class="material-icons">undoperson</i></button> </td>

                                    </tr>
                                  <?php }
                                    }
                                  ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Examples -->

            </div>
        </div>
