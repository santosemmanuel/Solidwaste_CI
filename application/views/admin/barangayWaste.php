<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Waste Collection by Barangay</h1>
	</div>

	<!-- Content Row -->
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<form class="form-inline" method="post" id="barangayWasteForm">
						<label class="sr-only" for="inlineFormInputName2">Name</label>
						<select class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" name="reportCat">
							<option value="daily">Daily</option>
							<option value="weekly">Weekly</option>
							<option value="monthly">Monthly</option>
						</select>
						<div class="input-group mb-2 mr-sm-2">
							<input type="text" class="form-control week-picker" name="dateWaste" id="dateByWeek"  autocomplete="off" placeholder="Select Date">
						</div>
						<button type="submit" class="btn btn-primary mb-2">Submit</button>
					</form>
					<div class="float-right">
						<button type="button" id="printTableBarangay" class="btn btn-info">
							<i class="fas fa-print"></i> Print
						</button>
						<button type="button" id="pdfTableBarangay" class="btn btn-info">
							<i class="fas fa-file-pdf"></i> Export PDF
						</button>
					</div>
					<br>
					<br><div class="table-responsive">
						<table class="table table-bordered table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
							<thead>
							<tr class="text-primary">
								<th width="200">Barangay</th>
								<th>Biodegrable Waste</th>
								<th>Residual Waste</th>
								<th>Special Waste</th>
								<th>Recyclable Waste</th>
								<th>Total</th>
							</tr>
							</thead>

							<tbody>

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<!-- /.container-fluid -->
	</div>
