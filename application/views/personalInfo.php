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
					<a href="#" data-toggle="modal" data-target="#viewBusiness<?php echo $user_data[0]->user_id ?>" class="btn btn-light">
						Show more
					</a>
					<a href="#" data-toggle="modal" class="btn btn-info" data-target="#editPersonal<?= $user_data[0]->user_id?>">
						<i class="fas fa-edit text-lg"></i> Edit
					</a>
					<a href="#" data-toggle="modal" class="btn btn-danger" data-target="#deletePersonal">
						<i class="fas fa-trash text-lg"></i> Delete / Deativate Account
					</a>
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
						<table class="table" id="requestTable">
							<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Request Date</th>
								<th scope="col">Request Info</th>
								<th scope="col">Action</th>
							</tr>
							</thead>
							<tbody>

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
<div class="modal fade" id="editPersonal<?= $user_data[0]->user_id ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formEditMunicipal" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title font-weight-bold text-primary mx-3 mt-3" id="formEditMunicipalLabel">Change User Data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" action="<?php echo base_url()."usersection/edit/".$user_data[0]->user_id."/1";?>" name="editUserModal">
					<div class="form-row">
						<div class="col">
							<label for="exampleInputEmail1">First Name</label>
							<input type="text" class="form-control" aria-describedby="" name="firstName" placeholder="First Name" value="<?= $user_data[0]->firstName ?>">
						</div>
						<div class="col">
							<label for="exampleInputPassword1">Middle Name</label>
							<input type="text" class="form-control" name="middleName" placeholder="Middle Name" value="<?= $user_data[0]->middleName ?>">
						</div>
					</div>
					<div class="form-row">
						<div class="col">
							<label for="exampleInputPassword1">Last Name</label>
							<input type="text" class="form-control" name="lastName" placeholder="Last Name" value="<?= $user_data[0]->lastName ?>">
						</div>
						<div class="col">
							<label for="exampleInputPassword1">Contact Number</label>
							<input type="text" class="form-control" name="contactNumber" placeholder="(e.g. 09123456789)" value="<?= $user_data[0]->phoneNumber ?>">
						</div>
					</div>
					<div class="form-row">
						<div class="col">
							<label for="exampleInputEmail1">Username</label>
							<input type="text" class="form-control" aria-describedby="" name="userName" placeholder="Username" value="<?= $user_data[0]->username ?>">
						</div>
						<div class="col">
							<label for="exampleInputPassword1">Password</label>
							<input type="password" class="form-control" name="password" placeholder="Password" value="<?php echo base64_decode($user_data[0]->password) ?>">
						</div>
						<div class="col">
							<label for="exampleInputPassword1">Re-type Password</label>
							<input type="password" class="form-control" name="reTypePassword" placeholder="Re-type Password">
						</div>
					</div>
					<div class="form-row">
						<div class="col">
							<label for="exampleInputPassword1">Real Estate Type</label>
							<select class="form-control" name="realEstate">
								<option value="residential" <?php if ($user_data[0]->realEstate == 'residential'){ echo "selected"; }?> >Residential</option>
								<option value="commercial" <?php if ($user_data[0]->realEstate == 'commercial'){ echo "selected"; }?>>Commercial</option>
								<option value="industrial" <?php if ($user_data[0]->realEstate == 'industrial'){ echo "selected"; }?>>Industrial</option>
							</select>
						</div>
						<div class="col">
							<label for="exampleInputPassword1">Select Brgy.</label>
							<select class="form-control" name="barangay">
								<option <?php if ($user_data[0]->brgy == 1){ echo "selected"; }?> value="1">Poblacion District I</option>
								<option <?php if ($user_data[0]->brgy == 2){ echo "selected"; }?> value="2">Poblacion District II</option>
								<option <?php if ($user_data[0]->brgy == 3){ echo "selected"; }?> value="3">Poblacion District III</option>
								<option <?php if ($user_data[0]->brgy == 4){ echo "selected"; }?> value="4">Poblacion District IV</option>
								<option <?php if ($user_data[0]->brgy == 5){ echo "selected"; }?> value="5">Poblacion District V</option>
								<option <?php if ($user_data[0]->brgy == 6){ echo "selected"; }?> value="6">Poblacion District VI</option>
								<option <?php if ($user_data[0]->brgy == 7){ echo "selected"; }?> value="7">Poblacion District VII</option>
								<option <?php if ($user_data[0]->brgy == 8){ echo "selected"; }?> value="8">Poblacion District VIII</option>
								<option <?php if ($user_data[0]->brgy == 9){ echo "selected"; }?> value="9">Poblacion District IX</option>
							</select>
						</div>
						<div class="col">
							<label for="exampleInputPassword1">Address</label>
							<input type="text" class="form-control" name="address" placeholder="Street name" value="<?= $user_data[0]->street?>">
						</div>
					</div>

					<div class="form-row commercialIndustry" style="<?php if ($user_data[0]->realEstate == 'residential'){ echo 'display:none';}?>">
						<div class="col">
							<label for="exampleInputEmail1">Business Name</label>
							<input type="text" class="form-control" aria-describedby="" name="businessName" placeholder="Business Name" value="<?= $user_data[0]->businessName?>">
						</div>
						<div class="col">
							<label for="exampleInputPassword1">Business Type</label>
							<select class="form-control" name="businessType">
								<option <?php if ($user_data[0]->businessType == 'Sole Proprietorship'){ echo "selected"; }?>>Sole Proprietorship</option>
								<option <?php if ($user_data[0]->businessType == 'Partnership'){ echo "selected"; }?>>Partnership</option>
								<option <?php if ($user_data[0]->businessType == 'Limited Partnership'){ echo "selected"; }?>>Limited Partnership</option>
								<option <?php if ($user_data[0]->businessType == 'Corporation'){ echo "selected"; }?>>Corporation</option>
								<option <?php if ($user_data[0]->businessType == 'limited liability company'){ echo "selected"; }?>>limited liability company (LLC)</option>
								<option <?php if ($user_data[0]->businessType == 'Non-profit'){ echo "selected"; }?>>Non-profit</option>
								<option <?php if ($user_data[0]->businessType == 'Co-op'){ echo "selected"; }?>>Co-op</option>
							</select>
						</div>
						<div class="col">
							<label for="exampleInputPassword1">Business Permit Number</label>
							<input type="number" class="form-control" name="businessPermit" placeholder="Business Permit Number" value="<?= $user_data[0]->permitNumber?>">
						</div>
					</div><br>

					<div class="row">
						<div id="viewMap1<?= $user_data[0]->user_id ?>" class="map"></div>
						<input type="hidden" name="coordinate" value="">
					</div>
			</div>
			<div class="modal-footer d-flex">
				<button type="button" class="flex-fill btn btn-danger btn-user" data-dismiss="modal">Cancel</button>
				<button type="submit" class="flex-fill btn btn-success btn-user">Save</button>
			</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="deletePersonal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formEditMunicipal" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title font-weight-bold text-primary mx-3 mt-3" id="formEditMunicipalLabel">Delete User Data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form name="form_edit_mahasiswa" action="<?php echo base_url().'usersection/deletePersonal/'.$user_data[0]->user_id ?>" method="post" class="user needs-validation mx-3 mb-4" novalidate>
				<br><p>Are you sure you want to delete <strong><?php echo $user_data[0]->lastName.", ".$user_data[0]->firstName." ".$user_data[0]->middleName?></strong>?</p>
				<div class="modal-footer d-flex">
					<button type="button" class="flex-fill btn btn-danger btn-user" data-dismiss="modal">Cancel</button>
					<button type="submit" class="flex-fill btn btn-warning btn-user">Delete</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="viewBusiness<?php echo $user_data[0]->user_id ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formEditMunicipal" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title font-weight-bold text-primary mx-3 mt-3" id="formEditMunicipalLabel">User Info Data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="viewUserMap">
					<ul class="list-inline">
						<li class="list-inline-item"><strong>Barangay/Poblacion:</strong> <?= $user_data[0]->barangay?></li>
						<li class="list-inline-item"><strong>Street:</strong> <?php echo $user_data[0]->password ?></li>
					</ul><hr>
					<div class="row">
						<div id="viewMap<?= $user_data[0]->user_id ?>" class="map"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
