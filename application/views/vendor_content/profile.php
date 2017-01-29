<div class="container-fluid">
           <div class="block-header">
               <!-- Basic Examples -->
           <div class="row clearfix">
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                   <div class="card">
                       <div class="header">
                         <h2>
                           Hello <?= $vendordata->vendor_fname. ' ' .$vendordata->vendor_lname.'!';?>
                         </h2>
                       </div>
                       <div class="body">

                         <div class="row">
                           <div id="text_0" style="margin-bottom:20px; margin-left:12px; width:150px; height:200px; border: 1px solid gray; position: relative;">
                              <div id="anchor-div">
                               <img id="profpic" style="display:block; position:absolute; margin:auto; max-width:148px; height:100%; margin:0;" src="<?php echo base_url('assets/images/prof_pic/'.$vendordata->vendor_image);?>" alt="User" />

                                <!--Edit Hover-->
                                <a href="javascript:void(0)" id="edit_0" onclick="editThis(0)">
                                  <div id="anchor-element" class="pull-bottom col-md-2" style="width:100%; background-color:black; opacity:0.5; margin-top:100%; padding:10px;">
                                    <p class="control-label pull-left"><span class="glyphicon glyphicon-camera" style="color:white"></span></p>
                                 </div>
                               </a>
                             </div>
                           </div>
                         </div>

                         <div id="input_0" class="row" style="display:none;">
                           <div id="anchor-div">
                           <div id="editImage" class="imageview" style="margin-bottom:10px;border:1px solid #999; margin-left:12px;">
               								<div class="trick"></div>
                             	<img id="uploadPreview"/>
                           </div>
                         </div>
                         <?php echo form_open_multipart('upload/do_upload','id="fileForm"');?>
                          <div class="col-sm-4">
                            <input id="file" type="file" name="userfile" style="font-size:17px;margin-bottom:10px; margin-left: -1px;" onchange="PreviewImage();" accept="image/*" >
                            <div id="error_0"  style="color:red;"><br></div>
                          </div>

                          <div class="col-sm-5">
                          <!--DONE BUTTON-->
                          <button style="display:none; margin-left:12px;" type="submit" class="btn btn-primary pull-left" id="donebutt_0"><span class="glyphicon glyphicon-ok"></span></button>
                          <!-- CANCEL BUTTON -->
                          <button style="display:none;" type="button" class="btn btn-default pull-left" id="cancelbutt_0" onclick="cancelEdit(0);"><span class="glyphicon glyphicon-remove"></span></button>
                          </div>
                          </form>

                        </div>
                        <!--FORM FIRSTNAME-->
                        <div id="anchor-div" class="row">
                          <div class="form-group">
                              <label for="inputEmail3" class="col-sm-2 control-label">Firstname:</label>

                                  <!--Paragraph-->
                                  <div class="col-sm-8" id="text_1">
                                      <p class="control-label pull-left"><?= $vendordata->vendor_fname;?></p>
                                  </div>

                                  <!--Input Text-->
                                  <div class="col-sm-8" id="input_1" style="display:none;">
                                    <div class="form-line">
                                      <input type="text" name="firstname" autofocus class="form-control" value="<?= $vendordata->vendor_fname;?>" required>
                                    </div>
                                  </div>

                                  <!--Edit Hover-->
                                  <div class="col-sm-2">
                                    <a href="javascript:void(0)" id="edit_1" onclick="editThis(1);"><p id="anchor-element" class="control-label pull-right">edit</p></a>

                                    <!--BUTTONS-->

                                    <!--DONE BUTTON-->
                                    <button style="display:none;" type="button" class="btn btn-primary pull-right" id="donebutt_1" onclick="doneEdit(1);"><span class="glyphicon glyphicon-ok"></span></button>
                                    <!--CANCEL BUTTON-->
                                    <button style="display:none;" type="button" class="btn btn-default pull-right" id="cancelbutt_1" onclick="cancelEdit(1);"><span class="glyphicon glyphicon-remove"></span></button>
                                   </div>
                          </div>
                        </div>
                        <!--FORM LASTNAME-->
                        <div id="anchor-div" class="row">
                          <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Lastname:</label>

                                <!--Paragraph-->
                                <div class="col-sm-8" id="text_2">
                                    <p class="control-label pull-left"><?= $vendordata->vendor_lname;?></p>
                                </div>

                                    <!--Input Text-->
                                    <div class="col-sm-8" id="input_2"  style="display:none;">
                                      <div class="form-line">
                                          <input type="text" name="lastname" autofocus class="form-control" value="<?= $vendordata->vendor_lname;?>" required>
                                          <div id="error_2"  style="color:red;"></div>
                                      </div>
                                    </div>

                                    <!--Edit Hover-->
                                    <div class="col-sm-2">
                                    <a href="javascript:void(0)" id = "edit_2" onclick="editThis(2);"><p id="anchor-element" class="control-label pull-right">Edit</p></a>

                                   <!--BUTTONS-->

                                   <!--DONE BUTTON-->
                                   <button style="display:none;" type="button" class="btn btn-primary pull-right" id="donebutt_2" onclick="doneEdit(2);"><span class="glyphicon glyphicon-ok"></span></button>
                                   <!--CANCEL BUTTON-->
                                   <button style="display:none;" type="button" class="btn btn-default pull-right" id="cancelbutt_2" onclick="cancelEdit(2);"><span class="glyphicon glyphicon-remove"></span></button>
                                  </div>
                          </div>
                        </div>
                        <!--FORM EMAIL-->
                        <div id="anchor-div" class="row">
                          <div class="form-group">
                               <label for="inputEmail3" class="col-sm-2 control-label">Email:</label>

                                   <!--Paragraph-->
                                   <div class="col-sm-8" id="text_3">
                                       <p class="control-label pull-left"><?= $vendordata->vendor_email;?></p>
                                   </div>

                                   <!--Input Text-->
                                   <div class="col-sm-8"  id="input_3" style="display:none;" >
                                     <div class="form-line">
                                       <input type="text" name="email" autofocus class="form-control" value="<?= $vendordata->vendor_email;?>" required>
                                       <div id="error_3"  style="color:red;"></div>
                                     </div>
                                   </div>

                                   <!--Edit Hover-->
                                   <div class="col-sm-2">
                                   <a href="javascript:void(0)" id = "edit_3" onclick="editThis(3);"><p id="anchor-element" class="control-label pull-right">Edit</p></a>

                                    <!--DONE BUTTON-->
                                    <button style="display:none;" type="button" class="btn btn-primary pull-right" id="donebutt_3" onclick="doneEdit(3);"><span class="glyphicon glyphicon-ok"></span></button>
                                    <!--CANCEL BUTTON-->
                                    <button style="display:none;" type="button" class="btn btn-default pull-right" id="cancelbutt_3" onclick="cancelEdit(3);"><span class="glyphicon glyphicon-remove"></span></button>
                                   </div>
                          </div>
                        </div>

                        <!--FORM USERNAME-->
                        <div id="anchor-div" class="row">
                          <div class="form-group">
                               <label for="inputEmail3" class="col-sm-2 control-label">Username:</label>

                                   <!--Paragraph-->
                                   <div class="col-sm-8" id="text_4">
                                       <p class="control-label pull-left"><?= $vendordata->vendor_username;?></p>
                                   </div>

                                   <!--Input Text-->
                                   <div class="col-sm-8" id="input_4"  style="display:none;">
                                   <div class="form-line" style="margin-top:0px;">
                                       <input type="text" name="username" autofocus class="form-control" value="<?= $vendordata->vendor_username;?>" required>
                                       <div id="error_4"  style="color:red;"></div>
                                   </div>
                                  </div>

                                   <!--Edit Hover-->
                                   <div class="col-sm-2">
                                   <a href="javascript:void(0)" id = "edit_4" onclick="editThis(4);"><p id="anchor-element" class="control-label pull-right">Edit</p></a>

                                   <!--BUTTONS-->
                                   <!--DONE BUTTON-->
                                   <button style="display:none;" type="button" class="btn btn-primary pull-right" id="donebutt_4" onclick="doneEdit(4);"><span class="glyphicon glyphicon-ok"></span></button>
                                   <!--CANCEL BUTTON-->
                                   <button style="display:none;" type="button" class="btn btn-default pull-right" id="cancelbutt_4" onclick="cancelEdit(4);"><span class="glyphicon glyphicon-remove"></span></button>
                                   </div>
                          </div>
                        </div>
                        <div id="anchor-div" class="row">
                          <div class="form-group">
                               <label for="inputEmail3" class="col-sm-2 control-label">Password:</label>

                                   <!--Paragraph-->
                                   <div id="text_5" class="col-sm-8">
                                       <p class="control-label pull-left">***********</p>
                                   </div>

                                     <!--Input Text-->
                                  <div class="col-sm-8" id="input_5" style="display:none;">
                                     <div class="form-line">
                                         <input type="password" name="password" autofocus class="form-control" placeholder="Password" required>
                                         <div id="error_5"  style="color:red;"></div>
                                     </div>
                                   </div>

                                   <!--Edit Hover-->
                                   <div class="col-sm-2">
                                   <a href="javascript:void(0)" id = "edit_5" onclick="editThis(5);"><p id="anchor-element" class="control-label pull-right">Edit</p></a>

                                   <!--BUTTONS-->
                                   <!--DONE BUTTON-->
                                   <button style="display:none;" type="button" class="btn btn-primary pull-right" id="donebutt_5" onclick="doneEdit(5);"><span class="glyphicon glyphicon-ok"></span></button>
                                   <!--CANCEL BUTTON-->
                                   <button style="display:none;" type="button" class="btn btn-default pull-right" id="cancelbutt_5" onclick="cancelEdit(5);"><span class="glyphicon glyphicon-remove"></span></button>
                                   </div>
                           </div>
                        </div>
                      </div>
                     </div>
                   </div>
               </div>
           </div>
           <!-- #END# Basic Examples -->

           </div>
       </div>
