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
                        </div>
                        <div class="body">
                            <table id="orderTable" class="table table-bordered table-striped table-hover">
                              <thead>
                                <tr>
                                  <th>CUSTOMER</th>
                                  <th width="120px">PRODUCTS</th>
                                  <th>DATE</th>
                                  <th width="100px">TOTAL PRICE</th>
                                  <th width="20px">STATUS</th>
                                </tr>
                              </thead>

                              <tbody>

                                <?php if (isset($orderlist)){
                                    foreach($orderlist as $row) { ?>
                                        <tr id="order_<?php echo $row->order_id; ?>">
                                        <td><?php echo $row->consumer_fname. ' ' .$row->consumer_lname; ?></td>
                                        <td><button type="button" name="vieworders" onclick="viewOrders(<?php echo $row->order_id ?>);" class="btn btn-success"><i class="material-icons">list</i> PRODUCT LIST</button></td>
                                        <td><?php echo $row->order_date; ?></td>
                                        <td>Php <?php echo $row->grandtotal;?></td>
                                        <?php if($row->order_status == 'pending'){
                                          $buttcolor = 'warning';
                                        }else if($row->order_status == 'processing'){
                                          $buttcolor = 'primary';
                                        }else if($row->order_status == 'declined'){
                                          $buttcolor = 'danger';      
                                        } ?>
                                        <td style="color:red;">
                                          <div class="btn-group">
                                              <button type="button" id="butt_<?php echo $row->order_id ?>" class="btn btn-<?php echo $buttcolor; ?> dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                  <?php echo strtoupper($row->order_status); ?> <span class="caret"></span>
                                              </button>
                                              <ul class="dropdown-menu">
                                                  <li><a href="javascript:void(0);" onclick="changeStatus(<?php echo $row->order_id; ?>,'<?php echo $row->order_status; ?>','pending')">PENDING</a></li>
                                                  <li><a href="javascript:void(0);" onclick="changeStatus(<?php echo $row->order_id; ?>,'<?php echo $row->order_status; ?>','processing')">PROCESSING</a></li>
                                                  <li><a href="javascript:void(0);" onclick="changeStatus(<?php echo $row->order_id; ?>,'<?php echo $row->order_status; ?>','completed')">COMPLETED</a></li>
                                                  <li><a href="javascript:void(0);" onclick="changeStatus(<?php echo $row->order_id; ?>,'<?php echo $row->order_status; ?>','declined')">DECLINED</a></li>
                                              </ul>
                                          </div>
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
