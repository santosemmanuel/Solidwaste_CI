                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between">
                            <h4 class="my-auto font-weight-bold text-primary">Administrator</h4>
                            <a href="#" class="btn btn-success shadow-sm" data-toggle="modal" data-target="#addAdmin"><i
                                class="fas fa-plus fa-sm text-white-500"></i>Add Administrator</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <?php if($_GET['delete'] == "error"){ ?>
                                    <div class="alert alert-danger" role="alert" id="alertMessage">There's an error in deleting an admin.</div>
                                <?php }?>
                                <table class="table table-bordered table-hover table-striped" id="dataTableAdmin" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-primary">
                                            <th>#</th>
                                            <th>ID</th>
                                            <th>First Name</th>
                                            <th>Middle Name</th>
                                            <th>Last Name</th>
                                            <th>Username</th>
                                            <th>Password</th>
                                            <th colspan="2">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $no = 1;
                                            foreach ($adminUsers as $value) { 
                                        ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $value->user_id ?></td>
                                                <td><?= $value->firstName ?></td>
                                                <td><?= $value->middleName ?></td>
                                                <td><?= $value->lastName ?></td>
                                                <td><?= $value->username ?></td>
                                                <td><?= base64_decode($value->password) ?></td>
                                                <td><a href="#" data-toggle="modal" data-target="#editAdmin<?= $value->user_id ?>"> 
                                                        <i title="ubah" class="fas fa-edit text-lg text-info"></i>
                                                    </a></td>
                                                <td> <a href="#" data-toggle="modal" data-target="#deleteAdmin<?= $value->user_id ?>"> 
                                                        <i title="hapus" class="fas fa-trash text-lg text-danger"></i>
                                                    </a></td>
                                            </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <!-- /.container-fluid -->

                <!-- Modal for adding new data -->
            <div class="modal fade" id="addAdmin" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formAddWastecat" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold text-primary mx-3 mt-3" id="formAddWastecatLabel">Add Administrator</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="submitAdmin">
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
                                        <label for="validationCustom02">Username</label>
                                        <input type="text" class="form-control" name="userName" placeholder="Username">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="validationCustom02">Password</label>
                                        <input type="password" class="form-control" name="password" placeholder="Password">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="validationCustom05">Re-type Password</label>
                                        <input type="passwordu" class="form-control" name="reTypePassword" placeholder="Re-Type Password">
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

            <!-- Edit Items -->
            <?php foreach($adminUsers as $value) {?>
            <div class="modal fade" id="editAdmin<?= $value->user_id ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formAddWastecat" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold text-primary mx-3 mt-3" id="formAddWastecatLabel">Edit Administrator</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="submiteditAdmin" method="post">
                            <div class="modal-body">
                                <div class="alert alert-danger" id="alertMessage<?= $value->user_id ?>" role="alert" hidden="hidden"></div>
                                <div class="form-row">
                                <input type="text" class="form-control" name="userID" value="<?= $value->user_id ?>" hidden="hidden">
                                    <div class="col-md-4 mb-3">
                                        <label for="validationCustom01">First name</label>
                                        <input type="text" class="form-control" name="firstName" value="<?= $value->firstName ?>" placeholder="First name">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="validationCustom02">Middle name</label>
                                        <input type="text" class="form-control" name="middleName" value="<?= $value->middleName ?>" placeholder="Middle name">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="validationCustom02">Last name</label>
                                        <input type="text" class="form-control" name="lastName" value="<?= $value->lastName ?>" placeholder="Last name">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                        <label for="validationCustom02">Username</label>
                                        <input type="text" class="form-control" name="userName" value="<?= $value->username ?>" placeholder="Username">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="validationCustom02">New Password</label>
                                        <input type="password" class="form-control" value="<?= base64_decode($value->password)?>" name="password" placeholder="Password">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="validationCustom05">Re-type New Password</label>
                                        <input type="password" class="form-control" value="<?= base64_decode($value->password)?>" name="reTypePassword" placeholder="Re-Type Password">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer d-flex">
                                <button type="button" class="flex-fill btn btn-danger btn-user" data-dismiss="modal">Cancel</button>
                                <input type="submit" class="flex-fill btn btn-info btn-user" value="Edit"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Delete Item -->
            <div class="modal fade" id="deleteAdmin<?= $value->user_id ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formAddWastecat" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold text-primary mx-3 mt-3" id="formAddWastecatLabel">Delete Administrator</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Do you want to Delete <strong><?php echo $value->lastName.", ".$value->firstName; ?></strong>?</p>
                        </div>
                        <div class="modal-footer d-flex">
                            <button type="button" class="flex-fill btn btn-danger btn-user" data-dismiss="modal">Cancel</button>
                            <a href="<?php echo base_url()."settings/deleteAdmin/".$value->user_id; ?>" type="submit" class="flex-fill btn btn-warning btn-user">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php }?>
        

           

            

            