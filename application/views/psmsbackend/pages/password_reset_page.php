<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

    <!-- BEGIN HEAD -->
    <head>
        <meta charset="UTF-8" />
        <title>BCORE Admin Dashboard Template | Login Page</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!--[if IE]>
           <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
           <![endif]-->
        <!-- GLOBAL STYLES -->
        <!-- PAGE LEVEL STYLES -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>psmsbackendtheme/plugins/bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>psmsbackendtheme/css/login.css" />
        <!-- <link rel="stylesheet" href="assets/plugins/magic/magic.css" /> -->
        <!-- END PAGE LEVEL STYLES -->
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <link href="<?php echo base_url(); ?>psmsbackendtheme/plugins/jquery-validation-1.11.1/screen.css" rel="stylesheet" type="text/css"/>
    </head>
    <!-- END HEAD -->

    <!-- BEGIN BODY -->
    <body >

        <!-- PAGE CONTENT --> 
        <div class="container">
            <div class="row <?php if($page_msg === "unsuccess"){ echo "";}else{ echo "hide";} ?>" id="page_msg">
                <div class="container-fluid">
                    <div class="col-md-12" id="divmessage_3">
                        <div id="spnmessage_3" class="alert alert-danger alert-dismissible" role="alert">
                            Unable to reset the password!
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center">
                <img style="margin-bottom: -3%; margin-top: 6%;" src="<?php echo base_url(); ?>psmsbackendtheme/img/header_logo.png" id="logoimg" alt=" Logo" />
            </div>
            <div class="tab-content">
                <div id="login" class="tab-pane active">
                    <form id="first_time_password_reset" action="<?php echo base_url(); ?>index.php/login_c/password_reset_verification" class="form-signin" method="POST">
                        
                        <div style="margin-left: 24%; margin-top: 4%;"><strong>Please enter username to reset the password</strong></div>
                        <input type="text" id="username" name="username" class="form-control" readonly=""/>
                        
                        <button style="margin-top: 6%;" class="btn text-muted text-center btn-danger" type="submit">Reset Password</button>
                    </form>
                </div>
            </div>

        </div>

        <!--END PAGE CONTENT -->     

        <!-- PAGE LEVEL SCRIPTS -->
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/jquery-2.0.3.min.js"></script>
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/bootstrap/js/bootstrap.js"></script>
        <script src="<?php echo base_url(); ?>psmsbackendtheme/js/login.js"></script>

        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/jquery-validation-1.11.1/jquery.validate.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/jquery-validation-1.11.1/additional-methods.js" type="text/javascript"></script>
        <!--END PAGE LEVEL SCRIPTS -->

        <script>
            $(document).ready(function () {
                $("#first_time_password_reset").validate({
                    rules: {
                        new_password: {
                            required: true,
														minlength: 8
                        },
                        confirm_password: {
                            required: true,
                            equalTo: "#new_password"
                        }
                    },
                    messages: {
                        new_password: {
                            required: "Please provide a password",
                            minlength: "Your password must be at least 8 characters long"
                        },
                        confirm_password: {
                            required: "Please retype the password",
                            equalTo: "Please enter the same password as above"
                        }
                    }
                });
            });
        </script>  

    </body>
    <!-- END BODY -->
</html>
