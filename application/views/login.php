<link rel="stylesheet" href="<?= base_url()?>assets/css/cover.css"> 
<body style="background-image: url('<?php echo base_url() ?>assets/img/burauen_cover.jpg'); ">

    
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
      
    <header class="masthead mb-auto">
        <div class="inner">
          <h3 class="masthead-brand" style="text-shadow: 1px 1px black;"> <img src="<?php echo base_url() ?>assets/img/seal.png" width="50" height="50"> Municipality of Burauen</h3>
          <nav class="nav nav-masthead justify-content-center">
            <a class="nav-link active" href="#">Home</a>
            <a class="nav-link" href="#">About</a>
            <a class="nav-link" href="#">Contact</a>
          </nav>
        </div>
      </header>
    
      <main role="" class="">
        <div class="row">
            <div class="col">
                <h1 class="cover-heading" style="text-shadow: 2px 2px black;">Solid Waste Collection Management System</h1>
                <p class="lead">Cover is a one-page template for building simple and beautiful home pages. Download, edit the text, and add your own fullscreen background photo to make it your own.</p>
                <p class="lead"><a href="" class="btn btn-lg btn-secondary">Learn more</a></p>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <?php
                            if (isset($_GET['pesan'])) {
                                if ($_GET['pesan'] == "gagal") {
                                    echo "<div class='alert alert-danger'>Login failed! Incorrect username and password.</div>";
                                } else if ($_GET['pesan'] == "logout") {
                                    echo "<div class='alert alert-danger'>You have logged out.</div>";
                                } else if ($_GET['pesan'] == "belumlogin") {
                                    echo "<div class='alert alert-warning'>Please login first.</div>";
                                } else if ($_GET['pesan'] == "SignUpConfirm") {
                                    echo "<div class='alert alert-success'>Congratulations! Please login using your previously created Account.</div>";
                                }
                            }
                        ?>
                        <form method="post" style="color: black" action="<?php echo base_url()?>welcome/login">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Username</label>
                                <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                            </div>
                            <button type="submit" class="btn btn-success">Log In</button>
                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#signUpModal">Sign Up</button>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
      </main>
    
      
      <footer class="mastfoot mt-auto">
        <center>
        <div class="inner">
            <p color="white">BURAUEN SOLID WASTE MANAGEMENT DIVISION, <br>09497392695 - <?php echo date('Y')?>
            <br>Powerd by CodeBlue.</p>
        </div>
        </center>
      </footer>
      

        <div class="modal fade bd-example-modal-lg" id="signUpModal" tabindex="-1" width="100" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" style="color: black">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle" >Sign Up</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <div class="alert alert-danger" role="alert" id="alertMessage"></div>
                        <form method="post" id="signUpForm">
                            <div class="form-row">
                                <div class="col">
                                    <label for="exampleInputEmail1">First Name</label>
                                    <input type="text" class="form-control" aria-describedby="" name="firstName" placeholder="First Name">
                                </div>
                                <div class="col">
                                    <label for="exampleInputPassword1">Middle Name</label>
                                    <input type="text" class="form-control" name="middleName" placeholder="Middle Name">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label for="exampleInputPassword1">Last Name</label>
                                    <input type="text" class="form-control" name="lastName" placeholder="Last Name">
                                </div>
                                <div class="col">
                                <label for="exampleInputPassword1">Contact Number</label>
                                    <input type="text" class="form-control" name="contactNumber" placeholder="(e.g. 09123456789)">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label for="exampleInputEmail1">Username</label>
                                    <input type="text" class="form-control" aria-describedby="" name="userName" placeholder="Username">
                                </div>
                                <div class="col">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="Password">
                                </div>
                                <div class="col">
                                    <label for="exampleInputPassword1">Re-type Password</label>
                                    <input type="password" class="form-control" name="reTypePassword" placeholder="Re-type Password">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label for="exampleInputEmail1">Business Name</label>
                                    <input type="text" class="form-control" aria-describedby="" name="businessName" placeholder="Business Name">
                                </div>
                                <div class="col">
                                    <label for="exampleInputPassword1">Business Type</label>
                                    <select class="form-control" name="businessType">
                                        <option>Sole Proprietorship</option>
                                        <option>Partnership</option>
                                        <option>Limited Partnership</option>
                                        <option>Corporation</option>
                                        <option>limited liability company (LLC)</option>
                                        <option>Non-profit</option>
                                        <option>Co-op</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="exampleInputPassword1">Annual Income Tax Return</label>
                                    <input type="number" class="form-control" name="ITR" placeholder="Annual Income Tax Return">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-3">
                                    <label for="exampleInputEmail1">TIN</label>
                                    <input type="text" class="form-control" aria-describedby="" name="TIN" placeholder="TIN">
                                </div>
                                <div class="col">
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
                                <div class="col">
                                    <label for="exampleInputPassword1">Address</label>
                                    <input type="text" class="form-control" name="address" placeholder="Street name">
                                </div>
                            </div><br>
                            <div class="row">
                                <div id="map" class="map"></div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-success" value="Sign Up" />
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  
</body>
