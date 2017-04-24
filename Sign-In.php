<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Sign-In</title>
    <?php include 'bootstrap.php'; ?>
  </head>
  <body>


    <div class="container">
    <div class="row">
        <div class="col-md-offset-5 col-md-3">
            <div class="form-login">
            <form action="connectivity.php" method="post">
            <h4>Welcome back.</h4>
            <input type="text" name="user" class="form-control input-sm chat-input" placeholder="username" />
            </br>
            <input type="password" name="pass" class="form-control input-sm chat-input" placeholder="password" />
            </br>
            <div class="wrapper">
            <span class="group-btn">
                <input class="btn btn-primary btn-md" id="button" type="submit" name="submit" value="Log-In">
                <i class="fa fa-sign-in"></i></a>
            </span>
            </div>
            </form>
            </div>

        </div>
    </div>
  </div>

  </body>
</html>
