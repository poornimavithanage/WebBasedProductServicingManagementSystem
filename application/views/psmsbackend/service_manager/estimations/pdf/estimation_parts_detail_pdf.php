<html>
    <head>         

        <style>
            table, th, td {
                border: 0.5px solid black;
            }
        </style> 
    </head>
    
    <img src="<?php echo base_url(); ?>psmsbackendtheme/img/header_logo.png" alt=""/>
    <div style="margin-left: 35%;">
        <h3>
            Job Estimate (Job ID : <?php echo $job_id; ?>)
        </h3>
    </div>

    <div style="margin-left: 0%; ">
        <table width="100">
            <thead>
                <tr>
                    <!-- <th class="text-center hide">
                        Job Id
                    </th> -->
                    <th class="text-center">
                        Part Ref Code
                    </th>
                    <th class="text-center">
                        Part No
                    </th>
                    <th class="text-center">
                        Part Description
                    </th>
                    <th class="text-center">
                        Qty
                    </th>
                    <th class="text-center">
                        Unit Price (Rs.)
                    </th>
                    <th width="150px">
                        Amount (Rs.)
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($job_repair_info as $list) {

                    echo "<tr>";
                    echo "<td>" . $list->part_ref_code . "</td>";
                    echo "<td>" . $list->part_no . "</td>";
                    echo "<td>" . $list->part_description . "</td>";
                    echo "<td>" . $list->qty . "</td>";
                    echo "<td>" . number_format((float) ($list->average_cost_price), 2, '.', '') . "</td>";
                    echo "<td style='text-align: right;'>" . number_format((float) ($list->qty * ((float)$list->average_cost_price)), 2, '.', '') . "</td>";
                    echo "</tr>";

                    $i++;
                }
                echo "<tr>"; // Markup Cost Row
                echo "<td colspan='4'></td>";
                echo "<td>Markup (" . $markup_value . "%) Cost</td>";
                echo "<td style='text-align: right;'>" . $estimation[0]->parts_markup_cost . "</td>";
                echo "</tr>";
                echo "<tr>"; // Total Parts Cost Row
                echo "<td colspan='4'></td>";
                echo "<td>Total parts cost with markup</td>";
                echo "<td style='text-align: right;'>" . $estimation[0]->total_parts_markup_cost_final . "</td>";
                echo "</tr>";
                echo "<tr>"; // Labour Cost Row
                echo "<td colspan='4'></td>";
                echo "<td>Labour Charges</td>";
                echo "<td style='text-align: right;'>" . $estimation[0]->labour_cost . "</td>";
                echo "</tr>";
                echo "<tr>"; // VAT Row
                echo "<td colspan='4'></td>";
                echo "<td>Vat (" . $vat_value . "%)</td>";
                echo "<td style='text-align: right;'>" . $estimation[0]->tax_vat . "</td>";
                echo "</tr>";
                echo "<tr>"; // NBT Row
                echo "<td colspan='4'></td>";
                echo "<td>NBT (" . $nbt_value . "%)</td>";
                echo "<td style='text-align: right;'>" . $estimation[0]->tax_nbt . "</td>";
                echo "</tr>";
                echo "<tr>"; // Total Row
                echo "<td colspan='4'></td>";
                echo "<td><strong>Total</strong></td>";
                echo "<td style='text-align: right;'><strong>" . $estimation[0]->total_job_cost . "</strong></td>";
                echo "</tr>";
                ?>
            </tbody>
        </table>
    </div>


</html>

