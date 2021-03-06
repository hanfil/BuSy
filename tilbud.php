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
                            Tilbud
                            <small>Oversikt over tilbuder</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Ordremodul
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <?php inputOffer(); ?>
                </div>

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

    <?php 
    if (isset($_POST['buyoffer'])){
        buyOffer($_POST['buyoffer']);
        echo "<script> location.assign('tilbud.php'); </script>";
        }
    elseif (isset($_POST['removeoffer'])){
        removeOffer($_POST['removeoffer']);
        echo "<script> location.assign('tilbud.php'); </script>";
    }
    ?>

</body>

</html>
