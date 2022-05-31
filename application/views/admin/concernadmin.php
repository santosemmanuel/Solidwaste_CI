<!-- Begin Page Content-->
<div class="container-fluid">

<!--	Page Heading-->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800"> List of Concern(s)</h1>
	</div>

<!--	Content Row-->
	<div class="row">
		<div class="col-12">
			<div class="container bootstrap snippets bootdey">
				<hr>
				<div class="row">
					<div class="col-sm-9 col-md-12">
						<!-- Nav tabs -->
						<ul class="nav nav-pills">
							<li class="nav-item"><a class="nav-link active" href="#home" data-toggle="tab"><span class="glyphicon glyphicon-inbox">
                			</span>Primary</a></li>
						</ul><br>
						<!-- Tab panes -->
						<div class="tab-content">
							<div class="tab-pane fade show active" id="home">
								<div class="list-group list-group-flush" id="concern_list"></div>
							</div>
							<div class="tab-pane fade in" id="profile">
								<div class="list-group">
									<div class="list-group-item">
										<span class="text-center">This tab is empty.</span>
									</div>
								</div>
							</div>
						</div><br>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- /.container-fluid-->
</div>
<div class="modal fade" id="deleteConcernModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title font-weight-bold text-primary mx-3 mt-3" id="formEditMunicipalLabel">Delete Concern Data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form name="form_edit_mahasiswa" action="<?php echo base_url().'concerns/deleteUserConcern/'?>" method="post" class="user needs-validation mx-3 mb-4" novalidate>
				<input type="text" id="deleteConcernID" name="deleteConcernID" hidden>
				<br><p>Are you sure you want to delete this concern ?</p>
				<div class="modal-footer d-flex">
					<button type="button" class="flex-fill btn btn-danger btn-user" data-dismiss="modal">Cancel</button>
					<button type="submit" class="flex-fill btn btn-warning btn-user">Delete</button>
				</div>
			</form>
		</div>
	</div>
</div>
