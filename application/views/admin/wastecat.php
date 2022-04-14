                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between">
                            <h4 class="my-auto font-weight-bold text-primary">Waste Category Data</h4>
                        </div>
                        <div class="card-body">
							<form class="form-inline" method="post" id="wasteReportForm">
								<label class="sr-only" for="inlineFormInputName2">Name</label>
								<select class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" name="reportCat">
									<option value="daily">Daily</option>
									<option value="weekly">Weekly</option>
									<option value="monthly">Monthly</option>
								</select>

								<div class="input-group mb-2 mr-sm-2">
									<input type="text" class="form-control" id="dateByWeek" placeholder="Select Date">
								</div>

								<button type="submit" class="btn btn-primary mb-2">Submit</button>
							</form><br>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-primary">
                                            <th>#</th>
                                            <th>ID</th>
                                            <th>Waste Category</th>
                                            <th>Specification</th>
                                            <th>Collection by kg.</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <?php
                                            $no = 1;
                                            foreach ($data_wastecat as $wastecat) {
                                        ?>
                                        <tr>
                                            <th><?php echo $no++ ?></th>
                                            <td><?php echo $wastecat->wastecat_id ?></td>
                                            <td><?php echo $wastecat->name_wastecat; ?></td>
                                            <td><?php echo $wastecat->spec ?></td>
                                            <td></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->


