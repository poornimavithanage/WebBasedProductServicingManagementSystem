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
                                <li><a style="text-decoration: none;" href="#" class="di">Edit Supplier Details</a></li>
                            </ul>
                        </div>
                    </div><!--/.row-->

                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-md-2">
                            <div style="font-weight: bold; margin-left: 10%;">
                                <a href="<?php echo base_url(); ?>/index.php/supplier_c/supplier_view" class="btn btn-round-sm btn-sm btn-danger">Go Back</a>
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
                                <form class="form-horizontal" role="form" id="editsupplierform" method="POST" action="">
                                        <!-- Text input-->
                                        <!-- hidden field for include supplier id : update the relevant record in db -->
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Supplier ID</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="supp_id" name="supp_id" value="<?php echo $supplier_details[0]->supp_id; ?>" class="form-control" readonly>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Supplier Name</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="supp_name" name="supp_name" value="<?php echo $supplier_details[0]->supp_name; ?>"class="form-control">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Supplier Address</label>
                                            <div class="col-sm-5">
                                                <textarea id="supp_address" name="supp_address" rows="3" cols="4" class="form-control"><?php echo $supplier_details[0]->supp_address; ?></textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Contact</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="sup_contact" name="sup_contact" value="<?php echo $supplier_details[0]->sup_contact; ?>" class="form-control">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">E-mail</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="sup_email" name="sup_email" value="<?php echo $supplier_details[0]->sup_email; ?>"class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Fax</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="fax" name="fax" value="<?php echo $supplier_details[0]->fax; ?>" class="form-control">
                                            </div>
                                        </div>
                               
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-md-5 control-label" for="textinput">Category</label>
                                            <div class="col-sm-5">
                                                <select class="form-control" id="category" name="category">                                                
                                                    <!-- <option disabled selected value> - select category- </option> -->
                                                    <?php 

                                                    echo"<option value='".$supplier_details[0]->category."'>".$supplier_details[0]->category."</option>";

                                                     ?>

                                                     <?php 

                                                     //not displaying Amplifiers if the result is Amplifiers
                                                    if($supplier_details[0]->category === 'Amplifiers'){

                                                        echo"<option value='Projectors'>Projectors</option>";
                                                        echo"<option value='Mixers'>Mixers</option>";
                                                        echo"<option value='Microphones'>Microphones</option>";
                                                        echo"<option value='Electronics'>Electronics</option>";
                                                        echo"<option value='Speakers'>Speakers</option>";
                                                        echo"<option value='Conference'>Conference</option>";

                                                    //not displaying Projectors if the result is Projectors    
                                                    }else if($supplier_details[0]->category === 'Projectors'){

                                                        echo"<option value='Mixers'>Mixers</option>";
                                                        echo"<option value='Microphones'>Microphones</option>";
                                                        echo"<option value='Electronics'>Electronics</option>";
                                                        echo"<option value='Speakers'>Speakers</option>";
                                                        echo"<option value='Conference'>Conference</option>";
                                                        echo"<option value='Amplifiers'>Amplifiers</option>";

                                                    //not displaying Mixers if the result is Mixers
                                                    }else if($supplier_details[0]->category === 'Mixers'){

                                                        echo"<option value='Projectors'>Projectors</option>";
                                                        echo"<option value='Microphones'>Microphones</option>";
                                                        echo"<option value='Electronics'>Electronics</option>";
                                                        echo"<option value='Speakers'>Speakers</option>";
                                                        echo"<option value='Conference'>Conference</option>";
                                                        echo"<option value='Amplifiers'>Amplifiers</option>";
                                                        
                                                    //not displaying Microphones if the result is Microphones
                                                    }else if($supplier_details[0]->category === 'Microphones'){

                                                        echo"<option value='Projectors'>Projectors</option>";
                                                        echo"<option value='Mixers'>Mixers</option>";
                                                        echo"<option value='Electronics'>Electronics</option>";
                                                        echo"<option value='Speakers'>Speakers</option>";
                                                        echo"<option value='Conference'>Conference</option>";
                                                        echo"<option value='Amplifiers'>Amplifiers</option>";
                                                    
                                                    //not displaying Speakers if the result is Speakers
                                                    }else if($supplier_details[0]->category === 'Speakers'){

                                                        echo"<option value='Projectors'>Projectors</option>";
                                                        echo"<option value='Mixers'>Mixers</option>";
                                                        echo"<option value='Electronics'>Electronics</option>";
                                                        echo"<option value='Microphones'>Microphones</option>";
                                                        echo"<option value='Conference'>Conference</option>";
                                                        echo"<option value='Amplifiers'>Amplifiers</option>";

                                                    //not displaying Conference if the result is Conference
                                                    }else if($supplier_details[0]->category === 'Conference'){

                                                        echo"<option value='Projectors'>Projectors</option>";
                                                        echo"<option value='Microphones'>Microphones</option>";
                                                        echo"<option value='Electronics'>Electronics</option>";
                                                        echo"<option value='Speakers'>Speakers</option>";
                                                        echo"<option value='Mixers'>Mixers</option>";
                                                        echo"<option value='Amplifiers'>Amplifiers</option>";
                                                        
                                                    //not displaying Microphones if the result is Microphones
                                                    }else{ 

                                                        echo"<option value='Projectors'>Projectors</option>";
                                                        echo"<option value='Amplifiers'>Amplifiers</option>";
                                                        echo"<option value='Mixers'>Mixers</option>";
                                                        echo"<option value='Microphones'>Microphones</option>";
                                                        echo"<option value='Speakers'>Speakers</option>";
                                                        echo"<option value='Conference'>Conference</option>";
                                                    }

                                                     ?>

                                                    
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Brand</label>
                                            <div class="col-sm-5">
                                                <select class="form-control" id="brand" name="brand">
                                                    <?php 

                                                    echo"<option value='".$supplier_details[0]->brand."'>".$supplier_details[0]->brand."</option>";

                                                     ?>

                                                    <?php 

                                                        if($supplier_details[0]->brand === 'Infocus'){

                                                            echo"<option value='Inter-M'>Inter-M</option>";
                                                            echo"<option value='Panasonic'>Panasonic</option>";
                                                            echo"<option value='Shure'>Shure</option>";
                                                            echo"<option value='Kramer'>Kramer</option>";
                                                            echo"<option value='Zoom'>Zoom</option>";
                                                            echo"<option value='Hi-Tone'>Hi-Tone</option>";
                                                            echo"<option value='Peavey'>Peavey</option>";
                                                            echo"<option value='Lite-Puter'>Lite-Puter</option>";
                                                            echo"<option value='Polycom'>Polycom</option>";
                                                        
                                                        }else if($supplier_details[0]->brand === 'Inter-M'){

                                                            echo"<option value='Infocus'>Infocus</option>";
                                                            echo"<option value='Panasonic'>Panasonic</option>";
                                                            echo"<option value='Shure'>Shure</option>";
                                                            echo"<option value='Kramer'>Kramer</option>";
                                                            echo"<option value='Zoom'>Zoom</option>";
                                                            echo"<option value='Hi-Tone'>Hi-Tone</option>";
                                                            echo"<option value='Peavey'>Peavey</option>";
                                                            echo"<option value='Lite-Puter'>Lite-Puter</option>";
                                                            echo"<option value='Polycom'>Polycom</option>";

                                                        }else if($supplier_details[0]->brand === 'Panasonic'){

                                                            echo"<option value='Infocus'>Infocus</option>";
                                                            echo"<option value='Inter-M'>Inter-M</option>";
                                                            echo"<option value='Shure'>Shure</option>";
                                                            echo"<option value='Kramer'>Kramer</option>";
                                                            echo"<option value='Zoom'>Zoom</option>";
                                                            echo"<option value='Hi-Tone'>Hi-Tone</option>";
                                                            echo"<option value='Peavey'>Peavey</option>";
                                                            echo"<option value='Lite-Puter'>Lite-Puter</option>";
                                                            echo"<option value='Polycom'>Polycom</option>";
                                                            
                                                        }else if($supplier_details[0]->brand === 'Shure'){

                                                            echo"<option value='Infocus'>Infocus</option>";
                                                            echo"<option value='Inter-M'>Inter-M</option>";
                                                            echo"<option value='Panasonic'>Panasonic</option>";
                                                            echo"<option value='Kramer'>Kramer</option>";
                                                            echo"<option value='Zoom'>Zoom</option>";
                                                            echo"<option value='Hi-Tone'>Hi-Tone</option>";
                                                            echo"<option value='Peavey'>Peavey</option>";
                                                            echo"<option value='Lite-Puter'>Lite-Puter</option>";
                                                            echo"<option value='Polycom'>Polycom</option>";
                                                            
                                                        }else if($supplier_details[0]->brand === 'Kramer'){

                                                            echo"<option value='Infocus'>Infocus</option>";
                                                            echo"<option value='Inter-M'>Inter-M</option>";
                                                            echo"<option value='Panasonic'>Panasonic</option>";
                                                            echo"<option value='Shure'>Shure</option>";
                                                            echo"<option value='Zoom'>Zoom</option>";
                                                            echo"<option value='Hi-Tone'>Hi-Tone</option>";
                                                            echo"<option value='Peavey'>Peavey</option>";
                                                            echo"<option value='Lite-Puter'>Lite-Puter</option>";
                                                            echo"<option value='Polycom'>Polycom</option>";
                                                            
                                                        }else if($supplier_details[0]->brand === 'Zoom'){

                                                            echo"<option value='Infocus'>Infocus</option>";
                                                            echo"<option value='Inter-M'>Inter-M</option>";
                                                            echo"<option value='Panasonic'>Panasonic</option>";
                                                            echo"<option value='Shure'>Shure</option>";
                                                            echo"<option value='Kramer'>Kramer</option>";
                                                            echo"<option value='Hi-Tone'>Hi-Tone</option>";
                                                            echo"<option value='Peavey'>Peavey</option>";
                                                            echo"<option value='Lite-Puter'>Lite-Puter</option>";
                                                            echo"<option value='Polycom'>Polycom</option>";
                                                            
                                                        }else if($supplier_details[0]->brand === 'Hi-Tone'){

                                                            echo"<option value='Infocus'>Infocus</option>";
                                                            echo"<option value='Inter-M'>Inter-M</option>";
                                                            echo"<option value='Panasonic'>Panasonic</option>";
                                                            echo"<option value='Shure'>Shure</option>";
                                                            echo"<option value='Kramer'>Kramer</option>";
                                                            echo"<option value='Zoom'>Zoom</option>";
                                                            echo"<option value='Peavey'>Peavey</option>";
                                                            echo"<option value='Lite-Puter'>Lite-Puter</option>";
                                                            echo"<option value='Polycom'>Polycom</option>";
                                                            
                                                        }else if($supplier_details[0]->brand === 'Peavey'){

                                                            echo"<option value='Infocus'>Infocus</option>";
                                                            echo"<option value='Inter-M'>Inter-M</option>";
                                                            echo"<option value='Panasonic'>Panasonic</option>";
                                                            echo"<option value='Shure'>Shure</option>";
                                                            echo"<option value='Kramer'>Kramer</option>";
                                                            echo"<option value='Zoom'>Zoom</option>";
                                                            echo"<option value='Hi-Tone'>Hi-Tone</option>";
                                                            echo"<option value='Lite-Puter'>Lite-Puter</option>";
                                                            echo"<option value='Polycom'>Polycom</option>";
                                                            
                                                        }else if($supplier_details[0]->brand === 'Lite-Puter'){

                                                            echo"<option value='Infocus'>Infocus</option>";
                                                            echo"<option value='Inter-M'>Inter-M</option>";
                                                            echo"<option value='Panasonic'>Panasonic</option>";
                                                            echo"<option value='Shure'>Shure</option>";
                                                            echo"<option value='Kramer'>Kramer</option>";
                                                            echo"<option value='Zoom'>Zoom</option>";
                                                            echo"<option value='Hi-Tone'>Hi-Tone</option>";
                                                            echo"<option value='Peavey'>Peavey</option>";
                                                            echo"<option value='Polycom'>Polycom</option>";

                                                        }else{

                                                            echo"<option value='Infocus'>Infocus</option>";
                                                            echo"<option value='Inter-M'>Inter-M</option>";
                                                            echo"<option value='Panasonic'>Panasonic</option>";
                                                            echo"<option value='Shure'>Shure</option>";
                                                            echo"<option value='Kramer'>Kramer</option>";
                                                            echo"<option value='Zoom'>Zoom</option>";
                                                            echo"<option value='Hi-Tone'>Hi-Tone</option>";
                                                            echo"<option value='Peavey'>Peavey</option>";
                                                            echo"<option value='Lite-Puter'>Lite-Puter</option>";
                                                        }


                                                    ?>
                                                    
                                                </select>
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
                $("#editsupplierform").validate({
                    rules: {
                        supp_name: "required",
                        supp_address: "required",
                        sup_contact: "required",
                        sup_email: "required",
                        fax: "required",
                        category: "required",
                        brand: "required"
                    },
                    messages: {
                        supp_name: "Please enter supplier name",
                        supp_address: "Please enter address",
                        sup_contact: "Please enter contact no",
                        fax: "Please enter fax no",
                        category: "Please select category",
                        brand: "Please select brand"

                    }
                });
            });
        </script>
        
        <!-- this Jquery handles the add supplier function : Edit supplier modal form -->
        <script>
            $(document).ready(function () {
                baseurl = "http://localhost/psms/";
                $("#editsupplierform").submit(function (e) {
                    e.preventDefault();
                    if (!$(this).valid())
                        return false;
                    $.ajax({
                        type: "POST",
                        url: baseurl + "index.php/supplier_c/edit_suppliers",
                        data: $("#editsupplierform").serialize(),
                        dataType: 'json',
                        success: function (data) {
                            //console.log(data);
                            if (data.final_result === "success") {
                                $('#editsupplierform')[0].reset();
                                $("#spnmessage").removeAttr("class", "alert alert-danger");
                                $("#spnmessage").attr("class", "alert alert-success");
                                $("#spnmessage").html('<p><strong>supplier detail changes was successful!</strong></p>');
                                $("#divmessage").removeAttr("class", "hide");
                                $("#divmessage").fadeIn(1500);
                                $("#divmessage").delay(3500).fadeOut(2500);
                                setTimeout(function () {
                                    //location.reload();
                                    window.location.href = "<?php echo base_url(); ?>/index.php/supplier_c/supplier_view";
                                }, 5000);
                            } else if (data.final_result === "unsuccess") {
                                $("#spnmessage").removeAttr("class", "alert alert-success");
                                $("#spnmessage").attr("class", "alert alert-danger");
                                $("#spnmessage").html('<p><strong>Unable to change supplier details please contact IT Department!</strong></p>');
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

