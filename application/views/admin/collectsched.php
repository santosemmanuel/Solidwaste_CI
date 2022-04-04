                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between">
                            <h4 class="my-auto font-weight-bold text-primary">Collection Schedule</h4>
                            <!-- <a href="#" class="btn btn-success shadow-sm" data-toggle="modal" data-target="#addMunicipal"><i
                                class="fas fa-plus fa-sm text-white-500"></i> Add Municipality</a> -->
                        </div>
                        <div class="card-body">
                        <div id='calendar'></div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
				<div class="modal fade bd-example-modal-lg" id="collectSched" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Add Collection Sched</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<form method="post" action="<?php echo base_url()."collectionSched/addCollectionSched"?>" id="collectSchedForm">
								<div class="modal-body">
									<div class="form-row">
										<?php
											$kode = '';
											$n_collectID = count($collectionID);
											if ($n_collectID == 0) {
												$kode = 'C001';
											} else {
												$last_id = (int) substr($collectionID[$n_collectID-1]->collection_id, 3, 1);
												$kode = 'C00'.($last_id+1);
											}
										?>
										<div class="form-group col-md-6">
											<label>Collection ID</label>
											<input type="text" class="form-control" name="collectionID" value="<?= $kode ;?>" readonly>
										</div>
										<div class="form-group col-md-6">
											<label>Date</label>
											<input type="text" class="form-control" name="collectionDate">
										</div>
									</div>
									<div class="btn-group" role="group" aria-label="Basic example">
										<button type="button" id="addAssign" class="btn btn-success">+</button>
										<button type="button" id="removeAssign" class="btn btn-danger">-</button>
									</div>
									<hr>
									<div class="assignCopy">
										<div class="form-row">
											<div class="form-group col-md-4">
												<label for="inputAddress">Assign Driver</label>
												<select name="driver[0][]" id="" class="form-control">
													<option value="">Select Driver</option>
													<?php foreach($driverData as $driver) {?>
															<option value="<?= $driver->user_id?>">
																<?php echo $driver->lastName.", ".$driver->firstName;?>
															</option>
													<?php }?>
												</select>
											</div>
											<div class="form-group col-md-4">
												<label for="inputAddress2">Assign Truck</label>
												<select name="truck[0][]" id="" class="form-control">
													<option value="">Select Truck</option>
													<?php foreach($truckData as $truck) {?>
														<option value="<?= $truck->id ?>">
															<?php echo $truck->truck_no."-".$truck->truck_model.",".$truck->truck_color;?>
														</option>
													<?php } ?>
												</select>
											</div>
											<div class="form-group col-md-4">
												<label for="inputAddress2">Assign Location</label>
												<select name="brgy[0][]" class="selectpicker" multiple>
													<option value="1">
														Poblacion District I														</option>
													<option value="2">
														Poblacion District II														</option>
													<option value="3">
														Poblacion District III														</option>
													<option value="4">
														Poblacion District IV														</option>
													<option value="5">
														Poblacion District V														</option>
													<option value="6">
														Poblacion District VI														</option>
													<option value="7">
														Poblacion District VII														</option>
													<option value="8">
														Poblacion District VIII														</option>
													<option value="9">
														Poblacion District IX														</option>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary">Save changes</button>
								</div>
							</form>
						</div>
					</div>
				</div>

				<div class="modal fade bd-example-modal-lg" id="collectEditSubmitDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Collection Sched</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
								<div class="modal-body">
									<p>Select a function for this sched or event.</p>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									<button type="button" id="editSchedButton" data-toggle="modal" data-target="#editSched" class="btn btn-primary">Edit</button>
									<button type="button" id="delSchedButton" data-toggle="modal" data-target="#deleteSched" class="btn btn-danger">Delete</button>
									<button type="button" class="btn btn-success">Finish</button>
								</div>
						</div>
					</div>
				</div>
				<div class="modal fade bd-example-modal-lg" id="deleteSched" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Collection Sched</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<p>Are you sure you want to delete this Sched?</p>
								<form action="<?php echo base_url()."collectionsched/deleteCollection"?>" method="post">
									<input type="hidden" name="schedID" />
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-danger">Delete</button>
							</div>
								</form>
						</div>
					</div>
				</div>
				<div class="modal fade bd-example-modal-lg" id="editSched" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Collection Sched</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary">Edit</button>
							</div>
							</form>
						</div>
					</div>
				</div>
