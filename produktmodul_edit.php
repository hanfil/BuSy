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

  <?php include 'produktmodul.php' ?>

<?php $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME); ?>


<?php
  $query = " SELECT * FROM produkter WHERE id='$id' ";
  $result = $mysqli->query($query);


  while ($row = $result->fetch_row()) {
    $leverandor = $row[1];
    $produktnummer = $row[2];
    $produktnavn = $row[3];
    $innkjopspris = $row[4];
    $utsalgspris = $row[5];
    $antall = $row[6];
}

echo '

    <div class="container">
      <form class="form-group" action="produktmodul_insert.php" method="POST">
        <table>
          <tr>
            <th>Leverandør</th>
            <th>Produktnummer</th>
            <th>Produktnavn</th>
            <th>Innkjøpspris</th>
            <th>Utsalgspris</th>
            <th>Antall</th>
          </tr>
          <tr>
            <td><input type="text" size="90" name="leverandor" value="'.$leverandor.'" class="form-control input-sm chat-input"></td>
            <td><input type="number" size="90" name="produktnummer" value="'.$produktnummer.'" class="form-control input-sm chat-input"></td>
            <td><input type="text" size="90" name="produktnavn" value="'.$produktnavn.'" class="form-control input-sm chat-input">
            <input type="number" size="90" name="id" value="'.$id.'" readonly class="form-control input-sm chat-input"></td>
            <td><input type="number" size="90" name="innkjopspris" value="'.$innkjopspris.'" class="form-control input-sm chat-input"></td>
            <td><input type="number" size="90" name="utsalgspris" value="'.$utsalgspris.'" class="form-control input-sm chat-input"></td>
            <td><input type="number" size="90" name="antall" value="'.$antall.'" class="form-control input-sm chat-input"></td>
          </tr>
        </table>
        <input type="submit" name="edit_produkt" value="Edit" class="btn btn-primary">
        <input type="submit" name="delete_produkt" value="Delete" class="btn btn-secondary">

      </form>
    </div>
    ';

?>

  </body>
</html>
