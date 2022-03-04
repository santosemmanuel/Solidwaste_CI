                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between">
                            <h4 class="my-auto font-weight-bold text-primary">Transaction Data</h4>
                            <a href="#" class="btn btn-success shadow-sm" data-toggle="modal" data-target="#addTransac"><i
                                class="fas fa-plus fa-sm text-white-500"></i> Add New Transaction</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-primary">
                                            <th>#</th>
                                            <th>Transc. ID</th>
                                            <th>Municipality</th>
                                            <th>Waste Category</th>
                                            <th>Weight</th>
                                            <th>Total</th>
                                            <th>Collection Date</th>
                                            <th>Finished Date</th>
                                            <th class="actions">Actions</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <?php
                                            $no = 1;
                                            foreach ($data_transac as $transac) {
                                        ?>
                                        <tr>
                                            <th><?php echo $no++ ?></th>
                                            <td>
                                                <?php if ($transac->end_date == '0000-00-00') { ?>
                                                    <span class="badge badge-danger">Not Finished Yet</span><br>
                                                <?php } 
                                                    echo $transac->transac_id;
                                                ?>
                                            </td>
                                            <td>
                                                <span class="row px-3 text-primary text-xs"><?php echo $transac->municipal_id ?></span>
                                                <span class="row px-3"><?php echo $transac->name_municipal?></span>
                                            </td>
                                            <td>
                                                <span class="row px-3 text-primary text-xs"><?php echo $transac->wastecat_id ?></span>
                                                <span class="row px-3"><?php echo $transac->name_wastecat ?></span>
                                            </td>
                                            <td><?php echo $transac->weight ?> KG</td>
                                            <td><?php echo $transac->total ?></td>
                                            <td><?php echo $transac->start_date ?></td>
                                            <td><?php if ($transac->end_date == '0000-00-00') { echo '-'; } else { echo $transac->end_date; } ?></td>
                                            <td class="action-icons">

                                                <?php if ($transac->end_date == '0000-00-00') { ?>

                                                <a target="blank" href="<?php echo base_url().'transac/print_nota/'.$transac->transac_id?>" class="btn btn-sm rounded-lg btn-primary mb-2"> Note</a><br>

                                                <a href="<?php echo base_url().'transac/done/'.$transac->transac_id?>" class="btn btn-sm rounded-lg btn-success mb-2">Complete</a><br>

                                                <?php } ?>
                                                <a href="#" data-toggle="modal" data-target="#editTransac<?php echo $no-1 ?>"> 
                                                    <i title="ubah" class="fas fa-edit text-lg text-info"></i>
                                                </a>
                                                 <a href="<?php echo base_url().'transac/delete/'.$transac->transac_id?>" onclick="return confirm('Are You sure to delete?')"> 
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
            <div class="modal fade" id="addTransac" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formAddTransa" caria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold text-primary mx-3 mt-3" id="formAddTransacLabel">Input Transaction Data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form name="form_add_transac" action="<?php echo base_url().'transac/add' ?>" method="post" class="user needs-validation mx-3 mb-4" novalidate>
                            <div class="modal-body"> 
                                <div class="form-group">
                                    <label class="control-label text-primary">Municipality</label>
                                    <select class="form-control" name="municipal_id" required>
                                        <option value="">--Please Select--</option>
                                        <?php
                                            foreach ($data_municipal as $municipal) {
                                        ?>
                                        <option value="<?php echo $municipal->municipal_id ?>">
                                            <?php echo $municipal->municipal_id.' '.$municipal->name_municipal ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                    <div class="invalid-feedback">
                                       Choose a municipality identity!
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label text-primary">Waste Category</label>
                                    <select class="form-control" name="wastecat_id" required>
                                        <option value="">--Please Select--</option>
                                        <?php
                                            foreach ($data_wastecat as $wastecat) {
                                                if ($wastecat->aktif == 1) {
                                        ?>
                                        <option value="<?php echo $wastecat->wastecat_id ?>">
                                            <?php echo $wastecat->wastecat_id.' '.$wastecat->name_wastecat ?>
                                        </option>
                                        <?php }} ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Choose waste category identity!
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label text-primary">Weight (kg)</label>
                                    <input type="number"  class="form-control" placeholder='Waste Weight' name="weight"  required>
                                    <div class="invalid-feedback">
                                        Fillup Waste Weight!
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label text-primary">Collection Date</label>
                                    <input type="date"  class="form-control" placeholder='start date Date' name="start_date" required>
                                    <div class="invalid-feedback">
                                        Fill in the date!
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label text-primary">Finished Date</label>
                                    <input type="date"  class="form-control" placeholder='Finished Date' name="end_date">
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
                $no = 1;
                foreach ($data_transac as $transac) {
            ?>
            <div class="modal fade" id="editTransac<?php echo $no ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formEditTransac" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold text-primary mx-3 mt-3" id="formEditTransacLabel">Edit Transaction Data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form name="form_edit_matakuliah" action="<?php echo base_url().'transac/edit' ?>" method="post" class="user needs-validation mx-3 mb-4" novalidate>
                            <div class="modal-body"> 
                                <div class="form-group d-none">
                                    <label class="control-label text-primary">ID Transactions</label>
                                    <input type="text"  class="form-control" name="transac_id" value="<?php echo $transac->transac_id ?>" required readonly>
                                </div>                                
                                <div class="form-group">
                                    <label class="control-label text-primary">Municipality</label>
                                    <select class="form-control" name="municipal_id" required>
                                        <option value="">--Please Select--</option>
                                        <?php
                                            foreach ($data_municipal as $municipal) {
                                        ?>
                                        <option value="<?php echo $municipal->municipal_id ?>" <?php if ($municipal->municipal_id === $transac->municipal_id) { echo "selected"; } ?>>
                                            <?php echo $municipal->municipal_id.' '.$municipal->name_municipal?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                    <div class="invalid-feedback">
                                       Choose a identity!
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label text-primary">Waste Category</label>
                                    <select class="form-control" name="wastecat_id" required>
                                        <option value="">--Please Select--</option>
                                        <?php
                                            foreach ($data_wastecat as $wastecat) {
                                                if ($wastecat->aktif == 1) {
                                        ?>
                                        <option value="<?php echo $wastecat->wastecat_id ?>" <?php if ($wastecat->wastecat_id === $transac->wastecat_id) { echo "selected"; } ?>>
                                            <?php echo $wastecat->wastecat_id.' '.$wastecat->name_wastecat ?>
                                        </option>
                                        <?php }} ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Choose waste category identity!
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label text-primary">Weight (kg)</label>
                                    <input type="number"  class="form-control" placeholder='waste Weight' name="weight" value="<?php echo $transac->weight ?>" required>
                                    <div class="invalid-feedback">
                                        Fillup wastecat Weight!
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label text-primary">Start Date</label>
                                    <input type="date"  class="form-control" placeholder='Start Date' name="start_date" value="<?php echo $transac->start_date ?>" required>
                                    <div class="invalid-feedback">
                                        Fill in the date !
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label text-primary">Finished Date</label>
                                    <input type="date"  class="form-control" placeholder='Finished Date' name="end_date" value="<?php echo $transac->end_date ?>">
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
                $no++;
                }
            ?>