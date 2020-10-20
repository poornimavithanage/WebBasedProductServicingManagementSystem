<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

<!-- BEGIN HEAD -->
<head>
     <meta charset="UTF-8" />
    <title>Swedish Trading Audio Visual (Pvt) Ltd</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
     <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <!-- GLOBAL STYLES -->
     <!-- PAGE LEVEL STYLES -->
     <link rel="icon" type="image/ico" href="<?php echo base_url(); ?>psmsbackendtheme/img/ico.png">
     <link rel="stylesheet" href="<?php echo base_url(); ?>psmsbackendtheme/plugins/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>psmsbackendtheme/css/login.css" />
    <!-- <link rel="stylesheet" href="assets/plugins/magic/magic.css" /> -->
     <!-- END PAGE LEVEL STYLES -->
   <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
    <!-- END HEAD -->

    <!-- BEGIN BODY -->
<body >

   <!-- PAGE CONTENT --> 
    <div class="container">
        
        
    <div class="text-center">
        <img style="margin-bottom: -3%;" src="<?php echo base_url(); ?>psmsbackendtheme/img/header_logo.png" id="logoimg" alt=" Logo" />
    </div>
    <div class="tab-content">
        <div id="login" class="tab-pane active">
            <form action="<?php echo base_url(); ?>index.php/customer_web_portal_c/new_password_submit" class="form-signin" method="POST">
<!--                <p class="text-muted text-center btn-block btn btn-primary btn-rect">
                    Enter your username and password
                </p>-->
                
                <input type="text" value="<?php echo $username; ?>" id="new_username" name="new_username" placeholder="Username" class="form-control" />
                <input type="text" id="new_password" name="new_password" placeholder="New Passsword" class="form-control" />
                <input type="text" id="confirm_new_username" name="confirm_new_username" placeholder="Confirm Password" class="form-control" />
                <button style="margin-top: 4%; margin-left: 26%;" class="btn text-muted text-center btn-danger" type="submit">Reset Password</button>
            </form>
        </div>
    </div>

    


</div>

	  <!--END PAGE CONTENT -->     
	      
      <!-- PAGE LEVEL SCRIPTS -->
      <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/jquery-2.0.3.min.js"></script>
      <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/bootstrap/js/bootstrap.js"></script>
   <script src="<?php echo base_url(); ?>psmsbackendtheme/js/login.js"></script>
      <!--END PAGE LEVEL SCRIPTS -->

</body>
    <!-- END BODY -->
</html>
