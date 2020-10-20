<!--<h1>mPDF<img src="<?php // echo base_url();    ?>backend_assets/img/demoImage.jpg" alt=""/></h1>-->

<img src="<?php echo base_url(); ?>psmsbackendtheme/img/header_logo.png" alt=""/>

<!--<h2>PSMS</h2>-->
<div style="margin-left: 30%;">    
    <h3><?php echo $report_job_status; ?> Jobs Report (Count <?php echo $jobs_count; ?>)</h3>
</div>


<table border="1">
    <tbody>
        <tr>
            <th>job_id</th>
            <th>Customer Name</th>
            <th>Category</th>
            <th>Make</th>
            <th>Model</th>
            <th>Serial No</th>
            <th>Warranty Type</th>
            <th>Customer Contact No</th>
        </tr>
        <?php
        foreach ($job_report_data as $list) {


            echo "<tr>";
            echo "<td>" . $list->job_id . "</td>";
            echo "<td>" . $list->title . "" . $list->cus_name . "</td>";
            echo "<td>" . $list->category . "</td>";
            echo "<td>" . $list->make . "</td>";
            echo "<td>" . $list->model . "</td>";
            echo "<td>" . $list->serial_no . "</td>";
            echo "<td>" . $list->warranty_type . "</td>";
            echo "<td>" . $list->contact_no . "</td>";
            echo "</tr>";
        }
        ?></tbody></table>
