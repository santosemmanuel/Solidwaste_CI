<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
	</div>

	<!-- Content Row -->
	<div class="row">
		<div class="col-6">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><?php echo $user_data[0]->lastName.", ".$user_data[0]->firstName." ".$user_data[0]->middleName;?></h4>
					<hr>
					<ul class="list-inline">
						<li class="list-inline-item"><strong>Username:</strong> <?= $user_data[0]->username?></li>
						<li class="list-inline-item"><strong>Password:</strong> <?php echo $user_data[0]->password ?></li>
						<li class="list-inline-item"><strong>Contact Number:</strong> <?= $user_data[0]->phoneNumber ?></li>
						<br><br><li class="list-inline-item"><strong>Read Estate:</strong> <?= $user_data[0]->realEstate ?></li>
					</ul><hr>
					<?php if($user_data[0]->realEstate == 'commercial' || $user_data[0]->realEstate == 'industrial') {?>
					<ul class="list-inline">
						<li class="list-inline-item"><strong>Business Permit Number:</strong> <?= $user_data[0]->permitNumber ?></li>
						<li class="list-inline-item"><strong>Business Name:</strong> <?= $user_data[0]->businessName?></li>
						<li class="list-inline-item"><strong>Business Type:</strong> <?= $user_data[0]->businessType?></li>
					</ul>
					<?php }?>
					<a href="#" class="btn btn-light">Show more</a>
					<a href="#" class="btn btn-info">Edit</a>
					<a href="#" class="btn btn-danger">Delete / Deativate Account</a>
				</div>
			</div>
		</div>
		<div class="col-6">
			<div>
				<button type="button" data-toggle="modal" data-target="#request" class="btn btn-success btn-lg" style="padding: 25px 45px 25px 45px"><i class="fas fa-truck"></i> Send Request</button>
				<button type="button" data-toggle="modal" data-target="#concern" class="btn btn-secondary btn-lg" style="padding: 25px 50px 25px 50px"><i class="fas fa-comment"></i> Send Concern</button>
			</div><br>
			<div>
				<div class="card" >
					<div class="card-body">
						<h5 class="card-title">List of Request(s)</h5>
						<table class="table">
							<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Request Date</th>
								<th scope="col">Request Info</th>
								<th scope="col">Action</th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<th scope="row">1</th>
								<td>Mark</td>
								<td>Otto</td>
								<td>@mdo</td>
							</tr>
							<tr>
								<th scope="row">2</th>
								<td>Jacob</td>
								<td>Thornton</td>
								<td>@fat</td>
							</tr>
							<tr>
								<th scope="row">3</th>
								<td>Larry</td>
								<td>the Bird</td>
								<td>@twitter</td>
							</tr>
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

<div class="modal fade" id="request" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formAddWastecat" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title font-weight-bold text-primary mx-3 mt-3" id="formAddWastecatLabel">Send Collection Request</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form name="form_add_mahasiswa" action="<?php echo base_url().'dashboard/addRequest' ?>" method="post" class="user needs-validation mx-3 mb-4" novalidate>
				<div class="modal-body">
					<div class="form-row">
						<div class="col">
							<label class="control-label text-primary">ID</label>
							<input type="text" class="form-control" placeholder="ID " autofocus name="wastecat_id" required readonly value="">
						</div>
						<div class="col">
							<label class="control-label text-primary">Date</label>
							<input type="text" class="form-control" placeholder="Collection Date" name="request_date" id="datepicker" readonly required>
						</div>
					</div><br>
				</div>
				<div class="modal-footer d-flex">
					<button type="button" class="flex-fill btn btn-danger btn-user" data-dismiss="modal">Cancel</button>
					<button type="submit" class="flex-fill btn btn-success btn-user">Send Request</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="concern" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formAddWastecat" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title font-weight-bold text-primary mx-3 mt-3" id="formAddWastecatLabel">Send Concern</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form name="form_add_mahasiswa" action="<?php echo base_url().'dashboard/addRequest' ?>" method="post" class="user needs-validation mx-3 mb-4" id="requestForm" novalidate>
				<div class="modal-body">
					<div class="form-row">
						<label for="exampleFormControlTextarea1">Example textarea</label>
						<textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
					</div><br>
				</div>
				<div class="modal-footer d-flex">
					<button type="button" class="flex-fill btn btn-danger btn-user" data-dismiss="modal">Cancel</button>
					<button type="submit" class="flex-fill btn btn-success btn-user">Save</button>
				</div>
			</form>
		</div>
	</div>
</div>
