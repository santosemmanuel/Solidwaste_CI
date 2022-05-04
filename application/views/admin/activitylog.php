<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3 d-flex justify-content-between">
			<h4 class="my-auto font-weight-bold text-primary">Activity Log</h4>
			<form class="form-inline">
				<label class="sr-only" for="inlineFormInputName2">Name</label>
				<input type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="Select Date">
				<button type="submit" class="btn btn-primary mb-2">Search</button>
			</form>
		</div>
		<div class="card-body scroll">
		<?php
			foreach($activityLog as $logger) {
				echo "<p>".$logger['date_log']." - ".$logger['message_log']."</p>";
			}
		?>
		</div>
	</div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->


