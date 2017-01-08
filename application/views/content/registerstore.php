<!--success message-->
  <?php
    if($this->session->flashdata('success') == TRUE){
      echo "<script> swal('Success!', 'The store has been registered!', 'success'); </script>";
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
                               REGISTER NEW STORE
                           </h2>
                       </div>
                       <div class="body">
                         <div class="row clearfix">
                           <div class="col-lg-12">
                             <div class="form-panel">
                                  <?php echo form_open('StoreRegisterController/check_store_credentials'); ?>
                                     <label style="font-weight: bold; font-size:15px;">Store</label><br>
                                     <div class="col-xs-12" >
                                       <div class="form-group">
                                         <div class="form-line">
                                           <input type="text" class="form-control" id="sName" name="sName" placeholder="Store Name" value = "<?php echo set_value('sName'); ?>">                                         </div>
                                         <div style="color:red; font-size:13px; margin:-10px 0 -15px 0;">
                                          <?php echo "<br>".form_error('sName'); ?>
                                        </div>
                                       </div>
                                     </div>
                                     <label style="font-weight: bold; font-size:15px;">Address</label><br>
                                     <div class="col-xs-12" >
                                       <div class="form-group">
                                         <div class="form-line">
                                           <input type="text" class="form-control" id="sAddress" name="sAddress" placeholder="Address" value = "<?php echo set_value('sAddress'); ?>">
                                         </div>
                                         <div style="color:red; font-size:13px; margin:-10px 0 -15px 0;">
                                          <?php echo "<br>".form_error('sAddress'); ?>
                                        </div>
                                       </div>
                                     </div>
                                     </div>
                                       <label style="font-weight: bold; font-size:15px;">Store Hours</label><br>
                                       <div class="col-sm-12">
                                           <div class="form-group">
                                             <div class="form-line">
                                               <input type="text" class="timepicker form-control" id="sHourStart" name="sHourStart" placeholder="Store Opening Time" value = "<?php echo set_value('sHourStart'); ?>">
                                             </div>
                                             <div style="color:red; font-size:13px; margin:-10px 0 -15px 0;">
                                               <?php echo "<br>".form_error('sHourStart'); ?>
                                             </div>
                                           </div>
                                       </div>
                                       <div class="col-sm-12">
                                           <div class="form-group">
                                             <div class="form-line">
                                               <input type="text" class="timepicker form-control" id="sHourClose" name="sHourClose" placeholder="Store Closing Time" value = "<?php echo set_value('sHourClose'); ?>">
                                             </div>
                                             <div style="color:red; font-size:13px; margin:-10px 0 -15px 0;">
                                               <?php echo "<br>".form_error('sHourClose'); ?>
                                             </div>
                                           </div>
                                       </div>
                                       <div class="form-group">
                                           <div class="col-sm-12">
                                               <input type="submit" class="btn btn-primary btn-lg btn-block" name="submit" value="Submit">
                                           </div>
                                       </div>
                                   </form>
                             </div><!-- /form-panel -->
                           </div><!-- /col-lg-12 -->
                         </div><!-- /row -->
                       </div>
                   </div>
               </div>
           </div>
           <!-- #END# Basic Examples -->
     </div>
 </div>