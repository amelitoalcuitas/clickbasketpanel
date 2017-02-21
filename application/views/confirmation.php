
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Confirm Account</title>
    <!-- Favicon-->
     <link rel="icon" href="../../favicon.ico" type="image/x-icon">

     <!-- Google Fonts -->
     <link href="<?php echo base_url().'assets/css/googlefonts.css';?>" rel="stylesheet" type="text/css">
     <link href="<?php echo base_url().'assets/css/material-icons.css';?>" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?php echo base_url().'assets/plugins/bootstrap/css/bootstrap.css';?>" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?php echo base_url().'assets/plugins/node-waves/waves.css';?>" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?php echo base_url().'assets/plugins/animate-css/animate.css';?>" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?php echo base_url().'assets/css/style.css';?>" rel="stylesheet">

    <!-- Sweet Alert -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/plugins/sweetalert/sweetalert.css';?>">
    <script src="<?php echo base_url().'assets/plugins/sweetalert/sweetalert.min.js';?>"></script>

    <style media="screen">
      .modal {
        overflow-y: auto;
      }

      .modal-open {
        overflow: auto;
      }

      .modal-open[style] {
        padding-right: 0px !important;
      }
    </style>

</head>

<body class="login-page">
   <?php $this->load->view('layouts/modals'); ?>

   <?php
     if($this->input->get('confirmation') == 'true'){
       echo "<script> swal('Success!', 'Your account has been verified!', 'success'); </script>";
     }
   ?>

    <div class="login-box">
        <div class="logo">
            <a>Welcome to <b>ClickBasket</b></a>
        </div>
        <div class="card">
            <div class="body">
                    <div class="msg" style="color:red;">
                      Your account has been confirmed! <br>
                      Please set your username and password!
                    </div>
                    <label>Username</label>
                    <div class="input-group">
                      <div class="form-line">
                          <input type="text" id="uname" class="form-control" name="uname" placeholder="Username">
                      </div>
                      <div id="unameError" style="color:red; font-size:13px; margin:2px 0 -5px 0;"><br></div>

                    </div>
                    <label>New Password</label>
                    <div class="input-group">
                      <div class="form-line">
                          <input type="password" id="pass" class="form-control" name="password" placeholder="Password">
                      </div>
                      <div id="passError" style="color:red; font-size:13px; margin:2px 0 -5px 0;"><br></div>

                    </div>
                    <label>Confirm Password</label>
                    <div class="input-group">
                        <div class="form-line">
                            <input type="password" id="pass2" class="form-control" name="verpassword" placeholder="Confirm Password">
                        </div>
                        <div id="pass2Error" style="color:red; font-size:13px; margin:2px 0 -5px 0;"><br></div>

                    </div>
                    <div class="row">
                        <div class="col-xs-4 pull-right">
                            <button class="btn btn-block bg-pink waves-effect" id="submitButton">Submit</button>
                        </div>
                    </div>
                    <div class="row m-t-15 m-b--20">
                    </div>
                </form>
            </div>

        </div>
           <?php if(isset($error))
            {
                 echo  '<div class="alert alert-danger" id = "error">
                     <strong>Wrong Username or Password</strong>
                       </div>';
                }?>
    </div>

<script>

  setTimeout(function() {
    $("div #error").fadeOut();
  }, 5000);

</script>

    <!-- Jquery Core Js -->
    <script src="<?php echo base_url().'assets/plugins/jquery/jquery.min.js';?>"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?php echo base_url().'assets/plugins/bootstrap/js/bootstrap.min.js';?>"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?php echo base_url().'assets/plugins/node-waves/waves.js';?>"></script>

    <!-- Validation Plugin Js -->
    <script src="<?php echo base_url().'assets/plugins/jquery-validation/jquery.validate.js';?>"></script>

    <!-- Custom Js -->
    <script src="<?php echo base_url().'assets/js/admin.js'?>"></script>
    <script src="<?php echo base_url().'assets/js/pages/examples/sign-in.js';?>"></script>

</body>

<!-- RESET PASSWORD -->
<script>
  $('#submitButton').click(function(){
    var pass = $('#pass').val();
    var pass2 = $('#pass2').val();
    var id = '<?php echo $vendorid; ?>';
    var key = '<?php echo $vendorkey; ?>';
    var uname = $('#uname').val();

    $('#passError').html('<br>');
    $('#pass2Error').html('<br>');
    $('#unameError').html('<br>');

    if(pass.length > 5){
      if(pass == pass2){
        $.ajax({
          type: 'POST',
          data: {pass:pass, id:id, key:key, uname:uname},
          url: '<?php echo base_url("login/setUnamePass") ?>',
          success: function(data){
            if(data == 'true'){
              swal({
                title: 'Success!',
                text:'Password has been changed! You may now log in using your new password!',
                type: 'success'},
              function(){
                window.location.replace('<?php echo base_url(); ?>');
              });
            }else{
              $('#unameError').html('Username already exists!');
            }
          }
        });
      }else{
        $('#pass2Error').html('Passwords does not match!');
      }
    }else if(pass.length == 0){
      $('#passError').html('Password field is empty!');
    }else if(pass.length < 6){
      $('#passError').html('Password should be more than 6 characters!');
    }
  });
</script>
<!-- RESET PASSWORD END -->

</html>
