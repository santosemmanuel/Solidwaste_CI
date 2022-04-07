    <!-- Custom made script for this project-->
    <script src="<?php echo base_url().'assets/js/script.js' ?>"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url().'assets/vendor/jquery/jquery.min.js' ?>"></script>

	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="<?php echo base_url().'assets/vendor/bootstrap/js/bootstrap.min.js' ?>"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="<?php echo base_url().'assets/vendor/bootstrap/js/bootstrap.bundle.min.js' ?>"></script>
    <script src="<?php echo base_url().'assets/vendor/jquery/jquery-ui.min.js'?>"></script>
    <!-- Costum Javascript code -->
    <script>var base_url = "<?= base_url()?>";</script>
    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url().'assets/vendor/jquery-easing/jquery.easing.min.js' ?>"></script>
    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url().'assets/js/sb-admin-2.min.js' ?>"></script>
    <!-- Page level plugins for Tables-->
    <script src="<?php echo base_url().'assets/vendor/datatables/jquery.dataTables.min.js' ?>"></script>
    <script src="<?php echo base_url().'assets/vendor/datatables/dataTables.bootstrap4.min.js' ?>"></script>
    <!-- Page level custom scripts for Tables-->
    <script src="<?php echo base_url().'assets/js/demo/datatables-demo.js' ?>"></script>
	<script src="<?php echo base_url().'assets/vendor/bootstrap-select/js/bootstrap-select.min.js'?>"></script>
	<script src="<?php echo base_url()."assets/vendor/fullcalendar/main.js"?>"></script>
	<?php if(isset($calendarJs)){?>
		<script src="<?php echo base_url()."assets/js/calendar_function.js"?>"></script>
	<?php } ?>
	<script src="<?php echo base_url().'assets/js/index.js'?>"></script>


</body>

</html>
