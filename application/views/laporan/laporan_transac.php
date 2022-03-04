                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between">
                            <h4 class="my-auto font-weight-bold text-primary">Transaction Data Report</h4>
                        </div>
                        <div class="card-body">
                            <form name="form_filter_transac" action="<?php echo base_url().'transac/laporan_filter' ?>" method="post" class="w-50 user needs-validation mx-3 mb-4" novalidate>
                                <h5>Transactions are completed within the timeframe</h5>
                                <div class="form-group">
                                    <label class="control-label text-primary">From</label>
                                    <input type="date"  class="form-control" name="dari" value="<?php echo set_value('dari')?>" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label text-primary">To</label>
                                    <input type="date"  class="form-control" name="sampai" value="<?php echo set_value('sampai')?>" required>
                                </div>
                                <button type="submit" class="flex-fill btn btn-primary btn-user px-4">Search</button>
                            </form>

                            <div class="d-flex m-3">
                                <a target="blank" href="<?php echo base_url().'transac/print/'.set_value('dari').'/'.set_value('sampai') ?>" class="btn btn-secondary shadow-sm"><i
                                class="fas fa-print fa-sm text-white-500"></i> Print</a>
                                <a target="blank" href="<?php echo base_url().'transac/cetak_pdf/'.set_value('dari').'/'.set_value('sampai') ?>" class="btn btn-danger shadow-sm mx-2" ><i
                                class="fas fa-file fa-sm text-white-500" ></i> Print PDF</a>
                            </div>

                            <div class="table-responsive mt-3">
                                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-primary">
                                            <th>#</th>
                                            <th>Transaction ID</th>
                                            <th>Municipality</th>
                                            <th>Waste Category</th>
                                            <th>Weight</th>
                                            <th>Total</th>
                                            <th>Collection Date</th>
                                            <th>Finished Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $no = 1;
                                            foreach ($data_transac as $transac) {
                                        ?>
                                        <tr>
                                            <th><?php echo $no++ ?></th>
                                            <td><?php echo $transac->transac_id ?></td>
                                            <td>
                                                <span class="row px-3 text-primary text-xs"><?php echo $transac->municipal_id ?></span>
                                                <span class="row px-3"><?php echo $transac->name_municipal ?></span>
                                            </td>
                                            <td>
                                                <span class="row px-3 text-primary text-xs"><?php echo $transac->wastecat_id ?></span>
                                                <span class="row px-3"><?php echo $transac->name_wastecat ?></span>
                                            </td>
                                            <td><?php echo $transac->weight ?> KG</td>
                                            <td>₱<?php echo $transac->total ?></td>
                                            <td><?php echo $transac->start_date ?></td>
                                            <td><?php if ($transac->end_date == '0000-00-00') { echo '-'; } else { echo $transac->end_date; } ?></td>
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

            

            