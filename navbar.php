<?php $username=file_get_contents("C:xampp\htdocs\BUSY\account");?>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">BuSy</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="kontaktmodul.php">Kontaktmodul</a></li>
        <li><a href="produktmodul.php">Produktmodul</a></li>
        <li><a href="message.php">Messages</a></li>
      </ul>
      <form class="navbar-form navbar-right" role="search" action="search.php" method="GET">
        <div class="form-group input-group">
          <input type="text" class="form-control" placeholder="Search.." name="search">
          <span class="input-group-btn">
            <button class="btn btn-default" type="submit" name="submit" value="search source code">
              <span class="glyphicon glyphicon-search"></span>
            </button>
          </span>
        </div>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span><?php echo $username ?></a></li>
      </ul>
    </div>
  </div>
</nav>
