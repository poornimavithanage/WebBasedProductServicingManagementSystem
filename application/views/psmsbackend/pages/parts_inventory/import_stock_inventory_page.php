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
        <!--<link href="<?php //echo base_url();                    ?>psmsbackendtheme/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />-->
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
        <link href="<?php echo base_url(); ?>psmsbackendtheme/plugins/bootstrap-daterangepicker-master/css/bootstrap-datepicker3.css" rel="stylesheet" type="text/css"/>
       <!--  <link href="<?php //echo base_url();                   ?>psmsbackendtheme/plugins/bootstrap-daterangepicker-master/css/daterangepicker.css" rel="stylesheet" type="text/css"/> -->

        <link href="<?php echo base_url(); ?>psmsbackendtheme/plugins/bootstrap-selectpicker/css/bootstrap-select.min.css" rel="stylesheet" type="text/css"/>

        <link href="<?php echo base_url(); ?>psmsbackendtheme/plugins/bootstrapFile/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>

        <link href="<?php echo base_url(); ?>psmsbackendtheme/plugins/bootstrapFile/themes/explorer-fa/theme.css" media="all" rel="stylesheet" type="text/css"/>

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
                                <li><a style="text-decoration: none;" href="#" class="di">Import Stock Inventory from CSV</a></li>
                            </ul>
                        </div>
                    </div><!--/.row-->

                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-md-2">
                            <div style="font-weight: bold; margin-left: -10%;">
                                <div style="font-weight: bold; margin-left: 10%;">
                                    <a href="<?php echo base_url(); ?>/index.php/parts_inventory_c/parts_inventory_list" class="btn btn-round-sm btn-sm btn-danger">Go Back</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-md-12">
                            <hr>
                        </div>
                    </div>

                    <div class="row" style="margin-left: 1%">
                        <div class="col-md-12 well well-sm" style="width: 98%; margin-top: 0.3%;">
                            <div style="font-weight: bold; margin-left: -10%;">
                                <div style="font-weight: bold; margin-left: 10%;">
                                    <a href="#" style="text-decoration: none; font-weight: bold; font-size: 145%; margin-left: 16%;"><?php echo $page_msg; ?></a>
                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="row hide" style="margin-top: 0.5%;">
                        <div class="col-md-12">
                            <form class="form-horizontal" role="form" id="import_stock_balance_data_form" method="POST" action="<?php echo base_url(); ?>index.php/parts_inventory_c/import_stock_inventory_data_save_1">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group" style="margin-right:10%">
                                            <label class="col-lg-5 control-label" for="textinput">Upload stock inventory CSV </label>
                                            <div class="col-lg-5" style="width: 39%; margin-left: 1.5%">
                                                <div class="form-group">
                                                    <div class="file-loading">
                                                        <input id="pop" name="pop" type="file" class="file" data-show-upload="false" data-show-caption="true" data-msg-placeholder="Select {files} for upload...">
                                                    </div> 
                                                </div>                                            
                                            </div>
                                            <label for="pop" class="error" style="display:none; font-style: italic; font-weight: bold; margin-left: 43%;"></label>
                                        </div>
                                    </div>  
                                    <div class="col-lg-6">
                                        <input type="submit" value="submit" class="btn btn-primary" name="">       
                                    </div>
                                </div>                                    
                            </form>
                        </div><!-- /.col-md-12 -->
                    </div><!--/.row-->

                    <div class="row">
                        <div class="col-lg-10 col-md-6 col-sm-6" style="margin-left: 1%;">
                            <div class="panel panel-info" style="height: 210px;">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong>Upload Stock Inventory </strong></h3>
                                </div>
                                <div class="panel-body" style="margin-bottom: 20%;">
                                    <div class="row">
                                        <form class="form-horizontal" role="form" id="import_stock_inventory_form" method="POST" action="<?php echo base_url(); ?>index.php/part_inventory_c/import_stock_inventory_data_save_1">
                                            <div class="form-group" style="margin-right: 9%;">
                                                <label class="col-lg-5 control-label" for="textinput" style="margin-left: 8%;">Upload stock inventory CSV </label>
                                                <div class="col-lg-5" style="">
                                                    <div class="form-group">
                                                        <div class="file-loading">
                                                            <input id="stock_inventory" name="stock_inventory" type="file" class="file" required="">
                                                        </div> 
                                                    </div>                                            
                                                </div>
                                                <label for="stock_inventory" class="error" style="display:none; font-style: italic; font-weight: bold; margin-left: 43%;"></label>
                                                <div class="col-lg-2">
                                                    <div class="form-group" style="margin-top: 5%; margin-left: 621%;">
                                                        <input type="submit" value="submit" class="btn btn-success" name="">   
                                                    </div>
                                                </div>
                                            </div>                                
                                        </form>
                                    </div>       
                                    <div class="row" style="margin-top:3%">
                                        <div class="col-md-12 hide" id="divmessage1">
                                            <div id="spnmessage1" class="alert alert-success alert-dismissible" role="alert">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        

                </div><!--/. inner -->
            </div><!--END PAGE CONTENT -->
        </div><!--END MAIN WRAPPER -->



        <!-- FOOTER -->
        <?php $this->load->view('psmsbackend/template/footer'); ?>
        <!--END FOOTER -->
        <!-- GLOBAL SCRIPTS -->
        <?php $this->load->view('psmsbackend/template/head_js'); ?>
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/jquery-validation-1.11.1/jquery.validate.js" type="text/javascript">
        </script>
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/jquery-validation-1.11.1/additional-methods.js" type="text/javascript">
        </script>
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/bootstrap-daterangepicker-master/js/bootstrap-datepicker.js" type="text/javascript">
        </script>
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/bootstrap-daterangepicker-master/locales/bootstrap-datepicker.en-GB.min.js" type="text/javascript">
        </script>

        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/bootstrap-selectpicker/js/bootstrap-select.min.js" type="text/javascript">
        </script>


        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/bootstrapFile/js/plugins/sortable.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/bootstrapFile/js/fileinput.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/bootstrapFile/js/locales/fr.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/bootstrapFile/js/locales/es.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/bootstrapFile/themes/explorer-fa/theme.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/bootstrapFile/themes/fa/theme.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" type="text/javascript"></script>


        <script type="text/javascript">
            $(document).ready(function () {

                $("#pop").fileinput({
                    minFileCount: 1,
                    maxFileCount: 1,
                    allowedFileExtensions: ["csv"]
                });
            });
        </script>

        <!-- import stock inventory -->
        <script>
            $(document).ready(function () {

                $('#import_stock_inventory_form').on('submit', function (event) {
                    event.preventDefault();
                    if (!$(this).valid())
                        return false;

                    $.ajax({
                        url: "<?php echo base_url(); ?>index.php/parts_inventory_c/import_stock_inventory",
                        method: "POST",
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        dataType: 'json',
                        success: function (data)
                        {

                            if (data.final_result === "success") {


                                $('#import_stock_inventory_form')[0].reset();
                                $("#spnmessage1").removeAttr("class", "alert alert-danger");
                                $("#spnmessage1").attr("class", "alert alert-success");
                                $("#spnmessage1").html('<p><strong>Successfuly uploaded the stock inventory</strong></p>');
                                $("#divmessage1").removeAttr("class", "hide");
                                $("#divmessage1").attr("class", "col-md-12");
                                $("#divmessage1").fadeIn(1500);
                                $("#divmessage1").delay(3500).fadeOut(2500);

                            } else if (data.final_result === "unsuccess") {

                                $("#spnmessage1").removeAttr("class", "alert alert-success");
                                $("#spnmessage1").attr("class", "alert alert-danger");
                                $("#spnmessage1").html('<p><strong>Unable to upload the stock inventory</strong></p>');
                                $("#divmessage1").removeAttr("class", "hide");
                                $("#divmessage1").attr("class", "col-md-12");
                                $("#divmessage1").fadeIn(1500);
                            }


                        }
                    });
                });
            });
        </script>
        
       



    </body>    
</html>

