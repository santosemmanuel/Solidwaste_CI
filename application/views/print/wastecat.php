<!DOCTYPE html>
<html><head>
    <title></title>
    <style>
    body {
    	width: 90%;
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
		padding: 12px;
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
	<h5>Solid Waste Collection Management System </h5>
	<h1>Waste Category Data Report</h1>
	<?php 
		echo '<p>Active Waste Collection on time range</p>';
		echo '<p>From: '.$dari.'<span>To: '.$sampai.'</span></p>';
	?>
    <table>
		<tr>
			<th class="center" id="no">#</th>
            <th class="center">ID</th>
            <th>Waste Category</th>
            <th>Collection Day</th>
            <th>Specification</th>
            <th>Source of Wastes</th>
            <th>Collection Fees Per Year</th>
            <th>Collection Date</th>
            <th>Finish Date</th>
		</tr>
		<?php
            $no = 1;
            foreach ($data_wastecat as $wastecat) {
        ?>
        <tr>
            <th class="center"><?php echo $no++ ?></th>
            <td class="center"><?php echo $wastecat->wastecat_id ?></td>
            <td><?php echo $wastecat->name_wastecat ?></td>
            <td><?php echo $wastecat->col_day ?></td>
            <td><?php echo $wastecat->spec ?></td>
            <td><?php echo $wastecat->source ?></td>
            <td>₱<?php echo $wastecat->col_fees ?></td>
            <td><?php echo $wastecat->col_date ?></td>
            <td><?php if ($wastecat->fin_date == '0000-00-00') { echo '-'; } else { echo $wastecat->fin_date; } ?></td>
		</tr>
		<?php 
			}
		?>
	</table>
	<p>Note: Year-month-day time format (yyyy-mm-dd)</p>
	<script type="text/javascript">
		window.print();
	</script>
</body></html>