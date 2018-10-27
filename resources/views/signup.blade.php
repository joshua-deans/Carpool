<!Doctype html>

<html lang="en">
  <head>
    <title>Sign Up</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../styles/login.css">
  </head>

  <body>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="landing.blade.php">Carpool</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li><a href="#">About</a></li>
            <li><a href="#">How it works</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="login.blade.php">Login</a></li>
            <li class="active"><a href="#">Sign Up</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>

    <div class="container">
      <form>
        <h2>Sign Up</h2>
        <div class="form-group">
          <input type="text" class="form-control" id="inputFirstName" placeholder="First Name">
        </div>
        <div class="form-group">
          <input type="text" class="form-control" id="inputLastName" placeholder="Last Name">
        </div>
        <div class="form-group">
          <input type="text" class="form-control" id="date" name="date" placeholder="MM/DD/YYYY">
        </div>
        <div class="form-group">
          <input type="email" class="form-control" id="inputEmail" placeholder="Email">
        </div>
        <div class="form-group">
          <input type="tel" class="form-control" id="inputPhone" placeholder="Phone #">
        </div>
        <button type="submit" class="btn btn-primary">Sign Up</button>
      </form>
    </div>

    <script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
    crossorigin="anonymous"></script>
  </body>
</html>
