<!DOCTYPE html>
<?php
$categori=$_GET['c'];
$id=$_GET['i'];
define('DB_HOST', 'localhost');
define('DB_NAME', 'kontaktmodul');
define('DB_USER','root');
define('DB_PASSWORD','');
?>
<html>
  <head>
    <meta charset="utf-8">
    <?php include 'bootstrap.php'; ?>
    <?php echo "<title>$id</title>"; ?>
  </head>
  <body>

  <?php include 'kontaktmodul.php' ?>

<?php $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME); ?>

<?php
if ($categori == 'privatperson') {
  $query = " SELECT * FROM privatpersoner WHERE id='$id' ";
  $result = $mysqli->query($query);

  $pic=0;

  while ($row = $result->fetch_row()) {
    $pic++;
    if (!$row['1']) {
      $image = file_get_contents('person-image.bin');
    }
    else {
        $image = $row[1];
    }
    $fornavn = $row[2];
    $etternavn = $row[3];
    $epost = $row[4];
    $telefon = $row[5];
    $adresse = $row[6];
    $firma = $row[7];
}

  file_put_contents('images/'.$pic, $image);
echo '

    <div class="container">
      <form class="form-group" action="kontaktmodul_insert.php" method="POST" enctype="multipart/form-data">
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
            <td><img src=images/'.$pic.' class="img-square" height="130" width="150" alt="Avatar">
                <input type="file" name="Bilde" class="textfield noDragDrop" id="field_2_3" size="10">
                <input type="text" size="90" name="id" value="'.$id.'" readonly class="form-control input-sm chat-input"></td>
            <td><input type="text" size="90" name="Fornavn" value="'.$fornavn.'" class="form-control input-sm chat-input"></td>
            <td><input type="text" size="90" name="Etternavn" value="'.$etternavn.'" class="form-control input-sm chat-input"></td>
            <td><input type="email" size="90" name="Epost" value="'.$epost.'" class="form-control input-sm chat-input"></td>
            <td><input type="int" size="90" name="Telefon" value="'.$telefon.'" class="form-control input-sm chat-input"></td>
            <td><input type="text" size="90" name="Adresse" value="'.$adresse.'" class="form-control input-sm chat-input"></td>
            <td><input type="text" size="90" name="Firma" value="'.$firma.'" class="form-control input-sm chat-input"></td>
          </tr>
        </table>
        <input type="submit" name="edit_privatperson" value="Edit" class="btn btn-primary">
        <input type="submit" name="delete_privatperson" value="Delete" class="btn btn-secondary">

      </form>
    </div>
    ';
}
?>

<?php
if ($categori == 'bedrift') {
  $query = " SELECT * FROM bedrifter WHERE id='$id' ";
  $result = $mysqli->query($query);


  while ($row = $result->fetch_row()) {
    $navn = $row[1];
    $adresse = $row[2];
    $epost = $row[4];
    $telefon = $row[3];
}

echo '

    <div class="container">
      <form class="form-group" action="kontaktmodul_insert.php" method="POST">
        <table>
          <tr>
            <th>Navn</th>
            <th>Adresse</th>
            <th>Epost</th>
            <th>Telefon</th>
          </tr>
          <tr>
            <td><input type="text" size="90" name="Navn" value="'.$navn.'" class="form-control input-sm chat-input">
            <input type="text" size="90" name="id" value="'.$id.'" readonly class="form-control input-sm chat-input"></td>
            <td><input type="text" size="90" name="Adresse" value="'.$adresse.'" class="form-control input-sm chat-input"></td>
            <td><input type="email" size="90" name="Epost" value="'.$epost.'" class="form-control input-sm chat-input"></td>
            <td><input type="int" size="90" name="Telefon" value="'.$telefon.'" class="form-control input-sm chat-input"></td>
          </tr>
        </table>
        <input type="submit" name="edit_bedrift" value="Edit" class="btn btn-primary">
        <input type="submit" name="delete_bedrift" value="Delete" class="btn btn-secondary">

      </form>
    </div>
    ';
}
?>

  </body>
</html>
