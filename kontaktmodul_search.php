<?php
include 'kontaktmodul.php';

define('DB_HOST', 'localhost');
define('DB_NAME', 'kontaktmodul');
define('DB_USER','root');
define('DB_PASSWORD','');

$button = $_GET['submit'];
$search = $_GET['search'];

if (!$button) {
  echo "You didn't submit a keyword";
}
else {
  if (strlen($search) <= -1) {
    echo "Search term too short";
  }
  else {
    echo "You searched for <b> $search </b> </br>";

    $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    if ($mysqli->connect_errno) {
        printf("Connect failed: %s\n", $mysqli->connect_error);
        exit();
    }


    $search_exploded = explode ( " ", $search );
    $x = 0;
    $construct = " ";

    if (isset($_GET['type'])) {
    if ($_GET['type']=="Privatpersoner") {
      foreach ($search_exploded as $search_each) {
        $x++;
        if ($x == 1) {
          $construct .= "fornavn LIKE '%$search_each%' ";
        }
        else {
          $construct .= "AND fornavn LIKE '%$search_each%' ";
        }
      }
      $construct = " SELECT * FROM privatpersoner WHERE $construct ORDER BY fornavn ";

      $run = $mysqli->query($construct);

      $foundnum = $run->num_rows;

      if ($foundnum == 0) {
        echo "Sorry, there are no matching result for <b> $search <b>. <hr size='2'>";
      }
      else {
        echo "$foundnum results found !<hr size='2'><p>";
        echo "<table>
          <tr>
          <th>Image</th>
          <th>Etternavn</th>
          <th>Fornavn</th>
          <th>Epost</th>
          <th>Telefon</th>
          <th>Adresse</th>
          <th>Firma</th>
          </tr>";
        $pic=0;
        while ($runrows = $run->fetch_assoc()) {
          $pic++;
          if (!$runrows['Bilde']) {
            $image = file_get_contents('person-image.bin');
          }
          else {
            $image = $runrows['Bilde'];
          }
          $fornavn = $runrows['Fornavn'];
          $etternavn = $runrows['Etternavn'];
          $epost = $runrows['Epost'];
          $telefon = $runrows['Telefon'];
          $adresse = $runrows['Adresse'];
          $firma = $runrows['Firma'];
          $id = $runrows['id'];

          echo "<tr>";
          file_put_contents('images/'.$pic, $image);
          echo "<td><img src='images/$pic' height='42' width='42'></td>
          <td><b><a href='kontaktmodul_edit.php?c=privatperson&i=$id'>$fornavn</a></b></td>
          <td>$etternavn</td>
          <td>$epost</td>
          <td>$telefon <br>
          <td>$adresse</td>
          <td>$firma</td>";
          echo "</tr></a>";
        }
      }
    }


    elseif ($_GET['type']=="Bedrifter") {
      foreach ($search_exploded as $search_each) {
        $x++;
        if ($x == 1) {
          $construct .= "navn LIKE '%$search_each%' ";
        }
        else {
          $construct .= "AND navn LIKE '%$search_each%' ";
        }
      }
      $construct = " SELECT * FROM bedrifter WHERE $construct ORDER BY navn ";

      $run = $mysqli->query($construct);

      $foundnum = $run->num_rows;

      if ($foundnum == 0) {
        echo "Sorry, there are no matching result for <b> $search <b>. <hr size='2'>";
      }
      else {
        echo "$foundnum results found !<hr size='2'><p>";
        echo "<table>
          <tr>
          <th>Navn</th>
          <th>Adresse</th>
          <th>Epost</th>
          <th>Telefon</th>
          </tr>";

        while ($runrows = $run->fetch_assoc()) {
          $navn = $runrows['Navn'];
          $adresse = $runrows['Adresse'];
          $epost = $runrows['Epost'];
          $telefon = $runrows['Telefon'];
          $id = $runrows['id'];

          echo "<tr>";
          echo "
          <td><b><a href='kontaktmodul_edit.php?c=bedrift&i=$id'>$navn</a></b></td>
          <td>$adresse</td>
          <td>$epost</td>
          <td>$telefon <br>";
          echo "</tr></a>";
        }
      }
    }
    }
    else {
      echo "Vennligst velg privatpersoner eller bedrifter!";
    }

  }
}
 ?>

  </body>
</html>
