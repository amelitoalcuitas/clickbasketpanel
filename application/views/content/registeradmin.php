<!--success message-->
  <?php
    if($this->session->flashdata('success') == TRUE){
      echo "<script> swal('Success!', 'The admin has been registered!', 'success'); </script>";
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
                               REGISTER NEW ADMIN
                           </h2>
                       </div>
                       <div class="body">
                         <div class="row clearfix">
                           <div class="col-lg-12">
                             <div class="form-panel">
                                  <?php echo form_open('RegistrationController/check_user_credentials'); ?>


                                        <!--select-->
                                     <label style="font-weight: bold; font-size:15px;">Store</label><br>
                                     <div class="col-sm-12">
                                       <div class="form-group" style="margin-bottom:0px;">
                                         <div class="form-line">
                                           <select id="store_selected" class="form-control show-tick selectsearch" data-live-search="true" name='store_selected' required>
                                             <option value="">-- Please select --</option>
                                             <?php foreach($storelist as $row) { ?>
                                             <option value="<?php echo $row->store_id;?>"> <?php echo $row->store_name; ?></option>
                                             <?php } ?>
                                           </select>
                                         </div>
                                       </div>
                                     </div>
                                  <!--select-->

                                     <label style="font-weight: bold; font-size:15px;">Name</label><br>
                                     <div class="col-xs-6" >
                                       <div class="form-group">
                                         <div class="form-line">
                                           <input type="text" class="form-control" id="fName" name="fName" placeholder="First Name" value="<?php echo set_value('fName'); ?>">
                                         </div>
                                         <div style="color:red; font-size:13px; margin:-10px 0 -15px 0;">
                                          <?php echo "<br>".form_error('fName'); ?>
                                        </div>
                                       </div>
                                     </div>
                                     <div class="col-xs-6" >
                                       <div class="form-group">
                                         <div class="form-line">
                                           <input type="text" class="form-control" id="lName" name="lName" placeholder="Last Name" value="<?php echo set_value('lName'); ?>">
                                         </div>
                                         <div style="color:red; font-size:13px; margin:-10px 0 -15px 0;">
                                          <?php echo "<br>".form_error('lName'); ?>
                                        </div>
                                       </div>
                                     </div>

                                       <label style="font-weight: bold; font-size:15px;">Username</label><br>
                                       <div class="col-sm-12">
                                           <div class="form-group">
                                             <div class="form-line">
                                               <input type="text" class="form-control" id="uName" name="uName" placeholder="Username" value="<?php echo set_value('uName'); ?>">
                                             </div>
                                             <div style="color:red; font-size:13px; margin:-10px 0 -15px 0;">
                                               <?php echo "<br>".form_error('uName'); ?>
                                             </div>
                                           </div>
                                       </div>
                                       <label style="font-weight: bold; font-size:15px;">Email</label><br>
                                       <div class="col-sm-12">
                                         <div class="form-group">
                                             <div class="form-line">
                                               <input type="email" class="form-control" id="eMail" name="eMail" placeholder="Email" value="<?php echo set_value('eMail'); ?>">
                                             </div>
                                             <div style="color:red; font-size:13px; margin:-10px 0 -15px 0;">
                                               <?php echo "<br>".form_error('eMail'); ?>
                                             </div>
                                         </div>
                                       </div>
                                       <label style="font-weight: bold; font-size:15px;">Password</label><br>
                                       <div class="col-sm-12">
                                           <div class="form-group">
                                             <div class="form-line">
                                               <input type="password" class="form-control" placeholder="Password" id="pass" name="pass">
                                             </div>
                                             <div style="color:red; font-size:13px; margin:-10px 0 -15px 0;">
                                               <?php echo "<br>".form_error('pass'); ?>
                                             </div>
                                           </div>
                                       </div>
                                       <div class="col-sm-12">
                                           <div class="form-group">
                                             <div class="form-line">
                                               <input type="password" class="form-control" id="cPass" placeholder="Confirm Password" name="cPass">
                                             </div>
                                             <div style="color:red; font-size:13px; margin:-10px 0 -15px 0; padding-bottom:10px;">
                                               <?php echo "<br>".form_error('cPass'); ?>
                                             </div>
                                           </div>
                                       </div>
                                       <div class="form-group">
                                           <div class="col-sm-12">
                                               <input type="submit" class="btn btn-primary btn-lg btn-block" name="submit" value="Submit">
                                           </div>
                                       </div>
                                   </form>
                                   </div>
                                   </div>
                           </div><!-- /form-panel -->
                       </div><!-- /col-lg-12 -->
                     </div><!-- /row -->
               </div>
         </div>
 </div>
           <!-- #END# Basic Examples -->
