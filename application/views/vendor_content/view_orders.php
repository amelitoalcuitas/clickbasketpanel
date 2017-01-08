 <div class="container-fluid">
            <div class="block-header">
                <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                ORDER LIST
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>Customer</th>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Store</th>
                                    </tr>
                                </thead>

                                <tbody>

                                  <?php if (isset($orderlist)){
                                      foreach($orderlist as $row)
                                          { ?>
                                          <tr id="order_<?php echo $row->order_id; ?>">
                                          <td><?php echo $row->consumer_fname. ' ' .$row->consumer_lname; ?></td>
                                          <td><?php echo $row->prod_name;?></td>
                                          <td><?php echo $row->order_qty;?></td>
                                          <td>Php <?php echo $row->order_total;?></td>
                                          <td><?php echo $row->order_status;?></td>
                                          <td><?php echo $row->store_name;?></td>
                                      </tr>
                                    <?php }
                                      } else {

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
