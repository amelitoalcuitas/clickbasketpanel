<!-- Bootstrap Core Js -->
<script src="<?php echo base_url().'assets/plugins/bootstrap/js/bootstrap.js';?>"></script>

<!-- Select Plugin Js -->
<script src="<?php echo base_url().'assets/plugins/bootstrap-select/js/bootstrap-select.js';?>"></script>

<!-- Slimscroll Plugin Js -->
<script src="<?php echo base_url().'assets/plugins/jquery-slimscroll/jquery.slimscroll.js';?>"></script>

<!-- Waves Effect Plugin Js -->
<script src="<?php echo base_url().'assets/plugins/node-waves/waves.js';?>"></script>

<!-- Moment Plugin Js -->
<script src="<?php echo base_url().'assets/plugins/momentjs/moment.js';?>"></script>

<!-- Bootstrap Material Datetime Picker Plugin Js -->
<script src="<?php echo base_url().'assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js';?>"></script>

<!-- Demo Js -->
<script src="<?php echo base_url().'assets/js/demo.js';?>"></script>

 <!-- Jquery DataTable Plugin Js -->
<script src="<?php echo base_url().'assets/plugins/jquery-datatable/jquery.dataTables.js'?>"></script>
<script src="<?php echo base_url().'assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js';?>"></script>
<script src="<?php echo base_url().'assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js';?>"></script>
<script src="<?php echo base_url().'assets/plugins/jquery-datatable/extensions/export/buttons.flash.min.js';?>"></script>
<script src="<?php echo base_url().'assets/plugins/jquery-datatable/extensions/export/jszip.min.js';?>"></script>
<script src="<?php echo base_url().'assets/plugins/jquery-datatable/extensions/export/pdfmake.min.js';?>"></script>
<script src="<?php echo base_url().'assets/plugins/jquery-datatable/extensions/export/vfs_fonts.js';?>"></script>
<script src="<?php echo base_url().'assets/plugins/jquery-datatable/extensions/export/buttons.html5.min.js';?>"></script>
<script src="<?php echo base_url().'assets/plugins/jquery-datatable/extensions/export/buttons.print.min.js';?>"></script>
<script src="<?php echo base_url().'assets/js/pages/tables/jquery-datatable.js';?>"></script>

<!-- Custom Js -->
<script src="<?php echo base_url().'assets/js/admin.js';?>"></script>
<script src="<?php echo base_url().'assets/js/jquery.validate.min.js';?>"></script>

<!-- VENDOR SIDE SCRIPTS START -->
<script>
  $('#sHourStart').bootstrapMaterialDatePicker({ date: false, shortTime: true, format: 'LT'});
  $('#sHourClose').bootstrapMaterialDatePicker({ date: false, shortTime: true, format: 'LT' });
</script>

<script>

  // TABLE PRIORITIES

  $('#productTable').DataTable({
        language: {
            emptyTable: "No products found!",
        }
  });

  // TABLE PRIORITIES END


  var reloadPrompt = true;
  // DISALLOW SPECIAL CHARACTERS TO ALL INPUTS
  $('input').on('keypress', function (event){
    var regex = new RegExp("^[a-zA-Z0-9;'%!#@&*,.-=() ]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
       event.preventDefault();
       return false;
    }
  });

  // <!-- TAB CLOSE ALERT SCRIPT START -->
    window.onbeforeunload = function () {
      var pagetitle = '<?php echo $title;?>';

      if(pagetitle == 'vendoraddnewproduct'){
        if(cnt-1 > 0 && reloadPrompt == true){
          return "alert";
        }
      }
    };
  // <!-- TAB CLOSE ALERT SCRIPT END -->

  $('.selectsearch').selectpicker();

  var cnt = 1;

  $('#addButton').click(function(){


    var data0 = document.getElementById("col1").innerHTML;
    var data1 = document.getElementById("col2").innerHTML;
    var data2 = document.getElementById("col3").innerHTML;
    var data3 = document.getElementById("col4").innerHTML;
    var data4 = '<div id="col5"><div class="form-group" style="margin-bottom:0px;"><select class="form-control show-tick selectsearch" data-live-search="true" name="pSubCategory[]" required><option value="">-- Please select --</option><?php if(isset($subcategorylist)){ foreach($subcategorylist as $row){ ?><option value="<?php echo $row->subcategory_id;?>"> <?php echo $row->subcategory_name; ?></option><?php }} ?></select></div></div>';
    var data5 = '<button type="button" id="delThisRow" onclick="deleteThisRow('+cnt+')" name="delThisRow" class="btn btn-danger"><i class="material-icons">remove</i></button>';

    $('#addProductTable').append('<tr id="'+ cnt +'"><td>'+data0+'</td><td>'+data1+'</td><td>'+data2+'</td><td>'+data3+'</td><td>'+data4+'</td><td>'+ data5 +'</td></tr>');
    $('.selectsearch').selectpicker();
    cnt = cnt + 1;

  });

  // CHECK SIMILAR PRODUCT NAMES
  function sameProdName(){
    var same = false;
    var inputs = {};
      $("#addProductTable input[name='pName[]']").each(function() {
        $(this).removeClass('sameName');
        if (inputs[this.value] !== undefined && $(this).val().length > 0) {
          // a previous element with the same value exists
          // apply class to both elements
          $([this, inputs[this.value]]).addClass('sameName');
          same = true;
        }
        inputs[this.value] = this;
      });

    return same;
  }

  $('#submitProduct').click(function(event){
    var result2 = "";
    event.preventDefault();
    $('#addProdError').html('<br>');
    $('#addProductTable #prodNameError').html('<br>');
    $('#addProductTable input[name="pName[]"]').removeClass('prodExist');

    var pname = $("#addProductTable input[name='pName[]']").map(function(){return $(this).val();}).get();
    var pprice = $("#addProductTable input[name='pPrice[]']").map(function(){return $(this).val();}).get();
    var pqty = $("#addProductTable input[name='pQuantity[]']").map(function(){return $(this).val();}).get();
    var pscat = $("#addProductTable select[name='pSubCategory[]']").map(function(){return $(this).val();}).get();
    var count = pname.length;

    sameProdName(); // Checks if there are similar product names

    if (count === 0) {
      event.preventDefault();
      swal('Error!','Add a row with product details!','error');
    } else if(inputEmpty() == false && sameProdName() == false){
      $.ajax({
        type: 'POST',
        url: '<?php echo base_url("addproductcontroller/check_product_credentials"); ?>',
        data: {pname:pname, pprice:pprice, pqty:pqty, pscat:pscat, count:count},
        success: function(result){
          var result2 = result;
          if(result == "existfalse"){
            swal('Error!','Product/s entered already exist!','error');
            $('#addProdError').append('*One or more product already exist');

            $.ajax({
              type:'POST',
              url: '<?php echo base_url("addproductcontroller/getExistingProducts"); ?>',
              data: {},
              dataType: 'JSON',
              success: function(index){
                console.log(index);
                for(var i = 0; i < index.length; i++){
                  var indx = index[i]+1;

                  $('#addProductTable #'+indx+' #prodNameError').html('Product already exist!');
                  $('#addProductTable #'+indx+' input[name="pName[]"]').addClass('prodExist');
                }
              }
            });

          }else if(result == "success"){
            reloadPrompt = false;
            location.reload();
          }
        }
      });
    }
    if(sameProdName() == true){
      $('#addProdError').append('*There are duplicate product names <br>');
    }
    if(inputEmpty() == true){
      $('#addProdError').append('*Fill up all fields');
    }

  });

  // CHECK IF INPUTS ARE EMPTY ------------ EXPERIMENTAL
  function inputEmpty(){
    var isEmpty = true;
    var emptyNum = 0;
    var count = (cnt-1)*4;

    $("#addProductTable input[name='pImage[]']").each(function(){
      if($(this).val().length > 0){
        $(this).removeClass('emptyInput');
        emptyNum = emptyNum + 1;
      }else{
        $(this).addClass('emptyInput');
        emptyNum =  emptyNum - 1;
      }
    });

    $("#addProductTable input[name='pName[]']").each(function(){
      if($(this).val().length > 0){
        $(this).removeClass('emptyInput');
        emptyNum = emptyNum + 1;
      }else{
        $(this).addClass('emptyInput');
        emptyNum =  emptyNum - 1;
      }
    });

    $("#addProductTable input[name='pPrice[]']").each(function(){
      if($(this).val().length > 0){
        $(this).removeClass('emptyInput');
        emptyNum = emptyNum + 1;
      }else{
        $(this).addClass('emptyInput');
        emptyNum =  emptyNum - 1;
      }
    });

    $("#addProductTable input[name='pQuantity[]']").each(function(){
      if($(this).val().length > 0){
        $(this).removeClass('emptyInput');
        emptyNum = emptyNum + 1;
      }else{
        $(this).addClass('emptyInput');
        emptyNum =  emptyNum - 1;
      }
    });

    $("#addProductTable select[name='pSubCategory[]']").each(function(){
      if($(this).val().length > 0){
        $(this).removeClass('emptyInput');
        emptyNum = emptyNum + 1;
      }else{
        $(this).removeClass('emptyInput');
        emptyNum =  emptyNum - 1;
      }
    });

    if(count == emptyNum){
      isEmpty = false;
    }

    return isEmpty;
  }

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
        url: "<?php echo base_url("addproductcontroller/deleteProduct"); ?>",
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
      url: '<?php echo base_url("addproductcontroller/updateProduct"); ?>',
      success: function(result){
        if(result == 'true'){
          $('#selectedsubcat_'+id).attr('value',psubcategory);
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
          $('#errorCat').html('Category already exists or previously removed! (Check "Removed Categories" page)');
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
    $('#errorCatEdit_'+id).html('</br>');
  }

  function catDoneButt(id){
    var table = $('#categoryTable').DataTable();
    var catname = document.getElementById('catNameInput_'+id).value;

    $.ajax({
      type: 'post',
      data: {catid:id, catName:catname},
      url: '<?php echo base_url("addcategorycontroller/updateCategory"); ?>',
      success: function(result){
        if(result == 'true'){
          swal('Success!','Category has been successfully updated!','success');

          $('#catNameParag_'+id).html(catname);
          $('#catNameParag_'+id).show();
          $('#editButt_'+id).show();
          $('#deleteButt_'+id).show();

          $('#catNameDiv_'+id).hide();
          $('#doneButt_'+id).hide();
          $('#cancelButt_'+id).hide();

        }else if (result === 'false') {
          $('#errorCatEdit_'+id).html('Category Name field is required!')
        }else if (result === 'existfalse') {
          $('#errorCatEdit_'+id).html('No changes made or it already exists!');
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
            var editBtn = "<button id='editSubCat_"+qResult[i].subcategory_id+"' onclick='editSubCat("+qResult[i].subcategory_id+")' class='btn btn-warning'><i class='material-icons'>edit</i></button>";
            var delBtn = "<button id='delSubCat_"+qResult[i].subcategory_id+"' name="+i+" onclick='delSubCat("+qResult[i].subcategory_id+","+"\""+qResult[i].subcategory_name+"\""+")' class='btn btn-danger'><i class='material-icons'>delete</i></button>";
            var doneBtn = "<button id='doneBtn_"+qResult[i].subcategory_id+"' style='display: none;' onclick='SubCatDoneButt("+qResult[i].subcategory_id+")' class='btn btn-primary'><i class='material-icons'>done</i></button>";
            var cancelBtn = "<button id='cancelBtn_"+qResult[i].subcategory_id+"' style='display: none;' onclick='SubCatCancelButt("+qResult[i].subcategory_id+")' class='btn btn-danger'><i class='material-icons'>close</i></button>";
            var inputField = '<div class="form-group" id="SubCatNameDiv_'+qResult[i].subcategory_id+'" style="margin-bottom:0px; display: none;"><div class="form-line"><input type="text" name="SubCatName" id="SubCatNameInput_'+qResult[i].subcategory_id+'" style="padding-left:5px;" class="form-control" value="'+qResult[i].subcategory_name+'"></div><div style="color:red; font-size:13px; margin:5px 0 0px 0;" id="errorSubCatEdit_'+qResult[i].subcategory_id+'"></div></div>';
            var paragField = '<p id="SubCatNameParag_'+qResult[i].subcategory_id+'">'+qResult[i].subcategory_name+'</p>';
            var subCatError = '<div style="color:red; font-size:13px; margin:-20px 0 0px 0;" id="errorSubCatEdit_'+qResult[i].subcategory_id+'"><br></div>';

            $('#subcatbody tr:eq('+i+')').attr('name',qResult[i].subcategory_name);
            $('#subcatbody tr:eq('+i+')').attr('id',qResult[i].subcategory_id);

            subCatTable.row.add([paragField + inputField + subCatError, editBtn + " " + delBtn + " " + doneBtn + " " + cancelBtn]).draw();
          }
        }
      });
  }

  function delSubCat(id,name){
    var table = $('#subCategoryTable').DataTable();

    swal({
      title: "Are you sure you want to delete " + name + "?",
      text: "You will not be able to recover this sub-category!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
      },
      function(){
        $.ajax({
          type: 'post',
          data: {subcategoryid:id},
          url: "<?php echo base_url('addcategorycontroller/deleteSubCategory'); ?>",
          success: function(result){
            table
              .row($('#delSubCat_'+id).attr('name'))
              .remove()
              .draw();
            swal("Deleted!", name + " has been deleted.", "success");
          }
        });
    });
  }

  function editSubCat(id){
    $('#SubCatNameParag_'+id).hide();
    $('#editSubCat_'+id).hide();
    $('#delSubCat_'+id).hide();

    $('#SubCatNameDiv_'+id).show();
    $('#doneBtn_'+id).show();
    $('#cancelBtn_'+id).show();
    $('#errorSubCatEdit_'+id).html('</br>');
  }

  function SubCatCancelButt(id){
    $('#SubCatNameParag_'+id).show();
    $('#editSubCat_'+id).show();
    $('#delSubCat_'+id).show();

    $('#SubCatNameDiv_'+id).hide();
    $('#doneBtn_'+id).hide();
    $('#cancelBtn_'+id).hide();
    $('#errorSubCatEdit_'+id).html('</br>');
  }

  function SubCatDoneButt(id){
    var table = $('#subCategoryTable').DataTable();
    var subcatname = document.getElementById('SubCatNameInput_'+id).value;
    var catid = $('#viewSubCat').attr('data-id');

    $.ajax({
      type: 'post',
      data: {subcatid:id, subCatName:subcatname, catId:catid},
      url: '<?php echo base_url("addcategorycontroller/updateSubCategory"); ?>',
      success: function(result){
        if(result == 'true'){
          swal('Success!','Sub-Category has been successfully updated!','success');

          $('#SubCatNameParag_'+id).html(subcatname);
          $('#SubCatNameParag_'+id).show();
          $('#editSubCat_'+id).show();
          $('#delSubCat_'+id).show();

          $('#SubCatNameDiv_'+id).hide();
          $('#doneBtn_'+id).hide();
          $('#cancelBtn_'+id).hide();
          $('#errorSubCatEdit_'+id).html('</br>');

        }else if (result === 'false') {
          $('#errorSubCatEdit_'+id).html('Sub-Category Name field is required!')
        }else if (result === 'existfalse') {
          $('#errorSubCatEdit_'+id).html('No changes made or it already exists!');
        }
      }
    });
  }

  $("#viewSubCat").on("shon.bs.modal", function () {
    var id = $('#viewSubCat').attr('data-id');
  });

  $("#viewSubCat").on("hidden.bs.modal", function () {
    $('#subCategoryTable').DataTable().clear().draw();
  });

  $("#addSubCategory").on("hidden.bs.modal", function () {
    $('#subcatName').val('');
    $('#errorsubCat').html('<br>');
  });

  $('#subcatSubmit').click(function(){
    var subCatName = document.getElementById('subcatName').value;
    var table = $('#subCategoryTable').DataTable();
    var catId = $('#viewSubCat').attr('data-id');

    $.ajax({
      type: 'POST',
      data: {subCatName:subCatName, catId:catId},
      url: '<?php echo base_url("addcategorycontroller/check_subcat_name"); ?>',
      success: function(result){
        if (result === 'true'){
          $('#addSubCategory').modal('hide');
          swal('Success!','Sub-category has been added!','success');
        }else if (result === 'false') {
          $('#errorsubCat').html('Sub-Category Name field is required!')
        }else if (result === 'existfalse') {
          $('#errorsubCat').html('Sub-Category already exists or previously removed! (Check "Removed Sub-Categories" page)');
        }
      },
      error: function(result){
        console.log(result);
      }
    });
  });

  //-------------CATEGORY PAGE END-----------------//
</script>

<!-- VENDOR SIDE SCRIPTS END -->

<!-- SUPERADMIN SIDE SCRIPTS START -->
  <script type="text/javascript">
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

    function editStore(id){
      $('#editStoreModal').modal('show');
      $('#editStoreModal').attr('data-id',id);

      var table = $('#storeEditTable').DataTable();
      var myData = table.row('#storetablerow_'+id).data();

      $('#modalStoreHeader').html('EDIT ' + myData[0].toUpperCase());

      $('#mStoreName').attr('value',myData[0]);
      $('#mAddress').attr('value',myData[1]);
      $('#mTimeOpen').attr('value',$('#timeOpen_'+id).val());
      $('#mTimeClose').attr('value',$('#timeClose_'+id).val());
    }

    $('#modalStoreSubmit').click(function(){
      var id = $('#editStoreModal').attr('data-id');
      var storename = $('#mStoreName').val();
      var storeaddress = $('#mAddress').val();
      var timeopen = $('#mTimeOpen').val();
      var timeclose = $('#mTimeClose').val();

      var table = $('#storeEditTable').DataTable();
      var myData = table.row('#storetablerow_'+id).data();

      myData[0] = storename;
      myData[1] = storeaddress;
      myData[2] = formatTime(timeopen) + ' - ' + formatTime(timeclose);

      $.ajax({
         type: 'post',
         url: '<?php echo base_url("storeregistercontroller/updateStore"); ?>',
         data: {storeid:id, storename:storename, storeaddress:storeaddress, timeopen:timeopen, timeclose:timeclose},
         success: function(result){
           if(result == 'true'){
             table.row($('#storetablerow_'+id)).data(myData).draw();
             $('#editStoreModal').modal('hide');
             swal('Success!','Category has been successfully updated!','success');
           }else if (result === 'false') {
             $('#errorStoreEdit').html('Store Name field is required!')
           }
         }
      });
    });

    function formatTime(time){
      var splitTime = time.split(':');
      var hh = splitTime[0];
      var mm = splitTime[1];
      var pp = (hh >= 12 ? "PM" : "AM");
      var Hh = ((parseInt(hh) + 11) % 12 + 1);

      var hour = (Hh < 10 ? "0" + Hh.toString() : Hh);

      var newTime = hour + ":" + mm + " " + pp;

      return newTime;
    }

    function deleteStore(id){
      var table = $('#storeEditTable').DataTable();

      swal({
        title: "Are you sure you want to remove " + $("#storetablerow_"+id).attr("name") + "?",
        text: "You can still reverse this action at the 'Removed Stores' page.",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes I am!",
        closeOnConfirm: false
        },
        function(){
        swal("Deleted!", $("#storetablerow_"+id).attr("name") + " has been removed.", "success");
        $.ajax({
          type: 'post',
          data: {storeid:id},
          url: "<?php echo base_url('storeregistercontroller/remove_Store'); ?>",
          success: function(result){
            table
              .row($('#storetablerow_'+id))
              .remove()
              .draw();
          }
        });
      });
    }

    function unblockThisStore(id){
      var table = $('#remStoreEditTable').DataTable();

      swal({
        title: "Are you sure you want to unblock " + $("#remStoreTableRow_"+id).attr("name") + "?",
        text: "Store will be added back to the store list.",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes I am!",
        closeOnConfirm: false
        },
        function(){
        swal("Deleted!", $("#remStoreTableRow_"+id).attr("name") + " has been removed.", "success");
        $.ajax({
          type: 'post',
          data: {storeid:id},
          url: "<?php echo base_url('storeregistercontroller/unblockStore'); ?>",
          success: function(result){
            table
              .row($('#remStoreTableRow_'+id))
              .remove()
              .draw();
          }
        });
      });
    }

  </script>
<!-- SUPERADMIN SIDE SCRIPTS END -->

<!-- SMS SCRIPT START -->
  <script>
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
  </script>
<!-- SMS SCRIPT END -->

<script type="text/javascript">
    function editThis(id){
      $("#cancelbutt_"+id).show();
      $("#donebutt_"+id).show();
      $("#input_"+id).show();
      $("#edit_"+id).hide();
      $("#text_"+id).hide();
    }

    function cancelEdit(id){
      $("#cancelbutt_"+id).hide();
      $("#donebutt_"+id).hide();
      $("#input_"+id).hide();
      $("#edit_"+id).show();
      $("#text_"+id).show();
    }

    function doneEdit(id){
      var input = $('#input_'+id+' input').val();
      var name = $('#input_'+id+' input').attr('name');

      $.ajax({
        type: 'POST',
        url: '<?php echo base_url("registrationcontroller/updateUser") ;?>',
        data: {input:input, name:name},
        success: function(){
          if(name == 'password'){
            $("#text_"+id+" p").html('***********');
          }else{
            $("#text_"+id+" p").html(input);
          }
          $("#cancelbutt_"+id).hide();
          $("#donebutt_"+id).hide();
          $("#input_"+id).hide();
          $("#edit_"+id).show();
          $("#text_"+id).show();
        }
      });
    }
</script>

<!-- NOTIFICATION SCRIPT START -->
<script>
  $(document).ready(function(){
    notifLoop();
  });

  function notifLoop(){
    $.ajax({
      type: "POST",
      url: "<?php echo base_url('notificationcontroller/get_notification'); ?>",
      timeout:50000,
      async: 'true',
      cache: 'false',
      success: function(data){
        $('#notif_li').html(data);
        $('.timeago').timeago();
        setTimeout(
          notifLoop,
          3000
        );
      }
    });

    $.ajax({
      type: "POST",
      url: "<?php echo base_url('notificationcontroller/get_count'); ?>",
      dataType: 'JSON',
      success: function(count){
        $('#notif_count').html(count.length);
        if(count.length == 0){
          $('#titleUpdate').html('ClickBasket Panel');
        }else{
          $('#titleUpdate').html('ClickBasket Panel (' + count.length +')');
        }
      }
    });
  }

  function notifRead(id){
    $.ajax({
      type: "POST",
      url: "<?php echo base_url('notificationcontroller/notif_read'); ?>",
      data: {notifid:id},
      success: function(){
      }
    });
  }
</script>
<!-- NOTIFICATION SCRIPT END -->

<!-- ORDER BUTTONS -->
<script>
  function changeStatus(id,currStat,stat){
    $('#butt_'+id).removeClass();

    if(stat == 'pending'){
      $('#butt_'+id).addClass('btn btn-danger dropdown-toggle');
    }else if(stat == 'processing'){
      $('#butt_'+id).addClass('btn btn-primary dropdown-toggle');
    }else if(stat == 'completed'){
      $('#butt_'+id).addClass('btn btn-success dropdown-toggle');
    }

    $.ajax({
      type: "POST",
      url: "<?php echo base_url('OrderController/changeOrderStatus'); ?>",
      data: {id:id, stat:stat},
      success: function(){
        $('#butt_'+id).html(stat.toUpperCase() + " <span class='caret'>");
      }
    });
  }

  function viewOrders(id){
    $('#orderProducts').modal('show');
    $('#orderProducts').attr('data-id',id);

    var totalprice = 0;
    var qty = 0;
    var orderProdTable = $('#orderProductsTable').DataTable();

    $.ajax({
      type: 'post',
      url: '<?php echo base_url("ordercontroller/getOrdersById"); ?>',
      data: {id:id},
      dataType: 'JSON',
      success: function(res){
        for (var i = 0; i < res.length; i++) {
          orderProdTable.row.add([res[i].prod_name,res[i].order_qty,"Php "+res[i].storeprod_price]).draw();
          totalprice += parseInt(res[i].order_qty) * parseFloat(res[i].storeprod_price);
          qty += parseInt(res[i].order_qty);
        }

        total = qty * totalprice;

        $('#totalprice').html('Php ' + parseFloat(totalprice).toFixed(2));
        $('#totalitems').html(qty);
      }
    });
  }

  $("#orderProducts").on("hidden.bs.modal", function () {
    $('#orderProductsTable').DataTable().clear().draw();
  });
</script>
<!-- ORDER BUTTONS END -->

<!-- EMAIL SCRIPT -->
<script>
  function sendEmail(){
    $.ajax({
      type: 'POST',
      url: "<?php echo base_url('emailcontroller/sendEmail'); ?>",
      data: {test:test},
      success: function(data){
        console.log(data);
      }
    });
  }
</script>
<!-- EMAIL SCRIPT END -->

<!-- UPLOAD IMAGE -->
<script>
  $('#fileForm').submit(function(e){
      e.preventDefault();

      var form = $('#fileForm')[0]; // You need to use standart javascript object here
      var formData = new FormData(form);

      $.ajax({
        url: '<?php echo base_url("upload/do_upload"); ?>',
        data: formData,
        type: 'POST',
        contentType: false,
        processData: false,
        success: function(res){
            if(res == "success"){
              $("#cancelbutt_0").hide();
              $("#donebutt_0").hide();
              $("#input_0").hide();
              $("#edit_0").show();
              $("#text_0").show();
              $('#error_0').html('<br>');

              swal({
                title: "Success!",
                text: "Profile Picture has been updated!",
                type: "success"},
                function(){
                  location.reload();
                });

            }else{
              $('#error_0').html(res);
            }
          }
      });
  });

  function PreviewImage() {
      var oFReader = new FileReader();

      oFReader.readAsDataURL(document.getElementById("file").files[0]);

      oFReader.onload = function (oFREvent) {
          document.getElementById("uploadPreview").src = oFREvent.target.result;
      };
  };

</script>
<!-- UPLOAD IMAGE END -->

</body>

</html>
