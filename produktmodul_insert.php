<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'kontaktmodul');
define('DB_USER','root');
define('DB_PASSWORD','');

$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
  }
?>


<?php
if (isset($_POST['submit_produkt'])) {
  $construct="INSERT INTO produkter (Leverandor, produktnummer, produktnavn, innkjopspris, utsalgspris, antall)
  VALUES ('".$_POST['leverandor']."', '".$_POST['produktnummer']."', '".$_POST['produktnavn']."', '".$_POST['innkjopspris']."', '".$_POST['utsalgspris']."', '".$_POST['antall']."');";
  echo $construct;

  if ($mysqli->query($construct) === TRUE) {
    include 'produktmodul.php';
    echo "New record created successfully";
  }
  else {
    include 'produktmodul.php';
    echo "Error: " . $construct . "<br>" . $mysqli->error;
  }
}

 if (isset($_POST['edit_produkt']) || isset($_POST['delete_produkt'])) {
   if (isset($_POST['delete_produkt'])) {
     $construct="DELETE FROM `produkter` WHERE `produkter`.`id` = ".$_POST['id'];
   }
   else {
     $construct="UPDATE `produkter` SET Leverandor = '".$_POST['leverandor']."',
     produktnummer = '".$_POST['produktnummer']."', produktnavn = '".$_POST['produktnavn']."',
     innkjopspris = '".$_POST['innkjopspris']."', utsalgspris = '".$_POST['utsalgspris']."',
     antall = '".$_POST['antall']."'
     WHERE `produkter`.`id` = '".$_POST['id']."';";
   }

   if ($mysqli->query($construct) === TRUE) {
     include 'produktmodul.php';
     echo "New record created successfully";
   }
   else {
     include 'produktmodul.php';
     echo "Error: " . $construct . "<br>" . $mysqli->error;
   }
 }
if (isset($_POST['submit'])) {
 if ($_POST['submit'] == 'insert'){
   include 'produktmodul.php';
   echo '
       <div class="container">
         <form class="form-group" action="produktmodul_insert.php" method="post">
           <table>
             <tr>
               <th>Produktnavn</th>
               <th>Innkjøpspris</th>
               <th>Utsalgspris</th>
               <th>Antall</th>
               <th>Produktnummer</th>
               <th>Kategori</th>
               <th>Leverandør</th>
             </tr>
             <tr>
               <td><input type="text" size="90" name="produktnavn" class="form-control input-sm chat-input"></td>
               <td><input type="number" size="90" name="innkjopspris" class="form-control input-sm chat-input"></td>
               <td><input type="number" size="90" name="utsalgspris" class="form-control input-sm chat-input"></td>
               <td><input type="number" size="90" name="antall" class="form-control input-sm chat-input"></td>
               <td><input type="number" size="90" name="produktnummer" class="form-control input-sm chat-input"></td>
               <td><select class="selectpicker" multiple>
                    <option></option>
                    </select>
                </td>
               <td><select class="selectpicker" name="leverandor">';

               $run = $mysqli->query("SELECT * FROM bedrifter");
               while ($runrows = $run->fetch_assoc()) {
                 echo "<option>".$runrows['Navn']."</option>";
               }

              echo '</select>
                </td>
             </tr>
           </table>
           <input type="submit" name="submit_produkt" class="btn btn-primary">
           <input type="reset" class="btn btn-secondary">

         </form>
       </div>


     </body>
    </html>
   ';
 }
 }
 ?>
