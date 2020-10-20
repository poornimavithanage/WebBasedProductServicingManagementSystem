<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">



        <!-- Bootstrap core CSS -->
        <?php $this->load->view('psmsfrontend/template/head_css'); ?>

    </head>

    <body>

        <!-- Navigation -->
        <?php $this->load->view('psmsfrontend/template/header'); ?>

        <!-- Page Content -->
        <div class="container">

            <div class="row">

                <!-- Blog Entries Column -->
                <div class="col-md-8">

                    <h1 class="my-4">
                        <small>Welcome to the STAV Customer Web Portal</small>
                    </h1>

                    <!-- Blog Post -->
                    <div class="card mb-4">
                        <table id="table1" class="table table-striped table-bordered table-list dataTables-example">
                            <tr>
                                <th colspan="2" style="text-align: center;">My Profile</th>
                            </tr>
                            <tr>
                                <th>Id : </th>
                                <td><?php echo $customer_details[0]->customer_id; ?></td>
                            </tr>
                            <tr>
                                <th>Name : </th>
                                <td><?php echo $customer_details[0]->cus_name; ?></td>
                            </tr>
                            <tr>
                                <th>Address : </th>
                                <td><?php echo $customer_details[0]->cus_address; ?></td>
                            </tr>
                            <tr>
                                <th>Contact No 1 : </th>
                                <td><?php echo $customer_details[0]->contact_no; ?></td>
                            </tr>
                            <tr>
                                <th>Contact No 2 : </th>
                                <td><?php echo $customer_details[0]->contact_no1; ?></td>
                            </tr>
                            <tr>
                                <th>Fax : </th>
                                <td><?php echo $customer_details[0]->fax; ?></td>
                            </tr>
                            <tr>
                                <th>Email : </th>
                                <td><?php echo $customer_details[0]->email; ?></td>
                            </tr>
                        </table>
                    </div>
                    
                </div>

                <!-- Sidebar Widgets Column -->
                <div class="col-md-4">

                    <!-- Search Widget -->
<!--                    <div class="card my-4">
                        <h5 class="card-header">Search Job</h5>
                        <div class="card-body">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search for...">
                                <span class="input-group-btn">
                                    <button class="btn btn-secondary" type="button">Go!</button>
                                </span>
                            </div>
                        </div>
                    </div>-->

                    <!-- Categories Widget -->
                    <div class="card my-4">
                        <h5 class="card-header">New Jobs</h5>
                        <div class="card-body">
                            <table class="table table-list ">

                                <?php
                                foreach ($new_jobs as $list) {

                                    echo "<tr>";
                                    echo "<td><a href='" . base_url() . "index.php/customer_web_portal_c/new_job_detail_view_page/" . $list->job_id . "' style='text-decoration: none' >" . $list->job_id . "</a></td>";
                                    echo "<td>Created on " . $list->job_date . "</td>";
                                    echo"</tr>";
                                }
                                ?>

                            </table>
                        </div>
                    </div>
                    <div class="card my-4">
                        <h5 class="card-header">In Progress Jobs</h5>
                        <div class="card-body">
                            <table class="table table-list ">

                                <?php
                                foreach ($in_progress_jobs as $list) {

                                    echo "<tr>";
                                    echo "<td><a href='" . base_url() . "index.php/customer_web_portal_c/job_detail_view_page/" . $list->job_id . "' style='text-decoration: none' >" . $list->job_id . "</a></td>";
                                    echo "<td>Created on " . $list->job_date . "</td>";
                                    echo"</tr>";
                                }
                                ?>

                            </table>
                        </div>
                    </div>

                    <!-- Side Widget -->
                    <div class="card my-4">
                        <h5 class="card-header">New Job Estimations</h5>
                        <div class="card-body">
                            <table class="table table-list ">

                                <?php
                                foreach ($pending_estimation as $list) {

                                    echo "<tr>";
                                    echo "<td><a href='" . base_url() . "index.php/customer_web_portal_c/job_estimation_detail_form_page/" . $list->job_id . "' style='text-decoration: none' >" . $list->job_id . "</a></td>";
                                    echo "<td>Sent on " . $list->est_send_date . "</td>";
                                    echo"</tr>";
                                }
                                ?>

                            </table>
                        </div>
                    </div>
                    
                    <div class="card my-4">
                        <h5 class="card-header">Finished not collected</h5>
                        <div class="card-body">
                            <table class="table table-list ">

                                <?php
                                foreach ($finished_not_collected as $list) {

                                    echo "<tr>";
                                    echo "<td><a href='" . base_url() . "index.php/customer_web_portal_c/job_detail_view_page/" . $list->job_id . "' style='text-decoration: none' >" . $list->job_id . "</a></td>";
                                    echo "<td> Created on " . $list->job_date . "</td>";
                                    echo"</tr>";
                                }
                                ?>

                            </table>
                        </div>
                    </div>

                    <!-- Side Widget -->
                    <div class="card my-4">
                        <h5 class="card-header">Closed Jobs</h5>
                        <div class="card-body">
                            <table class="table table-list ">

                                <?php
                                foreach ($closed_jobs as $list) {

                                    echo "<tr>";
                                    echo "<td><a href='" . base_url() . "index.php/customer_web_portal_c/job_detail_view_page/" . $list->job_id . "' style='text-decoration: none' >" . $list->job_id . "</a></td>";
//                                    echo "<td> Closed on" . $list->status_change_date . "</td>";
                                    echo"</tr>";
                                }
                                ?>

                            </table>
                        </div>
                    </div>

                </div>

            </div>
            <!-- /.row -->

        </div>
        <!-- /.container -->

        <!-- Footer -->
        <?php $this->load->view('psmsfrontend/template/footer'); ?>



        <!-- Bootstrap core JavaScript -->
        <?php $this->load->view('psmsfrontend/template/head_js'); ?>

    </body>

</html>
