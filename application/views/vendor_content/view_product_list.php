 <div class="container-fluid">
            <div class="block-header">
                <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                PRODUCT LIST
                            </h2>
                        </div>
                        <div class="body">
                            <table id="productTable" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>PRODUCT NAME</th>
                                        <th>CATEGORY</th>
                                        <th>SUB-CATEGORY</th>
                                        <th>QUANTITY</th>
                                        <th>PRICE</th>
                                        <th>EDIT</th>
                                    </tr>
                                </thead>

                                <tbody>
                                  <?php if (isset($productlist)){
                                      foreach($productlist as $row)
                                          { ?>
                                          <tr id="product_<?php echo $row->prod_id; ?>" name="<?php echo $row->prod_name; ?>">
                                          <td><?php echo $row->prod_name; ?></td>
                                          <td id="selectedcat_<?php echo $row->prod_id; ?>" value="<?php echo $row->category_id;?>"><?php echo $row->category_name;?></td>
                                          <td id="selectedsubcat_<?php echo $row->prod_id; ?>" value="<?php echo $row->subcategory_id;?>"><?php echo $row->subcategory_name;?></td>
                                          <td><?php echo $row->inventory_stock;?></td>
                                          <td>Php <?php echo $row->storeprod_price;?></td>
                                          <td>
                                              <button onclick="editThisProductModal(<?php echo $row->prod_id.','.$row->storeprod_id.','.$row->category_id;  ?>)" name="<?php echo $row->prod_id; ?>" class="btn btn-warning"><i class="material-icons">edit</i></button>
                                              <button onclick="deleteThis(<?php echo $row->prod_id; ?>)" name="<?php echo $row->prod_id; ?>" class="btn btn-danger"><i class="material-icons">delete</i></button>
                                          </td>
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
