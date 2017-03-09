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

        <form id="prodimageupdatesubmit" action="" method="post" enctype="multipart/form-data">

        <label style="font-weight: bold; font-size:15px;">Product Image</label>
        <div class="form-group prodimageview" style="margin-bottom:0px; margin:0 auto !important; border:1px solid gray;">
          <div class="form-line">
            <div class="trick"></div>
            <img id="uploadPreview3" style="width:250px;height:250px;" src="" alt="Store Image" />
          </div>
        </div>
        <br>

        <i>Suggested dimension: 800x800px | File size: not more than 2MB</i>
        <div class="col-md-8">
          <input id="editProdimage" type="file" name="mProdImage" style="font-size:17px;margin-bottom:10px;" onchange="PreviewImage();" accept="image/*" >
          <div id="prodimageerror" style="color:red;"><br></div>
        </div>
        <div class="col-md-4">
          <button type="submit" name="button" class="btn btn-success">Apply Image</button>
        </div>
        </form>
        <br><br><br>
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
        <label style="font-weight: bold; font-size:15px;">Price</label>
        <div class="input-group" style="margin-bottom:0px;">
            <span class="input-group-addon">
                Php
            </span>
          <div class="form-line">
            <input type="number" id="mPrice" class="form-control" value="" required>
          </div>
        </div>
        <br>
        <label style="font-weight: bold; font-size:15px;">Description</label>
        <div class="row clearfix">
            <div class="col-sm-12">
                <div class="form-group">
                    <div class="form-line">
                        <textarea rows="4" id="mDesc" class="form-control" style="max-width:100%;" placeholder="Please type the description..."></textarea>
                    </div>
                </div>
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


<!-- Add Product Discount List -->
<div id="addDiscount" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modaldiscounttitle"></h4>
      </div>
      <div class="modal-body">

        <p id="currDiscount" style="font-size:20px"></p>

        <form id="discountForm">

        <label style="font-weight: bold; font-size:15px;" for="dType">Discount Type</label>
        <div id="discounttype" class="demo-radio-button">
            <input name="dType" type="radio" class="with-gap radio-col-red" id="dType_1" required />
            <label for="dType_1">Percentage</label>
            <input name="dType" type="radio" class="with-gap radio-col-red" id="dType_2" required />
            <label for="dType_2">Amount</label>
        </div>

        <br>

        <label style="font-weight: bold; font-size:15px;">Discount</label>
        <div class="input-group" style="margin-bottom:0px;">
            <span class="input-group-addon" id="mSign">

            </span>
          <div class="form-line">
            <input type="number" id="mDiscount" min="0" max="100" class="form-control" value="" required>
          </div>
          <div style="color:red; font-size:13px; margin:5px 0 -20px 0;" id="errordiscount">
            <br>
          </div>
        </div>
        <br>
        <label style="font-weight: bold; font-size:15px;">Date Start</label>
        <div class="form-group" style="margin-bottom:0px;">
          <div class="form-line">
            <input type="text" class="datepicker form-control" id="dateStart" name="dateStart" placeholder="Choose a starting date" required>
          </div>
          <div style="color:red; font-size:13px; margin:5px 0 -20px 0;" id="errorCat">
            <br>
          </div>
        </div>
        <br>
        <label style="font-weight: bold; font-size:15px;">Date End</label>
        <div class="form-group" style="margin-bottom:0px;">
          <div class="form-line">
            <input type="text" class="datepicker form-control" id="dateEnd" name="dateEnd" placeholder="Choose an ending date" required>
          </div>
          <div style="color:red; font-size:13px; margin:5px 0 -20px 0;" id="errorCat">
            <br>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="submit" id="discountsubmit" class="btn btn-success" name="button">Set Discount</button>
      </div>
      </form>
    </div>
        <!-- Modal content-->
  </div>
</div>
<!-- Add Product Discount END -->


<!-- Add Coupon List -->
<div id="addCoupon" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modalcoupontitle">ADD COUPON</h4>
      </div>
      <div class="modal-body">

        <form id="couponForm">

        <label style="font-weight: bold; font-size:15px;">Coupon Name</label>
        <div class="form-group" style="margin-bottom:0px;">
          <div class="form-line">
            <input type="text" class="form-control" id="couponDesc" name="couponDesc" required>
          </div>
          <div style="color:red; font-size:13px; margin:5px 0 -20px 0;" id="errorcName">
            <br>
          </div>
        </div>

        <br>

        <label style="font-weight: bold; font-size:15px;">Coupon Code</label>
        <div class="form-group" style="margin-bottom:0px;">
          <div class="form-line">
            <input type="text" class="form-control" id="couponCode" name="couponCode" required>
          </div>
          <div style="color:red; font-size:13px; margin:5px 0 -20px 0;" id="errorCode">
            <br>
          </div>
        </div>

        <br>

        <label style="font-weight: bold; font-size:15px;" for="cType">Discount Type</label>
        <div id="couponType" class="demo-radio-button">
            <input name="cType" type="radio" class="with-gap radio-col-red" id="cType_1" required />
            <label for="cType_1">Percentage</label>
            <input name="cType" type="radio" class="with-gap radio-col-red" id="cType_2" required />
            <label for="cType_2">Amount</label>
        </div>
        <div style="color:red; font-size:13px; margin:5px 0 -20px 0;" id="ErrorRadio"><br></div>

        <br>

        <label style="font-weight: bold; font-size:15px;">Discount</label>
        <div class="input-group" style="margin-bottom:0px;">
            <span class="input-group-addon" id="cSign">

            </span>
          <div class="form-line">
            <input type="number" id="cDiscount" min="0" max="" class="form-control" value="" required>
          </div>
          <div style="color:red; font-size:13px; margin:5px 0 -20px 0;" id="errordiscount">
            <br>
          </div>
        </div>
        <br>

        <label style="font-weight: bold; font-size:15px;">Max Uses</label>
        <div class="input-group" style="margin-bottom:0px;">
            <span class="input-group-addon" id="cSign">

            </span>
          <div class="form-line">
            <input type="number" id="cMax" min="0" class="form-control" value="" required>
          </div>
          <div style="color:red; font-size:13px; margin:5px 0 -20px 0;" id="errormax">
            <br>
          </div>
        </div>
        <br>
        <label style="font-weight: bold; font-size:15px;">Date Start</label>
        <div class="form-group" style="margin-bottom:0px;">
          <div class="form-line">
            <input type="text" class="datepicker form-control" id="cdateStart" name="cdateStart" placeholder="Choose a starting date" required>
          </div>
          <div style="color:red; font-size:13px; margin:5px 0 -20px 0;" id="errorCat">
            <br>
          </div>
        </div>
        <br>
        <label style="font-weight: bold; font-size:15px;">Date End</label>
        <div class="form-group" style="margin-bottom:0px;">
          <div class="form-line">
            <input type="text" class="datepicker form-control" id="cdateEnd" name="cdateEnd" placeholder="Choose an ending date" required>
          </div>
          <div style="color:red; font-size:13px; margin:5px 0 -20px 0;" id="errorCat">
            <br>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="submit" id="couponSubmit" class="btn btn-success" name="button">Set Discount</button>
      </div>
      </form>
    </div>
        <!-- Modal content-->
  </div>
</div>
<!-- Add Coupon END -->

<!-- EDIT Coupon List -->
<div id="editCoupon" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="editcoupontitle">EDIT COUPON</h4>
      </div>
      <div class="modal-body">

        <form id="ecouponForm">

        <label style="font-weight: bold; font-size:15px;">Coupon Name</label>
        <div class="form-group" style="margin-bottom:0px;">
          <div class="form-line">
            <input type="text" class="form-control" id="ecouponDesc" name="ecouponDesc" required>
          </div>
          <div style="color:red; font-size:13px; margin:5px 0 -20px 0;" id="errorcName1">
            <br>
          </div>
        </div>

        <br>

        <label style="font-weight: bold; font-size:15px;">Coupon Code</label>
        <div class="form-group" style="margin-bottom:0px;">
          <div class="form-line">
            <input type="text" class="form-control" id="ecouponCode" name="ecouponCode" required>
          </div>
          <div style="color:red; font-size:13px; margin:5px 0 -20px 0;" id="errorCode">
            <br>
          </div>
        </div>

        <br>

        <label style="font-weight: bold; font-size:15px;" for="ecType">Discount Type</label>
        <div id="ecouponType" class="demo-radio-button">
            <input name="ecType" type="radio" class="with-gap radio-col-red" id="ecType_1" />
            <label for="ecType_1">Percentage</label>
            <input name="ecType" type="radio" class="with-gap radio-col-red" id="ecType_2" />
            <label for="ecType_2">Amount</label>
        </div>
        <div style="color:red; font-size:13px; margin:5px 0 -20px 0;" id="eErrorRadio"><br></div>

        <br>

        <label style="font-weight: bold; font-size:15px;">Discount</label>
        <div class="input-group" style="margin-bottom:0px;">
            <span class="input-group-addon" id="ecSign">

            </span>
          <div class="form-line">
            <input type="number" id="ecDiscount" min="0" max="" class="form-control" value="" required>
          </div>
          <div style="color:red; font-size:13px; margin:5px 0 -20px 0;" id="errordiscount">
            <br>
          </div>
        </div>
        <br>

        <label style="font-weight: bold; font-size:15px;">Max Uses</label>
        <div class="input-group" style="margin-bottom:0px;">
          <div class="form-line">
            <input type="number" id="ecMax" min="0" class="form-control" value="" required>
          </div>
          <div style="color:red; font-size:13px; margin:5px 0 -20px 0;" id="errormax">
            <br>
          </div>
        </div>
        <br>
        <label style="font-weight: bold; font-size:15px;">Date Start</label>
        <div class="form-group" style="margin-bottom:0px;">
          <div class="form-line">
            <input type="text" class="datepicker form-control" id="ecdateStart" name="ecdateStart" placeholder="Choose a starting date" required>
          </div>
          <div style="color:red; font-size:13px; margin:5px 0 -20px 0;" id="errorCat">
            <br>
          </div>
        </div>
        <br>
        <label style="font-weight: bold; font-size:15px;">Date End</label>
        <div class="form-group" style="margin-bottom:0px;">
          <div class="form-line">
            <input type="text" class="datepicker form-control" id="ecdateEnd" name="ecdateEnd" placeholder="Choose an ending date" required>
          </div>
          <div style="color:red; font-size:13px; margin:5px 0 -20px 0;" id="errorCat">
            <br>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="submit" id="ecouponSubmit" class="btn btn-success" name="button">Set Discount</button>
      </div>
      </form>
    </div>
        <!-- Modal content-->
  </div>
</div>
<!-- EDIT Coupon END -->


<!-- ADD QUANTITY -->
<div id="editQuantity" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"> Edit Quantity </h4>
      </div>
      <div class="modal-body">
        <label style="font-weight: bold; font-size:15px;">Current Quantity: </label>
        <label id='curqty' style="color: red; font-size: 16px"></label>
        <br> <br>
        <form id="qtyForm">
        <label style="font-weight: bold; font-size:15px;">Quantity</label>
        <div class="input-group" style="margin-bottom:0px;">
          <div class="form-line">
            <input type="number" id="mQty" min="0" class="form-control" placeholder="e.g., 50, -150" required>
          </div>
          <div style="color:red; font-size:13px; margin:5px 0 -20px 0;" id="errorQty">
            <br>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="submit" id="qtybutton" class="btn btn-success" name="button">Submit</button>
      </div>
      </form>
    </div>
        <!-- Modal content-->
  </div>
</div>
<!-- ADD QUANTITY END -->


<!-- CHANGE DESCRIPTION -->
<div id="changeDesc" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->

    <div class="modal-content" style="margin:auto;width:80%">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" align="center">ADD DESCRIPTION</h4>
      </div>
      <div class="modal-body">
        <div class="body">
          <textarea id="prod_desc" name="prod_desc" style="max-width:100%;" rows="8" cols="58"></textarea>
          <div style="color:red; font-size:13px; margin:0px 0 0px 0;" id="prod_descerror"><br></div>
        </div>
      </div>
      <div class="modal-footer">
        <button id="descsubmit" type="button" class="btn btn-primary" name="button">DONE</button>
      </div>
    </div>

  </div>
</div>
<!-- CHANGE DESCRIPTION -->


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
        <label style="font-weight: bold; font-size:15px;">Branch</label>
        <div class="form-group" style="margin-bottom:0px;">
          <div class="form-line">
            <input type="text" id="mBranch" class="form-control" value="" required>
          </div>
        </div>
        <br>
        <label style="font-weight: bold; font-size:15px;">Days of Operation</label>
        <div class="form-group" style="margin-bottom:0px;">
          <div class="form-line">
            <input type="text" id="mDays" class="form-control" placeholder="e.g., Mon-Fri | Mon-Wed-Fri | Everyday" value="" required>
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
            <img id="uploadPreview2" style="width:550px;height:273px;" src="" alt="Store Image" />
          </div>
        </div>
        <br>

        <i>Suggested dimension: 600x300px | Ratio: 2:1 | File size: not more than 2MB</i>
        <div class="col-md-8">
          <input id="editStoreimage" type="file" name="mStoreimage" style="font-size:17px;margin-bottom:10px;" onchange="PreviewImage();" accept="image/*" >
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
                <th width="30px"></th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td align="right"> Coupon Used </td>
                <td align="center">:</td>
                <td id="coupon" align="right"></td>
              </tr>
              <tr id="discountstr">
                <td align="right"> Discount </td>
                <td align="center"> </td>
                <td id="discounts" align="right" style="color:blue;"></td>
              </tr>
              <tr>
                <td align="right"> Total # of Items </td>
                <td align="center"> </td>
                <td id="totalitems" align="right"></td>
              </tr>
              <tr>
                <td align="right"> Qty * Price Total </td>
                <td align="center"> </td>
                <td id="rawprice" align="right"></td>
              </tr>
              <tr id="discountamounttr">
                <td align="right"> Discounted Amount </td>
                <td align="center"> </td>
                <td id="discountamount" align="right"></td>
              </tr>
              <tr>
                <td align="right"></td>
                <td align="center"></td>
                <td id="minus" align="right" >--------------------------</td>
              </tr>
              <tr>
                <td align="right"> Total Price </td>
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
