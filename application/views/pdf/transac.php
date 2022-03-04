<!DOCTYPE html>
<html><head>
    <title></title>
    <style>
    body {
    	width: 100%;
    	margin: auto;
    }

    table {
		border: 1px solid #ddd;
		width: 100%;
		margin-top: 20px;
		margin-bottom: 12px;
		border-collapse: collapse;
		text-align: left;
	}

	td, th {
		border: 1px solid #ddd;
		padding: 6px;
	}

	table th {
		font-weight: bold;
		text-align: left;
	}

	span {
		margin-left: 20px;
	}

	.center {
		text-align: center;
	}

	#no {
		width: 30px;
	}

	</style>
</head><body>
	<h5>Solid Waste Collection Management System</h5>
	<h1>Transaction Data Report</h1>
	<?php 
		echo '<p>The transaction is completed in the time range</p>';
		echo '<p>From: '.$dari.'<span>To: '.$sampai.'</span></p>';
	?>
    <table>
		<tr>
			<th class="center" id="no">#</th>
            <th class="center">Transaction  ID</th>
            <th class="center">Municipality ID</th>
            <th>Municipality</th>
            <th class="center">Waste Category ID</th>
            <th>Waste Category</th>
            <th>Weight</th>
            <th>Total</th>
            <th>Collection Date</th>
            <th>Finished Date</th>
		</tr>
		<?php
            $no = 1;
            $total_pendapatan = 0;
            foreach ($data_transac as $transac) {
            	$total_pendapatan += $transac->total;
        ?>
        <tr>
            <th class="center"><?php echo $no++ ?></th>
            <td class="center"><?php echo $transac->transac_id ?></td>
            <td class="center"><?php echo $transac->municipal_id ?></td>
            <td><?php echo $transac->name_municipal ?></td>
            <td class="center"><?php echo $transac->wastecat_id ?></td>
            <td><?php echo $transac->name_wastecat ?></td>
            <td><?php echo $transac->weight ?> KG</td>
            <td>$<?php echo $transac->total ?></td>
            <td><?php echo $transac->start_date ?></td>
            <td><?php if ($transac->end_date == '0000-00-00') { echo '-'; } else { echo $transac->end_date; } ?></td>
		</tr>
		<?php 
			}
		?>
		<tr>
			<td colspan="7"><b>Total Income</b></td>
			<td colspan="3"><b>$ <?php echo $total_pendapatan ?></b></td>
		</tr>
	</table>
	<p>Note: Year-month-day time format (yyyy-mm-dd)</p>
</body></html>