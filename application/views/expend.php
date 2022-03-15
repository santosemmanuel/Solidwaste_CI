                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between">
                            <h4 class="my-auto font-weight-bold text-primary">Expenditure Data</h4>
                            <div class="d-flex">
                                <a href="<?php echo base_url()?>expend/bayar_gaji" class="mr-2 btn btn-warning shadow-sm"><i
                                class="fas fa-wallet fa-sm text-white-500"></i> Paid</a>
                                <a href="#" class="btn btn-success shadow-sm" data-toggle="modal" data-target="#addExpend"><i
                                    class="fas fa-plus fa-sm text-white-500"></i> Add Business Owner</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-primary">
                                            <th>#</th>
                                            <th>Expenditure ID</th>
                                            <th>Details</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                            <th>Waste Category</th>
                                            <th class="actions">Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <?php
                                            $no = 1;
                                            foreach ($data_expend as $expend) {
                                        ?>
                                        <tr>
                                            <th><?php echo $no++ ?></th>
                                            <td><?php echo $expend->expend_id ?></td>
                                            <td><?php echo $expend->detail ?></td>
                                            <td>₱<?php echo $expend->total ?></td>
                                            <td><?php echo $expend->start_expend ?></td>
                                            <td>
                                                <span class="row px-3 text-primary text-xs"><?php echo $expend->wastecat_id ?></span>
                                                <span class="row px-3"><?php echo $expend->name_wastecat ?></span>
                                            </td>
                                            <td class="action-icons">
                                                <a href="#" data-toggle="modal" data-target="#editExpend<?php echo $no-1 ?>"> 
                                                    <i title="ubah" class="fas fa-edit text-lg text-info"></i>
                                                </a>
                                             <a href="<?php echo base_url().'expend/delete/'.$expend->expend_id?>" onclick="return confirm('Are You sure to delete?')"> 
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
            <div class="modal fade" id="addExpend" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formAddExpend" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold text-primary mx-3 mt-3" id="formAddExpendLabel">Expenditure Data Input</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form name="form_add_transac" action="<?php echo base_url().'expend/add' ?>" method="post" class="user needs-validation mx-3 mb-4" novalidate>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label class="control-label text-primary">Detail</label>
                                    <input type="text"  class="form-control" placeholder='Expenditure Details' name="detail"  required>
                                    <div class="invalid-feedback">
                                        Fill in the expense details!
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label text-primary">Total</label>
                                    <input type="number"  class="form-control" placeholder='Total Exp.' name="total"  required>
                                    <div class="invalid-feedback">
                                        Fill in the total expenses!
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
                                    Choose Waste category!
                                    </div>
                                </div>
 
                                <div class="form-group">
                                    <label class="control-label text-primary">Expenditure Date</label>
                                    <input type="date"  class="form-control" placeholder='Expenditure Date' name="start_expend" required>
                                    <div class="invalid-feedback">
                                    Enter the exp. date!
                                    </div>
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
                foreach ($data_expend as $expend) {
            ?>
            <div class="modal fade" id="editExpend<?php echo $no ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formEditExpend" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold text-primary mx-3 mt-3" id="formEditExpendLabel">Change Expenditure Data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form name="form_edit_matakuliah" action="<?php echo base_url().'expend/edit' ?>" method="post" class="user needs-validation mx-3 mb-4" novalidate>
                            <div class="modal-body">                                 
                                <div class="form-group d-none">
                                    <label class="control-label text-primary">Expenditure ID</label>
                                    <input type="text"  class="form-control" name="expend_id" value="<?php echo $expend->expend_id ?>" required readonly>
                                </div>
                                <div class="form-group">
                                    <label class="control-label text-primary">Detail</label>
                                    <input type="text"  class="form-control" placeholder='Expenditure Details' name="detail" value="<?php echo $expend->detail ?>" required>
                                    <div class="invalid-feedback">
                                        Fill in the expense details!
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label text-primary">Amount</label>
                                    <input type="number"  class="form-control" placeholder='Total Exp.' name="total" value="<?php echo $expend->total ?>" required>
                                    <div class="invalid-feedback">
                                        Fill in the total expenses!
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
                                        <option value="<?php echo $wastecat->wastecat_id ?>" <?php if ($wastecat->wastecat_id === $expend->wastecat_id) { echo "selected"; } ?>>
                                            <?php echo $wastecat->wastecat_id.' '.$wastecat->name_wastecat ?>
                                        </option>
                                        <?php }} ?>
                                    </select>
                                    <div class="invalid-feedback">
                                    Choose waste category!
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label text-primary">Expenditure Date</label>
                                    <input type="date"  class="form-control" placeholder='Expenditure Date' name="start_expend" value="<?php echo $expend->start_expend?>" required>
                                    <div class="invalid-feedback">
                                    Enter the exp. date!
                                    </div>
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