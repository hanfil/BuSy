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
                            Produktmodul
                            <small>Liste over produkter</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Produktmodul
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <form method="GET" action="" class="col-lg-8">
                        <div class="form-group input-group">
                            <input type="text" class="form-control" name="search">
                            <span class="input-group-btn"><button class="btn btn-default" type="button submit"><i class="fa fa-search"></i></button></span>
                        </div>
                    </form>
                    <button type="button" class="btn btn-primary col-lg-3" data-toggle="modal" href="#leggtilprodukt">Legg til produkt.</button>
                    <form method='GET'><button type="button submit" name="tilbud" class="btn btn-info col-lg-1">Lag Tilbud</button>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="<?php lagtilbudclass(); ?>">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Produktnavn</th>
                                        <th>Innkjøpspris</th>
                                        <th>Utsalgspris</th>
                                        <th>Antall</th>
                                        <th>Kategori</th>                                        
                                        <th>Leverandør</th>
                                        <th>Produktnummer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(isset($_GET['search'])) inputProduct($_GET['search']); else inputProduct('');?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <?php lagtilbud(); ?>

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
    <div class="modal fade" id="leggtilprodukt" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <form method="POST" action="">
                            <div class="modal-body">
                                <h2>Legg til Produkt</h2>
                                <div class="form-group row">
                                    <div class="col-lg-2"><input class="form-control" placeholder="Produktnavn" type="text" name="productname"></div>
                                    <div class="col-lg-2"><input class="form-control" placeholder="Innkjøpspris" type="number" name="innprice"></div>
                                    <div class="col-lg-2"><input class="form-control" placeholder="Utsalgspris" type="number" name="outprice"></div>
                                    <div class="col-lg-2"><input class="form-control" placeholder="Antall" type="number" name="quantity"></div>
                                    <div class="col-lg-2"><input class="form-control" placeholder="Kategori" type="text" name="category"></div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <input list="supplier" class="form-control" placeholder="Leverandør" type="text" name="supplier">
                                            <datalist id="supplier"><?php
                                                $querybusiness="SELECT name FROM business";
                                                $resultbusiness = (mysql_ask('fetchrow',$querybusiness));
                                                foreach($resultbusiness as $names){
                                                    foreach($names as $name)
                                                    echo "<option value='$name'>";}
                                            ?></datalist> 
                                        </div>
                                    </div>
                                    <div class="col-lg-2"><input class="form-control" placeholder="Produktnummer" type="number" name="productnumber"></div>
                                    <br><br>
                                </div>
                                <button type="button submit" class="btn btn-lg btn-success"><span class="fa fa-shopping-cart"> Legg til</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Input into DB-->
    <?php 
    if(isset($_POST['oppdater']) and $_POST['oppdater'] > 0)
        updateProduct($_POST['oppdater'],$_POST['productname'],$_POST['innprice'],$_POST['outprice'],$_POST['quantity'],$_POST['category'],$_POST['supplier'],$_POST['productnumber']);
    elseif(isset($_POST['productname']))
        addProduct($_POST['productname'],$_POST['innprice'],$_POST['outprice'],$_POST['quantity'],$_POST['category'],$_POST['supplier'],$_POST['productnumber']);
    ?>

</body>

</html>
