                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between">
                            <h4 class="my-auto font-weight-bold text-primary">User List Data</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-primary">
                                            <th>#</th>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Barangay/Poblacion</th>
                                            <th>Street</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                            $no = 1;
                                            $kode = '';
                                            foreach ($data_usersection as $usersection) {
                                        ?>
                                        <tr>
                                            <th><?php echo $no++ ?></th>
                                            <td><?php echo $usersection->user_id ?></td>
                                            <td><?php echo $usersection->lastName.", ".$usersection->firstName." ".$usersection->middleName ?></td>
                                            <td><?php echo $usersection->barangay ?></td>
                                            <td><?php echo $usersection->street ?></td>
                                            <td class="action-icons">
                                                <a href="#" data-toggle="modal" data-target="#viewBusiness<?php echo $usersection->user_id ?>"> 
                                                    <i title="ubah" class="fas fa-eye text-lg text-success"></i>
                                                </a>
                                                <a href="#" data-toggle="modal" data-target="#editMunicipal<?php echo $usersection->user_id ?>"> 
                                                    <i title="ubah" class="fas fa-edit text-lg text-info"></i>
                                                </a>
                                                <a href="#" data-toggle="modal" data-target="#deleteUser<?php echo $usersection->user_id ?>"> 
                                                    <i title="hapus" class="fas fa-trash text-lg text-danger"></i>
                                                </a>
                                            </td>
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

            <!-- Modal for editing existing data -->
            <?php
                foreach ($data_usersection as $usersection) {
            ?>
            <div class="modal fade" id="editMunicipal<?php echo $usersection->user_id ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formEditMunicipal" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold text-primary mx-3 mt-3" id="formEditMunicipalLabel">Change User Data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="<?php echo base_url()."usersection/edit/".$usersection->user_id;?>" name="editUserModal">
                                <div class="form-row">
                                    <div class="col">
                                        <label for="exampleInputEmail1">First Name</label>
                                        <input type="text" class="form-control" aria-describedby="" name="firstName" placeholder="First Name" value="<?= $usersection->firstName ?>">
                                    </div>
                                    <div class="col">
                                        <label for="exampleInputPassword1">Middle Name</label>
                                        <input type="text" class="form-control" name="middleName" placeholder="Middle Name" value="<?= $usersection->middleName ?>">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <label for="exampleInputPassword1">Last Name</label>
                                        <input type="text" class="form-control" name="lastName" placeholder="Last Name" value="<?= $usersection->lastName ?>">
                                    </div>
                                    <div class="col">
                                        <label for="exampleInputPassword1">Contact Number</label>
                                        <input type="text" class="form-control" name="contactNumber" placeholder="(e.g. 09123456789)" value="<?= $usersection->phoneNumber ?>">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <label for="exampleInputEmail1">Username</label>
                                        <input type="text" class="form-control" aria-describedby="" name="userName" placeholder="Username" value="<?= $usersection->username ?>">
                                    </div>
                                    <div class="col">
                                        <label for="exampleInputPassword1">Password</label>
                                        <input type="password" class="form-control" name="password" placeholder="Password" value="<?php echo base64_decode($usersection->password) ?>">
                                    </div>
                                    <div class="col">
                                        <label for="exampleInputPassword1">Re-type Password</label>
                                        <input type="password" class="form-control" name="reTypePassword" placeholder="Re-type Password">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <label for="exampleInputPassword1">Real Estate Type</label>
                                        <select class="form-control" name="realEstate">
                                            <option value="residential" <?php if ($usersection->realEstate == 'residential'){ echo "selected"; }?> >Residential</option>
                                            <option value="commercial" <?php if ($usersection->realEstate == 'commercial'){ echo "selected"; }?>>Commercial</option>
                                            <option value="industrial" <?php if ($usersection->realEstate == 'industrial'){ echo "selected"; }?>>Industrial</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="exampleInputPassword1">Select Brgy.</label>
                                        <select class="form-control" name="barangay">
                                            <option <?php if ($usersection->brgy == 1){ echo "selected"; }?> value="1">Poblacion District I</option>
                                            <option <?php if ($usersection->brgy == 2){ echo "selected"; }?> value="2">Poblacion District II</option>
                                            <option <?php if ($usersection->brgy == 3){ echo "selected"; }?> value="3">Poblacion District III</option>
                                            <option <?php if ($usersection->brgy == 4){ echo "selected"; }?> value="4">Poblacion District IV</option>
                                            <option <?php if ($usersection->brgy == 5){ echo "selected"; }?> value="5">Poblacion District V</option>
                                            <option <?php if ($usersection->brgy == 6){ echo "selected"; }?> value="6">Poblacion District VI</option>
                                            <option <?php if ($usersection->brgy == 7){ echo "selected"; }?> value="7">Poblacion District VII</option>
                                            <option <?php if ($usersection->brgy == 8){ echo "selected"; }?> value="8">Poblacion District VIII</option>
                                            <option <?php if ($usersection->brgy == 9){ echo "selected"; }?> value="9">Poblacion District IX</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="exampleInputPassword1">Address</label>
                                        <input type="text" class="form-control" name="address" placeholder="Street name" value="<?= $usersection->street?>">
                                    </div>
                                </div>

                                <div class="form-row commercialIndustry" style="<?php if ($usersection->realEstate == 'residential'){ echo 'display:none';}?>">
                                    <div class="col">
                                        <label for="exampleInputEmail1">Business Name</label>
                                        <input type="text" class="form-control" aria-describedby="" name="businessName" placeholder="Business Name" value="<?= $usersection->businessName?>">
                                    </div>
                                    <div class="col">
                                        <label for="exampleInputPassword1">Business Type</label>
                                        <select class="form-control" name="businessType">
                                            <option <?php if ($usersection->businessType == 'Sole Proprietorship'){ echo "selected"; }?>>Sole Proprietorship</option>
                                            <option <?php if ($usersection->businessType == 'Partnership'){ echo "selected"; }?>>Partnership</option>
                                            <option <?php if ($usersection->businessType == 'Limited Partnership'){ echo "selected"; }?>>Limited Partnership</option>
                                            <option <?php if ($usersection->businessType == 'Corporation'){ echo "selected"; }?>>Corporation</option>
                                            <option <?php if ($usersection->businessType == 'limited liability company'){ echo "selected"; }?>>limited liability company (LLC)</option>
                                            <option <?php if ($usersection->businessType == 'Non-profit'){ echo "selected"; }?>>Non-profit</option>
                                            <option <?php if ($usersection->businessType == 'Co-op'){ echo "selected"; }?>>Co-op</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="exampleInputPassword1">Business Permit Number</label>
                                        <input type="number" class="form-control" name="businessPermit" placeholder="Business Permit Number" value="<?= $usersection->permitNumber?>">
                                    </div>
                                </div><br>
                        
                                <div class="row">
                                    <div id="viewMap1<?= $usersection->user_id ?>" class="map"></div>
                                    <input type="hidden" name="coordinate" value="">
                                </div>
                            </div>
                            <div class="modal-footer d-flex">
                                <button type="button" class="flex-fill btn btn-danger btn-user" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="flex-fill btn btn-success btn-user">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="deleteUser<?php echo $usersection->user_id ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formEditMunicipal" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold text-primary mx-3 mt-3" id="formEditMunicipalLabel">Delete User Data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form name="form_edit_mahasiswa" action="<?php echo base_url().'usersection/delete/'.$usersection->user_id ?>" method="post" class="user needs-validation mx-3 mb-4" novalidate>
                            <br><p>Are you sure you want to delete <strong><?php echo $usersection->lastName.", ".$usersection->firstName." ".$usersection->middleName?></strong>?</p>
                            <div class="modal-footer d-flex">
                                <button type="button" class="flex-fill btn btn-danger btn-user" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="flex-fill btn btn-warning btn-user">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="viewBusiness<?php echo $usersection->user_id ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formEditMunicipal" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold text-primary mx-3 mt-3" id="formEditMunicipalLabel">User Info Data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="viewUserMap">
                            <ul class="list-inline">
                                <li class="list-inline-item"><strong>Username:</strong> <?= $usersection->username?></li>
                                <li class="list-inline-item"><strong>Password:</strong> <?php echo $usersection->password ?></li>
                                <li class="list-inline-item"><strong>Contact Number:</strong> <?= $usersection->phoneNumber ?></li>
                                <br><br><li class="list-inline-item"><strong>Read Estate:</strong> <?= $usersection->realEstate ?></li>
                            </ul><hr>
                            <?php if($usersection->realEstate == 'commercial' || $usersection->realEstate == 'industrial') {?>
                            <ul class="list-inline">
                                <li class="list-inline-item"><strong>Business Permit Number:</strong> <?= $usersection->permitNumber ?></li>
                                <li class="list-inline-item"><strong>Business Name:</strong> <?= $usersection->businessName?></li>
                                <li class="list-inline-item"><strong>Business Type:</strong> <?= $usersection->businessType?></li>
                            </ul>
                            <?php }?>
                            <div class="row">
                                <div id="viewMap<?= $usersection->user_id ?>" class="map"></div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                }
            ?>

            

