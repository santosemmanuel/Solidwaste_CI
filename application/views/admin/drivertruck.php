                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between">
                            <h4 class="my-auto font-weight-bold text-primary">Driver and Truck Section</h4>
                            <!-- <a href="#" class="btn btn-success shadow-sm" data-toggle="modal" data-target="#addMunicipal"><i
                                class="fas fa-plus fa-sm text-white-500"></i> Add Municipality</a> -->
                        </div>
                        <div class="card-body">
                            <nav>
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Driver</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Truck</a>
                                    </li>
                                </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="py-3 d-flex justify-content-between">
                                    <h4 class="my-auto font-weight-bold text-primary">List of Driver's</h4>
                                    <a href="#" class="btn btn-success shadow-sm" data-toggle="modal" data-target="#addDriver"><i
                                    class="fas fa-plus fa-sm text-white-500"></i>&nbsp;Add Driver</a>
                                </div>
                                <div class="table-responsive">
                                    <?php if(isset($_GET['delete']) && $_GET['delete'] == "error"){ ?>
                                        <div class="alert alert-danger" role="alert" id="alertMessage">There's an error in deleting an admin.</div>
                                    <?php }?>
                                    <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr class="text-primary">
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>PhoneNumber</th>
                                                <th>Drivers License</th>
                                                <th>Barangay</th>
                                                <th>Street</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $num = 1;
                                                foreach($driverData as $driver) {?>
                                            <tr>
                                                <td><?php echo $num++; ?></td>
                                                <td><?php echo $driver->lastName.",".$driver->firstName." ".$driver->middleName; ?></td>
                                                <td><?php echo $driver->phoneNumber; ?></td>
                                                <td><?php echo $driver->driversLicense; ?></td>
                                                <td><?php echo $driver->brgy; ?></td>
                                                <td><?php echo $driver->street;?></td>
                                                <td class="action-icons">
                                                <a href="#" data-toggle="modal" data-target="#viewDriver<?php echo $driver->user_id ?>"> 
                                                    <i title="ubah" class="fas fa-eye text-lg text-success"></i>
                                                </a>
                                                <a href="#" data-toggle="modal" data-target="#editDriver<?php echo $driver->user_id ?>"> 
                                                    <i title="ubah" class="fas fa-edit text-lg text-info"></i>
                                                </a>
                                                <a href="#" data-toggle="modal" data-target="#deleteUser<?php echo $driver->user_id ?>"> 
                                                    <i title="hapus" class="fas fa-trash text-lg text-danger"></i>
                                                </a>    
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="py-3 d-flex justify-content-between">
                                        <h4 class="my-auto font-weight-bold text-primary">List of Truck's</h4>
                                        <a href="#" class="btn btn-success shadow-sm" data-toggle="modal" data-target="#addTruck"><i
                                        class="fas fa-plus fa-sm text-white-500"></i>&nbsp;Add Truck</a>
                                    </div>
                                    <div class="table-responsive">
                                        <?php if(isset($_GET['delete']) && $_GET['delete'] == "error"){ ?>
                                            <div class="alert alert-danger" role="alert" id="alertMessage">There's an error in deleting an admin.</div>
                                        <?php }?>
                                        <table class="table table-bordered table-hover table-striped" id="dataTable1" width="100%" cellspacing="0">
                                            <thead>
                                                <tr class="text-primary">
                                                    <th>#</th>
                                                    <th>Truck Model</th>
                                                    <th>Plate Number</th>
                                                    <th>Truck Color / Identification</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $num = 1;
                                                    foreach($truckData as $truck) {?>
                                                <tr>
                                                    <td><?php echo $num++; ?></td>
                                                    <td><?= $truck->truck_model ?></td>
                                                    <td><?= $truck->plate_no ?></td>
                                                    <td><?= $truck->truck_color ?></td>
                                                    <td class="action-icons">
                                                        <a href="#" data-toggle="modal" data-target="#editTruck<?= $truck->id ?>"> 
                                                            <i title="ubah" class="fas fa-edit text-lg text-info"></i>
                                                        </a>
                                                        <a href="#" data-toggle="modal" data-target="#deleteTruck<?= $truck->id ?>"> 
                                                            <i title="hapus" class="fas fa-trash text-lg text-danger"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php }?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Modal for adding driver data -->
            <div class="modal fade" id="addDriver" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formAddWastecat" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold text-primary mx-3 mt-3" id="formAddWastecatLabel">Add Driver</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="submitDriver" method="post">
                            <div class="modal-body">
                            <div class="alert alert-danger" role="alert" id="alertMessage"></div>
                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                        <label for="validationCustom01">First name</label>
                                        <input type="text" class="form-control" name="firstName" placeholder="First name">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="validationCustom02">Middle name</label>
                                        <input type="text" class="form-control" name="middleName" placeholder="Middle name">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="validationCustom02">Last name</label>
                                        <input type="text" class="form-control" name="lastName" placeholder="Last name">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                        <label for="validationCustom01">Phone number</label>
                                        <input type="text" class="form-control" name="phoneNumber" placeholder="Phone Number">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="validationCustom02">Drivers license</label>
                                        <input type="text" class="form-control" name="driversLicense" placeholder="Drivers License">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="exampleInputPassword1">Select Brgy.</label>
                                        <select class="form-control" name="barangay">   
                                            <option>Poblacion District I</option>
                                            <option>Poblacion District II</option>
                                            <option>Poblacion District III</option>
                                            <option>Poblacion District IV</option>
                                            <option>Poblacion District V</option>
                                            <option>Poblacion District VI</option>
                                            <option>Poblacion District VII</option>
                                            <option>Poblacion District VIII</option>
                                            <option>Poblacion District IX</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="validationCustom02">Street</label>
                                        <input type="text" class="form-control" name="address" placeholder="Street">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                        <label for="validationCustom02">Username</label>
                                        <input type="text" class="form-control" name="userName" placeholder="Username">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="validationCustom02">Password</label>
                                        <input type="password" class="form-control" name="password" placeholder="Password">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="validationCustom05">Re-type Password</label>
                                        <input type="password" class="form-control" name="reTypePassword" placeholder="Re-Type Password">
                                    </div>
                                </div>
                            </div> 
                            <div class="modal-footer d-flex">
                                <button type="button" class="flex-fill btn btn-danger btn-user" data-dismiss="modal">Cancel</button>
                                <input type="submit" class="flex-fill btn btn-success btn-user" value="Save"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal for adding truck data -->
            <div class="modal fade" id="addTruck" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formAddWastecat" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold text-primary mx-3 mt-3" id="formAddWastecatLabel">Add Truck</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="submitTruck" method="post">
                            <div class="modal-body">
                            <div class="alert alert-danger" role="alert" id="alertMessage1" hidden="hidden"></div>
                                <div class="form-row">
									<div class="col-md-2 mb-3">
										<label for="validationCustom01">Truck Number</label>
										<input type="text" class="form-control" name="truckNumber" value="<?php echo count($truckData) + 1;?>" readonly>
									</div>
                                    <div class="col-md-3 mb-3">
                                        <label for="validationCustom01">Plate Number</label>
                                        <input type="text" class="form-control" name="plateNumber" placeholder="Plate Number">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="validationCustom02">Truck Model</label>
                                        <input type="text" class="form-control" name="truckModel" placeholder="Truck Model">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="validationCustom02">Truck Color/Identification</label>
                                        <input type="text" class="form-control" name="truckColor" placeholder="Truck Color">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer d-flex">
                                <button type="button" class="flex-fill btn btn-danger btn-user" data-dismiss="modal">Cancel</button>
                                <input type="submit" class="flex-fill btn btn-success btn-user" value="Save"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php foreach($driverData as $driver) { ?>
            <!-- Delete Driver-->
            <div class="modal fade" id="deleteUser<?php echo $driver->user_id ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formEditMunicipal" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold text-primary mx-3 mt-3" id="formEditMunicipalLabel">Delete User Data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form name="form_edit_mahasiswa" action="<?php echo base_url().'drivertruck/delete/'.$driver->user_id ?>" method="post" class="user needs-validation mx-3 mb-4" novalidate>
                            <br><p>Are you sure you want to delete <strong><?php echo $driver->lastName.", ".$driver->firstName." ".$driver->middleName?></strong>?</p>
                            <div class="modal-footer d-flex">
                                <button type="button" class="flex-fill btn btn-danger btn-user" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="flex-fill btn btn-warning btn-user">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- View Driver -->
            <div class="modal fade" id="viewDriver<?php echo $driver->user_id ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formEditMunicipal" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold text-primary mx-3 mt-3" id="formEditMunicipalLabel">Delete User Data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="list-inline">
                                <li class="list-inline-item"><strong>Username:</strong> <?= $driver->username?></li>
                                <li class="list-inline-item"><strong>Password:</strong> <?php echo base64_decode($driver->password); ?></li>
                            </div>
                        </div>
                        <div class="modal-footer d-flex">
                            <button type="button" class="flex-fill btn btn-success btn-user" data-dismiss="modal">Okay</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Driver --> 
            <div class="modal fade" id="editDriver<?php echo $driver->user_id ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formAddWastecat" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold text-primary mx-3 mt-3" id="formAddWastecatLabel">Edit Driver</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="editDriverForm" method="post">
                            <div class="modal-body">
                            <div class="alert alert-danger" role="alert" id="alertMessage<?= $driver->user_id?>" hidden="hidden"></div>
                                <div class="form-row">
                                    <input type="hidden" name="driverID" value="<?= $driver->user_id?>">
                                    <div class="col-md-4 mb-3">
                                        <label for="validationCustom01">First name</label>
                                        <input type="text" class="form-control" name="firstName" value="<?= $driver->firstName ?>">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="validationCustom02">Middle name</label>
                                        <input type="text" class="form-control" name="middleName" value="<?= $driver->middleName ?>">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="validationCustom02">Last name</label>
                                        <input type="text" class="form-control" name="lastName" value="<?= $driver->lastName ?>">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                        <label for="validationCustom01">Phone number</label>
                                        <input type="text" class="form-control" name="phoneNumber" value="<?= $driver->phoneNumber ?>">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="validationCustom02">Drivers license</label>
                                        <input type="text" class="form-control" name="driversLicense" value="<?= $driver->driversLicense ?>">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="exampleInputPassword1">Select Brgy.</label>
                                        <select class="form-control" name="barangay">
                                            <option <?php if ($driver->brgy == 'Poblacion District I'){ echo "selected"; }?> >Poblacion District I</option>
                                            <option <?php if ($driver->brgy == 'Poblacion District II'){ echo "selected"; }?>>Poblacion District II</option>
                                            <option <?php if ($driver->brgy == 'Poblacion District III'){ echo "selected"; }?>>Poblacion District III</option>
                                            <option <?php if ($driver->brgy == 'Poblacion District IV'){ echo "selected"; }?>>Poblacion District IV</option>
                                            <option <?php if ($driver->brgy == 'Poblacion District V'){ echo "selected"; }?>>Poblacion District V</option>
                                            <option <?php if ($driver->brgy == 'Poblacion District VI'){ echo "selected"; }?>>Poblacion District VI</option>
                                            <option <?php if ($driver->brgy == 'Poblacion District VII'){ echo "selected"; }?>>Poblacion District VII</option>
                                            <option <?php if ($driver->brgy == 'Poblacion District VIII'){ echo "selected"; }?>>Poblacion District VIII</option>
                                            <option <?php if ($driver->brgy == 'Poblacion District IX'){ echo "selected"; }?>>Poblacion District IX</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="validationCustom02">Street</label>
                                        <input type="text" class="form-control" name="address" value="<?= $driver->street ?>">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                        <label for="validationCustom02">Username</label>
                                        <input type="text" class="form-control" name="userName" value="<?= $driver->username ?>">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="validationCustom02">Password</label>
                                        <input type="text" class="form-control" name="password" value="<?php echo base64_decode($driver->password); ?>">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="validationCustom05">Re-type Password</label>
                                        <input type="text" class="form-control" name="reTypePassword" placeholder="Re-Type Password">
                                    </div>
                                </div>
                            </div> 
                            <div class="modal-footer d-flex">
                                <button type="button" class="flex-fill btn btn-danger btn-user" data-dismiss="modal">Cancel</button>
                                <input type="submit" class="flex-fill btn btn-success btn-user" value="Edit"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php } ?>
            <?php foreach($truckData as $truck) {?>
            <div class="modal fade" id="deleteTruck<?php echo $truck->id ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formEditMunicipal" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold text-primary mx-3 mt-3" id="formEditMunicipalLabel">Delete User Data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form name="form_edit_mahasiswa" action="<?php echo base_url().'drivertruck/deleteTruck/'.$truck->id ?>" method="post" class="user needs-validation mx-3 mb-4" novalidate>
                            <br><p>Are you sure you want to delete <strong><?php echo $truck->truck_model." with plate no. ".$truck->plate_no; ?></strong>?</p>
                            <div class="modal-footer d-flex">
                                <button type="button" class="flex-fill btn btn-danger btn-user" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="flex-fill btn btn-warning btn-user">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="editTruck<?php echo $truck->id; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formAddWastecat" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold text-primary mx-3 mt-3" id="formAddWastecatLabel">Edit Truck</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="editTruck" method="post">
                            <div class="modal-body">
                            <div class="alert alert-danger" role="alert" id="alertMessage1" hidden="hidden"></div>
                                <div class="form-row">
                                    <input type="hidden" name="truckID" value="<?= $truck->id ?>">
                                    <div class="col-md-4 mb-3">
                                        <label for="validationCustom01">Plate Number</label>
                                        <input type="text" class="form-control" name="plateNumber" value="<?= $truck->plate_no?>">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="validationCustom02">Truck Model</label>
                                        <input type="text" class="form-control" name="truckModel" value="<?= $truck->truck_model ?>">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="validationCustom02">Truck Color or Identification</label>
                                        <input type="text" class="form-control" name="truckColor" value="<?= $truck->truck_color ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer d-flex">
                                <button type="button" class="flex-fill btn btn-danger btn-user" data-dismiss="modal">Cancel</button>
                                <input type="submit" class="flex-fill btn btn-success btn-user" value="Save"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php }?>
           
            

