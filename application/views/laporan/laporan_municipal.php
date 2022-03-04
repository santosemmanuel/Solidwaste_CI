                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between">
                            <h4 class="my-auto font-weight-bold text-primary">Municipality Data Report</h4>
                        </div>
                        <div class="card-body">
                            <form name="form_filter_municipal" action="<?php echo base_url().'municipal/laporan_filter' ?>" method="post" class="w-50 user needs-validation mx-3 mb-4" novalidate>
                                <div class="form-group">
                                    <label class="control-label text-primary">Zipcode</label>
                                    <select class="form-control" name="zipcode" pattern="[A-Za-z]{1,10}" >
                                        <option value="6516" <?php if(set_value('6516') == '6516') { echo 'selected'; } ?>>6516</option>
                                     
                                    </select>
                                </div>
                                <button type="submit" class="flex-fill btn btn-primary btn-user px-4">Search</button>
                            </form>

                            <div class="d-flex m-3">
                                <a target="blank" href="<?php echo base_url().'municipal/print/'.set_value('zipcode') ?>" class="btn btn-secondary shadow-sm"><i
                                class="fas fa-print fa-sm text-white-500"></i> Print</a>
                                <a target="blank" href="<?php echo base_url().'municipal/cetak_pdf/'.set_value('zipcode') ?>" class="btn btn-danger shadow-sm mx-2" ><i
                                class="fas fa-file fa-sm text-white-500" ></i> Print PDF</a>
                            </div>

                            <div class="table-responsive mt-3">
                                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-primary">
                                            <th>No.</th>
                                            <th>ID</th>
                                            <th>Municipality</th>
                                            <th>Province</th>
                                            <th>Barabngay/Poblacion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $no = 1;
                                            foreach ($data_municipal as $municipal) {
                                        ?>
                                        <tr>
                                            <th><?php echo $no++ ?></th>
                                            <td><?php echo $municipal->municipal_id ?></td>
                                            <td><?php echo $municipal->name_municipal.' ' ?><sup>(<?php echo substr($municipal->zipcode, 0, 8) ?>)</sup></td>
                                            <td><?php echo $municipal->province ?></td>
                                            <td><?php echo $municipal->barangay ?></td>
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

            

            