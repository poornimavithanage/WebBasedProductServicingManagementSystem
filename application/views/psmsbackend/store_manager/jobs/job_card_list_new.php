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
        <!--<link href="<?php //echo base_url();   ?>psmsbackendtheme/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />-->
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
            <?php $this->load->view('psmsbackend/store_manager/template_store_manager/navigation_store_manager'); ?>
            <!--END MENU SECTION -->

            <!--PAGE CONTENT -->
            <div id="content">
                <div class="inner" style="min-height:1200px;">
                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <ul class="breadcrumb">
                                <li><a style="text-decoration: none;" href="#">Dashboard</a></li>
                                <li><a style="text-decoration: none;" href="#" class="di">Job Entry</a></li>
                            </ul>
                        </div>
                    </div><!--/.row-->

                    <div class="row <?php if ($page_msg === "unsucces") { echo "";} else { echo "hide";} ?>">
                        <div class="container-fluid">
                            <div class="col-md-12" id="divmessage_3">
                                <div id="spnmessage_3" class="alert alert-warning alert-dismissible" role="alert">
                                    Unable to assign this job to you,  Please contact administrator
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row" style="margin-top: 0.5%;">
                        <div class="col-md-12">
                            <div class="col-lg-12">
                                <div class="panel with-nav-tabs panel-default">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <ul class="nav nav-tabs">
                                                <strong>New Jobs</strong>
                                            </ul>
                                        </div></div>
                                    <div class="panel-body" >
                                        <table id="table1" class="table table-striped table-bordered table-list dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>Job No</th>
                                                    <th>Customer ID</th>
                                                    <th>Category</th>
                                                    <th>Make</th>
                                                    <th>Model</th>
                                                    <th>Serial No</th>
                                                    <th>Repair Mode</th>
                                                    <th>Job Open Date</th>
                                                    <th>Actions</th>
                                                </tr> 
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($new_job_list as $act_job) {

                                                    echo "<tr>";
                                                    echo "<td>" . $act_job->job_id . "</td>";
                                                    echo "<td>" . $act_job->customer_id . "</td>";
                                                    echo "<td>" . $act_job->category . "</td>";
                                                    echo "<td>" . $act_job->make . "</td>";
                                                    echo "<td>" . $act_job->model . "</td>";
                                                    echo "<td>" . $act_job->serial_no . "</td>";
                                                    echo "<td>" . $act_job->warranty_type . "</td>";
                                                    echo "<td>" . $act_job->job_date . "</td>";
                                                    echo "<td>";
                                                    echo "<a href='" . base_url() . "/index.php/store_mgr_c_view/assign_job_to_me?var1=" . $act_job->job_id . "&var2=" . $store_m_id . "' class='btn btn-success btn-xs'><i class='icon-briefcase'></i>&nbsp;Assign to me</a>&nbsp; &nbsp";
                                                    echo "<a href='" . base_url() . "/index.php/store_mgr_c_view/view_job_detail_page?var1=" . $act_job->job_id . "' class='btn btn-warning btn-xs'><i class='icon-external-link'></i>&nbsp;View</a>&nbsp; &nbsp";
                                                    echo "</tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
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
        <!--<script src="<?php //echo base_url();   ?>psmsbackendtheme/plugins/dataTables/jquery.dataTables.js"></script>-->
        <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="//cdn.datatables.net/1.10.16/js/dataTables.bootstrap.js" type="text/javascript"></script>
        <!--<script src="<?php //echo base_url();   ?>psmsbackendtheme/plugins/dataTables/dataTables.bootstrap.js"></script>-->
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/jquery-validation-1.11.1/jquery.validate.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>psmsbackendtheme/plugins/jquery-validation-1.11.1/additional-methods.js" type="text/javascript"></script>

        <script>
            $(document).ready(function () {
                $('.dataTables-example').dataTable(); // jquery-bootstrap datatable 

            });
        </script>




        <!-- get the job_id from the table remove button and pass the job_id to the remove modal form input field -->
        <script>
            $(".removeJob").click(function () {
                j_id = this.id;

                if (j_id !== null) {
                    $("#job_id_remove_form").attr('value', j_id);

                } else {
                    $("#job_id_remove_form").val("no_value");
                }

            });
        </script>

        <!-- get the job_id from the table restore button and pass the job_id to the restore modal form input field -->
        <script>
            $(".restoreJob").click(function () {
                j_id = this.id;

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>index.php/front_desk_c_view/get_job_details",
                    data: {'job_id_for_edit': j_id},
                    dataType: 'json',
                    success: function (data) {
                        //console.log(data);
                        if (data.final_result === "success") {
                            $('#addjobform')[0].reset();
                            $("#spnmessage").removeAttr("class", "alert alert-danger");
                            $("#spnmessage").attr("class", "alert alert-success");
                            $("#spnmessage").html('<p><strong>Job successfuly added to the system!</strong></p>');
                            $("#divmessage").removeAttr("class", "hide");
                            $("#divmessage").fadeIn(1500);
                            $("#divmessage").delay(3500).fadeOut(2500);
                            setTimeout(function () {
                                location.reload();
                            }, 6000);
                        } else if (data.final_result === "unsuccess") {
                            $("#spnmessage").removeAttr("class", "alert alert-success");
                            $("#spnmessage").attr("class", "alert alert-danger");
                            $("#spnmessage").html('<p><strong>Unable to restore this job please contact administrator, thank you!</strong></p>');
                            $("#divmessage").removeAttr("class", "hide");
                            $("#divmessage").fadeIn(1500);
                            $("#divmessage").delay(2500).fadeOut(1500);
                        }
                    }
                });

            });
        </script>

        <script>
            $(".restoreJob").click(function () {
                j_id = this.id;

                if (j_id !== null) {
                    $("#job_id_restore_form").attr('value', j_id);

                } else {
                    $("#ob_id_restore_form").val("no_value");
                }

            });
        </script>

    </body>    
</html>
