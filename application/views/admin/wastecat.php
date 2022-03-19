                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between">
                            <h4 class="my-auto font-weight-bold text-primary">Waste Category Data</h4>
                            <a href="#" class="btn btn-success shadow-sm" data-toggle="modal" data-target="#addWastecat"><i
                                class="fas fa-plus fa-sm text-white-500"></i> Add Waste Category Data</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-primary">
                                            <th>#</th>
                                            <th>ID</th>
                                            <th>Waste Category & Collection Day <sup>(Monday/Tuesday/Wednesday/Thursday/Friday/Saturday/Sunday)</sup></th>
                                            <th>Collection Date</th>
                                            <th>Specification</th>
                                            <th>Collection by kg.</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <?php
                                            $no = 1;
                                            $kode = '';
                                            $n_wastecat = count($data_wastecat);
                                            if ($n_wastecat == 0) {
                                                $kode = 'W001';
                                            } else {
                                                $last_id = (int) substr($data_wastecat[$n_wastecat-1]->wastecat_id, 3, 1);
                                                $kode = 'W00'.($last_id+1);
                                            }
                                            foreach ($data_wastecat as $wastecat) {
                                        ?>
                                        <tr>
                                            <th><?php echo $no++ ?></th>
                                            <td><?php echo $wastecat->wastecat_id ?></td>
                                            <td><?php echo $wastecat->name_wastecat.' ' ?><sup>(<?php echo substr($wastecat->col_day, 0, 8) ?>)</sup><br>
                                                <?php if ($wastecat->aktif == 1) { ?>
                                                    <span class="badge badge-success">Pending</span>
                                                <?php } else if ($wastecat->aktif == 2) { ?>
                                                    <span class="badge badge-info">Pending</span>
                                                <?php } ?>
                                            </td>
                                            <td><?php echo $wastecat->col_date; ?></td>
                                            <td><?php echo $wastecat->spec ?></td>
                                            <td><?php echo $wastecat->collection_kg ?></td>
                                            <td class="action-icons">
                                                <a href="#" data-toggle="modal" data-target="#editWastecat<?php echo $wastecat->wastecat_id ?>"> 
                                                    <i title="ubah" class="fas fa-edit text-lg text-info"></i>
                                                </a>
                                                <?php if ($wastecat->wastecat_id != 'W000') { ?>
                                                <a href="#" data-toggle="modal" data-target="#deleteWastecat<?= $wastecat->wastecat_id ?>"> 
                                                    <i title="hapus" class="fas fa-trash text-lg text-danger"></i>
                                                </a>
                                                <?php } ?>
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
            <div class="modal fade" id="addWastecat" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formAddWastecat" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold text-primary mx-3 mt-3" id="formAddWastecatLabel">Input Waste Category data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form name="form_add_mahasiswa" action="<?php echo base_url().'wastecat/add' ?>" method="post" class="user needs-validation mx-3 mb-4" novalidate>
                            <div class="modal-body"> 
                                <div class="form-group">
                                    <label class="control-label text-primary">ID</label>
                                    <input type="text" class="form-control" placeholder="ID " autofocus name="wastecat_id" required readonly value="<?php echo $kode ?>">
                                </div>
                                <div class="form-group">
                                    <label class="control-label text-primary">Date of Collection</label>
                                    <input type="text" class="form-control" placeholder="Collection Date" name="wastecat_date" id="datepicker" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label text-primary">Collection Day</label>
                                    <input type="text" class="form-control" placeholder="Collection Day" name="wastecat_day" id="datepicker2" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label text-primary">Waste Category </label>
                                   <select class="form-control" id="wastecat_name" name="name_wastecat" pattern="[A-Za-z]{1,10}" required>
                                        <option value="">--Please Select--</option>
                                        <option value="Biodegrable Waste">Biodegrable Waste</option>
                                        <option value="Residual Waste">Residual Waste(Non-biodegradable)</option>
                                        <option value="Special Waste">Special Waste(Electro waste)</option>
                                        <option value="Recyclable Waste">Recyclable Waste</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label text-primary">Specification</label>
                                    <select class="form-control" id="wasteSpecs" name="spec" pattern="[A-Za-z]{1,10}" required readonly="true">
                                        <option value="">--Please Select--</option>
                                        <option value="peels of vegetables and fruits , paper , Wood">peels of vegetables and Fruits , Paper , Wood</option>
                                        <option value="plastics, glass battles , cans , styrofoam">plastics, glass battles , cans , styrofoam</option>
                                        <option value="computers , televison, washing machine , aircon ,refrigerator ,light bulb">computers , televison, washing machine , aircon ,refrigerator ,light bulb</option>
                                        <option value="plastic cups , strew , plastic utensils , aluminum cans, mix paper">plastic cups , strew , plastic utensils , aluminum cans, mix paper</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label text-primary">Daily Kg. Collection</label>
                                    <input type="text" class="form-control" placeholder="Collection by Kg." name="wastecat_kg" required>
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
                foreach ($data_wastecat as $wastecat) {
            ?>
            <div class="modal fade" id="editWastecat<?php echo $wastecat->wastecat_id ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formEditWastecat" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold text-primary mx-3 mt-3" id="formEditWastecatLabel">Change Waste Category Data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form name="form_edit_mahasiswa" action="<?php echo base_url().'wastecat/edit' ?>" method="post" class="user needs-validation mx-3 mb-4" novalidate>
                            <div class="modal-body"> 
                                <div class="form-group">
                                    <label class="control-label text-primary">ID</label>
                                    <input type="text" class="form-control" placeholder="Waste ID" autofocus name="wastecat_id" value="<?php echo $wastecat->wastecat_id ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label class="control-label text-primary">Date of Collection</label>
                                    <input type="text" class="form-control" placeholder="Collection Date" value="<?= $wastecat->col_date?>" name="wastecat_date" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label text-primary">Collection Day</label>
                                    <input type="text" class="form-control" placeholder="Collection Day" value="<?= $wastecat->col_day?>" name="wastecat_day" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label text-primary">Waste Category</label>
                                     <select class="form-control" name="name_wastecat" pattern="[A-Za-z]{1,10}" required>
                                        <option value="">--Please Select--</option>
                                        <option value="Biodegrable Waste" <?php if ($wastecat->name_wastecat === 'Biodegrable Waste') { echo "selected"; } ?>>Biodegrable Waste</option>
                                        <option value="Residual Waste" <?php if ($wastecat->name_wastecat === 'Residual Waste') { echo "selected"; } ?>>Residual Waste</option>
                                        <option value="Special Waste" <?php if ($wastecat->name_wastecat === 'Special Waste') { echo "selected"; } ?>>Special Waste</option>
                                        <option value="Recyclable Waste" <?php if ($wastecat->name_wastecat === 'Recyclable Waste') { echo "selected"; } ?>>Recyclable Waste</option>
                                    </select>
                                </div>

                                 <div class="form-group">
                                    <label class="control-label text-primary">Specification</label>
                                   <select class="form-control" name="spec" pattern="[A-Za-z]{1,10}" required readonly>
                                        <option value="">--Please Select--</option>
                                        <option value="peels of vegetables and Fruits , Paper , Wood" <?php if (strcmp(strtolower($wastecat->spec),strtolower("peels of vegetables and Fruits , Paper , Wood")) == 0) { echo "selected"; } ?>>
                                            peels of vegetables and Fruits , Paper , Wood
                                        </option>
                                        <option value="plastics, glass battles , cans , styrofoam" <?php if (strcmp(strtolower($wastecat->spec),strtolower("plastics, glass battles , cans , styrofoam")) == 0) { echo "selected"; } ?>>
                                            plastics, glass battles , cans , styrofoam
                                        </option>
                                        <option value="computers , televison, washing machine , aircon ,refrigerator ,light bulb" <?php if (strcmp(strtolower($wastecat->spec), strtolower("computers , televison, washing machine , aircon ,refrigerator ,light bulb")) == 0) { echo "selected"; } ?>>
                                            computers , televison, washing machine , aircon ,refrigerator ,light bulb
                                        </option>
                                        <option value="plastic cups , strew , plastic utensils , aluminum cans, mix paper" <?php if (strcmp(strtolower($wastecat->spec), strtolower("plastic cups , strew , plastic utensils , aluminum cans, mix paper")) == 0) { echo "selected"; } ?>>
                                            plastic cups , strew , plastic utensils , aluminum cans, mix paper
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label text-primary">Daily Kg. Collection</label>
                                    <input type="text" class="form-control" placeholder="Collection by Kg." value="<?= $wastecat->collection_kg ?>" name="wastecat_kg" required>
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
           
            <!-- Delete Waste Category -->
            <div class="modal fade" id="deleteWastecat<?= $wastecat->wastecat_id ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formAddWastecat" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold text-primary mx-3 mt-3" id="formAddWastecatLabel">Delete Waste Category data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="<?php echo base_url().'wastecat/delete/'.$wastecat->wastecat_id?>" method="post">
                            <div class="modal-body">
                                <p>Are you sure you want to delete <strong><?= $wastecat->name_wastecat ?></strong>?!</p>
                            </div>
                            <div class="modal-footer d-flex">
                                <button type="button" class="flex-fill btn btn-danger btn-user" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="flex-fill btn btn-warning btn-user">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
                
            <?php
                }
            ?>