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
                    <form action="<?php echo base_url(); ?>index.php/customer_web_portal_c/reset_password_request" class="form-signin" method="POST">
        <!--                <p class="text-muted text-center btn-block btn btn-primary btn-rect">
                            Enter your username and password
                        </p>-->
                        <p style="color: black;"><strong>Please enter the username</strong></p>
                        <input type="text" id="username" name="username" placeholder="Username" class="form-control" />
                        <button style="margin-top: 4%; margin-left: 15%;" class="btn text-muted text-center btn-danger" type="submit">Reset Password</button>
                    </form>
                </div>
            </div>

            <div class="row <?php
            if ($page_msg === "invalid_user") {
                echo "";
            } else {
                echo "hide";
            }
            ?>" id="pg_msg_1">
                <div class="container-fluid">
                    <div class="col-md-12" id="divmessage_3">
                        <div id="spnmessage_3" class="alert alert-danger alert-dismissible" role="alert">
                            <strong>Invalid Username!</strong> 
                        </div>
                    </div>
                </div>
            </div>

            <div class="row <?php
            if ($page_msg === "unsuccess") {
                echo "";
            } else {
                echo "hide";
            }
            ?>" id="pg_msg_2">
                <div class="container-fluid">
                    <div class="col-md-12" id="divmessage_3">
                        <div id="spnmessage_3" class="alert alert-danger alert-dismissible" role="alert">
                            <strong>Unable to reset the password</strong> 
                        </div>
                    </div>
                </div>
            </div>

            <div class="row <?php
            if ($page_msg === "unsuccess_sms") {
                echo "";
            } else {
                echo "hide";
            }
            ?>" id="pg_msg_3">
                <div class="container-fluid">
                    <div class="col-md-12" id="divmessage_3">
                        <div id="spnmessage_3" class="alert alert-danger alert-dismissible" role="alert">
                            <strong>Verification code SMS unable to send, Please check network connection and try again</strong> 
                        </div>
                    </div>
                </div>
            </div>

            


        </div>

        <!--END PAGE CONTENT -->     

        <!-- PAGE LEVEL SCRIPTS -->
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/jquery-2.0.3.min.js"></script>
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/bootstrap/js/bootstrap.js"></script>
        <script src="<?php echo base_url(); ?>psmsbackendtheme/js/login.js"></script>
        <!--END PAGE LEVEL SCRIPTS -->


        <script>
            $(document).ready(function () {
                setTimeout(function () {
                    $('#pg_msg_1').attr('class', 'row hide');
                }, 4000);
            });
        </script>

        <script>
            $(document).ready(function () {
                setTimeout(function () {
                    $('#pg_msg_2').attr('class', 'row hide');
                }, 4000);
            });
        </script>

        <script>
            $(document).ready(function () {
                setTimeout(function () {
                    $('#pg_msg_3').attr('class', 'row hide');
                }, 4000);
            });
        </script>

        <script>
            $(document).ready(function () {
                setTimeout(function () {
                    $('#pg_msg_4').attr('class', 'row hide');
                }, 4000);
            });
        </script>



    </body>
    <!-- END BODY -->
</html>
