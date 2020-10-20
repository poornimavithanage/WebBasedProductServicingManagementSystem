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
        <link href="<?php echo base_url(); ?>psmsbackendtheme/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />

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
                                <li><a style="text-decoration: none;" href="#" class="di">Parts Inventory</a></li>
                            </ul>
                        </div>
                    </div><!--/.row-->

                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-md-2">
                            <div style="font-weight: bold; margin-left: 10%;">
                                <a href="<?php echo base_url(); ?>/index.php/parts_inventory_c/parts_inventory_list" class="btn btn-round-sm btn-sm btn-danger">Go Back</a>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-md-12">
                            <div class="col-lg-12">
                                <hr>
                            </div>
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
                            <form class="form-horizontal" role="form" id="addpartinventoryform" method="POST" action="">
<!--                                <div class="form-group" style="margin-right:10%">
                                    <label class="col-sm-5 control-label" for="part_ref_code">Ref Code</label>
                                    <div class="col-sm-5">
                                        <input type="text" id="part_ref_code" name="part_ref_code" placeholder="" class="form-control">
                                    </div>
                                </div>-->
                                <div class="form-group" style="margin-right:10%">
                                    <label class="col-sm-5 control-label" for="part_no">Part No</label>
                                    <div class="col-sm-5">
                                        <input type="text" id="part_no" name="part_no" placeholder="Part No" class="form-control">
                                    </div>
                                </div>    

                                <div class="form-group" style="margin-right:10%">
                                    <label class="col-sm-5 control-label" for="description">Description</label>
                                    <div class="col-sm-5">
                                        <textarea placeholder="Description" id="description" name="description" rows="3" cols="4" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="form-group" style="margin-right:10%">
                                    <label class="col-sm-5 control-label" for="min_qty">Minimum Qty</label>
                                    <div class="col-sm-5">
                                        <input type="number" id="min_qty" name="min_qty" placeholder="" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group" style="margin-right:10%">
                                    <label class="col-sm-5 control-label" for="store_qty">Store Qty</label>
                                    <div class="col-sm-5">
                                        <input type="number" id="store_qty" name="store_qty" placeholder="" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12" style="margin-left: 60%">
                                        <div class="pull-left">
                                            <input type="submit" class="btn btn-primary" value="Save" />
                                            <input type="reset" class="btn btn-warning" value="Reset" />
                                        </div>
                                    </div>
                                </div>
                            </form>
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
        <!-- END GLOBAL SCRIPTS -->
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/dataTables/jquery.dataTables.js"></script>
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('.dataTables-example').dataTable();
            });
        </script>
        
        <!-- this Jquery handles the add part function -->
        <script>
            $(document).ready(function () {
                baseurl = "http://localhost/psms/";
                $("#addpartinventoryform").submit(function (e) {
                    e.preventDefault();
                    if (!$(this).valid())
                        return false;
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>index.php/parts_inventory_c/parts_inventory_add",
                        data: $("#addpartinventoryform").serialize(),
                        dataType: 'json',
                        success: function (data) {
                            //console.log(data);
                            if (data.final_result === "success") {
                                $('#addpartinventoryform')[0].reset();
                                $("#spnmessage").removeAttr("class", "alert alert-danger");
                                $("#spnmessage").attr("class", "alert alert-success");
                                $("#spnmessage").html('<p><strong>Parts successfuly added to the system!</strong></p>');
                                $("#divmessage").removeAttr("class", "hide");
                                $("#divmessage").fadeIn(1500);
                                $("#divmessage").delay(3500).fadeOut(2500);
                                setTimeout(function () {
                                    //location.reload();
                                    window.location.href = "<?php echo base_url(); ?>/index.php/parts_inventory_c/parts_inventory_list";
                                }, 5000);
                            } else if (data.final_result === "unsuccess") {
                                $("#spnmessage").removeAttr("class", "alert alert-success");
                                $("#spnmessage").attr("class", "alert alert-danger");
                                $("#spnmessage").html('<p><strong>Unable to add this part please contact administrator, thank you!</strong></p>');
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
