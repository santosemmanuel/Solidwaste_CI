
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
                                    echo "<div class='alert alert-success'>Please login first.</div>";
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
                    
                        <form>
                            <div class="row">
                                <div class="col">
                                    <label for="exampleInputEmail1">First Name</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                                </div>
                                <div class="col">
                                    <label for="exampleInputPassword1">Middle Name</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                </div>
                                <div class="col">
                                    <label for="exampleInputPassword1">Last Name</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col">
                                    <label for="exampleInputEmail1">Username</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                                </div>
                                <div class="col">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                </div>
                                <div class="col">
                                    <label for="exampleInputPassword1">Re-type Password</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col">
                                    <label for="exampleInputEmail1">Business Name</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                                </div>
                                <div class="col">
                                    <label for="exampleInputPassword1">Business Type</label>
                                    <select class="form-control" id="exampleFormControlSelect1">
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
                                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-3">
                                    <label for="exampleInputEmail1">TIN</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                                </div>
                                <div class="col">
                                    <label for="exampleInputPassword1">Select Brgy.</label>
                                    <select class="form-control" id="exampleFormControlSelect1">
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
                                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                </div>
                            </div><br>
                            <div class="row">
                                <div id="map" class="map"></div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success">Sign Up</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script type="text/javascript">
        function init(){
            
            const map = new ol.Map({
                view: new ol.View({
                    center: [13903066.89804018, 1229275.2830421156],
                    zoom: 15
                }),
                layers: [
                    new ol.layer.Tile({
                        source: new ol.source.OSM()
                    })
                ],
                target: 'map'
            })

            map.on('click', function(e){
                console.log(e);
            })
        }
    </script>
</body>
