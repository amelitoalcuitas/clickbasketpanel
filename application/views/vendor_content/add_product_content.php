<!--success message-->
<?php
  if($this->session->flashdata('success') == TRUE){
    echo "<script> swal('Success!','Product/s has been added successfully','success'); </script>";
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
                             REGISTER NEW PRODUCT
                         </h2>
                     </div>
                     <div class="body">
                       <div class="row clearfix">
                         <div class="col-lg-12">
                           <table class="table">
                                <thead>
                                    <tr>
                                        <th>PRODUCT NAME</th>
                                        <th>PRICE</th>
                                        <th>QUANTITY</th>
                                        <th width="170px">SUB-CATEGORY</th>
                                        <th width="15px"> DELETE </th>
                                    </tr>
                                </thead>
                                <tbody id="addProductTable">

                                </tbody>
                                <tfoot>
                                  <tr>
                                </tfoot>
                            </table>
                            <div id="addProdError" style="color:red; font-size:13px; margin:10px 0 -15px 10px;">
                             <br>
                            </div>
                            <input type="submit" class="btn btn-primary btn-lg pull-right" id="submitProduct" name="submitProduct" value="Submit">
                            <button type="button" class="btn btn-success pull-right" id="addButton" name="addButton"><i class="material-icons">add</i></button>
                         </div>
                       </div>
                     </div>
                  </div>
                </div>

            <div id="tableData" hidden>
                  <div id="col2">
                    <div class="form-group" style="margin-bottom:0px;">
                      <div class="form-line">
                        <input type="text" class="form-control" id="pName" name="pName[]" placeholder="Enter Product name" value="<?php echo set_value('pName[]'); ?>" required>
                      </div>
                    </div>
                    <div id="prodNameError" style="color:red; font-size:13px; margin:2px 0 -5px 0;">
                    <br>
                    </div>
                  </div>
                  <div id="col3">
                    <div class="form-group" style="margin-bottom:0px;">
                      <div class="form-line">
                        <input type="number" class="form-control" id="pPrice" min="0" name="pPrice[]" placeholder="Price" value="<?php echo set_value('pPrice[]'); ?>" required>
                      </div>
                    </div>
                  </div>
                  <div id="col4">
                    <div class="form-group" style="margin-bottom:0px;">
                      <div class="form-line">
                        <input type="number" class="form-control" id="pQuantity" min="0" name="pQuantity[]" placeholder="Quantity" value="<?php echo set_value('pQuantity[]'); ?>" required>
                      </div>
                    </div>
                  </div>
            </div>

             <br>

           </div>
           <!-- #END# Basic Examples -->
     </div>
 </div>
