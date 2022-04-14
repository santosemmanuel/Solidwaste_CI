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
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
