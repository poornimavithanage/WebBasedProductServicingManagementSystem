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
            <?php $this->load->view('psmsbackend/imports_manager/template_imports_manager/navigation_imports_manager'); ?>
        <!--END MENU SECTION -->
        
        <!--PAGE CONTENT -->
        <div id="content">
            <div class="inner" style="min-height:1200px;">
                <div class="row" style="margin-top: 0.5%;">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <ul class="breadcrumb">
                                <li><a style="text-decoration: none;" href="#">Dashboard</a></li>
                                <li><a style="text-decoration: none;" href="#" class="di">Page...</a></li>
                            </ul>
                        </div>
                </div><!--/.row-->
                
                <div class="row">
                    <div class="col-lg-12">
                        <h3><strong>Imports Manager Dashboard</strong></h3>
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
    <!-- END GLOBAL SCRIPTS -->
    <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script>
        $(document).ready(function () {
            $('#dataTables-example').dataTable();
        });
    </script>
</body>    
</html>
