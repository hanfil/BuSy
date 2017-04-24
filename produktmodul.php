<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>produktmodul</title>
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
  </body>
</html>
