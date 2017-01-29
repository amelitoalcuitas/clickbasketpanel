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
                               CATEGORY LIST
                           </h2>
                           <div style="float:right; margin-top:-28px;">
                             <button data-target="#addCategory" data-toggle="modal" name="" class="btn btn-primary"><i class="material-icons">add</i></button>
                           </div>
                       </div>
                       <div class="body">
                           <table id="categoryTable" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                               <thead>
                                   <tr>
                                       <th>CATEGORY</th>
                                       <th>SUB-CATEGORIES</th>
                                       <th width="80px">EDIT</th>
                                   </tr>
                               </thead>

                               <tbody>

                               <?php if (isset($categorylist)){
                                   foreach($categorylist as $row)
                                       { ?>
                                   <tr id="category_<?php echo $row->category_id; ?>" name="<?php echo $row->category_name; ?>">
                                       <td>
                                         <p id="catNameParag_<?php echo $row->category_id; ?>"><?php echo $row->category_name; ?></p>
                                         <div class="form-group" id="catNameDiv_<?php echo $row->category_id; ?>" style="margin-bottom:0px; display: none;">
                                           <div class="form-line">
                                             <input type="text" name="catName" id="catNameInput_<?php echo $row->category_id; ?>" style="padding-left:5px;" class="form-control" value="<?php echo $row->category_name; ?>">
                                           </div>
                                           <div style="color:red; font-size:13px; margin:5px 0 0px 0;" id="errorCatEdit_<?php echo $row->category_id; ?>"><br></div>
                                         </div>
                                       </td>
                                       <td><button onclick="viewSubCatModal(<?php echo $row->category_id; ?>)" name="<?php echo $row->category_id; ?>" class="btn btn-success"><i class="material-icons">list</i>VIEW SUB-CATEGORY</button></td>
                                       <td>
                                         <button id="doneButt_<?php echo $row->category_id; ?>" onclick="catDoneButt(<?php echo $row->category_id; ?>)" name="<?php echo $row->category_id; ?>" style="display: none;" class="btn btn-primary"><i class="material-icons">done</i></button>
                                         <button id="cancelButt_<?php echo $row->category_id; ?>" onclick="catCancelButt(<?php echo $row->category_id; ?>)" name="<?php echo $row->category_id; ?>" style="display: none;" class="btn btn-danger"><i class="material-icons">close</i></button>
                                         <button id="editButt_<?php echo $row->category_id; ?>" onclick="editThisCat(<?php echo $row->category_id; ?>)" name="<?php echo $row->category_id; ?>" class="btn btn-warning"><i class="material-icons">edit</i></button>
                                         <button id="deleteButt_<?php echo $row->category_id; ?>" onclick="deleteThisCat(<?php echo $row->category_id; ?>)" name="<?php echo $row->category_id; ?>" class="btn btn-danger"><i class="material-icons">delete</i></button>
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
