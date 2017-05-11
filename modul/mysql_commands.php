<?php
//Connection settings | MySql
define('DB_HOST', 'localhost');
define('DB_NAME', 'BuSy'); //Create a DB with the name 'BuSy'
define('DB_USER', 'root');
define('DB_PASSWORD', '');

//Connect to database
function mysql_conn(){
    return new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    if ($mysqli->connect_errno) {
        printf("Connect failed: %s\n".$mysqli->connect_error);
        exit();
    }
}

//Query the database for information
function mysql_ask($task, $query){
    //Different task are: 'resultnumber', 'fetch', 'update'

    if($task == 'resultnumber'){
        $mysqli = mysql_conn();
        $run = $mysqli->query($query);
        return $run->num_rows;
        $mysqli->close();
    }
    elseif($task == 'fetchrow'){
        $mysqli = mysql_conn();
        $run = $mysqli->query($query);
        $array = array();
        while($row = $run->fetch_row())
            array_push($array,$row);
        return $array;
        $mysqli->close();
    }
    elseif($task == 'fetcharray'){
        $mysqli = mysql_conn();
        $run = $mysqli->query($query);
        return $run->fetch_array(MYSQLI_BOTH);
        $mysqli->close();
    }
    elseif($task == 'update'){
        $mysqli = mysql_conn();
        if($mysqli->query($query) === TRUE)
            return "New record updated successfully.";
        else return "Error: ".$query."<br>".$mysqli->error;
        $mysqli->close();
    }
}

function addPrivatperson($firstname,$lastname,$email,$tlf,$adress,$business){
    $query = "INSERT INTO privatperson (firstname, lastname, email, tlf, adress, business)
                VALUES ('$firstname','$lastname','$email','$tlf','$adress','$business');";
    $result = mysql_ask('update',$query);
    if ($result != "New record updated successfully."){
        $force = "CREATE TABLE privatperson (
                id int NOT NULL AUTO_INCREMENT,
                firstname varchar(255),
                lastname varchar(255),
                email varchar(255),
                tlf int(64),
                adress varchar(255),
                business varchar(255),
                PRIMARY KEY (id)
                );";
        mysql_ask('update',$force);
        mysql_ask('update',$query);
    }
}

function updatePrivatperson($id,$firstname,$lastname,$email,$tlf,$adress,$business){
    $query = "UPDATE privatperson SET firstname = '$firstname', lastname = '$lastname', email = '$email', tlf = '$tlf', adress = '$adress', business = '$business'
                WHERE id = $id";
    $reuslt = mysql_ask('update',$query);
}

function inputPrivatperson($keyword){
    $query = "SELECT * FROM privatperson";
    if ($keyword != '')
        $query .= " WHERE firstname LIKE '%$keyword%' OR lastname LIKE '%$keyword%' OR tlf LIKE '$keyword' OR business LIKE '%$keyword%'";

    $result = mysql_ask('fetchrow',$query);
    foreach($result as $row){
        echo "<tr>";
        for ($i=1; $i < count($row);$i++)
            echo "<td>$row[$i]</td>";
        echo "<td><button type='button' class='btn btn-info' data-toggle='modal' href='#editprivat$row[0]'>$row[0]</button></td>";
        inputPrivatpersonModal($row[0]);
        echo "</tr>";
    }
}

function inputPrivatpersonModal($id){
    $query = "SELECT * FROM privatperson WHERE id = $id";
    $privat = mysql_ask('fetcharray',$query);
    echo '
    <div class="modal fade" id="editprivat'.$id.'" tabindex="-1" role="dialog" aria-hidden="true">
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
                                <h2>Oppdater Privatperson</h2>
                                <div class="form-group">
                                    <div class="col-lg-2"><input class="form-control" value="'.$privat[1].'" type="text" name="firstname"></div>
                                    <div class="col-lg-2"><input class="form-control" value="'.$privat[2].'" type="text" name="lastname"></div>
                                    <div class="col-lg-2"><input class="form-control" value="'.$privat[3].'" type="email" name="privatemail"></div>
                                    <div class="col-lg-2"><input class="form-control" value="'.$privat[4].'" type="number" name="privattlf"></div>
                                    <div class="col-lg-2"><input class="form-control" value="'.$privat[5].'" type="text" name="privatadress"></div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <input list="business" class="form-control" value="'.$privat[6].'" type="text" name="business">
                                            <datalist id="business">';
                                                $querybusiness="SELECT name FROM business";
                                                $resultbusiness = (mysql_ask('fetchrow',$querybusiness));
                                                foreach($resultbusiness as $names){
                                                    foreach($names as $name)
                                                    echo "<option value='$name'>";}
                                            echo '</datalist> 
                                        </div>
                                    </div>
                                    <div class="col-lg-2"><input class="form-control" value="'.$privat[0].'" readonly name="privatid"></div>
                                    <br><br>
                                </div>
                                <button type="button submit" class="btn btn-lg btn-success"><span class="glyphicon glyphicon-briefcase"> Oppdater</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    ';
}

function addBusiness($name,$email,$tlf,$adress){
    $query = "INSERT INTO business (name, email, tlf, adress)
                VALUES ('$name','$email','$tlf','$adress');";
    $result = mysql_ask('update',$query);
    if ($result != "New record updated successfully."){
        $force = "CREATE TABLE business (
                id int NOT NULL AUTO_INCREMENT,
                name varchar(255),
                email varchar(255),
                tlf int(64),
                adress varchar(255),
                PRIMARY KEY (id)
                );";
        mysql_ask('update',$force);
        mysql_ask('update',$query);
    }
}

function updateBusiness($id,$name,$email,$tlf,$adress){
    $query = "UPDATE business SET name = '$name', email = '$email', tlf = '$tlf', adress = '$adress'
                WHERE id = $id";
    $reuslt = mysql_ask('update',$query);
}

function inputBusiness($keyword){
    $query = "SELECT * FROM business";
    if ($keyword != '')
        $query .= " WHERE name LIKE '%$keyword%' OR tlf LIKE '$keyword'";

    $result = mysql_ask('fetchrow',$query);
    foreach($result as $row){
        echo "<tr>";
        for ($i=1; $i < count($row);$i++)
            echo "<td>$row[$i]</td>";
        echo "<td><button type='button' class='btn btn-info' data-toggle='modal' href='#editbedrift$row[0]'>$row[0]</button></td>";
        inputBusinessModal($row[0]);
        echo "</tr>";
    }
}

function inputBusinessModal($id){
    $query = "SELECT * FROM business WHERE id = $id";
    $business = mysql_ask('fetcharray',$query);
    echo '
    <div class="modal fade" id="editbedrift'.$id.'" tabindex="-1" role="dialog" aria-hidden="true">
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
                                <h2>Opdater Bedrift</h2>
                                <div class="form-group">
                                    <div class="col-lg-3"><input class="form-control" value="'.$business[1].'" type="text" name="name"></div>
                                    <div class="col-lg-3"><input class="form-control" value="'.$business[2].'" type="email" name="businessemail"></div>
                                    <div class="col-lg-3"><input class="form-control" value="'.$business[3].'" type="number" name="businesstlf"></div>
                                    <div class="col-lg-3"><input class="form-control" value="'.$business[4].'" type="text" name="businessadress"></div>
                                    <div class="col-lg-2"><input class="form-control" value="'.$business[0].'" readonly name="businessid"></div>
                                    <br><br>
                                </div>
                                <button type="button submit" class="btn btn-lg btn-success"><span class="glyphicon glyphicon-briefcase"> Oppdater</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    ';
}

function addProduct($productname,$innprice,$outprice,$quantity,$category,$supplier,$productnumber){
    $query = "INSERT INTO product (productname, innprice, outprice, quantity, category, supplier, productnumber)
                VALUES ('$productname','$innprice','$outprice','$quantity','$category','$supplier','$productnumber');";
    $result = mysql_ask('update',$query);
    if ($result != "New record updated successfully."){
        $force = "CREATE TABLE product (
                id int NOT NULL AUTO_INCREMENT,
                productname varchar(255) UNIQUE,
                innprice int(64),
                outprice int(64),
                quantity int(64),
                category varchar(255),
                supplier varchar(255),
                productnumber int(64) NOT NULL,
                PRIMARY KEY (id)
                );";
        mysql_ask('update',$force);
        mysql_ask('update',$query);
    }
}

function updateProduct($id,$productname,$innprice,$outprice,$quantity,$category,$supplier,$productnumber){
    $query = "UPDATE product SET productname = '$productname', innprice = '$innprice', outprice = '$outprice', quantity = '$quantity', 
                                    category = '$category', supplier = '$supplier', productnumber ='$productnumber'
                WHERE id = $id";
    $reuslt = mysql_ask('update',$query);
}

function inputProduct($keyword){
    $query = "SELECT * FROM product";
    if ($keyword != '')
        $query .= " WHERE productname LIKE '%$keyword%' OR category LIKE '%$keyword%' OR supplier LIKE '%$keyword%'";

    $result = mysql_ask('fetchrow',$query);
    foreach($result as $row){
        echo "<tr>";
        for ($i=1; $i < count($row);$i++){
            if ($row[4] < 1)
                echo "<td class='danger'>$row[$i]</td>";
            elseif ($row[4] < 10)
                echo "<td class='warning'>$row[$i]</td>";
            elseif ($row[4] > 20)
                echo "<td class='success'>$row[$i]</td>";
            else
                echo "<td class='active'>$row[$i]</td>";
        }
        echo "<td><button type='button' class='btn btn-info' data-toggle='modal' href='#editproduct$row[0]'>$row[0]</button></td>";
        echo "<td><input class='form-control' type='checkbox' name='lagtilbud$row[0]'></td>";
        echo "</tr>";
    }
    echo "</form>";
    foreach ($result as $row){
        inputProductModal($row[0]);}
}

function inputProductModal($id){
    $query = "SELECT * FROM product WHERE id = $id";
    $product = mysql_ask('fetcharray',$query);
    echo '
    <div class="modal fade" id="editproduct'.$id.'" tabindex="-1" role="dialog" aria-hidden="true">
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
                                <h2>Oppdater Produkt</h2>
                                <div class="form-group row">
                                    <div class="col-lg-2"><input class="form-control" value="'.$product[1].'" type="text" name="productname"></div>
                                    <div class="col-lg-2"><input class="form-control" value="'.$product[2].'" type="number" name="innprice"></div>
                                    <div class="col-lg-2"><input class="form-control" value="'.$product[3].'" type="number" name="outprice"></div>
                                    <div class="col-lg-2"><input class="form-control" value="'.$product[4].'" type="number" name="quantity"></div>
                                    <div class="col-lg-2"><input class="form-control" value="'.$product[5].'" type="text" name="category"></div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <input list="business" class="form-control" value="'.$product[6].'" type="text" name="supplier">
                                            <datalist id="business">';
                                                $querysupplier="SELECT name FROM business";
                                                $resultsupplier = (mysql_ask('fetchrow',$querysupplier));
                                                foreach($resultsupplier as $names){
                                                    foreach($names as $name)
                                                    echo "<option value='$name'>";}
                                            echo '</datalist> 
                                        </div>
                                    </div>
                                    <div class="col-lg-2"><input class="form-control" value="'.$product[7].'" readonly name="productnumber"></div>
                                </div>
                                <button type="button submit" class="btn btn-lg btn-success" name="oppdater" value="'.$product[0].'"><span class="glyphicon glyphicon-briefcase"> Oppdater</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    ';
}
function makeoffer_class(){
    if (isset($_POST['tilbud']) or isset($_POST['updateoffer']))
        echo "col-lg-9";
}

function makeoffer_db(){
    $product = "SELECT * FROM product";
    $productcheck = mysql_ask('fetchrow',$product);
    foreach($productcheck as $namecheck){
        $lagtilbud="";
        $lagtilbud="lagtilbud".$namecheck[0];
        if (isset($_POST[$lagtilbud])){
            $query = "INSERT INTO makeoffer (productname, quantity, price)
                        VALUES ('$namecheck[1]','1', $namecheck[3]);";
            $result = mysql_ask('update',$query);
            if ($result != "New record updated successfully."){
                $force = "CREATE TABLE makeoffer (
                        id int NOT NULL AUTO_INCREMENT,
                        productname varchar(255) UNIQUE,
                        quantity int(64),
                        price int(64),
                        PRIMARY KEY (id)
                        );";
                mysql_ask('update',$force);
                mysql_ask('update',$query);
            }
        }
    }
}

function makeoffer_clear(){
    $query = "TRUNCATE TABLE makeoffer"; 
    mysql_ask('update',$query);
}

function makeoffer_update(){
    $query = "SELECT * FROM makeoffer";
    $result = mysql_ask('fetchrow',$query);
    foreach($result as $row){
        $namecheck = "quantity".$row[2];
        if ($row[2] != $_POST[$namecheck]){
            
        }
    }
}

function makeoffer(){
    $query = "SELECT * FROM makeoffer";
    $result = mysql_ask('fetchrow',$query);
    $sum = 0;
    echo '
                    <div class="col-lg-3">
                        <form method="POST">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>Produkter</th>
                                            <th>Antall</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                    foreach($result as $row){
                                        echo "<tr>";
                                        echo "<td><input class='form-control' type='text' value='$row[1]' readonly></td>";
                                        echo "<td><input class='form-control' type='number' value='$row[2]' min='1' name='quantity$row[0]'></td>";
                                        echo "</tr>";
                                        $sum += $row[3];
                                        } 
    echo '
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-lg-5 text-center"><h5>Tilbuds Pris</h5></div>
                                <div class="col-lg-7"><input class="form-control" type="number" name="offerprice" min="0" value="'.$sum.'"></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5 text-center"><h5>Slutt Dato</h5></div>
                                <div class="col-lg-7"><input class="form-control" type="date" name="endDate" min="'.date("Y-m-d").'"></div>
                            </div>
                            <div class="col-lg-4"><button type="button" class="btn btn-warning">Levér Tilbud</div>
                            <div class="col-lg-4"><button type="button submit" class="btn btn-success" name="updateoffer">Oppdater</div>
                            <div class="col-lg-4"><button type="button submit" class="btn btn-danger" name="clearoffer">Slett Alt</div>
                        </form>
                    </div>';
}
?>