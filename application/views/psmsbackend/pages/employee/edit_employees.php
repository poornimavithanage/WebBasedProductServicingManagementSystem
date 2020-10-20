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
                                <li><a style="text-decoration: none;" href="#" class="di">Edit Employee Details</a></li>
                            </ul>
                        </div>
                    </div><!--/.row-->

                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-md-2">
                            <div style="font-weight: bold; margin-left: 10%;">
                                <a href="<?php echo base_url(); ?>/index.php/employee_c/employee_view" class="btn btn-round-sm btn-sm btn-danger">Go Back</a>
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
                                <form class="form-horizontal" role="form" id="editemployeeform" method="POST" action="">
                                        <!-- Text input-->
                                        <!-- hidden field for include employee id : update the relevant record in db -->
                                        <div class="form-group hide" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Employee ID</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="emp_id" name="emp_id" value="<?php echo $employee_details[0]->emp_id; ?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-md-5 control-label" for="textinput">Employee Type</label>
                                            <div class="col-sm-5">
                                            <select class="form-control" id="emp_type" name="emp_type">                                                
                                            <!-- <option disabled selected value> - select type- </option> -->
                                            <?php 

                                                    echo"<option value='".$employee_details[0]->emp_type."'>".$employee_details[0]->emp_type."</option>";

                                                     ?>

                                                     <?php 
                                                    //not displaying Front Desk Officer if the result is Front Desk Officer
                                                    if($employee_details[0]->emp_type === 'Front Desk Officer'){

                                                        echo"<option value='Technician'>Technician</option>";
                                                        echo"<option value='Store Keeper'>Store Keeper</option>";
                                                        echo"<option value='Imports Officer'>Imports Officer</option>";
                                                        echo"<option value='Service Manager'>Service Manager</option>";
                                                       
                                                    
                                                    //not displaying Technician if the the result is Technician
                                                    }else if($employee_details[0]->emp_type === 'Technician'){

                                                        echo"<option value='Front Desk Officer'>Front Desk Officer</option>";
                                                        echo"<option value='Store Keeper'>Store Keeper</option>";
                                                        echo"<option value='Imports Officer'>Imports Officer</option>";
                                                        echo"<option value='Service Manager'>Service Manager</option>";
                                                        
                                                        
                                                    //not displaying Store Keeper if the the result is Store Keeper
                                                    }else if($employee_details[0]->emp_type === 'Store Keeper'){

                                                        echo"<option value='Front Desk Officer'>Front Desk Officer</option>";
                                                        echo"<option value='Technician'>Technician</option>";
                                                        echo"<option value='Imports Officer'>Imports Officer</option>";
                                                        echo"<option value='Service Manager'>Service Manager</option>";
                                                        
                                                        
                                                    //not displaying Imports Officer if the the result is Imports Officer
                                                    }else if($employee_details[0]->emp_type === 'Imports Officer'){

                                                        echo"<option value='Front Desk Officer'>Front Desk Officer</option>";
                                                        echo"<option value='Technician'>Technician</option>";
                                                        echo"<option value='Service Manager'>Service Manager</option>";
                                                        echo"<option value='Store Keeper'>Store Keeper</option>";
                                                       
                                                    
                                                    //not displaying Service Manager if the the result is Service Manager
                                                    }else if($employee_details[0]->emp_type === 'Imports Officer'){

                                                        echo"<option value='Front Desk Officer'>Front Desk Officer</option>";
                                                        echo"<option value='Technician'>Technician</option>";
                                                        echo"<option value='Imports Officer'>Imports Officer</option>";
                                                        echo"<option value='Store Keeper'>Store Keeper</option>";
                                                        
                                                    
                                                    }            
                                                    ?>
                                            </select>
                                        </div>
                                    </div>
 
                                            
                                       
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Employee Name</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="emp_name" name="emp_name" value="<?php echo $employee_details[0]->emp_name; ?>"class="form-control">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Email Address</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="email" name="email" value="<?php echo $employee_details[0]->email; ?>" class="form-control">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Contact No</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="contact_1" name="contact_1" value="<?php echo $employee_details[0]->contact_1; ?>" class="form-control">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Contact No</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="contact_2" name="contact_2" value="<?php echo $employee_details[0]->contact_2; ?>"class="form-control">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">NIC</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="NIC" name="NIC" value="<?php echo $employee_details[0]->NIC; ?>" class="form-control">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Address</label>
                                            <div class="col-sm-5">
                                                <textarea id="Address" name="Address" rows="3" cols="4" class="form-control"><?php echo $employee_details[0]->Address; ?></textarea>
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
                $("#editemployeeform").validate({
                    rules: {
                        emp_type: "required",
                        emp_name: "required",
                        email: "required",
                        contact_1: "required",
                        contact_2: "required",
                        NIC: "required",
                        Address: "required"
                    },
                    messages: {
                        emp_type: "Please select employee type",
                        emp_name: "Please enter name",
                        email: "Please enter email address",
                        contact_1: "Please enter mobile no",
                        contact_2: "Please enter telephone no",
                        NIC: "Please enter NIC",
                        Address: "Please enter address"

                    }
                });
            });
        </script>
        
        <!-- this Jquery handles the add customer function : Edit customer modal form -->
        <script>
            $(document).ready(function () {
                baseurl = "http://localhost/psms/";
                $("#editemployeeform").submit(function (e) {
                    e.preventDefault();
                    if (!$(this).valid())
                        return false;
                    $.ajax({
                        type: "POST",
                        url: baseurl + "index.php/employee_c/edit_employees",
                        data: $("#editemployeeform").serialize(),
                        dataType: 'json',
                        success: function (data) {
                            //console.log(data);
                            if (data.final_result === "success") {
                                $('#editemployeeform')[0].reset();
                                $("#spnmessage").removeAttr("class", "alert alert-danger");
                                $("#spnmessage").attr("class", "alert alert-success");
                                $("#spnmessage").html('<p><strong>Employee details changes was successful!</strong></p>');
                                $("#divmessage").removeAttr("class", "hide");
                                $("#divmessage").fadeIn(1500);
                                $("#divmessage").delay(3500).fadeOut(2500);
                                setTimeout(function () {
                                    //location.reload();
                                    window.location.href = "<?php echo base_url(); ?>/index.php/employee_c/employee_view";
                                }, 4000);
                            } else if (data.final_result === "unsuccess") {
                                $("#spnmessage").removeAttr("class", "alert alert-success");
                                $("#spnmessage").attr("class", "alert alert-danger");
                                $("#spnmessage").html('<p><strong>Unable to change employee details please contact IT Department!</strong></p>');
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

