<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Waste Info</h1>
	</div>

	<!-- Content Row -->
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr class="text-primary">
									<th>#</th>
									<th>Request Date</th>
									<th>Waste Category</th>
									<th>Waste Kg.</th>
									<th>Driver</th>
									<th>Truck</th>
									<th>Date PickUp</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								foreach($requestWasteList as $requestList) {?>
										<tr>
											<td><?= $no++?></td>
											<td><?= $requestList->request_date?></td>
											<td><?= $requestList->name_wastecat?></td>
											<td><?= $requestList->waste_kg?></td>
											<td>
												<?php echo $requestList->lastName.", ".$requestList->firstName;?>
											</td>
											<td>
												<?php echo $requestList->truck_model."(".$requestList->truck_color.") - ".$requestList->plate_no;?>
											</td>
											<td><?= $requestList->date_pickup ?></td>
										</tr>
								<?php }?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
