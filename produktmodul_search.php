<?php
include 'produktmodul.php';

define('DB_HOST', 'localhost');
define('DB_NAME', 'kontaktmodul');
define('DB_USER','root');
define('DB_PASSWORD','');

$button = $_POST['submit'];
$search = $_POST['search'];

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

      foreach ($search_exploded as $search_each) {
        $x++;
        if ($x == 1) {
          $construct .= "produktnavn LIKE '%$search_each%' OR Leverandor LIKE '%$search_each%' ";
        }
        else {
          $construct .= "AND produktnavn LIKE '%$search_each%' OR Leverandor LIKE '%$search_each%' ";
        }
      }
      $construct = " SELECT * FROM produkter WHERE $construct ORDER BY produktnavn ";

      $run = $mysqli->query($construct);

      $foundnum = $run->num_rows;

      if ($foundnum == 0) {
        echo "Sorry, there are no matching result for <b> $search <b>. <hr size='2'>";
      }
      else {
        echo "$foundnum results found !<hr size='2'><p>";
        echo "<table>
          <tr>
          <th>Produktnavn</th>
          <th>Innkjopspris</th>
          <th>Utsalgspris</th>
          <th>Antall</th>
          <th>Produktnummer</th>
          <th>Leverandør</th>
          </tr>";

          while ($runrows = $run->fetch_assoc()) {
          $leverandor = $runrows['Leverandor'];
          $produktnummer = $runrows['produktnummer'];
          $produktnavn = $runrows['produktnavn'];
          $innkjopspris = $runrows['innkjopspris'];
          $utsalgspris = $runrows['utsalgspris'];
          $antall = $runrows['antall'];
          $id = $runrows['id'];

          echo "<tr>          
          <td><b><a href='produktmodul_edit.php?c=privatperson&i=$id'>$produktnavn</a></b></td>
          <td>$innkjopspris <br>
          <td>$utsalgspris</td>
          <td>$antall</td>
          <td>$produktnummer</td>
          <td><a href='kontaktmodul_search.php?search=$leverandor&type=Bedrifter&submit=search'>$leverandor</a></td>
          </tr></a>";
          }
        }
    }
  }
 ?>

  </body>
</html>
