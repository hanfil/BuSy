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
    $reuslt = mysql_ask('update',$query);
    if ($reuslt != "New record updated successfully."){
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
                                <h2>Legg til Bedrift</h2>
                                <div class="form-group">
                                    <div class="col-lg-2"><input class="form-control" value="'.$privat[1].'" name="firstname"></div>
                                    <div class="col-lg-2"><input class="form-control" value="'.$privat[2].'" name="lastname"></div>
                                    <div class="col-lg-2"><input class="form-control" value="'.$privat[3].'" name="privatemail"></div>
                                    <div class="col-lg-2"><input class="form-control" value="'.$privat[4].'" name="privattlf"></div>
                                    <div class="col-lg-2"><input class="form-control" value="'.$privat[5].'" name="privatadress"></div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <input list="business" class="form-control" value="'.$privat[6].'" name="business">
                                            <datalist id="business">';
                                                $querybusiness="SELECT name FROM business";
                                                $resultbusiness = (mysql_ask('fetchrow',$querybusiness));
                                                for ($i = 0; $i < count($resultbusiness)/2; $i++){
                                                    file_put_contents('log1',$resultbusiness[$i], FILE_APPEND);
                                                }
                                                foreach($resultbusiness as $names){
                                                    foreach($names as $name)
                                                    echo "<option value='$name'>";file_put_contents('log2',$name, FILE_APPEND);}
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
    $reuslt = mysql_ask('update',$query);
    if ($reuslt != "New record updated successfully."){
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
                                <h2>Legg til Bedrift</h2>
                                <div class="form-group">
                                    <div class="col-lg-3"><input class="form-control" value="'.$business[1].'" name="name"></div>
                                    <div class="col-lg-3"><input class="form-control" value="'.$business[2].'" name="businessemail"></div>
                                    <div class="col-lg-3"><input class="form-control" value="'.$business[3].'" name="businesstlf"></div>
                                    <div class="col-lg-3"><input class="form-control" value="'.$business[4].'" name="businessadress"></div>
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
?>