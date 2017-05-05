<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>kontaktmodul</title>
    <?php include 'bootstrap.php'; ?>
    <style>
      table {
          font-family: arial, sans-serif;
          border-collapse: collapse;
          width: 100%;
      }

      td, th {
          border: 1px solid #dddddd;
          text-align: left;
          padding: 8px;
      }

      tr:nth-child(even) {
          background-color: #dddddd;
      }
      </style>
  </head>
  <body>
    <?php include 'navbar.php' ?>
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
