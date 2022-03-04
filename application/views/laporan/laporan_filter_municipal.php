                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between">
                            <h4 class="my-auto font-weight-bold text-primary">Municipality Data Report</h4>
                        </div>
                        <div class="card-body">
                            <form name="form_filter_wastecat" action="<?php echo base_url().'municipal/laporan_filter' ?>" method="post" class="w-50 user needs-validation mx-3 mb-4" novalidate>
                                <div class="form-group">
                                    <label class="control-label text-primary">Zipcode</label>
                                    <select class="form-control" name="zipcode" pattern="[A-Za-z]{1,10}">
                                        <!-- <option value="All" selected>All</option> -->
                                        <option value="6516">6516</option>
                                       
                                    </select>
                                </div>
                                <button type="submit" class="flex-fill btn btn-primary btn-user px-4">Search</button>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            

            