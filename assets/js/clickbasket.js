// <!-- VENDOR SIDE SCRIPTS START -->

  $('#sHourStart').bootstrapMaterialDatePicker({ date: false, shortTime: true, format: 'LT'});
  $('#sHourClose').bootstrapMaterialDatePicker({ date: false, shortTime: true, format: 'LT' });

  $('.selectsearch').selectpicker();

  var cnt = 1;
  $('#addButton').click(function(){

    var data1 = document.getElementById("col2").innerHTML;
    var data2 = document.getElementById("col3").innerHTML;
    var data3 = document.getElementById("col4").innerHTML;
    var data4 = '<div id="col5"><div class="form-group" style="margin-bottom:0px;"><select class="form-control show-tick selectsearch" data-live-search="true" name="pCategory[]" required><option value="">-- Please select --</option><?php if(isset($subcategorylist)){ foreach($subcategorylist as $row){ ?><option value="<?php echo $row->subcategory_id;?>"> <?php echo $row->subcategory_name; ?></option><?php }} ?></select></div></div>';
    var data5 = '<button type="button" id="delThisRow" onclick="deleteThisRow('+cnt+')" name="delThisRow" class="btn btn-danger"><i class="material-icons">remove</i></button>';

    $('#addProductTable').append('<tr id="'+ cnt +'"><td>'+data1+'</td><td>'+data2+'</td><td>'+data3+'</td><td>'+data4+'</td><td>'+ data5 +'</td></tr>');
    $('.selectsearch').selectpicker();
    cnt = cnt + 1;
  });

  function deleteThisRow(id){
      $('#'+id).remove();
      cnt = cnt - 1;
  }

  function deleteThis(id){
    var table = $('#productTable').DataTable();

    swal({
      title: "Are you sure you want to delete " + $("#product_"+id).attr("name") + "?",
      text: "You will not be able to recover this product!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
      },
      function(){
      swal("Deleted!", $("#product_"+id).attr("name") + " has been deleted.", "success");
      $.ajax({
        type: 'post',
        data: {productid:id},
        url: "deleteProduct",
        success: function(result){
          table
            .row($('#product_'+id))
            .remove()
            .draw();
        }
      });
    });
  }

  // ----- Product Edit ----- //
  function editThisProductModal(id,sId,catId){
      $('#editProductModal').modal('show');
      $('#editProductModal').attr('data-id',id);
      $('#editProductModal').attr('data-subId',sId);
      var data = $('#productTable').DataTable().row($('#product_'+id)).data();
      var price = data[4].substring(3);
      $('#mSubCategory').empty();

      $.ajax({
        type: 'post',
        url: '<?php echo base_url("addcategorycontroller/getsubCategoryById"); ?>',
        data: {subcatid:catId},
        dataType: 'JSON',
        success: function(qResult){
          $('#mSubCategory').append('<option value=""> -- Please select -- </option>');
          for (var i = 0; i < qResult.length; i++) {
            $('#mSubCategory').append('<option value="' + qResult[i].subcategory_id + '">' + qResult[i].subcategory_name + '</option>');
          }
          document.getElementById('mSubCategory').value = $('#selectedsubcat_'+id).attr('value');
          $('.selectsearch').selectpicker('refresh');
        }
      });

      document.getElementById('mProductName').value = data[0];
      document.getElementById('mCategory').value = $('#selectedcat_'+id).attr('value');
      document.getElementById('mQuantity').value = data[3];
      document.getElementById('mPrice').value = parseFloat(price).toFixed(2);

  }

  $('#mCategory').on('changed.bs.select',function(){
    var catid = $("#mCategory>option:selected").attr('value');
    $('#mSubCategory').empty();
    $('#mSubCategory').append('<option value=""> -- Please select -- </option>');

    $.ajax({
      type: 'post',
      url: '<?php echo base_url("addcategorycontroller/getsubCategoryById"); ?>',
      data: {subcatid:catid},
      dataType: 'JSON',
      success: function(qResult){
        console.log(catid);
        for (var i = 0; i < qResult.length; i++) {
          $('#mSubCategory').append('<option value="' + qResult[i].subcategory_id + '">' + qResult[i].subcategory_name + '</option>');
          if($('#selectedsubcat_'+$('#editProductModal').attr('data-id')).attr('value') == qResult[i].subcategory_id) {
            document.getElementById('mSubCategory').value = $('#selectedsubcat_'+$('#editProductModal').attr('data-id')).attr('value');
          }
        }
        $('.selectsearch').selectpicker('refresh');
      }
    });

  });
  // ----- Product Edit ----- //

  $("#modalSubmit").click(function(){
    var table = $('#productTable').DataTable();
    var id = $('#editProductModal').attr('data-id');
    var sId = $('#editProductModal').attr('data-subId');

    var pname = document.getElementById('mProductName').value;
    var pcategory = document.getElementById('mCategory').value;
    var psubcategory = document.getElementById('mSubCategory').value;
    var catname = $("#mCategory>option:selected").html();
    var subcatname = $("#mSubCategory>option:selected").html();
    var pquantity = document.getElementById('mQuantity').value;
    var pprice = document.getElementById('mPrice').value;
    var newprice = parseFloat(pprice).toFixed(2);
    var myData = table.row($('#product_'+id)).data();

    myData[0] = pname;
    myData[1] = catname;
    myData[2] = subcatname
    myData[3] = pquantity;
    myData[4] = "Php " + newprice;

    $.ajax({
      type: 'post',
      data: {sproductid:sId, productid:id, pname:pname, psubcategory:psubcategory, pquantity:pquantity, pprice:pprice},
      url: "updateProduct",
      success: function(result){
        if(result == 'true'){
          table.row($('#product_'+id)).data(myData).draw();
          $('#editProductModal').modal('hide');
          swal('Success!','Product has been successfully updated!','success');
        }else if (result === 'false') {
          $('#errorProdEdit').html('Product Name field is required!');
        }else if (result === 'existfalse') {
          $('#errorProdEdit').html('Product already exists!');
        }else if(result == 'false'){
          swal('No changes!','No changes has been made to the product!','error');
        }
      }
    });

  });

  $('#editProductModal').on('hidden.bs.modal',function() {
    $('#errorProdEdit').html('<br>');
  });

  $('#productTable').DataTable( {
      language: {
          emptyTable: "No products found!",
      }
  });

  $('#subCategoryTable').DataTable( {
      language: {
          emptyTable: "No Sub-Categories found!",
      }
  });

  $('#categoryTable').DataTable( {
      language: {
          emptyTable: "No Categories found!",
      }
  });

  //-------------CATEGORY PAGE-----------------//
  $('#catSubmit').click(function(){
    var catName = document.getElementById('cName').value;
    var table = $('#productTable').DataTable();

    $.ajax({
      type: 'post',
      data: {catName:catName},
      url: '<?php echo base_url(); ?>addcategorycontroller/check_category_name',
      success: function(result){
        if (result === 'true'){
          location.reload();
          $('#addCategory').modal('hide');
        }else if (result === 'false') {
          $('#errorCat').html('Category Name field is required!')
        }else if (result === 'existfalse') {
          $('#errorCat').html('Category already exists!');
        }
      },
      error: function(result){
        console.log(result);
      }
    });
  });

  function deleteThisCat(id){
    var table = $('#categoryTable').DataTable();

    swal({
      title: "Are you sure you want to delete " + $("#category_"+id).attr("name") + "?",
      text: "You will not be able to recover this category!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
      },
      function(){
      swal("Deleted!", $("#category_"+id).attr("name") + " has been deleted.", "success");
      $.ajax({
        type: 'post',
        data: {categoryid:id},
        url: "<?php echo base_url(); ?>addcategorycontroller/deletecategory",
        success: function(result){
          table
            .row($('#category_'+id))
            .remove()
            .draw();
        }
      });
    });
  }

  function editThisCat(id){
    $('#catNameParag_'+id).hide();
    $('#editButt_'+id).hide();
    $('#deleteButt_'+id).hide();

    $('#catNameDiv_'+id).show();
    $('#doneButt_'+id).show();
    $('#cancelButt_'+id).show();
  }

  function catCancelButt(id){
    $('#catNameParag_'+id).show();
    $('#editButt_'+id).show();
    $('#deleteButt_'+id).show();

    $('#catNameDiv_'+id).hide();
    $('#doneButt_'+id).hide();
    $('#cancelButt_'+id).hide();
  }

  function catDoneButt(id){
    var table = $('#categoryTable').DataTable();
    var catname = document.getElementById('catNameInput_'+id).value;
    var myData = table.row($('#category_'+id)).data();

    myData[0] = catname;

    $.ajax({
      type: 'post',
      data: {catid:id, catName:catname},
      url: '<?php echo base_url("addcategorycontroller/updateCategory"); ?>',
      success: function(result){
        if(result == 'true'){
          table.row($('#category_'+id)).data(myData).draw();
          $('#editThisCat_'+id).modal('hide');
          swal('Success!','Category has been successfully updated!','success');
        }else if (result === 'false') {
          $('#errorCatEdit_'+id).html('Category Name field is required!')
        }else if (result === 'existfalse') {
          $('#errorCatEdit_'+id).html('No changes made!');
        }
      }
    });
  }

  function viewSubCatModal(id){
      $('#viewSubCat').modal('show');
      $('#viewSubCat').attr('data-id',id);
      var catname = $('#category_'+id).attr('name');
      $('#subcatmodalheader').html(catname.toUpperCase() + ' SUB-CATEGORIES');

      var data = $('#categoryTable').DataTable().row( $('#category_'+id)).data();
      document.getElementById('catNameParag_'+id).value = data[0]; //Set Table Header

      var subCatTable = $('#subCategoryTable').DataTable();

      $.ajax({
        type: 'post',
        url: '<?php echo base_url("addcategorycontroller/getsubCategoryById"); ?>',
        data: {subcatid:id},
        dataType: 'JSON',
        success: function(qResult){
          for (var i = 0; i < qResult.length; i++) {
            subCatTable.row.add([qResult[i].subcategory_name]).draw();
          }
        }
      });
  }

  $("#viewSubCat").on("hidden.bs.modal", function () {
    $('#subCategoryTable').DataTable().clear();
  });

  $("#editThisCat").on("hidden.bs.modal", function () {
    $('#errorCatEdit').html('<br>');
  });
  //-------------CATEGORY PAGE END-----------------//

  $('#submitProduct').click(function(event){
    event.preventDefault();

    var pname = $("input[name='pName[]']").map(function(){return $(this).val();}).get();
    var pprice = $("input[name='pPrice[]']").map(function(){return $(this).val();}).get();
    var pqty = $("input[name='pQuantity[]']").map(function(){return $(this).val();}).get();
    var pcat = $("select[name='pCategory[]']").map(function(){return $(this).val();}).get();

     var newPname = pname.slice(0, -1);
     var newPrice = pprice.slice(0, -1);
     var newQty = pqty.slice(0, -1);
     var newCat = pcat.slice(0, -1);

     $.ajax({
        type: 'post',
        url: '<?php echo base_url(); ?>addproductcontroller/check_product_credentials',
        data: {pname:newPname, pprice:newPrice, pqty:newQty, pcat:newCat},
        success: function(result){
          console.log(result);
        }
     });

    console.log("Name: " + newPname + " Price: "+ newPrice + " Qty: " + newQty + " Cat: " + newCat);
  });

// <!-- VENDOR SIDE SCRIPTS END -->

// <!-- SUPERADMIN SIDE SCRIPTS START -->

    function deleteThisVendor(id){
      var table = $('#vendorListTable').DataTable();

      swal({
        title: "Are you sure you want to remove " + $("#vendor_"+id).attr("name") + "?",
        text: "You can still reverse this action at the 'Removed Vendors' page.",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes I am!",
        closeOnConfirm: false
        },
        function(){
        swal("Deleted!", $("#vendor_"+id).attr("name") + " has been removed.", "success");
        $.ajax({
          type: 'post',
          data: {vendorid:id},
          url: "<?php echo base_url('registrationcontroller/removeVendor'); ?>",
          success: function(result){
            table
              .row($('#vendor_'+id))
              .remove()
              .draw();
          }
        });
      });
    }

    function unblockThisVendor(id){
      var table = $('#vendorListTable').DataTable();

      swal({
        title: "Are you sure you want to unblock " + $("#vendor_"+id).attr("name") + "?",
        text: "Vendor will be added back to the affiliated store.",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes I am!",
        closeOnConfirm: false
        },
        function(){
        swal("Deleted!", $("#vendor_"+id).attr("name") + " has been removed.", "success");
        $.ajax({
          type: 'post',
          data: {vendorid:id},
          url: "<?php echo base_url('registrationcontroller/unblockVendor'); ?>",
          success: function(result){
            table
              .row($('#vendor_'+id))
              .remove()
              .draw();
          }
        });
      });
    }
// <!-- SUPERADMIN SIDE SCRIPTS END -->

// <!-- SMS SCRIPT START -->
    $('#sendsms').click(function(){
      var message = $('#message').val();
      var number = $('#mobilenum').val();
      var from = $('#from').val();

      $.ajax({
        type: 'POST',
        data: {message:message,from:from,number:number},
        url: '<?php echo base_url('smscontroller/sendSMS'); ?>',

        success: function(data){
          console.log(data);
        }
      });
    });
// <!-- SMS SCRIPT END -->

// <!-- TAB CLOSE ALERT SCRIPT START -->
  window.onbeforeunload = function () {
    var pagetitle = '<?php echo $title;?>'

    if(pagetitle == 'vendoraddnewproduct'){
      if(cnt > 1){
        return "alert";
      }
    }
  };
// <!-- TAB CLOSE ALERT SCRIPT END -->﻿
