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
<!--                        <div class="col-md-2">
                            <div style="font-weight: bold; margin-left: 10%;">
                                <a href="<?php echo base_url(); ?>/index.php/parts_inventory_c/parts_inventory_add_page" class="btn btn-round-sm btn-sm btn-primary">Add new parts</a>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div style="font-weight: bold; margin-left: -45%;">
                                <a href="<?php echo base_url(); ?>/index.php/parts_inventory_c/parts_inventory_update_page" class="btn btn-round-sm btn-sm btn-warning">Update inventory</a>
                            </div>
                        </div>-->
                        <div class="col-md-2">
                            <div style="font-weight: bold; margin-left: 10%;">
                                <a href="<?php echo base_url(); ?>/index.php/parts_inventory_c/import_stock_inventory_data_page" class="btn btn-round-sm btn-sm btn-success">Import stock inventory from CSV</a>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-md-12">
                            <div class="col-lg-12">
                                <div class="panel with-nav-tabs panel-default">
                                    <div class="panel-heading">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#activeParts" data-toggle="tab">All Parts</a></li>
                                            <li class=""><a href="#removedParts" data-toggle="tab">Removed Parts</a></li>
                                        </ul>
                                    </div>
                                    <div class="panel-body" >
                                        <div class="tab-content">
                                            <div class="tab-pane fade in active" id="activeParts"><!-- -->
                                                <table id="table1" class="table table-striped table-bordered table-list dataTables-example">
                                                    <thead>
                                                        <tr>
                                                            <th>Ref Code</th>
                                                            <th>Part No</th>
                                                            <th>Description</th>
                                                            <th>Min Qty</th>
                                                            <th>Store Qty</th>
                                                            <th>Status</th>
                                                            <!--<th style="width: 21%">Actions</th>-->
                                                        </tr> 
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        foreach ($all_parts_list as $part_all_list) {
                                                            echo "<tr>";
                                                            echo "<td>" . $part_all_list->part_ref_code . "</td>";
                                                            echo "<td>" . $part_all_list->part_no . "</td>";
                                                            echo "<td>" . $part_all_list->description . "</td>";
                                                            echo "<td>" . $part_all_list->min_qty . "</td>";
                                                            echo "<td>" . $part_all_list->store_qty . "</td>";
                                                            echo "<td>" . $part_all_list->store_status . "</td>";
//                                                            echo "<td>";
//                                                            echo "<a href='". base_url()."/index.php/parts_inventory_c/view_part_details/".$part_all_list->part_ref_code."' class='btn btn-info btn-xs'><i class='icon-external-link'></i>&nbsp;View</a>&nbsp; &nbsp;";
//                                                            echo "</td>";
                                                            echo "</tr>";
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>

                                            </div><!--/. 1st step: P Type -->
                                           
                                        </div><!--/. tab-content -->
                                    </div><!--/. panel-body -->
                                </div><!--/. panel with-nav-tabs panel-default -->
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
        <!-- END GLOBAL SCRIPTS -->
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/dataTables/jquery.dataTables.js"></script>
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('.dataTables-example').dataTable();
            });
        </script>
    </body>    
</html>
