<!--success message-->
  <?php
    if($this->session->flashdata('success') == TRUE){
      echo "<script> swal('Success!', 'New admin has been registered!', 'success'); </script>";
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
                               Register New Store
                           </h2>
                       </div>
                       <div class="body">
                         <div class="row clearfix">
                           <div class="col-lg-12">
                             <div class="form-panel">


                                  <?php echo form_open('addcategorycontroller/check_category_name'); ?>

                                     <label style="font-weight: bold; font-size:15px;">Category Name</label><br>
                                     <div class="col-xs-12" >
                                       <div class="form-group">
                                         <div class="form-line">
                                           <input type="text" class="form-control" id="cName" name="cName" placeholder="Category Name" value = "<?php echo set_value('cName'); ?>" autofocus>
                                         </div>
                                         <div style="color:red; font-size:13px; margin:-10px 0 -15px 0;">
                                          <?php echo "<br>".form_error('cName'); ?>
                                        </div>
                                       </div>
                                     </div>

                                       <div class="form-group">
                                           <div class="col-sm-12">
                                               <input type="button" class="btn btn-primary btn-lg btn-block" name="submit" value="Submit">
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
