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
		.chartDiv{
			width: 60%;
			height: 50%;
		}
	</style>
</head><body>
<h5>Solid Waste Collection Management System </h5>
<h1>Waste Collection Data Report</h1>
<?php
if($chartType == 'daily'){
	echo '<p><strong>Report:</strong> '.ucfirst($chartType).'&nbsp;&nbsp;<strong>Date:</strong> '.$chartDate.'</p>';
} else if($chartType == 'weekly'){
	echo '<p><strong>Report:</strong> '.ucfirst($chartType).'&nbsp;&nbsp;<strong>Date:</strong> '.$chartDate[0].' to '.$chartDate[1].'</p>';
} else {
	echo '<p><strong>Report:</strong> '.ucfirst($chartType).'&nbsp;&nbsp;<strong>Date:</strong> '.$chartDate[0].' '.$chartDate[1].'</p>';
}
?>
<div class="chartDiv">
	<canvas id="myChart"></canvas>
</div>
<p>Note: Year-month-day time format (yyyy-mm-dd)</p>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.js"></script>
<script type="text/javascript"> let data = <?php echo json_encode($report);?></script>
<script type="text/javascript">
	function getPecentage(dataWaste){
		var finalData = [];

		for (let i = 0; i < dataWaste.length; i++) { //you can also use "for in", so you don't need the variable "len"
			for (let j = 1; j < dataWaste.length; j++) {
				if (dataWaste[j - 1]['totalWaste'] > dataWaste[j]['totalWaste']) {
					let tmp = dataWaste[j - 1];
					dataWaste[j - 1] = dataWaste[j];
					dataWaste[j] = tmp;
				}
			}
		}

		var totalKg = 0;
		for(let count = 0; count < dataWaste.length; count++){
			totalKg += dataWaste[count]['totalWaste'];
		}

		for(let interval = 0; interval < dataWaste.length; interval++){
			var percentage = 0;
			if(dataWaste[interval]['totalWaste'] !== 0){
				percentage = (dataWaste[interval]['totalWaste']/totalKg) * 100;
			}
			dataWaste[interval]['totalWaste'] = percentage;

		}

		for (let k = 0; k < dataWaste.length; k++) {
			for (let l = 1; l < dataWaste.length; l++) {
				if (dataWaste[l-1]['barangay'] > dataWaste[l]['barangay']) {
					let tmp = dataWaste[l -1];
					dataWaste[l-1] = dataWaste[l];
					dataWaste[l] = tmp;
				}
			}
		}

		for(let m = 0; m <= dataWaste.length; m++){
			if(m == 9){
				finalData[m] = 100;
			} else {
				finalData[m] = dataWaste[m]['totalWaste'];
			}
		}

		return finalData;
	}
	const labels = [
		'District I',
		'District II',
		'District III',
		'District IV',
		'District V',
		'District VI',
		'District VII',
		'District VIII',
		'District IX'
	];

	const dataChart = {
		labels: labels,
		datasets: [{
			label: 'Biodegradable',
			backgroundColor: 'rgb(135,206,235)',
			borderColor: 'rgb(119,181,254)',
			data: getPecentage(data[0]),
		},
			{
				label: 'Residual Waste',
				backgroundColor: 'rgb(255,215,0)',
				borderColor: 'rgb(255,215,0)',
				data: getPecentage(data[1]),
			},
			{
				label: 'Special Waste',
				backgroundColor: 'rgb(34,139,34)',
				borderColor: 'rgb(34,139,34)',
				data: getPecentage(data[2]),
			},
			{
				label: 'Recyclable Waste',
				backgroundColor: 'rgb(255,0,0)',
				borderColor: 'rgb(255,0,0)',
				data: getPecentage(data[3]),
			}
		]
	};

	const config = {
		type: 'line',
		data: dataChart,
		options: {}
	};

	const myChart = new Chart(
		document.getElementById('myChart'),
		config
	);

	function printThis(){
		var css = '@page { size: landscape; }',
			head = document.head || document.getElementsByTagName('head')[0],
			style = document.createElement('style');

		style.type = 'text/css';
		style.media = 'print';

		if (style.styleSheet){
			style.styleSheet.cssText = css;
		} else {
			style.appendChild(document.createTextNode(css));
		}

		head.appendChild(style);
		window.print();
	}
	const printTimeout = setTimeout(printThis, 1000);
</script>
</body></html>



