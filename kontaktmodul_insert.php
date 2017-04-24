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
function fileUpload(){
  $target_dir = "uploads/";
  $target_file = $target_dir . basename($_FILES["Bilde"]["name"]);
  $uploadOk = 1;
  $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["Bilde"]["tmp_name"]);
      if($check !== false) {
          echo "File is an image - " . $check["mime"] . ".";
          $uploadOk = 1;
      } else {
          echo "File is not an image.";
          $uploadOk = 0;
      }
  }
  // Check if file already exists
  if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
  }
  // Check file size
  if ($_FILES["Bilde"]["size"] > 500000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
  }
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
  }
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
      if (move_uploaded_file($_FILES["Bilde"]["tmp_name"], $target_file)) {
          echo "The file ". basename( $_FILES["Bilde"]["name"]). " has been uploaded.";
      } else {
          echo "Sorry, there was an error uploading your file.";
      }
  }
}

?>

<?php
//Privat - innlegging, endring etc
if (isset($_POST['submit_privatperson'])) {
  fileUpload();
  $construct="INSERT INTO privatpersoner (Bilde, Fornavn, Etternavn, Epost, Telefon, Adresse, Firma)
  VALUES ('".$_POST['Bilde']."', '".$_POST['Fornavn']."', '".$_POST['Etternavn']."', '".$_POST['Epost']."', '".$_POST['Telefon']."', '".$_POST['Adresse']."', '".$_POST['Firma']."');";
  echo $construct;

  if ($mysqli->query($construct) === TRUE) {
    include 'kontaktmodul.php';
    echo "New record created successfully";
  }
  else {
    include 'kontaktmodul.php';
    echo "Error: " . $construct . "<br>" . $mysqli->error;
  }
}

if (isset($_POST['edit_privatperson']) || isset($_POST['delete_privatperson'])) {
  if (isset($_POST['delete_privatperson'])) {
    $construct="DELETE FROM `privatpersoner` WHERE `privatpersoner`.`id` = ".$_POST['id'];
  }
  else {
    $construct="UPDATE `privatpersoner` SET Bilde = '".$_POST['Bilde']."',
    Fornavn = '".$_POST['Fornavn']."',
    Etternavn = '".$_POST['Etternavn']."', Epost = '".$_POST['Epost']."',
    Adresse = '".$_POST['Adresse']."', Firma = '".$_POST['Firma']."'
    WHERE `privatpersoner`.`id` = '".$_POST['id']."';";
  }

  if ($mysqli->query($construct) === TRUE) {
    include 'kontaktmodul.php';
    echo "New record created successfully";
  }
  else {
    include 'kontaktmodul.php';
    echo "Error: " . $construct . "<br>" . $mysqli->error;
  }
}
if (isset($_POST['insert'])) {
  if ($_POST['insert'] == 'insert_privatperson'){
    include 'mainpage.php';
    echo '
        <div class="container">
          <form class="form-group" action="kontaktmodul_insert.php" method="post" enctype="multipart/form-data">
            <table>
              <tr>
                <th>Bilde</th>
                <th>Fornavn</th>
                <th>Etternavn</th>
                <th>Epost</th>
                <th>Telefon</th>
                <th>Adresse</th>
                <th>Firma</th>
              </tr>
              <tr>
                <td><input type="file" name="Bilde" class="textfield noDragDrop" id="Bilde" size="10"></td>
                <td><input type="text" size="90" name="Fornavn" class="form-control input-sm chat-input"></td>
                <td><input type="text" size="90" name="Etternavn" class="form-control input-sm chat-input"></td>
                <td><input type="email" size="90" name="Epost" class="form-control input-sm chat-input"></td>
                <td><input type="int" size="90" name="Telefon" class="form-control input-sm chat-input"></td>
                <td><input type="text" size="90" name="Adresse" class="form-control input-sm chat-input"></td>
                <td><input type="text" size="90" name="Firma" class="form-control input-sm chat-input"></td>
              </tr>
            </table>
            <input type="submit" name="submit_privatperson" class="btn btn-primary">
            <input type="reset" class="btn btn-secondary">

          </form>
        </div>


      </body>
      </html>
    ';
  }
}
?>
<?php
//Bedrifter - innlegging, endring etc
if (isset($_POST['submit_bedrift'])) {
  $construct="INSERT INTO bedrifter (Navn, Adresse, Epost, Telefon)
  VALUES ('".$_POST['Navn']."', '".$_POST['Adresse']."', '".$_POST['Epost']."', '".$_POST['Telefon']."');";
  echo $construct;

  if ($mysqli->query($construct) === TRUE) {
    include 'kontaktmodul.php';
    echo "New record created successfully";
  }
  else {
    include 'kontaktmodul.php';
    echo "Error: " . $construct . "<br>" . $mysqli->error;
  }
}

 if (isset($_POST['edit_bedrift']) || isset($_POST['delete_bedrift'])) {
   if (isset($_POST['delete_bedrift'])) {
     $construct="DELETE FROM `bedrifter` WHERE `bedrifter`.`id` = ".$_POST['id'];
   }
   else {
     $construct="UPDATE `bedrifter` SET Navn = '".$_POST['Navn']."',
     Adresse = '".$_POST['Adresse']."', Epost = '".$_POST['Epost']."',
     Telefon = '".$_POST['Telefon']."'
     WHERE `bedrifter`.`id` = '".$_POST['id']."';";
   }

   if ($mysqli->query($construct) === TRUE) {
     include 'kontaktmodul.php';
     echo "New record created successfully";
   }
   else {
     include 'kontaktmodul.php';
     echo "Error: " . $construct . "<br>" . $mysqli->error;
   }
 }
if (isset($_POST['insert'])) {
 if ($_POST['insert'] == 'insert_bedrift'){
   include 'mainpage.php';
   echo '
       <div class="container">
         <form class="form-group" action="kontaktmodul_insert.php" method="post">
           <table>
             <tr>
               <th>Navn</th>
               <th>Adresse</th>
               <th>Epost</th>
               <th>Telefon</th>
             </tr>
             <tr>
               <td><input type="text" size="90" name="Navn" class="form-control input-sm chat-input"></td>
               <td><input type="text" size="90" name="Adresse" class="form-control input-sm chat-input"></td>
               <td><input type="email" size="90" name="Epost" class="form-control input-sm chat-input"></td>
               <td><input type="text" size="90" name="Telefon" class="form-control input-sm chat-input"></td>
             </tr>
           </table>
           <input type="submit" name="submit_bedrift" class="btn btn-primary">
           <input type="reset" class="btn btn-secondary">

         </form>
       </div>


     </body>
    </html>
   ';
 }
 }
 ?>
