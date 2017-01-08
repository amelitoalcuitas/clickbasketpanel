<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sign In | ClickBasket Panel</title>
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

    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);">Click<b>Basket</b></a>
            <small>Managing made easy</small>
        </div>
        <div class="card">
            <div class="body">

                <?php echo form_open('login/checkLogin','sign_in');?>
                    <div class="msg"></div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="username" placeholder="Username"  autofocus>
                        </div>
                         <?php echo form_error('username','<div id="error" style="color:red; margin-bottom:-20px">','</div>');?>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                       <?php echo form_error('password','<div id="error" style="color:red; margin-bottom:-20px">','</div>');?>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                            <label for="rememberme">Remember Me</label>
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-pink waves-effect" type="submit">SIGN IN</button>
                        </div>
                    </div>
                    <?php echo form_close();?>
                    <div class="row m-t-15 m-b--20">

                        <div class="col-xs-12 align-right">
                            <a href="#" data-toggle="modal" data-target="#forgotPass">Forgot Password?</a>
                        </div>
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
  function getKey(){
    var key = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for( var i=0; i < 32; i++){
      key += possible.charAt(Math.floor(Math.random() * possible.length));
    }

    return key;
  }

  $('#resetPass').click(function(){
    var email = $('#resetpassemail').val();
    var key = getKey();

    if(email.length > 0){ //------------------------------ CHANGE THIS LINE ----------------------------------------//
      $.ajax({
        type: 'POST',
        data: {email:email, key:key},
        url: '<?php echo base_url("login/forgotPass"); ?>',
        success: function(data){
          if(data == 'failed'){
            $('#errorForgotPass').html('Email is invalid!');
          }else{
            $('#forgotPass').modal('hide');
            swal('Success!','Please check your email for the instructions.','success');
          }
        }
      });
    }else{
      $('#errorForgotPass').html('Please enter your email!');
    }

  });

  $('#forgotPass').on('hidden.bs.modal',function(){
    $('#errorForgotPass').html('</br>');
  });
</script>
<!-- RESET PASSWORD END -->

</html>
