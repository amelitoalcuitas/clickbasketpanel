 <div class="container-fluid">
            <div class="block-header">
                <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                              REMOVED STORE LIST
                            </h2>
                        </div>
                        <div class="body">
                          <table id="remStoreEditTable" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                              <thead>
                                  <tr>
                                      <th>Name</th>
                                      <th>Address</th>
                                      <th>Store Hours</th>
                                      <th width="20px"></th>
                                  </tr>
                              </thead>

                              <tbody>

                              <?php if (isset($stores)){
                                  foreach($stores as $row){ ?>
                                  <tr id="remStoreTableRow_<?php echo $row->store_id; ?>" name="<?php echo $row->store_name; ?>">
                                      <td><?php echo $row->store_name; ?></td>
                                      <td><?php echo $row->store_address;?></td>
                                      <td>
                                        <?php echo date('h:i A', strtotime($row->time_open)).' - '.date('h:i A', strtotime($row->time_close));?>
                                        <input type="hidden" id="timeOpen_<?php echo $row->store_id; ?>" name="" value="<?php echo $row->time_open?>">
                                        <input type="hidden" id="timeClose_<?php echo $row->store_id; ?>" name="" value="<?php echo $row->time_close?>">
                                      </td>
                                      <td> <button onclick="unblockThisStore(<?php echo $row->store_id; ?>)" class="btn btn-danger"><i class="material-icons">undostore</i></button> </td>

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
