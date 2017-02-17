<?php
  if($this->session->flashdata('success') == TRUE){
    echo "<script> swal('Success!', 'Category has been added!', 'success'); </script>";

  }
?>

<div class="container-fluid">
           <div class="block-header">
               <!-- Basic Examples -->
           <div class="row clearfix">
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                   <div class="card">
                       <div class="header">
                           <h2>
                               DELETED CATEGORY LIST
                           </h2>
                       </div>
                       <div class="body">
                           <table id="delcategoryTable" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                               <thead>
                                   <tr>
                                       <th>CATEGORY</th>
                                       <th width="80px"></th>
                                   </tr>
                               </thead>

                               <tbody>

                               <?php if (isset($delcategorylist)){
                                   foreach($delcategorylist as $row)
                                       { ?>
                                   <tr id="category_<?php echo $row->category_id; ?>" name="<?php echo $row->category_name; ?>">
                                       <td>
                                         <p id="catNameParag_<?php echo $row->category_id; ?>"><?php echo $row->category_name; ?></p>
                                       </td>
                                       <td>
                                         <button onclick="restoreCategory(<?php echo $row->category_id; ?>,'<?php echo $row->category_name; ?>')" class="btn btn-danger"><i class="material-icons">undoshopping_basket</i></button>
                                       </td>
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

       <div class="container-fluid">
                  <div class="block-header">
                      <!-- Basic Examples -->
                  <div class="row clearfix">
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <div class="card">
                              <div class="header">
                                  <h2>
                                      DELETED SUBCATEGORY LIST
                                  </h2>
                              </div>
                              <div class="body">
                                  <table id="delsubcategoryTable" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                      <thead>
                                          <tr>
                                              <th>SUB-CATEGORY</th>
                                              <th>CATEGORY</th>
                                              <th width="80px"></th>
                                          </tr>
                                      </thead>

                                      <tbody>

                                      <?php if (isset($delsubcategorylist)){
                                          foreach($delsubcategorylist as $row)
                                              { ?>
                                          <tr id="delSubCat_<?php echo $row->subcategory_id; ?>" name="<?php echo $row->subcategory_name; ?>">
                                              <td>
                                                <p id="SubCatname_<?php echo $row->subcategory_id; ?>"><?php echo $row->subcategory_name; ?></p>
                                              </td>
                                              <td><?php echo $row->category_name; ?></td>
                                              <td>
                                                <button <?= ($row->category_deleted == 'true' ? 'disabled title="Category is also deleted!"' : '') ?> onclick="restoreSubCat(<?php echo $row->subcategory_id; ?>,'<?php echo $row->subcategory_name; ?>')" class="btn btn-danger subcatbtn_<?= $row->category_id; ?>"><i class="material-icons">undoshopping_basket</i></button>
                                              </td>
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
