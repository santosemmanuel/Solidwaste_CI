                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between">
                            <h4 class="my-auto font-weight-bold text-primary">Municipality Data</h4>
                            <a href="#" class="btn btn-success shadow-sm" data-toggle="modal" data-target="#addMunicipal"><i
                                class="fas fa-plus fa-sm text-white-500"></i> Add Municipality</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-primary">
                                            <th>#</th>
                                            <th>ID</th>
                                            <th><center>Municipality</center><center><sup>(Zipcode)</center></sup></th>
                                            <th>Province</th>
                                            <th>Barangay/Poblacion</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <?php
                                            $no = 1;
                                            $kode = '';
                                            $n_municipal = count($data_municipal);
                                            if ($n_municipal == 0) {
                                                $kode = 'M001';
                                            } else {
                                                $last_id = (int) substr($data_municipal[$n_municipal-1]->municipal_id, 3, 1);
                                                $kode = 'M00'.($last_id + 5);
                                            }
                                            foreach ($data_municipal as $municipal) {
                                        ?>
                                        <tr>
                                            <th><?php echo $no++ ?></th>
                                            <td><?php echo $municipal->municipal_id ?></td>
                                            <td><?php echo $municipal->name_municipal.' ' ?><sup>(<?php echo substr($municipal->zipcode, 0, 50) ?>)</sup></td>
                                            <td><?php echo $municipal->province ?></td>
                                            <td><?php echo $municipal->barangay ?></td>
                                            <td class="action-icons">
                                                <a href="#" data-toggle="modal" data-target="#editMunicipal<?php echo $municipal->municipal_id ?>"> 
                                                    <i title="ubah" class="fas fa-edit text-lg text-info"></i>
                                                </a>
                                                <a href="<?php echo base_url().'municipal/delete/'.$municipal->municipal_id?>" onclick="return confirm('Are You sure to delete?')"> 
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

            <!-- Modal for adding new data -->
            <div class="modal fade" id="addMunicipal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formAddMunicipal" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold text-primary mx-3 mt-3" id="formAddMunicipalLabel">Municipal Data Input</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form name="form_add_mahasiswa" action="<?php echo base_url().'municipal/add' ?>" method="post" class="user needs-validation mx-3 mb-4" novalidate>
                            <div class="modal-body"> 
                                <div class="form-group">
                                    <label class="control-label text-primary">ID</label>
                                    <input type="text" class="form-control" placeholder="Municipal ID" autofocus name="municipal_id" required readonly value="<?php echo $kode ?>">
                                </div>
                                <div class="form-group">
                                    <label class="control-label text-primary">Municipality</label>
                                    <input type="text" class="form-control" title="Fill in the customer's name with letters" placeholder='Municipal Name'  name="name_municipal" pattern="[A-Za-z ]{1,50}" required>
                                    <div class="invalid-feedback">
                                    Fill in the customer's name with letters! (max. 50 letters)
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label text-primary">Zipcode</label>
                                    <select class="form-control" name="zipcode" pattern="[A-Za-z]{1,10}" required>
                                        <option value="">--Please Select--</option>
                                        <option value="6516">6516</option>
                                                                           </select>
                                    <div class="invalid-feedback">
                                    Choose the gender of the customer!
                                    </div>
                                </div>

                               

                                <div class="form-group">
                                    <label class="control-label text-primary">Province</label>
                                    <input type="text"  class="form-control" placeholder='Province' name="province"  required>
                                    <div class="invalid-feedback">
                                    Enter the customer's address!
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label text-primary">Barangay/Poblacion</label>
                                   
                                    <select class="form-control" name="barangay"  pattern="[A-Za-z]{1,50}" required>
                                        <option value="">--Please Select--</option>
                                        <option value="Poblacion District I">Poblacion District I</option>
                                        <option value="Poblacion District II">Poblacion District II</option>
                                        <option value="Poblacion District III">Poblacion District III</option>
                                        <option value="Poblacion District IV">Poblacion District IV</option>
                                        <option value="Poblacion District V">Poblacion District V</option>
                                        <option value="Poblacion District VI">Poblacion District VI</option>
                                        <option value="Poblacion District VII">Poblacion District VII</option>
                                        <option value="Poblacion District VIII">Poblacion District VIII</option>
                                        <option value="Poblacion District IX">Poblacion District IX</option>
                                    </select>
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

            <!-- Modal for editing existing data -->
            <?php
                foreach ($data_municipal as $municipal) {
            ?>
            <div class="modal fade" id="editMunicipal<?php echo $municipal->municipal_id ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formEditMunicipal" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold text-primary mx-3 mt-3" id="formEditMunicipalLabel">Change Municipality Data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form name="form_edit_mahasiswa" action="<?php echo base_url().'municipal/edit' ?>" method="post" class="user needs-validation mx-3 mb-4" novalidate>
                            <div class="modal-body"> 
                                <div class="form-group">
                                    <label class="control-label text-primary">ID</label>
                                    <input type="text" class="form-control" placeholder="Customer ID" autofocus name="municipal_id" value="<?php echo $municipal->municipal_id ?>" readonly>
                                </div>
                                <hr>

                                <div class="form-group">
                                    <label class="control-label text-primary">Municipality</label>
                                    <input type="text" class="form-control" title="Fill in the customer's name with letters" placeholder='Customers Name'  name="name_municipal" pattern="[A-Za-z ]{1,50}" value="<?php echo $municipal->name_municipal?>" required>
                                    <div class="invalid-feedback">
                                    Fill in the customer's name with letters! (max. 50 letters)
                                    </div>
                                </div>
                                <hr>

                                <div class="form-group">
                                    <label class="control-label text-primary">Zipcode</label>
                                    <select class="form-control" name="col_day" pattern="[A-Za-z]{1,10}" required>
                                        <option value="">--Please Select--</option>
                                        <option value="Male" <?php if ($municipal->zipcode === '6516') { echo "selected"; } ?>>6516</option>
                                        
                                    </select>
                                    <div class="invalid-feedback">
                                    Choose the gender of the customer!
                                    </div>
                                </div>
                                <hr>

                                <div class="form-group">
                                    <label class="control-label text-primary">Province</label>
                                    <input type="text"  class="form-control" placeholder='Province' name="province"  value="<?php echo $municipal->province ?>" required>
                                    <div class="invalid-feedback">
                                    Enter the customer's address!
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label text-primary">Baragay/Poblacion</label>
                                  
                                    <select class="form-control" name="barangay"pattern="[A-Za-z]{1,50}" required>
                                        <option value="">--Please Select--</option>
                                        <option value="Poblacion District I">Poblacion District I</option>
                                        <option value="Poblacion District II">Poblacion District II</option>
                                        <option value="Poblacion District III">Poblacion District III</option>
                                        <option value="Poblacion District IV">Poblacion District IV</option>
                                        <option value="Poblacion District V">Poblacion District V</option>
                                        <option value="Poblacion District VI">Poblacion District VI</option>
                                        <option value="Poblacion District VII">Poblacion District VII</option>
                                        <option value="Poblacion District VIII">Poblacion District VIII</option>
                                        <option value="Poblacion District IX">Poblacion District IX</option>
                                    </select>

                                
                                   
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
            <?php
                }
            ?>

            

            