                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
						<div class="col-12">
							<div id="dashboardMap" class="map"></div>
							<div id="popup" class="ol-popup" hidden="hidden">
								<a href="#" id="popup-closer" class="ol-popup-closer"></a>
								<div id="popup-content">
									<form action="<?php echo base_url()."dashboard/updateRequest"?>" method="post" id="recieveRequest">
										<p id="requestTitle"></p>
										<input type="hidden" name="requestID" hidden="hidden" id="requestID">
										<select name="driver">
											<?php foreach($driver_data as $driver){ ?>
												<option value="<?= $driver->driver_info_id?>">
													<?php
													$firstLetter = substr($driver->firstName, 0 , 1);
													echo $firstLetter.". ".$driver->lastName; ?>
												</option>
											<?php }?>
										</select>
										<select name="truck">
											<?php foreach($truck_data as $truck){ ?>
												<option value="<?= $truck->id?>">
													<?php echo $truck->truck_no."-".$truck->truck_model;?>
												</option>
											<?php }?>
										</select><br><br>
										<button type="submit" class="btn btn-sm btn-secondary">Submit</button>
									</form>
								</div>
							</div>
						</div>
                    </div><br>
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-body">
									<div class="float-right">
										<button type="button" id="printChart" class="btn btn-info">
											<i class="fas fa-print"></i> Print
										</button>
										<button type="button" id="pdfChart" class="btn btn-info">
											<i class="fas fa-file-pdf"></i> Export PDF
										</button>
									</div>
									<form class="form-inline" method="post" id="chartReport">
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
								<canvas id="myChart"></canvas>
								</div>
							</div>
						</div>
					</div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
