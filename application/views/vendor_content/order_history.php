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
                                    <th>Customer</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Store</th>
                                    <th>Status</th>
                                  </tr>
                                </thead>

                                <tbody>

                                  <?php if (isset($deliveredorders)){
                                      foreach($deliveredorders as $row) { ?>
                                          <tr id="order_<?php echo $row->order_id; ?>">
                                          <td><?php echo $row->consumer_fname. ' ' .$row->consumer_lname; ?></td>
                                          <td><?php echo $row->prod_name;?></td>
                                          <td><?php echo $row->order_qty;?></td>
                                          <td>Php <?php echo $row->order_total;?></td>
                                          <td><?php echo $row->store_name;?></td>
                                          <td style="color:#00a808;">
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
