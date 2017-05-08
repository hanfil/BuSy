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
                    <button type="button" class="btn btn-lg btn-primary" data-toggle="modal" href="#leggtilprivatperson">Legg til privatperson.</button>
                </div><br>
                <!-- /.row -->

                <div class="row">
                    <form method="GET" action="">
                        <div class="form-group input-group">
                            <input type="text" class="form-control" name="search">
                            <span class="input-group-btn"><button class="btn btn-default" type="button submit"><i class="fa fa-search"></i></button></span>
                        </div>
                    </form>
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
                                    <?php if(isset($_GET['search'])) inputBusiness($_GET['search']); else inputBusiness('');?>
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
                                        <th>Fornavn</th>
                                        <th>Etternavn</th>
                                        <th>Epost</th>
                                        <th>Telefon</th>
                                        <th>Adresse</th>
                                        <th>Firma</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(isset($_GET['search'])) inputPrivatperson($_GET['search']); else inputPrivatperson('');?>
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
                        <form method="POST" action="">
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
                        <form method="POST" action="">
                            <div class="modal-body">
                                <h2>Legg til Privatperson</h2>
                                <hr class="star-primary">
                                <img src="img/tjenester/nettside_background.jpeg" class="img-responsive img-centered" alt="">
                                <div class="form-group">
                                    <div class="col-lg-2"><input class="form-control" placeholder="Fornavn" name="firstname"></div>
                                    <div class="col-lg-2"><input class="form-control" placeholder="Etternavn" name="lastname"></div>
                                    <div class="col-lg-2"><input class="form-control" placeholder="Epost" name="privatemail"></div>
                                    <div class="col-lg-2"><input class="form-control" placeholder="Telefon" name="privattlf"></div>
                                    <div class="col-lg-2"><input class="form-control" placeholder="Adresse" name="privatadress"></div>
                                    <div class="col-lg-2"><input class="form-control" placeholder="Firma" name="business"></div>
                                    <br><br>
                                </div>
                                <button type="button submit" class="btn btn-lg btn-success"><span class="glyphicon glyphicon-user"> Legg til</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editbedrift" tabindex="-1" role="dialog" aria-hidden="true">
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
                        <form method="POST" action="">
                            <div class="modal-body">
                                <h2>Endre Bedrift</h2>
                                <div class="form-group">
                                    <div class="col-lg-2"><input class="form-control" placeholder="Fornavn" name="firstname"></div>
                                    <div class="col-lg-2"><input class="form-control" placeholder="Etternavn" name="lastname"></div>
                                    <div class="col-lg-2"><input class="form-control" placeholder="Epost" name="privatemail"></div>
                                    <div class="col-lg-2"><input class="form-control" placeholder="Telefon" name="privattlf"></div>
                                    <div class="col-lg-2"><input class="form-control" placeholder="Adresse" name="privatadress"></div>
                                    <div class="col-lg-2"><input class="form-control" placeholder="Firma" name="business"></div>
                                    <br><br>
                                </div>
                                <button type="button submit" class="btn btn-lg btn-success"><span class="glyphicon glyphicon-user"> Legg til</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Input into DB-->
    <?php 
    if(isset($_POST['name'])){
        addBusiness($_POST['name'],$_POST['businessemail'],$_POST['businesstlf'],$_POST['businessadress']);
    }
    if(isset($_POST['firstname'])){
        addPrivatperson($_POST['firstname'],$_POST['lastname'],$_POST['privatemail'],$_POST['privattlf'],$_POST['privatadress'],$_POST['business']);
    }
    ?>

</body>

</html>