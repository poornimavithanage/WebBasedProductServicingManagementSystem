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
                                <li><a style="text-decoration: none;" href="#" class="di">Add Products</a></li>
                            </ul>
                        </div>
                    </div><!--/.row-->

                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-md-2">
                            <div style="font-weight: bold; margin-left: 10%;">
                                <a href="<?php echo base_url(); ?>/index.php/products_c/products_view" class="btn btn-round-sm btn-sm btn-danger">Go Back</a>
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
                                <form class="form-horizontal" role="form" id="editproductform" method="POST" action="">
                                        <!-- Text input-->
                                        <!-- hidden field for include product id : update the relevant record in db -->
                                        <div class="form-group hide" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Product ID</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="product_id" name="product_id" value="<?php echo $product_details[0]->item_product_m_id; ?>" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-md-5 control-label" for="textinput">Category</label>
                                            <div class="col-sm-5">
                                                <select class="form-control" id="category" name="category">                                                
                                                    <!-- <option disabled selected value> - select category- </option> -->
                                                    <?php 

                                                    echo"<option value='".$product_details[0]->category."'>".$product_details[0]->category."</option>";

                                                     ?>

                                                     <?php 

                                                     //not displaying Amplifiers if the result is Amplifiers
                                                    if($product_details[0]->category === 'Amplifiers'){

                                                        echo"<option value='Projectors'>Projectors</option>";
                                                        echo"<option value='Mixers'>Mixers</option>";
                                                        echo"<option value='Microphones'>Microphones</option>";
                                                        echo"<option value='Conference'>Conference</option>";
                                                        echo"<option value='Electronics'>Electronics</option>";

                                                    //not displaying Projectors if the result is Projectors    
                                                    }else if($product_details[0]->category === 'Projectors'){

                                                        echo"<option value='Amplifiers'>Amplifiers</option>";
                                                        echo"<option value='Mixers'>Mixers</option>";
                                                        echo"<option value='Microphones'>Microphones</option>";
                                                        echo"<option value='Conference'>Conference</option>";
                                                        echo"<option value='Electronics'>Electronics</option>";
                                                        
                                                    //not displaying Mixers if the result is Mixers
                                                    }else if($product_details[0]->category === 'Mixers'){

                                                        echo"<option value='Projectors'>Projectors</option>";
                                                        echo"<option value='Amplifiers'>Amplifiers</option>";
                                                        echo"<option value='Microphones'>Microphones</option>";
                                                        echo"<option value='Conference'>Conference</option>";
                                                        echo"<option value='Electronics'>Electronics</option>";
                                                        
                                                    //not displaying Conference if the result is Conference
                                                    }else if($product_details[0]->category === 'Conference') {    
                                                        echo"<option value='Projectors'>Projectors</option>";
                                                        echo"<option value='Amplifiers'>Amplifiers</option>";
                                                        echo"<option value='Microphones'>Microphones</option>";
                                                        echo"<option value='Electronics'>Electronics</option>";
                                                        echo"<option value='Mixers'>Mixers</option>";
                                                        
                                                    //not displaying Conference if the result is Electronics
                                                    }else if($product_details[0]->category === 'Electronics') {    
                                                        echo"<option value='Projectors'>Projectors</option>";
                                                        echo"<option value='Amplifiers'>Amplifiers</option>";
                                                        echo"<option value='Microphones'>Microphones</option>";
                                                        echo"<option value='Conference'>Conference</option>";
                                                        echo"<option value='Mixers'>Mixers</option>";
                                                        
                                                    //not displaying Microphones if the result is Microphones
                                                    }else{ 

                                                        echo"<option value='Projectors'>Projectors</option>";
                                                        echo"<option value='Amplifiers'>Amplifiers</option>";
                                                        echo"<option value='Mixers'>Mixers</option>";
                                                        echo"<option value='Electronics'>Electronics</option>";
                                                        echo"<option value='Conference'>Conference</option>";
                                                    }

                                                     ?>

                                                    <!-- <option value="Projectors">Projectors</option>
                                                    <option value="Amplifiers">Amplifiers</option>
                                                    <option value="Mixers">Mixers</option>
                                                    <option value="Microphones">Microphones</option> -->
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Brand</label>
                                            <div class="col-sm-5">
                                                <select class="form-control" id="brand" name="brand">
                                                    <?php 

                                                    echo"<option value='".$product_details[0]->brand."'>".$product_details[0]->brand."</option>";

                                                     ?>

                                                    <?php 

                                                        if($product_details[0]->brand === 'Infocus'){

                                                            echo"<option value='Inter-M'>Inter-M</option>";
                                                            echo"<option value='Panasonic'>Panasonic</option>";
                                                            echo"<option value='Sure'>Sure</option>";
                                                            echo"<option value='Polycom'>Polycom</option>";
                                                            echo"<option value='Kramer'>Kramer</option>";
                                                        
                                                        }else if($product_details[0]->brand === 'Inter-M'){

                                                            echo"<option value='Panasonic'>Panasonic</option>";
                                                            echo"<option value='Sure'>Sure</option>";
                                                            echo"<option value='Polycom'>Polycom</option>";
                                                            echo"<option value='Kramer'>Kramer</option>";
                                                            echo"<option value='Infocus'>Infocus</option>";

                                                        }else if($product_details[0]->brand === 'Panasonic'){

                                                            echo"<option value='Sure'>Sure</option>";
                                                            echo"<option value='Polycom'>Polycom</option>";
                                                            echo"<option value='Kramer'>Kramer</option>";
                                                            echo"<option value='Infocus'>Infocus</option>";
                                                            echo"<option value='Inter-M'>Inter-M</option>";
                                                            
                                                        }else if($product_details[0]->brand === 'Kramer'){

                                                            echo"<option value='Sure'>Sure</option>";
                                                            echo"<option value='Polycom'>Polycom</option>";
                                                            echo"<option value='Panasonic'>Panasonic</option>";
                                                            echo"<option value='Infocus'>Infocus</option>";
                                                            echo"<option value='Inter-M'>Inter-M</option>";
                                                            
                                                        }else if($product_details[0]->brand === 'Sure'){

                                                            echo"<option value='Panasonic'>Panasonic</option>";
                                                            echo"<option value='Polycom'>Polycom</option>";
                                                            echo"<option value='Kramer'>Kramer</option>";
                                                            echo"<option value='Infocus'>Infocus</option>";
                                                            echo"<option value='Inter-M'>Inter-M</option>";
                                                        }else{

                                                            echo"<option value='Sure'>Sure</option>";
                                                            echo"<option value='Panasonic'>Panasonic</option>";
                                                            echo"<option value='Infocus'>Infocus</option>";
                                                            echo"<option value='Inter-M'>Inter-M</option>";
                                                            echo"<option value='Kramer'>Kramer</option>";
                                                        }


                                                    ?>
                                                    <!-- <option value="Infocus">Infocus</option>
                                                    <option value="Inter-M">Inter-M</option>
                                                    <option value="Panasonic">Panasonic</option>
                                                    <option value="Sure">Sure</option> -->
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-sm-5 control-label" for="textinput">Model</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="model" name="model" value="<?php echo $product_details[0]->model; ?>" class="form-control">
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
                            </div><!-- /.col-lg-12 -->
                        </div><!-- /.col-md-12 -->
                    </div><!--/.row-->




                </div><!--/. inner -->
            </div><!--END PAGE CONTENT -->
        </div><!--END MAIN WRAPPER -->


        

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

        <!-- This handles the add product modal form field validation -->
        <script>
            $(document).ready(function () {
                $("#editproductform").validate({
                    rules: {
                        category: "required",
                        brand: "required",
                        model: "required"
                    },
                    messages: {
                        category: "Please select a category",
                        brand: "Please select a brand",
                        model: "Please enter model"

                    }
                });
            });
        </script>
        
        <!-- this Jquery handles the add product function : Edit product modal form -->
        <script>
            $(document).ready(function () {
                baseurl = "http://localhost/psms/";
                $("#editproductform").submit(function (e) {
                    e.preventDefault();
                    if (!$(this).valid())
                        return false;
                    $.ajax({
                        type: "POST",
                        url: baseurl + "index.php/products_c/edit_products",
                        data: $("#editproductform").serialize(),
                        dataType: 'json',
                        success: function (data) {
                            //console.log(data);
                            if (data.final_result === "success") {
                                $('#editproductform')[0].reset();
                                $("#spnmessage").removeAttr("class", "alert alert-danger");
                                $("#spnmessage").attr("class", "alert alert-success");
                                $("#spnmessage").html('<p><strong>Product details changes was successful!</strong></p>');
                                $("#divmessage").removeAttr("class", "hide");
                                $("#divmessage").fadeIn(1500);
                                $("#divmessage").delay(3500).fadeOut(2500);
                                setTimeout(function () {
                                    //location.reload();
                                    window.location.href = "<?php echo base_url(); ?>/index.php/products_c/products_view";
                                }, 5000);
                            } else if (data.final_result === "unsuccess") {
                                $("#spnmessage").removeAttr("class", "alert alert-success");
                                $("#spnmessage").attr("class", "alert alert-danger");
                                $("#spnmessage").html('<p><strong>Unable to change product details, please contact technical team, thank you!</strong></p>');
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
