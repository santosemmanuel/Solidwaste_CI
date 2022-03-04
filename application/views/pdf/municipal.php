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
	<h5>Solid Waste Collection Management System</h5>
	<h1>Municipality Data Report</h1>
	<?php if ($zipcode != '') {
		echo '<p>zipcode: '.$zipcode.'</p>';
	} ?>
    <table>
		<tr>
			<th class="center" id="no">#</th>
            <th class="center">ID</th>
            <th>Municipality</th>
            <th>Zipcode</th>
            <th>Province</th>
            <th>Barangay/Poblacion</th>
		</tr>
		<?php
            $no = 1;
            foreach ($data_municipal as $municipal) {
        ?>
        <tr>
            <th class="center"><?php echo $no++ ?></th>
            <td class="center"><?php echo $municipal->municipal_id ?></td>
            <td><?php echo $municipal->name_municipal ?></td>
            <td><?php echo $municipal->zipcode ?></td>
            <td><?php echo $municipal->province ?></td>
            <td><?php echo $municipal->barangay ?></td>
		</tr>
		<?php 
			}
		?>
	</table>
</body></html>