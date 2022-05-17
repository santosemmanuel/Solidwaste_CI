<!-- Begin Page Content-->
<div class="container-fluid">

	<!--	Page Heading-->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Concern</h1>
	</div>

	<!--	Content Row-->
	<div class="row">
		<div class="col-2">
			<a href="#" class="btn btn-success btn-sm btn-block" role="button" data-toggle="modal" data-target="#conversationConcernAdmin">
				<i class="glyphicon glyphicon-edit"></i> Compose
			</a>
		</div>
	</div><hr>
	<div class="row">
		<div class="col-12">
			<div class="list-group list-group-flush" id="conversation_list"></div>
		</div>
	</div><br>
	<!-- /.container-fluid-->
</div>

<div class="modal fade" id="conversationConcernAdmin" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formAddWastecat" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title font-weight-bold text-primary mx-3 mt-3" id="formAddWastecatLabel">Send Concern</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form name="form_add_mahasiswa" action="<?php echo base_url().'concerns/sendConcern/admin/';?>" method="post" class="user needs-validation mx-3 mb-4" id="requestForm" novalidate>
				<div class="modal-body">
					<div class="form-row">
						<input type="text" name="sendTo" value="<?php echo $this->uri->segment(3); ?>" hidden/>
					</div>
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
<script>
	var userConversationID = '<?php echo $this->uri->segment(3);?>';
</script>
