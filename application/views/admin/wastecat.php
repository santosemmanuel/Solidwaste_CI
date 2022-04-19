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
									<input type="text" class="form-control week-picker" name="dateWaste" id="dateByWeek"  autocomplete="off" placeholder="Select Date">
								</div>
								<button type="submit" class="btn btn-primary mb-2">Submit</button>
							</form>
							<div class="float-right">
								<button type="button" id="printTable" class="btn btn-info">
									<i class="fas fa-print"></i> Print
								</button>
								<button type="button" id="pdfTable" class="btn btn-info">
									<i class="fas fa-file-pdf"></i> Export PDF
								</button>
							</div>
							<br>
                            <br><div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-primary">
                                            <th width="200">Date</th>
                                            <th>Biodegrable Waste</th>
                                            <th>Residual Waste</th>
                                            <th>Special Waste</th>
											<th>Recyclable Waste</th>
											<th>Total</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->


