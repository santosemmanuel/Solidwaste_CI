<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3 d-flex justify-content-between">
			<h4 class="my-auto font-weight-bold text-primary">Recycle Bin</h4>
		</div>
		<div class="card-body scroll" id="loggerContent">
			<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">User(s)</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Driver</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Truck</a>
				</li>
			</ul>
			<div class="tab-content" id="pills-tabContent">
				<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
					<div class="table-responsive">
						<table class="table table-bordered table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
							<thead>
							<tr class="text-primary">
								<th>#</th>
								<th>ID</th>
								<th>Name</th>
								<th>Barangay/Poblacion</th>
								<th>Street</th>
								<th>Action</th>
							</tr>
							</thead>

							<tbody>
							<?php
							$no = 1;
							$kode = '';
							foreach ($deletedUserList as $usersection) {
								?>
								<tr>
									<th><?php echo $no++ ?></th>
									<td><?php echo $usersection->user_id ?></td>
									<td><?php echo $usersection->lastName.", ".$usersection->firstName." ".$usersection->middleName ?></td>
									<td><?php echo $usersection->barangay ?></td>
									<td><?php echo $usersection->street ?></td>
									<td class="action-icons">
										<a href="<?php echo base_url()."settings/restore_UserDriver/".$usersection->user_id;?>" class="btn btn-sm btn-info">
											<i title="ubah" class="fas fa-undo"></i> Restore
										</a>
									</td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
					<div class="table-responsive">
						<table class="table table-bordered table-hover table-striped" id="dataTable1" width="100%" cellspacing="0">
							<thead>
							<tr class="text-primary">
								<th>#</th>
								<th>Name</th>
								<th>PhoneNumber</th>
								<th>Drivers License</th>
								<th>Barangay</th>
								<th>Street</th>
								<th>Action</th>
							</tr>
							</thead>
							<tbody>
							<?php
							$num = 1;
							foreach($deletedDriverList as $driver) {?>
								<tr>
									<td><?php echo $num++; ?></td>
									<td><?php echo $driver->lastName.",".$driver->firstName." ".$driver->middleName; ?></td>
									<td><?php echo $driver->phoneNumber; ?></td>
									<td><?php echo $driver->driversLicense; ?></td>
									<td><?php echo $driver->brgy; ?></td>
									<td><?php echo $driver->street;?></td>
									<td class="action-icons">
										<a href="<?php echo base_url()."settings/restore_UserDriver/".$driver->user_id;?>" class="btn btn-sm btn-info">
											<i title="ubah" class="fas fa-undo"></i> Restore
										</a>
									</td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
					<div class="table-responsive">
						<table class="table table-bordered table-hover table-striped" id="dataTable2" width="100%" cellspacing="0">
							<thead>
							<tr class="text-primary">
								<th>#</th>
								<th>Truck Model</th>
								<th>Plate Number</th>
								<th>Truck Color / Identification</th>
								<th>Action</th>
							</tr>
							</thead>
							<tbody>
							<?php
							$num = 1;
							foreach($deletedTruckList as $truck) {?>
								<tr>
									<td><?php echo $num++; ?></td>
									<td><?= $truck->truck_model ?></td>
									<td><?= $truck->plate_no ?></td>
									<td><?= $truck->truck_color ?></td>
									<td class="action-icons">
										<a href="<?php echo base_url()."settings/restore_Truck/".$truck->id;?>" class="btn btn-sm btn-info">
											<i title="ubah" class="fas fa-undo"></i> Restore
										</a>
									</td>
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
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->


