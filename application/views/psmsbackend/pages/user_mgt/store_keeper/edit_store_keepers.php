<!DOCTYPE html>
<html lang="en">

    <head>

        <!-- META -->
        <?php $this->load->view('psmsbackend/template/meta'); ?>
        <!-- END META -->
        <!-- Core CSS -->
        <?php $this->load->view('psmsbackend/template/head_css'); ?>
        <!-- END Core CSS -->
        <!-- Page Level CSS -->
        <!--<link href="<?php //echo base_url();  ?>psmsbackendtheme/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />-->
        <link href="//cdn.datatables.net/1.10.16/css/dataTables.bootstrap.css" rel="stylesheet"/>
        <style>
            .modal-dialog {
                width: 60%;
                /*   height: 100%; */
                padding: 10%;
            }

            .modal-content {
                height: 100%;
                border-radius: 0;
            }
        </style>
        <link href="<?php echo base_url(); ?>psmsbackendtheme/plugins/jquery-validation-1.11.1/screen.css" rel="stylesheet" type="text/css"/>




    </head>
    <body class="padTop53 " >

        <!-- MAIN WRAPPER -->
        <div id="wrap">


            <!-- HEADER SECTION -->
            <?php $this->load->view('psmsbackend/template/header'); ?>
            <!-- END HEADER SECTION -->

            <!-- MENU SECTION -->
            <?php $this->load->view('psmsbackend/template/navigation'); ?>
            <!--END MENU SECTION -->

            <!--PAGE CONTENT -->
            <div id="content">
                <div class="inner" style="min-height:1200px;">
                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <ul class="breadcrumb">
                                <li><a style="text-decoration: none;" href="#">Dashboard</a></li>
                                <li><a style="text-decoration: none;" href="#" class="di">Edit Store Keeper Details</a></li>
                            </ul>
                        </div>
                    </div><!--/.row-->

                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-md-2">
                            <div style="font-weight: bold; margin-left: 10%;">
                                <a href="<?php echo base_url(); ?>/index.php/store_keeper_c/store_keeper_view" class="btn btn-round-sm btn-sm btn-danger">Go Back</a>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-md-12">
                           <hr>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12 hide" id="divmessage">
                                <div id="spnmessage" class="alert alert-success alert-dismissible" role="alert">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-md-12">
                            <div class="col-lg-12">
                                <form class="form-horizontal" role="form" id="editstorekeeperform" method="POST" action="">
                                        <!-- Text input-->
                                        <!-- hidden field for include store_keeper_id : update the relevant record in db -->
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Code No</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="store_keeper_id" name="store_keeper_id" value="<?php echo $store_keeper_details[0]->store_keeper_id; ?>" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">First Name</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="store_keeper_first_name" name="store_keeper_first_name" value="<?php echo $store_keeper_details[0]->store_keeper_first_name; ?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Last Name</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="store_keeper_last_name" name="store_keeper_last_name" value="<?php echo $store_keeper_details[0]->store_keeper_last_name; ?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-md-5 control-label" for="textinput">Gender</label>
                                            <div class="col-sm-5">
                                                <select class="form-control" id="store_keeper_gender" name="store_keeper_gender">                                                
                                                    <!-- <option disabled selected value> - select category- </option> -->
                                                    <?php 

                                                    echo"<option value='".$store_keeper_details[0]->store_keeper_gender."'>".$store_keeper_details[0]->store_keeper_gender."</option>";

                                                     ?>

                                                     <?php 

                                                     //not displaying Female if the result is Female
                                                    if($store_keeper_details[0]->store_keeper_gender === 'Female'){

                                                        echo"<option value='Male'>Male</option>";
                                                        

                                                    //not displaying Male if the result is Male    
                                                    }else if($store_keeper_details[0]->store_keeper_gender === 'Male'){

                                                        echo"<option value='Female'>Female</option>";
                                                        
                                                    }
                                                    

                                                     ?>

                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Email</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="store_keeper_email" name="store_keeper_email" value="<?php echo $store_keeper_details[0]->store_keeper_email; ?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Contact No</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="store_keeper_contact" name="store_keeper_contact" value="<?php echo $store_keeper_details[0]->store_keeper_contact; ?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">NIC</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="store_keeper_nic" name="store_keeper_nic" value="<?php echo $store_keeper_details[0]->store_keeper_nic; ?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12" style="margin-left: 55%;">
                                                <div class="pull-left">
                                                    <input type="submit" class="btn btn-primary" value="Save Changes" />
                                                    <input type="reset" class="btn btn-warning" value="Reset" />
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>                                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        

        <!-- FOOTER -->
        <?php $this->load->view('psmsbackend/template/footer'); ?>
        <!--END FOOTER -->
        <!-- GLOBAL SCRIPTS -->
        <?php $this->load->view('psmsbackend/template/head_js'); ?>
        <!--<script src="<?php //echo base_url();  ?>psmsbackendtheme/plugins/dataTables/jquery.dataTables.js"></script>-->
        <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="//cdn.datatables.net/1.10.16/js/dataTables.bootstrap.js" type="text/javascript"></script>
        <!--<script src="<?php //echo base_url();  ?>psmsbackendtheme/plugins/dataTables/dataTables.bootstrap.js"></script>-->
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/jquery-validation-1.11.1/jquery.validate.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/jquery-validation-1.11.1/additional-methods.js" type="text/javascript"></script>

         <script>
            $(document).ready(function () {
                $('.dataTables-example').dataTable(); // jquery-bootstrap datatable 
            });
        </script>

        <!-- This handles the edit customer modal form field validation -->
        <script>
            $(document).ready(function () {
                $("#editstorekeeperform").validate({
                    rules: {
                        store_keeper_id: "required",
                        store_keeper_first_name: "required",
                        store_keeper_last_name: "required",
                        store_keeper_gender: "required",
                        store_keeper_email: "required",
                        store_keeper_contact: "required",
                        store_keeper_nic: "required"
                    },
                    messages: {
                        store_keeper_id: "Please enter code no",
                        store_keeper_first_name: "Please enter first name",
                        store_keeper_last_name: "Please enter last name",
                        store_keeper_gender: "Please select gender",
                        store_keeper_email: "Please enter email",
                        store_keeper_contact: "Please enter contact",
                        store_keeper_nic: "Please enter NIC"

                    }
                });
            });
        </script>
        
        <!-- this J query handles the add store_keeper function : Edit store_keeper modal form -->
        <script>
            $(document).ready(function () {
                baseurl = "http://localhost/psms/";
                $("#editstorekeeperform").submit(function (e) {
                    e.preventDefault();
                    if (!$(this).valid())
                        return false;
                    $.ajax({
                        type: "POST",
                        url: baseurl + "index.php/store_keeper_c/edit_store_keepers",
                        data: $("#editstorekeeperform").serialize(),
                        dataType: 'json',
                        success: function (data) {
                            //console.log(data);
                            if (data.final_result === "success") {
                                $('#editstorekeeperform')[0].reset();
                                $("#spnmessage").removeAttr("class", "alert alert-danger");
                                $("#spnmessage").attr("class", "alert alert-success");
                                $("#spnmessage").html('<p><strong>Store Keeper details changes were successful!</strong></p>');
                                $("#divmessage").removeAttr("class", "hide");
                                $("#divmessage").fadeIn(1500);
                                $("#divmessage").delay(3500).fadeOut(2500);
                                setTimeout(function () {
                                    //location.reload();
                                    window.location.href = "<?php echo base_url(); ?>/index.php/store_keeper_c/store_keeper_view";
                                }, 5000);
                            } else if (data.final_result === "unsuccess") {
                                $("#spnmessage").removeAttr("class", "alert alert-success");
                                $("#spnmessage").attr("class", "alert alert-danger");
                                $("#spnmessage").html('<p><strong>Unable to change store keeper details please contact IT Department!</strong></p>');
                                $("#divmessage").removeAttr("class", "hide");
                                $("#divmessage").fadeIn(1500);
                                $("#divmessage").delay(2500).fadeOut(1500);
                            }
                        }
                    });
                });
            });
        </script>
    </body>    
</html>


