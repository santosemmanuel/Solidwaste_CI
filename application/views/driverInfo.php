<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
	</div>

	<!-- Content Row -->
	<div class="row">
		<div class="col-12">
			<div id="dashboardMapDriver" class="map"></div>
			<div id="popup" class="ol-popup" hidden="hidden">
				<a href="#" id="popup-closer" class="ol-popup-closer"></a>
				<div id="popup-content">
					<form action="<?php echo base_url()."dashboard/updateRequest"?>" method="post" id="recieveRequest">
						<p id="requestTitle"></p>
						<input type="hidden" name="requestID" hidden="hidden" id="requestID">
						<div class="form-group">
								<label class="control-label text-primary">Waste Category </label>
								<select class="form-control" id="wastecat_name" name="name_wastecat" pattern="[A-Za-z]{1,10}" required>
									<option value="">--Please Select--</option>
									<option value="1">Biodegrable Waste</option>
									<option value="2">Residual Waste(Non-biodegradable)</option>
									<option value="3">Special Waste(Electro waste)</option>
									<option value="4">Recyclable Waste</option>
								</select>
							</div>
							<div class="form-group">
								<label class="control-label text-primary">Specification</label>
								<select class="form-control" id="wasteSpecs" name="spec" pattern="[A-Za-z]{1,10}" required readonly="true">
									<option value="">--Please Select--</option>
									<option value="peels of vegetables and fruits , paper , Wood">peels of vegetables and Fruits , Paper , Wood</option>
									<option value="plastics, glass battles , cans , styrofoam">plastics, glass battles , cans , styrofoam</option>
									<option value="computers , televison, washing machine , aircon ,refrigerator ,light bulb">computers , televison, washing machine , aircon ,refrigerator ,light bulb</option>
									<option value="plastic cups , strew , plastic utensils , aluminum cans, mix paper">plastic cups , strew , plastic utensils , aluminum cans, mix paper</option>
								</select>
							</div>
							<div class="form-group">
								<label class="control-label text-primary">Waste kg.</label>
								<input type="text" class="form-control" placeholder="Collection by Kg." name="wastecat_kg" required>
							</div>
						<button type="submit" class="btn btn-sm btn-secondary">Submit</button>
					</form>
				</div>
			</div>
			<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Collection Details</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form id="wasteCatForm" action="<?php echo base_url()."dashboard/doneRequest"?>" method="post">
								<p id="requestTitle"></p>
								<input type="hidden" name="requestID" hidden="hidden" id="requestID">
								<div class="form-group">
									<label class="control-label text-primary">Waste Category </label>
									<select class="form-control" id="wastecatName" name="name_wastecat" pattern="[A-Za-z]{1,10}" required>
										<option value="">--Please Select--</option>
										<option value="1">Biodegrable Waste</option>
										<option value="2">Residual Waste(Non-biodegradable)</option>
										<option value="3">Special Waste(Electro waste)</option>
										<option value="4">Recyclable Waste</option>
									</select>
								</div>
								<div class="form-group">
									<label class="control-label text-primary">Specification</label>
									<select class="form-control" id="wasteSpecs" name="spec" pattern="[A-Za-z]{1,10}" required readonly="true">
										<option value="">--Please Select--</option>
										<option value="peels of vegetables and fruits , paper , Wood">peels of vegetables and Fruits , Paper , Wood</option>
										<option value="plastics, glass battles , cans , styrofoam">plastics, glass battles , cans , styrofoam</option>
										<option value="computers , televison, washing machine , aircon ,refrigerator ,light bulb">computers , televison, washing machine , aircon ,refrigerator ,light bulb</option>
										<option value="plastic cups , strew , plastic utensils , aluminum cans, mix paper">plastic cups , strew , plastic utensils , aluminum cans, mix paper</option>
									</select>
								</div>
								<div class="form-group">
									<label class="control-label text-primary">Waste kg.</label>
									<input type="text" class="form-control" placeholder="Collection by Kg." name="wastecat_kg" required>
								</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-success">Done</button>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
