<!-- Product Edit -->
<div id="editProductModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Product</h4>
      </div>
      <div class="modal-body">
        <label style="font-weight: bold; font-size:15px;">Product Name</label>
        <div class="form-group" style="margin-bottom:0px;">
          <div class="form-line">
            <input type="text" id="mProductName" class="form-control" value="" required>
          </div>
          <br>
          <div style="color:red; font-size:13px; margin:-15px 0 -20px 0;" id="errorProdEdit"><br></div>
        </div>
        <br>
        <label style="font-weight: bold; font-size:15px;">Category</label>
        <div class="form-group" style="margin-bottom:0px;">
          <div class="form-line">
            <select id="mCategory" class="form-control show-tick selectsearch" data-live-search="true" name='' required>
              <option value="">-- Please select --</option>
              <?php foreach($categorylist as $row) { ?>
              <option value="<?php echo $row->category_id;?>"> <?php echo $row->category_name; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <br>
        <label style="font-weight: bold; font-size:15px;">Sub-Category</label>
        <div class="form-group" style="margin-bottom:0px;">
          <div class="form-line">
            <select id="mSubCategory" class="form-control show-tick selectsearch" data-live-search="true" name='' required>
              <!-- Options will be provided by AJAX -->
            </select>
          </div>
        </div>
        <br>
        <label style="font-weight: bold; font-size:15px;">Quantity</label>
        <div class="form-group" style="margin-bottom:0px;">
          <div class="form-line">
            <input id="mQuantity" type="number" min="0" class="form-control" value="" required>
          </div>
        </div>
        <br>
        <label style="font-weight: bold; font-size:15px;">Price</label>
        <div class="input-group" style="margin-bottom:0px;">
            <span class="input-group-addon">
                Php
            </span>
          <div class="form-line">
            <input type="number" id="mPrice" class="form-control" value="" required>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <input type="button" id="modalSubmit" class="btn btn-primary" value="Submit">
      </div>

    </div>
        <!-- Modal content-->
  </div>
</div>
<!-- Product Edit -->


<!-- FORGOT PASSWORD -->
<div id="forgotPass" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->

    <div class="modal-content" style="margin:auto;width:80%">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" align="center">Forgot Password</h4>
      </div>
      <div class="modal-body">
        <div class="body">
          <div style="display:none; margin: 0 auto;" class="loader"> </div>
          <div id="forgotpassbody">
            <div class="msg" style="text-align:center;">
                Enter the email address that you used to register. We'll send you an email with your username and a
                link to reset your password.
            </div>
            <br>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">email</i>
                </span>
                <div class="form-line">
                    <input type="email" class="form-control" name="resetpassemail" id="resetpassemail" placeholder="Enter your Email" required autofocus>
                </div>

                <div style="color:red; font-size:13px; margin:0px 0 0px 0;" id="errorForgotPass"><br></div>
            </div>
            <button class="btn btn-block btn-lg bg-pink waves-effect" id="resetPass" type="submit">RESET MY PASSWORD</button>
          </div>
        </div>
      </div>
      <div class="modal-footer">

      </div>
    </div>

  </div>
</div>
<!-- FORGOT PASSWORD -->

<!-- Add Category -->
<div id="addCategory" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New Category</h4>
      </div>
      <div class="modal-body">
        <label style="font-weight: bold; font-size:15px;">Category</label>
        <div class="form-group" style="margin-bottom:0px;">
          <div class="form-line">
            <input type="text" class="form-control" id="cName" name="cName" placeholder="Category Name" value = "<?php echo set_value('cName'); ?>">
          </div>
          <div style="color:red; font-size:13px; margin:5px 0 -20px 0;" id="errorCat">
            <br>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-primary btn-lg btn-block" id="catSubmit" name="submit" value="Submit">
      </div>
    </div>
        <!-- Modal content-->
  </div>
</div>
<!-- Add Category End -->

<!-- View Sub-Category -->
<div id="viewSubCat" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="subcatmodalheader"></h4>
        <div style="float:right; margin-top:-28px;">
          <button data-target="#addSubCategory" data-toggle="modal" data-dismiss="modal" class="btn btn-primary"><i class="material-icons">add</i></button>
        </div>
      </div>
      <div class="modal-body">
        <table id="subCategoryTable" class="table table-bordered table-striped table-hover js-basic-example dataTable">
            <thead>
                <tr>
                    <th>SUB-CATEGORY</th>
                    <th width="80px">EDIT</th>
                </tr>
            </thead>
            <tbody id="subcatbody">

            </tbody>
        </table>
      </div>
      <div class="modal-footer">

      </div>
    </div>
        <!-- Modal content-->
  </div>
</div>
<!-- View Sub-Category End -->

<!-- Add Sub-Category -->
<div id="addSubCategory" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add New Sub-category</h4>
      </div>
      <div class="modal-body">
        <label style="font-weight: bold; font-size:15px;">Sub-category</label>
        <div class="form-group" style="margin-bottom:0px;">
          <div class="form-line">
            <input type="text" class="form-control" id="subcatName" name="subcatName" placeholder="Sub-Category Name" value = "<?php echo set_value('subcatName'); ?>">
          </div>
          <div style="color:red; font-size:13px; margin:5px 0 -20px 0;" id="errorsubCat">
            <br>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-primary btn-lg btn-block" id="subcatSubmit" name="subcatSubmit" value="Submit">
      </div>
    </div>
        <!-- Modal content-->
  </div>
</div>
<!-- Add Sub-Category End -->

<!-- Store Edit -->
<div id="editStoreModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="modalStoreHeader"></h4>
      </div>
      <div class="modal-body">
        <label style="font-weight: bold; font-size:15px;">Store Name</label>
        <div class="form-group" style="margin-bottom:0px;">
          <div class="form-line">
            <input type="text" id="mStoreName" name="mStoreName" class="form-control" value="" required>
          </div>
          <br>
          <div style="color:red; font-size:13px; margin:-15px 0 -20px 0;" id="errorStoreEdit"><br></div>
        </div>
        <br>
        <label style="font-weight: bold; font-size:15px;">Adress</label>
        <div class="form-group" style="margin-bottom:0px;">
          <div class="form-line">
            <input type="text" id="mAddress" class="form-control" value="" required>
          </div>
        </div>
        <br>
        <label style="font-weight: bold; font-size:15px;">Time Open</label>
        <div class="form-group" style="margin-bottom:0px;">
          <div class="form-line">
            <input type="time" id="mTimeOpen" class="form-control" value="" required>
          </div>
        </div>
        <br>
        <label style="font-weight: bold; font-size:15px;">Time Close</label>
        <div class="form-group" style="margin-bottom:0px;">
          <div class="form-line">
            <input type="time" id="mTimeClose" class="form-control" value="" required>
          </div>
        </div>
        <br>
        
        <form id="imageupdatesubmit" action="" method="post" enctype="multipart/form-data">

        <label style="font-weight: bold; font-size:15px;">Store Image</label>
        <div class="form-group storeimageview" style="margin-bottom:0px; border:1px solid gray;">
          <div class="form-line">
            <div class="trick"></div>
            <img id="uploadPreview" style="width:550px;height:273px;" src="" alt="Store Image" />
          </div>
        </div>
        <br>

        <i>Suggested dimension: 600x300px | Ratio: 2:1 | File size: not more than 2MB</i>
        <div class="col-md-8">
          <input id="file" type="file" name="mStoreimage" style="font-size:17px;margin-bottom:10px;" onchange="PreviewImage();" accept="image/*" >
          <div id="storeimageerror" style="color:red;"><br></div>
        </div>
        <div class="col-md-4">
          <button type="submit" name="button" class="btn btn-success">Apply Image</button>
        </div>
        </form>
        <br>
      </div>
      <div class="modal-footer">
        <button type="button" id="modalStoreSubmit" class="btn btn-primary" name="button">Done Editing</button>
      </div>

    </div>
        <!-- Modal content-->
  </div>
</div>
<!-- Store Edit -->

<!-- Order Product List -->
<div id="orderProducts" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Ordered Products</h4>
      </div>
      <div class="modal-body">
        <table id="orderProductsTable" class="table table-bordered table-striped table-hover js-basic-example dataTable">
            <thead>
                <tr>
                    <th>PRODUCT NAME</th>
                    <th width="30px">QTY</th>
                    <th>PRICE</th>
                </tr>
            </thead>
            <tbody id="orderprodbody">

            </tbody>
        </table>

        <div align="right" style="padding:5px;">
          <b>
          <table>
            <thead>
              <tr>
                <th></th>
                <th width="20px"></th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td> # of Items </td>
                <td align="center">=</td>
                <td id="totalitems" align="right"></td>
              </tr>
              <tr>
                <td> Total Price </td>
                <td align="center">=</td>
                <td id="totalprice" align="right" style="color:red;"></td>
              </tr>
            </tbody>
          </table>
          </b>
        </div>

      </div>
    </div>
        <!-- Modal content-->
  </div>
</div>
<!-- Order Product List END -->
