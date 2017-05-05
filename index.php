<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>produktmodul</title>
    <?php include 'bootstrap.php';?>
    <?php include "mysql_commands.php" ?>
  </head>
  <body>
    <?php include 'navbar.php' ?>
    <div class="container-fluid">

      <div class="container">
        <div class="form-group col-xs-6">
        <form action="produktmodul_search.php" method="POST">
          <center>
            <h1>Søk produkt</h1>
            <input type="text" size="90" name="search" class="form-control input-sm chat-input">
            <br>
            <input type="submit" name="submit" value="search" class="btn btn-primary">
          </center>
        </form>
        </div>

        <div class="form-group col-xs-6">
          <form action="produktmodul_insert.php" method="POST">
            <center>
              <h1>Legg inn produkt</h1>
              <br>
              <input type="submit" name="submit" value="insert" class="btn btn-primary">
            </center>
          </form>
        </div>
      </div>

    </div>

    <div class="container-fluid">

      <div class="container">
        <div class="form-group col-xs-6">
        <form action="kontaktmodul_search.php" method="GET">
          <center>
            <h1>Search</h1>
            <input type="text" size="90" name="search" class="form-control input-sm chat-input">
            <input type="radio" name="type" value="Privatpersoner" class="radio-inline">Privatpersoner
            <input type="radio" name="type" value="Bedrifter" class="radio-inline">Bedrifter
            <br>
            <br>
            <input type="submit" name="submit" value="search" class="btn btn-primary">
          </center>
        </form>
        </div>

        <div class="form-group col-xs-6">
          <form action="kontaktmodul_insert.php" method="POST">
            <center>
              <h1>Insert</h1>
              <input type="radio" name="insert" value="insert_privatperson" class="radio-inline">Privatperson
              <input type="radio" name="insert" value="insert_bedrift" class="radio-inline">Bedrift
              <br>
              <input type="submit" name="submit" value="insert" class="btn btn-primary">
            </center>
          </form>
        </div>
      </div>

    </div>
  </body>
</html>
