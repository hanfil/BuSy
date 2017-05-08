<?php include 'modul/head.php' ?>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include 'modul/navigation.php' ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Kontaktmodul
                            <small>Liste over kontakter</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Kontaktmodul
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row text-center">
                    <button type="button" class="btn btn-lg btn-primary" data-toggle="modal" href="#leggtilbedrift">Legg til bedrift.</button>
                    <button type="button<td>$321.33</td>" class="btn btn-lg btn-primary" data-toggle="modal" href="#leggtilprivatperson">Legg til privatperson.</button>
                </div><br>
                <!-- /.row -->

                <div class="row">
                    <div class="form-group input-group">
                        <input type="text" class="form-control">
                        <span class="input-group-btn"><button class="btn btn-default" type="button"><i class="fa fa-search"></i></button></span>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-6">
                        <h2>Bedrifter</h2>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Navn</th>
                                        <th>Epost</th>
                                        <th>Telefon</th>
                                        <th>Adresse</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo $_GET['name'] ?></td>
                                        <td><?php echo $_GET['businessemail'] ?></td>
                                        <td><?php echo $_GET['businesstlf'] ?></td>
                                        <td><?php echo $_GET['businessadress'] ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h2>Privatpersoner</h2>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Etternavn</th>
                                        <th>Fornavn</th>
                                        <th>Epost</th>
                                        <th>Telefon</th>
                                        <th>Adresse</th>
                                        <th>Firma</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>/index.html</td>
                                        <td>1265</td>
                                        <td>32.3%</td>
                                        <td>$321.33</td>
                                        <td>$321.33</td>
                                        <td>$321.33</td>
                                    </tr>
                                    <tr>
                                        <td>/about.html</td>
                                        <td>261</td>
                                        <td>33.3%</td>
                                        <td>$234.12</td>
                                        <td>$321.33</td>
                                        <td>$321.33</td>
                                    </tr>
                                    <tr>
                                        <td>/sales.html</td>
                                        <td>665</td>
                                        <td>21.3%</td>
                                        <td>$16.34</td>
                                        <td>$321.33</td>
                                        <td>$321.33</td>
                                    </tr>
                                    <tr>
                                        <td>/blog.html</td>
                                        <td>9516</td>
                                        <td>89.3%</td>
                                        <td>$1644.43</td>
                                        <td>$321.33</td>
                                        <td>$321.33</td>
                                    </tr>
                                    <tr>
                                        <td>/404.html</td>
                                        <td>23</td>
                                        <td>34.3%</td>
                                        <td>$23.52</td>
                                        <td>$321.33</td>
                                        <td>$321.33</td>
                                    </tr>
                                    <tr>
                                        <td>/services.html</td>
                                        <td>421</td>
                                        <td>60.3%</td>
                                        <td>$724.32</td>
                                        <td>$321.33</td>
                                        <td>$321.33</td>
                                    </tr>
                                    <tr>
                                        <td>/blog/post.html</td>
                                        <td>1233</td>
                                        <td>93.2%</td>
                                        <td>$321.33</td>
                                        <td>$321.33</td>
                                        <td>$126.34</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>


    <!-- Portfolio Modals -->
    <div class="modal fade" id="leggtilbedrift" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <form method="GET" action="">
                            <div class="modal-body">
                                <h2>Legg til Bedrift</h2>
                                <hr class="star-primary">
                                <img src="img/tjenester/nettside_background.jpeg" class="img-responsive img-centered" alt="">
                                <div class="form-group">
                                    <div class="col-lg-2"><input class="form-control" placeholder="Navn" name="name"></div>
                                    <div class="col-lg-2"><input class="form-control" placeholder="Epost" name="businessemail"></div>
                                    <div class="col-lg-2"><input class="form-control" placeholder="Telefon" name="businesstlf"></div>
                                    <div class="col-lg-2"><input class="form-control" placeholder="Adresse" name="businessadress"></div>
                                    <br><br>
                                </div>
                                <button type="button submit" class="btn btn-lg btn-success"><span class="glyphicon glyphicon-briefcase"> Legg til</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="leggtilprivatperson" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <form method="GET" action="">
                            <div class="modal-body">
                                <h2>Legg til Privatperson</h2>
                                <hr class="star-primary">
                                <img src="img/tjenester/nettside_background.jpeg" class="img-responsive img-centered" alt="">
                                <div class="form-group">
                                    <div class="col-lg-2"><input class="form-control" placeholder="Fornavn" name="fornavn"></div>
                                    <div class="col-lg-2"><input class="form-control" placeholder="Etternavn" name="etternavn"></div>
                                    <div class="col-lg-2"><input class="form-control" placeholder="Epost" name="privatepost"></div>
                                    <div class="col-lg-2"><input class="form-control" placeholder="Telefon" name="privattelefon"></div>
                                    <div class="col-lg-2"><input class="form-control" placeholder="Adresse" name="privatadresse"></div>
                                    <div class="col-lg-2"><input class="form-control" placeholder="Firma" name="firma"></div>
                                    <br><br>
                                </div>
                                <button type="button input" class="btn btn-lg btn-success"><span class="glyphicon glyphicon-user"> Legg til</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Input into DB-->
    <?php 
    if(isset($_GET['name'])){
        addBusiness($_GET['name'],$_GET['businessemail'],$_GET['businesstlf'],$_GET['businessadress']);
    }
    ?>

</body>

</html>