 <div class="container-fluid">
            <div class="block-header">
                <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                ORDER HISTORY
                            </h2>
                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                  <tr>
                                    <th>CUSTOMER</th>
                                    <th width="120px">PRODUCTS</th>
                                    <th>STORE</th>
                                    <th>REASON</th>
                                    <th width="50px">STATUS</th>
                                  </tr>
                                </thead>

                                <tbody>

                                  <?php if (isset($deliveredorders)){
                                      foreach($deliveredorders as $row) { ?>
                                          <tr id="order_<?php echo $row->order_id; ?>">
                                          <td><?php echo $row->consumer_fname. ' ' .$row->consumer_lname; ?></td>
                                          <td><button type="button" name="vieworders" onclick="viewOrders(<?php echo $row->order_id ?>);" class="btn btn-success"><i class="material-icons">list</i> PRODUCT LIST</button></td>
                                          <td><?php echo $row->store_name;?></td>
                                          <td><?php echo $row->decline_reason;?></td>
                                          <td <?= $row->order_status == 'completed' ? 'style="color:#00a808;"' : 'style="color:#FB483A;"'; ?>>
                                            <?php echo ucfirst($row->order_status);?>
                                          </td>
                                      </tr>
                                    <?php }
                                      } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Examples -->

            </div>
        </div>
