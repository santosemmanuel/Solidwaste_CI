<!-- Begin Page Content -->
<!--<div class="container-fluid">-->
<!---->
<!--	Page Heading -->
<!--	<div class="d-sm-flex align-items-center justify-content-between mb-4">-->
<!--		<h1 class="h3 mb-0 text-gray-800">Concern</h1>-->
<!--	</div>-->
<!---->
<!--	Content Row -->
<!--	<div class="row">-->
<!--		<div class="col-12">-->
<!--			<div class="card">-->
<!--				<div class="card-body">-->
<!--					<table class="table table-striped table-sm">-->
<!--						<thead>-->
<!--						<tr>-->
<!--							<th scope="col" colspan="2">Message</th>-->
<!--						</tr>-->
<!--						</thead>-->
<!--						<tbody>-->
<!--						--><?php //foreach($list_concern as $concern){ ?>
<!--							<tr>-->
<!--								<td width="85%">-->
<!--									<p>-->
<!--										--><?php //if($concern->sender == 1){ ?>
<!--											<strong>Admin</strong>-->
<!--										--><?php //} else {?>
<!--											<strong>You</strong>-->
<!--										--><?php //} ?>
<!--										<br>--><?php //echo $concern->message; ?>
<!--									</p>-->
<!--								</td>-->
<!--								<td>-->
<!--									<div class="float-right">-->
<!--										<button type="button" class="btn btn-link btn-sm"><i class="fa fa-trash" aria-hidden="true"></i>-->
<!--										</button>-->
<!--									</div>-->
<!--									<small>--><?php //echo $concern->message_date; ?><!--</small>-->
<!--								</td>-->
<!--							</tr>-->
<!--						--><?php //}?>
<!--						</tbody>-->
<!--					</table>-->
<!--				</div>-->
<!--			</div>-->
<!--		</div>-->
<!--	</div>-->
<!-- /.container-fluid -->
<!--</div>-->

<div class="container bootstrap snippets bootdey">
	<hr>
	<div class="row">
<!--		<div class="col-sm-3 col-md-2">-->
<!--			<a href="#" class="btn btn-success btn-sm btn-block" role="button" data-toggle="modal" data-target="#concern">-->
<!--				<i class="glyphicon glyphicon-edit"></i> Compose-->
<!--			</a>-->
<!--			<hr>-->
<!--		</div>-->
		<div class="col-sm-9 col-md-12">
			<!-- Nav tabs -->
			<ul class="nav nav-pills">
				<li class="nav-item active"><a class="nav-link" href="#home" data-toggle="tab"><span class="glyphicon glyphicon-inbox">
                </span>Primary</a></li>
				<li class="nav-item"><a class="nav-link" href="#profile" data-toggle="tab"><span class="glyphicon glyphicon-user"></span>
						Social</a></li>
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
<div class="modal fade" id="concern" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formAddWastecat" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title font-weight-bold text-primary mx-3 mt-3" id="formAddWastecatLabel">Send Concern</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form name="form_add_mahasiswa" action="<?php echo base_url().'concerns/sendConcern/user' ?>" method="post" class="user needs-validation mx-3 mb-4" id="requestForm" novalidate>
				<div class="modal-body">
					<div class="form-row">
						<label for="exampleFormControlTextarea1">Input Message</label>
						<textarea class="form-control" id="exampleFormControlTextarea1" name="message" rows="5"></textarea>
					</div><br>
				</div>
				<div class="modal-footer d-flex">
					<button type="button" class="flex-fill btn btn-danger btn-user" data-dismiss="modal">Cancel</button>
					<button type="submit" class="flex-fill btn btn-success btn-user">Send</button>
				</div>
			</form>
		</div>
	</div>
</div>
